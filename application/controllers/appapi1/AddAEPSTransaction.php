<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AddAEPSTransaction extends CI_Controller {
	
	public function index()
	{ 
		
		//http://<?php echo base_url(); ?>/appapi1/AddAEPSTransaction?MobileNo=&PinNo=&Amount=&type=
		if(isset($_GET['MobileNo']) && isset($_GET['PinNo'])  && isset($_GET['Amount'])  && isset($_GET['type']))
		{
			$username = $_GET['MobileNo'];
			$pwd =  $_GET['PinNo'];
			$Amount =  $_GET['Amount'];
			$type =  $_GET['type'];
		}
		else
		{echo 'Paramenter is missing';exit;}			
		
		 $host_id = $this->Common_methods->getHostId($this->white->getDomainName());
		$userinfo = $this->db->query("select a.user_id,a.businessname,a.username,a.status,a.usertype_name,info.birthdate
		from tblusers  a 
		left join tblusers_info info on a.user_id = info.user_id
		where 
		a.username = ? and 
		a.password = ? 
		and a.host_id = ?",array($username,$pwd,$host_id));
		if($userinfo->num_rows() == 1)
		{
			$status = $userinfo->row(0)->status;
			$user_id = $userinfo->row(0)->user_id;
			$business_name = $userinfo->row(0)->businessname;
			$username = $userinfo->row(0)->username;
			$usertype_name = $userinfo->row(0)->usertype_name;
			$birthdate = $userinfo->row(0)->birthdate;
			if($status == '1')
			{
			    $insertion = $this->db->query("insert into minkspay_aeps(add_date,ipaddress,user_id,amount,type) values(?,?,?,?,?)",
			    	array($this->common->getDate(),$this->common->getRealIpAddr(),$user_id,$Amount,$type));
			    if($insertion == true)
			    {
			    	$insert_id = $this->db->insert_id();
			    	/*
			    	{"message":"Transaction Insert Successfully","status":"True","TransactionId":"1000002","DeveloperKey":"ggjgjggjgjjjh","DeveloperPass":"123654"}
			    	*/
			    	$resparray = array(
			    			"message"=>"Transaction Insert Successfully",
			    			"status"=>"True",
			    			"TransactionId"=>$insert_id,
			    			"DeveloperKey"=>'Q3dnVUdXMVI0QTJSQmlOL2ZqREJmM0ZLN0YyK2Y1bVA3a1V0RW1mRHlaM21HdmVrWHV1Q1YrNFRUNDZvTlRCSG9HRjZ0UkJVMEdoZjBNVUtreGFEVUE9PQ==',
			    			"DeveloperPass"=>'$2y$10$j8QgFtFJgJuUhe/6K/sQwuMd2O5k5jttWkcnIdouTCVwcHo1Nrxw2',

			    	);
			    	echo json_encode($resparray);exit;
			    }
			}
			else
			{
				$resparray = array(
				'status'=>1,
				'message'=>'Your account is deactivated. contact your Administrator'
				);
				echo json_encode($resparray);exit;
			}
		}
		else
		{
			$resparray = array(
				'status'=>1,
				'message'=>'Invalid UserId or Password'
				);
				echo json_encode($resparray);exit;
		}
	
	
	}	
}
