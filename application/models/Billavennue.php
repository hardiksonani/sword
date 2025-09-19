<?php
class Billavennue extends CI_Model 
{	
	function _construct()
	{
		  // Call the Model constructor
		  parent::_construct();
	}
	private function getLiveUrl($type)
	{	
		if($type == "balance")
		{
				$url = 'https://api.billavenue.com/billpay/enquireDeposit/fetchDetails/xml';
		}
		
		
		
		return $url;
	}
	private function getKey()
	{
		return "asdf";
	}
	private function getAccessCode()
	{
		return "asdf";
	}
	private function getInstituteId()
	{
		return "asdf";
	}
	private function getVersion()
	{
		return "1.0";
	}
	
	private function getOutletId()
	{
		return 1234;
	}
	
	public function balance()
	{
	
	    $plainText = '<?xml version="1.0" encoding="UTF-8"?><depositDetailsRequest><fromDate>2017-08-22</fromDate><toDate>2017-09-22</toDate><transType>DR</transType><agents><agentId>CC01CC57AGT000000638</agentId></agents></depositDetailsRequest>';
        $key = $this->getKey();
        $encrypt_xml_data = $this->encrypt($plainText, $key);
        
        $data['accessCode'] =$this->getAccessCode();
        $data['requestId'] = $this->generateRandomString();
        $data['encRequest'] = $encrypt_xml_data;
        $data['ver'] = $this->getVersion();
        $data['instituteId'] = $this->getInstituteId();
        
        $parameters = http_build_query($data);
        
        $url = "https://api.billavenue.com/billpay/enquireDeposit/fetchDetails/xml";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $parameters);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        $result = curl_exec($ch);
       // echo $result . "////////////////////";
        $response = $this->decrypt($result, $key);


//echo $plainText."<hr>";

//echo "Request Id :: ".$data['requestId'];
//echo "<hr>";
//print_r($response);exit;

        $xmlresp = simplexml_load_string($response);
        $Wallet = 0;
        if(isset($xmlresp->currentBalance))
        {
            $Wallet =  $xmlresp->currentBalance;exit;
        }
        //print_r($xmlresp);exit;
       // echo "<pre>";
      // echo htmlentities($response);
      //  exit;
		$this->loging("billavennue_balance",$plainText,$buffer,$Wallet,"Admin");
		return $Wallet;
		
	}
	
	
	public function getbillerInfo($billerId)
	{
	
	    $plainText = '<?xml version="1.0" encoding="UTF-8"?><billerInfoRequest><billerId>'.$billerId.'</billerId></billerInfoRequest>';
	     $plainText = '<?xml version="1.0" encoding="UTF-8"?><billerInfoRequest></billerInfoRequest>';
	  echo htmlentities($plainText);
    echo "<br><br>";
        $key = $this->getKey();
        $encrypt_xml_data = $this->encrypt($plainText, $key);
        $requestId = $this->generateRandomString();
        $data['accessCode'] =$this->getAccessCode();
        $data['requestId'] =  $requestId;
        $data['encRequest'] = $encrypt_xml_data;
        $data['ver'] = $this->getVersion();
        $data['instituteId'] = $this->getInstituteId();
        
        $parameters = http_build_query($data);
        
        $url = "https://api.billavenue.com/billpay/extMdmCntrl/mdmRequest/xml";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $parameters);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        $result = curl_exec($ch);
        //echo $result . "////////////////////";
        $response = $this->decrypt($result, $key);
        echo $response;exit;
        $xmlresp = simplexml_load_string($response);
        print_r($xmlresp);exit;
        if(isset($xmlresp->responseCode))
        {
            $biller = $xmlresp->biller; 
            foreach($biller as $billrow)
            {
               $billerId = trim((string)$billrow->billerId);
               $billerName = trim((string)$billrow->billerName);
               $billerCategory = trim((string)$billrow->billerCategory);
               $billerAdhoc = trim((string)$billrow->billerAdhoc);
               $billerCoverage = trim((string)$billrow->billerCoverage);
               $billerFetchRequiremet = trim((string)$billrow->billerFetchRequiremet);
               $billerPaymentExactness = trim((string)$billrow->billerPaymentExactness);
			   
			   $supportPendingStatus = trim((string)$billrow->supportPendingStatus);
			   $supportDeemed = trim((string)$billrow->supportDeemed);

               $billerSupportBillValidation = trim((string)$billrow->billerSupportBillValidation);
               $billerAmountOptions = trim((string)$billrow->billerAmountOptions);
               $billerPaymentModes = trim((string)$billrow->billerPaymentModes);
               $billerDescription = $billrow->billerDescription;
               $rechargeAmountInValidationRequest = trim((string)$billrow->rechargeAmountInValidationRequest);
               $billerInputParams = $billrow->billerInputParams;

               $rsltinsert = $this->db->query("insert into billavennue_operators(billerId,billerName,billerCategory,billerAdhoc,billerCoverage,billerFetchRequiremet,billerPaymentExactness,supportPendingStatus,supportDeemed,billerAmountOptions,billerPaymentModes)
               	values(?,?,?,?,?,?,?,?,?,?,?)",
               	array(
               			$billerId,$billerName,$billerCategory,$billerAdhoc,$billerCoverage,$billerFetchRequiremet,$billerPaymentExactness,
               			$supportPendingStatus,$supportDeemed,$billerAmountOptions,$billerPaymentModes
               		)
               );


//print_r($billerInputParams);exit;

               foreach($billerInputParams->paramInfo as $inpprms)
               {
                   $paramName = trim((string)$inpprms->paramName);
                   $dataType = trim((string)$inpprms->dataType);
                   $isOptional = trim((string)$inpprms->isOptional);
                   $minLength = trim((string)$inpprms->minLength);
                   $maxLength = trim((string)$inpprms->maxLength);
                   $regEx = "";

				if($rsltinsert == true)
				{
						$this->db->query("insert into billavennue_operators_billerInputParams(billerId,paramName,dataType,isOptional,minLength,maxLength,regEx) 
						values(?,?,?,?,?,?,?)",
						array(
							$billerId,$paramName,$dataType,$isOptional,$minLength,$maxLength,$regEx
						));
				}
                   
                   
                   
               }
             
            }
        }
        else
        {
            
        }
        $jsonobj = json_encode($xmlresp);
        
       // echo "<pre>";
       // echo htmlentities($response);
      //  exit;
		$this->loging("billavennue_balance",json_encode($parameters),$buffer,$Wallet,"Admin");
		return $Wallet;
		
	}
	
	
	public function getbillFetch($billerId,$customerMobile,$service_no,$option1,$option2,$userinfo)
	{
   // echo "here";exit;
		error_reporting(E_ALL);
		ini_set("display_errors",1);
		$this->db->db_debug = TRUE;
   
	    $plainText = '<?xml version="1.0" encoding="UTF-8"?>
                        <billFetchRequest>
                            <agentId>CC01CC57AGT000000638</agentId>
                            <agentDeviceInfo>
                                <ip>'.$this->common->getRealIpAddr().'</ip>
                                <initChannel>AGT</initChannel>
                                <mac>01-23-45-67-89-ab</mac>
                            </agentDeviceInfo>
                            <customerInfo>
                                <customerMobile>'.$customerMobile.'</customerMobile>
                                <customerEmail />
                                <customerAdhaar />
                                <customerPan />
                            </customerInfo>
                            <billerId>'.trim($billerId).'</billerId>
                            <inputParams>';


                           $rsltbiller_params = $this->db->query("SELECT * FROM billavennue_operators_billerInputParams where billerId = ? order by listing",array($billerId));
                           foreach($rsltbiller_params->result() as $opr_params)
                           {
                           		if($opr_params->param == "SERVICENO")
                           		{
                           			$plainText.='     
				 								<input>
				                                    <paramName>'.$opr_params->paramName.'</paramName>
				                                    <paramValue>'.$service_no.'</paramValue>
				                                </input>';	
                           		}
                           		else if($opr_params->param == "OPTION1")
                           		{
                           			$plainText.='     
				 								<input>
				                                    <paramName>'.$opr_params->paramName.'</paramName>
				                                    <paramValue>'.$option1.'</paramValue>
				                                </input>';	
                           		}
                           		else if($opr_params->param == "MOBILE")
                           		{
                           			$plainText.='     
				 								<input>
				                                    <paramName>'.$opr_params->paramName.'</paramName>
				                                    <paramValue>'.$customerMobile.'</paramValue>
				                                </input>';	
                           		}
 								
                           }

                        
                                
                            $plainText.='</inputParams>
                        </billFetchRequest>';
        //echo htmlentities($plainText) ;exit;                
        $key = $this->getKey();
        $encrypt_xml_data = $this->encrypt($plainText, $key);
        
        $data['accessCode'] =$this->getAccessCode();
        $requestId = $this->generateRandomString();
        $data['requestId'] = $requestId;
        $data['encRequest'] = $encrypt_xml_data;
        $data['ver'] = $this->getVersion();
        $data['instituteId'] = $this->getInstituteId();
        
        $parameters = http_build_query($data);
        
        $url = "https://api.billavenue.com/billpay/extBillCntrl/billFetchRequest/xml";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $parameters);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        $result = curl_exec($ch);




//echo $plainText."<hr>";

//echo "Request Id :: ".$data['requestId'];
//echo "<hr>";


       // echo $result . "////////////////////";
        $response = $this->decrypt($result, $key);

//echo  $response;exit;       
        $xmlresp = ((array)simplexml_load_string($response));
       //	print_r($xmlresp);exit;
/*
Array ( [responseCode] => 001 [errorInfo] => SimpleXMLElement Object ( [error] => SimpleXMLElement Object ( [errorCode] => E135 [errorMessage] => Mandatory Input Parameter Not Present or mismatch ) ) )


Array ( [responseCode] => 001 [errorInfo] => SimpleXMLElement Object ( [error] => SimpleXMLElement Object ( [errorCode] => BFR004 [errorMessage] => Payment received for the billing period - no bill due ) ) )



{"statuscode":"TXN","status":"Transaction Successful","data":{"dueamount":"122.00","duedate":"16-10-2019","customername":"SAJID BEGAM","billnumber":"201910721900935721","billdate":"01-01-0001","billperiod":"NA","billdetails":[],"customerparamsdetails":[{"Name":"Consumer Number","Value":"721900935721"}],"additionaldetails":[],"reference_id":1226061}}

{"statuscode":"ERR","status":"Unable to get bill details from biller","data":""}



<?xml version="1.0" encoding="UTF-8" standalone="yes"?>
<billFetchResponse>
<responseCode>000</responseCode>
<inputParams>
<input>
  <paramName>Loan Account Number</paramName>
  <paramValue>95HRCDFL182029</paramValue>
</input>
</inputParams>
<billerResponse>
    <billAmount>169000</billAmount>
    <customerName>RINKU KAUR</customerName>
</billerResponse>
<additionalInfo>
  <info>
    <infoName>Installment Overdue</infoName>
    <infoValue>332000</infoValue>
  </info>
  <info>
  <infoName>Penal Overdue</infoName>
  <infoValue>0</infoValue></info>
</additionalInfo>
</billFetchResponse>
*/


        if(isset($xmlresp["responseCode"]))
        {
        	$responseCode = $xmlresp["responseCode"];
        	if(trim($responseCode) == "000")
        	{
            
            $billAmount = "0";
            $billDate = "";
            $billNumber = "";
            $billPeriod = "";
        		$customerName = "";
            $dueDate = "";


            if(isset($xmlresp["billerResponse"]))
            {
            
              $billerResponse = (array)$xmlresp["billerResponse"];
              if(isset($billerResponse["billAmount"]))
              {
                  $billAmount = $billerResponse["billAmount"];
              }
              if(isset($billerResponse["billDate"]))
              {
                  $billDate = $billerResponse["billDate"];
              }
              if(isset($billerResponse["billNumber"]))
              {
                  $billNumber = $billerResponse["billNumber"];
              }
              if(isset($billerResponse["billPeriod"]))
              {
                  $billPeriod = $billerResponse["billPeriod"];
              }
              if(isset($billerResponse["customerName"]))
              {
                  $customerName = $billerResponse["customerName"];
              }
              if(isset($billerResponse["dueDate"]))
              {
                  $dueDate = $billerResponse["dueDate"];
              }
            }
            

        		$add_date = $this->common->getDate();
        		$ipaddress = $this->common->getRealIpAddr();
        		$customer_mobile = $customerMobile;
        		$user_id = $userinfo->row(0)->user_id;
    				$company_id = 0;
    				$response_message = "BILL FETCH SUCCESSFUL";
        		
        		$billfetch_insertion = $this->db->query("insert into tblbillcheck(add_date,ipaddress,service_no,option1,option2,customer_mobile,user_id,company_id,billerId,customer_name,billAmount,billDate,billNumber,billPeriod,dueDate,responseCode,response_message,RefId) 
        			values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)",
        			array($add_date,$ipaddress,$service_no,$option1,$option2,$customer_mobile,$user_id,$company_id,$billerId,$customerName,($billAmount/100),$billDate,$billNumber,$billPeriod,$dueDate,$responseCode,$response_message,$requestId));
        		$insert_id = $this->db->insert_id();



        		if(isset($xmlresp["additionalInfo"]))
        		{
        			$additionalInfo = (array)$xmlresp["additionalInfo"];
        			$info = $additionalInfo["info"];
        			foreach($info as $info_row)
        			{
        				$infoName =  $info_row->infoName;
        				$infoValue =  $info_row->infoValue;


        				$this->db->query("insert into tblbillcheck_additionalInfo(billcheck_id,infoName,infoValue) values(?,?,?)",array($insert_id,$infoName,$infoValue));

        			}
        		}











        		$resparray = array(
        			"statuscode"=>"TXN",
        			"status"=>"0",
        			"message"=>"BILL FETCH SUCCESSFUL",
        			"particulars"=>array(
        							"dueamount"=>($billAmount/100),
        							"duedate"=>$dueDate,
        							"customername"=>$customerName,
        							"billnumber"=>$billNumber,
        							"billdate"=>$billDate,
        							"billperiod"=>$billPeriod,
        							"reference_id"=>$insert_id
        						)
        		);

        		echo json_encode($resparray);exit;
        	}
        	else if(trim($responseCode) == "001")
        	{
        		$errorInfo = $xmlresp["errorInfo"];
        		$error = ((array)$errorInfo->error);
        		$errorCode = $error["errorCode"];
        		$errorMessage = $error["errorMessage"];

        		$resparray = array(
        			"statuscode"=>"ERR",
        			"status"=>1,
        			"message"=>$errorMessage
        		);
        		echo json_encode($resparray);exit;

        	}
        }
exit;

       //print_r($xmlresp);exit;
       // echo "<pre>";
       // echo htmlentities($response);
      //  exit;
		$this->loging("billavennue_billfetch",json_encode($parameters),$buffer,$Wallet,"Admin");
		return $Wallet;
		
	}
	
	public function bill_checkduplicate($user_id,$service_no,$amount)
	{
		//echo $user_id."   ".$service_no."   ".$amount;exit;
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
	public function billpay($userinfo,$billerId,$Amount,$Mobile,$CustomerMobile,$remark,$RefId,$option1,$option2="",$option3="",$done_by = "WEB")
	{
		$url=""; 
		$buffer = "";
		$json_resp = "";
	   error_reporting(-1);
		ini_set('display_errors', 1);
		$this->db->db_debug = TRUE;
	  		
        	if(true)
        	{
        	 
        	    $rsltcheck = $this->db->query("SELECT Id FROM `tblbills`  where service_no = ? and user_id = ? and status != 'Failure' and Date(add_date) = ?
ORDER BY `tblbills`.`Id`  DESC",array($Mobile,$userinfo->row(0)->user_id,$this->common->getMySqlDate()));
        	    if(false)
                //if($rsltcheck->num_rows() == 1)
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
                	
                  	$Amount = intval($Amount);
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
            						
            						/*
            						
            		{"statuscode":"TXN","status":"Transaction Successful","data":{"dueamount":"140.00","duedate":"04-02-2019","customername":"NISHAT","billnumber":"055440619012212","billdate":"22-01-2019","billperiod":"NA","billdetails":[],"customerparamsdetails":[{"Name":"CA Number","Value":"103761766"}],"additionaldetails":[],"reference_id":46731}}
            		*/
            						$crntBalance = $this->Common_methods->getAgentBalance($user_id);
            						//f($this->bill_checkduplicate($userinfo->row(0)->user_id,$Mobile,$Amount) == false)
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
            						
            						else if(trim($crntBalance) >= trim($Amount))
            						{
            						    
            								$dueamount = "";
            								$duedate = "";
            								$billnumber = "";
            								$billdate = "";
            								$billperiod = "";
            								$custname = "";
            							$billfetch_insertion = $this->db->query("select RefId,Id,add_date,ipaddress,service_no,option1,option2,customer_mobile,user_id,company_id,billerId,customer_name,billAmount,billDate,billNumber,billPeriod,dueDate,responseCode,response_message from tblbillcheck where Id = ? ",array($RefId));

            							if($billfetch_insertion->num_rows() == 1)
            							{
            								$custname = $billfetch_insertion->row(0)->customer_name;

            								$dueamount = $billfetch_insertion->row(0)->billAmount;
            								$duedate = $billfetch_insertion->row(0)->dueDate;
            								$billnumber = $billfetch_insertion->row(0)->billNumber;
            								$billdate = $billfetch_insertion->row(0)->billDate;
            								$billperiod = $billfetch_insertion->row(0)->billPeriod;
            								$insta_ref = $billfetch_insertion->row(0)->RefId;
            							}
            							
            							$insert_rslt = $this->db->query("insert into tblbills(add_date,ipaddress,user_id,service_no,customer_mobile,company_id,bill_amount,paymentmode,payment_channel,status,customer_name,dueamount,duedate,billnumber,billdate,billperiod,option1,done_by)
            							values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)",
            							array($this->common->getDate(),$ipaddress,$user_id,$Mobile,$CustomerMobile,0,$Amount,$payment_mode,$payment_channel,"Pending",$custname,$dueamount,$duedate,$billnumber,$billdate,$billperiod,$option1,$done_by));
            							if($insert_rslt == true)
            							{
            								
            								$insert_id = $this->db->insert_id();
            								
            								$transaction_type = "BILL";
            								
            								if($Amount >= 100000)
            								{
	                                            $Charge_Amount =0.0;
            								}
            								else
            								{
            								    $Charge_Amount = (($Amount * 0.50)/100);
            								}
            								
            							
            								$dr_amount = $Amount - $Charge_Amount;
            								$Description = "Service No.  ".$Mobile." Bill Amount : ".$Amount;
            								$sub_txn_type = "BILL";
            								$remark = "Bill PAYMENT";
            								$Charge_Amount = $Charge_Amount;
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

$plainText = '<?xml version="1.0" encoding="UTF-8"?>
<billPaymentRequest>
	<agentId>CC01CC57AGT000000638</agentId>
	<billerAdhoc>false</billerAdhoc>
	<agentDeviceInfo>
        <ip>'.$this->common->getRealIpAddr().'</ip>
        <initChannel>AGT</initChannel>
        <mac>01-23-45-67-89-ab</mac>
    </agentDeviceInfo>
    <customerInfo>
        <customerMobile>'.$CustomerMobile.'</customerMobile>
        <customerEmail />
        <customerAdhaar />
        <customerPan />
    </customerInfo>
	<billerId>'.trim($billerId).'</billerId>
	<inputParams>';
		$rsltbiller_params = $this->db->query("SELECT * FROM billavennue_operators_billerInputParams where billerId = ? order by listing",array($billerId));
       foreach($rsltbiller_params->result() as $opr_params)
       {
       		if($opr_params->param == "SERVICENO")
       		{
       			$plainText.='     
								<input>
                                <paramName>'.$opr_params->paramName.'</paramName>
                                <paramValue>'.$Mobile.'</paramValue>
                            </input>';	
       		}
       		else if($opr_params->param == "OPTION1")
       		{
       			$plainText.='     
								<input>
                                <paramName>'.$opr_params->paramName.'</paramName>
                                <paramValue>'.$option1.'</paramValue>
                            </input>';	
       		}
       		else if($opr_params->param == "MOBILE")
       		{
       			$plainText.='     
								<input>
                                <paramName>'.$opr_params->paramName.'</paramName>
                                <paramValue>'.$CustomerMobile.'</paramValue>
                            </input>';	
       		}
				
       }
	$plainText .= '</inputParams>';
	
	if($billfetch_insertion->num_rows() == 1)
	{
		$plainText .= '<billerResponse>
							<billAmount>'.($billfetch_insertion->row(0)->billAmount*100).'</billAmount>
							<billDate>'.$billfetch_insertion->row(0)->billDate.'</billDate>
							<billNumber>'.$billfetch_insertion->row(0)->billNumber.'</billNumber>
							<billPeriod>'.$billfetch_insertion->row(0)->billPeriod.'</billPeriod>
							<customerName>'.$billfetch_insertion->row(0)->customer_name.'</customerName>
							<dueDate>'.$billfetch_insertion->row(0)->dueDate.'</dueDate>
						</billerResponse>';
	}


	$plainText.= '
			<additionalInfo>';
			$additionalInfo_rslt = $this->db->query("select * from tblbillcheck_additionalInfo where billcheck_id = ?",array($RefId));
			if($additionalInfo_rslt->num_rows() >= 1)
			{
				foreach($additionalInfo_rslt->result() as $rwaddinfo)
				{
					$plainText .= '<info>
							    <infoName>'.$rwaddinfo->infoName.'</infoName>
							    <infoValue>'.$rwaddinfo->infoValue.'</infoValue>
							  </info>';		
				}
				
			}
			  
			 
	$plainText.= '</additionalInfo>';
	
	$plainText .='
		<amountInfo>
			<amount>'.($billfetch_insertion->row(0)->billAmount*100).'</amount>
			<currency>356</currency>
			<custConvFee>0</custConvFee>
			<amountTags>
			<amountTag>Additional Charges</amountTag>
			<value>0</value>
			</amountTags>
		</amountInfo>
	';


	$plainText .= '<paymentMethod>
		<paymentMode>Cash</paymentMode>
		<quickPay>N</quickPay>
		<splitPay>N</splitPay>
	</paymentMethod>
	<paymentInfo>
		<info>
		<infoName>Remarks</infoName>
		<infoValue>Received</infoValue>
		</info>
	</paymentInfo>
</billPaymentRequest>';
            				

$key = $this->getKey();
        $encrypt_xml_data = $this->encrypt($plainText, $key);
        //echo $billfetch_insertion->row(0)->RefId;exit;
        $data['accessCode'] =$this->getAccessCode();
        $data['requestId'] = $billfetch_insertion->row(0)->RefId;
        $data['encRequest'] = $encrypt_xml_data;
        $data['ver'] = $this->getVersion();
        $data['instituteId'] = $this->getInstituteId();
        
        $parameters = http_build_query($data);
        
        $url = "https://api.billavenue.com/billpay/extBillPayCntrl/billPayRequest/xml";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $parameters);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        $result = curl_exec($ch);




echo $plainText."<hr>";

//echo "Request Id :: ".$data['requestId'];
//echo "<hr>";


       // echo $result . "////////////////////";
        $response = $this->decrypt($result, $key);
/*
<extbillpayresponse>
<responsecode>000</responsecode>
<responsereason>Successful</responsereason>
<txnrefid>CC01ABN45245</txnrefid>
<approvalrefnumber>AB123456</approvalrefnumber>
<txnresptype>FORWARD TYPE RESPONSE</txnresptype>
<inputparams>
<input>
<paramname>Loan Account Number</paramname>
<paramvalue>95HRCDFL182029</paramvalue>
</inputparams>
<respamount>169000</respamount>
<respcustomername>RINKU KAUR</respcustomername>

</extbillpayresponse>
*/
echo  $response;exit; 
           























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
            							else
            							{
            								$resp_arr = array(
	            									"message"=>"Database Error",
	            									"status"=>1,
	            									"statuscode"=>"ISB",
	            								);
	            							$json_resp =  json_encode($resp_arr);
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
        		$this->loging("RECHARGE",$url,$buffer,$json_resp,$userinfo->row(0)->username);
        		return $json_resp;   
        	}    
	    
	    
		
	}
	
	public function gethoursbetweentwodates($fromdate,$todate)
	{
		 $now_date = strtotime (date ($todate)); // the current date 
		$key_date = strtotime (date ($fromdate));
		$diff = $now_date - $key_date;
		return round(abs($diff) / 60,2);
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
//////// bill payments api
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
	public function serviceproviders($userinfo,$spkey)
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
							$postparam = '{"token": "'.$this->getToken().'","request": {"mobile": "'.$mobile_no.'"}}';
		
							$headers = array();
							$headers[] = 'Accept: application/json';
							$headers[] = 'Content-Type: application/json';
							
							$url = 'https://www.instantpay.in/ws/api/serviceproviders?token='.$this->getToken().'&spkey='.$spkey.'&format=json';
							$ch = curl_init();
							curl_setopt($ch,CURLOPT_URL,$url);
							curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
							curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
							curl_setopt($ch, CURLOPT_POST,0);
							curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
							curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
							$buffer = curl_exec($ch);
							curl_close($ch);
							
							echo $buffer;exit;
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
											$remitter = $data->remitter;
											$beneficiary = $data->beneficiary;
											
											
											if(isset($remitter->name) and isset($remitter->mobile) and isset($remitter->pincode) and isset($remitter->id))
											{
												$name = trim((string)$remitter->name);
												$mobile = trim((string)$remitter->mobile);
												$pincode = trim((string)$remitter->pincode);
												$remiterid = trim((string)$remitter->id);
												$checkremitter = $this->db->query("select * from mt3_remitter_registration where remitter_id = ? and status = 'SUCCESS'",array(trim($remiterid)));
												if($checkremitter->num_rows() == 0)
												{
													$this->db->query("insert into mt3_remitter_registration(user_id,add_date,mobile,name,pincode,status,remitter_id) values(?,?,?,?,?,?,?)",array($user_id,$this->common->getDate(),$mobile_no,$name,$pincode,"SUCCESS",$remiterid));
												}
											}
											
											
											
											$resp_arr = array(
																"message"=>$status,
																"status"=>0,
																"statuscode"=>$statuscode,
																"remitter"=>$remitter,
																"beneficiary"=>$beneficiary
															);
											$json_resp =  json_encode($resp_arr);
										}
										else if(isset($data->remitter))
										{
											$remitter = $data->remitter;
											$resp_arr = array(
																"message"=>$status,
																"status"=>0,
																"statuscode"=>$statuscode,
																"remitter"=>$remitter,
																"beneficiary"=>""
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
	public function recharge_transaction($userinfo,$spkey,$company_id,$Amount,$Mobile,$CustomerMobile,$remark,$option1,$option2="",$option3="",$payment_mode = "CASH",$payment_channel = "AGT",$custname="",$particulars = false)
	{
		$Amount = intval($Amount);
		$ipaddress = $this->common->getRealIpAddr();
		$payment_mode = "CASH";
		$payment_channel = "AGT";
		
		if($spkey == "TPE")
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
						$crntBalance = $this->Ew2->getAgentBalance($user_id);
						if(floatval($crntBalance) >= floatval($Amount))
						{
								$dueamount = "";
								$duedate = "";
								$billnumber = "";
								$billdate = "";
								$billperiod = "";
							if($particulars != false)
							{
								$custname = $particulars->customername;
								$dueamount = $particulars->dueamount;
								$duedate = $particulars->duedate;
								$billnumber = $particulars->billnumber;
								$billdate = $particulars->billdate;
								$billperiod = $particulars->billperiod;
							}
							
							$insert_rslt = $this->db->query("insert into tblbills(add_date,ipaddress,user_id,service_no,customer_mobile,company_id,bill_amount,paymentmode,payment_channel,status,customer_name,dueamount,duedate,billnumber,billdate,billperiod,option1) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)",array($this->common->getDate(),$ipaddress,$user_id,$Mobile,$CustomerMobile,$company_id,$Amount,$payment_mode,$payment_channel,"Pending",$custname,$dueamount,$duedate,$billnumber,$billdate,$billperiod,$option1));
							if($insert_rslt == true)
							{
								$insert_id = $this->db->insert_id();
								$transaction_type = "BILL";
								$dr_amount = $Amount;
								$Description = "Service No.  ".$Mobile." Bill Amount : ".$Amount;
								$sub_txn_type = "BILL";
								$remark = "Bill PAYMENT";
								$Charge_Amount = 0.00;
								$paymentdebited = $this->PAYMENT_DEBIT_ENTRY($user_id,$insert_id,$transaction_type,$dr_amount,$Description,$sub_txn_type,$remark,$Charge_Amount,$userinfo);
								if($paymentdebited == true)
								{
									$headers = array();
									$headers[] = 'Accept: application/json';
									$headers[] = 'Content-Type: application/json';

									$url = 'https://www.instantpay.in/ws/api/transaction?format=json&token='.$this->getToken().'&spkey='.$spkey.'&agentid='.$insert_id.'&amount='.$Amount.'&account='.$Mobile.'&optional1='.$option1.'&optional2='.$option2.'&optional3='.$option3.'&optional4=&optional5=&optional6=&optional7=&optional8='.rawurlencode($remark).'&optional9=23.6036,72.9639|383001&outletid='.$this->getOutletId().'&endpointip='.$ipaddress.'&customermobile='.$CustomerMobile.'&paymentmode='.$payment_mode.'&paymentchannel='.$payment_channel;

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
											
										if($status == "SUCCESS")
										{
											$this->db->query("update tblbills set status = 'Success',ipay_id = ?,opr_id=?,trans_amt=?,charged_amt=?,opening_bal=?,datetime=?,resp_status=?,res_code=?,res_msg=? where Id = ?",array($ipay_id,$opr_id,$trans_amt,$charged_amt,$opening_bal,$datetime,$status,$res_code,$res_msg,$insert_id));
											
										}
										else
										{
											$this->db->query("update tblbills set ipay_id = ?,opr_id=?,trans_amt=?,charged_amt=?,opening_bal=?,datetime=?,resp_status=?,res_code=?,res_msg=? where Id = ?",array($ipay_id,$opr_id,$trans_amt,$charged_amt,$opening_bal,$datetime,$status,$res_code,$res_msg,$insert_id));
											
										}
										
											
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
		$this->loging("RECHARGE",$url,$buffer,$json_resp,$userinfo->row(0)->username);
		return $json_resp;
		
	}
	
	
	public function recharge_transaction_validate($userinfo,$spkey,$company_id,$Amount,$Mobile,$CustomerMobile,$option1 = "")
	{
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

									
									
									$url = 'https://www.instantpay.in/ws/api/transaction?format=json&token='.$this->getToken().'&agentid='.$insert_id.'&amount=10&spkey='.$spkey.'&account='.$Mobile.'&mode=VALIDATE&optional1='.$option1.'&optional2=&optional3=&optional4=&optional5=&optional6=&optional7=&optional8=billcheck&optional9=23.6036,72.9639|383001&outletid='.$this->getOutletId().'&endpointip='.$this->common->getRealIpAddr().'&customermobile='.$CustomerMobile.'&paymentmode='.$payment_mode.'&paymentchannel='.$payment_channel;
									
									

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
								//echo $buffer;exit;
									$json_obj = json_decode($buffer);
								//print_r($json_obj);exit;
									if(isset($json_obj->ipay_errorcode) and isset($json_obj->ipay_errordesc))
									{
											$ipay_errorcode = $json_obj->ipay_errorcode;
											$ipay_errordesc = $json_obj->ipay_errordesc;
											if($ipay_errorcode == "IRA")
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
																			"statuscode"=>$ipay_errorcode,
																			"particulars" => $particulars,
																			"ENCRDATA"=>$this->Common_methods->encrypt($buffer)
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
	
	
	
	
	public function recharge_transaction_postpaid($userinfo,$spkey,$company_id,$Amount,$Mobile,$recharge_id)
	{
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
	
	public function PAYMENT_DEBIT_ENTRY($user_id,$transaction_id,$transaction_type,$dr_amount,$Description,$sub_txn_type,$remark,$chargeAmount = 0.00,$userinfo = false)
	{
		
		if(false)
		{
			
			$this->load->library("common");
			$add_date = $this->common->getDate();
			$date = $this->common->getMySqlDate();
			$ip = $this->common->getRealIpAddr();
			$old_balance = $this->Common_methods->getAgentBalance($user_id);
			$current_balance = $old_balance - $dr_amount;
			
			$tds = 0.00;
			$stax = 0.00;
			if($transaction_type == "BILL")
			{
				$str_query = "insert into  tblewallet(user_id,bill_id,transaction_type,debit_amount,balance,description,add_date,ipaddress,tds,serviceTax,remark)

				values(?,?,?,?,?,?,?,?,?,?,?)";
				$reslut = $this->db->query($str_query,array($user_id,$transaction_id,$transaction_type,$dr_amount,$current_balance,$Description,$add_date,$ip,$tds,$stax,$remark));
				
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
		else
		{
			return true;
		}	
	}
	
	public function PAYMENT_CREDIT_ENTRY($user_id,$transaction_id,$transaction_type,$dr_amount,$Description,$sub_txn_type,$remark,$chargeAmount = 0.00,$userinfo = false)
	{
		$Description = "Refund :".$Description;
		$this->load->library("common");
		$add_date = $this->common->getDate();
		$date = $this->common->getMySqlDate();
		$ip = $this->common->getRealIpAddr();
		$old_balance = $this->Ew2->getAgentBalance($user_id);
		$current_balance = $old_balance + $dr_amount;
		$tds = 0.00;
		$stax = 0.00;
		if($transaction_type == "DMR")
		{
			$remark = "Money Remittance Reverse";
			$str_query = "insert into  tblewallet2(user_id,dmr_id,transaction_type,credit_amount,balance,description,add_date,ipaddress,tds,serviceTax,remark)

			values(?,?,?,?,?,?,?,?,?,?,?)";
			$reslut = $this->db->query($str_query,array($user_id,$transaction_id,$transaction_type,$dr_amount,$current_balance,$Description,$add_date,$ip,$tds,$stax,$remark));
			if($reslut == true)
			{
					$ewallet_id = $this->db->insert_id();
					if($ewallet_id > 100)
					{
						if($sub_txn_type == "Account_Validation")
						{
									$rslt_updtrec = $this->db->query("update mt3_account_validate set reverted='yes',balance=CONCAT_WS(',',balance,?), ewallet_id = CONCAT_WS(',',ewallet_id,?),credit_amount = ? where Id = ?",array($current_balance,$ewallet_id,$dr_amount,$transaction_id));
									return true;
						}
						else if($sub_txn_type == "REMITTANCE")
						{
									$current_balance2 = $current_balance + $chargeAmount;
									$remark = "Transaction Charge Reverse";
									$str_query_charge = "insert into  tblewallet2(user_id,dmr_id,transaction_type,credit_amount,balance,description,add_date,ipaddress,tds,serviceTax,remark)

									values(?,?,?,?,?,?,?,?,?,?,?)";
									$reslut2 = $this->db->query($str_query_charge,array($user_id,$transaction_id,$transaction_type,$chargeAmount,$current_balance2,$Description,$add_date,$ip,$tds,$stax,$remark));
									if($reslut2 == true)
									{
										$totaldebit_amount = $dr_amount + $chargeAmount;
										$ewallet_id2 = $ewallet_id.",".$this->db->insert_id();
										$rslt_updtrec = $this->db->query("update mt3_transfer set reverted='yes',balance=CONCAT_WS(',',balance,?), ewallet_id = CONCAT_WS(',',ewallet_id,?),credit_amount = ? where Id = ?",array($current_balance2,$ewallet_id2,$totaldebit_amount,$transaction_id));	
										
										
										///////////////////////////////////////////////////////////////////
										///////// TRANSACTION CHARGE OR COMMISSION ENTRY FOR DISTRIBUTOR
										////////////////////////////////////////////////////////////////

										if($userinfo->row(0)->usertype_name == 'Agent')
										{
											$dmrinfo = $this->db->query("
											select 
												a.Id,
												a.user_id,
												a.DId,
												a.MdId,
												a.dist_charge_type,
												a.dist_charge_value,
												a.dist_charge_amount,
												a.Amount,
												a.AccountNumber,
												a.IFSC from mt3_transfer a
												where a.Id = ?
											",array($transaction_id));
											if($dmrinfo->num_rows() == 1)
											{
												$DId = $dmrinfo->row(0)->DId;
												$dist_charge_type = $dmrinfo->row(0)->dist_charge_type;
												$dist_charge_value = $dmrinfo->row(0)->dist_charge_value;
												$dist_charge_amount = $dmrinfo->row(0)->dist_charge_amount;

												$dist_old_balance = $this->Ew2->getAgentBalance($DId);
												$dist_current_balance = $dist_old_balance + $dist_charge_amount;
												$dist_remark = "Revert Transaction Charge Done By :".$userinfo->row(0)->businessname."[".$userinfo->row(0)->username."]";
												if($dist_charge_amount != 0)
												{
													$str_query_charge = "insert into  tblewallet2(user_id,dmr_id,transaction_type,credit_amount,balance,description,add_date,ipaddress,tds,serviceTax,remark)

													values(?,?,?,?,?,?,?,?,?,?,?)";
													$reslut2 = $this->db->query($str_query_charge,array($DId,$transaction_id,$transaction_type,$dist_charge_amount,$dist_current_balance,$Description,$add_date,$ip,$tds,$stax,$dist_remark));
												}
												



											}
										}
										
										
										
										return true;
									}
									else
									{
										$rslt_updtrec = $this->db->query("update mt3_transfer set reverted='yes',balance=CONCAT_WS(',',balance,?), ewallet_id = CONCAT_WS(',',ewallet_id,?),_amount = ? where Id = ?",array($current_balance,$ewallet_id,$dr_amount,$transaction_id));	
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
			$str_query = "insert into  tblewallet2(user_id,bill_id,transaction_type,credit_amount,balance,description,add_date,ipaddress,tds,serviceTax,remark)

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
				0 as dist_charge_type,
				0 as dist_charge_value 
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
////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////
//*********** Encryption Function *********************
public function encrypt($plainText, $key) {
    $secretKey = $this->hextobin(md5($key));
    $initVector = pack("C*", 0x00, 0x01, 0x02, 0x03, 0x04, 0x05, 0x06, 0x07, 0x08, 0x09, 0x0a, 0x0b, 0x0c, 0x0d, 0x0e, 0x0f);
    $openMode = openssl_encrypt($plainText, 'AES-128-CBC', $secretKey, OPENSSL_RAW_DATA, $initVector);
    $encryptedText = bin2hex($openMode);
    return $encryptedText;
}

//*********** Decryption Function *********************
public function decrypt($encryptedText, $key) {
    $key = $this->hextobin(md5($key));
    $initVector = pack("C*", 0x00, 0x01, 0x02, 0x03, 0x04, 0x05, 0x06, 0x07, 0x08, 0x09, 0x0a, 0x0b, 0x0c, 0x0d, 0x0e, 0x0f);
    $encryptedText = $this->hextobin($encryptedText);
    $decryptedText = openssl_decrypt($encryptedText, 'AES-128-CBC', $key, OPENSSL_RAW_DATA, $initVector);
    return $decryptedText;
}

//*********** Padding Function *********************
public function pkcs5_pad($plainText, $blockSize) {
    $pad = $blockSize - (strlen($plainText) % $blockSize);
    return $plainText . str_repeat(chr($pad), $pad);
}

//********** Hexadecimal to Binary function for php 4.0 version ********
public function hextobin($hexString) {
    $length = strlen($hexString);
    $binString = "";
    $count = 0;
    while ($count < $length) {
        $subString = substr($hexString, $count, 2);
        $packedString = pack("H*", $subString);
        if ($count == 0) {
            $binString = $packedString;
        } else {
            $binString .= $packedString;
        }

        $count += 2;
    }
    return $binString;
}

//********** To generate ramdom String ********
public function generateRandomString($length = 35) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
	
}

?>