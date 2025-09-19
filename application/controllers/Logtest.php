<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Logtest extends CI_Controller { 
    private $msg='';
	function __construct()
    {
        parent:: __construct();
        $this->clear_cache();
		 error_reporting(E_ALL);
ini_set('display_errors', 1);
    }
    function clear_cache()
    {
         header('Expires: Sat, 26 Jul 1997 05:00:00 GMT');
        header('Cache-Control: no-cache, no-store, must-revalidate, max-age=0');
        header('Cache-Control: post-check=0, pre-check=0', FALSE);
        header('Pragma: no-cache');


        error_reporting(-1);
        ini_set('display_errors',1);
        $this->db->db_debug = TRUE;
    }
    public function checkoffer($Mobile,$code,$Amount,$offer_per = false,$check_api_test = false)
	{
	//echo $code;exit;
	if($code == "RA")
	{
		$code = "2";
	}
	if($code == "RV")
	{
		$code = "23";
	}
	if($code == "RI")
	{
		$code = "6";
	}

	$flag = false;
	$url = 'http://planapi.in/api/Mobile/RofferCheck?apimember_id=3014&api_password=549079&mobile_no='.$Mobile.'&operator_code='.$code;
	//echo $url;exit;
	 	$response = $this->common->callurl($url);
	 	if($check_api_test == true)
	 	{
	 		// echo $response;
	 		// echo "<hr>";
	 	}
	 	//echo $response;exit;
	 	$jsonobj = json_decode($response);
	 	if(isset($jsonobj->ERROR) and isset($jsonobj->STATUS))
	 	{
	 		$ERROR = trim($jsonobj->ERROR);
	 		$STATUS = trim($jsonobj->STATUS);
	 		if($STATUS == "1")
	 		{
	 			if($check_api_test == true)
			 	{
			 		
			 		//echo "here";
			 	}
	 			if(isset($jsonobj->RDATA))
	 			{
	 				$RDATA = $jsonobj->RDATA;
	 				//print_r($RDATA);exit;
	 				foreach($RDATA  as $rw)
	 				{
	 					//echo "statrt<br>";
	 					
	 					if(isset($rw->price) and isset($rw->price))
		 				{
		 					$price =  intval($rw->price);
		 					if($price == $Amount)
		 					{
		 						//echo "amount found<br>";
		 						$commissionUnit =  $rw->commissionUnit;
			 					$ofrtext =  $rw->ofrtext;
			 					$logdesc =  $rw->logdesc;
								$comm_ext = 0;
			 					if (preg_match("/Comm:/",$logdesc)  == 1)
			 					{
			 						$comm_ext = explode("Comm:",$logdesc)[1];
			 						$comm_ext = str_replace("%", "", $comm_ext);
			 					}
			 					//echo $comm_ext ;exit;
			 					$commissionAmount =  floatval($comm_ext);
			 					$offer_percentage = (($commissionAmount * 100)/$Amount);
			 					$validity = "";
			 					if(isset($rw->validity))
			 					{
			 						$validity =  $rw->validity;	
			 					}


			 					if($commissionAmount > 0)
		 						{

		 							if($offer_per == false)
		 							{
		 								$flag =  true;
		 								break;	
		 							}
		 							else
		 							{
		 								if($offer_percentage >= $offer_per)
		 								{
		 									$flag =  true;
		 									break;	
		 								}
		 							}
		 							
		 						}
		 					}	
		 				}	
		 				//echo "end<br>";
	 				}
	 				
	 			}
	 		}
	 	}
	 	//echo "final flag";
	 	//var_dump( $flag);
	return $flag;
}
    public function getcommission()
    {
    	
    	$Mobile = $this->input->get("mobile");
    	$code = $this->input->get("code");
    	$Amount = $this->input->get("amount");


    	
    	$resp = $this->checkoffer($Mobile,$code,$Amount);
    	var_dump($resp);exit;


    	
    }
    public function databaseinsertion()
    {}
 	public function addretailer()
    {}

     public function recharge_tets()
    {


    	//http://otmpay.co.in/logtest/recharge_tets?company_id=12&Amount=10&Mobile=8238232303&order_id=101
    	$user_info = $this->db->query("select * from tblusers where usertype_name = 'Agent' order by user_id limit 1");

    	$circle_code = "*";
    	$company_id = 12;
    	$Amount = 10;
    	$Mobile = 8238232303;
    	$recharge_type = "Mobile";
    	$service_id = 1;
    	$rechargeBy = "API";
    	$order_id = "123";
    	$is_check_api = true;

    	if(isset($_GET["company_id"]) and isset($_GET["Amount"]) and isset($_GET["Mobile"]) and isset($_GET["order_id"]) )
    	{
    		$company_id = intval($this->input->get("company_id"));
    		$Amount = intval($this->input->get("Amount"));
    		$Mobile = substr($this->input->get("Mobile"),0,10);
    		$order_id = substr($this->input->get("order_id"),0,20);
    	}
    	

    	$this->load->model("Do_recharge_model");
    	$this->Do_recharge_model->ProcessRecharge($user_info,$circle_code,$company_id,$Amount,$Mobile,$recharge_type,$service_id,$rechargeBy,$order_id,$is_check_api);
    }





    public function addbalance()
    {}
    public function redirect_to_finalpage()
    {
        $this->session->set_flashdata("unique_id","19");
        redirect(base_url()."Retailer/dmrmm_finalpage?crypt=".$this->Common_methods->encrypt("19"));
    }
    public function refundOfAcountReportEntry($recharge_id,$status,$operator_id,$company_id,$user_id,$lapubalance,$lapunumber,$recharge_info,$date,$ip,$recharge_by,$callback,$respurl,$uniqueid,$is_second = false)
	{}
    public function get_string_between($string, $start, $end)
	 { 
		$string = ' ' . $string;
		
		if(strlen($start) > 0 )
		{
		    $ini = strpos($string, $start);    
		}
		else
		{
		    $ini = 0;
		}
		if ($ini == 0) return '';
		$ini += strlen($start);
		
		
		
		
		if($end == "")
		{
		    $len = strlen($string);
		}
		else
		{
		    $len = strpos($string, $end, $ini) - $ini;    
		}
		
		return substr($string, $ini, $len);
	}
    
    

    public function getoperatorlist()
	{


			$request_array = array(

					"ClientRefId"=>"123",
					"Number"=>"1140267020",
					"SPKey"=>"TPE",
					"TelecomCircleID"=>"0",
					"Optional1"=>"Ahmedabad",
					"Optional2"=>"",
					"Optional3"=>"",
					"Optional4"=>"",
					"Optional5"=>"",
					"Optional6"=>"",
					"Optional7"=>"",
					"Optional8"=>"",
					"Optional9"=>"",

			);


			$curl = curl_init();

			curl_setopt_array($curl, array(
			  CURLOPT_URL => "http://staging.quicksekure.com//api/BBPS/BBPSBillerList",
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => "",
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 0,
			  CURLOPT_FOLLOWLOCATION => true,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => "GET",
			  CURLOPT_POSTFIELDS =>json_encode($request_array),
			  CURLOPT_HTTPHEADER => array(
			    "Header: Content-Type: application/json",
			    "ClientID: 1000000021",
			    "SecretKey: TPED@#123S%34",
			    "TokenID: MAHA@#123S%34",
			    "Accept: application/json",
			    "ContentType: application/json",
			    "Content-Type: application/json"
			  ),
			));

			$response = curl_exec($curl);

			curl_close($curl);

			error_reporting(-1);
			ini_set('display_errors',1);
			$this->db->db_debug = TRUE;
			$json_obj = json_decode($response);
			//print_r($json_obj);exit;
			if(isset($json_obj->ResponseCode) and isset($json_obj->ResponseMessage)  and isset($json_obj->BillerData))
			{
				$ResponseCode = $json_obj->ResponseCode;
				$ResponseMessage = $json_obj->ResponseMessage;
				
				if($ResponseCode == "000")
				{
					$BillerData = $json_obj->BillerData;
					foreach($BillerData as $rwop)
					{
						$ServiceType = $rwop->ServiceType;
						$Operator = $rwop->Operator;
						$SpKey = $rwop->SpKey;
						$IsBillFetch = $rwop->IsBillFetch;
						$BillUpdation = $rwop->BillUpdation;
						$BillerId = $rwop->BillerId;


						$insertdata = $this->db->query("insert into swiftmoney_operatorlist(add_date,ipaddress,ServiceType,Operator,SpKey,IsBillFetch,BillUpdation,BillerId)
											values(?,?,?,?,?,?,?,?)",
											array($this->common->getDate(),$this->common->getRealIpAddr(),
												$ServiceType,$Operator,$SpKey,$IsBillFetch,$BillUpdation,$BillerId
											));
						if($insertdata == true)
						{
							$insert_id = $this->db->insert_id();
							$LabelData = $rwop->LabelData;
							foreach($LabelData as $labels)
							{
								$label_index = $labels->Index;
								$Labels = $labels->Labels;
								$FieldMinLen = $labels->FieldMinLen;
								$FieldMaxLen = $labels->FieldMaxLen;
								$this->db->query("insert into swiftmoney_operatorlist_label(swift_op_id,min_length,max_length,labelindex,labelname)
									values(?,?,?,?,?)",
									array($insert_id,$FieldMinLen,$FieldMaxLen,$label_index,$Labels));
							}
						}
					}
				}
				
			}


			//echo $response;

			/*


stdClass Object
(
    [ServiceType] => DTH
    [Operator] => Airtel Digital TV
    [SpKey] => ATV
    [IsBillFetch] => False
    [BillUpdation] => 
    [BillerId] => AIRT00000NAT87
    [LabelData] => Array
        (
            [0] => stdClass Object
                (
                    [Index] => 0
                    [Labels] => DTH number  : 
                    [FieldMinLen] => 6
                    [FieldMaxLen] => 18
                )

        )

)




			*/




	}


    public function billfetch()
	{


			$request_array = array(

					"ClientRefId"=>"123",
					"Number"=>"1140267020",
					"SPKey"=>"TPE",
					"TelecomCircleID"=>"0",
					"Optional1"=>"Ahmedabad",
					"Optional2"=>"",
					"Optional3"=>"",
					"Optional4"=>"",
					"Optional5"=>"",
					"Optional6"=>"",
					"Optional7"=>"",
					"Optional8"=>"",
					"Optional9"=>"",

			);


			$curl = curl_init();

			curl_setopt_array($curl, array(
			  CURLOPT_URL => "http://staging.quicksekure.com/api/BBPS/BBPSBillFetch",
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
			    "ClientID: 100059620",
			    "SecretKey: 208052#2019",
			    "TokenID: D6DE4E33-9CBC-4F80-9280-F1E86671862F",
			    "Accept: application/json",
			    "ContentType: application/json",
			    "Content-Type: application/json"
			  ),
			));

			$response = curl_exec($curl);

			curl_close($curl);
			echo $response;

			/*

{"ResponseCode":"500","ResponseMessage":"Incorrect / invalid customer account","dueamount":0.0,"duedate":null,"customername":null,"billnumber":null,"billdate":null,"acceptPartPay":null,"BBPSCharges":null,"BillUpdate":null,"RequestID":null,"ClientRefId":null}



			*/




	}



	public function dobillrecharge()
	{


			$request_array = array(

					"ClientRefId"=>"136",
					"Number"=>"10038517",
					"SPKey"=>"TPE",
					"TelecomCircleID"=>"0",
					"Amount"=>"100",
					"Optional1"=>"Ahmedabad",
					"Optional2"=>"",
					"Optional3"=>"",
					"Optional4"=>"",
					"Optional5"=>"",
					"Optional6"=>"",
					"Optional7"=>"",
					"Optional8"=>"",
					"Optional9"=>"",

			);


			$curl = curl_init();

			curl_setopt_array($curl, array(
			  CURLOPT_URL => "http://staging.quicksekure.com/api/BBPS/BBPSPayment",
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
			    "ClientID: 100059620",
			    "SecretKey: 208052#2019",
			    "TokenID: D6DE4E33-9CBC-4F80-9280-F1E86671862F",
			    "Accept: application/json",
			    "ContentType: application/json",
			    "Content-Type: application/json"
			  ),
			));

			$response = curl_exec($curl);

			curl_close($curl);
			echo $response;

			/*

{"ResponseCode":"500","ResponseMessage":"Incorrect / invalid customer account","dueamount":0.0,"duedate":null,"customername":null,"billnumber":null,"billdate":null,"acceptPartPay":null,"BBPSCharges":null,"BillUpdate":null,"RequestID":null,"ClientRefId":null}




pending
amount 50
ref id  133
{"ResponseCode":"999","ResponseMessage":"Transaction Under Process","TransactionId":"100062969","AvailableBalance":"","ClientRefId":"133","OperatorTransactionId":null}
ref id 134
{"ResponseCode":"999","ResponseMessage":"Transaction Under Process","TransactionId":"100062971","AvailableBalance":"","ClientRefId":"134","OperatorTransactionId":null}




failure
amount 100
ref id 135
{"ResponseCode":"024","ResponseMessage":"Failed from Simulator","TransactionId":"100062973","AvailableBalance":"98763.47","ClientRefId":"135","OperatorTransactionId":null}
ref id 136
{"ResponseCode":"024","ResponseMessage":"Failed from Simulator","TransactionId":"100062977","AvailableBalance":"98763.47","ClientRefId":"136","OperatorTransactionId":null}



success
amount 200
ref id 131
{"ResponseCode":"000","ResponseMessage":"Transaction Successful","TransactionId":"100062957","AvailableBalance":"98923.73","ClientRefId":"131","OperatorTransactionId":"150224477514A12C55D5"}

amount 60
ref id 132
{"ResponseCode":"000","ResponseMessage":"Transaction Successful","TransactionId":"100062963","AvailableBalance":"98863.72","ClientRefId":"132","OperatorTransactionId":"150224477514A12C55D5"}


			*/




	}





	public function index()
	{
		$amount = $_GET["amount"];
		$operatorcode = "RB";
		if($operatorcode == "TB" or $operatorcode == "RB")
        {
        	var_dump($amount % 2);
            if($amount % 2 == 0)
            {
            	echo "topup";exit;
                $operatorcode = "RB";
            }
            else
            {
            	echo "stv";
                $operatorcode = "TB";
            }
        }
        echo $operatorcode;exit;
		$this->load->model("Recharge_model");
		$userinfo = $this->db->query("select * from tblusers where user_id = 18");
		$service_no = "500000070354";
		$CustomerMobile = "8200756279";
		$company_id = "262";
		$option1 = "";

		$name = "dilip";
		$surname="patel";
		$pincode = "380008";

		$mobile_no = "8200756279";
		$this->load->model("Instapay");
		//$this->Instapay->remitter_registration2($mobile_no,$name,$surname,$pincode,$userinfo);
		$otp = "157850";
		//$this->Instapay->remitter_resend_otp2($mobile_no,$otp,$userinfo);

		$benificiary_name = "Maharshi";
		$benificiary_mobile = "";
		$benificiary_ifsc = "PUNB0096400";
		$benificiary_account_no = "0964000102016012";

		//$resp = $this->Instapay->beneficiary_register($mobile_no,$benificiary_name,$benificiary_mobile,$benificiary_ifsc,$benificiary_account_no,$userinfo);
		//echo $resp;exit;
		$beneficiaryid = "1858106";
		$amount = "100";
		$mode = "IMPS";
		$unique_id = "1";
		$done_by="WEB";
		$bank_id = 0;
		$whole_amount = "100";
		//$resp = $this->Instapay->transfer2($mobile_no,$beneficiaryid,$amount,$mode,$userinfo,$unique_id,$done_by,$bank_id,$whole_amount);
		$resp = $this->Instapay->verify_bene($mobile_no,$benificiary_account_no,$benificiary_ifsc,$bank_id,$userinfo);

		echo $resp;exit;
		exit;







		$company_id = 12;
		$Amount = 10;
		$resp = $this->Recharge_model->getCommissionInfo($company_id,$userinfo,$Amount);
		print_r( $resp);exit;

		$this->load->model("Swift");
		echo $this->Swift->fetchbill_swift($userinfo,$company_id,$service_no,$CustomerMobile,$option1);exit;


			$request_array = array(

					"ClientRefId"=>"123",
					"Number"=>"1140267020",
					"SPKey"=>"TPE",
					"TelecomCircleID"=>"0",
					"Optional1"=>"Ahmedabad",
					"Optional2"=>"",
					"Optional3"=>"",
					"Optional4"=>"",
					"Optional5"=>"",
					"Optional6"=>"",
					"Optional7"=>"",
					"Optional8"=>"",
					"Optional9"=>"",

			);


			$curl = curl_init();

			curl_setopt_array($curl, array(
			  CURLOPT_URL => "http://staging.quicksekure.com/api/BBPS/BBPSBillFetch",
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
			    "ClientID: 100059620",
			    "SecretKey: 208052#2019",
			    "TokenID: D6DE4E33-9CBC-4F80-9280-F1E86671862F",
			    "Accept: application/json",
			    "ContentType: application/json",
			    "Content-Type: application/json"
			  ),
			));

			$response = curl_exec($curl);

			curl_close($curl);
			echo $response;

			/*

{"ResponseCode":"500","ResponseMessage":"Incorrect / invalid customer account","dueamount":0.0,"duedate":null,"customername":null,"billnumber":null,"billdate":null,"acceptPartPay":null,"BBPSCharges":null,"BillUpdate":null,"RequestID":null,"ClientRefId":null}



			*/




	}
	
	public function code_snipet_test()
	{
	    $amounts = '10,20,65,50-148,48,219,129,49';
	    $amount_array = explode(",",$amounts);
	   // print_r($amount_array);exit;
	    $checkamount = 148;
	    if (preg_match('/-/',$amounts) == 1 ) 
	    {
	        foreach($amount_array as $amt) 
	        {
	            if (preg_match('/-/',$amt) == 1 ) 
	            {
	                 $amt_range = explode("-",$amt);
	                 $min_amt = $amt_range[0];
	                 $max_amt = $amt_range[1];
	                 if($checkamount >= $min_amt and $checkamount <= $max_amt)
	                 {
	                     echo "found";exit;
	                 }
	            }
	            else if($amt == $checkamount)
	            {
	                echo "found";exit;
	            }
	        }
	    }
	    if(in_array($checkamount,$amount_array))
	    {
	        echo "foudnd";exit;
	    }
	    else
	    {
	        echo "not found";
	    }
	    
	}
	
}
