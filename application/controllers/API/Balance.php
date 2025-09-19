<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Balance extends CI_Controller {
	
	

	public function index() 
	{
		if($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			if(isset($_REQUEST['userid']) && isset($_REQUEST['pin']))
			{$username = $_REQUEST['userid'];$pwd =  $_REQUEST['pin'];}
			else
			{echo 'Paramenter is missing';exit;}			
		}
		else
		{
			if(isset($_GET['userid']) && isset($_GET['pin']))
			{$username = $_GET['userid'];$pwd =  $_GET['pin'];}
			else
			{echo 'Paramenter is missing';exit;}			
		} 
		
		
		$USERINFO = $this->Userinfo_methods->getUserInfoByUsernamePwd2($username,$pwd);
		
		//print_r($USERINFO);exit;
		if($USERINFO->num_rows() == 1)
		{
		
		$user_id = $USERINFO->row(0)->user_id;
		$USERINFO2 = $this->db->query("select client_ip,client_ip2,client_ip3,client_ip4,client_ip5 from tblusers_info where user_id = ?",array($user_id));
		$client_ip = $USERINFO2->row(0)->client_ip;
		$client_ip2 = $USERINFO2->row(0)->client_ip2;
		$client_ip3 = $USERINFO2->row(0)->client_ip3;
		$client_ip4 = $USERINFO2->row(0)->client_ip4;
		$client_ip5 = $USERINFO2->row(0)->client_ip5;
		$ip_address = $this->getRequestURLIp();
		if($client_ip == $ip_address or $client_ip2 == $ip_address or $client_ip3 == $ip_address or $client_ip4 == $ip_address or $client_ip5 == $ip_address)
		{
		
		if($this->Userinfo_methods->check_login($username,$pwd) == true)
		{
			
			if($USERINFO->row(0)->usertype_name == "APIUSER")
			{
				$balance = $this->Common_methods->getAgentBalance($USERINFO->row(0)->user_id);
				$balance2 = $this->Ew2->getAgentBalance($USERINFO->row(0)->user_id);
				echo $balance."|".$balance2;
			}
		}
		else
		{
			echo "ERROR::Authentication Fail";exit;
		}
		}
		else
		{
			echo "ERROR::Invalid IP Address";exit;
		}
		}
		else
		{
			echo "ERROR::Authentication Fail";exit;
		}		
	}	
	public function getRequestURLIp()
	{
		if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
		{
		  $ip=$_SERVER['HTTP_CLIENT_IP'];
		}
		elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
		{
		  $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
		}
		else
		{
		  $ip=$_SERVER['REMOTE_ADDR'];
		}
		return $ip;
		
	}
}
//50.22.77.79