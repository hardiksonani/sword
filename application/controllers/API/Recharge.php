<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Recharge extends CI_Controller {

    function __construct()
    {
        parent:: __construct();
        $this->clear_cache();
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
	    // error_reporting(E_ALL);
	    // ini_set('display_errors',1);
	    // $this->db->db_debug = TRUE;   
	    $this->load->model("Recharge_model");
	     $req =  'http://'. $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
 		$this->addlog("",$req,"BEGIN");

	     $this->load->model("Recharge_model");
		if($_SERVER['REQUEST_METHOD'] == 'POST')
		{  
		
			//http://MaharshiTelecom.co.in/api_users/recharge?userid=$username&pin=$txnpwd&circlecode=$circle&operatorcode=&number=&amount=&uniqueid=
			if(isset($_REQUEST['userid']) && isset($_REQUEST['pin']) && isset($_REQUEST['circlecode']) && isset($_REQUEST['operatorcode']) && isset($_REQUEST['number']) && isset($_REQUEST['amount']) && isset($_REQUEST['uniqueid']))
			{
			    $username = $_REQUEST['userid'];
			    $pwd =  $_REQUEST['pin'];
			    $circlecode = $_REQUEST['circlecode'];
			    $operatorcode = $_REQUEST['operatorcode'];
			    $number =  trim($_REQUEST['number']);
			    $amount = $_REQUEST['amount'];			
			    $orderid = $_REQUEST['uniqueid'];
			} 
			
			else
			{
			    
			    $response = '0000#Failure#ERROR::Paramenter is missing';
			    $this->addlog("",$req,$response);
			    echo $response;exit;
			  
			}			
		}
		else
		{
			if(isset($_GET['userid']) && isset($_GET['pin']) && isset($_GET['circlecode']) && isset($_GET['operatorcode']) && isset($_GET['number']) && isset($_GET['amount']) && isset($_GET['uniqueid']))
			{
			    $username = $_GET['userid'];
			    $pwd =  $_GET['pin'];
			    $circlecode = $_GET['circlecode'];
			    $operatorcode = $_GET['operatorcode'];
			    $number =  $_GET['number'];
			    $amount = $_GET['amount'];
			    $orderid = $_GET['uniqueid'];
			}
			else if(isset($_GET['login_id']) && isset($_GET['transaction_password']) && isset($_GET['message']) && isset($_GET['response_type']))
			{
				$username = $_GET['login_id'];
				$pwd =  $_GET['transaction_password'];
				$message = str_replace("JIO","JO",$_GET['message']);
				$response_type =  $_GET['response_type'];	
			
				
				
				$allmsg = strtoupper(substr($message,2));
				$arr = explode("A",$allmsg);
				if(count($arr) != 2)
				{
					$this->Recharge_model->custom_response("0","0","0","Failure","Invalid Message Format","0",$response_type);
				}
				
				
				
				$operatorcode  = substr($message,0,2);
				
				
				if($operatorcode == "JO")
				{
				    $operatorcode = "JIO";
				}
				$number =  $arr[0];
				$amtarr = explode("REF",$arr[1]);
				$amount = intval($amtarr[0]);
				$orderid = $amtarr[1]; 
			}
			else
			{
			   
			     
			    $response = '0000#Failure#ERROR::Paramenter is missing';
			    $this->addlog("",$req,$response);
			    echo $response;exit;
			}			
		}						
		 
		
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////xxxxxxxxxxxxxxxxxx AUTHINTICATION, RECHARGE  CODE xxxxxxxxxxxxxxxxxxxxxxxx///////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////		

		
			$this->load->model("Do_recharge_model");
			$this->load->model("Recharge_model");	
			$this->load->model("Tblcompany_methods");
			$user_info = $this->db->query("select * from tblusers where username = ? and password = ? ",array($username,$pwd));
			if($user_info->num_rows() == 1)
			{
    			$user_id = $user_info->row(0)->user_id;
    			if($user_info->row(0)->usertype_name == "APIUSER")
    			{
    				//echo "ERROR:Operator Not Set";exit;
    				if($amount < 1)
    				{	
    				     $response =  '0000#Failure#ERROR::Minimum amount 1 INR For Recharge.';
    					 $this->addlog($user_id,$req,$response);
    					 echo $response;exit;
    				}
    				$company_info = $this->db->query("select * from tblcompany where mcode = ?",array($operatorcode));
    				if($company_info->num_rows() == 0)
    				{
    				    $response =  '0000#Failure#ERROR::Invalid Operator Code.';
    					 $this->addlog($user_id,$req,$response);
    					 echo $response;exit;
    				}
    				$MobileNo =	$number;
    				$Amount = $amount;
    
    				$company_id = $company_info->row(0)->company_id; 
    				
    				$service_id = $company_info->row(0)->service_id;
    				$circle_code = $circlecode;
    				$recharge_type = "Mobile";
    				$rechargeBy = "API";
    				$response = $this->Recharge_model->ProcessRecharge($user_info,$circle_code,$company_id,$Amount,$MobileNo,$recharge_type,$service_id,$rechargeBy,$orderid);
    				if( $response == "" or $response == NULL)
    				{
    					$response = "No Response Form API CALL";
    				}
    				
    				 $this->addlog($user_id,$req,$response);
    				 echo $response;exit;
    			}
			}
		
    		else
    		{
    			echo "0000#Failure#ERROR::Authentication Fail";exit;
    		}
	}
	private function addlog($user_id,$req,$response)
	{
	    
	    $this->db->query("insert into tblreqresp(user_id,request,response,add_date,ipaddress) values(?,?,?,?,?)",
	    array($user_id,$req,$response,$this->common->getDate(),$this->common->getRealIpAddr()));
	    
	}
}
//50.22.77.79