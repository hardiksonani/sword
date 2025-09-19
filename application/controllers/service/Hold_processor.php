<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Hold_processor extends CI_Controller {
	
	
	private $msg='';
	function __construct()
    {
        parent:: __construct();
        $this->is_logged_in();
        $this->clear_cache();
    }
	function is_logged_in() 
    {
	 	error_reporting(-1);
	 	ini_set('display_errors',1);
	 	$this->db->db_debug = TRUE;
    }
    function clear_cache()
    {
         header('Expires: Sat, 26 Jul 1997 05:00:00 GMT');
        header('Cache-Control: no-cache, no-store, must-revalidate, max-age=0');
        header('Cache-Control: post-check=0, pre-check=0', FALSE);
        header('Pragma: no-cache');
    }
	public function index()  
	{
		 $rslthold_recharges = $this->db->query("select recharge_id,add_date,mobile_no,amount,company_id,ExecuteBy,status from tblholdtransactions where status = 'Hold' and ExecuteBy = 'HOLD' and Date(add_date) = ? order by RAND() limit 4",$this->common->getMySqlDate());

		// print_r($rslthold_recharges->result());exit;
		 if($rslthold_recharges->num_rows() > 0)
		 {
		 	foreach($rslthold_recharges->result() as $rw)
		 	{
		 		$company_id = $rw->company_id;
		 		$recharge_id = $rw->recharge_id;
		 		$Mobile = $rw->mobile_no;
		 		$Amount = $rw->amount;
		 		$amount= $rw->amount;

		 		$code2 = false;
				$state_id = 0;
				$circle_id = 0;
				$circle_id = $this->getcircle_planapi($Mobile);
				$state_id = $circle_id;
				$api_id = false;

		 		$ApiInfo = $this->db->query("SELECT a.company_id,a.api_id,a.amountrange,a.priority,a.status,api.api_name
FROM `operatorpendinglimit` a
left join api_configuration api on a.api_id = api.Id
where a.company_id = ? and api.enable_recharge = 'yes' and a.status = 'active' and a.api_id > 0 order by a.priority",array($company_id));
		 		//print_r($ApiInfo->result());exit;

			    if($ApiInfo->num_rows() == 0)
			    {
			        
			    }
			    else
			    {
			     	$k=0;
			        foreach($ApiInfo->result() as $apirw)
			        {
			            $temp_api_id = $apirw->api_id;
			            $temp_api_name = $apirw->api_name;
			            if($temp_api_name == "Random")
			            {
			        		$randomapi = $this->db->query("SELECT api_id FROM `tblrandomapirouting` where company_id = ? order by Rand() limit 1",array($company_id));
					        if($randomapi->num_rows() == 1)
					        {
					        	$pendinglimit_check = $this->checkpendinglimit($randomapi->row(0)->api_id,$company_id);
					        	if($pendinglimit_check == true )
					        	{
					        		$api_id = $randomapi->row(0)->api_id;
					        		break;	
					        	}
					        }
			            }
			            else if($temp_api_name == "Denomination_wise")
					    {
							
					       $amountapi = $this->db->query("
					                            SELECT 
					                                a.api_id,a.amounts,a.company_id,a.circle_id,a.code,b.api_name 
					                                FROM amountwiseapi a 
					                                left join api_configuration b on a.api_id = b.Id 
					                                left join operatorpendinglimit op on a.company_id = op.company_id and a.api_id = op.api_id
					                                where a.company_id = ? and b.enable_recharge = 'yes' and (b.is_active = 'yes' or a.api_id <= 3)  order by a.amounts desc",array($company_id));
				       
				           $amount_api_name = "";
				           
				           foreach($amountapi->result() as $amtrw)//main row loop
				           {
				               $amount_api_found = false;
				               $amount_api_name = "";
				               $amount_api_tempid = 0;
			                  
				               if (preg_match('/,/',$amtrw->amounts) == 1 ) 
				               {
				                   
									$amounts_array = explode(",",$amtrw->amounts);
									if(in_array($amount,$amounts_array))
					                {

					                	if($amtrw->circle_id > 0)
					                	{
					                		if($amtrw->circle_id == $circle_id)
					                		{
					                			$amount_api_name = $amtrw->api_name;
							                    $amount_api_tempid = $amtrw->api_id;
							                    $code2 = $amtrw->code;
							                    $amount_api_found = true;			
					                		}
					                	}
					                	else
					                	{
					                	   $amount_api_name = $amtrw->api_name;
						                   $amount_api_tempid = $amtrw->api_id;
						                   $code2 = $amtrw->code;
						                   $amount_api_found = true;

					                	}

					                   
					                }
				               }
				               else if (preg_match('/<->/',$amtrw->amounts) == 1 )
				               {
				                 	$amt_range = explode("<->",$amtrw->amounts);
			    	                $min_amt = $amt_range[0];
			    	                $max_amt = $amt_range[1];

			    	                if($amount >= $min_amt and $amount <= $max_amt)
			    	                {
			    	                	
			    	                	if($amtrw->circle_id > 0)
					                	{
					                		if($amtrw->circle_id == $circle_id)
					                		{
					                			$amount_api_name = $amtrw->api_name;
							                    $amount_api_tempid = $amtrw->api_id;
							                    $code2 = $amtrw->code;
							                    $amount_api_found = true;			
					                		}
					                	}
					                	else
					                	{
					                	   $amount_api_name = $amtrw->api_name;
						                   $amount_api_tempid = $amtrw->api_id;
						                   $code2 = $amtrw->code;
						                   $amount_api_found = true;	
					                	}
			    	                }
				               }

				               if($amount_api_found == true and $amount_api_tempid > 0 )
				               {

				               		if($amount_api_name == "Circle_wise")
						            {
						                if($circle_id > 0)
						               {
						                   $rlstseriesapi = $this->db->query("select * from serieswiseapi where state_id = ? and company_id = ?",array($circle_id,$company_id));
						                   if($rlstseriesapi->num_rows() == 1)
						                   {

						                   		$pendinglimit_check = $this->checkpendinglimit($rlstseriesapi->row(0)->api_id,$company_id);
						                   		if($pendinglimit_check == true)
						                   		{
						                   			$code2 = $rlstseriesapi->row(0)->code;
						                   			$api_id = $rlstseriesapi->row(0)->api_id;
						                       		break 2;
						                   		}
						                   }
						               }
						            }
						            else if($amount_api_name == "Random")
						            {
						               $randomapi = $this->db->query("SELECT a.api_id,b.api_name FROM `tblrandomapirouting` a left join api_configuration b on a.api_id = b.Id where a.company_id = ? order by Rand() limit 1",array($company_id));
						                if($randomapi->num_rows() == 1)
						                {
						                	$pendinglimit_check = $this->checkpendinglimit($randomapi->row(0)->api_id,$company_id);
					                   		if($pendinglimit_check == true)	
					                   		{
					                   			$api_id = $randomapi->row(0)->api_id;
						                    	break 2;
					                   		}  
						                }
						            }
						            else if($amount_api_tempid > 3)
						            {
						            
						            	$pendinglimit_check = $this->checkpendinglimit($amount_api_tempid,$company_id);
				                   		if($pendinglimit_check == true)	
				                   		{
				                   			$api_id = $amount_api_tempid;
						                	break 2;
				                   		}
						            }
				               }
				           }   
					    }
					    else if($temp_api_name == "Circle_wise")
					    {
					       if($circle_id > 0)
					       {
					           $rlstseriesapi = $this->db->query("
					           	select 
					           		a.*,
					           		b.api_name
					           		from serieswiseapi a 
					           		left join api_configuration b on a.api_id = b.Id 
					           		where 
					           		a.state_id = ? and 
					           		a.company_id = ?
					           	",array($circle_id,$company_id));


					           if($is_check_api == true)
							     {
							     	echo "Circle API LIST : <br>";
							     	print_r($rlstseriesapi->result());
							     	echo "<hr>";
							     }




					           if($rlstseriesapi->num_rows() == 1)
					           {
					           		$series_api_name = $rlstseriesapi->row(0)->api_name;
					           		$code2 = $rlstseriesapi->row(0)->code;

					           		if($series_api_name == "Random")
						            {
						               $randomapi = $this->db->query("SELECT a.api_id,b.api_name FROM `tblrandomapirouting` a left join api_configuration b on a.api_id = b.Id where a.company_id = ? order by Rand() limit 1",array($company_id));
						                if($randomapi->num_rows() == 1)
						                {
						                	$pendinglimit_check = $this->checkpendinglimit($randomapi->row(0)->api_id,$company_id);
					                   		if($pendinglimit_check == true)	
					                   		{
					                   			$api_id = $randomapi->row(0)->api_id;
						                    	break;
					                   		}  
						                }
						            }
						            else
						            {
						            	if($rlstseriesapi->row(0)->api_id > 3)
						            	{
						            		$pendinglimit_check = $this->checkpendinglimit($rlstseriesapi->row(0)->api_id,$company_id);
							        		if($pendinglimit_check == true )
							        		{
							        			$api_id = $rlstseriesapi->row(0)->api_id;	
												break;
							        		}	
						            	}
						            	
						            }
					           }
					       }
					    }
					    else
					    {
					    	$pendinglimit_check = $this->checkpendinglimit($apirw->api_id,$company_id);
					    	//echo "recharge Id : ".$recharge_id."<br>";
					    	//echo "api ".$temp_api_name."<br>";
					    	//var_dump($pendinglimit_check);
					    	//echo "<br>";
					    	

			        		if($pendinglimit_check == true )
			        		{
			        			$api_id = $apirw->api_id;
			        			break;
			        		}
					    }
			            
			            $k++;
			        }
			       // var_dump($api_id ); 
			        //echo "<br>APi setting starts....<br>";
			        if($api_id != false)
			        {
			        	$NewApiInfo = $this->db->query("select * from api_configuration where Id = ?",array($api_id));
			        	if($NewApiInfo->num_rows() == 1)
					   	{
						   	if($NewApiInfo->row(0)->api_name == "HOLD" or $NewApiInfo->row(0)->api_name == "STOP" or $NewApiInfo->row(0)->api_name == "Circle_wise")
						   	{
						   		
						   	}
						   	else
						   	{


						   		

						   		$operatorcode_rslt = $this->db->query("
                                                	    select 
                                                	    a.company_id,
                                                	    a.company_name,
                                                	    a.mcode,
                                                	    a.service_id,
                                                	    b.service_name,
                                                	    IFNULL(g.commission,0) as commission,
                                                	    g.commission_type,
                                                	    g.commission_slab,
                                                	    g.OpParam1,
                                                	    g.OpParam2,
                                                	    g.OpParam3,
                                                	    g.OpParam4,
                                                	    g.OpParam5
                                                	    
                                                	    from tblcompany a 
                                                	    left join tblservice b on a.service_id = b.service_id 
                                                	    left join tbloperatorcodes g on g.api_id = ? and a.company_id = g.company_id
                                                	    where a.company_id = ?
                                                	    order by service_id",array($NewApiInfo->row(0)->Id,$company_id));
            					if($operatorcode_rslt->num_rows() == 1)
            					{
            						$apiinfo = $NewApiInfo;
	                                            $api_id = $apiinfo->row(0)->Id;
	                                	        $api_name = $apiinfo->row(0)->api_name;
	                                	        $api_type = $apiinfo->row(0)->api_type;
	                                	        $is_active = $apiinfo->row(0)->is_active;
	                                	        $enable_recharge = $apiinfo->row(0)->enable_recharge;
	                                	        $enable_balance_check = $apiinfo->row(0)->enable_balance_check;
	                                	        $enable_status_check = $apiinfo->row(0)->enable_status_check;
	                                	        $hostname = $apiinfo->row(0)->hostname;
	                                	        $param1 = $apiinfo->row(0)->param1;
	                                	        $param2 = $apiinfo->row(0)->param2;
	                                	        $param3 = $apiinfo->row(0)->param3;
	                                	        $param4 = $apiinfo->row(0)->param4;
	                                	        $param5 = $apiinfo->row(0)->param5;
	                                	        $param6 = $apiinfo->row(0)->param6;
	                                	        $param7 = $apiinfo->row(0)->param7;
	                                	        
	                                	        $header_key1 = $apiinfo->row(0)->header_key1;
	                                	        $header_key2 = $apiinfo->row(0)->header_key1;
	                                	        $header_key3 = $apiinfo->row(0)->header_key1;
	                                	        $header_key4 = $apiinfo->row(0)->header_key1;
	                                	        $header_key5 = $apiinfo->row(0)->header_key1;
	                                	        $header_value1 = $apiinfo->row(0)->header_value1;
	                                	        $header_value2 = $apiinfo->row(0)->header_value2;
	                                	        $header_value3 = $apiinfo->row(0)->header_value3;
	                                	        $header_value4 = $apiinfo->row(0)->header_value4;
	                                	        $header_value5 = $apiinfo->row(0)->header_value5;
	                                	        
	                                	        $balance_check_api_method = $apiinfo->row(0)->balance_check_api_method;
	                                	        $balance_ceck_api = $apiinfo->row(0)->balance_ceck_api;
	                                	        $status_check_api_method = $apiinfo->row(0)->status_check_api_method;
	                                	        $status_check_api = $apiinfo->row(0)->status_check_api;
	                                	        $validation_api_method = $apiinfo->row(0)->validation_api_method;
	                                	        $validation_api = $apiinfo->row(0)->validation_api;
	                                	        $transaction_api_method = $apiinfo->row(0)->transaction_api_method;
	                                	        $api_prepaid = $apiinfo->row(0)->api_prepaid;
	                                	        $api_dth = $apiinfo->row(0)->api_dth;
	                                	        $api_postpaid = $apiinfo->row(0)->api_postpaid;
	                                	        
	                                	        $api_electricity = $apiinfo->row(0)->api_electricity;
	                                	        $api_gas = $apiinfo->row(0)->api_gas;
	                                	        $api_insurance = $apiinfo->row(0)->api_insurance;
	                                	        $dunamic_callback_url = $apiinfo->row(0)->dunamic_callback_url;
	                                	        $response_parser = $apiinfo->row(0)->response_parser;
	                                	        
	                                	        
	                                	        $recharge_response_type = $apiinfo->row(0)->recharge_response_type;
	                                	        $response_separator = $apiinfo->row(0)->response_separator;
	                                	        
	                                	        $recharge_response_status_field = $apiinfo->row(0)->recharge_response_status_field;
	                                	        $recharge_response_opid_field = $apiinfo->row(0)->recharge_response_opid_field;
	                                	        $recharge_response_apirefid_field = $apiinfo->row(0)->recharge_response_apirefid_field;
	                                	        
	                                	        $recharge_response_balance_field = $apiinfo->row(0)->recharge_response_balance_field;
	                                	        $recharge_response_remark_field = $apiinfo->row(0)->recharge_response_remark_field;
	                                	        $recharge_response_stat_field = $apiinfo->row(0)->recharge_response_stat_field;
	                                	        
	                                	        $recharge_response_fos_field = $apiinfo->row(0)->recharge_response_fos_field;
	                                	        $recharge_response_otf_field = $apiinfo->row(0)->recharge_response_otf_field;
	                                	        
	                                	         $recharge_response_lapunumber_field = $apiinfo->row(0)->recharge_response_lapunumber_field;
	                                	         $recharge_response_message_field = $apiinfo->row(0)->recharge_response_message_field;
	                                	         $pendingOnEmptyTxnId = $apiinfo->row(0)->pendingOnEmptyTxnId;
	                                	         $RecRespSuccessKey = $apiinfo->row(0)->RecRespSuccessKey;
	                                	         $RecRespPendingKey = $apiinfo->row(0)->RecRespPendingKey;
	                                	         $RecRespFailureKey = $apiinfo->row(0)->RecRespFailureKey;
	                                	         $RecRespFailureText = $apiinfo->row(0)->RecRespFailureText;
	                                	          
	                                	         ///////////////////////////////////////////
	                                	         ////////////////////////////////////////
	                                	         ///////////////////////
	                                	         ///////////////////////////////////////////
	                                	         
	                                                	    $OpParam1 = '';
	                                                	    $OpParam2 = '';
	                                                	    $OpParam3 = '';
	                                                	    $OpParam4 = '';
	                                                	    $OpParam5 = '';
	                                            if($operatorcode_rslt->num_rows() == 1)
	                                            {
	                                                $OpParam1 = $operatorcode_rslt->row(0)->OpParam1;
	                                                $OpParam2 = $operatorcode_rslt->row(0)->OpParam2;
	                                                $OpParam3 = $operatorcode_rslt->row(0)->OpParam3;
	                                                $OpParam4 = $operatorcode_rslt->row(0)->OpParam4;
	                                                $OpParam5 = $operatorcode_rslt->row(0)->OpParam5;
	                                            }
	                                            $url = $hostname;
	                                	        if($this->checkduplicate($recharge_id,$api_name))
	                                	        {
	                                	        	$this->db->query("delete from tblholdtransactions where recharge_id = ?",array($recharge_id));

	                                	        	$this->db->query("update tblpendingrechares set api_id = ?,status = 'Pending' where recharge_id = ?",array($api_id,$recharge_id));

	                                	        	$this->db->query("update tblrecharge set ExecuteBy = ? where recharge_id = ?",array($api_name,$recharge_id));

	                                	        	if($transaction_api_method == "GET")
		                                	        {
		                                	            ///Recharge?apiToken=@param&mn=@mn&op=@op1&amt=@amt&reqid=@reqid&field1=&field2=
		                                	            $api_prepaid  = str_replace("@param1",$param1, $api_prepaid);
		                                	            $api_prepaid  = str_replace("@param2",$param2, $api_prepaid);
		                                	            $api_prepaid  = str_replace("@param3",$param3, $api_prepaid);
		                                	            $api_prepaid  = str_replace("@param4",$param4, $api_prepaid);
		                                	            $api_prepaid  = str_replace("@param5",$param5, $api_prepaid);
		                                	            $api_prepaid  = str_replace("@param6",$param6, $api_prepaid);
		                                	            $api_prepaid  = str_replace("@param7",$param7, $api_prepaid);
		                                	            
		                                	            $url = $hostname.$api_prepaid;
		                                	            $url  = str_replace("@mn",$Mobile, $url);
		                                	            $url  = str_replace("@amt",$Amount, $url);
		                                	            $url  = str_replace("@opparam1",$OpParam1, $url);
		                                	            $url  = str_replace("@opparam2",$OpParam2, $url);
		                                	            $url  = str_replace("@opparam3",$OpParam3, $url);
		                                	            $url  = str_replace("@opparam4",$OpParam4, $url);
		                                	            $url  = str_replace("@opparam5",$OpParam5, $url);
		                                	            $url  = str_replace("@reqid",$recharge_id, $url);
		                                	            $response = $this->common->callurl(trim($url),$recharge_id);  
		                                	        }
		                                	        if($transaction_api_method == "POST")
		                                	        {
		                                	            ///Recharge?apiToken=@param&mn=@mn&op=@op1&amt=@amt&reqid=@reqid&field1=&field2=
		                                	            $api_prepaid  = str_replace("@param1",$param1, $api_prepaid);
		                                	            $api_prepaid  = str_replace("@param2",$param2, $api_prepaid);
		                                	            $api_prepaid  = str_replace("@param3",$param3, $api_prepaid);
		                                	            $api_prepaid  = str_replace("@param4",$param4, $api_prepaid);
		                                	            $api_prepaid  = str_replace("@param5",$param5, $api_prepaid);
		                                	            $api_prepaid  = str_replace("@param6",$param6, $api_prepaid);
		                                	            $api_prepaid  = str_replace("@param7",$param7, $api_prepaid);
		                                	            
		                                	            $url = $hostname.$api_prepaid;
		                                	            $url  = str_replace("@mn",$Mobile, $url);
		                                	            $url  = str_replace("@amt",$Amount, $url);
		                                	            $url  = str_replace("@opparam1",$OpParam1, $url);
		                                	            $url  = str_replace("@opparam2",$OpParam2, $url);
		                                	            $url  = str_replace("@opparam3",$OpParam3, $url);
		                                	            $url  = str_replace("@opparam4",$OpParam4, $url);
		                                	            $url  = str_replace("@opparam5",$OpParam5, $url);
		                                	            $url  = str_replace("@reqid",$recharge_id, $url);
		                                	            
		                                	            //$url = explode("?",$url)[0];
		                                	            $postdata = explode("?",$url)[1];
		                                	            $response = $this->common->callurl_post(trim($url),$postdata,$recharge_id);  
		                                	        }
		                                	        
		                                	        
		                                            if($recharge_response_type == "XML")
		                                            {
		                                                $obj = (array)simplexml_load_string( $response);
		                                               
		                                                $recharge_response_status_field = str_replace("<","",$recharge_response_status_field);
		                                                $recharge_response_status_field = str_replace(">","",$recharge_response_status_field);
		                                                
		                                                
		                                                 $recharge_response_otf_field = str_replace("<","",$recharge_response_otf_field);
		                                                $recharge_response_otf_field = str_replace(">","",$recharge_response_otf_field);
		                                                
		                                                // echo $recharge_response_status_field;
		                                                // echo "<br><br>";
		                                                // print_r($obj);exit;
		                                                
		                                                $recharge_response_opid_field = str_replace("<","",$recharge_response_opid_field);
		                                                $recharge_response_opid_field = str_replace(">","",$recharge_response_opid_field);
		                                                
		                                                
		                                                $recharge_response_balance_field = str_replace("<","",$recharge_response_balance_field);
		                                                $recharge_response_balance_field = str_replace(">","",$recharge_response_balance_field);
		                                                
		                                                if(isset($obj[$recharge_response_status_field]))
		                                                {
		                                                    $statusvalue = $obj[$recharge_response_status_field];
		                                                
		                                                    $operator_id = json_encode($obj[$recharge_response_opid_field]);
		                                                    $operator_id = str_replace('"','',$operator_id);
		                                                    $lapubalance = 0;
		                                                    if(isset($obj[$recharge_response_balance_field]))
		                                                    {
		                                                        $lapubalance = $obj[$recharge_response_balance_field];    
		                                                    }
		                                                    
		                                                    
		                                                    
		                                                    $roffer = 0;
		                                                    if(isset($obj[$recharge_response_otf_field]))
		                                                    {
		                                                        $roffer = $obj[$recharge_response_otf_field];    
		                                                    }
		                                                    
		                                                    $success_key_array = explode(",",$RecRespSuccessKey);
		                                                    $failure_key_array = explode(",",$RecRespFailureKey);
		                                                    $pending_key_array = explode(",",$RecRespPendingKey);
		                                                    
		                                                   
		                                                    if (in_array($statusvalue, $success_key_array)) 
		                                                    {
		                                                        $status = 'Success';
		                                                        $this->Update_methods->updateRechargeStatus($recharge_id,$operator_id,$status,true,$lapubalance,0,false,$roffer);
		                                                    }
		                                                    else if (in_array($statusvalue, $failure_key_array)) 
		                                                    {
		                                                        $status = 'Failure';
		                                                        $this->Update_methods->updateRechargeStatus($recharge_id,$operator_id,$status,true,$lapubalance,0,false,$roffer);
		                                                    }
		                                                    else  if (in_array($statusvalue, $pending_key_array)) 
		                                                    {
		                                                        $status = 'Pending';
		                                                        $operator_id = "";
		                                                    }   
		                                                }
		                                                else
		                                                {
		                                                    $status = 'Pending';
		                                                    $operator_id = "";  
		                                                }
		                                            }
		                                            else if($recharge_response_type == "JSON")
		                                            {
		                                                $obj = (array)json_decode($response);
		                                               
		                                                
		                                                
		                                                if(isset($obj[$recharge_response_status_field]))
		                                                {
		                                                	$statusvalue = "";
		                                                	if(isset($obj[$recharge_response_status_field]))
		                                                	{
		                                                		$statusvalue = $obj[$recharge_response_status_field];	
		                                                	}
		                                                    

		                                                    $operator_id = "";
		                                                    if(isset($obj[$recharge_response_opid_field]))
		                                                    {
		                                                    	$operator_id = $obj[$recharge_response_opid_field];	
		                                                    }
		                                                    $roffer = 0;
		                                                    if(isset($obj[$recharge_response_otf_field]))
		                                                    {
		                                                        $roffer = $obj[$recharge_response_otf_field];    
		                                                    }
		                                                    
		                                                    $lapubalance = 0;
		                                                    if(isset($obj[$recharge_response_balance_field]))
		                                                    {
		                                                        $lapubalance = $obj[$recharge_response_balance_field];    
		                                                    }
		                                                
		                                                    $success_key_array = explode(",",$RecRespSuccessKey);
		                                                    $failure_key_array = explode(",",$RecRespFailureKey);
		                                                    $pending_key_array = explode(",",$RecRespPendingKey);
		                                                    $failure_text_array = explode(",",$RecRespFailureText);
		                                                    
		                                                   
		                                                    if($statusvalue != "")
		                                                    {
		                                                    	foreach($success_key_array as $success_key)
							                           			{
								                           			$statusvalue = trim($statusvalue);
								                           			$success_key = trim($success_key);
								                           			if($statusvalue == $success_key)
								                           			{
								                           				$status = 'Success';
				                                                        $this->Update_methods->updateRechargeStatus($recharge_id,$operator_id,$status,true,$lapubalance,0,false,$roffer);
										                                break;
								                           			}
								                           		}

								                           		///check pending
								                           		foreach($pending_key_array as $pending_key)
								                           		{
								                           			$statusvalue = trim($statusvalue);
								                           			$pending_key = trim($pending_key);
								                           			if($statusvalue == $pending_key)
								                           			{
								                           				$status = 'Pending';
				                                                        $operator_id = "";
										                                break;
								                           			}
								                           		}
		                                                   
								                           		///check failure
								                           		foreach($failure_key_array as $failure_key)
								                           		{
								                           			$statusvalue = trim($statusvalue);
								                           			$failure_key = trim($failure_key);
								                           			if($statusvalue == $failure_key)
								                           			{
								                           				$status = 'Failure';
			                                                        	$this->Update_methods->updateRechargeStatus($recharge_id,$operator_id,$status,true,$lapubalance,0,false,$roffer);
										                                break;
								                           			}
								                           		}

								                           		///// check failurekeytet
								                           		foreach($failure_text_array as $failure_text)
											               		{
											               			if(strlen($failure_text) >= 6)
											               			{
											               				if (preg_match("/".$failure_text."/",$response)  == 1)
													               		{

												               				$status = 'Failure';
												                        	$this->Update_methods->updateRechargeStatus($recharge_id,$operator_id,$status,true,$lapubalance,0,false,$roffer);
												                            break;
												               			
													               		}	
											               			}
											               		}
			                                                }
			                                                else
		                                                   {
		                                                   		$response_send = false;
			                                               		///// check failurekeytet
								                           		foreach($failure_text_array as $failure_text)
											               		{
											               			if(strlen($failure_text) >= 6)
											               			{
											               				if (preg_match("/".$failure_text."/",$response)  == 1)
													               		{

												               				$status = 'Failure';
												                        	$this->Update_methods->updateRechargeStatus($recharge_id,$operator_id,$status,true,$lapubalance,0,false,$roffer);
												                        	$response_send = true;
												                            break;
												               			
													               		}	
											               			}
											               		}
											               		if($response_send == false) 
											               		{
											               			$status = 'Pending';
				                                                    $operator_id = "";
											               		}	   	
			                                			   } 
		                                                }
		                                                else
		                                                {
		                                                    $status = 'Pending';
		                                                    $operator_id = "";  
		                                                }
		                                            }
		                                            else if($recharge_response_type == "CSV")
		                                            {
		                                                $obj = explode($response_separator,$response);
		                                               
		                                                if(isset($obj[$recharge_response_status_field]))
		                                                {
		                                                	$statusvalue = "";
		                                                	if(isset($obj[$recharge_response_status_field]))
		                                                	{
		                                                		$statusvalue = $obj[$recharge_response_status_field];	
		                                                	}

		                                                    $operator_id = "";
		                                                    if(isset($obj[$recharge_response_opid_field]))
		                                                    {
		                                                    	$operator_id = json_encode($obj[$recharge_response_opid_field]);	
		                                                    }
		                                                    
		                                                    
		                                                    $roffer = 0;
		                                                    if(isset($obj[$recharge_response_otf_field]))
		                                                    {
		                                                        $roffer = $obj[$recharge_response_otf_field];   
		                                                    }
		                                                    
		                                                   $lapubalance = 0;
		                                                   if(isset($obj[$recharge_response_balance_field]))
		                                                   {
		                                                     $lapubalance = $obj[$recharge_response_balance_field];    
		                                                   }
		                                                    
		                                                    $success_key_array = explode(",",$RecRespSuccessKey);
		                                                    $failure_key_array = explode(",",$RecRespFailureKey);
		                                                    $pending_key_array = explode(",",$RecRespPendingKey);
		                                                    $failure_text_array = explode(",",$RecRespFailureText);


		                                                    //echo "START : ".$RecRespFailureText;

		                                                   if($statusvalue != "")
		                                                   {


		                                                   		foreach($success_key_array as $success_key)
							                           			{
								                           			$statusvalue = trim($statusvalue);
								                           			$success_key = trim($success_key);
								                           			if($statusvalue == $success_key)
								                           			{
								                           				$status = 'Success';
				                                                        $this->Update_methods->updateRechargeStatus($recharge_id,$operator_id,$status,true,$lapubalance,0,false,$roffer);
										                                break;
								                           			}
								                           		}

								                           		///check failure
								                           		foreach($pending_key_array as $pending_key)
								                           		{
								                           			$statusvalue = trim($statusvalue);
								                           			$pending_key = trim($pending_key);
								                           			if($statusvalue == $pending_key)
								                           			{
								                           				$status = 'Pending';
					                                                    $operator_id = "";
										                                break;
								                           			}
								                           		}
		                                                   
								                           		///check failure
								                           		foreach($failure_key_array as $failure_key)
								                           		{
								                           			$statusvalue = trim($statusvalue);
								                           			$failure_key = trim($failure_key);
								                           			if($statusvalue == $failure_key)
								                           			{
								                           				$status = 'Failure';
			                                                        	$this->Update_methods->updateRechargeStatus($recharge_id,$operator_id,$status,true,$lapubalance,0,false,$roffer);
										                                break;
								                           			}
								                           		}

								                           		
		                                                   		   
		                                                   }
		                                                   else
		                                                   {
		                                                   		$response_send = false;
			                                               		///// check failurekeytet
								                           		foreach($failure_text_array as $failure_text)
											               		{
											               			if(strlen($failure_text) >= 6)
											               			{
											               				if (preg_match("/".$failure_text."/",$response)  == 1)
													               		{

												               				$status = 'Failure';
												                        	$this->Update_methods->updateRechargeStatus($recharge_id,$operator_id,$status,true,$lapubalance,0,false,$roffer);
												                        	$response_send = true;
												                            break;
												               			
													               		}	
											               			}
											               		}
											               		if($response_send == false) 
											               		{
											               			$status = 'Pending';
				                                                    $operator_id = "";
											               		}	   	
			                                			   }
		                                                }
		                                                else
		                                                {
		                                                    $status = 'Pending';
		                                                    $operator_id = "";
		                                                }
		                                            }  
		                                            else if($recharge_response_type == "PARSER")
		                                            {
		                                                $rsltmessagesettings = $this->db->query("select * from message_setting where api_id = ?",array($ApiInfo->row(0)->Id));
		                                                if($rsltmessagesettings->num_rows() >= 1)
		                                                {
		                                                    foreach($rsltmessagesettings->result() as $r)
		    												{
		    													$status_word = $r->status_word;
		    													$num_start = $r->number_start;
		    													$num_end = $r->number_end;
		    													
		    													$balance_start = $r->balance_start;
		    													$balance_end = $r->balance_end;
		    													
		    													$operator_id_start = $r->operator_id_start;
		    													$operator_id_end = $r->operator_id_end;
		    													$status = $r->status;
		    													$api_id = $r->api_id;
		    													//echo $status_word;exit;
		                                                        
		    													if (preg_match("/".$status_word."/",$response) == 1 and preg_match("/".$operator_id_start."/",$response) == 1)
		    													{
		                                                            
		    														$mobile_no = $this->get_string_between($response, $num_start, $num_end);
		    														$operator_id = $this->get_string_between($response, $operator_id_start, $operator_id_end);
		    														
		    														$lapubalance = $this->get_string_between($response, $balance_start, $balance_end);
		    
		    														$operator_id = str_replace("\n","",$operator_id);
		    														$mobile_no = str_replace("\n","",$mobile_no);
		                                                        	
		    														$this->load->model("Update_methods");
		    														if($status == "Success" or $status == "Failure")
		    														{
		    															if($status == "Failure")
		    															{
		    																$status = 'Failure';
		                                                                    $this->Update_methods->updateRechargeStatus($recharge_id,$operator_id,$status,true,$lapubalance,0,false,$roffer);
		    															}
		    															else
		    															{
		    																$status = 'Success';
		                                                                    $this->Update_methods->updateRechargeStatus($recharge_id,$operator_id,$status,true,$lapubalance);
		    															}	
		    														}
		    														else
		    														{
		    															$status = 'Pending';
		    															$operator_id = "";
		    															$order_id = "";
		    														}
		    													}
		    													else
		    													{
		        													$status = 'Pending';
		                                                            $operator_id = "";
		    													}
		    												}
		                                                }
		                                                else
		                                                {
		                                                    $status = 'Pending';
		                                                    $operator_id = "";
		                                                    
		                                                }     
		                                            }
	                                	        }
            					}
						   	}
					   	}
			        }




			    }
		 	}
		 }
	}
	public function checkduplicate($recharge_id,$api_name)
	{
		$rslt = $this->db->query("insert into locking_holdprocessor(recharge_id,add_date,API,ipaddress) values(?,?,?,?)",
				array($recharge_id,$this->common->getDate(),$api_name,$this->common->getRealIpAddr()));
		if($rslt == true)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	public function checkpendinglimit($api_id,$company_id)
	{
	    $rslt = $this->db->query("select pendinglimit,failurelimit,totalpending,failurecount from pf_values where api_id = ? and company_id = ?",array($api_id,$company_id));
	    if($rslt->num_rows() == 1)
	    {
	        $pendinglimit = $rslt->row(0)->pendinglimit;
	        $failurelimit = $rslt->row(0)->failurelimit;
	        $totalpending = $rslt->row(0)->totalpending;
	        $failurecount = $rslt->row(0)->failurecount;
	        if($pendinglimit >= $totalpending or  $pendinglimit == 0)
	        {
	            return true;
	        }
	        else
	        {
	            return false;
	        }
	    }
	    else
	    {
	        return true;
	    }
	}
	public function getcircle($Mobile)
	{
	    $stateurl = 'https://www.freecharge.in/rest/operators/mapping/V/'.$Mobile;
		$data = $this->ExecuteAPI($stateurl);
		$dataarray = (array)json_decode($data);
	    $state = 0;
		if(is_array($dataarray))
		{
			if(isset($dataarray["prefixData"]))
			{
				$state = trim($dataarray["prefixData"][0]->circleMasterId);
			}
		}
		return $state;
	}
	public function getcircle_planapi($Mobile)
	{
	    $stateurl = 'http://planapi.in/api/Mobile/OperatorFetch?apimember_id=3113&api_password=sworld123*&Mobileno='.$Mobile;
		$data = $this->ExecuteAPI($stateurl);
		$dataarray = json_decode($data);
	    $state = 0;
	    	
		if(isset($dataarray->CircleCode))
		{
			$state =$dataarray->CircleCode;
			

			$circlerslt = $this->db->query("select circleMasterId from freecharge_circlemaster where mplancircle = ?",array($state));
			if($circlerslt->num_rows() == 1)
			{
				return $circlerslt->row(0)->circleMasterId;
			}

		}
		
		return 0;
	}
	private function ExecuteAPI($url)
	{	
	
		$ch = curl_init();
		curl_setopt($ch,CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		$buffer = curl_exec($ch);	
		curl_close($ch);
		return $buffer;
	}
}