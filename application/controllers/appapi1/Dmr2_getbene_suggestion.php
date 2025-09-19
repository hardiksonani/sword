<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dmr2_getbene_suggestion extends CI_Controller {
	
	public function index()
	{ 
		//echo "";exit;
		if($_SERVER['REQUEST_METHOD'] == 'GET')
		{
			if(isset($_GET['username']) && isset($_GET['password']) && isset($_GET['sendermobile']))
			{
				$username = trim($_GET['username']);
				$pwd =  trim($_GET['password']);
				$sendermobile = trim($_GET['sendermobile']);
				$userinfo = $this->db->query("select user_id,businessname,username,status,usertype_name,mobile_no,mt_access from tblusers where username = ? and password = ?",array($username,$pwd));
				
				if($userinfo->num_rows() == 1)
				{
					$status = $userinfo->row(0)->status;
					$user_id = $userinfo->row(0)->user_id;
					$businessname = $userinfo->row(0)->businessname;
					$username = $userinfo->row(0)->username;
					$mobile_no = $userinfo->row(0)->mobile_no;
					$usertype_name = $userinfo->row(0)->usertype_name;
					$mt_access = $userinfo->row(0)->mt_access;
					
					if($status == '1')
					{
						//if($mt_access != '1')
						if(false)
						{
							
							$resp_arr = array(
								"message"=>"You Dont Have Permission to Use DMR. Please Contact Administrator",
								"status"=>1,
								"statuscode"=>"ERR",
								);
							$json_resp =  json_encode($resp_arr);
							echo $json_resp;exit;
						}
						if(ctype_digit($sendermobile))
						{
							
							$this->load->model("Mastermoney");
        					$resp = $this->Mastermoney->remitter_details($sendermobile,$userinfo);
                          
        					$jsonobj = json_decode($resp);
        
        					if(isset($jsonobj->message) and isset($jsonobj->status) and isset($jsonobj->statuscode))
        					{
        					    $main_array = array();
        					    
        					    
        					    
        					    $accno_array = array();
        					    $bene_suggestion_array  = array();
        						$message = trim((string)$jsonobj->message);
        						$status = trim((string)$jsonobj->status);
        						$statuscode = trim((string)$jsonobj->statuscode);
        					    if($status == "0")
        						{
        						   
                                   
        								$data = $jsonobj->remitter;
        								$beneficiary = $jsonobj->beneficiary;
        								foreach($beneficiary as $rw)
        								{
        								   $account = $rw->account;
        								   $accno_array[$account] = "yes";
        								}
        							
                                    $this->load->model("Mastermoney");
                                    $benesug =$this->Mastermoney->getBankitBeneList($sendermobile);
                                   
                                  	if($benesug != null)
                                  	{
                                  	    $main_array["status"] = "0";
                                  	    $main_array["message"] = "SUCCESS";
                                  	    $main_array["statuscode"] = "TXN";
                                  		 $i=1;
                	                    foreach($benesug as $sbene) 
                	                    {
                	                       
                	                        if(!isset($accno_array[$sbene["benificiary_account_no"]]))
                	                        {
                	                            $temparray = array(
                	                                "benificiary_name"=>$sbene["benificiary_name"],
                	                                "benificiary_account_no"=>$sbene["benificiary_account_no"],
                	                                "benificiary_ifsc"=>$sbene["benificiary_ifsc"],
                	                                "bank_name"=>$sbene["bank_name"],
                	                                "bank_id"=>$sbene["bank_id"],
                	                                );
                	                                array_push($bene_suggestion_array,$temparray);
                	                      }
                	                   }
                	                   $main_array["data"] = $bene_suggestion_array;
                                  	}
                                  	echo json_encode($main_array);
        						}
        						else
        						{
        						    $resp_arr = array(
        								"message"=>"Invalid Sender Mobile",
        								"status"=>1,
        								"statuscode"=>"ERR",
        								);
        							$json_resp =  json_encode($resp_arr);
        							echo $json_resp;exit;
        						}
        					}
								
						}
						else
						{
							$resp_arr = array(
								"message"=>"Invalid Mobile Number",
								"status"=>1,
								"statuscode"=>"ERR",
								);
							$json_resp =  json_encode($resp_arr);
							echo $json_resp;exit;
						}
						
					}
					else
					{
						$resp_arr = array(
							"message"=>"Your account is deactivated. contact your Administrator",
							"status"=>1,
							"statuscode"=>"ERR",
						);
						$json_resp =  json_encode($resp_arr);
						echo $json_resp;exit;
					}
				}
				else
				{
					$resp_arr = array(
						"message"=>"Authentication Failed",
						"status"=>1,
						"statuscode"=>"ERR",
					);
					$json_resp =  json_encode($resp_arr);
					echo $json_resp;exit;
				}
				
				
			}
			else
			{
				$resp_arr = array(
							"message"=>"Invalid Input",
							"status"=>1,
							"statuscode"=>"ERR",
						);
				$json_resp =  json_encode($resp_arr);
				echo $json_resp;exit;
			}			
		}
		else
		{
			$resp_arr = array(
							"message"=>"Invalid Input",
							"status"=>1,
							"statuscode"=>"ERR",
						);
			$json_resp =  json_encode($resp_arr);
			echo $json_resp;exit;
		}
		
		
	
	
	}	
}
