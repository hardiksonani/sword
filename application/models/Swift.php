<?php
class Swift extends CI_Model 
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
	
	
	
	
	
	public function getTransactionChargeInfo($userinfo,$TransactionAmount)
	{
			return 5.00;
	}
	





	public function fetchbill_swift($userinfo,$company_id,$service_no,$CustomerMobile,$option1 = "")
	{
$request_array = array();

		// error_reporting(-1);
		// ini_set('display_errors',1);
		// $this->db->db_debug = TRUE;


		$company_info = $this->db->query("select mcode from tblcompany where company_id = ?",array($company_id));

		if($company_info->row(0)->mcode == "UGE" or $company_info->row(0)->mcode == "PGE" or $company_info->row(0)->mcode == "DGE" or $company_info->row(0)->mcode == "MGE" or $company_info->row(0)->mcode == "AGE")
	   {
	   		$mcode = $company_info->row(0)->mcode;
	       if($mcode == "UGE"){$spkey = "UGVCL"; }
	       if($mcode == "PGE"){$spkey = "PGVCL"; }
	       if($mcode == "DGE"){$spkey = "DGVCL"; }
	       if($mcode == "MGE"){$spkey = "MGVCL"; }
	       if($mcode == "AGE"){$spkey = "ADGL"; }
	       
	     
	       $url = "http://airmall.in/appapi1/getPlan/getElectricityBill?mcode=".$mcode."&number=".$service_no;
	       //$url = 'https://www.mplan.in/api/electricinfo.php?apikey=f4d8d1412123de1269742f76c746783d&offer=roffer&operator='.$spkey.'&tel='.$serviceno;
	      //  echo $url;exit;
	      // $this->logentry2($url);
    	   $buffer = $this->common->callurl($url);
    	   echo $buffer;exit;
    	
	   }




	//echo $Mobile."   ".$CustomerMobile;exit;
	$ipaddress = $this->common->getRealIpAddr();
	$payment_mode = "CASH";
	$payment_channel = "AGT";
	$url= '';
	$buffer = '';

	$ApiInfo = $this->db->query("select Id from api_configuration where api_name = 'SWIFT'");
	if($ApiInfo->num_rows() == 1)
	{
		$api_id = $ApiInfo->row(0)->Id;
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
						
							$insert_rslt = $this->db->query("insert into tblbillcheck(add_date,ipaddress,user_id,mobile,customer_mobile,company_id) values(?,?,?,?,?,?)",array($this->common->getDate(),$ipaddress,$user_id,$service_no,$CustomerMobile,$company_id));
							if($insert_rslt == true)
							{
								$insert_id = $this->db->insert_id();
								$transaction_type = "BILL";
								$Description = "Service No.  ".$service_no;
								$sub_txn_type = "BILL";
								$remark = "Bill PAYMENT";
								$Charge_Amount = 0.00;
								
								



								$operatorcode_rslt = $this->db->query("
	                                                	    select 
	                                                	    a.company_id,
	                                                	    a.company_name,
	                                                	    a.mcode,
	                                                	    a.service_id,
	                                                	    b.service_name,
	                                                	    g.commission,
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
	                                                	    order by service_id",array($api_id,$company_id));
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
















									
								$request_array = array(

									"ClientRefId"=>"FETCH".$insert_id,
									"Number"=>$service_no,
									"SPKey"=>$OpParam1,
									"TelecomCircleID"=>"0",
									"Optional1"=>"9428556279",
									"Optional2"=>"",
									"Optional3"=>"",
									"Optional4"=>"",
									"Optional5"=>"",
									"Optional6"=>"",
									"Optional7"=>"",
									"Optional8"=>"",
									"Optional9"=>"",

							);

							//	print_r($request_array);exit;

							$curl = curl_init();

							curl_setopt_array($curl, array(
							  CURLOPT_URL => "http://mswift.quicksekure.com/api/BBPS/BBPSBillFetch",
							  CURLOPT_RETURNTRANSFER => true,
							  CURLOPT_ENCODING => "",
							  CURLOPT_MAXREDIRS => 10,
							  CURLOPT_TIMEOUT => 0,
							  CURLOPT_FOLLOWLOCATION => true,
							  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
							  CURLOPT_CUSTOMREQUEST => "POST",
							  CURLOPT_POSTFIELDS =>json_encode($request_array),
							  CURLOPT_HTTPHEADER => array(
							  	 "Header: Content-Type: application/json",
							    "ClientID: ",
							    "SecretKey: ",
							    "TokenID: ",
							    "Accept: application/json",
							    "ContentType: application/json",
							    "Content-Type: application/json"
							  ),
							));

							$response = curl_exec($curl);
							//echo $response;exit;
							$this->loging("SWIFT_BILL",$url." ?".json_encode($request_array),$response,"",$userinfo->row(0)->username);
							/*

								{"Response":"SUCCESS","Price":"292","billduedate":"2020-11-14","DisplayValues":"[{\"label\":\"Customer Name : \",\"value\":\"DILIPBHAI PATEL\"}]"}

		
								{"ResponseCode":"000","ResponseMessage":"Transaction Successful","dueamount":292.0,"duedate":"2020-11-14","customername":"DILIPBHAI PATEL","billnumber":"500000070354","billdate":"24 Oct 2020","acceptPartPay":"N","BBPSCharges":"","BillUpdate":"T+1","RequestID":"3320190805296833","ClientRefId":"FETCH22"}{"message":"Internal Server Error Occured","status":1,"statuscode":"ERR"}
							*/

									curl_close($curl);
									$json_obj = json_decode($response);

									if(isset($json_obj->ResponseCode) and isset($json_obj->ResponseMessage))
									{
										$ResponseCode = trim($json_obj->ResponseCode);
										$ResponseMessage = trim($json_obj->ResponseMessage);
										
										if($ResponseCode == '000')
										{
											$dueamount = $json_obj->dueamount;
											$duedate = $json_obj->duedate;
											$customername = $json_obj->customername;
											$billnumber = $json_obj->billnumber;
											$billdate = $json_obj->billdate;
											$acceptPartPay = $json_obj->acceptPartPay;

											$BBPSCharges = $json_obj->BBPSCharges;
											$RequestID = $json_obj->RequestID;
											$ClientRefId = $json_obj->ClientRefId;





											

											$this->db->query("update tblbillcheck set check_dueamount = ?,check_duedate=?,check_customername=?,check_billnumber=?,check_billdate=?,check_billperiod=?,check_reference_id = ? where Id = ?",array($dueamount,$duedate,$customername,$billnumber,$billdate,"",$RequestID,$insert_id ));




											/*
											{"statuscode":"TXN","status":"0","message":"BILL FETCH SUCCESSFUL",
									"particulars":
									{
									    "dueamount":16960,"duedate":"2020-01-07","customername":"MR. BRIJ KISHORE SHARMA",
									    "billnumber":"150895735","billdate":"2019-12-20",
									    "billperiod":"JANUARY","reference_id":492751
									    
									}
									    
											*/
											$display_array = array(array(
																	"label"=>"Customer Name",
																	"value"=>"".$customername
																));

											$display_array = json_encode($display_array);
											$resparray = array(

												"statuscode"=>"TXN",
												"status"=>"0",
												"message"=>"BILL FETCH SUCCESSFUL",
												"particulars"=>array(
																	"dueamount"=>(string)$dueamount,
																	"duedate"=>$billdate,
																	"customername"=>$customername,
																	"billnumber"=>"",
																	"billdate"=>"",
																	"billperiod"=>"",
																	"reference_id"=>""
												),

												"Response"=>"SUCCESS",
												"Price"=>(string)$dueamount,
												"billduedate"=>$billdate,
												"DisplayValues"=>$display_array
											);
											echo json_encode($resparray);exit;


											return $buffer;
										}
										else
										{
											$resp_arr = array(
											"Response"=>"ERROR",
											"Message"=>$ResponseMessage,
											"message"=>$ResponseMessage,
											"status"=>1,
											"statuscode"=>"ERR",
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
	}

	
	$this->loging("SWIFT_BILL",$url." ?".json_encode($request_array),$buffer,$json_resp,$userinfo->row(0)->username);
	return $json_resp;
	
}



public function recharge_transaction2($userinfo,$company_id,$Amount,$Mobile,$CustomerMobile,$remark,$option1,$ref_id,$particulars,$option2="",$option3="",$done_by = "WEB",$order_id = 0)
{
   

	$ipaddress = $this->common->getRealIpAddr();
	$payment_mode = "CASH";
	$payment_channel = "AGT";
	$url= '';
	$buffer = '';

	$company_info = $this->db->query("select * from tblcompany where company_id = ?",array($company_id));

    $ApiInfo = $this->db->query("select * from api_configuration where api_name = 'SWIFT'");
	if($ApiInfo->num_rows() == 1)
	{
		$api_id = $ApiInfo->row(0)->Id;
		$api_name = $ApiInfo->row(0)->api_name;
		if($userinfo != NULL)
		{
			if($userinfo->num_rows() == 1)
			{
				
				$user_id = $userinfo->row(0)->user_id;
				$parentid = $userinfo->row(0)->parentid;
				$usertype_name = $userinfo->row(0)->usertype_name;
				$user_status = $userinfo->row(0)->status;
				$utility_group = $userinfo->row(0)->utility_group;
				if($usertype_name == "Agent" or $usertype_name == "APIUSER")
				{
					if($Amount < $company_info->row(0)->minamt )
				    {

				    	$resp_array = array(
										"Message"=>"You can only pay between  ".$company_info->row(0)->minamt."-".$company_info->row(0)->mxamt,
										"Response"=>"FAILED"
									);
						echo json_encode($resp_array);exit;
				    }
				    else if($Amount > $company_info->row(0)->mxamt )
				    {

				    	$resp_array = array(
										"Message"=>"You can only pay between  ".$company_info->row(0)->minamt."-".$company_info->row(0)->mxamt,
										"Response"=>"FAILED"
									);
						echo json_encode($resp_array);exit;
				    }
				    else if($userinfo->row(0)->service == 'no' )
				    {
				    	$resp_array = array(
										"Message"=>"Userinfo Missing",
										"Response"=>"FAILED"
									);
						echo json_encode($resp_array);exit;
				    }
				     $rsltcheck = $this->db->query("SELECT recharge_id FROM  tblrecharge  where mobile_no = ? and user_id = ? and recharge_status != 'Failure' and Date(add_date) = ?
ORDER BY recharge_id  DESC",array($Mobile,$userinfo->row(0)->user_id,$this->common->getMySqlDate()));
	                if($rsltcheck->num_rows() == 1)
	                //if(false)
	                {
	                	$resp_array = array(
										"Message"=>"Duplicate Request Found.",
										"Response"=>"FAILED"
									);
						echo json_encode($resp_array);exit;
	                }
					else if($user_status == '1')
					{
							$crntBalance = $this->Common_methods->getAgentBalance($user_id);
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


    					error_reporting(-1);
    					ini_set('display_errors',1);
    					$this->db->db_debug = TRUE;
                            //print_r($billcheck_rslt->result());exit;
    							
    							// $insert_rslt = $this->db->query("insert into tblbills(add_date,ipaddress,user_id,service_no,customer_mobile,company_id,bill_amount,paymentmode,payment_channel,status,customer_name,dueamount,duedate,billnumber,billdate,billperiod,option1,done_by,API)
    							// values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)",
    							// array($this->common->getDate(),$ipaddress,$user_id,$Mobile,$CustomerMobile,$company_id,$Amount,$payment_mode,$payment_channel,"Pending",$custname,$dueamount,$duedate,$billnumber,$billdate,$billperiod,$option1,$done_by,$api_name));
    						$operatorcode_rslt = $this->db->query("
	                                                	    select 
	                                                	    a.company_id,
	                                                	    a.company_name,
	                                                	    a.mcode,
	                                                	    a.service_id,
	                                                	    b.service_name,
	                                                	    g.commission,
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
	                                                	    order by service_id",array($api_id,$company_id));
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
























    							$MdId = 0;
    							$dist_info = $this->db->query("select * from tblusers where user_id = ?",array($userinfo->row(0)->parentid));
    							if($dist_info->num_rows() == 1)
    							{
    								$MdId = $dist_info->row(0)->parentid;
    							}

    							$recharge_status = "Pending";

    							$commission_amount = 0;
    							$commission_per = 0;
    							$dist_commission_amount = 0;
    							$dist_commission_per = 0;
    							$md_commission_amount = 0;
    							$md_commission_per = 0;
    							$DId = $userinfo->row(0)->parentid;
    							
    							$ExecuteBy = $api_name;
    							$state_id = 0;
    							$adminComPer = 0;
    							$adminCom = 0;
    							$host_id = 1;
    							$flatcomm = 0;


    							$RComm = 0;
    							$SdComm = 0;
								$MdComm = 0;
								$DComm = 0;
								$RComm = 0;
    							$commission_type = "PER";
    							//////////////////////commission calculation
    							$company_info = $this->db->query("select service_id from tblcompany where company_id = ?",array($company_id));
								if($company_info->num_rows() == 1)
								{
									$service_id = $company_info->row(0)->service_id;
									
										
										$commission_info = $this->db->query("select SdComm,MdComm,DComm,RComm,commission_type from tblutilitycommission where group_id = ? and service_id = ?",array($utility_group,$service_id));
										if($commission_info->num_rows() == 1)
										{
											$SdComm = $commission_info->row(0)->SdComm;
											$MdComm = $commission_info->row(0)->MdComm;
											$DComm = $commission_info->row(0)->DComm;
											$RComm = $commission_info->row(0)->RComm;
											$commission_type = $commission_info->row(0)->commission_type;

										}
										else if($commission_info->num_rows() == 0)
										{
											$commission_info = $this->db->query("select SdComm,MdComm,DComm,RComm,commission_type from tblutilitycommission where group_id = (select Id from utility_group where Name = 'Default_utility_group') and service_id = ?",array($service_id));
											if($commission_info->num_rows() == 1)
											{
												$SdComm = $commission_info->row(0)->SdComm;
												$MdComm = $commission_info->row(0)->MdComm;
												$DComm = $commission_info->row(0)->DComm;
												$RComm = $commission_info->row(0)->RComm;
												$commission_type = $commission_info->row(0)->commission_type;	
											}
											

										}

									
								}













								//retailer charge
								$Charge_Amount =$RComm;
								if($commission_type == "PER")
								{
									$Charge_Amount =(($Amount * $RComm) / 100);
								}	



								$commission_amount =$RComm;
								if($commission_type == "PER")
								{
									$commission_amount =(($Amount * $RComm) / 100);
								}	



								$dist_commission_per = $commission_type;
								$dist_commission_amount =$DComm;
								if($dist_commission_per == "PER")
								{
									$dist_commission_amount =(($Amount * $DComm) / 100);
								}	


								$md_commission_per = $commission_type;
								$md_commission_amount =$MdComm;
								if($md_commission_per == "PER")
								{
									$md_commission_amount =(($Amount * $MdComm) / 100);
								}	





    							$str_query = "insert into tblrecharge(
								company_id,amount,mobile_no,user_id,recharge_by,
								recharge_status,add_date,ipaddress,
								commission_amount,commission_per,
								DId,DComm,DComPer,
            					MdId,MdComm,MdComPer,
								ExecuteBy,order_id,state_id,AdminCommPer,AdminComm,host_id,flat_commission,CustomerMobile) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
							$recharge_status = "Pending";
							$insert_rslt = $this->db->query($str_query,array(
								$company_id,$Amount,$Mobile,$user_id,
								$done_by,$recharge_status,$this->common->getDate(),$this->common->getRealIpAddr(),
								$commission_amount,$commission_type,
								$DId,$dist_commission_amount,$dist_commission_per,
								$MdId,$md_commission_amount,$md_commission_per,
								$ExecuteBy,$order_id,$state_id,$adminComPer,$adminCom,$host_id,$flatcomm,$CustomerMobile));	

    							if($insert_rslt == true)
    							{
    								
    								$insert_id = $this->db->insert_id();



    								$transaction_type = "BILL";







    								
    								$dr_amount = $Amount - $commission_amount;
    								$Description = "Service No.  ".$Mobile." Bill Amount : ".$Amount;
    								$sub_txn_type = "BILL";
    								$remark = "Bill PAYMENT";
    								$Charge_Amount = $commission_amount;
    								
    								$paymentdebited = $this->PAYMENT_DEBIT_ENTRY($user_id,$insert_id,$transaction_type,$dr_amount,$Description,$sub_txn_type,$remark,$Charge_Amount,$userinfo);
    								if($paymentdebited == true)
    								{
    								    
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


									    if($dohold == 'yes')
										{
											
											$resp_array = array(
														"Message"=>$ResponseMessage,
														"Response"=>"PENDING"
													);
											echo json_encode($resp_array);exit;
										}
										else
										{
											


											$request_array = array(

													"ClientRefId"=>"FETCH".$insert_id,
													"Number"=>$Mobile,
													"SPKey"=>$OpParam1,
													"TelecomCircleID"=>"0",
													"Amount"=>$Amount,
													"Optional1"=>$option1,
													"Optional2"=>"",
													"Optional3"=>"",
													"Optional4"=>"",
													"Optional5"=>"",
													"Optional6"=>"",
													"Optional7"=>"",
													"Optional8"=>"",
													"Optional9"=>"",

											);

											//	print_r($request_array);exit;

											$curl = curl_init();

											curl_setopt_array($curl, array(
											  CURLOPT_URL => "http://mswift.quicksekure.com/api/BBPS/BBPSPayment",
											  CURLOPT_RETURNTRANSFER => true,
											  CURLOPT_ENCODING => "",
											  CURLOPT_MAXREDIRS => 10,
											  CURLOPT_TIMEOUT => 0,
											  CURLOPT_FOLLOWLOCATION => true,
											  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
											  CURLOPT_CUSTOMREQUEST => "POST",
											  CURLOPT_POSTFIELDS =>json_encode($request_array),
											  CURLOPT_HTTPHEADER => array(
											    "Header: Content-Type: application/json",
											    "ClientID: ",
											    "SecretKey: ",
											    "TokenID: ",
											    "Accept: application/json",
											    "ContentType: application/json",
											    "Content-Type: application/json"
											  ),
											));
											$url = "http://mswift.quicksekure.com/api/BBPS/BBPSPayment";
											$response = curl_exec($curl);



											$this->db->query("insert into tblreqresp(recharge_id,request,response,add_date,ipaddress)
												values(?,?,?,?,?)",array($insert_id,$url,$response,$this->common->getDate(),$this->common->getRealIpAddr()));

											$this->loging("SWIFT_BILL",$url." ?".json_encode($request_array),$response,"",$userinfo->row(0)->username);
											$this->loging("BILL",json_encode($request_array),$response,"",$userinfo->row(0)->username);
											$json_obj = json_decode($response);

											if(isset($json_obj->ResponseCode) and isset($json_obj->ResponseMessage))
											{
												$ResponseCode = trim($json_obj->ResponseCode);
												$ResponseMessage = trim($json_obj->ResponseMessage);
												$TransactionId  = $json_obj->TransactionId;
												$AvailableBalance  = $json_obj->AvailableBalance;
												$ClientRefId  = $json_obj->ClientRefId;
												
												if($ResponseCode == '000')//success
												{
													$opr_id = $json_obj->OperatorTransactionId;
													$this->db->query("update tblrecharge set recharge_status = 'Success',transaction_id = ?,operator_id=?,response_message = ? where recharge_id = ?",array($TransactionId,$opr_id,$ResponseMessage,$insert_id));
													

													$this->load->model("Commission");
													$this->Commission->ParentCommission($insert_id);


													$resp_array = array(
														"statuscode"=>"TXN",
														"status"=>"0",
														"message"=>$ResponseMessage,
														"data"=>array(
																		"ipay_id"=>$insert_id,
																		"opr_id"=>$opr_id,
																		"status"=>"Success"
																		),
														"Message"=>$ResponseMessage,
														"Response"=>"SUCCESS"
													);
													echo json_encode($resp_array);exit;
												}
												else if($ResponseCode == '999')//pending
												{
													$opr_id = $json_obj->OperatorTransactionId;
													$this->db->query("update tblrecharge set recharge_status = 'Pending',transaction_id = ?,response_message = ? where recharge_id = ?",array($TransactionId,$ResponseMessage,$insert_id));
													

													$resp_array = array(
														"statuscode"=>"TXN",
														"status"=>"0",
														"message"=>$ResponseMessage,
														"data"=>array(
																		"ipay_id"=>$insert_id,
																		"opr_id"=>$opr_id,
																		"status"=>"Pending"
																		),
														"Message"=>$ResponseMessage,
														"Response"=>"PENDING"
													);
													echo json_encode($resp_array);exit;

												}
												else //failure
												{
														$this->db->query("update tblrecharge set recharge_status = 'Failure',transaction_id = ?,response_message = ? where recharge_id = ?",array($TransactionId,$ResponseMessage,$insert_id));
														$this->PAYMENT_CREDIT_ENTRY($user_id,$insert_id,$transaction_type,$dr_amount,$Description,$sub_txn_type,$remark,$Charge_Amount,$userinfo);
														
													$resp_array = array(
														"statuscode"=>"ERR",
														"status"=>"1",
														"message"=>$ResponseMessage,
														"Message"=>$ResponseMessage,
														"Response"=>"FAILED"
													);
													echo json_encode($resp_array);exit;
												}
											}
											else
											{
												$resp_array = array(
														"statuscode"=>"ERR",
														"status"=>"1",
														"message"=>"Your Request Under Process",
														"Message"=>"Your Request Under Process",
														"Response"=>"PENDING"
													);
												echo json_encode($resp_array);exit;
											}
										}
    								}
    								else
    								{
    									$this->db->query("update tblrecharge set recharge_status = 'Failure',transaction_id = ?,response_message = ? where recharge_id = ?",array($TransactionId,$ResponseMessage,$insert_id));


    									$resp_array = array(
    													"statuscode"=>"ERR",
														"status"=>"1",
														"message"=>"Payment Error. Please Try Again",
														"Message"=>"Payment Error. Please Try Again",
														"Response"=>"FAILED"
													);
										echo json_encode($resp_array);exit;
    								}
    							}
    						}
    						else
    						{
    							$resp_array = array(
    													"statuscode"=>"ERR",
														"status"=>"1",
														"message"=>"Internal Server Error",
														"Message"=>"InSufficient Balance",
														"Response"=>"FAILED"
													);
								echo json_encode($resp_array);exit;


    						}
					}
					else
					{
						$resp_array = array(
														"statuscode"=>"ERR",
														"status"=>"1",
														"message"=>"Internal Server Error 2",
														"Message"=>"Your Account Deactivated By Admin",
														"Response"=>"FAILED"
													);
						echo json_encode($resp_array);exit;

					}
						
				}
				else
				{
					$resp_array = array(
										"statuscode"=>"ERR",
										"status"=>"1",
										"message"=>"Internal Server Error 2",
										"Message"=>"Invalid Access",
										"Response"=>"FAILED"
									);
					echo json_encode($resp_array);exit;
				}
			}
			else
			{


				$resp_array = array(
										"statuscode"=>"ERR",
										"status"=>"1",
										"message"=>"Internal Server Error 3",
										"Message"=>"Userinfo Missing",
										"Response"=>"FAILED"
									);
				echo json_encode($resp_array);exit;
			}
			
		}
		else
		{
			$resp_array = array(
										"statuscode"=>"ERR",
										"status"=>"1",
										"message"=>"Internal Server Error 4",
										"Message"=>"Userinfo Missing",
										"Response"=>"FAILED"
									);
			echo json_encode($resp_array);exit;
			
		}
	}	
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
					
						$rslt_updtrec = $this->db->query("update tblrecharge set debited='yes',reverted='no',balance=CONCAT_WS(',',balance,?), ewallet_id = CONCAT_WS(',',ewallet_id,?) where recharge_id = ?",array($current_balance,$ewallet_id,$transaction_id));
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
                
                					$rslt_updtrec = $this->db->query("update tblrecharge set debited='yes',reverted='yes',balance=CONCAT_WS(',',balance,?), ewallet_id = CONCAT_WS(',',ewallet_id,?) where recharge_id = ?",array($current_balance,$ewallet_id,$transaction_id));
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
                			$str_query = "insert into  tblewallet(user_id,bill_id,transaction_type,credit_amount,balance,description,add_date,ipaddress,tds,serviceTax,remark)
                
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





















//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//########################################## C O M M I S S I O N     D I S T R I B U T I O N ###########################//


public function getBillpaymentCommission($user_id,$company_id)
	{
		$company_info = $this->db->query("select service_id from tblcompany where company_id = ?",array($company_id));
		if($company_info->num_rows() == 1)
		{
			$service_id = $company_info->row(0)->service_id;
			$userinfo = $this->db->query("select user_id,scheme_id from tblusers where user_id = ?",array($user_id));
			if($userinfo->num_rows() == 1)
			{
				$scheme_id = $userinfo->row(0)->scheme_id;
				$commission_info = $this->db->query("select SdComm,MdComm,DComm,RComm from tblutilitycommission where group_id = ? and service_id = ?",array($scheme_id,$service_id));
				if($commission_info->num_rows() == 1)
				{
					$SdComm = $commission_info->row(0)->SdComm;
					$MdComm = $commission_info->row(0)->MdComm;
					$DComm = $commission_info->row(0)->DComm;
					$RComm = $commission_info->row(0)->RComm;

				}

			}
		}
	}
	private function distcommission($bill_id)
	{
	    //4381 allpayfast commission to superdealer
	   $rsltuser = $this->db->query("
        SELECT 
        a.bill_amount as total, 
        a.add_date,
        a.company_id,
        p.businessname,
        p.user_id,
        p.username,
        p.usertype_name,
        b.host_id
        FROM `tblbills` a 
        left join tblusers b on a.user_id = b.user_id 
        left join tblusers p on  b.parentid = p.user_id 
        where 
        b.usertype_name = 'Agent' and
        a.Id = ? and
        a.status = 'Success'  and
        a.bill_amount < 100000
        order by a.Id",array($bill_id));
    	if($rsltuser->num_rows() == 1)
    	{
    	    $cr_user_id = $rsltuser->row(0)->user_id;
    	    $host_id = $rsltuser->row(0)->host_id;
    	    $transaction_date = $rsltuser->row(0)->add_date;
    	    $company_id = $rsltuser->row(0)->company_id;
    	    $user_id = $rsltuser->row(0)->user_id;

    	    $md_id = 0;
    	    $sd_id = 0;

    	    $dist_info = $this->db->query("select user_id,parentid,scheme_id from tblusers where user_id = ?",array($user_id));
    	    if($dist_info->num_rows() == 1)
    	    {
    	    	$md_id = $dist_info->row(0)->parentid;
    	    	$md_info = $this->db->query("select user_id,parentid,scheme_id from tblusers where user_id = ?",array($md_id));
    	    	if($md_info->num_rows() == 1)
    	    	{
    	    		$sd_id = $md_info->row(0)->parentid;
    	    	}
    	    }

    	    ////default commission values
    	    $DComm = 0.20;
    	    $MdComm = 0.00;
    	    $SdComm = 0.00;


    	    $company_info = $this->db->query("select service_id from tblcompany where company_id = ?",array($company_id));
			if($company_info->num_rows() == 1)
			{
				$service_id = $company_info->row(0)->service_id;
				$userinfo = $this->db->query("select user_id,scheme_id from tblusers where user_id = ?",array($user_id));
				if($userinfo->num_rows() == 1)
				{
					$scheme_id = $userinfo->row(0)->scheme_id;
					$commission_info = $this->db->query("select SdComm,MdComm,DComm,RComm from tblutilitycommission where group_id = ? and service_id = ?",array($scheme_id,$service_id));
					if($commission_info->num_rows() == 1)
					{
						$SdComm = $commission_info->row(0)->SdComm;
						$MdComm = $commission_info->row(0)->MdComm;
						$DComm = $commission_info->row(0)->DComm;
						$RComm = $commission_info->row(0)->RComm;
						$commission_type = $commission_info->row(0)->commission_type;
					}

				}
			}







    	    if($host_id == 4381)
    	    {
    	        $cr_user_id = $rsltuser->row(0)->host_id;
    	    }
    	    
    	    ///////////
    	    ///// DIST COMMISSION
    	    ///////////////////////////////////////////
		    $dr_user_id = 1;
		    if($commission_type == "PER")
		    {
		    	$commamount = (($rsltuser->row(0)->total * $DComm) / 100);	
		    }
		    else
		    {
		    	$commamount = $DComm;		
		    }
		    
		    $tds = 0;
		    $commamount_aftertds = round($commamount - $tds,2);
		    $remark = "BILL PAYMENT COMM.";
		    $description = "Bill Payment Comm.";
		    $payment_type = "CASH";
		    
    		
		    $rsltinsert = $this->db->query("insert into bill_distcommission(add_date,ipaddress,user_id,transaction_date,TotalSuccess,totalcommission,tds,commission_type,commission_given,ewallet_id) 
            		    values(?,?,?,?,?,?,?,?,?,?)",
            		    array($this->common->getDate(),$this->common->getRealIpAddr(),$cr_user_id,$transaction_date, $rsltuser->row(0)->total,$commamount_aftertds,$tds,"BILL","no",""));
		    if($rsltinsert == true)
		    {
		        $amount = $commamount_aftertds;
    		    $remark = "BILL Payment Commission";
    		    $description = "BillComm.Date:".$transaction_date;
    		    $payment_type = "CASH";


				$this->Common_methods->tblewallet_Payment_CrDrEntry($cr_user_id,$dr_user_id,$amount,$remark,$description,$payment_type);
    		    
		        
		    }



		    ///////////
    	    ///// MD COMMISSION
    	    ///////////////////////////////////////////



		    $dr_user_id = 1;
		    if($commission_type == "PER")
		    {
		    	$commamount = (($rsltuser->row(0)->total * $MdComm) / 100);	
		    }
		    else
		    {
		    	$commamount = $DComm;		
		    }
		    
		    $tds = 0;
		    $commamount_aftertds = round($commamount - $tds,2);
		    $remark = "BILL PAYMENT COMM.";
		    $description = "Bill Payment Comm";
		    $payment_type = "CASH";
		    
    		
		    $rsltinsert = $this->db->query("insert into bill_distcommission(add_date,ipaddress,user_id,transaction_date,TotalSuccess,totalcommission,tds,commission_type,commission_given,ewallet_id) 
            		    values(?,?,?,?,?,?,?,?,?,?)",
            		    array($this->common->getDate(),$this->common->getRealIpAddr(),$md_id,$transaction_date, $rsltuser->row(0)->total,$commamount_aftertds,$tds,"BILL","no",""));
		    if($rsltinsert == true)
		    {
		        $amount = $commamount_aftertds;
    		    $remark = "BILL Payment Commission";
    		    $description = "BillComm.Date:".$transaction_date;
    		    $payment_type = "CASH";
    		    $this->Insert_model->tblewallet_Payment_CrDrEntry($md_id,$dr_user_id,$amount,$remark,$description,$payment_type);	
    		    
		    }


		    ///////////
    	    ///// SD COMMISSION
    	    ///////////////////////////////////////////
		    $dr_user_id = 1;
		    if($commission_type == "PER")
		    {
		    	$commamount = (($rsltuser->row(0)->total * $SdComm) / 100);
		    }
		    else
		    {
		    	$commamount = $SdComm;		
		    }

		    
		    $tds = 0;
		    $commamount_aftertds = round($commamount - $tds,2);
		    $remark = "BILL PAYMENT COMM.";
		    $description = "Bill Payment Comm";
		    $payment_type = "CASH";
		    
    		
		    $rsltinsert = $this->db->query("insert into bill_distcommission(add_date,ipaddress,user_id,transaction_date,TotalSuccess,totalcommission,tds,commission_type,commission_given,ewallet_id) 
            		    values(?,?,?,?,?,?,?,?,?,?)",
            		    array($this->common->getDate(),$this->common->getRealIpAddr(),$sd_id,$transaction_date, $rsltuser->row(0)->total,$commamount_aftertds,$tds,"BILL","no",""));
		    if($rsltinsert == true)
		    {
		        $amount = $commamount_aftertds;
    		    $remark = "BILL Payment Commission";
    		    $description = "BillComm.Date:".$transaction_date;
    		    $payment_type = "CASH";

				$this->Insert_model->tblewallet_Payment_CrDrEntry($sd_id,$dr_user_id,$amount,$remark,$description,$payment_type);	
    		    
		        
		    }    
    	}
	}
	
}

?>