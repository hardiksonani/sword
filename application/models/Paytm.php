<?php

class Paytm extends CI_Model 
{ 
   
	function _construct()
	{
		  parent::_construct();
		
//        $this->load->model("");
        header('Content-Type: application/json');
	}
	private function getLiveUrl($type)
	{
		
	}
	private function getToken()
	{
		return "dfdsfdsfff";
	}
	private function getClientId()
	{
		return "sdfsdf";
	}
	private function getUserId()
	{
		return "29";
	}
	private function getinitiator_id()
	{
		return "asdf";
	}
	private function getdauthKey()
	{
		return "asdfsdf";
	}
	
	
	
	public function encrypt($plainText)
	{
	    
	    $encData = "Rvf/z4OqYowCMqBqc/Lx6g==";
	    $key = "asdfsadfs";
        $cipher="AES256";
        $iv = chr(0x0).chr(0x0).chr(0x0).chr(0x0).chr(0x0).chr(0x0).chr(0x0).chr(0x0).chr(0x0).chr(0x0).chr(0x0).chr(0x0).chr(0x0).chr(0x0).chr(0x0).chr(0x0);
        
        $encData = base64_encode(openssl_encrypt($plaintext, $cipher, $key, $options = OPENSSL_RAW_DATA , $iv));
        //$decData = openssl_decrypt(base64_decode($encData), $cipher, $key, OPENSSL_RAW_DATA , $iv);
        return  $encData;
	}
	
	public function jwt_token()
    {
		//stating api partner id
		//DMT_i30_000200
	
		$this->objOfJwt = new CreatorJwt();
    	$randomnumber = rand ( 10000 , 99999 );
		$t = $milliseconds = round(microtime(true) * 1000);
		$json_string = '{"iss": "PAYTM", "timestamp": '.$t.', "partnerId": "", "partnerSubId":"","requestReferenceId": "Req'.$randomnumber.'"}';
		//echo $json_string;exit;
		$jwtToken = $this->objOfJwt->GenerateToken(json_decode($json_string ));

		return $jwtToken;

    }
	//https://pass-api.paytmbank.com/
	//https://pass-api-ite.paytmbank.com/api/tops/remittance/v1/user-balance
	public function getBalance()
	{
	
		$jwtToken = $this->jwt_token();
		$curl = curl_init();

		curl_setopt_array
		(
			$curl, array(
			CURLOPT_URL => "https://pass-api.paytmbank.com/api/tops/remittance/v1/user-balance",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "GET",
			CURLOPT_HTTPHEADER => array(
			"authorization: ".$jwtToken,
			"cache-control: no-cache",
			"postman-token: 2021c20d-47ed-ed8b-378a-7bf00adc49a8"
			),
		)
		);

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);
//echo $response;exit;
		if ($err) 
		{
		  return 0;
		} 
		else 
		{
			$json_obj = json_decode($response);
			if(isset($json_obj->effectiveBalance))
			{
				return $json_obj->effectiveBalance;
			}
			else
			{
				return 0;
			}
		}
	}
	
	public function remitter_details_limit($mobile_no,$userinfo) // done
	{
	    if($userinfo != NULL)
		{
			if($userinfo->num_rows() == 1)
			{
	          	$user_id = $userinfo->row(0)->user_id;
				$usertype_name = $userinfo->row(0)->usertype_name;
				$user_status = $userinfo->row(0)->status;
				if($usertype_name == "APIUSER")
				{
					if($user_status == '1')
					{
						$jwtToken = $this->jwt_token();
						$request_array = array(
								'customerMobile'=>$mobile_no
							);
						$json_reqarray = json_encode($request_array);
						$curl = curl_init();
						curl_setopt_array($curl, array(
						CURLOPT_URL => "https://pass-api.paytmbank.com/api/tops/remittance/v1/user/amount-limit?customerMobile=".$mobile_no,
							  CURLOPT_RETURNTRANSFER => true,
							  CURLOPT_ENCODING => "",
							  CURLOPT_MAXREDIRS => 10,
							  CURLOPT_TIMEOUT => 30,
							  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
							  CURLOPT_CUSTOMREQUEST => "GET",
							  CURLOPT_HTTPHEADER => array(
								"authorization: ".$jwtToken,
								"cache-control: no-cache",
								"content-type: application/json",
								"postman-token: c492db75-571a-fe94-5bf5-2ca4f2c87db8"
							  ),
							));
					
							$response = curl_exec($curl);
							$err = curl_error($curl);
					
							curl_close($curl);
							$json_resp = json_decode($response);
					
						
							if(isset($json_resp->status) and isset($json_resp->response_code))
							{
									$response_code = trim((string)$json_resp->response_code);
									$status = trim((string)$json_resp->status);
								
									if($status == "success" and  $response_code == 0 )
									{

										$limit = trim((string)$json_resp->limit);
										return $limit;
									}
									
									else
									{
										return 0;
									}
							}
							else
							{
								return 0;
							}	
						
					}
					else
					{
						return 0;
					}
						
				}
				else
				{
					return 0;
				}
			}
			else
			{
				return 0;
			}
			
		}
		else
		{
			return 0;
			
		}
		$this->loging("paytm_remitter_limit",$url,$response,$json_resp,$userinfo->row(0)->mobile_no);
		return $json_resp;
		
	}
	
	public function is_sender_exist($mobile_no,$userinfo) // done
	{
	
	    if($userinfo != NULL)
		{
			if($userinfo->num_rows() == 1)
			{
	          	$user_id = $userinfo->row(0)->user_id;
				$usertype_name = $userinfo->row(0)->usertype_name;
				$user_status = $userinfo->row(0)->status;
				if($usertype_name == "APIUSER")
				{
					if($user_status == '1')
					{
						$url = "https://pass-api.paytmbank.com/api/tops/remittance/v1/user/amount-limit?customerMobile=".$mobile_no;
						
						$jwtToken = $this->jwt_token();
						$request_array = array(
								'customerMobile'=>$mobile_no
							);
						$json_reqarray = json_encode($request_array);
						$curl = curl_init();
						curl_setopt_array($curl, array(
						CURLOPT_URL => $url,
							  CURLOPT_RETURNTRANSFER => true,
							  CURLOPT_ENCODING => "",
							  CURLOPT_MAXREDIRS => 10,
							  CURLOPT_TIMEOUT => 30,
							  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
							  CURLOPT_CUSTOMREQUEST => "GET",
							  CURLOPT_HTTPHEADER => array(
								"authorization: ".$jwtToken,
								"cache-control: no-cache",
								"content-type: application/json",
								"postman-token: c492db75-571a-fe94-5bf5-2ca4f2c87db8"
							  ),
							));
					
							$response = curl_exec($curl);
							$err = curl_error($curl);
					
							curl_close($curl);
							$json_resp = json_decode($response);
					
						
							if(isset($json_resp->status) and isset($json_resp->response_code))
							{
									$response_code = trim((string)$json_resp->response_code);
									$status = trim((string)$json_resp->status);
								
									if($status == "success" and  $response_code == 0 )
									{
											return "yes";
									}
									
									else
									{
									
										$this->remitter_registration_getotp($mobile_no,$userinfo);
										return "no";
									}
							}
							else
							{
								return "no";
							}	
						
					}
					else
					{
						return "no";
					}
						
				}
				else
				{
					return "no";
				}
			}
			else
			{
				return "no";
			}
			
		}
		else
		{
			return "no";
			
		}
		return $json_resp;
		
	}
	
	public function remitter_details($mobile_no,$userinfo) // done
	{
	    if($userinfo != NULL)
		{
			if($userinfo->num_rows() == 1)
			{
	          	$user_id = $userinfo->row(0)->user_id;
				$usertype_name = $userinfo->row(0)->usertype_name;
				$user_status = $userinfo->row(0)->status;
				if($usertype_name == "APIUSER")
				{
					if($user_status == '1')
					{
						
							$url = "https://pass-api.paytmbank.com/api/tops/remittance/v1/user/pre-validate?customerMobile=".$mobile_no;
							$jwtToken = $this->jwt_token();
							$curl = curl_init();
					
							curl_setopt_array($curl, array(
							CURLOPT_URL => $url,
							CURLOPT_RETURNTRANSFER => true,
							CURLOPT_ENCODING => "",
							CURLOPT_MAXREDIRS => 10,
							CURLOPT_TIMEOUT => 30,
							CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
							CURLOPT_CUSTOMREQUEST => "GET",
							CURLOPT_POSTFIELDS => "------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"\"\r\n\r\n\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW--",
							CURLOPT_HTTPHEADER => array(
							"authorization: ". $jwtToken,
							"cache-control: no-cache",
							"content-type: multipart/form-data; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW",
							"postman-token: f71a5a6c-de06-e694-f5e6-4c9ce2d7f161"
							 ),
							));
					
							$response = curl_exec($curl);
							$err = curl_error($curl);
					
							curl_close($curl);
							//echo $response;exit;
							$json_resp = json_decode($response);
						
						/*
						
						{"status":"success","response_code":1032}
						
						 {"STATUS":1,"MESSAGE":"Sender detail retrieved successfully!","DATA":{"mobileno":"9924160199","senderpin":"123456","name":"KAMLESH","lastname":"SONI","kycflag":"PENDINGKYC","address":"ahmedabad","city":"Ahmedabad","state":"Gujarat","pincode":"380001","impslimit":25000.0,"neftlimit":25000.0}}
						*/
						
							if(isset($json_resp->status) and isset($json_resp->response_code))
							{
									$response_code = trim((string)$json_resp->response_code);
									$status = trim((string)$json_resp->status);
								
									if($status == "success" and  $response_code == 0 )
									{

										$firstName = trim((string)$json_resp->firstName);
										$lastName = trim((string)$json_resp->lastName);
										$customerMobile = trim((string)$json_resp->customerMobile);
										$limitLeft = trim((string)$json_resp->limitLeft);
										
										
										$checkremitterexist = $this->db->query("select Id from mt3_remitter_registration where mobile = ?",array($customerMobile));
										if($checkremitterexist->num_rows() == 0)
										{
											$this->db->query("insert into mt3_remitter_registration(user_id,add_date,ipaddress,mobile,name,lastname,pincode,status,PAYTM)
											values(?,?,?,?,?,?,?,?,?)",
											array(
											$user_id,
											$this->common->getDate(),
											$this->common->getRealIpAddr(),
											$customerMobile,
											$firstName,
											$lastName,
											"",
											"SUCCESS",
											"yes"
											));
										}
										if($checkremitterexist->num_rows() == 1)
										{
											$this->db->query("update mt3_remitter_registration set name=?,lastname = ?,PAYTM = 'yes' where mobile = ?",array($firstName,$lastName ,$customerMobile));
										}
										
										$temparray = array(
											"firstName"=>$firstName,
											"lastName"=>$lastName,
											"customerMobile"=>$customerMobile,
											"limitLeft"=>$limitLeft,
										);
										$resp_arr = array(
																"message"=>$status,
																"status"=>0,
																"statuscode"=>"TXN",
																"data"=>$temparray,
															);
										$json_resp =  json_encode($resp_arr);
									}
									
									else
									{
										$resp_arr = array(
																"message"=>$status,
																"status"=>2,
																"statuscode"=>$status,
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
		$this->loging("paytm_remitter_details",$url,$response,$json_resp,$userinfo->row(0)->mobile_no);
		return $json_resp;
		
	}
	
	
	
	public function getbenelist2($mobile_no,$userinfo,$limit,$offset)
	{
	    if($userinfo != NULL)
		{
			if($userinfo->num_rows() == 1)
			{
			   
				
				$user_id = $userinfo->row(0)->user_id;
				$usertype_name = $userinfo->row(0)->usertype_name;
				$user_status = $userinfo->row(0)->status;
				if($usertype_name == "APIUSER")
				{
					if($user_status == '1')
					{
						$resp_benearray = array();
						$totalCount = 0;
						$rsltbenelist = $this->db->query("SELECT a.*,b.bank_name FROM `beneficiaries` a left join dezire_banklist b on a.dezire_bank_id = b.Id where a.sender_mobile = ? and a.is_paytm = 'yes'",array($mobile_no));
						
						foreach($rsltbenelist->result() as $rwbene)
						{
						
							$totalCount ++;
							$beneficiaryId = $rwbene->Id;
							$ifscCode = $rwbene->IFSC;
							$bankName = $rwbene->bank_name;
							$accountHolderName = $rwbene->bene_name;
							$accountNumber = $rwbene->account_number;
							$resp_verifystatus = $rwbene->is_verified;
							$bank_id = $rwbene->dezire_bank_id;
							$temp_benearray = array(
								"beneficiaryId"=>$beneficiaryId,
								"bankName"=>$bankName,
								"bankId"=>$bank_id,
								"accountHolderName"=>$accountHolderName,
								"accountNumber"=>$accountNumber,
								"ifscCode"=>$ifscCode,
								"verifystatus"=>$resp_verifystatus,
							);
							
							array_push($resp_benearray,$temp_benearray);
						}
						$resp_arr = array(
												"message"=>"Beneficiary Fetch Successfully",
												"status"=>0,
												"statuscode"=>$response_code,
												"data"=>$resp_benearray,
											);
						$json_resp =  json_encode($resp_arr);
								
							
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
		$this->loging("paytm_getbenelist",$url,$response,$json_resp,$userinfo->row(0)->mobile_no);
		return $json_resp;
		
	}
	
	
	public function getbenelist($mobile_no,$userinfo,$limit,$offset)
	{
	    if($userinfo != NULL)
		{
			if($userinfo->num_rows() == 1)
			{
			   
				
				$user_id = $userinfo->row(0)->user_id;
				$usertype_name = $userinfo->row(0)->usertype_name;
				$user_status = $userinfo->row(0)->status;
				if($usertype_name == "APIUSER")
				{
					if($user_status == '1')
					{
						$url = "https://pass-api.paytmbank.com/api/tops/remittance/v1/user/beneficiaries?customerMobile=".$mobile_no."&limit=".$limit."&offset=".$offset;
						$jwtToken = $this->jwt_token();
						$curl = curl_init();
				
					  curl_setopt_array($curl, array(
					  CURLOPT_URL => $url,
					  CURLOPT_RETURNTRANSFER => true,
					  CURLOPT_ENCODING => "",
					  CURLOPT_MAXREDIRS => 10,
					  CURLOPT_TIMEOUT => 30,
					  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
					  CURLOPT_CUSTOMREQUEST => "GET",
					  CURLOPT_HTTPHEADER => array(
						"authorization: ".$jwtToken,
						"cache-control: no-cache",
						"content-type: application/json",
						"postman-token: ba3a157b-501e-f6d5-845f-c15bd8dec8ec"
					  ),
					));
				
						$response = curl_exec($curl);
						$err = curl_error($curl);
				
						curl_close($curl);
						
						
						/*
						{"status":"failure","message":"Your request was declined due to an internal error. Please try again after sometime.","response_code":1023,"txn_id":"D0J5F06U2PZA0"}
						*/
						
						/*
						{"status":"success","response_code":0,"customerMobile":"8238232303","beneficiaries":[{"beneficiaryId":"722d76a8a377432faddafe65d0b397dc","accountDetail":{"accountNumber":"09XX6012","ifscCode":"PUNB0012000","bankName":"PUNJAB NATIONAL BANK","accountHolderName":"RAVIKANT LAXMANBHAI"}},{"beneficiaryId":"1886065d5c7c45ccb4a299a30ad204e5","accountDetail":{"accountNumber":"31XX1069","ifscCode":"SBIN0001266","bankName":"STATE BANK OF INDIA","accountHolderName":"Mr RAVIKANT LAXMANB"}}],"totalCount":2}
						*/
						$json_resp = json_decode($response);
						if(isset($json_resp->status))
						{
								$status = trim((string)$json_resp->status);
	
								$response_code = trim((string)$json_resp->response_code);
								if($status == "success" )
								{
									$totalCount = trim((string)$json_resp->totalCount);
									$beneficiaries =  $json_resp->beneficiaries;
									$resp_benearray = array();
									foreach($beneficiaries as $benerw)
									{
									
										$beneficiaryId = $benerw->beneficiaryId;
										$accountDetail = $benerw->accountDetail;
										$ifscCode = $accountDetail->ifscCode;
										$bankName = "";
										$accountHolderName = $accountDetail->accountHolderName;
										$accountNumber = $accountDetail->accountNumber;
										$resp_verifystatus = "";
										
										$temp_benearray = array(
											"beneficiaryId"=>$beneficiaryId,
											"bankName"=>$bankName,
											"accountHolderName"=>$accountHolderName,
											"accountNumber"=>$accountNumber,
											"ifscCode"=>$ifscCode,
										);
										
										array_push($resp_benearray,$temp_benearray);
										
										
										
									}
									
									$resp_arr = array(
															"message"=>"Beneficiary Fetch Successfully",
															"status"=>0,
															"statuscode"=>$response_code,
															"data"=>$resp_benearray,
														);
									$json_resp =  json_encode($resp_arr);
								}
								else if($status == "failure")
								{
									$resp_arr = array(
																"message"=>"Failed",
																"status"=>$status,
																"statuscode"=>$response_code,
															);
									$json_resp =  json_encode($resp_arr);
								}
								else
								{
									$resp_arr = array(
															"message"=>"Failed",
															"status"=>2,
															"statuscode"=>$status,
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
		$this->loging("paytm_getbenelist",$url,$response,$json_resp,$userinfo->row(0)->mobile_no);
		return $json_resp;
		
	}
	
	
	
	public function remitter_registration_getotp($mobile_no,$userinfo,$type = "registrationOtp")
	{
		$json_resp = "";
		
		if($userinfo != NULL)
		{
			if($userinfo->num_rows() == 1)
			{
			
			    $user_id = $userinfo->row(0)->user_id;
				$usertype_name = $userinfo->row(0)->usertype_name;
				$user_status = $userinfo->row(0)->status;

				if($usertype_name == "APIUSER")
				{
					if($user_status == '1')
					{
						$rsltcheckexist = $this->db->query("select sender_mobile from sender_registration_getotp where sender_mobile = ?",array($mobile_no));
						if($rsltcheckexist->num_rows() == 0)
						{
							$this->db->query("insert into sender_registration_getotp(sender_mobile,add_date,ipaddress) values(?,?,?)",array($mobile_no,$this->common->getDate(),$this->common->getRealIpAddr()));
						}
					
						$url = "https://pass-api.paytmbank.com/api/tops/remittance/v1/send-otp";
						$request_array = array('customerMobile'=>$mobile_no,
							'otpType'=>$type);	 
	    				$json_reqarray = json_encode($request_array );
						$jwtToken = $this->jwt_token();
						$curl = curl_init();
				
				
						curl_setopt_array($curl, array(
						  CURLOPT_URL => $url,
						  CURLOPT_RETURNTRANSFER => true,
						  CURLOPT_ENCODING => "",
						  CURLOPT_MAXREDIRS => 10,
						  CURLOPT_TIMEOUT => 30,
						  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
						  CURLOPT_CUSTOMREQUEST => "POST",
						  CURLOPT_POSTFIELDS => $json_reqarray,
						  CURLOPT_HTTPHEADER => array(
							"authorization: ".$jwtToken,
							"cache-control: no-cache",
							"content-type: application/json",
							"postman-token: 206aa74a-9d05-1c42-fa4f-cf9ba0243a01"
						  ),
						));
				
						$buffer = $response = curl_exec($curl);
						$err = curl_error($curl);
				
						curl_close($curl);
						
						$json_object = json_decode($buffer);
						if(isset($json_object->status) and isset($json_object->state))
						{
							$status  = $json_object->status;
							$state  = $json_object->state;
							$this->db->query("update sender_registration_getotp set request_id = ? where sender_mobile = ?",array($state,$mobile_no));
							$resp_arr = array(
									"message"=>$status,
									"status"=>0,
									"statuscode"=>"TXN",
								);
						$json_resp =  json_encode($resp_arr);
							
						}
						
					}
					else
					{
						$resp_arr = array(
									"message"=>"Your Account Deactivated By Admin",
									"status"=>5,
									"statuscode"=>"ERR",
								);
						$json_resp =  json_encode($resp_arr);
					}
						
				}
				else
				{
					$resp_arr = array(
									"message"=>"Invalid Access",
									"status"=>5,
									"statuscode"=>"ERR",
								);
					$json_resp =  json_encode($resp_arr);
				}
			}
			else
			{
				$resp_arr = array(
									"message"=>"Userinfo Missing",
									"status"=>4,
									"statuscode"=>"ERR",
								);
				$json_resp =  json_encode($resp_arr);
			}
			
		}
		else
		{
			$resp_arr = array(
									"message"=>"Userinfo Missing",
									"status"=>4,
									"statuscode"=>"ERR",
								);
			$json_resp =  json_encode($resp_arr);
			
		}
		
		$this->loging("paytm_customer_registration_otp",$url."?".$json_reqarray,$buffer,$json_resp,$userinfo->row(0)->mobile_no);
		return $json_resp;
		
	}
	

	
	public function remitter_registration($mobile_no,$name,$lname,$address1,$address2,$pincode,$requset_id,$otp,$userinfo)
	{
		
		$url = $buffer = "";
		if($userinfo != NULL)
		{
		    if($userinfo->num_rows() == 1)
			{
			    $user_id = $userinfo->row(0)->user_id;
				$usertype_name = $userinfo->row(0)->usertype_name;
				$user_status = $userinfo->row(0)->status;
				if($usertype_name == "APIUSER")
				{
					if($user_status == '1')
					{
					
						$rsltcheck = $this->db->query("select Id from mt3_remitter_registration where mobile = ?",array($mobile_no));
						if($rsltcheck->num_rows() == 0)
						{
							$this->db->query("insert into mt3_remitter_registration(user_id,add_date,ipaddress,mobile,name,lastname,pincode) values(?,?,?,?,?,?,?)",array($user_id,$this->common->getDate(),$this->common->getRealIpAddr(),$mobile_no,$name,$lname,$pincode));
						}
					
					
						$url = "https://pass-api.paytmbank.com/api/tops/remittance/v1/user/register";
					    $jwtToken = $this->jwt_token();

						$request_array = array(
							'customerMobile'=>$mobile_no,
							'otp'=>$otp,
							'state'=>$requset_id,
							'name'=>array("firstName"=>$name,"lastName"=>$lname),
							'address'=>array("address1"=>$address1,"address2"=>$address2,"pin"=>$pincode,'mobile'=>$mobile_no)	
						);
				
						$json_reqarray = json_encode($request_array);
				
						$curl = curl_init();
				
						curl_setopt_array($curl, array(
						  CURLOPT_URL => $url,
						  CURLOPT_RETURNTRANSFER => true,
						  CURLOPT_ENCODING => "",
						  CURLOPT_MAXREDIRS => 10,
						  CURLOPT_TIMEOUT => 30,
						  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
						  CURLOPT_CUSTOMREQUEST => "POST",
						  CURLOPT_POSTFIELDS => $json_reqarray,
						  CURLOPT_HTTPHEADER => array(
							"authorization: ".$jwtToken,
							"cache-control: no-cache",
							"content-type: application/json",
							"postman-token: 4a225a2f-2abf-9ac6-a6c6-7a3b175dd9b6"
						  ),
						));
				
						$buffer = $response = curl_exec($curl);
						$err = curl_error($curl);
				
						curl_close($curl);
						$json_object = json_decode($buffer);
						if(isset($json_object->status) and isset($json_object->response_code))
						{
							$status  = $json_object->status;
							$response_code  = $json_object->response_code;
							if($status == "success")
							{
								$this->db->query("update mt3_remitter_registration set resp_status = 'abc',status = 'SUCCESS',PAYTM = 'yes' where mobile = ?",array($mobile_no));
								$this->load->model("Bankit");
								$this->Bankit->remitter_registration_auto($mobile_no,$name,$lname,$userinfo);
								
								$resp_arr = array(
										"message"=>$status,
										"status"=>0,
										"statuscode"=>"TXN",
									);
								$json_resp =  json_encode($resp_arr);
							}
							else
							{
								$message = $json_object->message;
								$resp_arr = array(
										"message"=>$message,
										"status"=>1,
										"statuscode"=>$response_code,
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
									"message"=>"Your Account Deactivated By Admin",
									"status"=>5,
									"statuscode"=>"ERR",
								);
						$json_resp =  json_encode($resp_arr);
					}
						
				}
				else
				{
					$resp_arr = array(
									"message"=>"Invalid Access",
									"status"=>5,
									"statuscode"=>"ERR",
								);
					$json_resp =  json_encode($resp_arr);
				}
			}
			else
			{
				$resp_arr = array(
									"message"=>"Userinfo Missing",
									"status"=>4,
									"statuscode"=>"ERR",
								);
				$json_resp =  json_encode($resp_arr);
			}
			
		}
		else
		{
			$resp_arr = array(
									"message"=>"Userinfo Missing",
									"status"=>4,
									"statuscode"=>"ERR",
								);
			$json_resp =  json_encode($resp_arr);
			
		}
		
		$this->loging("paytm_customer_registration",$url."?".$json_reqarray,$buffer,$json_resp,$userinfo->row(0)->username);
		return $json_resp;
		
	}
	
	public function remitter_registration_auto($mobile_no,$name,$lname,$userinfo)
	{
		
		$url = $buffer = "";
		if($userinfo != NULL)
		{
		    
		    $name = str_replace(" ","",$name);
		    
			if($userinfo->num_rows() == 1)
			{
			    $user_id = $userinfo->row(0)->user_id;
				$usertype_name = $userinfo->row(0)->usertype_name;
				$user_status = $userinfo->row(0)->status;
				
				if($usertype_name == "Agent")
				{
					if($user_status == '1')
					{
						
						
						$registeras = "NONKYC";
						$data = array(
								"firstname"=>$name,
								"lastname"=>$lname,
								"registeras"=>$registeras,
								"mobileno"=>$mobile_no
								);
						
						
						$checksender = $this->db->query("select Id from mt3_remitter_registration where status = 'SUCCESS' and mobile = ? and API = 'SHOOTCASE'",array($mobile_no));
						if($checksender->num_rows() == 0)
						{
						    $resultinsert = $this->db->query("insert into mt3_remitter_registration(user_id,add_date,ipaddress,mobile,name,lastname,API) values(?,?,?,?,?,?,?)",array(
    						$user_id,$this->common->getDate(),$this->common->getRealIpAddr(),$mobile_no,$name,$lname,"SHOOTCASE"
    						));
    						if($resultinsert == true)
    						{
    							$insert_id = $this->db->insert_id();
    							$registeras = "NONKYC";
    							$data = array(
    									"firstname"=>$name,
    									"lastname"=>$lname,
    									"registeras"=>$registeras,
    									"mobileno"=>$mobile_no
    									);
    							$url = 'http://www.deziremoney.co.in/apis/v1/dmr?action=senderregistration&authKey='.$this->getdauthKey().'&clientId='.$this->getClientId().'&userId='.$this->getUserId().'&data='.json_encode($data);
    
    							$ch = curl_init();
    							curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    							curl_setopt($ch, CURLOPT_URL, $url);
    							curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    							curl_setopt($ch, CURLOPT_TIMEOUT, 80);
    							$buffer = $response = curl_exec($ch);
    							curl_close($ch);
    							$this->loging("shootcase_customer_registration",$url,$buffer,"",$userinfo->row(0)->username);
    
    							$json_resp = json_decode($response);
    
    							if(isset($json_resp->STATUS) and isset($json_resp->MESSAGE))
    							{
    								// user not exist
    								// redirect to registration form
    								$STATUS = trim($json_resp->STATUS);
    								$MESSAGE = trim($json_resp->MESSAGE);
    								if($STATUS == "1")
    								{
    								    
    								    $this->db->query("update mt3_remitter_registration set status = 'SUCCESS',RESP_statuscode = ?,RESP_status=? where Id = ?",array($STATUS,$MESSAGE,$insert_id));
    									$resp_arr = array(
    													"message"=>$MESSAGE,
    													"status"=>0,
    													"statuscode"=>"TXN",
    													"remitter_id"=>$mobile_no
    												);
    									$json_resp =  json_encode($resp_arr);		
    								}
    								else
    								{
    									$resp_arr = array(
    													"message"=>$MESSAGE,
    													"status"=>1,
    													"remitter_id"=>$mobile_no
    												);
    									$json_resp =  json_encode($resp_arr);
    								}
    							}
    							else
    							{
    							    $resp_arr = array(
    								"message"=>"Invalid Response Received",
    								"status"=>1,
    								"statuscode"=>"UNK",
    								);
    						        $json_resp =  json_encode($resp_arr);
    							}
    						}
    						else
    						{
    							$resp_arr = array(
    									"message"=>"Some Error Occured",
    									"status"=>1,
    									"statuscode"=>"ERR",
    								);
    							$json_resp =  json_encode($resp_arr);
    						}
						}
						else
						{
						    $resp_arr = array(
									"message"=>"Sender Already Registered",
									"status"=>1,
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
		
		$this->loging("shootcase_customer_registration",$url,$buffer,$json_resp,$userinfo->row(0)->username);
		return $json_resp;
		
	}
	/*public function remitter_validate_otp($mobile_no,$otp,$userinfo)
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
						
						
							$url ="https://api.eko.co.in:25002/ekoicici/v1/customers/verification/otp:".$otp;
							$request = array(
								  'initiator_id' => $this->getinitiator_id(),
								  'id_type' => 'mobile_number',
  								  'id' => $mobile_no
								);

							$ch = curl_init($url);
							curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
							curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
							curl_setopt($ch, CURLOPT_HTTPHEADER, array(
								'postman-token:89ce1baf-531e-e42b-dbf8-102be0d9e5a1',
								'cache-control: no-cache',
								'secret-key-timestamp: '.$secret_key_timestamp,
								'secret-key: '.$secret_key,
								'content-type: application/x-www-form-urlencoded',
								'developer_key: '.$this->getdeveloper_key()
							));
							curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query($request));

							$buffer = $response = $response = curl_exec($ch);
							$json_obj = json_decode($buffer);
							//print_r($json_obj);exit;
							if(isset($json_obj->response_status_id) and isset($json_obj->response_type_id) and isset($json_obj->message) and isset($json_obj->status))
							{
									$response_status_id = trim((string)$json_obj->response_status_id);
									$response_type_id = trim((string)$json_obj->response_type_id);
									$message = trim((string)$json_obj->message);
									$status = trim((string)$json_obj->status);
									//echo $status."  ".$response_type_id;exit;
									
										$resp_arr = array(
																	"message"=>$message,
																	"status"=>$status,
																	"statuscode"=>$status,
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
		
		$this->loging("verify_RegOtp",$url,$buffer,$json_resp,$userinfo->row(0)->username);
		return $json_resp;
		
	}*/
	
	
	
	public function add_benificiary($mobile_no,$bene_name,$bene_mobile,$acc_no,$ifsc,$bank,$userinfo)
	{
		if($userinfo != NULL)
		{
			if($userinfo->num_rows() == 1)
			{
			   
				
				$user_id = $userinfo->row(0)->user_id;
				$usertype_name = $userinfo->row(0)->usertype_name;
				$user_status = $userinfo->row(0)->status;
				if($usertype_name == "APIUSER")
				{
					if($user_status == '1')
					{
						
						$checkbeneexist = $this->db->query("select * from beneficiaries where sender_mobile = ? and account_number = ? and IFSC = ? order by Id desc limit 1",array($mobile_no,$acc_no,$ifsc));
						if($checkbeneexist->num_rows() ==  1)
						{
							$is_paytm = $checkbeneexist->row(0)->is_paytm;
							$Id = $checkbeneexist->row(0)->Id;
							if($is_paytm == "yes")
							{
								$resp_arr = array(
														"message"=>"Beneficiary Already Registered",
														"status"=>1,
														"statuscode"=>"ERR",
													);
								$json_resp =  json_encode($resp_arr);
							}
							else
							{
								$insert_id = $Id;
							}
						}
						else
						{
							$insertrslt = $this->db->query("insert into beneficiaries
											(
											ipaddress,add_date,bene_name,account_number,IFSC,benemobile,
											sender_mobile,is_verified,paytm_bene_id,is_paytm,bank_name,dezire_bank_id
											) values(?,?,?,?,?,?,?,?,?,?,?,?)",
											array($this->common->getRealIpAddr(),$this->common->getDate(),$bene_name,$acc_no,$ifsc,0,$mobile_no,false,"",'no',"",$bank) );
							if($insertrslt == true)		
							{
								$insert_id = $this->db->insert_id();
							}
						}
						
						
						//$otprsp = $this->remitter_registration_getotp($mobile_no,$userinfo,"beneficiaryOtp");
						//echo $otprsp;exit;
						
						$url = "https://pass-api.paytmbank.com/api/tops/remittance/v1/user/add-beneficiary";
						
						$jwtToken = $this->jwt_token();
						$request_array = array(
							'beneficiaryDetails'=>array(
								'accountNumber'=>$acc_no,
								'bankName'=>$bank,
								'benIfsc'=>$ifsc,
								'name'=>$bene_name,
								'nickName'=>$bene_name,
							),
							'customerMobile'=>$mobile_no
						);
						
						$json_reqarray = json_encode($request_array);
				
						
						$curl = curl_init();
				
						curl_setopt_array($curl, array(
						  CURLOPT_URL => $url,
						  CURLOPT_RETURNTRANSFER => true,
						  CURLOPT_ENCODING => "",
						  CURLOPT_MAXREDIRS => 10,
						  CURLOPT_TIMEOUT => 30,
						  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
						  CURLOPT_CUSTOMREQUEST => "POST",
						  CURLOPT_POSTFIELDS => $json_reqarray,
						  CURLOPT_HTTPHEADER => array(
							"authorization: ".$jwtToken,
							"cache-control: no-cache",
							"content-type: application/json",
							"postman-token: 602e1e0d-ce9a-01b8-9658-5ef3695891a5"
						  ),
						));
				
						$response = curl_exec($curl);
						$err = curl_error($curl);
						
				//echo "https://pass-api.paytmbank.com/api/tops/remittance/v1/user/add-beneficiary";
				//echo "<br>";
				//echo $json_reqarray."<br>";
						
				//echo $response;exit;
						curl_close($curl);
				//echo $response;exit;
					/*
					
					{"status":"success","response_code":0,"customerMobile":"8238232303","beneficiaryId":"27da5930a51740768783efa20a4de20a"}
					*/
							
						$json_resp = json_decode($response);
							
							if(isset($json_resp->status) and isset($json_resp->response_code))
							{
									// user not exist
									// redirect to registration form
								$status = trim($json_resp->status);
								$response_code = trim($json_resp->response_code);
								if($status == "success")
								{
									$recipient_id = $json_resp->beneficiaryId;
									
									$this->db->query("update beneficiaries set 
									is_paytm = 'yes',
									paytm_bene_id=?
									where Id = ?",array($recipient_id,intval($insert_id)));
									$resp_arr = array(
															"message"=>$status,
															"status"=>0,
															"statuscode"=>"TXN",
															"data"=>$insert_id,
														);
									$json_resp =  json_encode($resp_arr);
									
									
									
									$this->load->model("Bankit");
									$this->Bankit->add_benificiary($mobile_no,$bene_name,$bene_mobile,$acc_no,$ifsc,$bank,$userinfo);
								}
								else
								{
									
										$resp_arr = array(
																"message"=>$status,
																"status"=>1,
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
		$this->loging("Shootcase_set_beneficiary",$url,$response,$json_resp,$userinfo->row(0)->username);
		return $json_resp;
		
	}
	
	
	public function verify_bene($mobile_no,$acc_no,$ifsc,$bank,$userinfo)
	{
		$url= "";
		$response = $json_resp = "";
		if($userinfo != NULL)
		{
			if($userinfo->num_rows() == 1)
			{
			   
				
				$user_id = $userinfo->row(0)->user_id;
				$usertype_name = $userinfo->row(0)->usertype_name;
				$user_status = $userinfo->row(0)->status;
				if($usertype_name == "APIUSER")
				{
					if($user_status == '1')
					{
						
						$accval_resultcheck = $this->db->query("SELECT RESP_benename FROM `mt3_account_validate` where account_no = ? and remitter_mobile = ? and user_id = ? and status = 'SUCCESS' and API = 'PAYTM' order by Id desc limit 1",
						array($acc_no,$mobile_no,$user_id));
						if($accval_resultcheck->num_rows() == 1)
						{
						    $resp_arr = array(
													"message"=>"Beneficiary Already Validated. ".$accval_resultcheck->row(0)->RESP_benename,
													"status"=>1,
													"statuscode"=>"ERR",
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
    						$rsltinsert = $this->db->query("insert into mt3_account_validate(user_id,add_date,edit_date,ipaddress,remitter_id,remitter_mobile,account_no,IFSC,status,API) values(?,?,?,?,?,?,?,?,?,?)",array(
    							$user_id,$this->common->getDate(),$this->common->getDate(),$this->common->getRealIpAddr(),$mobile_no,$mobile_no,$acc_no,$ifsc,"PENDING","PAYTM"
    						));
    						if($rsltinsert == true)
    						{
    							$insert_id = $this->db->insert_id();
    							$transaction_type = "DMR";
    							$sub_txn_type = "Account_Validation";
    							$charge_amount = 3.00;
    							$Description = "Valid.Charge : ".$acc_no;
    							$remark = $mobile_no."  Acc NO :".$acc_no;
    							$debitpayment = $this->PAYMENT_DEBIT_ENTRY($user_id,$insert_id,$transaction_type,$charge_amount,$Description,$sub_txn_type,$remark,0);
    
    							if($debitpayment == true)
    							{
    								$unique_id = $insert_id;
									$ddbit_amount_a = 1;
									$url = "https://pass-api.paytmbank.com/api/tops/remittance/v2/penny-drop";
									
									$jwtToken = $this->jwt_token();
									/*$request_array = array(
										'beneficiaryDetails'=>array(
											'accountNumber'=>$acc_no,
											'bankName'=>$bank,
											'benIfsc'=>$ifsc,
										),
										'customerMobile'=>$mobile_no,
										'txnReqId'=>"VERIFY".$insert_id,
										'transactionType'=>"transactionType",
										'channel'=> 'S2S',

									);*/


									$request_array = array(
										'beneficiaryDetails'=>array(
											'accountNumber'=>$acc_no,
											'bankName'=>$bank,
											'benIfsc'=>$ifsc,
										),
										'customerMobile'=>$mobile_no,
										'txnReqId'=>"VERIFY".$insert_id,
										'transactionType'=>"CORPORATE_PENNY_DROP",
										'channel'=> 'S2S',

									);






									
									$json_reqarray = json_encode($request_array);
							
									
									$curl = curl_init();
							
									curl_setopt_array($curl, array(
									  CURLOPT_URL => $url,
									  CURLOPT_RETURNTRANSFER => true,
									  CURLOPT_ENCODING => "",
									  CURLOPT_MAXREDIRS => 10,
									  CURLOPT_TIMEOUT => 30,
									  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
									  CURLOPT_CUSTOMREQUEST => "POST",
									  CURLOPT_POSTFIELDS => $json_reqarray,
									  CURLOPT_HTTPHEADER => array(
										"authorization: ".$jwtToken,
										"cache-control: no-cache",
										"content-type: application/json",
										"postman-token: 602e1e0d-ce9a-01b8-9658-5ef3695891a5"
									  ),
									));
							
									$response = curl_exec($curl);
									$err = curl_error($curl);
									curl_close($curl);
									$json_resp = json_decode($response);
									//echo $url."<br><br>";


									//echo $json_reqarray."<br><br>";
									//echo "resp ".$response;exit;
									/*
										{"status":"success","message":"Transfer Successful","amount":2.48,"customerMobile":"8238232303","response_code":0,"txn_id":"VERIFY100166341","mw_txn_id":"65951381","extra_info":{"beneficiaryName":"RAVIKANT LAXMANBHAI"},"rrn":"929623462138","transactionDate":"Wed Oct 23 23:33:11 IST 2019"}
									*/
									$recipient_name = "";
									if(isset($json_resp->status) and isset($json_resp->message))
									{
										// user not exist
										// redirect to registration form
										$status = trim($json_resp->status);
										$message = trim($json_resp->message);
										if($status == "success")
										{
											if(isset($json_resp->extra_info))
											{
												$extra_info = $json_resp->extra_info;
												if(isset($extra_info->beneficiaryName))
												{
													$recipient_name = $extra_info->beneficiaryName;
													$resp_arr = array(
        																	"message"=>$message."  Name : ".$recipient_name,
        																	"status"=>0,
        																	"statuscode"=>"TXN",
        																	"recipient_name"=>$recipient_name
        																);
        											$json_resp =  json_encode($resp_arr);
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
    																							    "VERIFIED",
    																								$insert_id
    																							)
    																						);
												}
											}
										}
										else if($status == "pending" or $status == "unknown")
										{
											$resp_arr = array(
        																	"message"=>$message,
        																	"status"=>1,
        																	"statuscode"=>"TUP",
        																	"recipient_name"=>$recipient_name
        																);
											$json_resp =  json_encode($resp_arr);
											$this->db->query("update mt3_account_validate 
																					set RESP_statuscode = ?,
																						RESP_status = ?,
																						verification_status = ?,
																						status = 'PENDING'
																						where 	Id = ?",
																						array
																						(
																							"TUP",
																							$message,
																							"PENDING",
																							$insert_id
																						)
																					);
										}
										else if($status == "failure")
										{
											
											$this->PAYMENT_CREDIT_ENTRY($user_id,$insert_id,$transaction_type,$charge_amount,$Description,$sub_txn_type,$remark,0);
                                                    
											$resp_arr = array(
																	"message"=>$message,
																	"status"=>1,
																	"statuscode"=>"ERR",
																	"recipient_name"=>$recipient_name
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
        																	"statuscode"=>"TUP",
        																	"recipient_name"=>$recipient_name
        																);
											$json_resp =  json_encode($resp_arr);
											$this->db->query("update mt3_account_validate 
																					set RESP_statuscode = ?,
																						RESP_status = ?,
																						verification_status = ?,
																						status = 'PENDING'
																						where 	Id = ?",
																						array
																						(
																							"TUP",
																							$message,
																							"PENDING",
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
		$this->loging("paytm_bene_verify",$url."?".json_encode($request_array)." ........".$jwtToken,$response,$json_resp,$userinfo->row(0)->username);
		return $json_resp;
		
	}
	public function transfer($remittermobile,$beneficiary_array,$amount,$mode,$userinfo,$order_id)
	{
		$postfields = '';
		$jwtToken = "";
		$transtype = "IMPSIFSC";
		$apimode = "2";
		
		if($mode == "NEFT" or $mode == "1")
		{
		    $transtype = "NEFT";
		    $mode = "NEFT";
			$apimode = "1";
		}
		$postparam = $remittermobile." <> ".$beneficiary_array->row(0)->paytm_bene_id." <> ".$amount." <> ".$mode;
		$buffer = "No Api Call";
		if($userinfo != NULL)
		{
			if($userinfo->num_rows() == 1)
			{
				$url = '';
				$user_id = $userinfo->row(0)->user_id;
				$usertype_name = $userinfo->row(0)->usertype_name;
				$user_status = $userinfo->row(0)->status;
				if($usertype_name == "APIUSER")
				{
					if($user_status == '1')
					{
						if($amount >= 100)
						{
						    $crntBalance = $this->Common_methods->getAgentBalance($user_id);
    						if(floatval($crntBalance) >= floatval($amount) + 30)
    						{
    						
    								if($beneficiary_array->num_rows() >= 1)
    								{
    									$benificiary_name = $beneficiary_array->row(0)->bene_name;
    									$benificiary_mobile = $beneficiary_array->row(0)->benemobile;
    									$benificiary_ifsc = $beneficiary_array->row(0)->IFSC;
    									$benificiary_account_no = $beneficiary_array->row(0)->account_number;
										$beneficiaryid = $beneficiary_array->row(0)->paytm_bene_id;
    									$chargeinfo = $this->getChargeValue($userinfo,$amount);
    									if($chargeinfo != false)
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
    										
    										$ccf = $chargeinfo->row(0)->ccf;	
    										$cashback = $chargeinfo->row(0)->cashback;	
    										$tds = $chargeinfo->row(0)->tds;	
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
    											order_id,
												add_date,
												ipaddress,
												user_id,
    											Charge_type,
    											charge_value,
    											Charge_Amount,
    											RemiterMobile,
    											BeneficiaryId,
    											AccountNumber,
    											IFSC,
    											Amount,
    											Status,
    											mode,
												API,
												ccf,cashback,tds)
    											values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)
    											",array(
												$order_id,
												$this->common->getDate(),
												$this->common->getRealIpAddr(),
												$user_id,
    											$Charge_type,$charge_value,$Charge_Amount,
    											$remittermobile,
    											$beneficiaryid,
												$benificiary_account_no,
												$benificiary_ifsc,
    											$amount,
												"PENDING",
												$mode,
												"PAYTM",
												$ccf,
												$cashback,
												$tds
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
    																							"statuscode"=>"TUP",
    																						);
    																	$json_resp =  json_encode($resp_arr);
    												}
    												else
    												{
    													
    													
    												    $timestamp = str_replace('+00:00', 'Z', gmdate('c', strtotime($this->common->getDate())));
        												$jwtToken = $this->jwt_token();
	
													

        												if($mode == "NEFT")
        												{
															$request_array = array(
																'amount'=>$amount,
																'beneficiaryId'=>$beneficiaryid,
																'channel'=>'S2S',
																'customerMobile'=>$remittermobile,
																'transactionType'=>'CORPORATE_DOMESTIC_REMITTANCE',
																'txnReqId'=>$insert_id,
																"mode"=>strtolower($mode),
																"ifscBased"=>false
																);
        												}
        												else
        												{
        													$request_array = array(
																'amount'=>$amount,
																'beneficiaryId'=>$beneficiaryid,
																'channel'=>'S2S',
																'customerMobile'=>$remittermobile,
																'transactionType'=>'CORPORATE_DOMESTIC_REMITTANCE',
																'txnReqId'=>$insert_id,
																'extra_info'=>array(
																	"mode"=>strtolower($mode),
																	"ifscBased"=>false
																)
														);
        												}

														
														
														$json_reqarray = json_encode($request_array);
														$url = "https://pass-api.paytmbank.com/api/tops/remittance/v2/fund-transfer";
														$curl = curl_init();
												
														curl_setopt_array($curl, array(
														  CURLOPT_URL => $url,
														  CURLOPT_RETURNTRANSFER => true,
														  CURLOPT_ENCODING => "",
														  CURLOPT_MAXREDIRS => 10,
														  CURLOPT_TIMEOUT => 30,
														  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
														  CURLOPT_CUSTOMREQUEST => "POST",
														  CURLOPT_POSTFIELDS => $json_reqarray ,
														  CURLOPT_HTTPHEADER => array(
															 "authorization: ".$jwtToken,
															"cache-control: no-cache",
															"content-type: application/json",
															"postman-token: e65364aa-3d7d-fea3-76db-c1cb36585a6f"
														  ),
														));
												
														$buffer = $response = curl_exec($curl);
														$err = curl_error($curl);
														/**
														{"status":"success","message":"Transfer Successful","amount":100.0,"customerMobile":"8238232303","response_code":0,"txn_id":"14","mw_txn_id":"23947395",
														"extra_info":{"totalAmount":"110.00","beneficiaryName":"Mr RAVIKANT LAXMANB","commission":"10.00"},"rrn":"916614536820","transactionDate":"Sat Jun 15 14:55:24 IST 2019"}
														**/
												
												curl_close($curl);
												$this->loging("PAYTM_transfer",$mode." ".$url."?".$json_reqarray." >>>> TOKEN ".$jwtToken,$response,$response,$userinfo->row(0)->mobile_no);
														       

/*
{"status":"pending","message":"The amount will be transferred to CHAMPION SOFTWARE TECHNOLOGIES's bank account ","amount":102.0,"customerMobile":"8866628967","response_code":0,"txn_id":"1436095","mw_txn_id":"77297878","extra_info":{"mode":"neft","totalAmount":"112.00","utr":"PYTMH19326125256","beneficiaryName":"CHAMPION SOFTWARE TECHNOLOGIES","commission":"10.00","transfer_type":"neft"},"rrn":"PYTMH19326125256"}
*/														       
															$json_obj = json_decode($response);
															if(isset($json_obj->status) and isset($json_obj->message))
    														{
        														$status = $json_obj->status;
    															$message = $json_obj->message;
    															if($status == "success")
    															{
																	$txn_id = $json_obj->txn_id;
																	$mw_txn_id = $json_obj->mw_txn_id;
																	$rrn = $json_obj->rrn;
																	$extra_info = $json_obj->extra_info;
    																
    																
    																$data = array(
    																			'RESP_statuscode' => "TXN",
    																			'RESP_status' => $message,
    																			'RESP_ipay_id' => $mw_txn_id,
    																			'RESP_opr_id' => $rrn,
    																			'RESP_name' => $extra_info->beneficiaryName,
    																			'message'=>$message,
    																			'Status'=>'SUCCESS',
    																			'edit_date'=>$this->common->getDate()
    																	);
    
    																	$this->db->where('Id', $insert_id);
    																	$this->db->update('mt3_transfer', $data);
    
                                                                        $sendmsg = 'Transaction Successful, TID: '.$rrn.' Amt:Rs.'.$amount.' A/C: '.$benificiary_account_no.'  '.$this->common->getDate().' Thanks,mastermoney';
                                                                        $this->db->query("insert into tempsms(message,to_mobile) values(?,?)",array($sendmsg,$remittermobile));
																		$resp_arr = array(
    																						"message"=>$message,
    																						"status"=>0,
																							"statuscode"=>"TXN",
    																						"data"=>array(
    																							"tid"=>$insert_id,
    																							"ref_no"=>$insert_id,
    																							"opr_id"=>$rrn,
    																							"name"=>$extra_info->beneficiaryName,																								"balance"=>"",
    																							"amount"=>$amount,
    
    																						)
    																					);
    																	$json_resp =  json_encode($resp_arr);
    															}
																else if($status == "failure")
																{
																	$this->PAYMENT_CREDIT_ENTRY($user_id,$insert_id,$transaction_type,$dr_amount,$Description,$sub_txn_type,$remark,$Charge_Amount,$userinfo);	
																	
																	

																	$data = array(
																			'RESP_statuscode' => "ERR",
																			'RESP_status' => $message,
																			'Status'=>'FAILURE',
																			'edit_date'=>$this->common->getDate()
																	);

																	$this->db->where('Id', $insert_id);
																	$this->db->update('mt3_transfer', $data);
																	$resp_arr = array(
																							"message"=>$message,
																							"status"=>1,
																							"statuscode"=>"ERR",
																						);
																	$json_resp =  json_encode($resp_arr);

																}
																else if($status == "pending")
    															{
																	$txn_id = $json_obj->txn_id;
																	$mw_txn_id = $json_obj->mw_txn_id;
																	$rrn = $json_obj->rrn;
																	$extra_info = $json_obj->extra_info;
    																
    																
    																$data = array(
    																			'RESP_statuscode' => "TXN",
    																			'RESP_status' => $message,
    																			'RESP_ipay_id' => $mw_txn_id,
    																			'RESP_opr_id' => $rrn,
    																			'RESP_name' => $extra_info->beneficiaryName,
    																			'message'=>$message,
    																			'Status'=>'SUCCESS',
    																			'edit_date'=>$this->common->getDate()
    																	);
    
    																	$this->db->where('Id', $insert_id);
    																	$this->db->update('mt3_transfer', $data);
    
                                                                        $sendmsg = 'Transaction Successful, TID: '.$rrn.' Amt:Rs.'.$amount.' A/C: '.$benificiary_account_no.'  '.$this->common->getDate().' Thanks,mastermoney';
                                                                        $this->db->query("insert into tempsms(message,to_mobile) values(?,?)",array($sendmsg,$remittermobile));
																		$resp_arr = array(
    																						"message"=>$message,
    																						"status"=>0,
																							"statuscode"=>"TXN",
    																						"data"=>array(
    																							"tid"=>$insert_id,
    																							"ref_no"=>$insert_id,
    																							"opr_id"=>$rrn,
    																							"name"=>$extra_info->beneficiaryName,																								"balance"=>"",
    																							"amount"=>$amount,
    
    																						)
    																					);
    																	$json_resp =  json_encode($resp_arr);
    															}
    															
        														else
    															{
    																$data = array(
    																				"RESP_status"=>$message,
    																				'RESP_statuscode' => "UNK",
    																				'Status'=>'PENDING',
    																				'RESP_statuscode'=>$status,
    																				'edit_date'=>$this->common->getDate()
    																	);
    
    																	$this->db->where('Id', $insert_id);
    																	$this->db->update('mt3_transfer', $data);
    																	$resp_arr = array(
    																							"message"=>$message,
    																							"status"=>2,
    																							"statuscode"=>"TUP",
    																						);
    																	$json_resp =  json_encode($resp_arr);
    															}
        
        
        													}
															else if(isset($json_obj->errorCode) and isset($json_obj->errorMessage))
    														{
        														$errorCode = $json_obj->errorCode;
    															$errorMessage = $json_obj->errorMessage;
    															$data = array(
    																				"RESP_status"=>$errorMessage,
    																				'RESP_statuscode' => $errorCode,
    																				'Status'=>'PENDING',
    																				'edit_date'=>$this->common->getDate()
    																	);
    
    																	$this->db->where('Id', $insert_id);
    																	$this->db->update('mt3_transfer', $data);
    																	$resp_arr = array(
    																							"message"=>$errorMessage,
    																							"status"=>2,
    																							"statuscode"=>"TUP",
    																						);
    																	$json_resp =  json_encode($resp_arr);
        
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
        																"message"=>"Your Request Submitted Successfully",
        																"status"=>0,
        																"statuscode"=>"TUP",
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
    									"message"=>"Minimum Balance Limit is 1000 Rupees",
    									"status"=>1,
    									"statuscode"=>"ERR",
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
		$this->loging("paytm_transfer",$mode." ".$url."?".$request_array."  ..........".$jwtToken,$buffer,$json_resp,$userinfo->row(0)->username);
		return $json_resp;
		
	}
	
	public function transfer_resend_hold($Id)
	{
	    $insert_id = $Id;
	    $rslttransaction = $this->db->query("SELECT * FROM `mt3_transfer` where Status = 'HOLD' and Id = ?",array($Id));
		$remitter_id = $rslttransaction->row(0)->RemiterMobile;
		$remittermobile = $remitter_id;
		$benificiary_account_no = $rslttransaction->row(0)->BeneficiaryId;
		$mobile_no = $remitter_id;
		$mode = $rslttransaction->row(0)->mode;
		$user_id = $rslttransaction->row(0)->user_id;
		$beneficiaryid = $rslttransaction->row(0)->BeneficiaryId;
		$Charge_Amount = $rslttransaction->row(0)->Charge_Amount;
	
		$AccountNumber = $rslttransaction->row(0)->AccountNumber;
		$benificiary_account_no = $AccountNumber;
		$IFSC = $rslttransaction->row(0)->IFSC;
		$amount = $rslttransaction->row(0)->Amount;
		$dist_charge_amount= $rslttransaction->row(0)->dist_charge_amount;
		$postfields = '';
		$userinfo = $this->db->query("select * from tblusers where user_id = ?",array($user_id));
		if($mode == "IMPS"){$apimode = "2";}
		if($mode == "NEFT"){$apimode = "1";}
		
		
		if($mode == "NEFT" or $mode == "1")
		{
		    $transtype = "NEFT";
		    $mode = "NEFT";
			$apimode = "1";
		}
		
		$postparam = $remittermobile." <> ".$beneficiaryid." <> ".$amount." <> ".$mode;
		$buffer = "No Api Call";
		if($userinfo != NULL)
		{
			if($userinfo->num_rows() == 1)
			{
				$url = '';
				$user_id = $userinfo->row(0)->user_id;
				$DId = $userinfo->row(0)->parentid;
				$MdId = 0;
				$usertype_name = $userinfo->row(0)->usertype_name;
				$user_status = $userinfo->row(0)->status;
				
				$parentinfo = $this->db->query("select * from tblusers where user_id = ?",array($DId));
				if($parentinfo->num_rows() == 1)
				{
						$MdId = $parentinfo->row(0)->parentid;
				}
					
					
				$this->db->query("update mt3_transfer set Status = 'PENDING',API = 'SHOOTCASE' where Id = ?",array($Id));
					
				$PIN = $this->getpin($remitter_id);
			    $timestamp = str_replace('+00:00', 'Z', gmdate('c', strtotime($this->common->getDate())));
				$data = array(
					"sendermobile"=>$remitter_id,
					"senderpinno"=>$PIN,
					"beneficiaryid"=>$beneficiaryid,
					"remark"=>urlencode($remark),
					"transtype"=>$transtype,
					"transamount"=>$amount,
					"agentmerchantid"=>$insert_id,
					);
					
						$url = 'http://www.deziremoney.co.in/apis/v1/dmr?action=paynow&authKey='.$this->getdauthKey().'&clientId='.$this->getClientId().'&userId='.$this->getUserId().'&data='.json_encode($data);
						

						$ch = curl_init();
						curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
						curl_setopt($ch, CURLOPT_URL, $url);
						curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
						curl_setopt($ch, CURLOPT_TIMEOUT, 60);
						$response = $buffer = curl_exec($ch);
						curl_close($ch);
						$json_obj = json_decode($response);

						if(isset($json_obj->STATUS) and isset($json_obj->MESSAGE))
						{
							$status = $json_obj->STATUS;
							$message = $json_obj->MESSAGE;
							if($status == "1")
							{
								$tid = "";
								if(isset($json_obj->DATA))
								{
									$tid = $json_obj->DATA;	
								}
								$fee = "";
								$collectable_amount = "";
								$utility_acc_no = "";
								$sender_name = "";
								$balance = "";
								$recipient_name = "";
								$data = array(
											'RESP_statuscode' => "TXN",
											'RESP_status' => $message,
											'RESP_ipay_id' => $tid,
											'RESP_ref_no' => "",
											'RESP_opr_id' => $tid,
											'RESP_name' => $benificiary_name,
											'RESP_opening_bal' => "",
											'RESP_amount' => "",
											'RESP_locked_amt' => "",
											'tx_status'=>$message,
											"row_lock"=>"LOCKED",
											'Status'=>'SUCCESS'
									);

									$this->db->where('Id', $insert_id);
									$this->db->update('mt3_transfer', $data);
                                    
                                    $sendmsg = 'Transaction Successful, TID: '.$tid.' Amt:Rs.'.$amount.' A/C: '.$benificiary_account_no.'  '.$this->common->getDate().' Thanks,masterpay';
                                    $this->common->ExecuteSMSApi($remittermobile,$sendmsg);
                                    $this->COMMISSIONPAYMENT_CREDIT_ENTRY($DId,$insert_id,$transaction_type,$dist_charge_amount,$Description,$sub_txn_type,$remark,$chargeAmount = 0.00);
									$resp_arr = array(
														"message"=>$message,
														"status"=>0,
														"data"=>array(
															"tid"=>$tid,
															"ref_no"=>$insert_id,
															"opr_id"=>$tid,
															"name"=>$benificiary_name,
															"balance"=>"",
															"amount"=>$amount,

														)
													);
									$json_resp =  json_encode($resp_arr);
							}
							else if($status == "4")
							{
								
								$tid = "";
								if(isset($json_obj->DATA))
								{
									$tid = $json_obj->DATA;	
								}
									$fee = "";
									$collectable_amount = "";
									$utility_acc_no = "";
									$sender_name = "";
									$balance = "";
									$recipient_name = "";
									$data = array(
												'RESP_statuscode' => "TUP",
												'RESP_status' => $message,
												'RESP_ipay_id' => $tid,
												'RESP_ref_no' => $insert_id,
												'RESP_opr_id' => $tid,
												'RESP_name' => $benificiary_name,
												'RESP_opening_bal' => "",
												'RESP_amount' => $amount,
												'RESP_locked_amt' => "",
												'tx_status'=>$message,
												"row_lock"=>"OPEN",
												'Status'=>'PENDING'
										);

										$this->db->where('Id', $insert_id);
										$this->db->update('mt3_transfer', $data);
										$resp_arr = array(
															"message"=>$message,
															"status"=>0,
															"data"=>array(
																"tid"=>$tid,
																"ref_no"=>$insert_id,
																"opr_id"=>$tid,
																"name"=>$benificiary_name,
																"balance"=>"",
																"amount"=>"",

															)
														);
										$json_resp =  json_encode($resp_arr);	

								
							}
							else if($status == "2")
							{
								    $transaction_type = "DMR";
									$dr_amount = $amount;
									$Description = "DMR ".$remittermobile." Acc No : ".$benificiary_account_no;
									$sub_txn_type = "REMITTANCE";
									$remark = "Money Remittance";
								    $this->PAYMENT_CREDIT_ENTRY($user_id,$insert_id,$transaction_type,$dr_amount,$Description,$sub_txn_type,$remark,$Charge_Amount,$userinfo);
									$data = array(
												'RESP_statuscode' => $status,
												'RESP_status' => $message,
												'tx_status'=>$message,
												'Status'=>'FAILURE',
												"row_lock"=>"LOCKED",
										);

									$this->db->where('Id', $insert_id);
									$this->db->update('mt3_transfer', $data);
									$resp_arr = array(
															"message"=>$message,
															"status"=>1,
															"statuscode"=>$status,
														);
									$json_resp =  json_encode($resp_arr);   
								
							}
							else
							{
								$data = array(
												"RESP_status"=>$message,
												'RESP_statuscode' => "UNK",
												'RESP_status' => "Unknown Response",
												'Status'=>'PENDING',
												'RESP_statuscode'=>$status,
												'tx_status'=>message,
									);

									$this->db->where('Id', $insert_id);
									$this->db->update('mt3_transfer', $data);
									$resp_arr = array(
															"message"=>"Unknown Response",
															"status"=>$status,
															"statuscode"=>"UNK",
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
		$this->loging("shootcase_hold_resend",$url."?".$postfields,$buffer,$json_resp,$userinfo->row(0)->username);
		return $json_resp;
		
	}
	
	
	
	
	
	
	
	public function transfer_status($dmr_id)
	{
	    
	 
		    $resultdmr = $this->db->query("SELECT a.API,a.Id,a.add_date,a.user_id,a.Charge_type,a.charge_value,a.Charge_Amount,a.RemiterMobile,
a.debit_amount,a.credit_amount,a.BeneficiaryId,a.AccountNumber,
a.IFSC,a.Amount,a.Status,a.debited,a.balance,a.mode,
a.RESP_statuscode,a.RESP_status,a.RESP_ipay_id,a.RESP_opr_id,a.RESP_name,
b.businessname,b.username


FROM `mt3_transfer` a
left join tblusers b on a.user_id = b.user_id

 where a.Id = ?",array($dmr_id));
		
		
		
		if($resultdmr->num_rows() == 1)
		{
			$Status = $resultdmr->row(0)->Status;
			$user_id = $resultdmr->row(0)->user_id;
			$API = $resultdmr->row(0)->API;
			$RESP_status = $resultdmr->row(0)->RESP_status;
			$RESP_name = $resultdmr->row(0)->RESP_name;
			$Amount = $amount = $resultdmr->row(0)->Amount;
			$RESP_opr_id = $resultdmr->row(0)->RESP_opr_id;
			$RESP_ipay_id = $resultdmr->row(0)->RESP_ipay_id;
			$debit_amount = $resultdmr->row(0)->debit_amount;
			if($API == "PAYTM")
			{
				$paymentinfo = $this->db->query("SELECT transaction_type,description,remark,credit_amount,debit_amount FROM tblewallet where dmr_id =? and user_id = ?",array($dmr_id,$user_id));
			
			
				if($paymentinfo->num_rows() == 0)
				{
					$data = array(
									'RESP_statuscode' => "ERR",
									'RESP_status' => "Payment Failure",
									'RESP_name' => "",
									'RESP_opening_bal' => "",
									'RESP_amount' => "",
									'RESP_locked_amt' => "",
									'tx_status'=>"Payment Failure",
									"row_lock"=>"LOCKED",
									'Status'=>'FAILURE'
							);
	
					$this->db->where('Id', $dmr_id);
					$this->db->update('mt3_transfer', $data);    
				}
				else
				{
					$benificiary_account_no = $resultdmr->row(0)->AccountNumber;
					$Charge_Amount = $resultdmr->row(0)->Charge_Amount;
					$remittermobile = $resultdmr->row(0)->RemiterMobile;
					$Description = "DMR ".$remittermobile." Acc No : ".$benificiary_account_no;
					$sub_txn_type = "REMITTANCE";
					$remark = "Money Remittance";
					if($API == "PAYTM")
					{
						
						if($Status == "PENDING" )
						{
							$jwtToken = $this->jwt_token();
							$curl = curl_init();
					$url = "https://pass-api.paytmbank.com/api/tops/remittance/v1/status?transactionType=CORPORATE_DOMESTIC_REMITTANCE&txnReqId=".$dmr_id;
							curl_setopt_array($curl, array(
							CURLOPT_URL => $url,
						   CURLOPT_RETURNTRANSFER => true,
						   CURLOPT_ENCODING => "",
						   CURLOPT_MAXREDIRS => 10,
						   CURLOPT_TIMEOUT => 30,
						   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
						   CURLOPT_CUSTOMREQUEST => "GET",
						   CURLOPT_HTTPHEADER => array(
							"authorization: ".$jwtToken,
							"cache-control: no-cache",
							"postman-token: f8859c27-ec4b-dab3-a7de-6a4f1cc01c93"
						   ),
						));
					
							$response = curl_exec($curl);
							$err = curl_error($curl);
							curl_close($curl);
							$json_obj = json_decode($response);
							
							$this->loging("paytmtransfer_status",$url,$response,"","");
							/*
							{"status":"pending","response_code":0,"txn_id":"13504","mw_txn_id":"25834509","rrn":"917510334958"}
							
							{"status":"success","response_code":0,"txn_id":"32898","mw_txn_id":"26358880","rrn":"917622490084"}
							
							{"status":"failure","message":"Invalid combination of transaction request id/client and transactiontype","response_code":1041,"txn_id":"32941"}
							*/
						   if(isset($json_obj->status) and isset($json_obj->response_code))
						   {
							   $status = $json_obj->status;
							   $response_code = $json_obj->response_code;
							   if($status == "success" and $response_code == "0") // SUCCESS
							   {
								   $txn_id = $json_obj->txn_id;
								   $mw_txn_id = $json_obj->mw_txn_id;
								   $rrn = $json_obj->rrn;
									$data = array(
														'RESP_statuscode' => "TXN",
														'RESP_status' => $status,
														'RESP_ipay_id' => $txn_id,
														'RESP_opr_id' => $rrn,
														'Status'=>'SUCCESS'
												);
		
									$this->db->where('Id', $dmr_id);
									$this->db->update('mt3_transfer', $data);
									
									$resp_arr = array(
											"message"=>$status,
											"status"=>0,
											"statuscode"=>"TXN",
											"data"=>array(
												"tid"=>$dmr_id,
												"ref_no"=>$txn_id,
												"opr_id"=>$rrn,
												"name"=>$RESP_name,
												"amount"=>$amount,

											)
										);
									$json_resp =  json_encode($resp_arr); 
							   }
							   else if($status == "failure") // SUCCESS
							   {
								   $txn_id = $json_obj->txn_id;
								   $rrn = "NA";
									$data = array(
														'RESP_statuscode' => "TXN",
														'RESP_status' => $status,
														'RESP_ipay_id' => $txn_id,
														'RESP_opr_id' => $rrn,
														'Status'=>'FAILURE'
												);
		
									$this->db->where('Id', $dmr_id);
									$this->db->update('mt3_transfer', $data);
									$transaction_type = "DMR";
									$dr_amount = $amount;
									$Description = "DMR ".$remittermobile." Acc No : ".$benificiary_account_no;
									$sub_txn_type = "REMITTANCE";
									$remark = "Money Remittance";
									$this->PAYMENT_CREDIT_ENTRY($user_id,$dmr_id,$transaction_type,$dr_amount,$Description,$sub_txn_type,$remark,$Charge_Amount,$userinfo);	
																	
									
									$resp_arr = array(
											"message"=>$status,
											"status"=>1,
											"statuscode"=>"ERR",
										);
									$json_resp =  json_encode($resp_arr); 
									return $json_resp;
							   }
							   else if($status == "pending" and $response_code == "0") // PENDING
							   {
								  $resparray = array(
										"message"=>"Transaction In Pending Process",
										"status"=>2,
										"statuscode"=>"TUP"
										);
									return json_encode($resparray);   
							   }
							   else 
							   {
								   echo $response;
							   }
		
						   }
						   else
						   {
							  echo $response;
						   }
						
						}
						else if($Status == "SUCCESS")
						{
				
							$resp_arr = array(
											"message"=>"SUCCESS",
											"status"=>0,
											"statuscode"=>"TXN",
											"data"=>array(
												"tid"=>$dmr_id,
												"ref_no"=>$RESP_ipay_id,
												"opr_id"=>$RESP_opr_id,
												"name"=>$RESP_name,
												"amount"=>$amount,

											)
										);
							$json_resp =  json_encode($resp_arr); 
							return $json_resp;
						}
						else if($Status == "FAILURE")
						{
					
							$resp_arr = array(
											"message"=>"FAILURE",
											"status"=>1,
											"statuscode"=>"ERR",
										);
							$json_resp =  json_encode($resp_arr); 
							return $json_resp;
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
		}
		
			
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
		$this->db->query("insert into templog(dmt_id,add_date,ipaddress,request,response,downline_response,type) values(?,?,?,?,?,?,?)",
											array(0,$this->common->getDate(),$this->common->getRealIpAddr(),$request,$response,$json_resp,"PAYTM".$methiod));
		//**return "";
		//**echo $methiod." <> ".$request." <> ".$response." <> ".$json_resp." <> ".$username;exit;
		$log  = "User: ".$_SERVER['REMOTE_ADDR'].' - '.date("F j, Y, g:i a").PHP_EOL.
		"username: ".$username.PHP_EOL.
		"Request: ".$request.PHP_EOL.
        "Response: ".$response.PHP_EOL.
		"Downline Response: ".$json_resp.PHP_EOL.
        "Method: ".$methiod.PHP_EOL.
        "-------------------------".PHP_EOL;
		
		
		//echo $log;exit;
	//	$filename ='inlogs/'.$methiod.'log_'.date("j.n.Y").'.txt';
	//	if (!file_exists($filename)) 
	//	{
	//		file_put_contents($filename, '');
	//	} 
		
//Save string to log, use FILE_APPEND to append.
	//	file_put_contents('inlogs/'.$methiod.'log_'.date("j.n.Y").'.txt', $log, FILE_APPEND);
		
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
	

	
	public function PAYMENT_DEBIT_ENTRY($user_id,$transaction_id,$transaction_type,$dr_amount,$Description,$sub_txn_type,$remark,$chargeAmount = 0.00)
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
			
				
        		$result_oldbalance2 = $this->db->query("SELECT balance FROM masterpa_archive.tblewallet where user_id = ? order by Id desc limit 1",array($user_id));
        		if($result_oldbalance2->num_rows() > 0)
        		{
        			$old_balance =  $result_oldbalance2->row(0)->balance;
        		}
        		else 
        		{
        			
        			$old_balance =  0;
        			
        		}
			
		}
		$this->db->query("COMMIT;");
		
		//$old_balance = $this->Common_methods->getAgentBalance($user_id);
		if($old_balance < $dr_amount)
		{
		    return false;
		}
		else
		{
		    $current_balance = $old_balance - $dr_amount;
    		$tds = 0.00;
    		$stax = 0.00;
    		if($transaction_type == "DMR")
    		{
    			$str_query = "insert into  tblewallet(user_id,dmr_id,transaction_type,debit_amount,balance,description,add_date,ipaddress,remark)
    
    			values(?,?,?,?,?,?,?,?,?)";
    			$reslut = $this->db->query($str_query,array($user_id,$transaction_id,$transaction_type,$dr_amount,$current_balance,$Description,$add_date,$ip,$remark));
    			if($reslut == true)
    			{
    					$ewallet_id = $this->db->insert_id();
    					if($ewallet_id > 1)
    					{
    						if($sub_txn_type == "Account_Validation")
    						{
    									$rslt_updtrec = $this->db->query("update mt3_account_validate set debited='yes',reverted='no',balance=CONCAT_WS(',',balance,?),debit_amount = ? where Id = ?",array($current_balance,$dr_amount,$transaction_id));
    									return true;
    						}
    						else if($sub_txn_type == "REMITTANCE")
    						{
    									$current_balance2 = $current_balance - $chargeAmount;
    									$remark = "Transaction Charge";
    									$str_query_charge = "insert into  tblewallet(user_id,dmr_id,transaction_type,debit_amount,balance,description,add_date,ipaddress,remark)
    
    									values(?,?,?,?,?,?,?,?,?)";
    									$reslut2 = $this->db->query($str_query_charge,array($user_id,$transaction_id,$transaction_type,$chargeAmount,$current_balance2,$Description,$add_date,$ip,$remark));
    									if($reslut2 == true)
    									{
    										$totaldebit_amount = $dr_amount + $chargeAmount;
    										$ewallet_id2 = $ewallet_id.",".$this->db->insert_id();
    										$rslt_updtrec = $this->db->query("update mt3_transfer set debited='yes',reverted='no',balance=CONCAT_WS(',',balance,?),debit_amount = ? where Id = ?",array($current_balance2,$totaldebit_amount,$transaction_id));	
    										return true;
    									}
    									else
    									{
    										$rslt_updtrec = $this->db->query("update mt3_transfer set debited='yes',reverted='no',balance=CONCAT_WS(',',balance,?),debit_amount = ? where Id = ?",array($current_balance,$dr_amount,$transaction_id));	
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
	public function PAYMENT_CREDIT_ENTRY($user_id,$transaction_id,$transaction_type,$dr_amount,$Description,$sub_txn_type,$remark,$chargeAmount = 0.00)
	{
	    
	    
	    if($this->checkduplicate($user_id,$transaction_id) == false)
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
        		$tds = 0.00;
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
        									$rslt_updtrec = $this->db->query("update mt3_account_validate set reverted='yes',balance=CONCAT_WS(',',balance,?),credit_amount = ? where Id = ?",array($current_balance,$dr_amount,$transaction_id));
        									return true;
        						}
        						else if($sub_txn_type == "REMITTANCE")
        						{
        									$current_balance2 = $current_balance + $chargeAmount;
        									$remark = "Transaction Charge Reverse";
        									$str_query_charge = "insert into  tblewallet(user_id,dmr_id,transaction_type,credit_amount,balance,description,add_date,ipaddress,remark)
        
        									values(?,?,?,?,?,?,?,?,?)";
        									$reslut2 = $this->db->query($str_query_charge,array($user_id,$transaction_id,$transaction_type,$chargeAmount,$current_balance2,$Description,$add_date,$ip,$remark));
        									if($reslut2 == true)
        									{
        										$totaldebit_amount = $dr_amount + $chargeAmount;
        										$ewallet_id2 = $ewallet_id.",".$this->db->insert_id();
        										$rslt_updtrec = $this->db->query("update mt3_transfer set reverted='yes',balance=CONCAT_WS(',',balance,?), credit_amount = ? where Id = ?",array($current_balance2,$totaldebit_amount,$transaction_id));	
        										return true;
        									}
        									else
        									{
        										$rslt_updtrec = $this->db->query("update mt3_transfer set reverted='yes',balance=CONCAT_WS(',',balance,?),credit_amount = ? where Id = ?",array($current_balance,$dr_amount,$transaction_id));	
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
				$str_query = "insert into  tblewallet(user_id,dmr_id,transaction_type,credit_amount,balance,description,add_date,ipaddress,remark)
	
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
    
    
    $groupinfo = $this->db->query("select * from mt3_group where Id = (select dmr_group from tblusers where user_id = ?)",array($userinfo->row(0)->user_id));
	if($groupinfo->num_rows() == 1)
	{
		if($groupinfo->row(0)->charge_type == "SLAB")
		{
			$getrangededuction = $this->db->query("
			select 
				a.charge_type,
				a.charge_amount as charge_value,
				'PER' as dist_charge_type,
				'0.20' as dist_charge_value,
				a.ccf,
				a.cashback,
				a.tds
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
        				'0.20' as dist_charge_value,
        				a.ccf,
        				a.cashback,
        				a.tds
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
