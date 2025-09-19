<?php
class Instapay extends CI_Model 
{	
	function _construct()
	{
		  // Call the Model constructor
		  parent::_construct();
	}
	private function getLiveUrl($type)
	{	
		if($type == "remitter_details")
		{
				$url = 'https://www.instantpay.in/ws/dmi/remitter_details';
		}
		if($type == "remitter_registration")
		{
				$url = 'https://www.instantpay.in/ws/dmi/remitter';
		}
		if($type == "remitter_validate")
		{
				$url = 'https://www.instantpay.in/ws/dmi/remitter_validate';
		}


		
		if($type == "beneficiary_register")
		{
				$url = 'https://www.instantpay.in/ws/dmi/beneficiary_register';
		}
		if($type == "beneficiary_resend_otp")
		{
				$url = 'https://www.instantpay.in/ws/dmi/beneficiary_resend_otp';
		}
		if($type == "beneficiary_register_validate")
		{
				$url = 'https://www.instantpay.in/ws/dmi/beneficiary_register_validate';
		}
		if($type == "account_validate")
		{
				$url = 'https://www.instantpay.in/ws/imps/account_validate';
		}
		if($type == "beneficiary_remove")
		{
				$url = 'https://www.instantpay.in/ws/dmi/beneficiary_remove';
		}
		if($type == "beneficiary_remove_validate")
		{
				$url = 'https://www.instantpay.in/ws/dmi/beneficiary_remove_validate';
		}
		if($type == "transfer_status")
		{
				$url = 'https://www.instantpay.in/ws/dmi/transfer_status';
		}
		if($type == "transfer")
		{
				$url = 'https://www.instantpay.in/ws/dmi/transfer';
		}
		if($type == "checkwallet")
		{
				$url = 'https://www.instantpay.in/ws/api/checkwallet';
		}
		if($type == "bank_details")
		{
				$url = 'https://www.instantpay.in/ws/dmi/bank_details';
		}
		
		
		return $url;
	}
	private function getToken()
	{
		//return "";
		//return "";
		return "";
	}
	private function getOutletId()
	{
		return 3374;
	}
	
	public function bank_details($accountno,$userinfo,$ifsc)
	{
		if($userinfo != NULL)
		{
			if($userinfo->num_rows() == 1)
			{
				$ifsc_f = substr($ifsc,0,4);
				
				$user_id = $userinfo->row(0)->user_id;
				$usertype_name = $userinfo->row(0)->usertype_name;
				$user_status = $userinfo->row(0)->status;
				if($usertype_name == "Agent" or $usertype_name == "APIUSER")
				{
					if($user_status == '1')
					{
							$postparam = '{"token": "'.$this->getToken().'","request": {"account": "'.$accountno.'"}}';
		
							$headers = array();
							$headers[] = 'Accept: application/json';
							$headers[] = 'Content-Type: application/json';
							
							$ch = curl_init();
							curl_setopt($ch,CURLOPT_URL,$this->getLiveUrl("bank_details"));
							curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
							curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
							curl_setopt($ch, CURLOPT_POST,1);
							curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
							curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
							curl_setopt($ch, CURLOPT_POSTFIELDS, $postparam);
							$buffer = curl_exec($ch);
							curl_close($ch);
							
							//echo $buffer;exit;
							$json_obj = json_decode($buffer);
						//echo "URL :: ".$this->getLiveUrl("bank_details");
					//	echo "<br>";
					//	echo "POST PARAMS :: ".$postparam;
						//echo "<br>";
						//echo "Response :: ".$buffer;exit;
						
							if(isset($json_obj->statuscode) and isset($json_obj->status))
							{
									$statuscode = $json_obj->statuscode;
									$status = $json_obj->status;
								
									if($statuscode == "TXN")
									{
										
										$data = $json_obj->data;
										//print_r($data);exit;
											$active = true;
											foreach($data as $rw)
											{
												$id = $rw->id;
												$bank_name = $rw->bank_name;
												$imps_enabled = $rw->imps_enabled;
												$bank_sort_name = $rw->bank_sort_name;
												$branch_ifsc = $rw->branch_ifsc;
												$ifsc_alias = trim((string)$rw->ifsc_alias);
												$is_down = trim((string)$rw->is_down);
												if($ifsc_alias == $ifsc_f)
												{
													if($is_down  == "1")
													{
														$active = false;
													}
													else
													{
														$active = true;
													}
													break;
												}
												
											}
										return $active;
											
										
										
									}
									else
									{
										$resp_arr = array(
																	"message"=>$status,
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
		$this->loging("remitter_details",$postparam,$buffer,$json_resp,$userinfo->row(0)->username);
		return $json_resp;
		
	}
	
	public function balance()
	{
		
		$postparam = '{"token": "'.$this->getToken().'"}';

		$headers = array();
		$headers[] = 'Accept: application/json';
		$headers[] = 'Content-Type: application/json';

		$ch = curl_init();
		curl_setopt($ch,CURLOPT_URL,$this->getLiveUrl("checkwallet"));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_POST,1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postparam);
		$buffer = curl_exec($ch);
		curl_close($ch);
							
							//echo $buffer;exit;
		$json_obj = json_decode($buffer);
		if(isset($json_obj->Wallet) )
		{
			$Wallet = $json_obj->Wallet;
		}
		else
		{
			$Wallet =  "";
		}

		
		$this->loging("checkwallet",$postparam,$buffer,$Wallet,"Admin");
		return $Wallet;
		
	}
	
	



	public function checkservice_activation($user_id)
	{
		$rslt = $this->db->query("SELECT * FROM active_services where user_id = ? and service_id = 22",array($user_id));
		if($rslt->num_rows() == 1)
		{
			$status = $rslt->row(0)->status;
			if($status == "on")
			{
				return true;
			}
		}
		return false;
	}
	public function remitter_details($mobile_no,$userinfo)
	{
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

						if($this->checkservice_activation($user_id) == false)
						{
							$resp_arr = array(
										"message"=>"Service Activation Failed. Contact Administrator",
										"status"=>10,
										"statuscode"=>"UNK",
									);
							$json_resp =  json_encode($resp_arr);
							return $json_resp;
						}




							$postparam = '{"token": "'.$this->getToken().'","request": {"mobile": "'.$mobile_no.'"}}';
		
							$headers = array();
							$headers[] = 'Accept: application/json';
							$headers[] = 'Content-Type: application/json';
							
							$ch = curl_init();
							curl_setopt($ch,CURLOPT_URL,$this->getLiveUrl("remitter_details"));
							curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
							curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
							curl_setopt($ch, CURLOPT_POST,1);
							curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
							curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
							curl_setopt($ch, CURLOPT_POSTFIELDS, $postparam);
							$buffer = curl_exec($ch);
							curl_close($ch);
							
							//echo $buffer;exit;
							$json_obj = json_decode($buffer);
						//print_r($json_obj);exit;
							if(isset($json_obj->statuscode) and isset($json_obj->status))
							{
									$statuscode = $json_obj->statuscode;
									$status = $json_obj->status;
									if($statuscode == "RNF")
									{
											$resp_arr = array(
																	"message"=>"Record Not Found",
																	"status"=>1,
																	"statuscode"=>"RNF",
																);
											$json_resp =  json_encode($resp_arr);
									}
									else if($statuscode == "TXN")
									{

										$data = $json_obj->data;
										if(isset($data->remitter) and isset($data->beneficiary))
										{
											
												//echo "inside remiter bene";exit;
												
												$remitter =  $data->remitter;
												$remitter->totallimit = 25000;
												$beneficiary = $data->beneficiary;

												$new_bene_array = array();
												
												
												if(isset($remitter->name) and isset($remitter->mobile) and isset($remitter->pincode) and isset($remitter->id))
												{
													$name = trim((string)$remitter->name);
													$mobile = trim((string)$remitter->mobile);
													$pincode = trim((string)$remitter->pincode);
													$remiterid = trim((string)$remitter->id);
													$is_verified = trim((string)$remitter->is_verified);



													$checkremitter = $this->db->query("select * from remitters where insta_remitter_id = ? and status = 'SUCCESS'",array(trim($remiterid)));
													if($checkremitter->num_rows() == 0)
													{
														$otp_varified = "no";
														if($is_verified == "1")
														{
															$otp_varified = "yes";
														}
														$this->db->query("insert into remitters(add_date,mobile,name,pincode,status,insta_remitter_id,insta_verified,otp_varified) values(?,?,?,?,?,?,?,?)",array($this->common->getDate(),$mobile_no,$name,$pincode,"SUCCESS",$remiterid,$is_verified,$otp_varified));
													}
													else if($checkremitter->num_rows() == 1)
													{
														$otp_varified = "no";
														if($is_verified == "1")
														{
															$otp_varified = "yes";
														}
														$this->db->query("update remitters set insta_verified = ?,status = 'SUCCESS',insta_remitter_id = ? where mobile = ?",array($otp_varified,$remiterid,$mobile_no));
													}
												}
												
												foreach($beneficiary  as $bne)
												{
													
													$temparray = array(
														"id"=>$bne->id,
														"name"=>$bne->name,
														"mobile"=>$bne->mobile,
														"account"=>$bne->account,
														"bank"=>$bne->bank,
														"status"=>$bne->status,
														"last_success_date"=>$bne->last_success_date,
														"last_success_name"=>$bne->last_success_name,
														"last_success_imps"=>$bne->last_success_imps,
														"ifsc"=>$bne->ifsc,
														"is_verified"=>"0",
														"verified_name"=>$bne->last_success_name,
														"bankId"=>"1",
														"verifystatus"=>"0"
													);
													

													array_push($new_bene_array,$temparray);

													$checkbeneexist = $this->db->query("select bene_name,benemobile,IFSC,account_number,insta_bene_id,insta_remitter_id from beneficiaries 
	        																	where insta_remitter_id  = ? and insta_bene_id  = ?",
	        																	array($remiterid,$bne->id));

													if($checkbeneexist->num_rows() == 0)
													{
														
														$insertrslt = $this->db->query("insert into beneficiaries
														(
														ipaddress,add_date,bene_name,account_number,IFSC,benemobile,
														sender_mobile,insta_remitter_id,is_verified,paytm_bene_id,is_paytm,bank_name,dezire_bank_id,status,insta_bene_id
														) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)",
														array($this->common->getRealIpAddr(),$this->common->getDate(),$bne->name,$bne->account,$bne->ifsc,$bne->mobile,$mobile_no,$remitter->id,true,"",'no',"",0,"SUCCESS",$bne->id) );

														
													}
												}
												
												
												$remitter->id = $mobile;
												
												$resp_arr = array(
																	"message"=>$status,
																	"status"=>0,
																	"statuscode"=>$statuscode,
																	"remitter"=>$remitter,
																	"beneficiary"=>$new_bene_array
																);
												$json_resp =  json_encode($resp_arr);
											
											
										}
										else if(isset($data->remitter))
										{
											$remitter = $data->remitter;
											if($remitter->is_verified == 0)
											{
												$resp_arr = array(
																	"message"=>"Record Not Found",
																	"status"=>1,
																	"statuscode"=>"RNF",
																);
											$json_resp =  json_encode($resp_arr);
											}
											else
											{
												$resp_arr = array(
																"message"=>$status,
																"status"=>1,
																"statuscode"=>$statuscode,
																
															);
											$json_resp =  json_encode($resp_arr);
											}
											
										}
										else
										{
												$resp_arr = array(
																	"message"=>"Unknown Response",
																	"status"=>2,
																	"statuscode"=>"UNK",
																);
											$json_resp =  json_encode($resp_arr);
										}
										
									}
									else
									{
										$resp_arr = array(
																	"message"=>$status,
																	"status"=>2,
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
		$this->loging("remitter_details",$postparam,$buffer,$json_resp,$userinfo->row(0)->username);
		return $json_resp;
		
	}




	public function remitter_registration2($mobile_no,$firstname,$lastname,$pincode,$userinfo)
	{
		
		if($userinfo != NULL)
		{
			if($userinfo->num_rows() == 1)
			{
			   
				//error_reporting(-1);
				//ini_set('display_errors',1);
				//$this->db->db_debug = TRUE;
				$user_id = $userinfo->row(0)->user_id;
				$usertype_name = $userinfo->row(0)->usertype_name;
				$user_status = $userinfo->row(0)->status;
				if($usertype_name == "Agent" or $usertype_name == "APIUSER")
				{
					if($user_status == '1')
					{
						if($this->checkservice_activation($user_id) == false)
						{
							$resp_arr = array(
										"message"=>"Service Activation Failed. Contact Administrator",
										"status"=>10,
										"statuscode"=>"UNK",
									);
							$json_resp =  json_encode($resp_arr);
							return $json_resp;
						}

						$checkexist = $this->db->query("select * from remitters where mobile  = ?",array($mobile_no));
						if($checkexist->num_rows() == 1)
						{
							$insert_rslt = true;
							$insta_verified =  $checkexist->row(0)->insta_verified;
							$insta_remitter_id =  $checkexist->row(0)->insta_remitter_id;
							$insert_id = $checkexist->row(0)->Id;
							if($insta_verified == 1)
							{
								$resp_arr = array(
												"message"=>$status,
												"status"=>0,
												"remitter_id"=>$insta_remitter_id
											);
								$json_resp =  json_encode($resp_arr);	
								echo $json_resp;exit;
							}
						}
						else
						{
							$insert_rslt = $this->db->query("insert into remitters(add_date,ipaddress,mobile,name,lastname,pincode) values(?,?,?,?,?,?)",
					                                    array($this->common->getDate(),$this->common->getRealIpAddr(),$mobile_no,$firstname,$lastname,$pincode));	
							if($insert_rslt == true)
							{
								$insert_id = $this->db->insert_id();
							}
						}

					    
					   if($insert_rslt == true)
					   {
					       $req_array = array(
										"token"	=>$this->getToken(),
										"request"=>array(
															"mobile"=>$mobile_no,
															"name"=>$firstname,
															"surname"=>"indian",
															"pincode"=>$pincode,
															"outletid"=>"3374"
														)
										);
										$postparam = json_encode($req_array);
										$req = $postparam;
										
										$url = $this->getLiveUrl("remitter_registration");
										$headers = array();
										$headers[] = 'Accept: application/json';
										$headers[] = 'Content-Type: application/json';
										
										$ch = curl_init();
										curl_setopt($ch,CURLOPT_URL,$url);
										curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
										curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
										curl_setopt($ch, CURLOPT_POST,1);
										curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
										curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
										curl_setopt($ch, CURLOPT_POSTFIELDS, $postparam);
										$buffer = curl_exec($ch);
										curl_close($ch);



										$json_obj = json_decode($buffer);
										
										if(isset($json_obj->statuscode) and isset($json_obj->status))
										{
												$statuscode = $json_obj->statuscode;
												$status = $json_obj->status;
												if($statuscode == "RNF")
												{
														$resp_arr = array(
																				"message"=>"Record Not Found",
																				"status"=>1,
																				"statuscode"=>"RNF",
																			);
														$json_resp =  json_encode($resp_arr);
														$this->db->query("update mt3_remitter_registration set status = 'FAILED',RESP_statuscode=?,RESP_status=? where Id = ?",array($statuscode,$status,$insert_id));
												}
												else if($statuscode == "TXN")
												{
													$data = $json_obj->data;
													if(isset($data->remitter))
													{
														$remitter = $data->remitter;
														$is_verified = $remitter->is_verified;
														$remitter_id = $remitter->id;
														if($is_verified == 1)
														{
															$resp_arr = array(
																			"message"=>$status,
																			"status"=>0,
																			"statuscode"=>"TXN",
																			"remitter_id"=>$mobile_no,
																			"is_verified"=>$is_verified
																		);
															$json_resp =  json_encode($resp_arr);	
															$this->db->query("update remitters set status = 'SUCCESS',otp_varified=1,insta_verified=1,insta_remitter_id=? where Id = ?",array($remitter_id,$insert_id));	
														}
														else
														{
															$resp_arr = array(
																			"message"=>$status,
																			"status"=>0,
																			"statuscode"=>"TXN",
																			"remitter_id"=>$mobile_no,
																			"is_verified"=>$is_verified
																		);
															$json_resp =  json_encode($resp_arr);	
															$this->db->query("update remitters set status = 'SUCCESS',insta_remitter_id=? where Id = ?",array($remitter_id,$insert_id));	
														}
														
													}
													else
													{
															$resp_arr = array(
																				"message"=>"Unknown Response",
																				"status"=>2,
																				"statuscode"=>"UNK",
																			);
														$json_resp =  json_encode($resp_arr);
														$this->db->query("update mt3_remitter_registration set status = 'FAILED',RESP_statuscode=?,RESP_status=? where Id = ?",array($statuscode,$status,$insert_id));
													}
													
												}
												else
												{
													$resp_arr = array(
																				"message"=>$status,
																				"status"=>1,
																				"statuscode"=>$statuscode,
																			);
													$json_resp =  json_encode($resp_arr);
													$this->db->query("update mt3_remitter_registration set status = 'FAILED',RESP_statuscode=?,RESP_status=? where Id = ?",array($statuscode,$status,$insert_id));
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
											$this->db->query("update mt3_remitter_registration set status = 'FAILED',RESP_statuscode=?,RESP_status=? where Id = ?",array("UNK","Internal Server Error",$insert_id));
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
		
		$this->loging("instapay_GetSenderRegisterOtp",$url." >> ".json_encode($req),$buffer,$json_resp,$userinfo->row(0)->username);
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
				
				if($usertype_name == "Agent" or $usertype_name == "APIUSER")
				{
					if($user_status == '1')
					{

						if($this->checkservice_activation($user_id) == false)
						{
							$resp_arr = array(
										"message"=>"Service Activation Failed. Contact Administrator",
										"status"=>10,
										"statuscode"=>"UNK",
									);
							$json_resp =  json_encode($resp_arr);
							return $json_resp;
						}

					    $rsltsender = $this->db->query("select * from remitters where mobile = ?  order by Id desc limit 1",array($mobile_no));
					    if($rsltsender->num_rows() == 1)
					    {
					        $remitterid = $rsltsender->row(0)->insta_remitter_id;
					        $pincode = $rsltsender->row(0)->pincode;
					        if(strlen($pincode != 6))
					        {
					            $pincode = 380001;
					        }
					        
					        


					        	$req_array = array(
										"token"	=>$this->getToken(),
										"request"=>array(
															"mobile"=>$mobile_no,
															"remitterid"=>$remitterid,
															"otp"=>$otp,
															"outletid"=>"3374"
														)
										);
										$postparam = json_encode($req_array);
										$req = $postparam;
										
										$url = $this->getLiveUrl("remitter_validate");
										$headers = array();
										$headers[] = 'Accept: application/json';
										$headers[] = 'Content-Type: application/json';
										
										$ch = curl_init();
										curl_setopt($ch,CURLOPT_URL,$url);
										curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
										curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
										curl_setopt($ch, CURLOPT_POST,1);
										curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
										curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
										curl_setopt($ch, CURLOPT_POSTFIELDS, $postparam);
										$buffer = curl_exec($ch);
										curl_close($ch);
										$json_obj = json_decode($buffer);
										
										if(isset($json_obj->statuscode) and isset($json_obj->status))
										{
												$statuscode = $json_obj->statuscode;
												$status = $json_obj->status;
												if($statuscode == "RNF")
												{
														$resp_arr = array(
																				"message"=>"Record Not Found",
																				"status"=>1,
																				"statuscode"=>"RNF",
																			);
														$json_resp =  json_encode($resp_arr);
														$this->db->query("update mt3_remitter_registration set status = 'FAILED',RESP_statuscode=?,RESP_status=? where Id = ?",array($statuscode,$status,$insert_id));
												}
												else if($statuscode == "TXN")
												{
													$data = $json_obj->data;
													if(isset($data->remitter))
													{
														$remitter = $data->remitter;
														$is_verified = $remitter->is_verified;
														$remitter_id = $remitter->id;
														if($is_verified == 1)
														{
															$resp_arr = array(
																			"message"=>$status,
																			"status"=>0,
																			"statuscode"=>"TXN",
																			"remitter_id"=>$remitter_id
																		);
															$json_resp =  json_encode($resp_arr);	
															$this->db->query("update remitters set otp_varified = 'yes',insta_verified = 1,status = 'SUCCESS' where mobile = ? ",array($mobile_no));
														}
														else
														{
															$resp_arr = array(
																			"message"=>$status,
																			"status"=>2,
																			"remitter_id"=>$remitter_id
																		);
															$json_resp =  json_encode($resp_arr);	
														}
														
													}
													else
													{
															$resp_arr = array(
																				"message"=>"Unknown Response",
																				"status"=>2,
																				"statuscode"=>"UNK",
																			);
														$json_resp =  json_encode($resp_arr);
														
													}
													
												}
												else
												{
													$resp_arr = array(
																				"message"=>$status,
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
		
		$this->loging("instapay_SenderRegistration",$url."?".json_encode($req),$buffer,$json_resp,$userinfo->row(0)->username);
		return $json_resp;
		
	}


	public function remitter_registration($mobile_no,$name,$pincode,$userinfo)
	{
		if($userinfo != NULL)
		{
			if($userinfo->num_rows() == 1)
			{
				$postparam=$mobile_no."  ".$name."  ".$pincode;
				
				$buffer = "Exception";
				$user_id = $userinfo->row(0)->user_id;
				$usertype_name = $userinfo->row(0)->usertype_name;
				$user_status = $userinfo->row(0)->status;
				if($usertype_name == "Agent"  or $usertype_name == "APIUSER")
				{
					if($user_status == '1')
					{
						if($this->checkservice_activation($user_id) == false)
						{
							$resp_arr = array(
										"message"=>"Service Activation Failed. Contact Administrator",
										"status"=>10,
										"statuscode"=>"UNK",
									);
							$json_resp =  json_encode($resp_arr);
							return $json_resp;
						}



						$rslt_checkremitter = $this->db->query("select * from remitters where mobile = ? and status = 'SUCCESS'",array(trim($mobile_no)));
						
						if($rslt_checkremitter->num_rows() == 0)
						{
								try
								{
									$rslt_insert = $this->db->query("insert into mt3_remitter_registration(user_id,add_date,ipaddress,mobile,name,pincode)
																values(?,?,?,?,?,?)",
																array(
																$user_id,$this->common->getDate(),$this->common->getRealIpAddr(),
																$mobile_no,$name,$pincode
																)
																);
									if($rslt_insert == TRUE)
									{
										
										$insert_id = $this->db->insert_id();
										$req_array = array(
										"token"	=>$this->getToken(),
										"request"=>array(
															"mobile"=>$mobile_no,
															"name"=>$name,
															"surname"=>"indian",
															"pincode"=>$pincode,
															"outletid"=>"3374"
														)
										);
										$postparam = json_encode($req_array);
										
										
										
										$headers = array();
										$headers[] = 'Accept: application/json';
										$headers[] = 'Content-Type: application/json';
										
										$ch = curl_init();
										curl_setopt($ch,CURLOPT_URL,$this->getLiveUrl("remitter_registration"));
										curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
										curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
										curl_setopt($ch, CURLOPT_POST,1);
										curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
										curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
										curl_setopt($ch, CURLOPT_POSTFIELDS, $postparam);
										$buffer = curl_exec($ch);
										curl_close($ch);
										$json_obj = json_decode($buffer);
										
										if(isset($json_obj->statuscode) and isset($json_obj->status))
										{
												$statuscode = $json_obj->statuscode;
												$status = $json_obj->status;
												if($statuscode == "RNF")
												{
														$resp_arr = array(
																				"message"=>"Record Not Found",
																				"status"=>1,
																				"statuscode"=>"RNF",
																			);
														$json_resp =  json_encode($resp_arr);
														$this->db->query("update mt3_remitter_registration set status = 'FAILED',RESP_statuscode=?,RESP_status=? where Id = ?",array($statuscode,$status,$insert_id));
												}
												else if($statuscode == "TXN")
												{
													$data = $json_obj->data;
													if(isset($data->remitter))
													{
														$remitter = $data->remitter;
														$is_verified = $remitter->is_verified;
														$remitter_id = $remitter->id;
														if($is_verified == 0)
														{
															$resp_arr = array(
																			"message"=>$status,
																			"status"=>0,
																			"remitter_id"=>$remitter_id
																		);
															$json_resp =  json_encode($resp_arr);	
															$this->db->query("update mt3_remitter_registration set status = 'SUCCESS',RESP_statuscode=?,RESP_status=?,remitter_id=? where Id = ?",array($statuscode,$status,$remitter_id,$insert_id));	
														}
														else
														{
															$resp_arr = array(
																			"message"=>$status,
																			"status"=>2,
																			"remitter_id"=>$remitter_id
																		);
															$json_resp =  json_encode($resp_arr);	
														}
														
													}
													else
													{
															$resp_arr = array(
																				"message"=>"Unknown Response",
																				"status"=>2,
																				"statuscode"=>"UNK",
																			);
														$json_resp =  json_encode($resp_arr);
														$this->db->query("update mt3_remitter_registration set status = 'FAILED',RESP_statuscode=?,RESP_status=? where Id = ?",array($statuscode,$status,$insert_id));
													}
													
												}
												else
												{
													$resp_arr = array(
																				"message"=>$status,
																				"status"=>1,
																				"statuscode"=>$statuscode,
																			);
													$json_resp =  json_encode($resp_arr);
													$this->db->query("update mt3_remitter_registration set status = 'FAILED',RESP_statuscode=?,RESP_status=? where Id = ?",array($statuscode,$status,$insert_id));
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
											$this->db->query("update mt3_remitter_registration set status = 'FAILED',RESP_statuscode=?,RESP_status=? where Id = ?",array("UNK","Internal Server Error",$insert_id));
										}
										
									}
									else
									{
										$resp_arr = array(
												"message"=>"Data Insertion Error",
												"status"=>11,
												"statuscode"=>"UNK",
											);
										$json_resp =  json_encode($resp_arr);
									}
								}
								catch(Exception $e)
								{
									$this->loging("remitter_registration","","Internal Exception","",$userinfo->row(0)->username);
									$resp_arr = array(
											"message"=>"Internal Server Error",
											"status"=>100,
											"statuscode"=>"UNK",
										);
									$json_resp =  json_encode($resp_arr);
								}
						}
						else
						{
							$remitter_id = $rslt_checkremitter->row(0)->remitter_id;
							$resp_arr = array(
												"message"=>"User Already Registered",
												"status"=>0,
												"remitter_id"=>$remitter_id
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
		
		
		$this->loging("remitter_registration",$postparam,$buffer,$json_resp,$userinfo->row(0)->username);
		return $json_resp;
	}



	public function remitter_registration_validate($mobile_no,$otp,$userinfo)
	{
		if($userinfo != NULL)
		{
			if($userinfo->num_rows() == 1)
			{
				$postparam=$mobile_no."  ".$name."  ".$pincode;
				
				$buffer = "Exception";
				$user_id = $userinfo->row(0)->user_id;
				$usertype_name = $userinfo->row(0)->usertype_name;
				$user_status = $userinfo->row(0)->status;
				if($usertype_name == "Agent"  or $usertype_name == "APIUSER")
				{
					if($user_status == '1')
					{
						if($this->checkservice_activation($user_id) == false)
						{
							$resp_arr = array(
										"message"=>"Service Activation Failed. Contact Administrator",
										"status"=>10,
										"statuscode"=>"UNK",
									);
							$json_resp =  json_encode($resp_arr);
							return $json_resp;
						}



						$rslt_checkremitter = $this->db->query("select * from mt3_remitter_registration where mobile = ? and status = 'SUCCESS'",array(trim($mobile_no)));
						
						if($rslt_checkremitter->num_rows() == 0)
						{
								try
								{
									$rslt_insert = $this->db->query("insert into mt3_remitter_registration(user_id,add_date,ipaddress,mobile,name,pincode)
																values(?,?,?,?,?,?)",
																array(
																$user_id,$this->common->getDate(),$this->common->getRealIpAddr(),
																$mobile_no,$name,$pincode
																)
																);
									if($rslt_insert == TRUE)
									{
										
										$insert_id = $this->db->insert_id();
										$req_array = array(
										"token"	=>$this->getToken(),
										"request"=>array(
															"mobile"=>$mobile_no,
															"remitterid"=>$remitterid,
															"otp"=>$otp,
															"outletid"=>"3374"
														)
										);
										$postparam = json_encode($req_array);
										
										
										
										$headers = array();
										$headers[] = 'Accept: application/json';
										$headers[] = 'Content-Type: application/json';
										
										$ch = curl_init();
										curl_setopt($ch,CURLOPT_URL,$this->getLiveUrl("remitter_validate"));
										curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
										curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
										curl_setopt($ch, CURLOPT_POST,1);
										curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
										curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
										curl_setopt($ch, CURLOPT_POSTFIELDS, $postparam);
										$buffer = curl_exec($ch);
										curl_close($ch);
										$json_obj = json_decode($buffer);
										
										if(isset($json_obj->statuscode) and isset($json_obj->status))
										{
												$statuscode = $json_obj->statuscode;
												$status = $json_obj->status;
												if($statuscode == "RNF")
												{
														$resp_arr = array(
																				"message"=>"Record Not Found",
																				"status"=>1,
																				"statuscode"=>"RNF",
																			);
														$json_resp =  json_encode($resp_arr);
														$this->db->query("update mt3_remitter_registration set status = 'FAILED',RESP_statuscode=?,RESP_status=? where Id = ?",array($statuscode,$status,$insert_id));
												}
												else if($statuscode == "TXN")
												{
													$data = $json_obj->data;
													if(isset($data->remitter))
													{
														$remitter = $data->remitter;
														$is_verified = $remitter->is_verified;
														$remitter_id = $remitter->id;
														if($is_verified == 1)
														{
															$resp_arr = array(
																			"message"=>$status,
																			"status"=>0,
																			"remitter_id"=>$remitter_id
																		);
															$json_resp =  json_encode($resp_arr);	
															$this->db->query("update mt3_remitter_registration set status = 'SUCCESS',RESP_statuscode=?,RESP_status=?,remitter_id=? where Id = ?",array($statuscode,$status,$remitter_id,$insert_id));	
														}
														else
														{
															$resp_arr = array(
																			"message"=>$status,
																			"status"=>2,
																			"remitter_id"=>$remitter_id
																		);
															$json_resp =  json_encode($resp_arr);	
														}
														
													}
													else
													{
															$resp_arr = array(
																				"message"=>"Unknown Response",
																				"status"=>2,
																				"statuscode"=>"UNK",
																			);
														$json_resp =  json_encode($resp_arr);
														$this->db->query("update mt3_remitter_registration set status = 'FAILED',RESP_statuscode=?,RESP_status=? where Id = ?",array($statuscode,$status,$insert_id));
													}
													
												}
												else
												{
													$resp_arr = array(
																				"message"=>$status,
																				"status"=>1,
																				"statuscode"=>$statuscode,
																			);
													$json_resp =  json_encode($resp_arr);
													$this->db->query("update mt3_remitter_registration set status = 'FAILED',RESP_statuscode=?,RESP_status=? where Id = ?",array($statuscode,$status,$insert_id));
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
											$this->db->query("update mt3_remitter_registration set status = 'FAILED',RESP_statuscode=?,RESP_status=? where Id = ?",array("UNK","Internal Server Error",$insert_id));
										}
										
									}
									else
									{
										$resp_arr = array(
												"message"=>"Data Insertion Error",
												"status"=>11,
												"statuscode"=>"UNK",
											);
										$json_resp =  json_encode($resp_arr);
									}
								}
								catch(Exception $e)
								{
									$this->loging("remitter_registration","","Internal Exception","",$userinfo->row(0)->username);
									$resp_arr = array(
											"message"=>"Internal Server Error",
											"status"=>100,
											"statuscode"=>"UNK",
										);
									$json_resp =  json_encode($resp_arr);
								}
						}
						else
						{
							$remitter_id = $rslt_checkremitter->row(0)->remitter_id;
							$resp_arr = array(
												"message"=>"User Already Registered",
												"status"=>0,
												"remitter_id"=>$remitter_id
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
		
		
		$this->loging("remitter_registration",$postparam,$buffer,$json_resp,$userinfo->row(0)->username);
		return $json_resp;
	}	
	
	
	
	public function beneficiary_register($mobile_no,$bene_name,$bene_mobile,$ifsc,$acc_no,$userinfo,$bank_id = 0)
	{

		// error_reporting(-1);
		// ini_set('display_errors',1);
		// $this->db->db_debug = TRUE;

		$buffer = "";
		$postparam = "";
		$json_resp = "";
		if($userinfo != NULL)
		{
			if($userinfo->num_rows() == 1)
			{
				
				$user_id = $userinfo->row(0)->user_id;
				$usertype_name = $userinfo->row(0)->usertype_name;
				$user_status = $userinfo->row(0)->status;
				if($usertype_name == "Agent"  or $usertype_name == "APIUSER")
				{
					if($user_status == '1')
					{

						if($this->checkservice_activation($user_id) == false)
						{
							$resp_arr = array(
										"message"=>"Service Activation Failed. Contact Administrator",
										"status"=>10,
										"statuscode"=>"UNK",
									);
							$json_resp =  json_encode($resp_arr);
							return $json_resp;
						}




						$insta_remitterid = false;

						$sender_info = $this->db->query("select * from remitters where mobile  = ?",array($mobile_no));
						if($sender_info->num_rows() == 1)
						{
							$insert_rslt = true;
							$insta_verified =  $sender_info->row(0)->insta_verified;
							$insta_remitter_id =  $sender_info->row(0)->insta_remitter_id;
							if($insta_remitter_id > 0)
							{
								$insta_remitterid = $insta_remitter_id;
							}
						}
						
						if($insta_remitterid != false)
						{
							$checkbeneexist = $this->db->query("select * from beneficiaries where sender_mobile = ? and account_number = ? and IFSC = ? order by Id desc limit 1",array($mobile_no,$acc_no,$ifsc));
							if($checkbeneexist->num_rows() ==  1)
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
												sender_mobile,insta_remitter_id,is_verified,paytm_bene_id,is_paytm,bank_name,dezire_bank_id,status
												) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?)",
												array($this->common->getRealIpAddr(),$this->common->getDate(),$bene_name,$acc_no,$ifsc,$bene_mobile,$mobile_no,$insta_remitterid,false,"",'no',"",$bank_id,"PENDING") );

								if($insertrslt == true)		
								{
									$insert_id = $this->db->insert_id();
									$req_array = array(
											"token"	=>$this->getToken(),
											"request"=>array(
																"remitterid"=>$insta_remitterid,
																"name"=>$bene_name,
																"mobile"=>$bene_mobile,
																"ifsc"=>$ifsc,
																"account"=>$acc_no,
															)
															);
											$postparam = json_encode($req_array);
											$req = $postparam;
											
											

											$url = $this->getLiveUrl("beneficiary_register");
											$headers = array();
											$headers[] = 'Accept: application/json';
											$headers[] = 'Content-Type: application/json';
											
											$ch = curl_init();
											curl_setopt($ch,CURLOPT_URL,$url);
											curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
											curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
											curl_setopt($ch, CURLOPT_POST,1);
											curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
											curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
											curl_setopt($ch, CURLOPT_POSTFIELDS, $postparam);
											$buffer = curl_exec($ch);
											curl_close($ch);
											$json_obj = json_decode($buffer);
											if(isset($json_obj->statuscode) and isset($json_obj->status))
											{
													$statuscode = $json_obj->statuscode;
													$status = $json_obj->status;
													if($statuscode == "RNF")
													{
															$resp_arr = array(
																					"message"=>"Record Not Found",
																					"status"=>1,
																					"statuscode"=>"RNF",
																				);
															$json_resp =  json_encode($resp_arr);
															$this->db->query("update beneficiaries 
																			set status = 'FAILED' where Id = ?",
																				array
																				(
																					$insert_id
																				)
																			);
													}
													else if($statuscode == "TXN")
													{
														$data = $json_obj->data;
														if(isset($data->remitter))
														{
															$remitter = $data->remitter;
															$remiterid = $remitter->id;
															
															$beneficiary = $data->beneficiary;
															$beneid = $beneficiary->id;
															$resp_arr = array(
																				"message"=>"Beneficiary Registration Successful",
																				"status"=>0,
																				"statuscode"=>"TXN",
																				"remiter_id"=>$remiterid,
																				"beneid"=>$beneid
																			);
															$json_resp =  json_encode($resp_arr);	
															$this->db->query("update beneficiaries 
																			set status = 'SUCCESS',
																				
																				insta_remitter_id = ?,
																				insta_bene_id = ?
																				where Id = ?",
																				array
																				(
																					$remiterid,
																					$beneid,
																					$insert_id
																				)
																			);
														}
														else
														{
																$resp_arr = array(
																					"message"=>"Unknown Response",
																					"status"=>1,
																					"statuscode"=>"UNK",
																				);
																$json_resp =  json_encode($resp_arr);
																$this->db->query("update beneficiaries 
																			set status = 'FAILED'
																				where Id = ?",
																				array
																				(
																					$insert_id
																				)
																			);
														}
														
													}
													else
													{

													}
											}
								}
								else
								{
									$resp_arr = array(
												"message"=>"Database Error",
												"status"=>1,
												"statuscode"=>"UNK",
											);
									$json_resp =  json_encode($resp_arr);
								}

							}	
						}	
						else
						{
							$resp_arr = array(
										"message"=>"Sender Not Registered",
										"status"=>1,
										"statuscode"=>"RNF",
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
									"status"=>1,
									"statuscode"=>"UNK",
								);
			$json_resp =  json_encode($resp_arr);
			
		}
		$this->loging("instapay_bene_register",$postparam,$buffer,$json_resp,$userinfo->row(0)->username);
		return $json_resp;
	
		
		
		
		
	}	
	
	
		
	
	
	
	public function beneficiary_register_validate($remitter_id,$bene_id,$otp,$userinfo)
	{
		if($userinfo != NULL)
		{
			if($userinfo->num_rows() == 1)
			{
				
				$user_id = $userinfo->row(0)->user_id;
				$usertype_name = $userinfo->row(0)->usertype_name;
				$user_status = $userinfo->row(0)->status;
				if($usertype_name == "Agent"  or $usertype_name == "APIUSER")
				{
					if($user_status == '1')
					{


						if($this->checkservice_activation($user_id) == false)
						{
							$resp_arr = array(
										"message"=>"Service Activation Failed. Contact Administrator",
										"status"=>10,
										"statuscode"=>"UNK",
									);
							$json_resp =  json_encode($resp_arr);
							return $json_resp;
						}




							$req_array = array(
							"token"	=>$this->getToken(),
							"request"=>array(
												"remitterid"=>$remitter_id,
												"beneficiaryid"=>$bene_id,
												"otp"=>$otp
											)
											);
							$postparam = json_encode($req_array);
							
							
							
							$headers = array();
							$headers[] = 'Accept: application/json';
							$headers[] = 'Content-Type: application/json';
							
							$ch = curl_init();
							curl_setopt($ch,CURLOPT_URL,$this->getLiveUrl("beneficiary_register_validate"));
							curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
							curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
							curl_setopt($ch, CURLOPT_POST,1);
							curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
							curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
							curl_setopt($ch, CURLOPT_POSTFIELDS, $postparam);
							$buffer = curl_exec($ch);
							curl_close($ch);
							$json_obj = json_decode($buffer);
							if(isset($json_obj->statuscode) and isset($json_obj->status))
							{
									$statuscode = $json_obj->statuscode;
									$status = $json_obj->status;
									$data = $json_obj->data;
									if($statuscode == "RNF")
									{
											$resp_arr = array(
																	"message"=>"Record Not Found",
																	"status"=>1,
																	"statuscode"=>"RNF",
																);
											$json_resp =  json_encode($resp_arr);
									}
									else if($statuscode == "TXN")
									{
										$data = $json_obj->data;
										
											
											$resp_arr = array(
																"message"=>"Beneficiary Validation Successful",
																"status"=>0,
															);
											$json_resp =  json_encode($resp_arr);	
											
											$this->db->query("update mt3_beneficiary_register_temp 
																		set validation_process = 'SUCCESS',
																			validation_datetime = ?
																			where 	RESP_beneficiary_id = ?",
																			array
																			(
																				$this->common->getDate(),
																				$bene_id
																			)
																		);
										
										
									}
									else
									{
										$resp_arr = array(
																"message"=>$status,
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
		$this->loging("beneficiary_register_validate",$postparam,$buffer,$json_resp,$userinfo->row(0)->username);
		echo $json_resp;exit;
		
	}
	
	
	
	
	
	
	public function verify_bene($mobile_no,$acc_no,$ifsc,$bank_id,$userinfo)
	{
	    
	   
	   // error_reporting(E_ALL);
	   // ini_set('display_errors',1);
	   // $this->db->db_debug = TRUE;


	   $url = $req = $buffer =$json_resp = "";

	   // echo $mobile_no."  ".$acc_no."  ".$ifsc."  ".$bank_id;exit;
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
						if($this->checkservice_activation($user_id) == false)
						{
							$resp_arr = array(
										"message"=>"Service Activation Failed. Contact Administrator",
										"status"=>10,
										"statuscode"=>"UNK",
									);
							$json_resp =  json_encode($resp_arr);
							return $json_resp;
						}





						$accval_resultcheck = $this->db->query("SELECT RESP_benename FROM `mt3_account_validate` where account_no = ? and remitter_mobile = ? and user_id = ? and status = 'SUCCESS'  order by Id desc limit 1",
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
							//echo $json_resp;exit;
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
    							$user_id,$this->common->getDate(),1,$this->common->getRealIpAddr(),$mobile_no,$mobile_no,$acc_no,$ifsc,"PENDING","INSTAPAY"
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
    								
    								
    								$req_array = array(
											"token"	=>$this->getToken(),
											"request"=>array(
																"remittermobile"=>$mobile_no,
																"account"=>$acc_no,
																"ifsc"=>$ifsc,
																"agentid"=>$insert_id,
															)
															);
											$postparam = json_encode($req_array);
											
											
											
											$headers = array();
											$headers[] = 'Accept: application/json';
											$headers[] = 'Content-Type: application/json';
											
											$ch = curl_init();
											curl_setopt($ch,CURLOPT_URL,$this->getLiveUrl("account_validate"));
											curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
											curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
											curl_setopt($ch, CURLOPT_POST,1);
											curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
											curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
											curl_setopt($ch, CURLOPT_POSTFIELDS, $postparam);
											$buffer = curl_exec($ch);
											curl_close($ch);
											$json_obj = json_decode($buffer);
											if(isset($json_obj->statuscode) and isset($json_obj->status))
											{
													$statuscode = $json_obj->statuscode;
													$status = $json_obj->status;
													$message = $json_obj->status;
													if($statuscode == "RNF")
													{
															$resp_arr = array(
																					"message"=>"Record Not Found",
																					"status"=>1,
																					"statuscode"=>"RNF",
																				);
															$json_resp =  json_encode($resp_arr);
															$this->db->query("update mt3_account_validate 
																						set RESP_statuscode = ?,
																							RESP_status = ?
																							where 	Id = ?",
																							array
																							(
																								$statuscode,
																								$status,
																								$insert_id
																							)
																						);
													}
													if($statuscode == "TXN")
		        									{
		        										$recipient_name = "";
		        										$data = $json_obj->data;
														if(isset($data->benename))
														{
															$recipient_name = $data->benename;
															$remarks = $data->remarks;
															$bankrefno = $data->bankrefno;
															$ipay_id = $data->ipay_id;
															$locked_amt = $data->locked_amt;
															$charged_amt = $data->charged_amt;
															$verification_status = $data->verification_status;
														}
		        									    
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
													else if($statuscode == "SPE" or $statuscode == "IAN" or $statuscode == "ERR"  or $statuscode == "ISE")
													{
														$transaction_type = "DMR";
														$sub_txn_type = "Account_Validation";
														$charge_amount = 3.00;
														$Description = "Account Validation Charge";
														$remark = $remittermobile."  Acc NO :".$benificiary_account_no;
														$debitpayment = $this->PAYMENT_CREDIT_ENTRY($user_id,$insert_id,$transaction_type,$charge_amount,$Description,$sub_txn_type,$remark,0,$userinfo);
														
														
														$resp_arr = array(
																					"message"=>$status,
																					"status"=>1,
																					"statuscode"=>$statuscode,
																				);
															$json_resp =  json_encode($resp_arr);
															$this->db->query("update mt3_account_validate 
																						set RESP_statuscode = ?,
																							RESP_status = ?,
																							status = 'FAILED'
																							where 	Id = ?",
																							array
																							(
																								$statuscode,
																								$status,
																								$insert_id
																							)
																						);
														
														
														
													}
													else
													{
															$resp_arr = array(
																					"message"=>$status,
																					"status"=>1,
																					"statuscode"=>$statuscode,
																				);
															$json_resp =  json_encode($resp_arr);
															$this->db->query("update mt3_account_validate 
																						set RESP_statuscode = ?,
																							RESP_status = ?
																							where 	Id = ?",
																							array
																							(
																								$statuscode,
																								$status,
																								$insert_id
																							)
																						);
													}
											}
											else
											{
												$resp_arr = array(
														"message"=>"Internal Server Error, Please Try Later",
														"status"=>10,
														"statuscode"=>"ERR",
													);
												$json_resp =  json_encode($resp_arr);
											}
    							}
    							else
    							{
    									$resp_arr = array(
												"message"=>"Payment Error",
												"status"=>1,
												"statuscode"=>"ERR",
											);
									$json_resp =  json_encode($resp_arr);
    							}
    							
    						}
    						else
    						{
    							$resp_arr = array(
											"message"=>"Database Error",
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
	public function account_validate($remitter_id,$remittermobile,$benificiary_account_no,$benificiary_ifsc,$userinfo)
	{
		
		$postparam = '';
		$buffer = "noapicall";
		if($userinfo != NULL)
		{
			if($userinfo->num_rows() == 1)
			{
				$user_id = $userinfo->row(0)->user_id;
				$usertype_name = $userinfo->row(0)->usertype_name;
				$user_status = $userinfo->row(0)->status;
				if($usertype_name == "Agent"  or $usertype_name == "APIUSER")
				{
					if($user_status == '1')
					{

						if($this->checkservice_activation($user_id) == false)
						{
							$resp_arr = array(
										"message"=>"Service Activation Failed. Contact Administrator",
										"status"=>10,
										"statuscode"=>"UNK",
									);
							$json_resp =  json_encode($resp_arr);
							return $json_resp;
						}


						$crnt_balance = $this->Common_methods->getAgentBalance($user_id);
						if($crnt_balance >= 10)
						{
							$rslt_checkremitter = $this->db->query("select * from mt3_remitter_registration where mobile = ? and remitter_id = ? and status = 'SUCCESS'",array(trim($remittermobile),trim($remitter_id)));
							if($rslt_checkremitter->num_rows() > 0)
							{
								
								
									
									$rsltaccinsert = $this->db->query("
														insert into mt3_account_validate
															(
																user_id,
																add_date,
																ipaddress,
																remitter_id,
																remitter_mobile,
																account_no,
																IFSC,
																bene_id
															) values(?,?,?,?,?,?,?,?)",
															array(
																$user_id,
																$this->common->getDate(),
																$this->common->getRealIpAddr(),
																$remitter_id,
																$remittermobile,
																$benificiary_account_no,
																$benificiary_ifsc,
																""
															));
									
									if($rsltaccinsert == true)
									{
										$insert_id = $this->db->insert_id();
										$transaction_type = "DMR";
										$sub_txn_type = "Account_Validation";
										$charge_amount = 3.00;
										$Description = "Account Validation Charge";
										$remark = $remittermobile."  Acc NO :".$benificiary_account_no;
										$debitpayment = $this->PAYMENT_DEBIT_ENTRY($user_id,$insert_id,$transaction_type,$charge_amount,$Description,$sub_txn_type,$remark,0,$userinfo);
										
										if($debitpayment == true)
										{
											$req_array = array(
											"token"	=>$this->getToken(),
											"request"=>array(
																"remittermobile"=>$remittermobile,
																"account"=>$benificiary_account_no,
																"ifsc"=>$benificiary_ifsc,
																"agentid"=>$insert_id,
															)
															);
											$postparam = json_encode($req_array);
											
											
											
											$headers = array();
											$headers[] = 'Accept: application/json';
											$headers[] = 'Content-Type: application/json';
											
											$ch = curl_init();
											curl_setopt($ch,CURLOPT_URL,$this->getLiveUrl("account_validate"));
											curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
											curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
											curl_setopt($ch, CURLOPT_POST,1);
											curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
											curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
											curl_setopt($ch, CURLOPT_POSTFIELDS, $postparam);
											$buffer = curl_exec($ch);
											curl_close($ch);
											$json_obj = json_decode($buffer);
											if(isset($json_obj->statuscode) and isset($json_obj->status))
											{
													$statuscode = $json_obj->statuscode;
													$status = $json_obj->status;
													if($statuscode == "RNF")
													{
															$resp_arr = array(
																					"message"=>"Record Not Found",
																					"status"=>1,
																					"statuscode"=>"RNF",
																				);
															$json_resp =  json_encode($resp_arr);
															$this->db->query("update mt3_account_validate 
																						set RESP_statuscode = ?,
																							RESP_status = ?
																							where 	Id = ?",
																							array
																							(
																								$statuscode,
																								$status,
																								$insert_id
																							)
																						);
													}
													else if($statuscode == "TXN")
													{
														$data = $json_obj->data;
														if(isset($data->benename))
														{
															$benename = $data->benename;
															$remarks = $data->remarks;
															$bankrefno = $data->bankrefno;
															$ipay_id = $data->ipay_id;
															$locked_amt = $data->locked_amt;
															$charged_amt = $data->charged_amt;
															$verification_status = $data->verification_status;
															
															
															$resp_arr = array(
																				"message"=>"Success",
																				"status"=>0,
																				"data"=>array(
																						"remarks"=>$remarks,
																						"benename"=>$benename,
																						"bankrefno"=>$bankrefno,
																						"brid"=>$ipay_id,
																						"locked_amt"=>$locked_amt,
																						"charged_amt"=>$charge_amount,
																						"verification_status"=>$verification_status,
																					"status"=>"SUCCESS"
																				)
																			);
															$json_resp =  json_encode($resp_arr);	
															
															$this->db->query("update mt3_account_validate 
																						set RESP_statuscode = ?,
																							RESP_status = ?,
																							RESP_benename = ?,
																							RESP_remarks = ?,
																							RESP_bankrefno = ?,
																							RESP_ipay_id = ?,
																							RESP_locked_amt = ?,
																							RESP_charged_amt = ?,
																							verification_status = ?
																							where 	Id = ?",
																							array
																							(
																								$statuscode,
																								$status,
																								$benename,
																								$remarks,
																								$bankrefno,
																								$ipay_id,
																								$locked_amt,
																								$charged_amt,
																								$verification_status,
																								$insert_id
																							)
																						);
															
															
															$this->db->query("update mt3_beneficiary_register_temp 
																						set verify_status = 'yes',
																							verify_datetime = ?,
																							verified_name = ?
																							where 	benificiary_account_no = ? and benificiary_ifsc = ? and RESP_remitter_id = ? ",
																							array
																							(
																								$this->common->getDate(),
																								$benename,
																								$benificiary_account_no,
																								$benificiary_ifsc,
																								$benificiary_ifsc,$remitter_id
																							)
																						);
															
															
														}
														else
														{
																$resp_arr = array(
																					"message"=>"Unknown Response",
																					"status"=>2,
																					"statuscode"=>"UNK",
																				);
															$json_resp =  json_encode($resp_arr);
															$this->db->query("update mt3_account_validate 
																						set RESP_statuscode = ?,
																							RESP_status = ?
																							where 	Id = ?",
																							array
																							(
																								$statuscode,
																								$status,
																								$insert_id
																							)
																						);
														}
														
													}
													else if($statuscode == "SPE" or $statuscode == "IAN" or $statuscode == "ERR"  or $statuscode == "ISE")
													{
														$transaction_type = "DMR";
														$sub_txn_type = "Account_Validation";
														$charge_amount = 3.00;
														$Description = "Account Validation Charge";
														$remark = $remittermobile."  Acc NO :".$benificiary_account_no;
														$debitpayment = $this->PAYMENT_CREDIT_ENTRY($user_id,$insert_id,$transaction_type,$charge_amount,$Description,$sub_txn_type,$remark,0,$userinfo);
														
														
														$resp_arr = array(
																					"message"=>$status,
																					"status"=>1,
																					"statuscode"=>$statuscode,
																				);
															$json_resp =  json_encode($resp_arr);
															$this->db->query("update mt3_account_validate 
																						set RESP_statuscode = ?,
																							RESP_status = ?,
																							status = 'FAILED'
																							where 	Id = ?",
																							array
																							(
																								$statuscode,
																								$status,
																								$insert_id
																							)
																						);
														
														
														
													}
													else
													{
															$resp_arr = array(
																					"message"=>$status,
																					"status"=>1,
																					"statuscode"=>$statuscode,
																				);
															$json_resp =  json_encode($resp_arr);
															$this->db->query("update mt3_account_validate 
																						set RESP_statuscode = ?,
																							RESP_status = ?
																							where 	Id = ?",
																							array
																							(
																								$statuscode,
																								$status,
																								$insert_id
																							)
																						);
													}
											}
											else
											{
												$resp_arr = array(
														"message"=>"Internal Server Error, Please Try Later",
														"status"=>10,
														"statuscode"=>"ERR",
													);
												$json_resp =  json_encode($resp_arr);
											}
										}
										else
										{
											$resp_arr = array(
												"message"=>"Payment Error",
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
										"message"=>"Remiter Not Found",
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
		$this->loging("account_validate",$postparam,$buffer,$json_resp,$userinfo->row(0)->username);
		echo $json_resp;exit;
		
		
		
		
	}	
	
	
	public function bene_account_validate2($remitter_id,$remittermobile,$benificiary_account_no,$benificiary_ifsc,$userinfo)
	{
		
		$postparam = '';
		$buffer = "noapicall";
		if($userinfo != NULL)
		{
			if($userinfo->num_rows() == 1)
			{
				$user_id = $userinfo->row(0)->user_id;
				$usertype_name = $userinfo->row(0)->usertype_name;
				$user_status = $userinfo->row(0)->status;
				if($usertype_name == "Agent"  or $usertype_name == "APIUSER")
				{
					if($user_status == '1')
					{

						if($this->checkservice_activation($user_id) == false)
						{
							$resp_arr = array(
										"message"=>"Service Activation Failed. Contact Administrator",
										"status"=>10,
										"statuscode"=>"UNK",
									);
							$json_resp =  json_encode($resp_arr);
							return $json_resp;
						}



						$crnt_balance = $this->Common_methods->getAgentBalance($user_id);
						if($crnt_balance >= 10)
						{
							$rslt_checkremitter = $this->db->query("select * from mt3_remitter_registration where mobile = ? and remitter_id = ? and status = 'SUCCESS'",array(trim($remittermobile),trim($remitter_id)));
							if($rslt_checkremitter->num_rows() > 0)
							{
								
								
									
									$rsltaccinsert = $this->db->query("
														insert into mt3_account_validate
															(
																user_id,
																add_date,
																ipaddress,
																remitter_id,
																remitter_mobile,
																account_no,
																IFSC,
																bene_id
															) values(?,?,?,?,?,?,?,?)",
															array(
																$user_id,
																$this->common->getDate(),
																$this->common->getRealIpAddr(),
																$remitter_id,
																$remittermobile,
																$benificiary_account_no,
																$benificiary_ifsc,
																""
															));
									
									if($rsltaccinsert == true)
									{
										$insert_id = $this->db->insert_id();
										$transaction_type = "DMR";
										$sub_txn_type = "Account_Validation";
										$charge_amount = 3.00;
										$Description = "Account Validation Charge";
										$remark = $remittermobile."  Acc NO :".$benificiary_account_no;
										$debitpayment = $this->PAYMENT_DEBIT_ENTRY($user_id,$insert_id,$transaction_type,$charge_amount,$Description,$sub_txn_type,$remark,0,$userinfo);
										
										if($debitpayment == true)
										{
											$req_array = array(
											"token"	=>$this->getToken(),
											"request"=>array(
																"remittermobile"=>$remittermobile,
																"account"=>$benificiary_account_no,
																"ifsc"=>$benificiary_ifsc,
																"agentid"=>$insert_id,
															)
															);
											$postparam = json_encode($req_array);
											
											
											
											$headers = array();
											$headers[] = 'Accept: application/json';
											$headers[] = 'Content-Type: application/json';
											
											$ch = curl_init();
											curl_setopt($ch,CURLOPT_URL,$this->getLiveUrl("account_validate"));
											curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
											curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
											curl_setopt($ch, CURLOPT_POST,1);
											curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
											curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
											curl_setopt($ch, CURLOPT_POSTFIELDS, $postparam);
											$buffer = curl_exec($ch);
											curl_close($ch);
											$json_obj = json_decode($buffer);
											if(isset($json_obj->statuscode) and isset($json_obj->status))
											{
													$statuscode = $json_obj->statuscode;
													$status = $json_obj->status;
													
													if($statuscode == "RNF")
													{
															$resp_arr = array(
																					"message"=>"Record Not Found",
																					"status"=>1,
																					"statuscode"=>"RNF",
																				);
															$json_resp =  json_encode($resp_arr);
															$this->db->query("update mt3_account_validate 
																						set RESP_statuscode = ?,
																							RESP_status = ?
																							where 	Id = ?",
																							array
																							(
																								$statuscode,
																								$status,
																								$insert_id
																							)
																						);
													}
													else if($statuscode == "TXN")
													{
														$data = $json_obj->data;
														if(isset($data->benename))
														{
															$benename = $data->benename;
															$remarks = $data->remarks;
															$bankrefno = $data->bankrefno;
															$ipay_id = $data->ipay_id;
															$locked_amt = $data->locked_amt;
															$charged_amt = $data->charged_amt;
															$verification_status = $data->verification_status;
															
															
															$resp_arr = array(
																				"message"=>"Success",
																				"status"=>0,
																				"data"=>array(
																						"remarks"=>$remarks,
																						"benename"=>$benename,
																						"bankrefno"=>$bankrefno,
																						"brid"=>$ipay_id,
																						"locked_amt"=>$locked_amt,
																						"charged_amt"=>$charge_amount,
																						"verification_status"=>$verification_status,
																				)
																			);
															$json_resp =  json_encode($resp_arr);	
															
															$this->db->query("update mt3_account_validate 
																						set RESP_statuscode = ?,
																							RESP_status = ?,
																							RESP_benename = ?,
																							RESP_remarks = ?,
																							RESP_bankrefno = ?,
																							RESP_ipay_id = ?,
																							RESP_locked_amt = ?,
																							RESP_charged_amt = ?,
																							verification_status = ?,
																							status = 'SUCCESS'
																							where 	Id = ?",
																							array
																							(
																								$statuscode,
																								$status,
																								$benename,
																								$remarks,
																								$bankrefno,
																								$ipay_id,
																								$locked_amt,
																								$charged_amt,
																								$verification_status,
																								$insert_id
																							)
																						);
															
															
															/*$this->db->query("update mt3_beneficiary_register_temp 
																						set verify_status = 'yes',
																							verify_datetime = ?,
																							verified_name = ?
																							where 	benificiary_account = ? and benificiary_ifsc = ? and RESP_remitter_id = ? ",
																							array
																							(
																								$this->common->getDate(),
																								$benename,
																								$benificiary_account_no,
																								$benificiary_ifsc,$remitter_id
																							)
																						);*/
															
															
														}
														else
														{
																$resp_arr = array(
																					"message"=>"Unknown Response",
																					"status"=>2,
																					"statuscode"=>"UNK",
																				);
															$json_resp =  json_encode($resp_arr);
															$this->db->query("update mt3_account_validate 
																						set RESP_statuscode = ?,
																							RESP_status = ?
																							where 	Id = ?",
																							array
																							(
																								$statuscode,
																								$status,
																								$insert_id
																							)
																						);
														}
														
													}
													else if($statuscode == "SPE" or $statuscode == "IAN" or $statuscode == "ERR"  or $statuscode == "ISE")
													{
														$transaction_type = "DMR";
														$sub_txn_type = "Account_Validation";
														$charge_amount = 3.00;
														$Description = "Account Validation Charge";
														$remark = $remittermobile."  Acc NO :".$benificiary_account_no;
														$debitpayment = $this->PAYMENT_CREDIT_ENTRY($user_id,$insert_id,$transaction_type,$charge_amount,$Description,$sub_txn_type,$remark,0,$userinfo);
														
														
														$resp_arr = array(
																					"message"=>$status,
																					"status"=>1,
																					"statuscode"=>$statuscode,
																				);
															$json_resp =  json_encode($resp_arr);
															$this->db->query("update mt3_account_validate 
																						set RESP_statuscode = ?,
																							RESP_status = ?,
																							status = 'FAILED'
																							where 	Id = ?",
																							array
																							(
																								$statuscode,
																								$status,
																								$insert_id
																							)
																						);
														
														
														
													}
													else
													{
															$resp_arr = array(
																					"message"=>$status,
																					"status"=>1,
																					"statuscode"=>$statuscode,
																				);
															$json_resp =  json_encode($resp_arr);
															$this->db->query("update mt3_account_validate 
																						set RESP_statuscode = ?,
																							RESP_status = ?
																							where 	Id = ?",
																							array
																							(
																								$statuscode,
																								$status,
																								$insert_id
																							)
																						);
													}
											}
											else
											{
												$resp_arr = array(
														"message"=>"Internal Server Error, Please Try Later",
														"status"=>10,
														"statuscode"=>"ERR",
													);
												$json_resp =  json_encode($resp_arr);
											}
										}
										else
										{
											$resp_arr = array(
												"message"=>"Payment Error",
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
										"message"=>"Remiter Not Found",
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
		$this->loging("account_validate2",$postparam,$buffer,$json_resp,$userinfo->row(0)->username);
		echo $json_resp;exit;
		
		
		
		
	}	
	
	
	public function account_validate2($remitter_id,$remittermobile,$benificiary_account_no,$benificiary_ifsc,$userinfo)
	{
		
		$postparam = '';
		$buffer = "noapicall";
		if($userinfo != NULL)
		{
			if($userinfo->num_rows() == 1)
			{
				$user_id = $userinfo->row(0)->user_id;
				$usertype_name = $userinfo->row(0)->usertype_name;
				$user_status = $userinfo->row(0)->status;
				if($usertype_name == "Agent"  or $usertype_name == "APIUSER")
				{
					if($user_status == '1')
					{
						if($this->checkservice_activation($user_id) == false)
						{
							$resp_arr = array(
										"message"=>"Service Activation Failed. Contact Administrator",
										"status"=>10,
										"statuscode"=>"UNK",
									);
							$json_resp =  json_encode($resp_arr);
							return $json_resp;
						}


						$crnt_balance = $this->Common_methods->getAgentBalance($user_id);
						if($crnt_balance >= 10)
						{
							$rslt_checkremitter = $this->db->query("select * from mt3_remitter_registration where mobile = ? and remitter_id = ? and status = 'SUCCESS' and API = 'INSTAPAY'",array(trim($remittermobile),trim($remitter_id)));
							if($rslt_checkremitter->num_rows() > 0)
							{
								
								
									
									$rsltaccinsert = $this->db->query("
														insert into mt3_account_validate
															(
																user_id,
																add_date,
																ipaddress,
																remitter_id,
																remitter_mobile,
																account_no,
																IFSC,
																bene_id
															) values(?,?,?,?,?,?,?,?)",
															array(
																$user_id,
																$this->common->getDate(),
																$this->common->getRealIpAddr(),
																$remitter_id,
																$remittermobile,
																$benificiary_account_no,
																$benificiary_ifsc,
																""
															));
									
									if($rsltaccinsert == true)
									{
										$insert_id = $this->db->insert_id();
										$transaction_type = "DMR";
										$sub_txn_type = "Account_Validation";
										$charge_amount = 5.00;
										$Description = "Account Validation Charge";
										$remark = $remittermobile."  Acc NO :".$benificiary_account_no;
										$debitpayment = $this->PAYMENT_DEBIT_ENTRY($user_id,$insert_id,$transaction_type,$charge_amount,$Description,$sub_txn_type,$remark,0,$userinfo);
										
										if($debitpayment == true)
										{
											$req_array = array(
											"token"	=>$this->getToken(),
											"request"=>array(
																"remittermobile"=>$remittermobile,
																"account"=>$benificiary_account_no,
																"ifsc"=>$benificiary_ifsc,
																"agentid"=>$insert_id,
															)
															);
											$postparam = json_encode($req_array);
											
											
											
											$headers = array();
											$headers[] = 'Accept: application/json';
											$headers[] = 'Content-Type: application/json';
											
											$ch = curl_init();
											curl_setopt($ch,CURLOPT_URL,$this->getLiveUrl("account_validate"));
											curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
											curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
											curl_setopt($ch, CURLOPT_POST,1);
											curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
											curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
											curl_setopt($ch, CURLOPT_POSTFIELDS, $postparam);
											$buffer = curl_exec($ch);
											curl_close($ch);
											$json_obj = json_decode($buffer);
											if(isset($json_obj->statuscode) and isset($json_obj->status))
											{
													$statuscode = $json_obj->statuscode;
													$status = $json_obj->status;
													if($statuscode == "RNF")
													{
															$resp_arr = array(
																					"message"=>"Record Not Found",
																					"status"=>1,
																					"statuscode"=>"RNF",
																				);
															$json_resp =  json_encode($resp_arr);
															$this->db->query("update mt3_account_validate 
																						set RESP_statuscode = ?,
																							RESP_status = ?
																							where 	Id = ?",
																							array
																							(
																								$statuscode,
																								$status,
																								$insert_id
																							)
																						);
													}
													else if($statuscode == "TXN")
													{
														$data = $json_obj->data;
														if(isset($data->benename))
														{
															$benename = $data->benename;
															$remarks = $data->remarks;
															$bankrefno = $data->bankrefno;
															$ipay_id = $data->ipay_id;
															$locked_amt = $data->locked_amt;
															$charged_amt = $data->charged_amt;
															$verification_status = $data->verification_status;
															
															
															$resp_arr = array(
																				"message"=>"Success",
																				"status"=>0,
																				"data"=>array(
																						"remarks"=>$remarks,
																						"benename"=>$benename,
																						"bankrefno"=>$bankrefno,
																						"brid"=>$ipay_id,
																						"locked_amt"=>$locked_amt,
																						"charged_amt"=>$charge_amount,
																						"verification_status"=>$verification_status,
																				)
																			);
															$json_resp =  json_encode($resp_arr);	
															
															$this->db->query("update mt3_account_validate 
																						set RESP_statuscode = ?,
																							RESP_status = ?,
																							RESP_benename = ?,
																							RESP_remarks = ?,
																							RESP_bankrefno = ?,
																							RESP_ipay_id = ?,
																							RESP_locked_amt = ?,
																							RESP_charged_amt = ?,
																							verification_status = ?,
																							status = 'SUCCESS'
																							where 	Id = ?",
																							array
																							(
																								$statuscode,
																								$status,
																								$benename,
																								$remarks,
																								$bankrefno,
																								$ipay_id,
																								$locked_amt,
																								$charged_amt,
																								$verification_status,
																								$insert_id
																							)
																						);
															
															
															/*$this->db->query("update mt3_beneficiary_register_temp 
																						set verify_status = 'yes',
																							verify_datetime = ?,
																							verified_name = ?
																							where 	benificiary_account = ? and benificiary_ifsc = ? and RESP_remitter_id = ? ",
																							array
																							(
																								$this->common->getDate(),
																								$benename,
																								$benificiary_account_no,
																								$benificiary_ifsc,$remitter_id
																							)
																						);*/
															
															
														}
														else
														{
																$resp_arr = array(
																					"message"=>"Unknown Response",
																					"status"=>2,
																					"statuscode"=>"UNK",
																				);
															$json_resp =  json_encode($resp_arr);
															$this->db->query("update mt3_account_validate 
																						set RESP_statuscode = ?,
																							RESP_status = ?
																							where 	Id = ?",
																							array
																							(
																								$statuscode,
																								$status,
																								$insert_id
																							)
																						);
														}
														
													}
													else if($statuscode == "SPE" or $statuscode == "IAN" or $statuscode == "ERR"  or $statuscode == "ISE")
													{
														$transaction_type = "DMR";
														$sub_txn_type = "Account_Validation";
														$charge_amount = 5.00;
														$Description = "Account Validation Charge";
														$remark = $remittermobile."  Acc NO :".$benificiary_account_no;
														$debitpayment = $this->PAYMENT_CREDIT_ENTRY($user_id,$insert_id,$transaction_type,$charge_amount,$Description,$sub_txn_type,$remark,0,$userinfo);
														
														
														$resp_arr = array(
																					"message"=>$status,
																					"status"=>1,
																					"statuscode"=>$statuscode,
																				);
															$json_resp =  json_encode($resp_arr);
															$this->db->query("update mt3_account_validate 
																						set RESP_statuscode = ?,
																							RESP_status = ?,
																							status = 'FAILED'
																							where 	Id = ?",
																							array
																							(
																								$statuscode,
																								$status,
																								$insert_id
																							)
																						);
														
														
														
													}
													else
													{
															$resp_arr = array(
																					"message"=>$status,
																					"status"=>1,
																					"statuscode"=>$statuscode,
																				);
															$json_resp =  json_encode($resp_arr);
															$this->db->query("update mt3_account_validate 
																						set RESP_statuscode = ?,
																							RESP_status = ?
																							where 	Id = ?",
																							array
																							(
																								$statuscode,
																								$status,
																								$insert_id
																							)
																						);
													}
											}
											else
											{
												$resp_arr = array(
														"message"=>"Internal Server Error, Please Try Later",
														"status"=>10,
														"statuscode"=>"ERR",
													);
												$json_resp =  json_encode($resp_arr);
											}
										}
										else
										{
											$resp_arr = array(
												"message"=>"Payment Error",
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
										"message"=>"Remiter Not Found",
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
		$this->loging("account_validate2",$postparam,$buffer,$json_resp,$userinfo->row(0)->username);
		echo $json_resp;exit;
		
		
		
		
	}	
	public function beneficiary_remove($remitter_id,$bene_id,$userinfo)
	{
		if($userinfo != NULL)
		{
			if($userinfo->num_rows() == 1)
			{
				
				$user_id = $userinfo->row(0)->user_id;
				$usertype_name = $userinfo->row(0)->usertype_name;
				$user_status = $userinfo->row(0)->status;
				if($usertype_name == "Agent"  or $usertype_name == "APIUSER")
				{
					if($user_status == '1')
					{

						if($this->checkservice_activation($user_id) == false)
						{
							$resp_arr = array(
										"message"=>"Service Activation Failed. Contact Administrator",
										"status"=>10,
										"statuscode"=>"UNK",
									);
							$json_resp =  json_encode($resp_arr);
							return $json_resp;
						}

							$req_array = array(
							"token"	=>$this->getToken(),
							"request"=>array(
												"remitterid"=>$remitter_id,
												"beneficiaryid"=>$bene_id
											)
											);
							$postparam = json_encode($req_array);
							
							
							
							$headers = array();
							$headers[] = 'Accept: application/json';
							$headers[] = 'Content-Type: application/json';
							
							$ch = curl_init();
							curl_setopt($ch,CURLOPT_URL,$this->getLiveUrl("beneficiary_remove"));
							curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
							curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
							curl_setopt($ch, CURLOPT_POST,1);
							curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
							curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
							curl_setopt($ch, CURLOPT_POSTFIELDS, $postparam);
							$buffer = curl_exec($ch);
							curl_close($ch);
							
							$json_obj = json_decode($buffer);
							if(isset($json_obj->statuscode) and isset($json_obj->status))
							{
									$statuscode = $json_obj->statuscode;
									$status = $json_obj->status;
									if($statuscode == "RNF")
									{
											$resp_arr = array(
																	"message"=>"Record Not Found",
																	"status"=>1,
																	"statuscode"=>"RNF",
																);
											$json_resp =  json_encode($resp_arr);
									}
									else if($statuscode == "TXN")
									{
										$resp_arr = array(
															"message"=>"Otp Sent To Registered Mobile Number",
															"status"=>0,
															"remiter_id"=>$remitter_id,
															"beneid"=>$bene_id,
														);
										$json_resp =  json_encode($resp_arr);	
									}
									else
									{
										$resp_arr = array(
																"message"=>$status,
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
		$this->loging("beneficiary_remove",$postparam,$buffer,$json_resp,$userinfo->row(0)->username);
		echo $json_resp;exit;
	
	}	
	
	
	
	
	public function beneficiary_remove_validate($remitter_id,$bene_id,$otp,$userinfo)
	{
		if($userinfo != NULL)
		{
			if($userinfo->num_rows() == 1)
			{
				
				$user_id = $userinfo->row(0)->user_id;
				$usertype_name = $userinfo->row(0)->usertype_name;
				$user_status = $userinfo->row(0)->status;
				if($usertype_name == "Agent"  or $usertype_name == "APIUSER")
				{
					if($user_status == '1')
					{
						if($this->checkservice_activation($user_id) == false)
						{
							$resp_arr = array(
										"message"=>"Service Activation Failed. Contact Administrator",
										"status"=>10,
										"statuscode"=>"UNK",
									);
							$json_resp =  json_encode($resp_arr);
							return $json_resp;
						}




							$req_array = array(
							"token"	=>$this->getToken(),
							"request"=>array(
												"remitterid"=>$remitter_id,
												"beneficiaryid"=>$bene_id,
												"otp"=>$otp
											)
											);
							$postparam = json_encode($req_array);
							
							
							
							$headers = array();
							$headers[] = 'Accept: application/json';
							$headers[] = 'Content-Type: application/json';
							
							$ch = curl_init();
							curl_setopt($ch,CURLOPT_URL,$this->getLiveUrl("beneficiary_remove_validate"));
							curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
							curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
							curl_setopt($ch, CURLOPT_POST,1);
							curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
							curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
							curl_setopt($ch, CURLOPT_POSTFIELDS, $postparam);
							$buffer = curl_exec($ch);
							curl_close($ch);
						//	$this->loging("beneficiary_remove_validate",$postparam,$buffer,$userinfo->row(0)->username);
							$json_obj = json_decode($buffer);
							if(isset($json_obj->statuscode) and isset($json_obj->status))
							{
									$statuscode = $json_obj->statuscode;
									$status = $json_obj->status;
									$data = $json_obj->data;
									if($statuscode == "RNF")
									{
											$resp_arr = array(
																	"message"=>"Record Not Found",
																	"status"=>1,
																	"statuscode"=>"RNF",
																);
											$json_resp =  json_encode($resp_arr);
									}
									else if($statuscode == "TXN")
									{
										$data = $json_obj->data;
										
										$resp_arr = array(
															"message"=>"Beneficiary Deleted Successfully",
															"status"=>0,
															"statuscode"=>$statuscode,
														);
										$json_resp =  json_encode($resp_arr);	
										$this->db->query("update mt3_beneficiary_register_temp 
																		set status = 'REMOVED',
																			remove_datetime = ?
																			where 	RESP_beneficiary_id = ?",
																			array
																			(
																				$this->common->getDate(),
																				$bene_id
																			)
																		);		
										
									}
									else
									{
										if($status == "Invalid Beneficiary")
										{
											
												$this->db->query("update mt3_beneficiary_register_temp 
																		set status = 'REMOVED',
																			remove_datetime = ?
																			where 	RESP_beneficiary_id = ?",
																			array
																			(
																				$this->common->getDate(),
																				$bene_id
																			)
																		);		
										}
										
										$resp_arr = array(
															"message"=>$status,
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
		$this->loging("beneficiary_remove_validate",$postparam,$buffer,$json_resp,$userinfo->row(0)->username);
		echo $json_resp;exit;
			
	}	
	
	
	public function transfer2($remittermobile,$beneficiaryid,$amount,$mode,$userinfo,$unique_id,$done_by,$bank_id,$whole_amount,$order_id = 0)
	{
	    
		$req = $buffer = $json_resp = "";


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
        				if($usertype_name == "Agent" or $usertype_name == "APIUSER")
        				{

        					if($this->checkservice_activation($user_id) == false)
							{
								$resp_arr = array(
											"message"=>"Service Activation Failed. Contact Administrator",
											"status"=>10,
											"statuscode"=>"UNK",
										);
								$json_resp =  json_encode($resp_arr);
								return $json_resp;
							}


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
        						
        								
        							$insta_remitterid = false;

									$sender_info = $this->db->query("select * from remitters where mobile  = ?",array($mobile_no));
									if($sender_info->num_rows() == 1)
									{
										$insert_rslt = true;
										$insta_verified =  $sender_info->row(0)->insta_verified;
										$insta_remitter_id =  $sender_info->row(0)->insta_remitter_id;
										if($insta_remitter_id > 0)
										{
											$insta_remitterid = $insta_remitter_id;
										}
									}
									
									if($insta_remitterid != false)
									{
										$checkbeneexist = $this->db->query("select bene_name,benemobile,IFSC,account_number from beneficiaries 
        																	where insta_remitter_id  = ? and insta_bene_id  = ?",
        																	array($insta_remitterid,$beneficiaryid));
        								// echo "resp here : ";
        								// print_r($checkbeneexist->result());exit;
        								if($checkbeneexist->num_rows() >= 1)
        								{
        									$benificiary_name = $checkbeneexist->row(0)->bene_name;
        									$benificiary_mobile = $checkbeneexist->row(0)->benemobile;
        									$benificiary_ifsc = $checkbeneexist->row(0)->IFSC;
        									$benificiary_account_no = $checkbeneexist->row(0)->account_number;
        									
        									
        									$chargeinfo = $this->getChargeValue($userinfo,$amount);
        								
        									$dist_charge_type = "AMOUNT";
        									$dist_charge_value = "0";
        									$dist_charge_amount="0";
        
        
                                            
                                            if(true)
                                            {
                                                	//if($userinfo->row(0)->usertype_name == "APIUSER")
                                            		if(false)
                									{
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
                											mode,order_id,unique_id,API,done_by,ccf,cashback,tds,bank_id)
                											values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)
                											",array($this->common->getDate(),$this->common->getRealIpAddr(),$user_id,$DId,$MdId,
                											$Charge_type,$charge_value,$Charge_Amount,
                											$dist_charge_type,$dist_charge_value,$dist_charge_amount,
                											$remittermobile,$insta_remitterid,
                											$beneficiaryid,$benificiary_account_no,$benificiary_ifsc,
                											$amount,"PENDING",$mode,$order_id,$unique_id,"INSTAPAY",$done_by,$ccf,$cashback,$tds,$bank_id
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
                    											$req_array = array(
														"token"	=>$this->getToken(),
														"request"=>array(
																			"remittermobile"=>$remittermobile,
																			"beneficiaryid"=>$beneficiaryid,
																			"agentid"=>$insert_id,
																			"amount"=>$amount,
																			"mode"=>$mode,
																		)
																		);
														$postparam = json_encode($req_array);

														$req = $postparam;
														$url =  $this->getLiveUrl("transfer");
														$headers = array();
														$headers[] = 'Accept: application/json';
														$headers[] = 'Content-Type: application/json';

														$ch = curl_init();
														curl_setopt($ch,CURLOPT_URL,$url);
														curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
														curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
														curl_setopt($ch, CURLOPT_POST,1);
														curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
														curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
														curl_setopt($ch, CURLOPT_POSTFIELDS, $postparam);
														$buffer = curl_exec($ch);
														curl_close($ch);

														$json_resp = "";
														$this->loging("instapay_transfer","1>>>".$url."?".json_encode($req),$buffer,$json_resp,$userinfo->row(0)->username);


														$json_obj = json_decode($buffer);




														if(isset($json_obj->statuscode) and isset($json_obj->status))
														{
																$statuscode = $json_obj->statuscode;
																$status = $json_obj->status;
																$message = $status;
																if($statuscode == "RNF")
																{
																		//check status befor refund
																		$this->PAYMENT_CREDIT_ENTRY($user_id,$insert_id,$transaction_type,$dr_amount,$Description,$sub_txn_type,$remark,$Charge_Amount,$userinfo);

																		$data = array(
																				'RESP_statuscode' => $statuscode,
																				'RESP_status' => $status,
																				'Status'=>'FAILURE'
																		);

																		$this->db->where('Id', $insert_id);
																		$this->db->update('mt3_transfer', $data);
																		$resp_arr = array(
																								"message"=>"Record Not Found",
																								"status"=>1,
																								"statuscode"=>"RNF",
																							);
																		$json_resp =  json_encode($resp_arr);

																}
																else if($statuscode == "TXN")
																{
																	$data = $json_obj->data;
																	if(isset($data->ipay_id))
																	{
																		$ipay_id = $data->ipay_id;
																		$ref_no = $data->ref_no;
																		$opr_id = $data->opr_id;
																		$name = $data->name;
																		$recipient_name = $name;
																		$opening_bal = $data->opening_bal;
																		$amount = $data->amount;
																		$locked_amt = $data->locked_amt;





																		$data = array(
    																				'RESP_statuscode' => "TXN",
    																				'RESP_status' => $message,
    																				'RESP_ipay_id' => $ipay_id,
    																				'RESP_ref_no' => $ipay_id,
    																				'RESP_opr_id' => $opr_id,
    																				'RESP_name' => $recipient_name,
    																				'Status'=>'SUCCESS',
    																				'edit_date'=>$this->common->getDate()
    																		);
    
    																		$this->db->where('Id', $insert_id);
    																		$this->db->update('mt3_transfer', $data);


    																	$resp_arr = array(
    																							"message"=>$message,
    																							"status"=>0,
    																							"statuscode"=>"TXN",
    																							"data"=>array(
    																								"tid"=>$ipay_id,
    																								"ref_no"=>$ipay_id,
    																								"opr_id"=>$opr_id,
    																								"name"=>$recipient_name,
    																								"balance"=>0,
    																								"amount"=>$amount,
    
    																							)
    																						);
    																		$json_resp =  json_encode($resp_arr);
																	}

																}


																


																else if($statuscode == "TUP")
																{

																	$data = $json_obj->data;
																	if(isset($data->ipay_id))
																	{
																		$ipay_id = $data->ipay_id;
																		$ref_no = $data->ref_no;
																		$opr_id = $data->opr_id;
																		$name = $data->name;
																		$opening_bal = $data->opening_bal;
																		$amount = $data->amount;
																		$locked_amt = $data->locked_amt;


																		
																		$data = array(
																				'RESP_ipay_id' => $ipay_id,
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

																}

																else if($statuscode == "SPE")
																{
																		//check status befor refund
																		$this->PAYMENT_CREDIT_ENTRY($user_id,$insert_id,$transaction_type,$dr_amount,$Description,$sub_txn_type,$remark,$Charge_Amount,$userinfo);	

																		$data = array(
																				'RESP_statuscode' => $statuscode,
																				'RESP_status' => $status,
																				'Status'=>'FAILURE'
																		);

																		$this->db->where('Id', $insert_id);
																		$this->db->update('mt3_transfer', $data);
																		$resp_arr = array(
																								"message"=>$status,
																								"status"=>1,
																								"statuscode"=>$statuscode,
																							);
																		$json_resp =  json_encode($resp_arr);

																}
																else if($statuscode == "SPD")
																{
																		//check status befor refund
																		$this->PAYMENT_CREDIT_ENTRY($user_id,$insert_id,$transaction_type,$dr_amount,$Description,$sub_txn_type,$remark,$Charge_Amount,$userinfo);	

																		$data = array(
																				'RESP_statuscode' => $statuscode,
																				'RESP_status' => $status,
																				'Status'=>'FAILURE'
																		);

																		$this->db->where('Id', $insert_id);
																		$this->db->update('mt3_transfer', $data);
																		$resp_arr = array(
																								"message"=>$status,
																								"status"=>1,
																								"statuscode"=>$statuscode,
																							);
																		$json_resp =  json_encode($resp_arr);

																}
																else if($statuscode == "IAB")
																{
																		//check status befor refund
																		$this->PAYMENT_CREDIT_ENTRY($user_id,$insert_id,$transaction_type,$dr_amount,$Description,$sub_txn_type,$remark,$Charge_Amount,$userinfo);	

																		$data = array(
																				'RESP_statuscode' => $statuscode,
																				'RESP_status' => "Internal Server Error. Please Try Later...",
																				'Status'=>'FAILURE',
																				'reason'=>$status
																		);

																		$this->db->where('Id', $insert_id);
																		$this->db->update('mt3_transfer', $data);
																		$resp_arr = array(
																								"message"=>$status,
																								"status"=>1,
																								"statuscode"=>$statuscode,
																							);
																		$json_resp =  json_encode($resp_arr);

																}
																else if($statuscode == "IAN")
																{
																		//check status befor refund
																		$this->PAYMENT_CREDIT_ENTRY($user_id,$insert_id,$transaction_type,$dr_amount,$Description,$sub_txn_type,$remark,$Charge_Amount,$userinfo);	

																		$data = array(
																				'RESP_statuscode' => $statuscode,
																				'RESP_status' => $status,
																				'Status'=>'FAILURE',
																				'reason'=>$status
																		);

																		$this->db->where('Id', $insert_id);
																		$this->db->update('mt3_transfer', $data);
																		$resp_arr = array(
																								"message"=>$status,
																								"status"=>1,
																								"statuscode"=>$statuscode,
																							);
																		$json_resp =  json_encode($resp_arr);

																}
																else if($statuscode == "ERR")
																{
																		//check status befor refund
																		$this->PAYMENT_CREDIT_ENTRY($user_id,$insert_id,$transaction_type,$dr_amount,$Description,$sub_txn_type,$remark,$Charge_Amount,$userinfo);	

																		$data = array(
																				'RESP_statuscode' => $statuscode,
																				'RESP_status' => $status,
																				'Status'=>'FAILURE',
																				'reason'=>$status
																		);



																		$this->db->where('Id', $insert_id);
																		$this->db->update('mt3_transfer', $data);
																		$resp_arr = array(
																								"message"=>$status,
																								"status"=>1,
																								"statuscode"=>$statuscode,
																							);
																		$json_resp =  json_encode($resp_arr);

																}
																else 
																{

																		$data = array(
																					'RESP_statuscode' => $statuscode,
																					'RESP_status' => "2",
																					'Status'=>'PENDING'
																		);

																		$this->db->where('Id', $insert_id);
																		$this->db->update('mt3_transfer', $data);
																		$resp_arr = array(
																								"message"=>$status,
																								"status"=>0,
																								"statuscode"=>$statuscode,
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
		$this->loging("instapay_transfer","1>>>".$url."?".json_encode($req),$buffer,$json_resp,$userinfo->row(0)->username);
		return $json_resp;
		
	}
	public function transfer($remittermobile,$beneficiaryid,$amount,$mode,$userinfo,$unique_id,$order_id = 0)
	{
		$postparam = $remittermobile." <> ".$beneficiaryid." <> ".$amount." <> ".$mode;
		$buffer = "No Api Call";
		if($userinfo != NULL)
		{
			if($userinfo->num_rows() == 1)
			{
				
				$user_id = $userinfo->row(0)->user_id;
				$DId = $userinfo->row(0)->parentid;
				$MdId = 0;
				$usertype_name = $userinfo->row(0)->usertype_name;
				$user_status = $userinfo->row(0)->status;
				if($usertype_name == "Agent"  or $usertype_name == "APIUSER")
				{
					$parentinfo = $this->db->query("select * from tblusers where user_id = ?",array($DId));
					if($parentinfo->num_rows() == 1)
					{
							$MdId = $parentinfo->row(0)->parentid;
					}
					if($user_status == '1')
					{
						
						if($this->checkservice_activation($user_id) == false)
						{
							$resp_arr = array(
										"message"=>"Service Activation Failed. Contact Administrator",
										"status"=>10,
										"statuscode"=>"UNK",
									);
							$json_resp =  json_encode($resp_arr);
							return $json_resp;
						}



						
						$crntBalance = $this->Common_methods->getAgentBalance($user_id);
						if(floatval($crntBalance) >= floatval($amount) + 20)
						{
							
							
							$wholeamount_rslt = $this->db->query("select * from mt3_uniquetxnId where Id = ?",array($unique_id));
							if($wholeamount_rslt->num_rows() == 1)
							{
								$whole_amount = $wholeamount_rslt->row(0)->whole_amount;
								$checkremitter = $this->db->query("select * from mt3_remitter_registration where mobile = ? and status = 'SUCCESS'",array(trim($remittermobile)));
								if($checkremitter->num_rows() >= 1)
								{
									$remitter_id = $checkremitter->row(0)->remitter_id;
									$checkbeneexist = $this->db->query("select * from mt3_beneficiary_register_temp 
																		where remitterid = ? and RESP_beneficiary_id = ? and status = 'SUCCESS'",
																		array($remitter_id,$beneficiaryid));
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
											$Charge_type = $chargeinfo->row(0)->charge_type;
											$charge_value = $chargeinfo->row(0)->charge_value;
											if($Charge_type == "PER")
											{
												$Charge_Amount = ((floatval($charge_value) * floatval($amount))/ 100); 
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
											mode,unique_id,order_id)
											values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)
											",array($this->common->getDate(),$this->common->getRealIpAddr(),$user_id,$DId,$MdId,
											$Charge_type,$charge_value,$Charge_Amount,$dist_charge_type,$dist_charge_value,$dist_charge_amount,
											$remittermobile,$remitter_id,
											$beneficiaryid,$benificiary_account_no,$benificiary_ifsc,
											$amount,"PENDING",$mode,$unique_id,$order_id
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
												
												
												$rsltcommon = $this->db->query("select * from common where param = 'DMRHOLD'");
												if($rsltcommon->num_rows() == 1)
												{
													$is_hold = $rsltcommon->row(0)->value;
													if($is_hold == 1)
													{
														$this->db->query("update mt3_transfer set Status = 'HOLD' where Id = ?",array($insert_id));
														$resp_arr = array(
																								"message"=>"Transaction Under Process",
																								"status"=>0,
																								"statuscode"=>"TUP",
																							);
																		$json_resp =  json_encode($resp_arr);
													}
													else
													{
														$req_array = array(
														"token"	=>$this->getToken(),
														"request"=>array(
																			"remittermobile"=>$remittermobile,
																			"beneficiaryid"=>$beneficiaryid,
																			"agentid"=>$insert_id,
																			"amount"=>$amount,
																			"mode"=>$mode,
																		)
																		);
														$postparam = json_encode($req_array);



														$headers = array();
														$headers[] = 'Accept: application/json';
														$headers[] = 'Content-Type: application/json';

														$ch = curl_init();
														curl_setopt($ch,CURLOPT_URL,$this->getLiveUrl("transfer"));
														curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
														curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
														curl_setopt($ch, CURLOPT_POST,1);
														curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
														curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
														curl_setopt($ch, CURLOPT_POSTFIELDS, $postparam);
														$buffer = curl_exec($ch);
														curl_close($ch);
														$json_obj = json_decode($buffer);
														if(isset($json_obj->statuscode) and isset($json_obj->status))
														{
																$statuscode = $json_obj->statuscode;
																$status = $json_obj->status;
																if($statuscode == "RNF")
																{
																		//check status befor refund
																		$this->PAYMENT_CREDIT_ENTRY($user_id,$insert_id,$transaction_type,$dr_amount,$Description,$sub_txn_type,$remark,$Charge_Amount,$userinfo);

																		$data = array(
																				'RESP_statuscode' => $statuscode,
																				'RESP_status' => $status,
																				'Status'=>'FAILURE'
																		);

																		$this->db->where('Id', $insert_id);
																		$this->db->update('mt3_transfer', $data);
																		$resp_arr = array(
																								"message"=>"Record Not Found",
																								"status"=>1,
																								"statuscode"=>"RNF",
																							);
																		$json_resp =  json_encode($resp_arr);

																}
																else if($statuscode == "TXN")
																{
																	$data = $json_obj->data;
																	if(isset($data->ipay_id))
																	{
																		$ipay_id = $data->ipay_id;
																		$ref_no = $data->ref_no;
																		$opr_id = $data->opr_id;
																		$name = $data->name;
																		$opening_bal = $data->opening_bal;
																		$amount = $data->amount;
																		$locked_amt = $data->locked_amt;


																		$data = array(
																				'RESP_statuscode' => $statuscode,
																				'RESP_status' => $status,
																				'RESP_ipay_id' => $ipay_id,
																				'RESP_ref_no' => $ref_no,
																				'RESP_opr_id' => $opr_id,
																				'RESP_name' => $name,
																				'RESP_opening_bal' => $opening_bal,
																				'RESP_amount' => $amount,
																				'RESP_locked_amt' => $locked_amt,
																				"row_lock"=>"LOCKED",
																				'Status'=>'SUCCESS'
																		);

																		$this->db->where('Id', $insert_id);
																		$this->db->update('mt3_transfer', $data);
																		$resp_arr = array(
																							"message"=>"Transaction Done Successfully. Ref Id :".$ref_no,
																							"status"=>0,
																							"data"=>array(
																								"brid"=>$ipay_id,
																								"ref_no"=>$ref_no,
																								"opr_id"=>$opr_id,
																								"name"=>$name,
																								"amount"=>$amount,
																								"locked_amt"=>$locked_amt,

																							)
																						);
																		$json_resp =  json_encode($resp_arr);	
																	}
																	else
																	{
																			$data = array(
																				'RESP_statuscode' => $statuscode,
																				'RESP_status' => $status,
																				'Status'=>'FAILED'
																			);

																			$this->db->where('Id', $insert_id);
																			$this->db->update('mt3_transfer', $data);
																			$resp_arr = array(
																								"message"=>"Unknown Response",
																								"status"=>2,
																								"statuscode"=>"UNK",
																							);
																		$json_resp =  json_encode($resp_arr);
																	}

																}
																else if($statuscode == "TUP")
																{

																	$data = $json_obj->data;
																	if(isset($data->ipay_id))
																	{
																		$ipay_id = $data->ipay_id;
																		$ref_no = $data->ref_no;
																		$opr_id = $data->opr_id;
																		$name = $data->name;
																		$opening_bal = $data->opening_bal;
																		$amount = $data->amount;
																		$locked_amt = $data->locked_amt;


																		$data = array(
																				'RESP_statuscode' => $statuscode,
																				'RESP_status' => $status,
																				'RESP_ipay_id' => $ipay_id,
																				'RESP_ref_no' => $ref_no,
																				'RESP_opr_id' => $opr_id,
																				'RESP_name' => $name,
																				'RESP_opening_bal' => $opening_bal,
																				'RESP_amount' => $amount,
																				'RESP_locked_amt' => $locked_amt,
																				"row_lock"=>"LOCKED",
																				'Status'=>'PENDING'
																		);

																		$this->db->where('Id', $insert_id);
																		$this->db->update('mt3_transfer', $data);
																		$resp_arr = array(
																							"message"=>"Transaction Under Process Ref Id :".$ref_no,
																							"status"=>0,
																							"data"=>array(
																								"brid"=>$ipay_id,
																								"ref_no"=>$ref_no,
																								"opr_id"=>$opr_id,
																								"name"=>$name,
																								"amount"=>$amount,
																								"locked_amt"=>$locked_amt,

																							)
																						);
																		$json_resp =  json_encode($resp_arr);	
																	}
																	else
																	{
																			$data = array(
																				'RESP_statuscode' => $statuscode,
																				'RESP_status' => $status,
																				'Status'=>'FAILED'
																			);

																			$this->db->where('Id', $insert_id);
																			$this->db->update('mt3_transfer', $data);
																			$resp_arr = array(
																								"message"=>"Unknown Response",
																								"status"=>2,
																								"statuscode"=>"UNK",
																							);
																		$json_resp =  json_encode($resp_arr);
																	}

																}

																else if($statuscode == "SPE")
																{
																		//check status befor refund
																		$this->PAYMENT_CREDIT_ENTRY($user_id,$insert_id,$transaction_type,$dr_amount,$Description,$sub_txn_type,$remark,$Charge_Amount,$userinfo);

																		$data = array(
																				'RESP_statuscode' => $statuscode,
																				'RESP_status' => $status,
																				'Status'=>'FAILURE'
																		);

																		$this->db->where('Id', $insert_id);
																		$this->db->update('mt3_transfer', $data);
																		$resp_arr = array(
																								"message"=>$status,
																								"status"=>1,
																								"statuscode"=>$statuscode,
																							);
																		$json_resp =  json_encode($resp_arr);

																}
																else if($statuscode == "SPD")
																{
																		//check status befor refund
																		$this->PAYMENT_CREDIT_ENTRY($user_id,$insert_id,$transaction_type,$dr_amount,$Description,$sub_txn_type,$remark,$Charge_Amount,$userinfo);

																		$data = array(
																				'RESP_statuscode' => $statuscode,
																				'RESP_status' => $status,
																				'Status'=>'FAILURE'
																		);

																		$this->db->where('Id', $insert_id);
																		$this->db->update('mt3_transfer', $data);
																		$resp_arr = array(
																								"message"=>$status,
																								"status"=>1,
																								"statuscode"=>$statuscode,
																							);
																		$json_resp =  json_encode($resp_arr);

																}
																else if($statuscode == "IAB")
																{
																		//check status befor refund
																		$this->PAYMENT_CREDIT_ENTRY($user_id,$insert_id,$transaction_type,$dr_amount,$Description,$sub_txn_type,$remark,$Charge_Amount,$userinfo);

																		$data = array(
																				'RESP_statuscode' => $statuscode,
																				'RESP_status' => "Internal Server Error. Please Try Later...",
																				'Status'=>'FAILURE',
																				'reason'=>$status
																		);

																		$this->db->where('Id', $insert_id);
																		$this->db->update('mt3_transfer', $data);
																		$resp_arr = array(
																								"message"=>$status,
																								"status"=>1,
																								"statuscode"=>$statuscode,
																							);
																		$json_resp =  json_encode($resp_arr);

																}
																else if($statuscode == "IAN")
																{
																		//check status befor refund
																		$this->PAYMENT_CREDIT_ENTRY($user_id,$insert_id,$transaction_type,$dr_amount,$Description,$sub_txn_type,$remark,$Charge_Amount,$userinfo);

																		$data = array(
																				'RESP_statuscode' => $statuscode,
																				'RESP_status' => $status,
																				'Status'=>'FAILURE',
																				'reason'=>$status
																		);

																		$this->db->where('Id', $insert_id);
																		$this->db->update('mt3_transfer', $data);
																		$resp_arr = array(
																								"message"=>$status,
																								"status"=>1,
																								"statuscode"=>$statuscode,
																							);
																		$json_resp =  json_encode($resp_arr);

																}
																else if($statuscode == "ERR")
																{
																		//check status befor refund
																		$this->PAYMENT_CREDIT_ENTRY($user_id,$insert_id,$transaction_type,$dr_amount,$Description,$sub_txn_type,$remark,$Charge_Amount,$userinfo);

																		$data = array(
																				'RESP_statuscode' => $statuscode,
																				'RESP_status' => $status,
																				'Status'=>'FAILURE',
																				'reason'=>$status
																		);



																		$this->db->where('Id', $insert_id);
																		$this->db->update('mt3_transfer', $data);
																		$resp_arr = array(
																								"message"=>$status,
																								"status"=>1,
																								"statuscode"=>$statuscode,
																							);
																		$json_resp =  json_encode($resp_arr);

																}
																else 
																{

																		$data = array(
																					'RESP_statuscode' => $statuscode,
																					'RESP_status' => $status,
																					'Status'=>'PENDING'
																		);

																		$this->db->where('Id', $insert_id);
																		$this->db->update('mt3_transfer', $data);
																		$resp_arr = array(
																								"message"=>$status,
																								"status"=>0,
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
																				'RESP_status' => "Unknown Response or No Response"
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

													
												
												
													
											}
											else
											{
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
												"message"=>"Remitter Not Found",
												"status"=>1,
												"statuscode"=>"RNF",
											);
										$json_resp =  json_encode($resp_arr);
								}
							}
							else
							{
								$resp_arr = array(
											"message"=>"Some Error Occured, Please Try Again",
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
		$this->loging("transfer",$postparam,$buffer,$json_resp,$userinfo->row(0)->username);
		return $json_resp;
		
	}	
	
	
	public function transfer_resend($insert_id)
	{
		$postparam = " <>  <>  <> ";
		$buffer = "No Api Call";
		$rslttxncheck = $this->db->query("SELECT a.unique_id,a.Id,a.add_date,a.user_id,a.DId,a.MdId,a.Charge_type,a.charge_value,a.Charge_Amount,a.RemiterMobile,
a.debit_amount,a.credit_amount,a.remitter_id,a.BeneficiaryId,a.AccountNumber,
a.IFSC,a.Amount,a.Status,a.debited, a.ewallet_id,a.balance,a.remark,a.mode,
a.RESP_statuscode,a.RESP_status,a.RESP_ipay_id,a.RESP_ref_no,a.RESP_opr_id,a.RESP_name,a.row_lock,
b.businessname,b.username


FROM `mt3_transfer` a
left join tblusers b on a.user_id = b.user_id
 where a.Id = ? and a.Status = 'HOLD' order by Id desc",array($insert_id));
		if($rslttxncheck->num_rows() == 1)
		{
			$this->db->query("update mt3_transfer set Status = 'PENDING' where Id = ?",array($insert_id));
			$remittermobile = $rslttxncheck->row(0)->RemiterMobile;
			$benificiary_account_no = $rslttxncheck->row(0)->AccountNumber;
			$beneficiaryid = $rslttxncheck->row(0)->BeneficiaryId;
			$amount = $rslttxncheck->row(0)->Amount;
			$mode = $rslttxncheck->row(0)->mode;
			$user_id = $rslttxncheck->row(0)->user_id;
			$transaction_type = "DMR";
			$dr_amount = $amount;
			$Description = "DMR ".$remittermobile." Acc No : ".$benificiary_account_no;
			$sub_txn_type = "REMITTANCE";
			$remark = "Money Remittance";
			$Charge_Amount = $rslttxncheck->row(0)->Charge_Amount;
			$userinfo = $this->db->query("select * from tblusers where user_id = ?",array($user_id));
			$req_array = array(
			"token"	=>$this->getToken(),
			"request"=>array(
								"remittermobile"=>$remittermobile,
								"beneficiaryid"=>$beneficiaryid,
								"agentid"=>$insert_id,
								"amount"=>$amount,
								"mode"=>$mode,
							)
							);
			$postparam = json_encode($req_array);



			$headers = array();
			$headers[] = 'Accept: application/json';
			$headers[] = 'Content-Type: application/json';

			$ch = curl_init();
			curl_setopt($ch,CURLOPT_URL,$this->getLiveUrl("transfer"));
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_POST,1);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $postparam);
			$buffer = curl_exec($ch);
			curl_close($ch);
			$json_obj = json_decode($buffer);
			if(isset($json_obj->statuscode) and isset($json_obj->status))
			{
					$statuscode = $json_obj->statuscode;
					$status = $json_obj->status;
					if($statuscode == "RNF")
					{
							//check status befor refund
							$this->PAYMENT_CREDIT_ENTRY($user_id,$insert_id,$transaction_type,$dr_amount,$Description,$sub_txn_type,$remark,$Charge_Amount,$userinfo);

							$data = array(
									'RESP_statuscode' => $statuscode,
									'RESP_status' => $status,
									'Status'=>'FAILURE'
							);

							$this->db->where('Id', $insert_id);
							$this->db->update('mt3_transfer', $data);
							$resp_arr = array(
													"message"=>"Record Not Found",
													"status"=>1,
													"statuscode"=>"RNF",
												);
							$json_resp =  json_encode($resp_arr);

					}
					else if($statuscode == "TXN")
					{
						$data = $json_obj->data;
						if(isset($data->ipay_id))
						{
							$ipay_id = $data->ipay_id;
							$ref_no = $data->ref_no;
							$opr_id = $data->opr_id;
							$name = $data->name;
							$opening_bal = $data->opening_bal;
							$amount = $data->amount;
							$locked_amt = $data->locked_amt;


							$data = array(
									'RESP_statuscode' => $statuscode,
									'RESP_status' => $status,
									'RESP_ipay_id' => $ipay_id,
									'RESP_ref_no' => $ref_no,
									'RESP_opr_id' => $opr_id,
									'RESP_name' => $name,
									'RESP_opening_bal' => $opening_bal,
									'RESP_amount' => $amount,
									'RESP_locked_amt' => $locked_amt,
									"row_lock"=>"LOCKED",
									'Status'=>'SUCCESS'
							);

							$this->db->where('Id', $insert_id);
							$this->db->update('mt3_transfer', $data);
							$resp_arr = array(
												"message"=>"Transaction Done Successfully. Ref Id :".$ref_no,
												"status"=>0,
												"data"=>array(
													"brid"=>$ipay_id,
													"ref_no"=>$ref_no,
													"opr_id"=>$opr_id,
													"name"=>$name,
													"amount"=>$amount,
													"locked_amt"=>$locked_amt,

												)
											);
							$json_resp =  json_encode($resp_arr);	
						}
						else
						{
								$data = array(
									'RESP_statuscode' => $statuscode,
									'RESP_status' => $status,
									'Status'=>'FAILED'
								);

								$this->db->where('Id', $insert_id);
								$this->db->update('mt3_transfer', $data);
								$resp_arr = array(
													"message"=>"Unknown Response",
													"status"=>2,
													"statuscode"=>"UNK",
												);
							$json_resp =  json_encode($resp_arr);
						}

					}
					else if($statuscode == "TUP")
					{

						$data = $json_obj->data;
						if(isset($data->ipay_id))
						{
							$ipay_id = $data->ipay_id;
							$ref_no = $data->ref_no;
							$opr_id = $data->opr_id;
							$name = $data->name;
							$opening_bal = $data->opening_bal;
							$amount = $data->amount;
							$locked_amt = $data->locked_amt;


							$data = array(
									'RESP_statuscode' => $statuscode,
									'RESP_status' => $status,
									'RESP_ipay_id' => $ipay_id,
									'RESP_ref_no' => $ref_no,
									'RESP_opr_id' => $opr_id,
									'RESP_name' => $name,
									'RESP_opening_bal' => $opening_bal,
									'RESP_amount' => $amount,
									'RESP_locked_amt' => $locked_amt,
									"row_lock"=>"LOCKED",
									'Status'=>'PENDING'
							);

							$this->db->where('Id', $insert_id);
							$this->db->update('mt3_transfer', $data);
							$resp_arr = array(
												"message"=>"Transaction Under Process Ref Id :".$ref_no,
												"status"=>0,
												"data"=>array(
													"brid"=>$ipay_id,
													"ref_no"=>$ref_no,
													"opr_id"=>$opr_id,
													"name"=>$name,
													"amount"=>$amount,
													"locked_amt"=>$locked_amt,

												)
											);
							$json_resp =  json_encode($resp_arr);	
						}
						else
						{
								$data = array(
									'RESP_statuscode' => $statuscode,
									'RESP_status' => $status,
									'Status'=>'FAILED'
								);

								$this->db->where('Id', $insert_id);
								$this->db->update('mt3_transfer', $data);
								$resp_arr = array(
													"message"=>"Unknown Response",
													"status"=>2,
													"statuscode"=>"UNK",
												);
							$json_resp =  json_encode($resp_arr);
						}

					}

					else if($statuscode == "SPE")
					{
							//check status befor refund
							$this->PAYMENT_CREDIT_ENTRY($user_id,$insert_id,$transaction_type,$dr_amount,$Description,$sub_txn_type,$remark,$Charge_Amount,$userinfo);

							$data = array(
									'RESP_statuscode' => $statuscode,
									'RESP_status' => $status,
									'Status'=>'FAILURE'
							);

							$this->db->where('Id', $insert_id);
							$this->db->update('mt3_transfer', $data);
							$resp_arr = array(
													"message"=>$status,
													"status"=>1,
													"statuscode"=>$statuscode,
												);
							$json_resp =  json_encode($resp_arr);

					}
					else if($statuscode == "SPD")
					{
							//check status befor refund
							$this->PAYMENT_CREDIT_ENTRY($user_id,$insert_id,$transaction_type,$dr_amount,$Description,$sub_txn_type,$remark,$Charge_Amount,$userinfo);

							$data = array(
									'RESP_statuscode' => $statuscode,
									'RESP_status' => $status,
									'Status'=>'FAILURE'
							);

							$this->db->where('Id', $insert_id);
							$this->db->update('mt3_transfer', $data);
							$resp_arr = array(
													"message"=>$status,
													"status"=>1,
													"statuscode"=>$statuscode,
												);
							$json_resp =  json_encode($resp_arr);

					}
					else if($statuscode == "IAB")
					{
							//check status befor refund
							$this->PAYMENT_CREDIT_ENTRY($user_id,$insert_id,$transaction_type,$dr_amount,$Description,$sub_txn_type,$remark,$Charge_Amount,$userinfo);

							$data = array(
									'RESP_statuscode' => $statuscode,
									'RESP_status' => "Internal Server Error. Please Try Later...",
									'Status'=>'FAILURE',
									'reason'=>$status
							);

							$this->db->where('Id', $insert_id);
							$this->db->update('mt3_transfer', $data);
							$resp_arr = array(
													"message"=>$status,
													"status"=>1,
													"statuscode"=>$statuscode,
												);
							$json_resp =  json_encode($resp_arr);

					}
					else if($statuscode == "IAN")
					{
							//check status befor refund
							$this->PAYMENT_CREDIT_ENTRY($user_id,$insert_id,$transaction_type,$dr_amount,$Description,$sub_txn_type,$remark,$Charge_Amount,$userinfo);

							$data = array(
									'RESP_statuscode' => $statuscode,
									'RESP_status' => $status,
									'Status'=>'FAILURE',
									'reason'=>$status
							);

							$this->db->where('Id', $insert_id);
							$this->db->update('mt3_transfer', $data);
							$resp_arr = array(
													"message"=>$status,
													"status"=>1,
													"statuscode"=>$statuscode,
												);
							$json_resp =  json_encode($resp_arr);

					}
					else if($statuscode == "ERR")
					{
							//check status befor refund
							$this->PAYMENT_CREDIT_ENTRY($user_id,$insert_id,$transaction_type,$dr_amount,$Description,$sub_txn_type,$remark,$Charge_Amount,$userinfo);

							$data = array(
									'RESP_statuscode' => $statuscode,
									'RESP_status' => $status,
									'Status'=>'FAILURE',
									'reason'=>$status
							);



							$this->db->where('Id', $insert_id);
							$this->db->update('mt3_transfer', $data);
							$resp_arr = array(
													"message"=>$status,
													"status"=>1,
													"statuscode"=>$statuscode,
												);
							$json_resp =  json_encode($resp_arr);

					}
					else 
					{

							$data = array(
										'RESP_statuscode' => $statuscode,
										'RESP_status' => $status,
										'Status'=>'PENDING'
							);

							$this->db->where('Id', $insert_id);
							$this->db->update('mt3_transfer', $data);
							$resp_arr = array(
													"message"=>$status,
													"status"=>0,
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
									'RESP_status' => "Unknown Response or No Response"
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
		
		
		
		$this->loging("transfer_resend",$postparam,$buffer,$json_resp,$userinfo->row(0)->username);
		return $json_resp;
		
	}	
	
	
	public function gethoursbetweentwodates($fromdate,$todate)
	{
		 $now_date = strtotime (date ($todate)); // the current date 
		$key_date = strtotime (date ($fromdate));
		$diff = $now_date - $key_date;
		return round(abs($diff) / 60,2);
	}
	
	public function transfer_status($Id,$ipayid,$userinfo)
	{
	
		if($userinfo != NULL)
		{
			if($userinfo->num_rows() == 1)
			{
				
				$user_id = $userinfo->row(0)->user_id;
				$usertype_name = $userinfo->row(0)->usertype_name;
				$user_status = $userinfo->row(0)->status;
				if($usertype_name == "Agent"  or $usertype_name == "APIUSER")
				{
					if($user_status == '1')
					{ 
						
						$rsltchec = $this->db->query("SELECT * FROM `mt3_transfer` where Id = ? ORDER BY `mt3_transfer`.`Id` ASC",array($Id));
						if($rsltchec->num_rows() == 1)
						{
						    $txnDatetime = $rsltchec->row(0)->add_date;
							
							$recdatetime =date_format(date_create($txnDatetime),'Y-m-d H:i:s');
							$cdate =date_format(date_create($this->common->getDate()),'Y-m-d H:i:s');
							$diff = $this->gethoursbetweentwodates($recdatetime,$cdate);
							
							if($diff < 10)
							{
								$resp_arr = array(
														"message"=>"Please Try After 10 Minutes",
														"status"=>1,
														"statuscode"=>"ERR",
													);
								$json_resp =  json_encode($resp_arr);
								echo $json_resp;exit;
							}
							
						    $RemiterMobile = $rsltchec->row(0)->RemiterMobile;
						    $AccountNumber = $rsltchec->row(0)->AccountNumber;
						    $Amount = $rsltchec->row(0)->Amount;
						    $Charge_Amount = $rsltchec->row(0)->Charge_Amount;
						    $req_array = array(
							"token"	=>$this->getToken(),
							"request"=>array(
												"ipayid"=>$ipayid,
											)
											);
							$postparam = json_encode($req_array);
							
							
							
							$headers = array();
							$headers[] = 'Accept: application/json';
							$headers[] = 'Content-Type: application/json';
							
							$ch = curl_init();
							curl_setopt($ch,CURLOPT_URL,$this->getLiveUrl("transfer_status"));
							curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
							curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
							curl_setopt($ch, CURLOPT_POST,1);
							curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
							curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
							curl_setopt($ch, CURLOPT_POSTFIELDS, $postparam);
							$buffer = curl_exec($ch);
							curl_close($ch);
							$json_obj = json_decode($buffer);
						    //print_r($json_obj);exit; 
						    
							if(isset($json_obj->statuscode) and isset($json_obj->status))
							{
									$statuscode = $json_obj->statuscode;
									$status = $json_obj->status;
									if($statuscode == "RNF")
									{
											$resp_arr = array(
																	"message"=>"Record Not Found",
																	"status"=>1,
																	"statuscode"=>"RNF",
																);
											$json_resp =  json_encode($resp_arr);
									}
									else if($statuscode == "TXN")
									{
										$data = $json_obj->data;
									
										if(isset($data->ipayid))
										{
											$ipay_id = $data->ipayid;
											$agentid = $data->agentid;
											$opr_id = $data->opr_id;
											$trans_amt = $data->trans_amt;
											$charged_amt = $data->charged_amt;
											$opening_bal = $data->opening_bal;
											$req_dt = $data->req_dt;
											$locked_amt = $data->locked_amt;
											$beneficiary_name = $data->beneficiary_name;
											$refund_allowed = $data->refund_allowed;
											
											
											$data = array(
																			'RESP_statuscode' => $statuscode,
																			'RESP_status' => $status,
																			'RESP_name'=>$beneficiary_name,
																			'RESP_ipay_id'=>$ipay_id,
																			'RESP_opr_id'=>$opr_id,
																			'RESP_opening_bal'=>$opening_bal,
																			'Status'=>'SUCCESS'
																);
																
																$this->db->where('Id', $Id);
																$this->db->update('mt3_transfer', $data);
											
											
										    $resp_arr = array(
																	"message"=>"Transaction Success",
																	"status"=>0,
																	"statuscode"=>"SUCCESS",
																);
											$json_resp =  json_encode($resp_arr);
											
										}
										else
										{
												$resp_arr = array(
																	"message"=>"Unknown Response",
																	"status"=>2,
																	"statuscode"=>"UNK",
																);
											$json_resp =  json_encode($resp_arr);
										}
										
									}
									else if($statuscode == "TRP")
									{
										$data = $json_obj->data;
										if(isset($data->ipayid))
										{
											$ipay_id = $data->ipayid;
											$agentid = $data->agentid;
											$opr_id = $data->opr_id;
											$trans_amt = $data->trans_amt;
											$charged_amt = $data->charged_amt;
											$opening_bal = $data->opening_bal;
											$req_dt = $data->req_dt;
											$locked_amt = $data->locked_amt;
											$beneficiary_name = $data->beneficiary_name;
											$refund_allowed = $data->refund_allowed;
											$data = array(
																			'RESP_statuscode' => $statuscode,
																			'RESP_status' => $status,
																			'Status'=>'FAILURE'
																);
																
																$this->db->where('Id', $Id);
																$this->db->update('mt3_transfer', $data);
																
											$Description = "DMR ". $RemiterMobile." Acc No : ".$AccountNumber;
                							$sub_txn_type = "REMITTANCE";
                							$remark = "Money Remittance";	
                							$dr_amount = $Amount;
                							$transaction_type = "DMR";
                						//	echo $Description;exit;
											$this->PAYMENT_CREDIT_ENTRY($user_id,$Id,$transaction_type,$dr_amount,$Description,$sub_txn_type,$remark,$Charge_Amount,$userinfo);
											
											
											$resp_arr = array(
																"message"=>"Transaction failed. Ref Id ",
																"status"=>0,
																"data"=>array(
																	"ipay_id"=>$ipay_id,
																	"agentid"=>$agentid,
																	"opr_id"=>$opr_id,
																	"trans_amt"=>$trans_amt,
																	"charged_amt"=>$charged_amt,
																	"opening_bal"=>$opening_bal,
																	"req_dt"=>$req_dt,
																	"locked_amt"=>$locked_amt,
																	"beneficiary_name"=>$beneficiary_name,
																	"refund_allowed"=>$refund_allowed,
																)
															);
											$json_resp =  json_encode($resp_arr);	
										}
										else
										{
												$resp_arr = array(
																	"message"=>"Unknown Response",
																	"status"=>2,
																	"statuscode"=>"UNK",
																);
											$json_resp =  json_encode($resp_arr);
										}
										
									}
									else if($statuscode == "TUP")
									{
										$data = $json_obj->data;
									
									
												$resp_arr = array(
																	"message"=>"Transaction Pending",
																	"status"=>0,
																	"statuscode"=>"PENDING",
																);
											$json_resp =  json_encode($resp_arr);
										
										
									}
									else if($statuscode == "ERR")
									{
									    $data = array(
														'RESP_statuscode' => $statuscode,
														'RESP_status' => $status,
														'Status'=>'FAILURE'
													);
																
																$this->db->where('Id', $Id);
																$this->db->update('mt3_transfer', $data);
																
											$Description = "DMR ". $RemiterMobile." Acc No : ".$AccountNumber;
                							$sub_txn_type = "REMITTANCE";
                							$remark = "Money Remittance";	
                							$dr_amount = $Amount;
                							$transaction_type = "DMR";
										
											if($status == "Transaction Not Found")
											{
												$this->PAYMENT_CREDIT_ENTRY($user_id,$Id,$transaction_type,$dr_amount,$Description,$sub_txn_type,$remark,$Charge_Amount,$userinfo);
											}
                						//	echo $Description;exit;
											//$this->PAYMENT_CREDIT_ENTRY($user_id,$Id,$transaction_type,$dr_amount,$Description,$sub_txn_type,$remark,$Charge_Amount,$userinfo);
											
											
											
										
												$resp_arr = array(
																	"message"=>$status,
																	"status"=>2,
																	"statuscode"=>"ERR", 
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
		$this->loging("transfer_status",$postparam,$buffer,$json_resp,$userinfo->row(0)->username);
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
		
		//echo $methiod." <> ".$request." <> ".$response." <> ".$json_resp." <> ".$username;exit;
		$log  = "User: ".$_SERVER['REMOTE_ADDR'].' - '.$this->common->getDate().PHP_EOL.
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
//////// bill payments api
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
	
/////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////	
	
	
	
	
	public function getservice($mcode)
	{
	   // $mcode = "TYE";
	    $headers = array();
		$headers[] = 'Accept: application/json';
		$headers[] = 'Content-Type: application/json';
        $url = 'https://www.instantpay.in/ws/userresources/bbps_biller';
        $request_array = array();
        
        $mainreq_array["token"]=$this->getToken();
        
        $request_array = array(
            "sp_key"=>$mcode);
        
        $mainreq_array["request"] = $request_array;
        
       // echo json_encode($mainreq_array);
       
        
      
       
       
		$ch = curl_init();
		curl_setopt($ch,CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_POST,1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($mainreq_array));
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		
		$buffer = curl_exec($ch);
		curl_close($ch);
        $resparray = json_decode($buffer);
        $dataarray = $resparray->data[0];
       $paramsarray = json_decode($dataarray->params);
       //print_r($paramsarray );exit;
        $resparray = array();
       foreach($paramsarray as $paramas)
       {
          array_push($resparray,$paramas->name);
       }
	    return $resparray;
	    
	}
	public function recharge_transaction_validate2($userinfo,$spkey,$company_id,$Amount,$Mobile,$CustomerMobile,$option1 = "")
	{
		
		
		if($spkey == "TYE")
		{
		   $option1 = "Ahmedabad"; 
		}
		if($spkey == "TZE")
		{
		   $option1 = "Agra"; 
		}
		if($spkey == "TXE")
		{
		   $option1 = "Bhiwandi"; 
		}
		if($spkey == "TWE")
		{
		   $option1 = "Surat"; 
		}
		
		
		
		/*$resp_arr = array(
									"message"=>$option1,
									"status"=>5,
									"statuscode"=>"UNK",
								);
						$json_resp =  json_encode($resp_arr);
						echo $json_resp;exit;*/
		/*
		{"statuscode":"TXN","status":"Transaction Successful","data":{"dueamount":"140.00","duedate":"04-02-2019","customername":"NISHAT","billnumber":"055440619012212","billdate":"22-01-2019","billperiod":"NA","billdetails":[],"customerparamsdetails":[{"Name":"CA Number","Value":"103761766"}],"additionaldetails":[],"reference_id":46731}}
		*/
		$ipaddress = $this->common->getRealIpAddr();
		$payment_mode = "CASH";
		$payment_channel = "AGT";
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

									
									$temp_customer_arams = array();
									$main_customer_params = array();
									$params = $this->getservice($spkey);
									$this->loging("RECHARGE_VALIDATE",$url." ?".json_encode($params),"","",$userinfo->row(0)->username);
									//print_r($params);exit;
									foreach($params as $p)
									{
										if($p == "Account Number" or $p =="Contract Number")
										{
											array_push($main_customer_params ,$Mobile);
											 $temp_customer_arams = array(
												 $service_number
												 );
										}
										if($p == "Telephone Number"  or $p == "Landline Number with STD code" or $p == "Number with STD Code (without 0)" or $p == "Subdivision Code")
										{
											array_push($main_customer_params ,$option1);
											 $temp_customer_arams = array(
												 $service_number
												 );
										}
										
										
										if($p == "Service Number" or $p == "ACCOUNTNO"  or $p == "CA Number" or $p == "K Number" or $p == "RR Number"  or $p == "K No" or $p == "Consumer No" or $p == "Consumer Number" or $p == "Service Connection Number" or $p == "Consumer number" or $p == "BP Number" or $p =="Consumer ID" or preg_match('/Customer ID/',$p) or preg_match('/Account ID/',$p))
										{
										    //Account ID (RAPDRP) OR Consumer Number \/ Connection ID (Non-RAPDRP)
											 $temp_customer_arams = array(
												 $service_number
												 );
												 array_push($main_customer_params ,$Mobile);
										}

										if($p == "Mobile Number")
										{
											 $temp_customer_arams = array(
												$mobile_number
												 );
												 array_push($main_customer_params ,$CustomerMobile);
										}
										if($p == "City")
										{
											 $temp_customer_arams = array(
												$option1
												 );
												  array_push($main_customer_params ,$option1);
										}
										if($p == "BU")
										{
											 $temp_customer_arams = array(
												$city
												 );
												  array_push($main_customer_params ,$option1);
										}


									}
								
								
							//	print_r($main_customer_params);exit;
								
									
									$url = 'https://www.instantpay.in/ws/bbps/bill_fetch';
									$request_array = array();
        							$mainreq_array["token"]=$this->getToken();

									$request_array = array(
										"sp_key"=>$spkey,
										"agentid"=>$insert_id,
										"customer_mobile"=>$CustomerMobile,
										"customer_params"=>$main_customer_params,
										"init_channel"=>"AGT",
										"endpoint_ip"=>$this->common->getRealIpAddr(),
										"mac"=>"BC-EE-7B-9C-F6-C0",
										"payment_mode"=>"Cash",
										"payment_info"=>"bill",
										"amount"=>"10",
										"reference_id"=>"",
										"latlong"=>"24.1568,78.5263",
										"outletid"=>$this->getOutletId(),
										);

									$mainreq_array["request"] = $request_array;
								//print_r($mainreq_array);exit;
								$ch = curl_init();
								curl_setopt($ch,CURLOPT_URL,$url);
								curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
								curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
								curl_setopt($ch, CURLOPT_POST,1);
								curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($mainreq_array));
								curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
								curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);

								$buffer = curl_exec($ch);
								curl_close($ch);
								
								$json_resp =  $buffer;
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
		$this->loging("RECHARGE_VALIDATE",$url." ?".json_encode($request_array),$buffer,$json_resp,$userinfo->row(0)->username);
		return $json_resp;
		
	}
	public function recharge_transaction2($userinfo,$spkey,$company_id,$Amount,$Mobile,$CustomerMobile,$remark,$option1,$particulars,$option2="",$option3="",$done_by = "WEB")
	{
        if($option1 == NULL)
        {
            $option1 = "";
        }
        
        $params = "";
	    $api_name = "";
	    $company_info = $this->db->query("select a.company_id,a.company_name,a.sortname,a.service_id from tblcompany a where a.company_id = ?",array($company_id));
	  
	   if($Amount < 20)
    	{
    	    $resp_arr = array(
							"message"=>"Invalid Amount Entered",
							"status"=>1,
							"statuscode"=>"ERR",
						);
		    $json_resp =  json_encode($resp_arr);
		    
    		echo $json_resp;   exit;
    	}
	   
	    if(true)
	    {
	       
	        if($this->bill_checkduplicate($userinfo->row(0)->user_id,$Mobile,$Amount) == false)
        	{
        	    $resp_arr = array(
								"message"=>"Please Try Later",
								"status"=>1,
								"statuscode"=>"ERR",
							);
			    $json_resp =  json_encode($resp_arr);
			    
        		echo $json_resp;   exit;
        	}
        	else
        	{
        	   
        	   
        	    $rsltcheck = $this->db->query("SELECT Id FROM `tblbills`  where service_no = ? and user_id = ? and status != 'Failure' and Date(add_date) = ?
ORDER BY `tblbills`.`Id`  DESC",array($Mobile,$userinfo->row(0)->user_id,$this->common->getMySqlDate()));
                if($rsltcheck->num_rows() == 1)
                {
                    $resp_arr = array(
								"message"=>"Duplicate Request Found.",
								"status"=>1,
								"statuscode"=>"ERR",
							);
			        $json_resp =  json_encode($resp_arr);
			        echo $json_resp;exit;
                }
                else
                {
                    
                    
                    
                    
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
            						 
            						$crntBalance = $this->Common_methods->getAgentBalance($user_id);
            						if(floatval($crntBalance) >= floatval($Amount))
            						{
            						    
            						   
            						    
            								$dueamount = "";
            								$duedate = "";
            								$billnumber = "";
            								$billdate = "";
            								$billperiod = "";
            								$custname = "";
            					
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
            							
            							
            							$strtest =''.$this->common->getDate().'  '.$ipaddress.'  '.$user_id;
            							$strtest .=$Mobile.'  customer mobile '.$CustomerMobile.' company id  '.$company_id.' amount  '.$Amount.' paymode :  '.$payment_mode;
            							$strtest .=$payment_channel.'  Pending  custname : '.$custname.'  dueamount : '.$dueamount;
            							$strtest .='   optino 1 :'.$option1.'   doneby :'.$done_by;
            							$strtest .='billdate '.$duedate.'   billnumber : '.$billnumber.'   billdate : '.$billdate;
            							$strtest .='   bill period : '.$billperiod;
            							//echo $strtest;exit;
            							$insert_rslt = $this->db->query("insert into tblbills(add_date,ipaddress,user_id,service_no,customer_mobile,company_id,bill_amount,paymentmode,payment_channel,status,customer_name,dueamount,duedate,billnumber,billdate,billperiod,option1,done_by)
            							values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)",
            							array($this->common->getDate(),$ipaddress,$user_id,$Mobile,$CustomerMobile,$company_id,$Amount,$payment_mode,$payment_channel,"Pending",$custname,$dueamount,$duedate,$billnumber,$billdate,$billperiod,$option1,$done_by));
            						
            							if($insert_rslt == true)
            							{
            								$this->loging("RECHARGE","step8",$Mobile,$params,$userinfo->row(0)->username);
            								$insert_id = $this->db->insert_id();
            								$transaction_type = "BILL";
            								
            								$Charge_Amount  = 5;
            								
            							
            								$dr_amount = $Amount + $Charge_Amount;
            								$Description = "Service No.  ".$Mobile." Bill Amount : ".$Amount;
            								$sub_txn_type = "BILL";
            								$remark = "Bill PAYMENT";
            								$Charge_Amount = $Charge_Amount;
            								
            								$paymentdebited = $this->PAYMENT_DEBIT_ENTRY($user_id,$insert_id,$transaction_type,$dr_amount,$Description,$sub_txn_type,$remark,$Charge_Amount,$userinfo);
            								if($paymentdebited == true)
            								{
            								    
											   // if($dohold == 'yes')
											   if(true)
												{
													
													
													$sms_message = 'Thank you for bill payment of Rs '.$Amount.' against '.$company_info->row(0)->sortname.',Consumer No.'.$Mobile.',Ref '.$insert_id.' received on '.date_format(date_create($this->common->getDate()),'d-m-Y h:i:s A').'. www.jantaestore.com';
													$this->common->ExecuteSMSApi($CustomerMobile,$sms_message);
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
                    
            											$temp_customer_arams = array();
            											$main_customer_params = array();
            											$params = $this->getservice($spkey);
            											//print_r($params);exit;
            											foreach($params as $p)
            											{
            												if($p == "Account Number" or $p =="Contract Number")
            												{
            													array_push($main_customer_params ,$Mobile);
            													 $temp_customer_arams = array(
            														 $service_number
            														 );
            												}
            												if($p == "Service Number" or $p == "ACCOUNTNO"  or $p == "CA Number" or $p == "K Number" or $p == "Consumer No" or $p == "Consumer Number")
            												{
            													 $temp_customer_arams = array(
            														 $service_number
            														 );
            														 array_push($main_customer_params ,$Mobile);
            												}
            
            												if($p == "Mobile Number")
            												{
            													 $temp_customer_arams = array(
            														$mobile_number
            														 );
            														 array_push($main_customer_params ,$CustomerMobile);
            												}
            												if($p == "City")
            												{
            													 $temp_customer_arams = array(
            														$city
            														 );
            														  array_push($main_customer_params ,$option1);
            												}
            												if($p == "BU")
            												{
            													 $temp_customer_arams = array(
            														$city
            														 );
            														  array_push($main_customer_params ,$option1);
            												}
            
            
            											}
            
            
            
                                                        sleep(3);
            
            											$url = 'https://www.instantpay.in/ws/bbps/bill_pay';
            											$request_array = array();
            											$mainreq_array["token"]=$this->getToken();
            
            											$request_array = array(
            												"sp_key"=>$spkey,
            												"agentid"=>$insert_id,
            												"customer_mobile"=>$CustomerMobile,
            												"customer_params"=>$main_customer_params,
            												"init_channel"=>"AGT",
            												"endpoint_ip"=>$this->common->getRealIpAddr(),
            												"mac"=>"BC-EE-7B-9C-F6-C0",
            												"payment_mode"=>"Cash",
            												"payment_info"=>"bill",
            												"amount"=>$Amount,
            												"reference_id"=>$insta_ref,
            												"latlong"=>"24.1568,78.5263",
            												"outletid"=>$this->getOutletId(),
            												);
            
            											$mainreq_array["request"] = $request_array;
            											//print_r($mainreq_array);exit;
            											$ch = curl_init();
            											curl_setopt($ch,CURLOPT_URL,$url);
            											curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            											curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            											curl_setopt($ch, CURLOPT_POST,1);
            											curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($mainreq_array));
            											curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            											curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            
            											$buffer = curl_exec($ch);
            											curl_close($ch);
            
            											$json_resp =  $buffer;
            											
            											
            											$this->loging("RECHARGE",$url." ? ".json_encode($mainreq_array),$buffer,"",$userinfo->row(0)->username);
            										
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
            											
                    									*/
                    									$json_obj = json_decode($buffer);
                    									if(isset($json_obj->ipay_errorcode) and isset($json_obj->ipay_errordesc))
                    									{
                    											$ipay_errorcode = $json_obj->ipay_errorcode;
                    											$ipay_errordesc = $json_obj->ipay_errordesc;
                    											if($ipay_errorcode == "DTX")
                    											{
                    												$this->PAYMENT_CREDIT_ENTRY($user_id,$insert_id,$transaction_type,$dr_amount,$Description,$sub_txn_type,$remark,$Charge_Amount,$userinfo);
                    												
                    												$this->db->query("update tblbills set status = 'Failure',resp_status=?,res_code=?,res_msg=? where Id = ?",array("FAILURE",$ipay_errorcode,$ipay_errordesc,$insert_id));
                    												
                    													$resp_arr = array(
                    																			"message"=>"Duplicate Transaction",
                    																			"status"=>1,
                    																			"statuscode"=>"DTX",
                    																		);
                    													$json_resp =  json_encode($resp_arr);
                    											}
                    											if($ipay_errorcode == "SPD")
                    											{
                    												$this->PAYMENT_CREDIT_ENTRY($user_id,$insert_id,$transaction_type,$dr_amount,$Description,$sub_txn_type,$remark,$Charge_Amount,$userinfo);
                    												
                    												$this->db->query("update tblbills set status = 'Failure',resp_status=?,res_code=?,res_msg=? where Id = ?",array("FAILURE",$ipay_errorcode,$ipay_errordesc,$insert_id));
                    													$resp_arr = array(
                    																			"message"=>"Service Provider Downtime",
                    																			"status"=>1,
                    																			"statuscode"=>"DTX",
                    																		);
                    													$json_resp =  json_encode($resp_arr);
                    											}
                    
                    											else
                    											{
                    												$this->PAYMENT_CREDIT_ENTRY($user_id,$insert_id,$transaction_type,$dr_amount,$Description,$sub_txn_type,$remark,$Charge_Amount,$userinfo);
                    												
                    												$this->db->query("update tblbills set status = 'Failure',resp_status=?,res_code=?,res_msg=? where Id = ?",array("FAILURE",$ipay_errorcode,$ipay_errordesc,$insert_id));
                    												
                    												$resp_arr = array(
                    																			"message"=>$ipay_errordesc,
                    																			"status"=>1,
                    																			"statuscode"=>$ipay_errorcode,
                    																		);
                    													$json_resp =  json_encode($resp_arr);
                    											}
                    
                    									}
                    									else if(isset($json_obj->statuscode) and isset($json_obj->status))
                    									{
            													$statuscode = trim((string)$json_obj->statuscode);
            													$status = trim((string)$json_obj->status);
            												
            													if($statuscode == "TXN")
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
            														if($status == "SUCCESS")
            														{
            															$this->db->query("update tblbills set status = 'Success',ipay_id = ?,opr_id=?,trans_amt=?,charged_amt=?,opening_bal=?,datetime=?,resp_status=?,res_code=?,res_msg=? where Id = ?",array($ipay_id,$opr_id,$trans_amt,$charged_amt,$opening_bal,$datetime,$status,$statuscode,$status,$insert_id));
            
            														}
            														else
            														{
            															$this->db->query("update tblbills set ipay_id = ?,opr_id=?,trans_amt=?,charged_amt=?,opening_bal=?,datetime=?,resp_status=?,res_code=?,res_msg=? where Id = ?",array($ipay_id,$opr_id,$trans_amt,$charged_amt,$opening_bal,$datetime,$status,$statuscode,$status,$insert_id));
            
            														}
            
            
            															$resp_arr = array(
            																					"message"=>$status,
            																					"status"=>0,
            																					"statuscode"=>$statuscode,
            																					"data"=>array(
            
            																						"ipay_id"=>$ipay_id,
            																						"opr_id"=>$opr_id,
            																						"status"=>$status,
            																						"res_msg"=>$status,
            																					)
            																				);
            															$json_resp =  json_encode($resp_arr);	
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
            
            														
            
            
            															$resp_arr = array(
            																		"message"=>$status,
            																		"status"=>0,
            																		"statuscode"=>$statuscode,
            																		"data"=>array(
            
            																			"ipay_id"=>$ipay_id,
            																			"opr_id"=>$opr_id,
            																			"status"=>$status,
            																			"res_msg"=>$status,
            																		)
            																	);
            															$json_resp =  json_encode($resp_arr);	
            													}
            													else if($statuscode == "IRA" or $statuscode == "UAD" or $statuscode == "IAC"  or $statuscode == "IAT"  or $statuscode == "AAB" or $statuscode == "ISP"  or $statuscode == "DID"  or $statuscode == "SPD" )
            													{
                    												$this->PAYMENT_CREDIT_ENTRY($user_id,$insert_id,$transaction_type,$dr_amount,$Description,$sub_txn_type,$remark,$Charge_Amount,$userinfo);
                    												
                    												$this->db->query("update tblbills set status = 'Failure',resp_status=?,res_code=?,res_msg=? where Id = ?",array("FAILURE",$statuscode,$status,$insert_id));
                    												
                    												$resp_arr = array(
                    																			"message"=>$status,
                    																			"status"=>1,
                    																			"statuscode"=>$statuscode,
                    																		);
                    													$json_resp =  json_encode($resp_arr);
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
                    											}
                        
                        
                        									}
                    									else 
                    									{
                    										$resp_arr = array(
                    												"message"=>"Some Error Occure",
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
        		$this->loging("RECHARGE",$url,$buffer,$json_resp,$userinfo->row(0)->username);
        		return $json_resp;   
        	}    
	    }
	    
		
	}
	
	
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////	
	
	
	
	
	public function recharge_transaction_postpaid($userinfo,$spkey,$company_id,$Amount,$Mobile,$recharge_id)
	{
	    exit;
		$remark = "Bill Payment";
		$ipaddress = $this->common->getRealIpAddr();
		$payment_mode = "CASH";
		$payment_channel = "AGT";
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
						
						$headers = array();
						$headers[] = 'Accept: application/json';
						$headers[] = 'Content-Type: application/json';


						$url = 'https://www.instantpay.in/ws/api/transaction?format=json&token='.$this->getToken().'&spkey='.$spkey.'&agentid='.$recharge_id.'&amount='.$Amount.'&account='.$Mobile.'&customermobile='.$Mobile;

						$ch = curl_init();
						curl_setopt($ch,CURLOPT_URL,$url);
						curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
						curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
						curl_setopt($ch, CURLOPT_POST,0);
						curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
						curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
						$buffer = curl_exec($ch);
						curl_close($ch);
						/*
						{"ipay_id":"1180518152856NUHHQ","agent_id":"1235","opr_id":"1805181529230004","account_no":"8238232303","sp_key":"VFP","trans_amt":10,"charged_amt":9.93,"opening_bal":"18066.10","datetime":"2018-05-18 15:29:14","status":"SUCCESS","res_code":"TXN","res_msg":"Transaction Successful"}
						*/
						$json_obj = json_decode($buffer);
						if(isset($json_obj->ipay_errorcode) and isset($json_obj->ipay_errordesc))
						{
								$ipay_errorcode = $json_obj->ipay_errorcode;
								$ipay_errordesc = $json_obj->ipay_errordesc;
								if($ipay_errorcode == "DTX")
								{
									$resp_arr = array(
																"message"=>"Duplicate Transaction",
																"status"=>1,
																"statuscode"=>"DTX",
															);
										$json_resp =  json_encode($resp_arr);
								}
								if($ipay_errorcode == "SPD")
								{

										$resp_arr = array(
																"message"=>"Service Provider Downtime",
																"status"=>1,
																"statuscode"=>"DTX",
															);
										$json_resp =  json_encode($resp_arr);
								}

								else
								{


										$resp_arr = array(
																"message"=>$ipay_errordesc,
																"status"=>1,
																"statuscode"=>$ipay_errorcode,
															);
										$json_resp =  json_encode($resp_arr);
								}

						}
						else if(isset($json_obj->ipay_id) and isset($json_obj->agent_id) and isset($json_obj->opr_id) and isset($json_obj->status) and isset($json_obj->res_msg))
						{
								$ipay_id = $json_obj->ipay_id;
								$agent_id = $json_obj->agent_id;
								$opr_id = $json_obj->opr_id;
								$status = $json_obj->status;
								$res_msg = $json_obj->res_msg;
								$res_code = $json_obj->res_code;

								$trans_amt = "";
								$charged_amt = "";
								$opening_bal = "";
								$datetime = "";

								$resp_arr = array(
														"message"=>$res_msg,
														"status"=>0,
														"statuscode"=>$status,
														"data"=>array(
															"ipay_id"=>$ipay_id,
															"opr_id"=>$opr_id,
															"status"=>$status,
															"res_msg"=>$res_msg,
														)
													);
								$json_resp =  json_encode($resp_arr);


						}
						else 
						{
							$resp_arr = array(
									"message"=>"Some Error Occure",
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
		$this->loging("RECHARGENORMAL",$url,$buffer,$json_resp,$userinfo->row(0)->username);
		return $json_resp;
		
	}




















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
		$result_oldbalance = $this->db->query("SELECT balance FROM `tblewallet` where user_id = ? order by Id desc limit 1",array($user_id));
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
    			$str_query = "insert into  tblewallet(user_id,dmr_id,transaction_type,debit_amount,balance,description,add_date,ipaddress,remark)
    
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
								$str_query_charge = "insert into  tblewallet(user_id,dmr_id,transaction_type,debit_amount,balance,description,add_date,ipaddress,remark)

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
				$str_query = "insert into  tblewallet(user_id,recharge_id,transaction_type,debit_amount,balance,description,add_date,ipaddress)

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
                			$str_query = "insert into  tblewallet(user_id,dmr_id,transaction_type,credit_amount,balance,description,add_date,ipaddress,remark)
                
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
                									$str_query_charge = "insert into  tblewallet(user_id,dmr_id,transaction_type,credit_amount,balance,description,add_date,ipaddress,remark)
                
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
                			$str_query = "insert into  tblewallet(user_id,bill_id,transaction_type,credit_amount,balance,description,add_date,ipaddress)
                
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
	

////////////////////////////////////////////////////////////////////////////////////////////////////////////////	
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//****************************  P A Y M E N T   M E T H O D   E N D S   H E R E   ****************************//
////////////////////////////////////////////////////////////////////////////////////////////////////////////////	
////////////////////////////////////////////////////////////////////////////////////////////////////////////////

private function getChargeValue($userinfo,$whole_amount)
{
    
    
    $groupinfo = $this->db->query("select * from mt3_group where Id = (select dmr_group from tblusers where user_id = ?)",array($userinfo->row(0)->user_id));
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
			$groupinfo = $this->db->query("select * from mt3_group where Name = 'DMR'");
        	if($groupinfo->num_rows() == 1)
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
        		return false;
        	}
	}
    
    
    
    
    
    

}
public function bill_checkduplicate($user_id,$service_no,$amount)
{
	$add_date = $this->common->getDate();
	$df = date_format(date_create($add_date),"Y-m-d H:i");
	$ip = $this->common->getRealIpAddr();
	$rslt = $this->db->query("insert into locking_bill (user_id,service_no,amount,datetime) values(?,?,?,?)",array($user_id,$service_no,$amount,$df));
	  if($rslt == "" or $rslt == NULL)
	  {
		return false;
	  }
	  else
	  {
	    return true;
	  }
}

	
}

?>
