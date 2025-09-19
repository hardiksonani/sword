<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Change_CSN extends CI_Controller {
	

	public function index()
	{ 
		$header_array = array(); 
		foreach (getallheaders() as $name => $value) 
		{
			$header_array[$name]= $value;
			//echo "$name: $value\n<br>";
		}
		if(isset($header_array["Authkey"]))
		{
		
			$header_developer_key = trim($header_array["Authkey"]);
			if($_SERVER['REQUEST_METHOD'] == 'POST')
			{
				
				$json = file_get_contents('php://input');
				$json_obj = json_decode($json);
				//sendermobile,account_number,ifsc
				if(isset($json_obj->username) && isset($json_obj->password) && isset($json_obj->sendermobile) && isset($json_obj->new_sendermobile))
				{
					$username = trim($json_obj->username);
					$pwd =  trim($json_obj->password);
					$sendermobile = trim($json_obj->sendermobile);
					$new_sendermobile = trim($json_obj->new_sendermobile);
					
				
					
				
					$userinfo = $this->db->query("
					select 
					a.user_id,
					a.businessname,
					a.username,
					a.status,
					a.usertype_name,
					a.mobile_no,
					a.mt_access,
					a.developer_key,
					info.client_ip,
					info.client_ip2,
					info.client_ip3,
					info.client_ip4
					from tblusers  a 
					left join tblusers_info info on a.user_id = info.user_id
					where a.mobile_no = ? and a.password = ?",array($username,$pwd));
					
					if($userinfo->num_rows() == 1)
					{
						$developer_key = $userinfo->row(0)->developer_key;
						$status = $userinfo->row(0)->status;
						$user_id = $userinfo->row(0)->user_id;
						$businessname = $userinfo->row(0)->businessname;
						$username = $userinfo->row(0)->username;
						$mobile_no = $userinfo->row(0)->mobile_no;
						$usertype_name = $userinfo->row(0)->usertype_name;
						$mt_access = $userinfo->row(0)->mt_access;
						
						$client_ip = $userinfo->row(0)->client_ip;
						$client_ip2 = $userinfo->row(0)->client_ip2;
						$client_ip3 = $userinfo->row(0)->client_ip3;
						$client_ip4 = $userinfo->row(0)->client_ip4;
						
						$ip = $this->common->getRealIpAddr();
						if($ip == $client_ip or $ip == $client_ip2 or $ip == $client_ip3 or $ip == $client_ip4)
						{
							if($status == '1')
							{
								if($mt_access != '1')
								{
									$resp_array = array(
										"message"=>"You Are Not Allowed To Use This Service",
										"status"=>1,
										"statuscode"=>"AUTH"
									);
									echo json_encode($resp_array);exit;
								}
								if($header_developer_key != $developer_key)
								{
									$resp_array = array(
										"message"=>"Invalid authentication_key",
										"status"=>1,
										"statuscode"=>"AUTH"
									);
									echo json_encode($resp_array);exit;
								}
								if(ctype_digit($sendermobile))
								{
									
										$rsltcommon = $this->db->query("select * from common where param = 'DMRSERVICE'");
										if($rsltcommon->num_rows() == 1)
										{
											$is_service = $rsltcommon->row(0)->value;
											if($is_service == "DOWN")
											{
												$resp_array = array(
													"message"=>"Dmt Service Temporarily Down",
													"status"=>1,
													"statuscode"=>"ERR"
												);
												echo json_encode($resp_array);exit;
											}
										}
										$rsltsender = $this->db->query("select Id,mobile,name,lastname,pincode from remitters where mobile = ? and otp_varified = 'yes' order by Id limit 1",array($sendermobile));
										if($rsltsender->num_rows() == 1)
										{
										    
										    
										    $checknewsender = $this->db->query("select Id,mobile,name,lastname,pincode from remitters where mobile = ? and otp_varified = 'yes' order by Id limit 1",array($new_sendermobile));
										    if($checknewsender->num_rows() == 1)
										    {
										        
										        
										        $oldbene = $this->db->query("select * from beneficiaries where sender_mobile = ?",array($sendermobile));
										        foreach($oldbene->result() as $bene)
										        {
										            
										            
										            
										            
										            $checkbeneexist = $this->db->query("select * from beneficiaries where sender_mobile = ? and account_number = ? and IFSC = ? order by Id desc limit 1",array($new_sendermobile,$bene->account_number,$bene->IFSC));
                            						if($checkbeneexist->num_rows() >=  1)
                            						{
                            						    $resp_arr = array(
                            														"message"=>"Beneficiary Already Registered",
                            														"status"=>0,
                            														"statuscode"=>"TXN",
                            														"data"=>$Id
                            													);
                            							$json_resp =  json_encode($resp_arr);
                            							
                            						}
                            						else
                            						{
                            						    $rsltbenes = $this->db->query("
										                insert into beneficiaries(ipaddress,add_date,bene_name,account_number,IFSC,benemobile,
                                        											sender_mobile,is_verified,paytm_bene_id,is_paytm,bank_name,dezire_bank_id,status,display)
                                        											
                                        				values(?,?,?,?,?,?,?,?,?,?,?,?,?,?) ",array($this->common->getRealIpAddr(),$this->common->getDate(),$bene->bene_name,$bene->account_number,$bene->IFSC,$bene->benemobile,
                                        											$new_sendermobile,$bene->is_verified,$bene->paytm_bene_id,$bene->is_paytm,$bene->bank_name,$bene->dezire_bank_id,$bene->status,$bene->display));
                            						}
										             
										        }
										        
										      
											    $resp_array = array(
													"message"=>"Beneficiary Copy Successful",
													"status"=>0,
													"statuscode"=>"TXN"
												);
												echo json_encode($resp_array);exit;
										       
										    }
										    else
										    {
										        $resp_array = array(
													"message"=>"New Sender Not Found",
													"status"=>1,
													"statuscode"=>"ERR"
												);
												echo json_encode($resp_array);exit;
										    }
										}
										else
										{
											
												$resp_array = array(
													"message"=>"Sender Not Found",
													"status"=>1,
													"statuscode"=>"ERR"
												);
												echo json_encode($resp_array);exit;
											
										}
								}
								else
								{
									$resp_array = array(
													"message"=>"Invalid Sender Mobile Number",
													"status"=>1,
													"statuscode"=>"ERR"
												);
									echo json_encode($resp_array);exit;
								}
								
							}
							else
							{
								$resp_array = array(
													"message"=>"Your Account Not Active",
													"status"=>1,
													"statuscode"=>"AUTH"
												);
								echo json_encode($resp_array);exit;
							}
						}
						else
						{
							$resp_array = array(
													"message"=>"Invalid Ip Address [".$ip."]",
													"status"=>1,
													"statuscode"=>"AUTH"
												);
							echo json_encode($resp_array);exit;
						}
					}
					else
					{
						$resp_array = array(
												"message"=>"UserId Or Password Invalid",
												"status"=>1,
												"statuscode"=>"AUTH"
											);
						echo json_encode($resp_array);exit;
					}
					
					
				}
				else
				{
					$resp_array = array(
												"message"=>"Parameter Missing",
												"status"=>1,
												"statuscode"=>"ERR"
											);
					echo json_encode($resp_array);exit;
				}			
			}
			else
			{
				$resp_array = array(
												"message"=>"Something Went Wrong",
												"status"=>1,
												"statuscode"=>"ERR"
											);
				echo json_encode($resp_array);exit;
			}
		}
		else
		{
			$resp_array = array(
												"message"=>"authentication_key Not Found",
												"status"=>1,
												"statuscode"=>"AUTH"
											);
			echo json_encode($resp_array);exit;
		}
		
		
		
	
	
	}	
	
	
	public function test()
	{ 
	    
	    error_reporting(-1);
	    ini_set('display_errors',1);
	    $this->db->db_debug = TRUE;
		$sendermobile = "9998681700";
		$new_sendermobile = "8238232303";
									
									
										$rsltsender = $this->db->query("select Id,mobile,name,lastname,pincode from remitters where mobile = ? and otp_varified = 'yes' order by Id limit 1",array($sendermobile));
										if($rsltsender->num_rows() == 1)
										{
										    
										    
										    $checknewsender = $this->db->query("select Id,mobile,name,lastname,pincode from remitters where mobile = ? and otp_varified = 'yes' order by Id limit 1",array($new_sendermobile));
										    if($checknewsender->num_rows() == 1)
										    {
										        
										        
										        $oldbene = $this->db->query("select * from beneficiaries where sender_mobile = ?",array($sendermobile));
										        foreach($oldbene->result() as $bene)
										        {
										            
										           	$checkbeneexist = $this->db->query("select * from beneficiaries where sender_mobile = ? and account_number = ? and IFSC = ? order by Id desc limit 1",array($new_sendermobile,$bene->account_number,$bene->IFSC));
                            						if($checkbeneexist->num_rows() >=  1)
                            						{
                            						    $resp_arr = array(
                            														"message"=>"Beneficiary Already Registered",
                            														"status"=>0,
                            														"statuscode"=>"TXN",
                            														"data"=>$Id
                            													);
                            							$json_resp =  json_encode($resp_arr);
                            							
                            						}
                            						else
                            						{
                            						    $rsltbenes = $this->db->query("
										                insert into beneficiaries(ipaddress,add_date,bene_name,account_number,IFSC,benemobile,
                                        											sender_mobile,is_verified,paytm_bene_id,is_paytm,bank_name,dezire_bank_id,status,display)
                                        											
                                        				values(?,?,?,?,?,?,?,?,?,?,?,?,?,?) ",array($this->common->getRealIpAddr(),$this->common->getDate(),$bene->bene_name,$bene->account_number,$bene->IFSC,$bene->benemobile,
                                        											$new_sendermobile,$bene->is_verified,$bene->paytm_bene_id,$bene->is_paytm,$bene->bank_name,$bene->dezire_bank_id,$bene->status,$bene->display));
                            						}
										            
										            
										             
										        }
										        
										      
											    $resp_array = array(
													"message"=>"Beneficiary Copy Successful",
													"status"=>0,
													"statuscode"=>"TXN"
												);
												echo json_encode($resp_array);exit;
										       
										    }
										    else
										    {
										        $resp_array = array(
													"message"=>"New Sender Not Found",
													"status"=>1,
													"statuscode"=>"ERR"
												);
												echo json_encode($resp_array);exit;
										    }
										}
										else
										{
											
												$resp_array = array(
													"message"=>"Sender Not Found",
													"status"=>1,
													"statuscode"=>"ERR"
												);
												echo json_encode($resp_array);exit;
											
										}
								
					
	}
}
