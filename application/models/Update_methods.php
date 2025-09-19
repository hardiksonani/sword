<?php
class Update_methods extends CI_Model 
{	
	function _construct()
	{
		  // Call the Model constructor
		  parent::_construct();
		  $this->load->model("Locking_model");
	}
	private function recharge_refund_remove_duplicate($recharge_id)
	{
		
		$rslt = $this->db->query("insert into locking_rechargerefund (recharge_id,add_date,ipaddress) values(?,?,?)",array($recharge_id,$this->common->getDate(),$this->common->getRealIpAddr()));
		  if($rslt == "" or $rslt == NULL)
		  {
			return false;
		  }
		  else
		  {
			return true;
		  }
	}
	public function apibalanceloging($api_name,$balance)
	{
		$api_info = $this->db->query("select Id,min_balance_limit from api_configuration where api_name = ?",array($api_name));
		if($api_info->num_rows() == 1)
		{
			$api_id = $api_info->row(0)->Id;
			$min_balance_limit = $api_info->row(0)->min_balance_limit;
			if($min_balance_limit > 0)
			{
				if($balance <= $min_balance_limit)
				{
					$this->db->query("update api_configuration set enable_recharge = 'no' where Id = ?",array($api_id));
				}
				else
				{
					$this->db->query("update api_configuration set enable_recharge = 'yes' where Id = ?",array($api_id));
				}
			}
			$this->db->query("insert into tblapibalance_log(api_id,balance,add_date) values(?,?,?)",array($api_id,$balance,$this->common->getDate()));	
		}
		
	}
	public function templog($recharge_id,$action_from,$field1,$field2,$field3,$field4,$field5)
	{
	    $add_date = $this->common->getDate();
	    $ipaddress = $this->common->getRealIpAddr();
	    $this->db->query("insert into retrylog(recharge_id,add_date,ipaddress,action_from,field1,field2,field3,field4,field5) values(?,?,?,?,?,?,?,?,?)",
	    array($recharge_id,$add_date,$ipaddress,$action_from,$field1,$field2,$field3,$field4,$field5));
	}
	public function updateRechargeStatus($recharge_id,$operator_id,$status,$callback = true,$lapubalance = 0,$lapunumber = "",$API = false,$roffer = 0)
	{
	    //$this->templog($recharge_id,"Update_methods_start",$status,$operator_id,"","","");
	    
		$rslt = $this->db->query("
		select 
		a.order_id,
		a.recharge_by,
		a.user_id, 
		a.DId,
		a.MdId,
		a.add_date,
		a.ExecuteBy,
		api.Id as api_id,
		a.recharge_status,
		a.company_id,
		a.mobile_no,
		a.amount,
		a.commission_amount,
		a.commission_per,



		a.DComPer,
		a.DComm,
		a.MdComPer,
		a.MdComm,
		a.user_id,
		b.company_name,
		b.allowed_retry,
		c.mobile_no as sendermobile,
		d.call_back_url as respurl 
		from tblrecharge a
		left join tblusers_info d on a.user_id = d.user_id
		left join tblcompany b on a.company_id = b.company_id
		left join tblusers c on a.user_id = c.user_id 
		left join api_configuration api on a.ExecuteBy = api.api_name
		where 
		a.recharge_id = ?",array($recharge_id));
		if($rslt->num_rows() == 1)
		{
			$recharge_info = $rslt;
			$rec_datetime = $rslt->row(0)->add_date;
			putenv("TZ=Asia/Calcutta");
			date_default_timezone_set('Asia/Calcutta');
			$recdatetime =date_format(date_create($rec_datetime),'Y-m-d H:i:s');
			$cdate =date_format(date_create($this->common->getDate()),'Y-m-d H:i:s');
			$this->load->model("Common_methods");

			$user_id = $rslt->row(0)->user_id;
			$DId = $rslt->row(0)->DId;
			$MdId = $rslt->row(0)->MdId;

			$DComm = $rslt->row(0)->DComm;
			$MdComm = $rslt->row(0)->MdComm;
			$recmobile_no = $rslt->row(0)->mobile_no;
			$recamount = $rslt->row(0)->amount;

			$recdate = $rslt->row(0)->add_date;
			$uniqueid = $rslt->row(0)->order_id;
			$amount = $rslt->row(0)->amount;
			$company_id = $rslt->row(0)->company_id;
			$ExecuteBy = $rslt->row(0)->ExecuteBy;
			$api_id = $rslt->row(0)->api_id;
			$respurl = $rslt->row(0)->respurl;
			$recharge_by = $rslt->row(0)->recharge_by;
			$mobile_no = $rslt->row(0)->mobile_no;
			$date = $this->common->getDate();
			$ip = $this->common->getRealIpAddr();
			$path = $recharge_id."#".$operator_id."#".$status;
			$diff = $this->gethoursbetweentwodates($recdatetime,$cdate);
			$allowed_retry = $rslt->row(0)->allowed_retry;
			if($lapubalance != 0)
			{
				$this->apibalanceloging($ExecuteBy,$lapubalance);
			}
			
			$this->load->model("AutoStopApi");
			$this->AutoStopApi->increment_failure_counter($api_id,$company_id,$status);

			if($rslt->row(0)->recharge_status == "Pending"  or $rslt->row(0)->recharge_status == "")
			{
				
				if($status == 'Failure')
				{
				     //$this->templog($recharge_id,"Update_methods_IF_STATUS_EQUAL_Failure",$status,$operator_id,"","","");
				    if($diff >= 0 and $diff <= 5)
				    {
				        //retry code here  
				        $rslt_reroot_values = $this->db->query("SELECT 
				                                recharge_id, 
				                                allowed_retry, 
				                                retry_count, 
				                                last_retry_priority, 
				                                last_retry_api, 
				                                recharge_api, 
				                                retry_api_1, 
				                                retry_api_2,
				                                retry_api_3 ,
				                                api_1_status,
    			                                api_2_status,
    			                                api_3_status,
    			                                current_retry_api
				                                FROM reroot_count 
				                                WHERE recharge_id = ? and retry_count < ?",array($recharge_id,$allowed_retry));
				        if($rslt_reroot_values->num_rows() == 1)
				        {
				            $retry_api_1 = $rslt_reroot_values->row(0)->retry_api_1;
        			        $retry_api_2 = $rslt_reroot_values->row(0)->retry_api_2;
        			        $retry_api_3 = $rslt_reroot_values->row(0)->retry_api_3;
        			        
        			        $api_1_status = $rslt_reroot_values->row(0)->api_1_status;
        			        $api_2_status = $rslt_reroot_values->row(0)->api_2_status;
        			        $api_3_status = $rslt_reroot_values->row(0)->api_3_status;
				            
				            $reroot_api = false;
				            $reroot_api_id = false;
				            $reroot_api_name = false;
				            
			                
			                if($api_1_status == "NOTINIT" and $api_2_status == "NOTINIT" and $api_3_status == "NOTINIT")
			                {
			                    if($retry_api_1 > 0)
			                    {
			                        $reroot_api_info = $this->db->query("select api_name from api_configuration where Id = ?",array($retry_api_1));
			                        if($reroot_api_info->num_rows() == 1)
			                        {
			                            $reroot_api = true;
			                            $reroot_api_id = $retry_api_1;
			                            $reroot_api_name = $reroot_api_info->row(0)->api_name;
			                        }  
			                    }
			                }
			                if($reroot_api == true)
			                {
			                    $this->db->query("update reroot_count set api_1_status = 'open' where recharge_id = ?",array($recharge_id));
	                            $this->db->query("update tblrecharge set retry = 'yes',ExecuteBy = ? where recharge_id = ?",array($reroot_api_name,$recharge_id));
	                            $this->db->query("update tblpendingrechares set  ishold = 'retry',api_id = ? where recharge_id = ?",array( $reroot_api_id,$recharge_id));
	                            if($callback == false and $recharge_by == "API")
            					{
            					    $response_type = "JSON";
            					    $status = "Pending";
            					    $operator_id = "";
            					    $this->load->model("Recharge_model");
            					    $this->Recharge_model->custom_response($recharge_id,$mobile_no,$amount,$status,$operator_id,$uniqueid,$response_type,$recharge_by,$user_id);
            					}
            					if($callback == false and (strtoupper($recharge_by) == "WEB" or strtoupper($recharge_by) == "GPRS"))
            					{
            					    $response_type = "CSV";
            					    $status = "Pending";
            					    $operator_id = "";
            					    $this->load->model("Do_recharge_model");
            					    $this->Do_recharge_model->custom_response($recharge_id,$mobile_no,$amount,$status,$operator_id,$uniqueid,$response_type,$recharge_by,$user_id);
            					}
			                }
			                else
			                {
			                     $this->refundOfAcountReportEntry($recharge_id,$status,$operator_id,$company_id,$user_id,$lapubalance,$lapunumber,$recharge_info,$date,$ip,$recharge_by,$callback,$respurl,$uniqueid);	        
    				            if($recharge_by == "API" and $callback == true)
            					{
            						$resptosend = $respurl."?uniqueid=".trim($uniqueid)."&status=Failure&operator_id=".rawurlencode($operator_id)."&transaction_id=".$recharge_id."&number=".$mobile_no."&amount=".$amount;
            						$this->common->callurl($resptosend);
            					}
            					if($callback == false and $recharge_by == "API")
            					{
            					    $response_type = "JSON";
            					    $this->load->model("Recharge_model");
            					    $this->Recharge_model->custom_response($recharge_id,$mobile_no,$amount,$status,$operator_id,$uniqueid,$response_type,$recharge_by,$user_id);
            					}
            					if($callback == false and (strtoupper($recharge_by) == "WEB" or strtoupper($recharge_by) == "GPRS"))
            					{
            					    $response_type = "CSV";
            					    $this->load->model("Do_recharge_model");
            					    $this->Do_recharge_model->custom_response($recharge_id,$mobile_no,$amount,$status,$operator_id,$uniqueid,$response_type,$recharge_by,$user_id);
            					}   
			                }    
				        }
				        else
				        {
				            $this->refundOfAcountReportEntry($recharge_id,$status,$operator_id,$company_id,$user_id,$lapubalance,$lapunumber,$recharge_info,$date,$ip,$recharge_by,$callback,$respurl,$uniqueid);	        
				            if($recharge_by == "API" and $callback == true)
        					{
        						$resptosend = $respurl."?uniqueid=".trim($uniqueid)."&status=Failure&operator_id=".rawurlencode($operator_id)."&transaction_id=".$recharge_id."&number=".$mobile_no."&amount=".$amount;
        						$this->common->callurl($resptosend);
        					}
        					if($callback == false and $recharge_by == "API")
        					{
        					    $response_type = "JSON";
        					    $this->load->model("Recharge_model");
        					    $this->Recharge_model->custom_response($recharge_id,$mobile_no,$amount,$status,$operator_id,$uniqueid,$response_type,$recharge_by,$user_id);
        					}
        					if($callback == false and (strtoupper($recharge_by) == "WEB" or strtoupper($recharge_by) == "GPRS"))
        					{
        					    $response_type = "CSV";
        					    $this->load->model("Do_recharge_model");
        					    $this->Do_recharge_model->custom_response($recharge_id,$mobile_no,$amount,$status,$operator_id,$uniqueid,$response_type,$recharge_by,$user_id);
        					}
				            
				        }
				    }
				    else
				    {
				        $this->refundOfAcountReportEntry($recharge_id,$status,$operator_id,$company_id,$user_id,$lapubalance,$lapunumber,$recharge_info,$date,$ip,$recharge_by,$callback,$respurl,$uniqueid);	        
				        
				        if($recharge_by == "API" and $callback == true)
    					{
    						$resptosend = $respurl."?uniqueid=".trim($uniqueid)."&status=Failure&operator_id=".rawurlencode($operator_id)."&transaction_id=".$recharge_id."&number=".$mobile_no."&amount=".$amount;
    						$this->common->callurl($resptosend);
    					}
    					if($callback == false and $recharge_by == "API")
    					{
    					    $response_type = "JSON";
    					    $this->load->model("Recharge_model");
    					    $this->Recharge_model->custom_response($recharge_id,$mobile_no,$amount,$status,$operator_id,$uniqueid,$response_type,$recharge_by,$user_id);
    					}
    					if($callback == false and (strtoupper($recharge_by) == "WEB" or strtoupper($recharge_by) == "GPRS"))
    					{
    					    $response_type = "CSV";
    					    $this->load->model("Do_recharge_model");
    					    $this->Do_recharge_model->custom_response($recharge_id,$mobile_no,$amount,$status,$operator_id,$uniqueid,$response_type,$recharge_by,$user_id);
    					}   
				    }
				    
				    
					
				}
				else if($status == "Success")
				{
				    $this->db->query("update tblrecharge set recharge_status = ?, operator_id = ?,update_time=?,update_ip=?,lapubalance = ?,lapunumber = ?,roffer = ? where recharge_id = ? ",array($status,$operator_id,$date,$ip,$lapubalance,$lapunumber,$roffer,$recharge_id));
					$this->load->model("Commission");
					$this->Commission->ParentCommission($recharge_id);
					$this->db->query("update IGNORE  pf_values set failurecount = 0 where company_id = ? and api_id = (select api_id from tblapi where api_name = ?)",array($company_id,$ExecuteBy));
					if($recharge_by == "API" and $callback == true)
					{
						$resptosend = $respurl."?uniqueid=".trim($uniqueid)."&status=Success&operator_id=".rawurlencode($operator_id)."&transaction_id=".$recharge_id."&number=".$mobile_no."&amount=".$amount;
						$this->common->callurl($resptosend);
					}
					if($callback == false and $recharge_by == "API")
					{
					    $response_type = "JSON";
					    $this->load->model("Recharge_model");
					    $this->Recharge_model->custom_response($recharge_id,$mobile_no,$amount,$status,$operator_id,$uniqueid,$response_type,$recharge_by,$user_id);
					}
					if($callback == false and (strtoupper($recharge_by) == "WEB" or strtoupper($recharge_by) == "GPRS"))
					{
					    $response_type = "CSV";
					    $this->load->model("Do_recharge_model");
					    $this->Do_recharge_model->custom_response($recharge_id,$mobile_no,$amount,$status,$operator_id,$uniqueid,$response_type,$recharge_by,$user_id);
					}
				}
			}
			else if($rslt->row(0)->recharge_status == "Failure" and ($status == "Success" or$status == "Pending"  ))
			{
			    $this->db->query("insert into statuschange_recharges(add_date,ipaddress,recharge_id,callback_response,API)
			    					values(?,?,?,?,?)",array($this->common->getDate(),$this->common->getRealIpAddr(),$recharge_id,"",$ExecuteBy));
			}
			else if($rslt->row(0)->recharge_status == "Success" and ($status == "Failure"))
			{
			   $this->refundOfAcountReportEntry($recharge_id,$status,$operator_id,$company_id,$user_id,$lapubalance,$lapunumber,$recharge_info,$date,$ip,$recharge_by,$callback,$respurl,$uniqueid);	        
				 




			   




		        if($recharge_by == "API" and $callback == true)
				{
					$resptosend = $respurl."?uniqueid=".trim($uniqueid)."&status=Failure&operator_id=".rawurlencode($operator_id)."&transaction_id=".$recharge_id."&number=".$mobile_no."&amount=".$amount;
					$this->common->callurl($resptosend);
				}
				if($callback == false and $recharge_by == "API")
				{
				    $response_type = "JSON";
				    $this->load->model("Recharge_model");
				    $this->Recharge_model->custom_response($recharge_id,$mobile_no,$amount,$status,$operator_id,$uniqueid,$response_type,$recharge_by,$user_id);
				}
				if($callback == false and (strtoupper($recharge_by) == "WEB" or strtoupper($recharge_by) == "GPRS"))
				{
				    $response_type = "CSV";
				    $this->load->model("Do_recharge_model");
				    $this->Do_recharge_model->custom_response($recharge_id,$mobile_no,$amount,$status,$operator_id,$uniqueid,$response_type,$recharge_by,$user_id);
				}  
			}
	 	}
	}
	public function gethoursbetweentwodates($fromdate,$todate)
	{
		 $now_date = strtotime (date ($todate)); // the current date 
		$key_date = strtotime (date ($fromdate));
		$diff = $now_date - $key_date;
		return round(abs($diff) / 60,2);
	}
	
	public function ExecuteAPI($url)
	{	
		
		$ch = curl_init();
		curl_setopt($ch,CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		$buffer = curl_exec($ch);	
		curl_close($ch);
		
		$this->db->query("insert into tblreqresp(user_id,request,response,add_date,ipaddress,recharge_id,mobile_no,amount,company_id) values(?,?,?,?,?,?,?,?,?)",array(0,$url,$buffer,$this->common->getDate(),$this->common->getRealIpAddr(),0,0,0,0));
		
		
		return $buffer;
	}
	public function logentry($data)
	{
		$filename = "responseurls.txt";
		if (!file_exists($filename)) 
		{
			file_put_contents($filename, '');
		} 
		$this->load->library("common");

		$this->load->helper('file');
	
		$sapretor = "------------------------------------------------------------------------------------";
		
write_file($filename." .\n", 'a+');
write_file($filename, $data."\n", 'a+');
write_file($filename, $sapretor."\n", 'a+');
	}
	public function refundOfAcountReportEntry($recharge_id,$status,$operator_id,$company_id,$user_id,$lapubalance,$lapunumber,$recharge_info,$date,$ip,$recharge_by,$callback,$respurl,$uniqueid,$is_second = false)
	{
	   
	    



	    
		$rsltrecstatus = $recharge_info;
		$mobile_no = $rsltrecstatus->row(0)->mobile_no;
		$old_rechargestatus = $rsltrecstatus->row(0)->recharge_status;
		$amount = $rsltrecstatus->row(0)->amount;


		$DId = $rsltrecstatus->row(0)->DId;
		$DComm = $rsltrecstatus->row(0)->DComm;
		$MdId = $rsltrecstatus->row(0)->MdId;
		$MdComm = $rsltrecstatus->row(0)->MdComm;


		$recmobile_no = $rsltrecstatus->row(0)->mobile_no;
		$recamount = $rsltrecstatus->row(0)->amount;
		$recdate = $rsltrecstatus->row(0)->add_date;
		



		$ExecuteBy = $recharge_info->row(0)->ExecuteBy;
		$this->db->query("update tblrecharge set recharge_status = ?, operator_id = ?,update_time=?,update_ip=?,lapubalance = ?,lapunumber = ? where recharge_id = ?",array($status,$operator_id,$date,$ip,$lapubalance,$lapunumber,$recharge_id));
		$this->db->query("update pf_values set failurecount = failurecount + 1 where company_id = ? and api_id = (select api_id from tblapi where api_name = ?)",array($company_id,$ExecuteBy));
								
		//if($rsltrecstatus->row(0)->reverted == "no")
		if(true)
		{
		
		    $Success_flag = false;
        
		    if(true)
		    {
		    	if($old_rechargestatus == "Success")
		    	{
		    		$Success_flag = true;
		    		$this->db->query("update tblrecharge set reverted = 'yes',edit_date = 3 where recharge_id = ?",array($recharge_id));

		    		





		    	}
		    	else
		    	{
		    		$this->db->query("update tblrecharge set reverted = 'yes' where recharge_id = ?",array($recharge_id));
		    	}


		        
    			if($this->recharge_refund_remove_duplicate($recharge_id) == true)
    			{
    				$date = $this->common->getDate();


    				$user_id = $rsltrecstatus->row(0)->user_id;
					$userinfo = $this->db->query("select usertype_name from tblusers where user_id = ?",array($user_id));
					$usertype_name = $userinfo->row(0)->usertype_name;
					
					
					$commission_amount = $rsltrecstatus->row(0)->commission_amount;
					$commission_per = $rsltrecstatus->row(0)->commission_per;
					if($usertype_name == "Distributor")
					{
						$commission_amount = $rsltrecstatus->row(0)->DComm;
						$commission_per = $rsltrecstatus->row(0)->DComPer;
					}
					if($usertype_name == "MasterDealer")
					{
						$commission_amount = $rsltrecstatus->row(0)->MdComm;
						$commission_per = $rsltrecstatus->row(0)->MdComPer;
					}



    				$cr_amount = $rsltrecstatus->row(0)->amount - $commission_amount;
    				$transaction_type = "Recharge_Refund";
    				
    				$Description = "Refund : Mobile : ".$rsltrecstatus->row(0)->mobile_no." Amount : ".$rsltrecstatus->row(0)->amount." | Revert Date = ".$date;
    				
    				// debit process start
    				$add_date = $this->common->getDate();
    				$date = $this->common->getMySqlDate();
    				$old_balance = $this->Common_methods->getCurrentBalance($user_id);
    				$current_balance = $old_balance + $cr_amount;
    				
    				$str_query = "insert into  tblewallet(user_id,recharge_id,transaction_type,credit_amount,balance,description,add_date,ipaddress)
    				values(?,?,?,?,?,?,?,?)";
    				$reslut = $this->db->query($str_query,array($user_id,$recharge_id,$transaction_type,$cr_amount,$current_balance,$Description,$add_date,$this->common->getRealIpAddr()));
    				//debit process end
    				$ewallet_id = $this->db->insert_id();
    				$this->db->query("update tblrecharge set reverted = 'yes',debited = 'no',ewallet_id = CONCAT_WS(',',ewallet_id,?) where recharge_id = ?",array($ewallet_id,$recharge_id));



    				if($Success_flag == true)
    				{
    					////////////commission reverse entry from distributor and master
    					$this->load->model("Commission");
    					$this->Commission->ParentCommission_reverse($recharge_id);
					   
/*
					   if($DId > 0)
						{
							$cr_user_id = 1;
		        		    $dr_user_id = $DId;
		        		    $dramount = $DComm;
		        		    $remark = "Rev Recharge Commission :Number : ".$recmobile_no;
		        		    $description = "Rev Recharge Incentive Date : ".$recdate ." Total Recharge :  ".$recamount;
		        		    $payment_type = "CASH";
		    		        
		    		        $this->Insert_model->tblewallet_Payment_CrDrEntry($cr_user_id,$dr_user_id,$dramount,$remark,$description,$payment_type);
						}

						if($MdId > 0)
						{
							
		    		        $cr_user_id = 1;
		        		    $dr_user_id = $MdId;
		        		    $dramount = $MdComm;
		        		    $remark = "Rev Recharge Commission :Number : ".$recmobile_no;
		        		    $description = "Rev Recharge Incentive Date : ".$recdate ." Total Recharge :  ".$recamount;
		        		    $payment_type = "CASH";
		    		        $this->Insert_model->tblewallet_Payment_CrDrEntry($cr_user_id,$dr_user_id,$dramount,$remark,$description,$payment_type);
						}
*/
    				}


    			}    
		    }
			
		}
		if($recharge_by == "API" and $callback == true)
		{
		    $resptosend = $respurl."?uniqueid=".trim($uniqueid)."&status=Failure&operator_id=".rawurlencode($operator_id)."&transaction_id=".$recharge_id."&number=".$mobile_no."&amount=".$amount;
			$this->common->callurl($resptosend);
		}
		
		
	}
	private function loging($recharge_id,$actionfrom,$remark)
	{
		$add_date = $this->common->getDate();
		$ipaddress = $this->common->getRealIpAddr();
		$this->db->query("insert into tbllogs(recharge_id,add_date,ipaddress,actionfrom,remark) values(?,?,?,?,?)",
						array($recharge_id,$add_date,$ipaddress,$actionfrom,$remark));
	}
}

?>