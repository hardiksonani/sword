<?php
class Mastermoney extends CI_Model 
{ 
   
	function _construct()
	{
	   
		  // Call the Model constructor
		  parent::_construct();
	}
	private function getLiveUrl($type)
	{	
	}
	
	private function getUsername()
	{
		return "";
	}
	private function getPassword()
	{
		return "";
	}
	private function getdeveloper_key()
	{
		return "";
	}

	public function getBalance()
	{
	    $url = 'https://www.primepay.co.in/webapi/Balance';
		$req = array(
		            "username"=>$this->getUsername(),
		            "password"=>$this->getPassword(),
		    );
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLINFO_HEADER_OUT, 1);
		curl_setopt($ch, CURLOPT_BINARYTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'Accept: application/json',
			'Authkey: '.$this->getdeveloper_key()
		));
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POST,1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($req));
		curl_setopt($ch, CURLOPT_URL, $url);
		$buffer = $response = $buffer = curl_exec($ch);
		curl_close($ch);
		
	     /*
	    {"message":"Success","status":0,"statuscode":"TXN","Balance":"1000.00000"}
	    */
	    $json_obj = json_decode($buffer);
	    if(isset($json_obj->message) and isset($json_obj->status)) 
	    {
	        $message = trim($json_obj->message);
	        $status = trim($json_obj->status);
	        if($status == "0")
	        {
	            $balance = trim($json_obj->Balance);
	            return $balance;
	        }
	        else
	        {
	            return "";
	        }
	    }
	    else
	    {
	        return "";
	    }
	}
	
	public function getBankList()
	{
	    $url = 'https://www.primepay.co.in/webapi/GetBankList';
		$req = array(
		            "username"=>$this->getUsername(),
		            "password"=>$this->getPassword(),
		    );
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLINFO_HEADER_OUT, 1);
		curl_setopt($ch, CURLOPT_BINARYTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'Accept: application/json',
			'Authkey: '.$this->getdeveloper_key()
		));
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POST,1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($req));
		curl_setopt($ch, CURLOPT_URL, $url);
		$buffer = $response = $buffer = curl_exec($ch);
		curl_close($ch);
	    echo $buffer;
	}
	public function getBankitBeneList($sendermobile)
	{
	    $url = 'https://www.primepay.co.in/webapi/GetBankitBeneList';
		$req = array(
		            "username"=>$this->getUsername(),
		            "password"=>$this->getPassword(),
		            "sendermobile"=>$sendermobile,
		    );
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLINFO_HEADER_OUT, 1);
		curl_setopt($ch, CURLOPT_BINARYTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'Accept: application/json',
			'Authkey: '.$this->getdeveloper_key()
		));
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POST,1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($req));
		curl_setopt($ch, CURLOPT_URL, $url);
		$buffer = $response = $buffer = curl_exec($ch);
		curl_close($ch);
		$json_obj = json_decode($buffer);
	    if(isset($json_obj->errorMsg) and isset($json_obj->errorCode))
	    {
	        $errorCode = trim($json_obj->errorCode);
	        if($errorCode == "00")
	        {
	            $resp_array = array();
	            $data = $json_obj->data;
	            $bene_array = $data->recipientList;
	            foreach($bene_array as $bene)
	            {
	                $ifsc = $bene->udf2;
	                $accno = $bene->udf1;
	                $bene_name = $bene->recipientName;
	                $bankName = $bene->bankName;
	                $bankit_bank_id = $bene->bankCode;
	                $bank_idrslt = $this->db->query("select Id from dezire_banklist where bankit_id = ?",array($bankit_bank_id));
	                if($bank_idrslt->num_rows() == 1)
	                {
	                    $bank_id = $bank_idrslt->row(0)->Id;
	                }
	                $temparray = array(
	                    "benificiary_name"=>$bene_name,
	                    "benificiary_account_no"=>$accno,
	                    "benificiary_ifsc"=>$ifsc,
	                    "bank_name"=>$bankName,
	                    "bank_id"=>$bank_id,
	                    
	                    );
	               array_push($resp_array, $temparray);
	            }
	            return $resp_array;exit;
	        }
	    }
	}
	
	public function delete_bene($mobile_no,$bene_id,$userinfo) 
	{
	   if($userinfo != NULL)
		{
			if($userinfo->num_rows() == 1)
			{
			   
				
				$user_id = $userinfo->row(0)->user_id;
				$usertype_name = $userinfo->row(0)->usertype_name;
				$user_status = $userinfo->row(0)->status;
				if($usertype_name == "Agent")
				{
					if($user_status == '1')
					{
						$url = 'http://www.primepay.co.in/ws/delete_bene?username='.$this->getUsername().'&password='.$this->getPassword().'&sendermobile='.$mobile_no.'&beneid='.$bene_id;
                	
                		$ch = curl_init();
                		curl_setopt($ch, CURLOPT_HEADER, false);
                		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                		curl_setopt($ch, CURLINFO_HEADER_OUT, 1);
                		curl_setopt($ch, CURLOPT_BINARYTRANSFER, 1);
                		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                			'Accept: application/json',
                			'Authkey: '.$this->getdeveloper_key()
                		));
                		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                		
                		curl_setopt($ch, CURLOPT_URL, $url);
                		$buffer = $response = $buffer = curl_exec($ch);
                		curl_close($ch);
                	echo $buffer;exit;
                		
					    $json_obj = json_decode($response);
						
							if( isset($json_obj->message) and isset($json_obj->status) and isset($json_obj->statuscode))
							{
							        $message = trim((string)$json_obj->message);
									$status = trim((string)$json_obj->status);
									$statuscode = trim((string)$json_obj->statuscode);
									
									if($statuscode == "TXN")
									{
									    $temparr = array();
									    $data = $json_obj->remitter;
									    $data->mastermoney =  'yes';
									    
									     $beneficiary = $json_obj->beneficiary;
									     foreach($beneficiary as $bene)
									     {
									         /*
									          [id] => 563387 
									          [name] => CHAMPION SOFTWARE TE 
									          [mobile] => 
									          [account] => 138305500448 
									          [bank] => Icici Bank Ltd 
									          [bankId] => 45 
									          [ifsc] => ICIC0000001 
									          [available_channel] => 
									          [is_verified] => )
									         */
									         
									         $resp_beneid = $bene->id;
									         $resp_name = $bene->name;
									         $resp_account = $bene->account;
									         $resp_bankId = $bene->bankId;
									         $resp_ifsc = $bene->ifsc;
									         $resp_is_verified = $bene->is_verified;
									        
									         $checkbene = $this->db->query("select Id from mt3_beneficiary_register_temp where RESP_beneficiary_id = ?",array(intval($resp_beneid)));
									         if($checkbene->num_rows() == 0)
									         {
									             $this->db->query("insert into mt3_beneficiary_register_temp(
									                                    user_id,
									                                    add_date,ipaddress,
									                                    remitter_mobile,benificiary_name,
									                                    benificiary_ifsc,benificiary_account_no,
									                                    status,API,bank_id,RESP_beneficiary_id) values(?,?,?,?,?,?,?,?,?,?,?)",
									                                    array(
									                                        1,
									                                        $this->common->getDate(),
									                                        $this->common->getRealIpAddr(),
									                                        $mobile_no,
									                                        $resp_name,$resp_ifsc,$resp_account,
									                                        "SUCCESS","MASTERMONEY",$resp_bankId,$resp_beneid
									                                        
									                                    ));
									         }
									         
									         
									     }
									     
									     
									     
									    $resp_arr = array(
																"message"=>$message,
																"status"=>0,
																"statuscode"=>"TXN",
																"remitter"=>$data,
																"beneficiary"=>$beneficiary,
															);
										$json_resp =  json_encode($resp_arr);    
									
									}
									else
									{
									    $resp_arr = array(
																	"message"=>$message,
																	"status"=>1,
																	"statuscode"=>$statuscode,
																);
										$json_resp =  json_encode($resp_arr);
									}
							}
							else
							{
								$resp_arr = array(
										"message"=>"Internal Server Error, Please Try Later",
										"status"=>10,
										"statuscode"=>"UNK",
									);
								$json_resp =  json_encode($resp_arr);
							}
					}
					else
					{
						$resp_arr = array(
									"message"=>"Your Account Deactivated By Admin",
									"status"=>5,
									"statuscode"=>"UNK",
								);
						$json_resp =  json_encode($resp_arr);
					}
						
				}
				else
				{
					$resp_arr = array(
									"message"=>"Invalid Access",
									"status"=>5,
									"statuscode"=>"UNK",
								);
					$json_resp =  json_encode($resp_arr);
				}
			}
			else
			{
				$resp_arr = array(
									"message"=>"Userinfo Missing",
									"status"=>4,
									"statuscode"=>"UNK",
								);
				$json_resp =  json_encode($resp_arr);
			}
			
		}
		else
		{
			$resp_arr = array(
									"message"=>"Userinfo Missing",
									"status"=>4,
									"statuscode"=>"UNK",
								);
			$json_resp =  json_encode($resp_arr);
			
		}
		$this->loging("remitter_details",$url,$response,$json_resp,$userinfo->row(0)->username);
		return $json_resp;
		
	}

	public function remitter_details($mobile_no,$userinfo,$reqfrom = false) 
	{
	   if($userinfo != NULL)
		{
			if($userinfo->num_rows() == 1)
			{
			   
				
				$user_id = $userinfo->row(0)->user_id;
				$usertype_name = $userinfo->row(0)->usertype_name;
				$user_status = $userinfo->row(0)->status;
				if($usertype_name == "Agent")
				{
					if($user_status == '1')
					{
						$url = 'https://www.primepay.co.in/webapi/Getsenderinfo';
                		$req = array(
                		            "username"=>$this->getUsername(),
                		            "password"=>$this->getPassword(),
                		            "sendermobile"=>$mobile_no
                		    );
                		
                		$ch = curl_init();
                		curl_setopt($ch, CURLOPT_HEADER, false);
                		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                		curl_setopt($ch, CURLINFO_HEADER_OUT, 1);
                		curl_setopt($ch, CURLOPT_BINARYTRANSFER, 1);
                		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                			'Accept: application/json',
                			'Authkey: '.$this->getdeveloper_key()
                		));
                		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                		curl_setopt($ch, CURLOPT_POST,1);
                		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($req));
                		curl_setopt($ch, CURLOPT_URL, $url);
                		$buffer = $response = $buffer = curl_exec($ch);
                		curl_close($ch);
                	
                		
					    $json_obj = json_decode($response);
					    //print_r($json_obj );exit;
						
							if( isset($json_obj->message) and isset($json_obj->status) and isset($json_obj->statuscode))
							{
							        $message = trim((string)$json_obj->message);
									$status = trim((string)$json_obj->status);
									$statuscode = trim((string)$json_obj->statuscode);
									
									if($statuscode == "TXN")
									{
									    $temparr = array();
									    $data = $json_obj->remitter;
									    $data->mastermoney =  'yes';
									    
									     $beneficiary = $json_obj->beneficiary;
									     foreach($beneficiary as $bene)
									     {
									         /*
									          [id] => 563387 
									          [name] => CHAMPION SOFTWARE TE 
									          [mobile] => 
									          [account] => 138305500448 
									          [bank] => Icici Bank Ltd 
									          [bankId] => 45 
									          [ifsc] => ICIC0000001 
									          [available_channel] => 
									          [is_verified] => )
									         */
									         
									         $resp_beneid = $bene->id;
									         $resp_name = $bene->name;
									         $resp_account = $bene->account;
									         $resp_bankId = $bene->bankId;
									         $resp_ifsc = $bene->ifsc;
									         $resp_is_verified = $bene->is_verified;
									        
									         $checkbene = $this->db->query("select Id from mt3_beneficiary_register_temp where RESP_beneficiary_id = ?",array(intval($resp_beneid)));
									         if($checkbene->num_rows() == 0)
									         {
									             $this->db->query("insert into mt3_beneficiary_register_temp(
									                                    user_id,
									                                    add_date,ipaddress,
									                                    remitter_mobile,benificiary_name,
									                                    benificiary_ifsc,benificiary_account_no,
									                                    status,API,bank_id,RESP_beneficiary_id) values(?,?,?,?,?,?,?,?,?,?,?)",
									                                    array(
									                                        1,
									                                        $this->common->getDate(),
									                                        $this->common->getRealIpAddr(),
									                                        $mobile_no,
									                                        $resp_name,$resp_ifsc,$resp_account,
									                                        "SUCCESS","MASTERMONEY",$resp_bankId,$resp_beneid
									                                        
									                                    ));
									         }
									         
									         
									     }
									     
									     
									     
									    $resp_arr = array(
																"message"=>$message,
																"status"=>0,
																"statuscode"=>"TXN",
																"remitter"=>$data,
																"beneficiary"=>$beneficiary,
															);
										$json_resp =  json_encode($resp_arr);    
									
									}
									else
									{
									    $resp_arr = array(
																	"message"=>$message,
																	"status"=>1,
																	"statuscode"=>$statuscode,
																);
										$json_resp =  json_encode($resp_arr);
									}
							}
							else
							{
								$resp_arr = array(
										"message"=>"Internal Server Error, Please Try Later",
										"status"=>10,
										"statuscode"=>"UNK",
									);
								$json_resp =  json_encode($resp_arr);
							}
					}
					else
					{
						$resp_arr = array(
									"message"=>"Your Account Deactivated By Admin",
									"status"=>5,
									"statuscode"=>"UNK",
								);
						$json_resp =  json_encode($resp_arr);
					}
						
				}
				else
				{
					$resp_arr = array(
									"message"=>"Invalid Access",
									"status"=>5,
									"statuscode"=>"UNK",
								);
					$json_resp =  json_encode($resp_arr);
				}
			}
			else
			{
				$resp_arr = array(
									"message"=>"Userinfo Missing",
									"status"=>4,
									"statuscode"=>"UNK",
								);
				$json_resp =  json_encode($resp_arr);
			}
			
		}
		else
		{
			$resp_arr = array(
									"message"=>"Userinfo Missing",
									"status"=>4,
									"statuscode"=>"UNK",
								);
			$json_resp =  json_encode($resp_arr);
			
		}
		$this->loging("remitter_details",$url,$response,$json_resp,$userinfo->row(0)->username);
		return $json_resp;
		
	}
	

	
	
	public function verify_bene($mobile_no,$acc_no,$ifsc,$bank_id,$userinfo)
	{
	    
	   
	   error_reporting(E_ALL);
	   ini_set('display_errors',1);
	   $this->db->db_debug = TRUE;
	   // echo $mobile_no."  ".$acc_no."  ".$ifsc."  ".$bank_id;exit;
		if($userinfo != NULL)
		{
		   
			if($userinfo->num_rows() == 1)
			{
			    $user_id = $userinfo->row(0)->user_id;
				$usertype_name = $userinfo->row(0)->usertype_name;
				$user_status = $userinfo->row(0)->status;
				if($usertype_name == "Agent")
				{
					if($user_status == '1')
					{
						
						$accval_resultcheck = $this->db->query("SELECT RESP_benename FROM `mt3_account_validate` where account_no = ? and remitter_mobile = ? and user_id = ? and status = 'SUCCESS' and API = 'MASTERMONEY' order by Id desc limit 1",
						array($acc_no,$mobile_no,$user_id));
						
						if($accval_resultcheck->num_rows() == 1)
						{
						    $resp_arr = array(
													"message"=>"Beneficiary Already Validated ".$accval_resultcheck->row(0)->RESP_benename,
													"status"=>0,
													"statuscode"=>"TXN",
													"recipient_name"=>$accval_resultcheck->row(0)->RESP_benename
												);
							$json_resp =  json_encode($resp_arr);	
						}
						else
						{
						    	$crntBalance = $this->Common_methods->getAgentBalance($user_id);
						    
    						if(floatval($crntBalance) < 3)
    						{
    							$resp_arr = array(
    													"message"=>"InSufficient Balance",
    													"status"=>1,
    													"statuscode"=>"ISB",
    												);
    							$json_resp =  json_encode($resp_arr);
    							echo $json_resp;exit;
    						}
    					//echo 	$mobile_no."  ".$mobile_no."  ".$acc_no."  ".$ifsc;exit;
    					
    						$rsltinsert = $this->db->query("insert into mt3_account_validate(user_id,add_date,edit_date,ipaddress,remitter_mobile,remitter_id,account_no,IFSC,status,API) 
    						values(?,?,?,?,?,?,?,?,?,?)",array(
    							$user_id,$this->common->getDate(),1,$this->common->getRealIpAddr(),$mobile_no,$mobile_no,$acc_no,$ifsc,"PENDING","MASTERMONEY"
    						));
    					//	var_dump($rsltinsert);exit;
    						if($rsltinsert == true)
    						{
    							$insert_id = $this->db->insert_id();
    							$transaction_type = "DMR";
    							$sub_txn_type = "Account_Validation";
    							$charge_amount = 3.00;
    							$Description = "Account Validation Charge";
    							$remark = $mobile_no."  Acc NO :".$acc_no;
    							$debitpayment = $this->PAYMENT_DEBIT_ENTRY($user_id,$insert_id,$transaction_type,$charge_amount,$Description,$sub_txn_type,$remark,0,0,0,$userinfo);
                               // var_dump($debitpayment);exit;
    							if($debitpayment == true)
    							{
    								
    								$url = 'https://www.primepay.co.in/webapi/VerifyBene';
                            		$req = array(
                            		            "username"=>$this->getUsername(),
                            		            "password"=>$this->getPassword(),
                            		            "sendermobile"=>$mobile_no,
                            		            "account_number"=>$acc_no,
                            		            "ifsc"=>$ifsc,
                            		            "bank_id"=>""
                            		    );
                            		
                            		$ch = curl_init();
                            		curl_setopt($ch, CURLOPT_HEADER, false);
                            		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                            		curl_setopt($ch, CURLINFO_HEADER_OUT, 1);
                            		curl_setopt($ch, CURLOPT_BINARYTRANSFER, 1);
                            		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                            			'Accept: application/json',
                            			'Authkey: '.$this->getdeveloper_key()
                            		));
                            		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                            		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                            		curl_setopt($ch, CURLOPT_POST,1);
                            		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($req));
                            		curl_setopt($ch, CURLOPT_URL, $url);
                            		$buffer = $response = $buffer = curl_exec($ch);
                            		curl_close($ch);
    							    $json_obj = json_decode($response);
            						
            					//	echo "Response :: ".$buffer;exit;
            						/*
            					{"message":"Beneficiary Already Validated. RAVIKANT LAXMANBHAI","status":1,"statuscode":"ERR","recipient_name":"RAVIKANT LAXMANBHAI"}
            						*/
        							if( isset($json_obj->message) and isset($json_obj->status) and isset($json_obj->statuscode))
        							{
        							        $message = trim((string)$json_obj->message);
        									$status = trim((string)$json_obj->status);
        									$statuscode = trim((string)$json_obj->statuscode);
        								    if( preg_match('/Beneficiary Already Validated/',$message) == 1)
        								    {
        								        $statuscode = "TXN";
        								       
        								    }
        									
        									
        									if($statuscode == "TXN")
        									{
        									    $recipient_name = trim((string)$json_obj->recipient_name);
        									    $this->db->query("update mt3_account_validate 
        															set RESP_statuscode = ?,
        																RESP_status = ?,
        																RESP_benename = ?,
        																verification_status = ?,
        																status = 'SUCCESS'
        																where 	Id = ?",
        																array
        																(
        																	"TXN",
        																	$message,
        																	$recipient_name,
        																    "SUCCESS",
        																	$insert_id
        																)
        															);
        										$resp_arr = array(
        																	"message"=>"Beneficiary Validation Successful",
        																	"status"=>0,
        																	"statuscode"=>"TXN",
        																	"recipient_name"=>$recipient_name
        																);
        										$json_resp =  json_encode($resp_arr);
        									
        									}
        									else if($statuscode == "ERR")
        									{
        									     $this->PAYMENT_CREDIT_ENTRY($user_id,$insert_id,$transaction_type,$charge_amount,$Description,$sub_txn_type,$remark,0);
                                                    
        											$resp_arr = array(
        																	"message"=>$message,
        																	"status"=>1,
        																	"statuscode"=>"ERR",
        																);
        											$json_resp =  json_encode($resp_arr);
        											$this->db->query("update mt3_account_validate 
    																						set RESP_statuscode = ?,
    																							RESP_status = ?,
    																							verification_status = ?,
    																							status = 'FAILURE'
    																							where 	Id = ?",
    																							array
    																							(
    																								"ERR",
    																								$message,
    																							    "FAILURE",
    																								$insert_id
    																							)
    																						);
        									}
        									else
        									{
        									    $resp_arr = array(
        																	"message"=>$message,
        																	"status"=>1,
        																	"statuscode"=>$statuscode,
        																);
        										$json_resp =  json_encode($resp_arr);
        									}
        							}
        							else
        							{
        								$resp_arr = array(
        										"message"=>"Internal Server Error, Please Try Later",
        										"status"=>10,
        										"statuscode"=>"UNK",
        									);
        								$json_resp =  json_encode($resp_arr);
        							}
    							}
    							
    						}
						}	
					
					}
					else

					{
						$resp_arr = array(
									"message"=>"Your Account Deactivated By Admin",
									"status"=>5,
									"statuscode"=>"UNK",
								);
						$json_resp =  json_encode($resp_arr);
					}
						
				}
				else
				{
					$resp_arr = array(
									"message"=>"Invalid Access",
									"status"=>5,
									"statuscode"=>"UNK",
								);
					$json_resp =  json_encode($resp_arr);
				}
			}
			else
			{
				$resp_arr = array(
									"message"=>"Userinfo Missing",
									"status"=>4,
									"statuscode"=>"UNK",
								);
				$json_resp =  json_encode($resp_arr);
			}
			
		}
		else
		{
			$resp_arr = array(
									"message"=>"Userinfo Missing",
									"status"=>4,
									"statuscode"=>"UNK",
								);
			$json_resp =  json_encode($resp_arr);
			
		}
		$this->loging("verify_bene",$url.">>>>".json_encode($req),$buffer,$json_resp,$userinfo->row(0)->username);
		return $json_resp;
		
	}
	
	
	//http://staging.eko.co.in:25004/ekoapi/v1/customers/mobile_number:3000000026/recipients/acc_ifsc:32100000000_SBIN0008441
	
	public function add_benificiary($mobile_no,$bene_name,$bene_mobile,$acc_no,$ifsc,$bank_id,$userinfo) //done
	{
	
	
		//$resparr = array("status"=>"1","message"=>"Sender MObile : ".$mobile_no."   beneName : ".$bene_name."   BENE mobile : ".$bene_mobile."   ACCNO :".$acc_no."   IFSC : ".$ifsc."   bankId:".$bank_id,"statuscode"=>"ERR");
		//echo json_encode($resparr);exit;
		if($userinfo != NULL)
		{
			if($userinfo->num_rows() == 1)
			{
			   
				
				$user_id = $userinfo->row(0)->user_id;
				$usertype_name = $userinfo->row(0)->usertype_name;
				$user_status = $userinfo->row(0)->status;
				if($usertype_name == "Agent" or $usertype_name == "APIUSER")
				{
					if($user_status == '1')
					{
						$checkbeneexist = $this->db->query("select * from beneficiaries where sender_mobile = ? and account_number = ? and IFSC = ? order by Id desc limit 1",array($mobile_no,$acc_no,$ifsc));
						//if($checkbeneexist->num_rows() ==  1)
						if(false)
						{
						    $Id = $checkbeneexist->row(0)->Id;
							$resp_arr = array(
														"message"=>"Beneficiary Already Registered",
														"status"=>1,
														"statuscode"=>"ERR",
														"data"=>$Id
													);
							$json_resp =  json_encode($resp_arr);
							
						}
						else
						{
							$insertrslt = $this->db->query("insert into beneficiaries
											(
											ipaddress,add_date,bene_name,account_number,IFSC,benemobile,
											sender_mobile,is_verified,paytm_bene_id,is_paytm,bank_name,dezire_bank_id,status
											) values(?,?,?,?,?,?,?,?,?,?,?,?,?)",
											array($this->common->getRealIpAddr(),$this->common->getDate(),$bene_name,$acc_no,$ifsc,$bene_mobile,$mobile_no,false,"",'no',"",$bank_id,"PENDING") );
							if($insertrslt == true)		
							{
								$insert_id = $this->db->insert_id();
    							$url = 'http://rechargeplaza.in/webapi/Beneficiary_Registration';
                        		$req = array(
                        		            "username"=>$this->getUsername(),
                        		            "password"=>$this->getPassword(),
                        		            "sendermobile"=>$mobile_no,
                        		            "benificiary_name"=>$bene_name,
                        		            "benificiary_mobile"=>$mobile_no,
                        		            "benificiary_ifsc"=>$ifsc,
                        		            "benificiary_account_no"=>$acc_no,
                        		            "bank_id"=>$bank_id
                        		    );
                        		
                        		$ch = curl_init();
                        		curl_setopt($ch, CURLOPT_HEADER, false);
                        		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                        		curl_setopt($ch, CURLINFO_HEADER_OUT, 1);
                        		curl_setopt($ch, CURLOPT_BINARYTRANSFER, 1);
                        		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                        			'Accept: application/json',
                        			'Authkey: '.$this->getdeveloper_key()
                        		));
                        		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                        		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        		curl_setopt($ch, CURLOPT_POST,1);
                        		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($req));
                        		curl_setopt($ch, CURLOPT_URL, $url);
                        		$buffer = $response = $buffer = curl_exec($ch);
                        		curl_close($ch);
    							
    							$json_obj = json_decode($buffer);
    							
    						/*

{"message":"Beneficiary Registration Successful","status":0,"statuscode":"TXN","remiter_id":"180873","beneid":22995526}
    						*/
    							
    							if(isset($json_obj->message) and isset($json_obj->status) and isset($json_obj->statuscode) )
    							{
    								    $message = trim((string)$json_obj->message);
    									$status = trim((string)$json_obj->status);
    									$statuscode = trim((string)$json_obj->statuscode);
    									$recipient_id = 0;
    									if($statuscode == "TXN")
    									{
    									   $recipient_id = trim((string)$json_obj->beneid);    
    									}
    									if($status == "0")
    									{
    										$this->db->query("update beneficiaries set status = 'SUCCESS',dezire_bene_id=? where Id = ?",
    										array($recipient_id,$insert_id));
    									    $resp_arr = array(
    																"message"=>$message,
    																"status"=>0,
    																"statuscode"=>$statuscode,
    																"data"=>$recipient_id,
    															);
    										$json_resp =  json_encode($resp_arr);
    									}
	    								else
	    								{
	    									   $resp_arr = array(
	    																"message"=>$message,
	    																"status"=>$status,
	    																"statuscode"=>$statuscode,
	    															);
	    										$json_resp =  json_encode($resp_arr);
	    								}
    									
    									
    							}
    							else
    							{
    								$resp_arr = array(
    										"message"=>"Internal Server Error, Please Try Later",
    										"status"=>10,
    										"statuscode"=>"UNK",
    									);
    								$json_resp =  json_encode($resp_arr);
    							}
							}
						}
    							
    						
						
					}
					else
					{
						$resp_arr = array(
									"message"=>"Your Account Deactivated By Admin",
									"status"=>5,
									"statuscode"=>"UNK",
								);
						$json_resp =  json_encode($resp_arr);
					}
						
				}
				else
				{
					$resp_arr = array(
									"message"=>"Invalid Access",
									"status"=>5,
									"statuscode"=>"UNK",
								);
					$json_resp =  json_encode($resp_arr);
				}
			}
			else
			{
				$resp_arr = array(
									"message"=>"Userinfo Missing",
									"status"=>4,
									"statuscode"=>"UNK",
								);
				$json_resp =  json_encode($resp_arr);
			}
			
		}
		else
		{
			$resp_arr = array(
									"message"=>"Userinfo Missing",
									"status"=>4,
									"statuscode"=>"UNK",
								);
			$json_resp =  json_encode($resp_arr);
			
		}
		$this->loging("mastermoney_set_beneficiary",$url."?".json_encode($req),$buffer,$json_resp,$userinfo->row(0)->username);
		return $json_resp;
		
	}
	
	
	
	public function transfer($remittermobile,$beneficiaryid,$amount,$mode,$userinfo,$unique_id,$done_by = "WEB",$bank_id = 0)
	{
	 exit;   
		$remitter_id = $remittermobile;
		$mobile_no = $remittermobile;
		$postfields = '';
		$postparam = $remittermobile." <> ".$beneficiaryid." <> ".$amount." <> ".$mode;
		$buffer = "No Api Call";
		$url = "";
		if($amount < 10)
		{
		    $resp_arr = array(
									"message"=>"Invalid Amount",
									"status"=>1,
									"statuscode"=>"ERR",
								);
			$json_resp =  json_encode($resp_arr);
		}
		else
		{
		    if($mode == "IMPS")
    		{
    			$apimode = "2";
    		}
    		if($mode == "NEFT")
    		{
    			$apimode = "1";
    		}
    		
    	//	if($userinfo->row(0)->service == 'no' )
    	if(false)
    		{
    		    $resp_arr = array(
    									"message"=>"Userinfo Missing",
    									"status"=>4,
    									"statuscode"=>"UNK",
    								);
    			$json_resp =  json_encode($resp_arr);
    		}
    		else
    		{
    		    if($userinfo != NULL )
        		{
        			if($userinfo->num_rows() == 1)
        			{
        				$url = '';
        				$user_id = $userinfo->row(0)->user_id;
        				$DId = $userinfo->row(0)->parentid;
        				$MdId = 0;
        				$usertype_name = $userinfo->row(0)->usertype_name;
        				$user_status = $userinfo->row(0)->status;
        				if($usertype_name == "Agent")
        				{
        					$parentinfo = $this->db->query("select user_id,parentid from tblusers where user_id = ? order by user_id",array($DId));
        					if($parentinfo->num_rows() == 1)
        					{
        							$MdId = $parentinfo->row(0)->parentid;
        					}
        					if($user_status == '1')
        					{
        						
        						$crntBalance = $this->Common_methods->getAgentBalance($user_id);
        						if(floatval($crntBalance) >= floatval($amount) + 30)
        						{
        						
        								
        								$checkbeneexist = $this->db->query("select benificiary_name,benificiary_mobile,benificiary_ifsc,benificiary_account_no from mt3_beneficiary_register_temp 
        																	where remitter_mobile = ? and RESP_beneficiary_id = ?",
        																	array($remittermobile,$beneficiaryid));
        							
        								if($checkbeneexist->num_rows() >= 1)
        								{
        									$benificiary_name = $checkbeneexist->row(0)->benificiary_name;
        									$benificiary_mobile = $checkbeneexist->row(0)->benificiary_mobile;
        									$benificiary_ifsc = $checkbeneexist->row(0)->benificiary_ifsc;
        									$benificiary_account_no = $checkbeneexist->row(0)->benificiary_account_no;
        									
        									
        									$chargeinfo = $this->getChargeValue($userinfo,$amount);
        									$dist_charge_type = "AMOUNT";
        									$dist_charge_value = "0";
        									$dist_charge_amount="0";
        
        
                                            $this->load->model("Mastermoney");
                                            if(true)
                                            {
                                                	if($userinfo->row(0)->usertype_name == "APIUSER")
                									{
                										$Charge_type = "AMOUNT";
                										$charge_value = 4.5;
                										$Charge_Amount = 4.5;
                									}
                									else if($chargeinfo != false)
                									{
                										/////////////////////////////////////////////////
                										/////// RETAILER CHARGE CALCULATION
                										////////////////////////////////////////////////
                										$ccf = $chargeinfo->row(0)->ccf;	
                										$cashback = $chargeinfo->row(0)->cashback;	
                										$tds = $chargeinfo->row(0)->tds;
                										
                										$ccf_type = $chargeinfo->row(0)->ccf_type;	
                										$cashback_type = $chargeinfo->row(0)->cashback_type;	
                										$tds_type = $chargeinfo->row(0)->tds_type;
                										
                                                        if($ccf_type == "PER")
                                                        {
                                                           $ccf = ((floatval($ccf) * floatval($amount))/ 100); 
                                                        }
                                                        if($cashback_type == "PER")
                                                        {
                                                           $cashback = ((floatval($cashback) * floatval($amount))/ 100); 
                                                        }
                                                        if($tds_type == "PER")
                                                        {
                                                           $tds = ((floatval($tds) * floatval($cashback))/ 100); 
                                                        }
                										
                										
                										
                										$Charge_type = $chargeinfo->row(0)->charge_type;
                										$charge_value = $chargeinfo->row(0)->charge_value;
                										if($Charge_type == "PER")
                										{
                											$Charge_Amount = ((floatval($charge_value) * floatval($amount))/ 100); 
                											$Charge_Amount = $Charge_Amount + $tds;
            											    $Charge_Amount = (round($Charge_Amount * 1000)/1000);
                										}
                										else
                										{
                											$Charge_Amount = $chargeinfo->row(0)->charge_value;	
                										}
                										
                
                										/////////////////////////////////////////////////
                										/////// DISTRIBUTOR CHARGE CALCULATION
                										////////////////////////////////////////////////
                										$dist_charge_type = $chargeinfo->row(0)->dist_charge_type;
                										$dist_charge_value = $chargeinfo->row(0)->dist_charge_value;
                										if($dist_charge_type == "PER")
                										{
                											$dist_charge_amount = ((floatval($dist_charge_value) * floatval($amount))/ 100); 
                										}
                										else
                										{
                											$dist_charge_amount = $chargeinfo->row(0)->dist_charge_value;	
                										}
                
                									}
                									else
                									{
                										$Charge_type = "PER";
                										$charge_value = 0.40;
                										$Charge_Amount = ((floatval($charge_value) * floatval($amount))/ 100); 
                										$ccf = 0;
                										$cashback = 0;
                										$tds = 0;
                									}
                									
                									
                										
                									
                										$resultInsert = $this->db->query("
                											insert into mt3_transfer(
                											add_date,ipaddress,user_id,DId,MdId,
                											Charge_type,
                											charge_value,
                											Charge_Amount,
                											dist_charge_type,
                											dist_charge_value,
                											dist_charge_amount,
                											RemiterMobile,
                											remitter_id,
                											BeneficiaryId,
                											AccountNumber,
                											IFSC,
                											Amount,
                											Status,
                											mode,unique_id,API,done_by,ccf,cashback,tds)
                											values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)
                											",array($this->common->getDate(),$this->common->getRealIpAddr(),$user_id,$DId,$MdId,
                											$Charge_type,$charge_value,$Charge_Amount,
                											$dist_charge_type,$dist_charge_value,$dist_charge_amount,
                											$remittermobile,$remitter_id,
                											$beneficiaryid,$benificiary_account_no,$benificiary_ifsc,
                											$amount,"PENDING",$mode,$unique_id,"MASTERMONEY",$done_by,$ccf,$cashback,$tds
                											));
                										if($resultInsert == true)
                										{
                											$insert_id = $this->db->insert_id();
                											$transaction_type = "DMR";
                											$dr_amount = $amount;
                											$Description = "DMR ".$remittermobile." Acc No : ".$benificiary_account_no;
                											$sub_txn_type = "REMITTANCE";
                											$remark = "Money Remittance";
                											$paymentdebited = $this->PAYMENT_DEBIT_ENTRY($user_id,$insert_id,$transaction_type,$dr_amount,$Description,$sub_txn_type,$remark,$Charge_Amount,$userinfo);
                											if($paymentdebited == true)
                											{
                											    
                											    
                											    $dohold = 'no';
                											    $rsltcommon = $this->db->query("select * from common where param = 'DMRHOLD'");
            												    if($rsltcommon->num_rows() == 1)
            												    {
            												        $is_hold = $rsltcommon->row(0)->value;
            												    	if($is_hold == 1)
            												    	{
            												    	    $dohold = 'yes';
            												    	}
            												    }
                											    
                												//if($mode == "NEFT")
                											    if($dohold == 'yes' and $mode == "NEFT")
                												{
                													$this->db->query("update mt3_transfer set Status = 'HOLD' where Id = ?",array($insert_id));
                													$resp_arr = array(
                																							"message"=>"Transaction Under Process",
                																							"status"=>0,
                																							"statuscode"=>"TXN",
                																						);
                													$json_resp =  json_encode($resp_arr);
                												}
                												else
                												{
////////////////
////////// timmer start here
//////////////////////////////
$msc_step1 = microtime(true);
$dt_step1 = $this->common->getDate();


                												    
                												    
                												    
                												     $timestamp = str_replace('+00:00', 'Z', gmdate('c', strtotime($this->common->getDate())));
                				
                				$url = 'https://www.primepay.co.in/webapi/Transfer';
                        		$req = array(
                        		            "username"=>$this->getUsername(),
                        		            "password"=>$this->getPassword(),
                        		            "sendermobile"=>$mobile_no,
                        		            "bene_id"=>$beneficiaryid,
                        		            "amount"=>$amount,
                        		            "mode"=>$mode,
                        		            "bank_id"=>$bank_id,
                        		            "order_id"=>$insert_id
                        		    );
                        		
                        		$ch = curl_init();
                        		curl_setopt($ch, CURLOPT_HEADER, false);
                        		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                        		curl_setopt($ch, CURLINFO_HEADER_OUT, 1);
                        		curl_setopt($ch, CURLOPT_BINARYTRANSFER, 1);
                        		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                        			'Accept: application/json',
                        			'Authkey: '.$this->getdeveloper_key()
                        		));
                        		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                        		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        		curl_setopt($ch, CURLOPT_POST,1);
                        		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($req));
                        		curl_setopt($ch, CURLOPT_URL, $url);
                        		$buffer = $response = $buffer = curl_exec($ch);
                        		curl_close($ch);

                    
                    												$json_obj = json_decode($buffer);
                    												/*
                    												"data"=>array(
            																							"tid"=>$insert_id,
            																							"ref_no"=>$insert_id,
            																							"opr_id"=>$rrn,
            																							"name"=>$extra_info->beneficiaryName,																								"balance"=>"",
            																							"amount"=>$amount,
            
            																						)
                    												*/
                    													if(isset($json_obj->message) and isset($json_obj->status) and isset($json_obj->statuscode) )
                    													{
                    															$message = $json_obj->message;
                    															$status = $json_obj->status;
                    															$statuscode = $json_obj->statuscode;
                    															
                    															
                    
                    															if($statuscode == "TXN")
                    															{
                    															   
                    																$data = $json_obj->data;
                    																$tid = trim((string)$data->tid);
                    																$bank_ref_num = trim((string)$data->opr_id);
                    																$recipient_name = trim((string)$data->name);
                    
                                                                                   
                    																	$data = array(
                    																				'RESP_statuscode' => "TXN",
                    																				'RESP_status' => $message,
                    																				'RESP_ipay_id' => $tid,
                    																				'RESP_ref_no' => $tid,
                    																				'RESP_opr_id' => $bank_ref_num,
                    																				'RESP_name' => $recipient_name,
                    																				'Status'=>'SUCCESS',
                    																				'edit_date'=>$this->common->getDate()
                    																		);
                    
                    																		$this->db->where('Id', $insert_id);
                    																		$this->db->update('mt3_transfer', $data);
                    																		
                    																		$resp_arr = array(
                    																							"message"=>$message,
                    																							"status"=>0,
                    																							"data"=>array(
                    																								"tid"=>$tid,
                    																								"ref_no"=>$tid,
                    																								"opr_id"=>$bank_ref_num,
                    																								"name"=>$recipient_name,
                    																								"balance"=>0,
                    																								"amount"=>$amount,
                    
                    																							)
                    																						);
                    																		$json_resp =  json_encode($resp_arr);
                    
                    															}
                    															else if($statuscode == "ERR")
                    															{
                    															    
                    																	
                    																	if($status == "1")
                    																	{
                    																		$this->PAYMENT_CREDIT_ENTRY($user_id,$insert_id,$transaction_type,$dr_amount,$Description,$sub_txn_type,$remark,$Charge_Amount,$userinfo);	
                    																	}
                    																	
                    
                    																	$data = array(
                    																			'RESP_statuscode' => $statuscode,
                    																			'RESP_status' => $message,
                    																			'Status'=>'FAILURE',
                    																			'edit_date'=>$this->common->getDate()
                    																	);
                    
                    																	$this->db->where('Id', $insert_id);
                    																	$this->db->update('mt3_transfer', $data);
                    																	$resp_arr = array(
                    																							"message"=>$message,
                    																							"status"=>1,
                    																							"statuscode"=>$statuscode,
                    																						);
                    																	$json_resp =  json_encode($resp_arr);
                    															}
                    
                    
                    													}
                    												
                    													else
                    													{ 
                    														//check status befor refund
                    														//$this->PAYMENT_CREDIT_ENTRY($user_id,$insert_id,$transaction_type,$dr_amount,$Description,$sub_txn_type,$remark,$Charge_Amount);
                    														$data = array(
                    																			'RESP_statuscode' => "UNK",
                    																			'RESP_status' => "Unknown Response or No Response",
                    																			'edit_date'=>$this->common->getDate()
                    																	);
                    
                    																	$this->db->where('Id', $insert_id);
                    																	$this->db->update('mt3_transfer', $data);
                    														$resp_arr = array(
                    																"message"=>"Internal Server Error, Please Try Later",
                    																"status"=>10,
                    																"statuscode"=>"UNK",
                    															);
                    														$json_resp =  json_encode($resp_arr);
                    													}
                												}
                											}
                											else
                											{
                											    	$data = array(
                																			'RESP_statuscode' => "ERR",
                																			'RESP_status' => "PAYMENT FAILURE",
                																			'tx_status'=>"1",
                																			'Status'=>'FAILURE',
                																			"row_lock"=>"LOCKED",
                																			'edit_date'=>$this->common->getDate()
                																	);
                
                																	$this->db->where('Id', $insert_id);
                																	$this->db->update('mt3_transfer', $data);
                												$resp_arr = array(
                													"message"=>"Payment Failure",
                													"status"=>1,
                													"statuscode"=>"ERR",
                												);
                												$json_resp =  json_encode($resp_arr);	
                											}		
                										}
                										else
                										{
                											$resp_arr = array(
                												"message"=>"Internal Server Error",
                												"status"=>1,
                												"statuscode"=>"ERR",
                											);
                											$json_resp =  json_encode($resp_arr);	
                										}
                                            }
                                            else
                                            {
                                                $resp_arr = array(
        											"message"=>"Monthly Transfer Limit Exceeded For This Account Number",
        											"status"=>1,
        											"statuscode"=>"ERR",
        										);
        									$json_resp =  json_encode($resp_arr);
                                            }
        
        
        								
        									
        								}
        								else
        								{
        									$resp_arr = array(
        											"message"=>"Invalid Beneficiary Id",
        											"status"=>1,
        											"statuscode"=>"RNF",
        										);
        									$json_resp =  json_encode($resp_arr);
        								}
        							
        						}
        						else
        						{
        							$resp_arr = array(
        									"message"=>"InSufficient Balance",
        									"status"=>1,
        									"statuscode"=>"ISB",
        								);
        							$json_resp =  json_encode($resp_arr);
        						}
        					}
        					else
        					{
        						$resp_arr = array(
        									"message"=>"Your Account Deactivated By Admin",
        									"status"=>1,
        									"statuscode"=>"UNK",
        								);
        						$json_resp =  json_encode($resp_arr);
        					}
        						
        				}
        				else
        				{
        					$resp_arr = array(
        									"message"=>"Invalid Access",
        									"status"=>1,
        									"statuscode"=>"UNK",
        								);
        					$json_resp =  json_encode($resp_arr);
        				}
        			}
        			else
        			{
        				$resp_arr = array(
        									"message"=>"Userinfo Missing",
        									"status"=>4,
        									"statuscode"=>"UNK",
        								);
        				$json_resp =  json_encode($resp_arr);
        			}
        			
        		}
        		else
        		{
        			$resp_arr = array(
        									"message"=>"Userinfo Missing",
        									"status"=>4,
        									"statuscode"=>"UNK",
        								);
        			$json_resp =  json_encode($resp_arr);
        			
        		}    
    		}   
		}
		$this->loging("mastermoneytransfer","1>>>".$url."?".$postfields,$buffer,$json_resp,$userinfo->row(0)->username);
		return $json_resp;
		
	}
	
	
	
	public function transfer2($remittermobile,$beneficiaryid,$amount,$mode,$userinfo,$unique_id,$done_by,$bank_id,$whole_amount)
	{
	    
		$remitter_id = $remittermobile;
		$mobile_no = $remittermobile;
		$postfields = '';
		$postparam = $remittermobile." <> ".$beneficiaryid." <> ".$amount." <> ".$mode;
		$buffer = "No Api Call";
		$url = "";
		if($amount < 10)
		{
		    $resp_arr = array(
									"message"=>"Invalid Amount",
									"status"=>1,
									"statuscode"=>"ERR",
								);
			$json_resp =  json_encode($resp_arr);
		}
		else
		{
		    if($mode == "IMPS")
    		{
    			$apimode = "2";
    		}
    		if($mode == "NEFT")
    		{
    			$apimode = "1";
    		}
    		
    	    if(false)
    		{
    		    $resp_arr = array(
    									"message"=>"Userinfo Missing",
    									"status"=>4,
    									"statuscode"=>"UNK",
    								);
    			$json_resp =  json_encode($resp_arr);
    		}
    		else
    		{
    		   
    		    if($userinfo != NULL )
        		{
        			if($userinfo->num_rows() == 1)
        			{
        				$url = '';
        				$user_id = $userinfo->row(0)->user_id;
        				$DId = $userinfo->row(0)->parentid;
        				$MdId = 0;
        				$usertype_name = $userinfo->row(0)->usertype_name;
        				$user_status = $userinfo->row(0)->status;
        				if($usertype_name == "Agent")
        				{
        					$parentinfo = $this->db->query("select * from tblusers where user_id = ?",array($DId));
        					if($parentinfo->num_rows() == 1)
        					{
        							$MdId = $parentinfo->row(0)->parentid;
        					}
        					if($user_status == '1')
        					{
        						
        						$crntBalance = $this->Common_methods->getAgentBalance($user_id);
        						if(floatval($crntBalance) >= floatval($amount) + 30)
        						{
        						
        								
        								$checkbeneexist = $this->db->query("select benificiary_name,benificiary_mobile,benificiary_ifsc,benificiary_account_no from mt3_beneficiary_register_temp 
        																	where remitter_mobile  = ? and RESP_beneficiary_id  = ?",
        																	array($remittermobile,$beneficiaryid));
        							
        								if($checkbeneexist->num_rows() >= 1)
        								{
        									$benificiary_name = $checkbeneexist->row(0)->benificiary_name;
        									$benificiary_mobile = $checkbeneexist->row(0)->benificiary_mobile;
        									$benificiary_ifsc = $checkbeneexist->row(0)->benificiary_ifsc;
        									$benificiary_account_no = $checkbeneexist->row(0)->benificiary_account_no;
        									
        									
        									$chargeinfo = $this->getChargeValue($userinfo,$amount);
        								
        									$dist_charge_type = "AMOUNT";
        									$dist_charge_value = "0";
        									$dist_charge_amount="0";
        
        
                                            $this->load->model("Mastermoney");
                                            if(true)
                                            {
                                                	if($userinfo->row(0)->usertype_name == "APIUSER")
                									{
                										$Charge_type = "AMOUNT";
                										$charge_value = 4.5;
                										$Charge_Amount = 4.5;
                									}
                									else if($chargeinfo != false)
                									{
                										/////////////////////////////////////////////////
                										/////// RETAILER CHARGE CALCULATION
                										////////////////////////////////////////////////
                										
                										$ccf = $chargeinfo->row(0)->ccf;	
                										$cashback = $chargeinfo->row(0)->cashback;	
                										$tds = $chargeinfo->row(0)->tds;
                										
                										
                										$ccf_type = $chargeinfo->row(0)->ccf_type;	
                										$cashback_type = $chargeinfo->row(0)->cashback_type;	
                										$tds_type = $chargeinfo->row(0)->tds_type;
                										
                										
                										
                										$Charge_type = $chargeinfo->row(0)->charge_type;;
                										$charge_value = $chargeinfo->row(0)->charge_value;;
                										
                                                        if($ccf_type == "PER")
                                                        {
                                                           $ccf = ((floatval($ccf) * floatval($amount))/ 100); 
                                                        }
                                                        if($cashback_type == "PER")
                                                        {
                                                           $cashback = ((floatval($cashback) * floatval($ccf))/ 100); 
                                                        }
                                                        if($tds_type == "PER")
                                                        {
                                                           $tds = ((floatval($tds) * floatval($cashback))/ 100); 
                                                        }
                										
                										
                									    
                									    if($Charge_type == "PER")
                									    {
                									        $Charge_Amount = ((floatval($amount) * floatval($charge_value))/ 100);   
                									    }
                									    else
                									    {
                									        $Charge_Amount = $charge_value; 
                									    }
                									        
                									    
                									
            											
        											    
                									
                										
                
                										/////////////////////////////////////////////////
                										/////// DISTRIBUTOR CHARGE CALCULATION
                										////////////////////////////////////////////////
                										$dist_charge_type = $chargeinfo->row(0)->dist_charge_type;
                										$dist_charge_value = $chargeinfo->row(0)->dist_charge_value;
                										if($dist_charge_type == "PER")
                										{
                											$dist_charge_amount = ((floatval($dist_charge_value) * floatval($amount))/ 100); 
                										}
                										else
                										{
                											$dist_charge_amount = $chargeinfo->row(0)->dist_charge_value;	
                										}
                
                									}
                									else
                									{
                										$Charge_type = "PER";
                										$charge_value = 0.50;
                										$Charge_Amount = ((floatval($charge_value) * floatval($amount))/ 100); 
                										$ccf = 0;
                										$cashback = 0;
                										$tds = 0;
                									}
                									
                								
                								//	$this->db->db_debug = TRUE;
                								//	error_reporting(E_ALL);
                							//		ini_set('display_errors',1);
                										$resultInsert = $this->db->query("
                											insert into mt3_transfer(
                											add_date,ipaddress,user_id,DId,MdId,
                											Charge_type,
                											charge_value,
                											Charge_Amount,
                											dist_charge_type,
                											dist_charge_value,
                											dist_charge_amount,
                											RemiterMobile,
                											remitter_id,
                											BeneficiaryId,
                											AccountNumber,
                											IFSC,
                											Amount,
                											Status,
                											mode,unique_id,API,done_by,ccf,cashback,tds,bank_id)
                											values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)
                											",array($this->common->getDate(),$this->common->getRealIpAddr(),$user_id,$DId,$MdId,
                											$Charge_type,$charge_value,$Charge_Amount,
                											$dist_charge_type,$dist_charge_value,$dist_charge_amount,
                											$remittermobile,$remitter_id,
                											$beneficiaryid,$benificiary_account_no,$benificiary_ifsc,
                											$amount,"PENDING",$mode,$unique_id,"MASTERMONEY",$done_by,$ccf,$cashback,$tds,$bank_id
                											));
                										if($resultInsert == true)
                										{
                											$insert_id = $this->db->insert_id();
                											$transaction_type = "DMR";
                											$dr_amount = $amount;
                											$Description = "DMR ".$remittermobile." Acc No : ".$benificiary_account_no;
                											$sub_txn_type = "REMITTANCE";
                											$remark = "Money Remittance";
                									
                			                                $paymentdebited = $this->PAYMENT_DEBIT_ENTRY($user_id,$insert_id,$transaction_type,$amount,$Description,$sub_txn_type,$remark,$Charge_Amount,$userinfo);
                											if($paymentdebited == true)
                											{
                											    
                											    
                											    $dohold = 'no';
                											    
////
////////////////
////////// timmer start here
//////////////////////////////
$msc_step1 = microtime(true);
$dt_step1 = $this->common->getDate();

                												     $timestamp = str_replace('+00:00', 'Z', gmdate('c', strtotime($this->common->getDate())));
                    											$url = 'https://www.primepay.co.in/webapi/Transfer';
                                                        		$req = array(
                                                        		            "username"=>$this->getUsername(),
                                                        		            "password"=>$this->getPassword(),
                                                        		            "sendermobile"=>$mobile_no,
                                                        		            "bene_id"=>$beneficiaryid,
                                                        		            "amount"=>$amount,
                                                        		            "mode"=>$mode,
                                                        		            "order_id"=>$insert_id
                                                        		    );
                                                        		
                                                        		$ch = curl_init();
                                                        		curl_setopt($ch, CURLOPT_HEADER, false);
                                                        		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                                                        		curl_setopt($ch, CURLINFO_HEADER_OUT, 1);
                                                        		curl_setopt($ch, CURLOPT_BINARYTRANSFER, 1);
                                                        		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                                                        			'Accept: application/json',
                                                        			'Authkey: '.$this->getdeveloper_key()
                                                        		));
                                                        		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                                                        		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                                                        		curl_setopt($ch, CURLOPT_POST,1);
                                                        		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($req));
                                                        		curl_setopt($ch, CURLOPT_URL, $url);
                                                        		$buffer = $response = $buffer = curl_exec($ch);
                                                        		curl_close($ch);

                    
                    												$json_obj = json_decode($buffer);
                    												/*
                    												"data"=>array(
            																							"tid"=>$insert_id,
            																							"ref_no"=>$insert_id,
            																							"opr_id"=>$rrn,
            																							"name"=>$extra_info->beneficiaryName,																								"balance"=>"",
            																							"amount"=>$amount,
            
            																						)
                    												*/
                    													if(isset($json_obj->message) and isset($json_obj->status) and isset($json_obj->statuscode) )
                    													{
                    															$message = $json_obj->message;
                    															$status = $json_obj->status;
                    															$statuscode = $json_obj->statuscode;
                    															
                    															
                    
                    															if($statuscode == "TXN")
                    															{
                    															    
                    																$data = $json_obj->data;
                    																$tid = trim((string)$data->tid);
                    																$bank_ref_num = trim((string)$data->opr_id);
                    																$recipient_name = trim((string)$data->name);
                    
                                                                                   
                    																	$data = array(
                    																				'RESP_statuscode' => "TXN",
                    																				'RESP_status' => $message,
                    																				'RESP_ipay_id' => $tid,
                    																				'RESP_ref_no' => $tid,
                    																				'RESP_opr_id' => $bank_ref_num,
                    																				'RESP_name' => $recipient_name,
                    																				'Status'=>'SUCCESS',
                    																				'edit_date'=>$this->common->getDate()
                    																		);
                    
                    																		$this->db->where('Id', $insert_id);
                    																		$this->db->update('mt3_transfer', $data);
                    																		
                    																		$resp_arr = array(
                    																							"message"=>$message,
                    																							"status"=>0,
                    																							"data"=>array(
                    																								"tid"=>$tid,
                    																								"ref_no"=>$tid,
                    																								"opr_id"=>$bank_ref_num,
                    																								"name"=>$recipient_name,
                    																								"balance"=>0,
                    																								"amount"=>$amount,
                    
                    																							)
                    																						);
                    																		$json_resp =  json_encode($resp_arr);
                    
                    															}
                    															else if($statuscode == "TUP")
                    															{
                    															   
                                                                                   
                    																	$data = array(
                    																				'RESP_statuscode' => "TUP",
                    																				'RESP_status' => $message,
                    																				'edit_date'=>$this->common->getDate()
                    																		);
                    
                    																		$this->db->where('Id', $insert_id);
                    																		$this->db->update('mt3_transfer', $data);
                    																		
                    																		$resp_arr = array(
                    																							"message"=>$message,
                    																							"status"=>0,
                    																							"statuscode"=>$statuscode,
                    																						);
                    																	    $json_resp =  json_encode($resp_arr);
                    
                    															}
                    															else if($statuscode == "ERR")
                    															{
                    															    if($message ==  "You Do Not have Sufficient Balance.")
                    															    {
                    															        $message = "Internal Server Error";
                    															    }
                    																	
                    																	if($status == "1")
                    																	{
                    																		$this->PAYMENT_CREDIT_ENTRY($user_id,$insert_id,$transaction_type,$dr_amount,$Description,$sub_txn_type,$remark,$Charge_Amount);	
                    																	}
                    																	
                    
                    																	$data = array(
                    																			'RESP_statuscode' => $statuscode,
                    																			'RESP_status' => $message,
                    																			'Status'=>'FAILURE',
                    																			'edit_date'=>$this->common->getDate()
                    																	);
                    
                    																	$this->db->where('Id', $insert_id);
                    																	$this->db->update('mt3_transfer', $data);
                    																	$resp_arr = array(
                    																							"message"=>$message,
                    																							"status"=>1,
                    																							"statuscode"=>$statuscode,
                    																						);
                    																	$json_resp =  json_encode($resp_arr);
                    															}
                    
                    
                    													}
                    												
                    													else
                    													{ 
                    														//check status befor refund
                    														//$this->PAYMENT_CREDIT_ENTRY($user_id,$insert_id,$transaction_type,$dr_amount,$Description,$sub_txn_type,$remark,$Charge_Amount);
                    														$data = array(
                    																			'RESP_statuscode' => "UNK",
                    																			'RESP_status' => "Unknown Response or No Response",
                    																			'edit_date'=>$this->common->getDate()
                    																	);
                    
                    																	$this->db->where('Id', $insert_id);
                    																	$this->db->update('mt3_transfer', $data);
                    														$resp_arr = array(
                    																"message"=>"Internal Server Error, Please Try Later",
                    																"status"=>10,
                    																"statuscode"=>"UNK",
                    															);
                    														$json_resp =  json_encode($resp_arr);
                    													}
                												
                											}
                											else
                											{
                											    	$data = array(
                																			'RESP_statuscode' => "ERR",
                																			'RESP_status' => "PAYMENT FAILURE",
                																			'tx_status'=>"1",
                																			'Status'=>'FAILURE',
                																			"row_lock"=>"LOCKED",
                																			'edit_date'=>$this->common->getDate()
                																	);
                
                																	$this->db->where('Id', $insert_id);
                																	$this->db->update('mt3_transfer', $data);
                												$resp_arr = array(
                													"message"=>"Payment Failure",
                													"status"=>1,
                													"statuscode"=>"ERR",
                												);
                												$json_resp =  json_encode($resp_arr);	
                											}		
                										}
                										else
                										{
                											$resp_arr = array(
                												"message"=>"Internal Server Error",
                												"status"=>1,
                												"statuscode"=>"ERR",
                											);
                											$json_resp =  json_encode($resp_arr);	
                										}
                                            }
                                            else
                                            {
                                                $resp_arr = array(
        											"message"=>"Monthly Transfer Limit Exceeded For This Account Number",
        											"status"=>1,
        											"statuscode"=>"ERR",
        										);
        									$json_resp =  json_encode($resp_arr);
                                            }
        
        
        								
        									
        								}
        								else
        								{
        									$resp_arr = array(
        											"message"=>"Invalid Beneficiary Id",
        											"status"=>1,
        											"statuscode"=>"RNF",
        										);
        									$json_resp =  json_encode($resp_arr);
        								}
        							
        						}
        						else
        						{
        							$resp_arr = array(
        									"message"=>"InSufficient Balance",
        									"status"=>1,
        									"statuscode"=>"ISB",
        								);
        							$json_resp =  json_encode($resp_arr);
        						}
        					}
        					else
        					{
        						$resp_arr = array(
        									"message"=>"Your Account Deactivated By Admin",
        									"status"=>1,
        									"statuscode"=>"UNK",
        								);
        						$json_resp =  json_encode($resp_arr);
        					}
        						
        				}
        				else
        				{
        					$resp_arr = array(
        									"message"=>"Invalid Access",
        									"status"=>1,
        									"statuscode"=>"UNK",
        								);
        					$json_resp =  json_encode($resp_arr);
        				}
        			}
        			else
        			{
        				$resp_arr = array(
        									"message"=>"Userinfo Missing",
        									"status"=>4,
        									"statuscode"=>"UNK",
        								);
        				$json_resp =  json_encode($resp_arr);
        			}
        			
        		}
        		else
        		{
        			$resp_arr = array(
        									"message"=>"Userinfo Missing",
        									"status"=>4,
        									"statuscode"=>"UNK",
        								);
        			$json_resp =  json_encode($resp_arr);
        			
        		}    
    		}   
		}
		$this->loging("mastermoneytransfer","1>>>".$url."?".json_encode($req),$buffer,$json_resp,$userinfo->row(0)->username);
		return $json_resp;
		
	}
	
	
	
	public function transfer_status($dmr_id)
	{
	   
		    $resultdmr = $this->db->query("SELECT a.API,a.unique_id,a.Id,a.add_date,a.user_id,a.DId,a.MdId,a.Charge_type,a.charge_value,a.Charge_Amount,a.dist_charge_amount,a.RemiterMobile,
a.debit_amount,a.credit_amount,a.remitter_id,a.BeneficiaryId,a.AccountNumber,
a.IFSC,a.Amount,a.Status,a.debited, a.ewallet_id,a.balance,a.remark,a.mode,
a.RESP_statuscode,a.RESP_status,a.RESP_ipay_id,a.RESP_ref_no,a.RESP_opr_id,a.RESP_name,a.row_lock,
b.businessname,b.username


FROM `mt3_transfer` a
left join tblusers b on a.user_id = b.user_id
left join tblusers parent on b.parentid = parent.user_id
 where a.Id = ?",array($dmr_id));
		
		
		
		if($resultdmr->num_rows() == 1)
		{
			$Status = $resultdmr->row(0)->Status;
			$user_id = $resultdmr->row(0)->user_id;
			$DId = $resultdmr->row(0)->DId;
			$API = $resultdmr->row(0)->API;
			$RESP_status = $resultdmr->row(0)->RESP_status;
			$Amount = $amount =  $resultdmr->row(0)->Amount;
			$debit_amount = $resultdmr->row(0)->debit_amount;
			if($debit_amount < $Amount)
			{
			    echo "some problem found";exit;
			}
			
			$benificiary_account_no = $resultdmr->row(0)->AccountNumber;
			$benificiary_ifsc = $resultdmr->row(0)->IFSC;
			$Charge_Amount = $resultdmr->row(0)->Charge_Amount;
			$remittermobile = $resultdmr->row(0)->RemiterMobile;
			
			$dist_charge_amount= $resultdmr->row(0)->dist_charge_amount;
			$Description = "DMR ".$remittermobile." Acc No : ".$benificiary_account_no;
			$sub_txn_type = "REMITTANCE";
			$remark = "Money Remittance";
			if($API == "MASTERMONEY")
			{
			
				if($Status == "PENDING" )
				{
				    
				    
				    
				    
					$url = "http://primepay.co.in/ws/CheckStatus?username=".$this->getUsername()."&password=".$this->getPassword()."&order_id=".$dmr_id;	
			        
	
					$ch = curl_init();
					curl_setopt($ch, CURLOPT_HEADER, false);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
					curl_setopt($ch, CURLINFO_HEADER_OUT, 1);
					curl_setopt($ch, CURLOPT_BINARYTRANSFER, 1);
					curl_setopt($ch, CURLOPT_HTTPHEADER, array(
						'Accept: application/json',
						'developer_key: '.$this->getdeveloper_key()
					));
					curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
					curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					curl_setopt($ch, CURLOPT_URL, $url);
					$response = curl_exec($ch);
					curl_close($ch);
				   //echo $response;exit;
				
					$this->loging("mmtransfer_status",$url,$response,"","");
					$json_obj = json_decode($response);
					
				    if(isset($json_obj->message) and isset($json_obj->status) and isset($json_obj->statuscode) )
					{
							$message = $json_obj->message;
							$status = $json_obj->status;
							$statuscode = $json_obj->statuscode;
							
						

							if($statuscode == "TXN")
							{
								$data = $json_obj->data;
								$tid = trim((string)$data->tid);
								$bank_ref_num = trim((string)$data->opr_id);
								$recipient_name = trim((string)$data->name);

                             
									$data = array(
												'RESP_statuscode' => "TXN",
            									'RESP_status' => $message,
												'RESP_ipay_id' => $tid,
												'RESP_ref_no' => $tid,
												'RESP_opr_id' => $bank_ref_num,
												'RESP_name' => $recipient_name,
												'Status'=>'SUCCESS',
												'edit_date'=>$this->common->getDate()
												);
            
									$this->db->where('Id', $dmr_id);
									$this->db->update('mt3_transfer', $data);
									
									$resp_arr = array(
														"message"=>$message,
														"status"=>0,
														"data"=>array(
															"tid"=>$tid,
															"ref_no"=>$tid,
															"opr_id"=>$bank_ref_num,
															"name"=>$recipient_name,
															"balance"=>0,
															"amount"=>$amount,

														)
													);
									$json_resp =  json_encode($resp_arr);
									return $json_resp;
            
            				}
							else if($statuscode == "ERR")
							{
							   
							    if($status == "1")
								{
								   $transaction_type = "DMR";
        							$sub_txn_type = "REMITTANCE";
        						    $remark = "Money Remittance";
        						    $transaction_type = "DMR";
        						    $userinfo = $this->db->query("select * from tblusers where user_id = ?",array($user_id));
									//$this->PAYMENT_CREDIT_ENTRY($user_id,$dmr_id,$transaction_type,$Amount,$Description,$sub_txn_type,$remark,$Charge_Amount,$userinfo);	
								}
									

									$data = array(
											'RESP_statuscode' => $statuscode,
											'RESP_status' => $message,
											'Status'=>'FAILURE',
											'edit_date'=>$this->common->getDate()
									);

									//$this->db->where('Id', $dmr_id);
									//$this->db->update('mt3_transfer', $data);
									$resp_arr = array(
															"message"=>$message,
															"status"=>1,
															"statuscode"=>$statuscode,
														);
									$json_resp =  json_encode($resp_arr);
									return $json_resp;
							}
            
            
            		}
            		else
            		{
            		    return $response;
            		}
				}
				else
				{
				    return $Status;
				}
			}
			else
			{
			    return $API;
			}
			
			
		}
		
	}	
	
	
	
	
	
	
	
	
	
	
	
	
	
	public function remitter_registration($mobile_no,$name,$lastname,$pincode,$otp,$userinfo)
	{
		
		if($userinfo != NULL)
		{
			if($userinfo->num_rows() == 1)
			{
			   
				
				$user_id = $userinfo->row(0)->user_id;
				$usertype_name = $userinfo->row(0)->usertype_name;
				$user_status = $userinfo->row(0)->status;
				if($usertype_name == "Agent")
				{
					if($user_status == '1')
					{
					    if(strlen($pincode != 10))
					    {
					        $rsltuserinfo = $this->db->query("select pincode from tblusers_info where user_id = ?",array($user_id));
					        if($rsltuserinfo->num_rows() == 1)
					        {
					            $pincode = $rsltuserinfo->row(0)->pincode;
					            if(strlen($pincode != 10))
					            {
					                $pincode = "380006";
					            }
					        }
					    }
						if($lastname == "")
						{
						    $lastname  = $name;
						}
						
							$insert_id = $this->db->insert_id();
							$url = 'http://primepay.co.in/ws/Sender_registration?username=1234567890&password=123456&sendermobile='.$mobile_no.'&Name='.urlencode($name).'&Lastname='.urlencode($lastname).'&Pincode='.$pincode.'&OTP='.$otp;
                            $developer_key= $this->getdeveloper_key();

    						
    						$ch = curl_init();
    						curl_setopt($ch, CURLOPT_HEADER, false);
    						curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    						curl_setopt($ch, CURLINFO_HEADER_OUT, 1);
    						curl_setopt($ch, CURLOPT_BINARYTRANSFER, 1);
    						curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    							'Accept: application/json',
    							'developer_key: '.$this->getdeveloper_key()
    						));
    						curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
    						curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    						curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    						curl_setopt($ch, CURLOPT_URL, $url);
    						$buffer = $response = curl_exec($ch);
    						curl_close($ch);
							$json_obj = json_decode($buffer);
							
						/*{"response_status_id":0,"data":{"initiator_id":"","recipient_mobile":"","recipient_id_type":"acc_bankcode","customer_id":"8238232303","pipes":{},"recipient_id":40699557},"response_type_id":43,"message":"Success!Please transact using Recipientid","status":0}*/
							
							if(isset($json_obj->message) and isset($json_obj->status) and isset($json_obj->statuscode) )
							{
								    $message = trim((string)$json_obj->message);
									$status = trim((string)$json_obj->status);
									$statuscode = trim((string)$json_obj->statuscode);
								
								
									if($status == "0")
									{
										
									    $resp_arr = array(
																"message"=>$message,
																"status"=>0,
																"statuscode"=>$statuscode,
															);
										$json_resp =  json_encode($resp_arr);
									}
    								else
    								{
    									   
    										$resp_arr = array(
    																"message"=>$message,
    																"status"=>$status,
    																"statuscode"=>$statuscode,
    															);
    										$json_resp =  json_encode($resp_arr);
    								}
									
									
							}
							else
							{
								$resp_arr = array(
										"message"=>"Internal Server Error, Please Try Later",
										"status"=>10,
										"statuscode"=>"UNK",
									);
								$json_resp =  json_encode($resp_arr);
							}
							
						
					}
					else
					{
						$resp_arr = array(
									"message"=>"Your Account Deactivated By Admin",
									"status"=>5,
									"statuscode"=>"UNK",
								);
						$json_resp =  json_encode($resp_arr);
					}
						
				}
				else
				{
					$resp_arr = array(
									"message"=>"Invalid Access",
									"status"=>5,
									"statuscode"=>"UNK",
								);
					$json_resp =  json_encode($resp_arr);
				}
			}
			else
			{
				$resp_arr = array(
									"message"=>"Userinfo Missing",
									"status"=>4,
									"statuscode"=>"UNK",
								);
				$json_resp =  json_encode($resp_arr);
			}
			
		}
		else
		{
			$resp_arr = array(
									"message"=>"Userinfo Missing",
									"status"=>4,
									"statuscode"=>"UNK",
								);
			$json_resp =  json_encode($resp_arr);
			
		}
		
		$this->loging("mastermoney_customer_registration",$url,$buffer,$json_resp,$userinfo->row(0)->username);
		return $json_resp;
		
	}
	public function remitter_resend_otp($mobile_no,$userinfo)
	{
		
		if($userinfo != NULL)
		{
			if($userinfo->num_rows() == 1)
			{
			   
				
				$user_id = $userinfo->row(0)->user_id;
				$usertype_name = $userinfo->row(0)->usertype_name;
				$user_status = $userinfo->row(0)->status;
				
				if($usertype_name == "Agent")
				{
					if($user_status == '1')
					{
						$authenticator_key ='11a5d10f-58b2-449f-9377-52d1cd935a7d';
						$encodedKey = base64_encode($authenticator_key);
						$secret_key_timestamp = "".round(microtime(true) * 1000);

						$signature = hash_hmac('SHA256', $secret_key_timestamp, $encodedKey, true);
						$secret_key = base64_encode($signature);
						
						
							$url ="http://www.primepay.co.in/ws/Sender_registration/getotp?username=1234567890&password=123456&sendermobile=".$mobile_no;
							$ch = curl_init();
    						curl_setopt($ch, CURLOPT_HEADER, false);
    						curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    						curl_setopt($ch, CURLINFO_HEADER_OUT, 1);
    						curl_setopt($ch, CURLOPT_BINARYTRANSFER, 1);
    						curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    							'Accept: application/json',
    							'developer_key: '.$this->getdeveloper_key()
    						));
    						curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
    						curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    						curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    						curl_setopt($ch, CURLOPT_URL, $url);
    						$buffer = $response = curl_exec($ch);
    						curl_close($ch);
							$json_obj = json_decode($buffer);
							
							if(isset($json_obj->message) and isset($json_obj->status))
							{
								
									$message = trim((string)$json_obj->message);
									$status = trim((string)$json_obj->status);
									//echo $status."  ".$response_type_id;exit;
									
										$resp_arr = array(
																	"message"=>$message,
																	"status"=>$status,
																);
										$json_resp =  json_encode($resp_arr);
									
							}
							else
							{
								$resp_arr = array(
										"message"=>"Internal Server Error, Please Try Later",
										"status"=>10,
										"statuscode"=>"UNK",
									);
								$json_resp =  json_encode($resp_arr);
							}
					}
					else
					{
						$resp_arr = array(
									"message"=>"Your Account Deactivated By Admin",
									"status"=>5,
									"statuscode"=>"UNK",
								);
						$json_resp =  json_encode($resp_arr);
					}
						
				}
				else
				{
					$resp_arr = array(
									"message"=>"Invalid Access",
									"status"=>5,
									"statuscode"=>"UNK",
								);
					$json_resp =  json_encode($resp_arr);
				}
			}
			else
			{
				$resp_arr = array(
									"message"=>"Userinfo Missing",
									"status"=>4,
									"statuscode"=>"UNK",
								);
				$json_resp =  json_encode($resp_arr);
			}
			
		}
		else
		{
			$resp_arr = array(
									"message"=>"Userinfo Missing",
									"status"=>4,
									"statuscode"=>"UNK",
								);
			$json_resp =  json_encode($resp_arr);
			
		}
		
		$this->loging("paytmresendOtp",$url,$buffer,$json_resp,$userinfo->row(0)->username);
		return $json_resp;
		
	}
	
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////                  ///////////////////////////////////////////////////
//////////////////////////////////////////    MASTERMONEY FOR NEW SENDER   ////////////////////////////////////////////////////
/////////////////////////////////////////                  /////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////	
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	public function remitter_registration2($mobile_no,$name,$lastname,$pincode,$userinfo)
	{
		
		if($userinfo != NULL)
		{
			if($userinfo->num_rows() == 1)
			{
			   
				error_reporting(-1);
				ini_set('display_errors',1);
				$this->db->db_debug = TRUE;
				$user_id = $userinfo->row(0)->user_id;
				$usertype_name = $userinfo->row(0)->usertype_name;
				$user_status = $userinfo->row(0)->status;
				if($usertype_name == "Agent")
				{
					if($user_status == '1')
					{
					    $insert_rslt = $this->db->query("insert into mt3_remitter_registration(add_date,ipaddress,mobile,name,lastname,pincode,API) values(?,?,?,?,?,?,?)",
					                                    array($this->common->getDate(),$this->common->getRealIpAddr(),$mobile_no,$name,$lastname,$pincode,'MASTERMONEY'));
					   if($insert_rslt == true)
					   {
					        $insert_id = $this->db->insert_id();
					        
					        
					        
					        $url = 'https://www.primepay.co.in/webapi/GetSenderRegisterOtp';
                    		$req = array(
                    		            "username"=>$this->getUsername(),
                    		            "password"=>$this->getPassword(),
                    		            "sendermobile"=>$mobile_no,
                    		    );
                    		
                    		$ch = curl_init();
                    		curl_setopt($ch, CURLOPT_HEADER, false);
                    		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    		curl_setopt($ch, CURLINFO_HEADER_OUT, 1);
                    		curl_setopt($ch, CURLOPT_BINARYTRANSFER, 1);
                    		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                    			'Accept: application/json',
                    			'Authkey: '.$this->getdeveloper_key()
                    		));
                    		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                    		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    		curl_setopt($ch, CURLOPT_POST,1);
                    		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($req));
                    		curl_setopt($ch, CURLOPT_URL, $url);
                    		$buffer = $response = $buffer = curl_exec($ch);
                    		curl_close($ch);
							//echo "resp : ".$buffer;exit;
							
                        	$json_obj = json_decode($buffer);
							
							if(isset($json_obj->message) and isset($json_obj->status))
							{
								
									$message = trim((string)$json_obj->message);
									$status = trim((string)$json_obj->status);
									
										$resp_arr = array(
																	"message"=>$message,
																	"status"=>$status,
																	"statuscode"=>"TXN",
																	"insert_id"=>$insert_id
																);
										$json_resp =  json_encode($resp_arr);
									
							}
							else
							{
								$resp_arr = array(
										"message"=>"Internal Server Error, Please Try Later",
										"status"=>10,
										"statuscode"=>"UNK",
									);
								$json_resp =  json_encode($resp_arr);
							}
					   }	
					}
					else
					{
						$resp_arr = array(
									"message"=>"Your Account Deactivated By Admin",
									"status"=>5,
									"statuscode"=>"UNK",
								);
						$json_resp =  json_encode($resp_arr);
					}
						
				}
				else
				{
					$resp_arr = array(
									"message"=>"Invalid Access",
									"status"=>5,
									"statuscode"=>"UNK",
								);
					$json_resp =  json_encode($resp_arr);
				}
			}
			else
			{
				$resp_arr = array(
									"message"=>"Userinfo Missing",
									"status"=>4,
									"statuscode"=>"UNK",
								);
				$json_resp =  json_encode($resp_arr);
			}
			
		}
		else
		{
			$resp_arr = array(
									"message"=>"Userinfo Missing",
									"status"=>4,
									"statuscode"=>"UNK",
								);
			$json_resp =  json_encode($resp_arr);
			
		}
		
		$this->loging("mastermoney_GetSenderRegisterOtp",$url." >> ".json_encode($req),$buffer,$json_resp,$userinfo->row(0)->username);
		return $json_resp;
		
	}
	public function remitter_resend_otp2($mobile_no,$otp,$userinfo)
	{
		
		if($userinfo != NULL)
		{
			if($userinfo->num_rows() == 1)
			{
			   
				
				$user_id = $userinfo->row(0)->user_id;
				$usertype_name = $userinfo->row(0)->usertype_name;
				$user_status = $userinfo->row(0)->status;
				
				if($usertype_name == "Agent")
				{
					if($user_status == '1')
					{
					    $rsltsender = $this->db->query("select * from mt3_remitter_registration where mobile = ?  order by Id desc limit 1",array($mobile_no));
					    if($rsltsender->num_rows() == 1)
					    {
					        
					        $pincode = $rsltsender->row(0)->pincode;
					        if(strlen($pincode != 6))
					        {
					            $pincode = 380001;
					        }
					        
					        $url = 'https://www.primepay.co.in/webapi/SenderRegistration';
                    		$req = array(
                    		            "username"=>$this->getUsername(),
                    		            "password"=>$this->getPassword(),
                    		            "sendermobile"=>$mobile_no,
                    		            "firstname"=>urlencode($rsltsender->row(0)->name),
                    		            "lastname"=>urlencode($rsltsender->row(0)->lastname),
                    		            "pincode"=>$pincode,
                    		            "otp"=>$otp,
                    		    );
                    	   // print_r($req);exit;
                    		$ch = curl_init();
                    		curl_setopt($ch, CURLOPT_HEADER, false);
                    		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    		curl_setopt($ch, CURLINFO_HEADER_OUT, 1);
                    		curl_setopt($ch, CURLOPT_BINARYTRANSFER, 1);
                    		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                    			'Accept: application/json',
                    			'Authkey: '.$this->getdeveloper_key()
                    		));
                    		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                    		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    		curl_setopt($ch, CURLOPT_POST,1);
                    		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($req));
                    		curl_setopt($ch, CURLOPT_URL, $url);
                    		$buffer = $response = $buffer = curl_exec($ch);
                    		curl_close($ch);
                        	$json_obj = json_decode($buffer);
                        	echo $buffer;exit;
    							
    						/*{"response_status_id":0,"data":{"initiator_id":"","recipient_mobile":"","recipient_id_type":"acc_bankcode","customer_id":"8238232303","pipes":{},"recipient_id":40699557},"response_type_id":43,"message":"Success!Please transact using Recipientid","status":0}*/
    							
    							if(isset($json_obj->message) and isset($json_obj->status) and isset($json_obj->statuscode) )
    							{
    								    $message = trim((string)$json_obj->message);
    									$status = trim((string)$json_obj->status);
    									$statuscode = trim((string)$json_obj->statuscode);
    								
    								
    									if($status == "0")
    									{
    										$this->db->query("update mt3_remitter_registration set status = 'SUCCESS' where Id = ? ",array($rsltsender->row(0)->Id));
    									    $resp_arr = array(
    																"message"=>$message,
    																"status"=>0,
    																"statuscode"=>$statuscode,
    															);
    										$json_resp =  json_encode($resp_arr);
    									}
        								else
        								{
        									   	$this->db->query("update mt3_remitter_registration set status = 'FAILURE' where Id = ? ",array($rsltsender->row(0)->Id));
        										$resp_arr = array(
        																"message"=>$message,
        																"status"=>$status,
        																"statuscode"=>$statuscode,
        															);
        										$json_resp =  json_encode($resp_arr);
        								}
    									
    									
    							}
    							else
    							{
    								$resp_arr = array(
    										"message"=>"Internal Server Error, Please Try Later",
    										"status"=>10,
    										"statuscode"=>"UNK",
    									);
    								$json_resp =  json_encode($resp_arr);
    							}   
					    }	
					}
					else
					{
						$resp_arr = array(
									"message"=>"Your Account Deactivated By Admin",
									"status"=>5,
									"statuscode"=>"UNK",
								);
						$json_resp =  json_encode($resp_arr);
					}
						
				}
				else
				{
					$resp_arr = array(
									"message"=>"Invalid Access",
									"status"=>5,
									"statuscode"=>"UNK",
								);
					$json_resp =  json_encode($resp_arr);
				}
			}
			else
			{
				$resp_arr = array(
									"message"=>"Userinfo Missing",
									"status"=>4,
									"statuscode"=>"UNK",
								);
				$json_resp =  json_encode($resp_arr);
			}
			
		}
		else
		{
			$resp_arr = array(
									"message"=>"Userinfo Missing",
									"status"=>4,
									"statuscode"=>"UNK",
								);
			$json_resp =  json_encode($resp_arr);
			
		}
		
		$this->loging("mastermoney_SenderRegistration",$url."?".json_encode($req),$buffer,$json_resp,$userinfo->row(0)->username);
		return $json_resp;
		
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	public function getTransactionChargeInfo($userinfo,$TransactionAmount)
	{
			return 5.00;
	}
	
	
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////                  ///////////////////////////////////////////////////
//////////////////////////////////////////    L O G I N G   ////////////////////////////////////////////////////
/////////////////////////////////////////                  /////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////	
////////////////////////////////////////////////////////////////////////////////////////////////////////////////	
	
	private function loging($methiod,$request,$response,$json_resp,$username)
	{
		//return "";
		//echo $methiod." <> ".$request." <> ".$response." <> ".$json_resp." <> ".$username;exit;
		$log  = "User: ".$_SERVER['REMOTE_ADDR'].' - '.date("F j, Y, g:i a").PHP_EOL.
		"username: ".$username.PHP_EOL.
		"Request: ".$request.PHP_EOL.
        "Response: ".$response.PHP_EOL.
		"Downline Response: ".$json_resp.PHP_EOL.
        "Method: ".$methiod.PHP_EOL.
        "-------------------------".PHP_EOL;
		
		
		//echo $log;exit;
		$filename ='inlogs/'.$methiod.'log_'.date("j.n.Y").'.txt';
		if (!file_exists($filename)) 
		{
			file_put_contents($filename, '');
		} 
		
//Save string to log, use FILE_APPEND to append.
		file_put_contents('inlogs/'.$methiod.'log_'.date("j.n.Y").'.txt', $log, FILE_APPEND);
		
	}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////	
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//*************************************** L O G I N G    E N D   H E R E *************************************//
////////////////////////////////////////////////////////////////////////////////////////////////////////////////	
////////////////////////////////////////////////////////////////////////////////////////////////////////////////





////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////                                                        ////////////////////////////////
///////////////////////    P A Y M E N T   M E T H O D   S T A R T   H E R E   /////////////////////////////////
//////////////////////                                                        //////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////	
////////////////////////////////////////////////////////////////////////////////////////////////////////////////	
	

	public function PAYMENT_DEBIT_ENTRY($user_id,$transaction_id,$transaction_type,$dr_amount,$Description,$sub_txn_type,$remark,$ChargeAmount,$userinfo)
	{

		$this->load->library("common");
		$add_date = $this->common->getDate();
		$date = $this->common->getMySqlDate();
		$ip = $this->common->getRealIpAddr();
	    $this->db->query("SET TRANSACTION ISOLATION LEVEL SERIALIZABLE;");
		$this->db->query("BEGIN;");
		$result_oldbalance = $this->db->query("SELECT balance FROM `tblewalle` where user_id = ? order by Id desc limit 1",array($user_id));
		if($result_oldbalance->num_rows() > 0)
		{
			$old_balance =  $result_oldbalance->row(0)->balance;
		}
		else 
		{
        	$old_balance =  0;
		}
		$this->db->query("COMMIT;");
		
	
		if($old_balance < $dr_amount)
		{
		    return false;
		}
		else
		{
		    $current_balance = $old_balance - $dr_amount;
    	//	$tds = 0.00;
    		$stax = 0.00;
    		if($transaction_type == "DMR")
    		{
    			$str_query = "insert into  tblewalle(user_id,dmr_id,transaction_type,debit_amount,balance,description,add_date,ipaddress,remark)
    
    			values(?,?,?,?,?,?,?,?,?)";
    			$reslut = $this->db->query($str_query,array($user_id,$transaction_id,$transaction_type,$dr_amount,$current_balance,$Description,$add_date,$ip,$remark));
    			if($reslut == true)
    			{
    					$ewallet_id = $this->db->insert_id();
    					if($ewallet_id > 10)
    					{
    						if($sub_txn_type == "Account_Validation")
    						{
    									$rslt_updtrec = $this->db->query("update mt3_account_validate set debited='yes',reverted='no',balance=CONCAT_WS(',',balance,?), ewallet_id = CONCAT_WS(',',ewallet_id,?),debit_amount = ? where Id = ?",array($current_balance,$ewallet_id,$dr_amount,$transaction_id));
    									return true;
    						}
    						else if($sub_txn_type == "REMITTANCE")
    						{
    						    
    						    //ccf deduction code
								$current_balance2 = $current_balance - $ChargeAmount;
								$remark = "Transaction Charge";
								$str_query_charge = "insert into  tblewalle(user_id,dmr_id,transaction_type,debit_amount,balance,description,add_date,ipaddress,remark)

								values(?,?,?,?,?,?,?,?,?)";
								$reslut2 = $this->db->query($str_query_charge,array($user_id,$transaction_id,$transaction_type,$ChargeAmount,$current_balance2,$Description,$add_date,$ip,$remark));
								if($reslut2 == true)
								{
									$totaldebit_amount = $dr_amount + $ChargeAmount;
									$ewallet_id2 = $ewallet_id.",".$this->db->insert_id();
									$rslt_updtrec = $this->db->query("update mt3_transfer set debited='yes',reverted='no',balance=CONCAT_WS(',',balance,?), ewallet_id = CONCAT_WS(',',ewallet_id,?),debit_amount = ? where Id = ?",array($current_balance2,$ewallet_id2,$totaldebit_amount,$transaction_id));	
									return true;
								}
								else
								{
									$rslt_updtrec = $this->db->query("update mt3_transfer set debited='yes',reverted='no',balance=CONCAT_WS(',',balance,?), ewallet_id = CONCAT_WS(',',ewallet_id,?),debit_amount = ? where Id = ?",array($current_balance,$ewallet_id,$dr_amount,$transaction_id));	
									return false;
								}
    									
    									
    									return false;
    						}
    						
    					}
    					else
    					{
    							return false;
    					}
    			}
    			else
    			{
    				return false;
    			}
    			
    		}
    		else if($transaction_type == "BILL")
			{
				$str_query = "insert into  tblewalle(user_id,recharge_id,transaction_type,debit_amount,balance,description,add_date,ipaddress)

				values(?,?,?,?,?,?,?,?)";
				$reslut = $this->db->query($str_query,array($user_id,$transaction_id,$transaction_type,$dr_amount,$current_balance,$Description,$add_date,$ip));
				
				if($reslut == true)
				{
						$ewallet_id = $this->db->insert_id();
					
						$rslt_updtrec = $this->db->query("update tblbills set debited='yes',reverted='no',balance=CONCAT_WS(',',balance,?), ewallet_id = CONCAT_WS(',',ewallet_id,?),debit_amount = ? where Id = ?",array($current_balance,$ewallet_id,$dr_amount,$transaction_id));
					return true;
				}
				else
				{
					return false;
				}

			}
    		else
    		{
    				return false;
    		}
		}
			
	}
	
	
	public function recharge_transaction_validate($userinfo,$spkey,$company_id,$Amount,$Mobile,$CustomerMobile,$option1 = "")
	{
	    
		$ipaddress = $this->common->getRealIpAddr();
		$payment_mode = "CASH";
		$payment_channel = "AGT";
		$url= '';
		$buffer = '';
		
		if($spkey == "TYE")
		{
		    $option1 = "Ahmedabad";
		}
		if($spkey == "TWE")
		{
		    $option1 = "Surat";
		}
		if($userinfo != NULL)
		{
			if($userinfo->num_rows() == 1)
			{
				
				$user_id = $userinfo->row(0)->user_id;
				$usertype_name = $userinfo->row(0)->usertype_name;
				$user_status = $userinfo->row(0)->status;
				if($usertype_name == "Agent" or $usertype_name == "APIUSER")
				{
					if($user_status == '1')
					{
						
							$insert_rslt = $this->db->query("insert into tblbillcheck(add_date,ipaddress,user_id,mobile,customer_mobile,company_id) values(?,?,?,?,?,?)",array($this->common->getDate(),$ipaddress,$user_id,$Mobile,$CustomerMobile,$company_id));
							if($insert_rslt == true)
							{
								$insert_id = $this->db->insert_id();
								$transaction_type = "BILL";
								$dr_amount = $Amount;
								$Description = "Service No.  ".$Mobile." Bill Amount : ".$Amount;
								$sub_txn_type = "BILL";
								$remark = "Bill PAYMENT";
								$Charge_Amount = 0.00;
								
								
									$headers = array();
									$headers[] = 'Accept: application/json';
									$headers[] = 'Content-Type: application/json';
									
								
									$url = 'https://primepay.co.in/webapi/getBillAmount?username=9428640000&pwd=323908&mcode='.$spkey.'&serviceno='.$Mobile.'&customer_mobile='.$CustomerMobile.'&option1='.$option1.'&option2=';
								   // var_dump($url);exit;
									

									$ch = curl_init();
									curl_setopt($ch,CURLOPT_URL,$url);
									curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
									//curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
									//curl_setopt($ch, CURLOPT_POST,0);
									curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
									curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
									$buffer = curl_exec($ch);
									curl_close($ch);
									echo $buffer;exit;
									/*
									{"statuscode":"TXN","status":"0","message":"BILL FETCH SUCCESSFUL",
									"particulars":
									{
									    "dueamount":16960,"duedate":"2020-01-07","customername":"MR. BRIJ KISHORE SHARMA",
									    "billnumber":"150895735","billdate":"2019-12-20",
									    "billperiod":"JANUARY","reference_id":492751
									    
									}
									    
									}
									*/
							
									$json_obj = json_decode($buffer);
								//print_r($json_obj);exit;
									if(isset($json_obj->statuscode) and isset($json_obj->status))
									{
											$statuscode = $json_obj->statuscode;
											$status = $json_obj->status;
											$message = $json_obj->message;
											if($statuscode == "TXN")
											{
												
												$particulars = $json_obj->particulars;
												
												
												/*if(isset($particulars->dueamount) and isset($particulars->duedate) and isset($particulars->customername) and isset($particulars->billnumber) and isset($particulars->billdate) and isset($particulars->billperiod))
												{
													$dueamount = $particulars->dueamount;
													$duedate = $particulars->duedate;
													$customername = $particulars->customername;
													$billnumber = $particulars->billnumber;
													$billdate = $particulars->billdate;
													$billperiod = $particulars->billperiod;
												}*/
													$resp_arr = array(
																			"message"=>"Bill Detail Get Successfully",
																			"status"=>0,
																			"statuscode"=>$statuscode,
																			"particulars" => array($particulars),
																			"ENCRDATA"=>$this->Ew2->encrypt($buffer)
																		);
													$json_resp =  json_encode($resp_arr);
											}
											else
											{
												

												
												$resp_arr = array(
																			"message"=>$message,
																			"status"=>1,
																			"statuscode"=>$statuscode,
																		);
													$json_resp =  json_encode($resp_arr);
											}

									}
								
							}
						
					}
					else
					{
						$resp_arr = array(
									"message"=>"Your Account Deactivated By Admin",
									"status"=>5,
									"statuscode"=>"UNK",
								);
						$json_resp =  json_encode($resp_arr);
					}
						
				}
				else
				{
					$resp_arr = array(
									"message"=>"Invalid Access",
									"status"=>5,
									"statuscode"=>"UNK",
								);
					$json_resp =  json_encode($resp_arr);
				}
			}
			else
			{
				$resp_arr = array(
									"message"=>"Userinfo Missing",
									"status"=>4,
									"statuscode"=>"UNK",
								);
				$json_resp =  json_encode($resp_arr);
			}
			
		}
		else
		{
			$resp_arr = array(
									"message"=>"Userinfo Missing",
									"status"=>4,
									"statuscode"=>"UNK",
								);
			$json_resp =  json_encode($resp_arr);
			
		}
		$this->loging("RECHARGE",$url,$buffer,$json_resp,$userinfo->row(0)->username);
		return $json_resp;
		
	}
	public function fetchbill($userinfo,$spkey,$company_id,$Mobile,$CustomerMobile,$option1 = "")
{
	//echo $Mobile."   ".$CustomerMobile;exit;
	$ipaddress = $this->common->getRealIpAddr();
	$payment_mode = "CASH";
	$payment_channel = "AGT";
	$url= '';
	$buffer = '';

	if($spkey == "TYE")
	{
		$option1  = "Ahmedabad";
	}
	if($spkey == "TZE")
	{
		$option1  = "Agra";
	}
	if($spkey == "TXE")
	{
		$option1  = "Bhiwandi";
	}
	if($spkey == "TWE")
	{
		$option1  = "Surat";
	}

	if($userinfo != NULL)
	{
		if($userinfo->num_rows() == 1)
		{
			
			$user_id = $userinfo->row(0)->user_id;
			$usertype_name = $userinfo->row(0)->usertype_name;
			$user_status = $userinfo->row(0)->status;
			if($usertype_name == "Agent" or $usertype_name == "APIUSER")
			{
				if($user_status == '1')
				{
					
						$insert_rslt = $this->db->query("insert into tblbillcheck(add_date,ipaddress,user_id,mobile,customer_mobile,company_id) values(?,?,?,?,?,?)",array($this->common->getDate(),$ipaddress,$user_id,$Mobile,$CustomerMobile,$company_id));
						if($insert_rslt == true)
						{
							$insert_id = $this->db->insert_id();
							$transaction_type = "BILL";
							$Description = "Service No.  ".$Mobile;
							$sub_txn_type = "BILL";
							$remark = "Bill PAYMENT";
							$Charge_Amount = 0.00;
							
							
								$headers = array();
								$headers[] = 'Accept: application/json';
								$headers[] = 'Content-Type: application/json';

								
								$url = "https://primepay.co.in/webapi/getBillAmount?username=".$this->getUsername()."&pwd=".$this->getPassword()."&mcode=".$spkey."&serviceno=".$Mobile."&customer_mobile=".$CustomerMobile."&option1=".$option1."&option2=";
							
								$ch = curl_init();
								curl_setopt($ch,CURLOPT_URL,$url);
								curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
								curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
								curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
								curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	
								$buffer = curl_exec($ch);
								curl_close($ch);
							$this->loging("MMBILL",$url,$buffer,"",$userinfo->row(0)->username);
								//str_replace("particulars", "data", $buffer);
								$json_resp =  $buffer;
								$json_obj = json_decode($buffer);
								/*

{"statuscode":"TXN","status":"0","message":"BILL FETCH SUCCESSFUL",
	"particulars":
	{
		"dueamount":64,
		"duedate":"",
		"customername":"NEHABEN DIPAKBHAI JOSHI",
		"billnumber":"",
		"billdate":"",
		"billperiod":"",
		"reference_id":493250
	}
}
								*/
								if(isset($json_obj->status) and isset($json_obj->statuscode) and isset($json_obj->message))
								{
									$status = trim($json_obj->status);
									$statuscode = trim($json_obj->statuscode);
									$message = trim($json_obj->message);
									if($status == '0')
									{
										$particulars = $json_obj->particulars;

										$dueamount = 0;
										$duedate = "";
										$customername = "";
										$billnumber = "";
										$billdate = "";
										$billperiod = "";
										$reference_id = "";
										if(isset($particulars->dueamount))
										{
											$dueamount = trim($particulars->dueamount);
										}
										if(isset($particulars->duedate))
										{
											$duedate = trim($particulars->duedate);
										}
										if(isset($particulars->customername))
										{
											$customername = trim($particulars->customername);
										}
										if(isset($particulars->billnumber))
										{
											$billnumber = trim($particulars->billnumber);
										}
										if(isset($particulars->billdate))
										{
											$billdate = trim($particulars->billdate);
										}
										if(isset($particulars->billperiod))
										{
											$billperiod = trim($particulars->billperiod);
										}
										if(isset($particulars->reference_id))
										{
											$reference_id = trim($particulars->reference_id);
										}

										$this->db->query("update tblbillcheck set check_dueamount = ?,check_duedate=?,check_customername=?,check_billnumber=?,check_billdate=?,check_billperiod=?,check_reference_id = ? where Id = ?",array($dueamount,$duedate,$customername,$billnumber,$billdate,$billperiod,$reference_id,$insert_id ));

										return $buffer;
									}
									else
									{
										$resp_arr = array(
										"message"=>$message,
										"status"=>$status,
										"statuscode"=>$statuscode,
										);
										$json_resp =  json_encode($resp_arr);
										return $json_resp;
									}
									
									
								}
								else
								{
									$resp_arr = array(
										"message"=>"Internal Server Error Occured",
										"status"=>1,
										"statuscode"=>"ERR",
										);
									$json_resp =  json_encode($resp_arr);
									return $json_resp;
								}
						}
				}
				else
				{
					$resp_arr = array(
								"message"=>"Your Account Deactivated By Admin",
								"status"=>5,
								"statuscode"=>"UNK",
							);
					$json_resp =  json_encode($resp_arr);
					return $json_resp;
				}
					
			}
			else
			{
				$resp_arr = array(
								"message"=>"Invalid Access",
								"status"=>5,
								"statuscode"=>"UNK",
							);
				$json_resp =  json_encode($resp_arr);
				return $json_resp;
			}
		}
		else
		{
			$resp_arr = array(
								"message"=>"Userinfo Missing",
								"status"=>4,
								"statuscode"=>"UNK",
							);
			$json_resp =  json_encode($resp_arr);
			return $json_resp;
		}
		
	}
	else
	{
		$resp_arr = array(
								"message"=>"Userinfo Missing",
								"status"=>4,
								"statuscode"=>"UNK",
							);
		$json_resp =  json_encode($resp_arr);
		return $json_resp;
		
	}
	$this->loging("MMBILL",$url." ?".json_encode($request_array),$buffer,$json_resp,$userinfo->row(0)->username);
	return $json_resp;
	
}



	public function recharge_transaction2($userinfo,$spkey,$company_id,$Amount,$Mobile,$CustomerMobile,$remark,$option1,$ref_id,$particulars,$option2="",$option3="",$done_by = "WEB")
{
   

   		// error_reporting(-1);
   		// ini_set('display_errors',1);
   		// $this->db->db_debug = TRUE;
	    $api_name = "";
	    
	    
	    
	    if($spkey == "TYE")
		{
			$option1  = "Ahmedabad";
		}
	    $company_info = $this->db->query("select a.company_id,a.company_name,b.api_name,a.minamt,a.mxamt,a.service_id from tblcompany a left join tblapi b on a.api_id = b.api_id where a.company_id = ?",array($company_id));
	   if($company_info->num_rows() == 1)
	   {
	       $api_name = $company_info->row(0)->api_name;
	   }
	   $service_id = $company_info->row(0)->service_id;



	   if($Amount < $company_info->row(0)->minamt )
	    {
	        $resp_arr = array(
								"message"=>"You can only pay between  ".$company_info->row(0)->minamt."-".$company_info->row(0)->mxamt,
								"status"=>1,
								"statuscode"=>"ERR",
							);
			$json_resp =  json_encode($resp_arr);
			echo $json_resp;exit;
	    }
	    else if($Amount > $company_info->row(0)->mxamt )
	    {
	        $resp_arr = array(
								"message"=>"You can only pay between  ".$company_info->row(0)->minamt."-".$company_info->row(0)->mxamt,
								"status"=>1,
								"statuscode"=>"ERR",
							);
			$json_resp =  json_encode($resp_arr);
				echo $json_resp;exit;
	    }
	    else if($userinfo->row(0)->service == 'no' )
	    {
	        $resp_arr = array(
								"message"=>"Userinfo Missing",
								"status"=>4,
								"statuscode"=>"UNK",
							);
			$json_resp =  json_encode($resp_arr);
	    }
	    else
	    {

	        $this->loging("RECHARGE","step2","","",$userinfo->row(0)->username);
	       // if($this->bill_checkduplicate($userinfo->row(0)->user_id,$Mobile,$Amount) == false)
	        if(false)
        	{
        	    $resp_arr = array(
								"message"=>"Please Try Later",
								"status"=>1,
								"statuscode"=>"ERR",
							);
			    $json_resp =  json_encode($resp_arr);
			    	$this->loging("RECHARGE","","",$json_resp,$userinfo->row(0)->username);
        		return $json_resp;   
        	}
        	else
        	{

        	    $this->loging("RECHARGE","step3","","",$userinfo->row(0)->username);
        	    $rsltcheck = $this->db->query("SELECT Id FROM `tblbills`  where service_no = ? and user_id = ? and status != 'Failure' and Date(add_date) = ?
ORDER BY `tblbills`.`Id`  DESC",array($Mobile,$userinfo->row(0)->user_id,$this->common->getMySqlDate()));
                //if($rsltcheck->num_rows() == 1)
                if(false)
                {
                    $resp_arr = array(
								"message"=>"Duplicate Request Found.",
								"status"=>1,
								"statuscode"=>"ERR",
							);
			        $json_resp =  json_encode($resp_arr);
                }
                else
                {
                	$this->loging("RECHARGE","step4","","",$userinfo->row(0)->username);
                    $Amount = intval($Amount);
            		$ipaddress = $this->common->getRealIpAddr();
            		$payment_mode = "CASH";
            		$payment_channel = "AGT";
            		
            		if($spkey == "TPE" )
            		{
            			$payment_mode = "";
            			$payment_channel = "";
            		}
            		$url= '';
            		$buffer = '';
            		if($userinfo != NULL)
            		{
            		 
            			if($userinfo->num_rows() == 1)
            			{
            				
            				$user_id = $userinfo->row(0)->user_id;
            				$usertype_name = $userinfo->row(0)->usertype_name;
            				$user_status = $userinfo->row(0)->status;
            				if($usertype_name == "Agent" or $usertype_name == "APIUSER")
            				{
            					if($user_status == '1')
            					{
            			
            						/*
            						
            		{"statuscode":"TXN","status":"Transaction Successful","data":{"dueamount":"140.00","duedate":"04-02-2019","customername":"NISHAT","billnumber":"055440619012212","billdate":"22-01-2019","billperiod":"NA","billdetails":[],"customerparamsdetails":[{"Name":"CA Number","Value":"103761766"}],"additionaldetails":[],"reference_id":46731}}
            		*/

            						$crntBalance = $this->Common_methods->getAgentBalance($user_id);

$this->loging("RECHARGE_REQ_",$url,"CurrentBalance:".$crntBalance,"RechAmount:".$Amount."---Mobile:".$Mobile."---CustomerMobile:".$CustomerMobile,$userinfo->row(0)->username);
            						if(trim($crntBalance) >= trim($Amount))
            						{
            						   
            								$dueamount = "";
            								$duedate = "";
            								$billnumber = "";
            								$billdate = "";
            								$billperiod = "";
            								$custname = "";
            								$insta_ref = 0;
            							//print_r($particulars);exit;
            							if($particulars != false)
            							{
            								$custname = $particulars->customername;
            								$dueamount = $particulars->dueamount;
            								$duedate = $particulars->duedate;
            								$billnumber = $particulars->billnumber;
            								$billdate = $particulars->billdate;
            								$billperiod = $particulars->billperiod;
            								$insta_ref = $particulars->reference_id;
            							}
            							else
            							{
            								$billcheck_rslt = $this->db->query("select * from tblbillcheck where mobile=? and user_id = ? order by Id desc limit 1",array($Mobile,$user_id));
            								if($billcheck_rslt->num_rows() == 1)
            								{
            									$custname = $billcheck_rslt->row(0)->check_customername;
	            								$dueamount = $billcheck_rslt->row(0)->check_dueamount;
	            								$duedate = $billcheck_rslt->row(0)->check_duedate;
	            								$billnumber = $billcheck_rslt->row(0)->check_billnumber;
	            								$billdate = $billcheck_rslt->row(0)->check_billdate;
	            								$billperiod = $billcheck_rslt->row(0)->check_billperiod;
	            								$insta_ref = $billcheck_rslt->row(0)->check_reference_id;
            								}
            							}


            					// error_reporting(-1);
            					// ini_set('display_errors',1);
            					// $this->db->db_debug = TRUE;
                                    //print_r($billcheck_rslt->result());exit;
            							
            							$insert_rslt = $this->db->query("insert into tblbills(add_date,ipaddress,user_id,service_no,customer_mobile,company_id,bill_amount,paymentmode,payment_channel,status,customer_name,dueamount,duedate,billnumber,billdate,billperiod,option1,done_by,API)
            							values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)",
            							array($this->common->getDate(),$ipaddress,$user_id,$Mobile,$CustomerMobile,$company_id,$Amount,$payment_mode,$payment_channel,"Pending",$custname,$dueamount,$duedate,$billnumber,$billdate,$billperiod,$option1,$done_by,"MM"));
            							if($insert_rslt == true)
            							{
            								
            								$insert_id = $this->db->insert_id();

            								$transaction_type = "BILL";
            								if($service_id == 31)
            								{
            										$Charge_Amount = -10;
            								}
            								else
            								{
            									$Charge_Amount =0.0;
            									if($Amount > 100000)
	            								{
		                                            $Charge_Amount =0.0;
	            								}
	            								else
	            								{
	            								    //$Charge_Amount = (($Amount * 0.15)/100);
	            								}
            								}
            								
            								
            							
            								$dr_amount = $Amount - $Charge_Amount;
            								$Description = "Service No.  ".$Mobile." Bill Amount : ".$Amount;
            								$sub_txn_type = "BILL";
            								$remark = "Bill PAYMENT";
            								$Charge_Amount = $Charge_Amount;
            								
            								$paymentdebited = $this->PAYMENT_DEBIT_ENTRY($user_id,$insert_id,$transaction_type,$dr_amount,$Description,$sub_txn_type,$remark,$Charge_Amount,$userinfo);
            								if($paymentdebited == true)
            								{
            								    $otoamount = 2000;
            								    $rsltcommon_otoamt = $this->db->query("select * from common where param = 'BILLAMT_OTOMAX'");
            								    if($rsltcommon_otoamt->num_rows() == 1)
            								    {
            								        $otoamount = $rsltcommon_otoamt->row(0)->value;
            								    }
            								    $dohold = 'no';
											    $rsltcommon = $this->db->query("select * from common where param = 'BILLHOLD'");
											    if($rsltcommon->num_rows() == 1)
											    {
											        $is_hold = $rsltcommon->row(0)->value;
											    	if($is_hold == 1)
											    	{
											    	    $dohold = 'yes';
											    	}
											    }


											    //if($dohold == 'yes')
											    if(false)
												{
													
													$resp_arr = array(
																			"message"=>"Bill Request Submitted Successfully",
																			"status"=>0,
																			"statuscode"=>"TUP",
																			"data"=>array(

																				"ipay_id"=>"",
																				"opr_id"=>"",
																				"status"=>"Pending",
																				"res_msg"=>"Bill Request Submitted Successfully",
																			)
																		);
													$json_resp =  json_encode($resp_arr);	
												}
												else
												{
													$headers = array();
	            									$headers[] = 'Accept: application/json';
	            									$headers[] = 'Content-Type: application/json';
	            
											    	if($spkey == "TPE" and $option1 == "Ahmedabad")
													{
														$spkey  = "TYE";
													}
	    
	    											$url = "https://www.primepay.co.in/webapi/doBillrecharge?username=".$this->getUsername()."&pwd=".$this->getPassword()."&mcode=".$spkey."&serviceno=".$Mobile."&customer_mobile=".$CustomerMobile."&option1=".$option1."&Amount=".$Amount."&RefId=".$insta_ref;
	    											
	    										
	    											$request_array = array();
	    										//	$mainreq_array["token"]=$this->getToken();
	    
	    											
	    											$ch = curl_init();
	    											curl_setopt($ch,CURLOPT_URL,$url);
	    											curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	    											curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	    											curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	    											curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	    
	    											$buffer = curl_exec($ch);
	    											curl_close($ch);
	    
	    											$json_resp =  $buffer;
	    											//echo $url."<br><br>";
	    											//var_dump( $buffer);exit;
	    											
	    											$this->loging("MMBBPS",$url,$buffer,"",$userinfo->row(0)->username);
	    										
	    									//	$this->loging("RECHARGE",$url,$json_resp,json_encode($request_array),$userinfo->row(0)->username);
	    										
	    											
	            									/*
	            									{"ipay_id":"1180518152856NUHHQ","agent_id":"1235","opr_id":"1805181529230004","account_no":"8238232303","sp_key":"VFP","trans_amt":10,"charged_amt":9.93,"opening_bal":"18066.10","datetime":"2018-05-18 15:29:14","status":"SUCCESS","res_code":"TXN","res_msg":"Transaction Successful"}
	    											
	    											
	    											new response 
	    											{"statuscode":"TXN","status":"Transaction Successful",
	    											"data":{
	    												"ipay_id":"1190122152826GSQYX",
	    												"agent_id":"14",
	    												"opr_id":"TJ0100953330",
	    												"account_no":"103761766",
	    												"sp_key":"BYE",
	    												"trans_amt":"140",
	    												"charged_amt":139.05,
	    												"opening_bal":"23927.70",
	    												"datetime":"2019-01-22 15:28:28",
	    												"status":"SUCCESS"
	    											}}

	    											 {"message":"SUCCESS","status":0,"statuscode":"TXN","data":{"ipay_id":"O022098801","opr_id":"CC01ABU31654","status":"Successful","res_msg":"000"}}
	    											
	            									*/
	            									$json_obj = json_decode($buffer);
	            									if(isset($json_obj->statuscode) and isset($json_obj->status))
	            									{
	    													$statuscode = trim((string)$json_obj->statuscode);
	    													$status = trim((string)$json_obj->status);
	    												
	    													if($statuscode == "TXN")
	    													{
	    														$data = $json_obj->data;
	    														$ipay_id = $data->ipay_id;
	    														$agent_id = "";
	    														$opr_id = $data->opr_id;
	    														$sp_key = "";
	    														$trans_amt = "";
	    														$charged_amt = "";
	    														$opening_bal = "";
	    														$datetime = "";
	    														$status = $data->status;
	    														if($status == "SUCCESS")
	    														{
	    															$this->db->query("update tblbills set status = 'Success',ipay_id = ?,opr_id=?,trans_amt=?,charged_amt=?,opening_bal=?,datetime=?,resp_status=?,res_code=?,res_msg=? where Id = ?",array($ipay_id,$opr_id,$trans_amt,$charged_amt,$opening_bal,$datetime,$status,$statuscode,$status,$insert_id));
	    
	    														}
	    														else
	    														{
	    															$this->db->query("update tblbills set ipay_id = ?,opr_id=?,trans_amt=?,charged_amt=?,opening_bal=?,datetime=?,resp_status=?,res_code=?,res_msg=? where Id = ?",array($ipay_id,$opr_id,$trans_amt,$charged_amt,$opening_bal,$datetime,$status,$statuscode,$status,$insert_id));
	    
	    														}
	    
	    
	    															// $resp_arr = array(
	    															// 						"message"=>$status,
	    															// 						"status"=>0,
	    															// 						"statuscode"=>$statuscode,
	    															// 						"data"=>array(
	    
	    															// 							"ipay_id"=>$ipay_id,
	    															// 							"opr_id"=>$opr_id,
	    															// 							"status"=>$status,
	    															// 							"res_msg"=>$status,
	    															// 						)
	    															// 					);
	    															// $json_resp =  json_encode($resp_arr);	

	    															$resparray = array(
																                            "status"=>"Success",
																                            "tid"=>$insert_id,
																                            "order_id"=>"",
																                            "mobile"=>$Mobile,
																                            "amount"=>$Amount,
																                            "operator_id"=>$opr_id,
																                    );
																    echo json_encode($resparray);exit;



	    													}
	    													else if($statuscode == "TUP")
	    													{
	    														$data = $json_obj->data;
	    														$ipay_id = $data->ipay_id;
	    														$agent_id = $data->agent_id;
	    														$opr_id = $data->opr_id;
	    														$sp_key = $data->sp_key;
	    														$trans_amt = $data->trans_amt;
	    														$charged_amt = $data->charged_amt;
	    														$opening_bal = $data->opening_bal;
	    														$datetime = $data->datetime;
	    														$status = $data->status;
	    														
	    															$this->db->query("update tblbills set status = 'Pending',ipay_id = ?,opr_id=?,trans_amt=?,charged_amt=?,opening_bal=?,datetime=?,resp_status=?,res_code=?,res_msg=? where Id = ?",array($ipay_id,$opr_id,$trans_amt,$charged_amt,$opening_bal,$datetime,$status,$statuscode,$status,$insert_id));
	    
	    														
	    
	    
	    															// $resp_arr = array(
	    															// 			"message"=>"Request Submitted Successfully",
	    															// 			"status"=>0,
	    															// 			"statuscode"=>$statuscode,
	    															// 			"data"=>array(
	    
	    															// 				"ipay_id"=>$ipay_id,
	    															// 				"opr_id"=>$opr_id,
	    															// 				"status"=>$status,
	    															// 				"res_msg"=>$status,
	    															// 			)
	    															// 		);
	    															// $json_resp =  json_encode($resp_arr);	


	    															$resparray = array(
																                            "status"=>"Pending",
																                            "tid"=>$insert_id,
																                            "order_id"=>"",
																                            "mobile"=>$Mobile,
																                            "amount"=>$Amount,
																                            "operator_id"=>"",
																                    );
																    echo json_encode($resparray);exit;

	    													}
	    													else if($statuscode == "IRA" or $statuscode == "UAD" or $statuscode == "IAC"  or $statuscode == "IAT"  or $statuscode == "AAB" or $statuscode == "ISP"  or $statuscode == "DID"  or $statuscode == "SPD" )
	    													{
	            												$this->PAYMENT_CREDIT_ENTRY($user_id,$insert_id,$transaction_type,$dr_amount,$Description,$sub_txn_type,$remark,$Charge_Amount,$userinfo);
	            												
	            												$this->db->query("update tblbills set status = 'Failure',resp_status=?,res_code=?,res_msg=? where Id = ?",array("FAILURE",$statuscode,$status,$insert_id));
	            												
	            												// $resp_arr = array(
	            												// 							"message"=>$status,
	            												// 							"status"=>1,
	            												// 							"statuscode"=>$statuscode,
	            												// 						);
	            												// 	$json_resp =  json_encode($resp_arr);



	            													$resparray = array(
																                            "status"=>"Failure",
																                            "tid"=>$insert_id,
																                            "order_id"=>"",
																                            "mobile"=>$Mobile,
																                            "amount"=>$Amount,
																                            "operator_id"=>"",
																                    );
																    echo json_encode($resparray);exit;


	            											}
	    													else if($statuscode == "IAB" )
	    													{
	            												$this->PAYMENT_CREDIT_ENTRY($user_id,$insert_id,$transaction_type,$dr_amount,$Description,$sub_txn_type,$remark,$Charge_Amount,$userinfo);
	            												
	    														$status = "Internal Server Error";
	    														$statuscode = "ERR";
	            												$this->db->query("update tblbills set status = 'Failure',resp_status=?,res_code=?,res_msg=? where Id = ?",array("FAILURE",$statuscode,$status,$insert_id));
	            												
	            												$resp_arr = array(
	            																			"message"=>$status,
	            																			"status"=>1,
	            																			"statuscode"=>$statuscode,
	            																		);
	            													$json_resp =  json_encode($resp_arr);


	            													$resparray = array(
																                            "status"=>"Failure",
																                            "tid"=>$insert_id,
																                            "order_id"=>"",
																                            "mobile"=>$Mobile,
																                            "amount"=>$Amount,
																                            "operator_id"=>"",
																                    );
																    echo json_encode($resparray);exit;
	            											}
	                
	                
	                									}
	            									else 
	            									{
	            										$resparray = array(
																                            "status"=>"Failure",
																                            "tid"=>"",
																                            "order_id"=>"",
																                            "mobile"=>$Mobile,
																                            "amount"=>$Amount,
																                            "operator_id"=>"",
																                    );
													    echo json_encode($resparray);exit;


	            										// $resp_arr = array(
	            										// 		"message"=>"Some Error Occure",
	            										// 		"status"=>10,
	            										// 		"statuscode"=>"UNK",
	            										// 	);
	            										// $json_resp =  json_encode($resp_arr);
	            									}
												}
            								}
            								else
            								{
            									$resp_arr = array(
            									"message"=>"Payment Error. Please Try Again",
            									"status"=>1,
            									"statuscode"=>"ERR",
            								);
            								$json_resp =  json_encode($resp_arr);
            								}
            							}
            						}
            						else
            						{
            							$resp_arr = array(
            									"message"=>"InSufficient Balance 2",
            									"status"=>1,
            									"statuscode"=>"ISB",
            								);
            							$json_resp =  json_encode($resp_arr);
            						}
            						
            					}
            					else
            					{
            						$resp_arr = array(
            									"message"=>"Your Account Deactivated By Admin",
            									"status"=>5,
            									"statuscode"=>"UNK",
            								);
            						$json_resp =  json_encode($resp_arr);
            					}
            						
            				}
            				else
            				{
            					$resp_arr = array(
            									"message"=>"Invalid Access",
            									"status"=>5,
            									"statuscode"=>"UNK",
            								);
            					$json_resp =  json_encode($resp_arr);
            				}
            			}
            			else
            			{
            				$resp_arr = array(
            									"message"=>"Userinfo Missing",
            									"status"=>4,
            									"statuscode"=>"UNK",
            								);
            				$json_resp =  json_encode($resp_arr);
            			}
            			
            		}
            		else
            		{
            			$resp_arr = array(
            									"message"=>"Userinfo Missing",
            									"status"=>4,
            									"statuscode"=>"UNK",
            								);
            			$json_resp =  json_encode($resp_arr);
            			
            		}  
                }
        		$this->loging("MMBILL",$url,$buffer,$json_resp,$userinfo->row(0)->username);
        		return $json_resp;   
        	}    
	    }
	    
		
}


	
	public function checkduplicate($user_id,$transaction_id)
    {
    	$add_date = $this->common->getDate();
    	$ip = $this->common->getRealIpAddr();
    
    	$rslt = $this->db->query("insert into dmr_refund_lock (user_id,dmr_id,add_date,ipaddress) values(?,?,?,?)",array($user_id,$transaction_id,$add_date,$ip));
    	  if($rslt == "" or $rslt == NULL)
    	  {
    		return false;
    	  }
    	  else
    	  {
    	  	return true;
    	  }
    }
	public function PAYMENT_CREDIT_ENTRY($user_id,$transaction_id,$transaction_type,$dr_amount,$Description,$sub_txn_type,$remark,$ChargeAmount)
	{
	    
				if($this->checkduplicate($user_id,$transaction_id) == false)
        	    //if(false)
            	{
            	    
            	}
            	else
            	{
            	    	$Description = "Refund :".$Description;
                		$this->load->library("common");
                		$add_date = $this->common->getDate();
                		$date = $this->common->getMySqlDate();
                		$ip = $this->common->getRealIpAddr();
                		$old_balance = $this->Common_methods->getAgentBalance($user_id);
                		$current_balance = $old_balance + $dr_amount;
                		//$tds = 0.00;
                		$stax = 0.00;
                		if($transaction_type == "DMR")
                		{
                			$remark = "Money Remittance Reverse";
                			$str_query = "insert into  tblewalle(user_id,dmr_id,transaction_type,credit_amount,balance,description,add_date,ipaddress,remark)
                
                			values(?,?,?,?,?,?,?,?,?)";
                			$reslut = $this->db->query($str_query,array($user_id,$transaction_id,$transaction_type,$dr_amount,$current_balance,$Description,$add_date,$ip,$remark));
                			if($reslut == true)
                			{
                					$ewallet_id = $this->db->insert_id();
                					if($ewallet_id > 10)
                					{
                						if($sub_txn_type == "Account_Validation")
                						{
                									$rslt_updtrec = $this->db->query("update mt3_account_validate set reverted='yes',balance=CONCAT_WS(',',balance,?), ewallet_id = CONCAT_WS(',',ewallet_id,?),credit_amount = ? where Id = ?",array($current_balance,$ewallet_id,$dr_amount,$transaction_id));
                									return true;
                						}
                						else if($sub_txn_type == "REMITTANCE")
                						{
                									$current_balance2 = $current_balance + $ChargeAmount;
                									$remark = "Transaction Charge Reverse";
                									$str_query_charge = "insert into  tblewalle(user_id,dmr_id,transaction_type,credit_amount,balance,description,add_date,ipaddress,remark)
                
                									values(?,?,?,?,?,?,?,?,?)";
                									$reslut2 = $this->db->query($str_query_charge,array($user_id,$transaction_id,$transaction_type,$ChargeAmount,$current_balance2,$Description,$add_date,$ip,$remark));
                									if($reslut2 == true)
                									{
                										$totaldebit_amount = $dr_amount + $ChargeAmount;
                										$ewallet_id2 = $ewallet_id.",".$this->db->insert_id();
                										$rslt_updtrec = $this->db->query("update mt3_transfer set reverted='yes',balance=CONCAT_WS(',',balance,?), ewallet_id = CONCAT_WS(',',ewallet_id,?),credit_amount = ? where Id = ?",array($current_balance2,$ewallet_id2,$totaldebit_amount,$transaction_id));
                									    return true;
                									}
                									else
                									{
                										$rslt_updtrec = $this->db->query("update mt3_transfer set reverted='yes',balance=CONCAT_WS(',',balance,?), ewallet_id = CONCAT_WS(',',ewallet_id,?),credit_amount = ? where Id = ?",array($current_balance,$ewallet_id,$dr_amount,$transaction_id));
                										return false;
                									}
                									
                									
                									return false;
                						}
                						
                					}
                					else
                					{
                							return false;
                					}
                			}
                			else
                			{
                				return false;
                			}
                			
                		}
                		else if($transaction_type == "BILL")
                		{
                			$str_query = "insert into  tblewalle(user_id,bill_id,transaction_type,credit_amount,balance,description,add_date,ipaddress)
                
                			values(?,?,?,?,?,?,?,?)";
                			$reslut = $this->db->query($str_query,array($user_id,$transaction_id,$transaction_type,$dr_amount,$current_balance,$Description,$add_date,$ip));
                
                			if($reslut == true)
                			{
                					$ewallet_id = $this->db->insert_id();
                
                					$rslt_updtrec = $this->db->query("update tblbills set debited='yes',reverted='yes',balance=CONCAT_WS(',',balance,?), ewallet_id = CONCAT_WS(',',ewallet_id,?),credit_amount = ? where Id = ?",array($current_balance,$ewallet_id,$dr_amount,$transaction_id));
                			}
                			else
                			{
                				return false;
                			}
                
                		}
                		else
                		{
                				return false;
                		}
            	}
			
			
			
		
	}
	
	
	
	
	public function checkduplicate_bill($user_id,$transaction_id)
    {
    	$add_date = $this->common->getDate();
    	$ip = $this->common->getRealIpAddr();
    
    	$rslt = $this->db->query("insert into bill_refund_lock (user_id,dmr_id,add_date,ipaddress) values(?,?,?,?)",array($user_id,$transaction_id,$add_date,$ip));
    	  if($rslt == "" or $rslt == NULL)
    	  {
    		return false;
    	  }
    	  else
    	  {
    	  	return true;
    	  }
    }
	public function PAYMENT_CREDIT_ENTRY_bill($user_id,$transaction_id,$transaction_type,$dr_amount,$Description,$sub_txn_type,$remark,$ccf,$cashback,$tds)
	{
	    
				if($this->checkduplicate_bill($user_id,$transaction_id) == false)
        	    //if(false)
            	{
            	    
            	}
            	else
            	{
            	    	$Description = "Refund :".$Description;
                		$this->load->library("common");
                		$add_date = $this->common->getDate();
                		$date = $this->common->getMySqlDate();
                		$ip = $this->common->getRealIpAddr();
                		$old_balance = $this->Common_methods->getAgentBalance($user_id);
                		$current_balance = $old_balance + $dr_amount;
                		//$tds = 0.00;
                		$stax = 0.00;
                		if($transaction_type == "BILL")
                		{
                			$str_query = "insert into  tblewalle(user_id,bill_id,transaction_type,credit_amount,balance,description,add_date,ipaddress,tds,serviceTax,remark)
                
                			values(?,?,?,?,?,?,?,?,?,?,?)";
                			$reslut = $this->db->query($str_query,array($user_id,$transaction_id,$transaction_type,$dr_amount,$current_balance,$Description,$add_date,$ip,$tds,$stax,$remark));
                
                			if($reslut == true)
                			{
                					$ewallet_id = $this->db->insert_id();
                
                					$rslt_updtrec = $this->db->query("update tblbills set debited='yes',reverted='yes',balance=CONCAT_WS(',',balance,?), ewallet_id = CONCAT_WS(',',ewallet_id,?),credit_amount = ? where Id = ?",array($current_balance,$ewallet_id,$dr_amount,$transaction_id));
                			}
                			else
                			{
                				return false;
                			}
                
                		}
                		else
                		{
                				return false;
                		}
            	}
			
			
			
		
	}

	public function COMMISSIONPAYMENT_CREDIT_ENTRY($user_id,$transaction_id,$transaction_type,$dr_amount,$Description,$sub_txn_type,$remark,$chargeAmount = 0.00)
	{
	
	/*	$Description = "Commission :".$Description;
		$this->load->library("common");
		$add_date = $this->common->getDate();
		$date = $this->common->getMySqlDate();
		$ip = $this->common->getRealIpAddr();
		if($dr_amount <= 30)
		{
			$old_balance = $this->Common_methods->getAgentBalance($user_id);
			$current_balance = $old_balance + $dr_amount;
			
			$tds = 0.00;
			$stax = 0.00;
			if($transaction_type == "DMR")
			{
				$remark = "Money Remittance Commission";
				$str_query = "insert into  tblewalle(user_id,dmr_id,transaction_type,credit_amount,balance,description,add_date,ipaddress,remark)
	
				values(?,?,?,?,?,?,?,?,?)";
				$reslut = $this->db->query($str_query,array($user_id,$transaction_id,$transaction_type,$dr_amount,$current_balance,$Description,$add_date,$ip,$remark));
				if($reslut == true)
				{
						$ewallet_id = $this->db->insert_id();
						if($ewallet_id > 10)
						{
						    $ORDERREM = "yes".$dr_amount;
							
				$rslt_updtrec = $this->db->query("update mt3_transfer set order_id=?  where Id = ?",array($ORDERREM,$transaction_id));
										return true;
							
							
						}
						else
						{
								return false;
						}
				}
				else
				{
					return false;
				}
				
			}
			else
			{
					return false;
			}
		}*/
			
	}
	

////////////////////////////////////////////////////////////////////////////////////////////////////////////////	
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//****************************  P A Y M E N T   M E T H O D   E N D S   H E R E   ****************************//
////////////////////////////////////////////////////////////////////////////////////////////////////////////////	
////////////////////////////////////////////////////////////////////////////////////////////////////////////////

private function getChargeValue($userinfo,$whole_amount)
{
    
    
    $groupinfo = $this->db->query("select * from mt3_group where Id = (select dmr_group from tblusers where user_id = ?)",array($userinfo->row(0)->parentid));
   // $groupinfo = $this->db->query("select * from mt3_group where Id =3");
	if($groupinfo->num_rows() == 1)
	{
		
			$getrangededuction = $this->db->query("
			select 
				a.charge_type,
				a.charge_amount as charge_value,
				'PER' as dist_charge_type,
				'0.20' as dist_charge_value,
				a.ccf,
				a.cashback,
				a.tds,
				a.ccf_type,
				a.cashback_type,
				a.tds_type
				from mt_commission_slabs a 
				where a.range_from <= ? and a.range_to >= ? and group_id = ?",array($whole_amount,$whole_amount,$groupinfo->row(0)->Id));
			if($getrangededuction->num_rows() == 1)
			{
				return $getrangededuction;
			}
		
		
	}
	else
	{
			$groupinfo = $this->db->query("select * from mt3_group where Id = (select dmr_group from tblusers where user_id = ?)",array($userinfo->row(0)->parentid));
        	if($groupinfo->num_rows() == 1)
        	{
        		if($groupinfo->row(0)->charge_type == "SLAB")
        		{
        			$getrangededuction = $this->db->query("
        			select 
        				a.charge_type,
        				a.charge_amount as charge_value,
        				'PER' as dist_charge_type,
        				'0.20' as dist_charge_value ,
        				a.ccf,
        				a.cashback,
        				a.tds,
        				a.ccf_type,
        				a.cashback_type,
        				a.tds_type
        				from mt_commission_slabs a 
        				where a.range_from <= ? and a.range_to >= ? and group_id = ?",array($whole_amount,$whole_amount,$groupinfo->row(0)->Id));
        			if($getrangededuction->num_rows() == 1)
        			{
        				return $getrangededuction;
        			}
        		}
        		else
        		{
        			return $groupinfo;	
        		}
        		
        	}
        	else
        	{
        		return false;
        	}
	}
    
    
    
    
    
    

}


	
}

?>