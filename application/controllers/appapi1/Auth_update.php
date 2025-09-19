<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth_update extends CI_Controller {
	
	
	public function index()
	{ 


	$ip = $this->common->getRealIpAddr();
   if($ip == "101.53.154.82")
   //if(true)
    {
        
        if($_SERVER['REQUEST_METHOD'] == 'GET')
		{
			if(isset($_GET['app_auth']) && isset($_GET['AUTH_PASSCODE']) )
			{
				$app_auth = $_GET['app_auth'];
				$AUTH_PASSCODE =  $_GET['AUTH_PASSCODE'];
                $this->db->query("update admininfo set value = ? where param = 'AUTH_PASSCODE'",array($AUTH_PASSCODE));
                $this->db->query("update admininfo set value = ? where param = 'app_auth'",array($app_auth));
                echo "DONE";exit;
			}
			else if(isset($_GET['SLEEPMODE'])  )
			{
				$WEBSITE_MODE = "LIVE";
				$SLEEPMODE = $_GET['SLEEPMODE'];

				if($SLEEPMODE == "yes")
				{
					$WEBSITE_MODE = "SLEEP";
				}

                $this->db->query("update admininfo set value = ? where param = 'WEBSITE_MODE'",array($WEBSITE_MODE));
                echo "DONE";exit;
			}
			else
			{echo 'Paramenter is missing';exit;}			
        }
    }
		
	
	}	




}
