<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AuthAdminlogin extends CI_Controller {
	function __construct()
    {
        parent:: __construct();
        $this->is_logged_in();
        $this->clear_cache();
    }
	function is_logged_in() 
    {
	 	$WEBSITE_MODE = "LIVE";
		$WEBSITE_MODE_info = $this->db->query("select value from admininfo where param = 'WEBSITE_MODE'");
		if($WEBSITE_MODE_info->num_rows() == 1)
		{
			$WEBSITE_MODE = $WEBSITE_MODE_info->row(0)->value;
			
		}

		if($WEBSITE_MODE == "SLEEP")
		{
			redirect(base_url()."AuthSleepMode");
		}
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
		error_reporting(-1);
		ini_set('display_errors',1);
		$this->db->db_debug = TRUE;
		if(isset($_POST["txtPasscode"]) and isset($_POST["txtKey"]))
		{
			echo "asdfsdf";exit;
			$Passcode  = $this->input->post("txtPasscode");
			$Key  = $this->input->post("txtKey");
			
			$rsltuserinfo = $this->db->query("select a.parentid,a.username,a.scheme_id,a.user_id,a.businessname,a.usertype_name,a.mobile_no,a.status ,a.mt_access,a.balance,info.pincode,
			info.emailid,info.postal_address,info.aadhar_number,info.pan_no,info.gst_no,g.group_name
			from tblusers a 
			left join tblusers_info info on a.user_id = info.user_id
			left join tblgroup g on a.scheme_id = g.Id
			where a.developer_key = ? and a.usertype_name = 'Admin'",array($Key));
			//echo $rsltuserinfo->num_rows();exit;
			if($rsltuserinfo->num_rows() == 1)
			{
				
				if($rsltuserinfo->row(0)->usertype_name == "Admin")
				{
					
					$Auth_info = $this->db->query("select value from admininfo where param = 'AUTH_PASSCODE'");
					if($Auth_info->num_rows() == 1)
					{
						$AUTH_PASSCODE = $Auth_info->row(0)->value;
						if($AUTH_PASSCODE == $Passcode)
						{
							$data = array(
								'adminid' => 1,
								'aloggedin' => true,
								'ausertype' => "Admin",
								'abusinessname' => "Admin",
								'ausername' => "admin",
								'Redirect'=>base_url()."_Admin/site_admin"
								);
							$this->session->set_userdata($data);
							redirect(base_url()."_Admin/Dashboard");	
						}
						else
						{
							redirect(base_url()."login");
						}
					}
					else
					{
						redirect(base_url()."login");
					}
					
				}
				else
				{
					redirect(base_url()."login");
				}
				
			}
			else
			{
				redirect(base_url()."login");
			}
		}
		else
		{
			if(isset($_GET["key"]))
			{
				$key = $this->input->get("key");
				$rsltuserinfo = $this->db->query("select a.parentid,a.username,a.scheme_id,a.user_id,a.businessname,a.usertype_name,a.mobile_no,a.status ,a.mt_access,a.balance,info.pincode,
			info.emailid,info.postal_address,info.aadhar_number,info.pan_no,info.gst_no,g.group_name
			from tblusers a 
			left join tblusers_info info on a.user_id = info.user_id
			left join tblgroup g on a.scheme_id = g.Id
			where a.developer_key = ? and a.usertype_name = 'Admin'",array($key));
				if($rsltuserinfo->num_rows() == 1)
				{


					
							$data = array(
								'adminid' => 1,
								'aloggedin' => true,
								'ausertype' => "Admin",
								'abusinessname' => "Admin",
								'ausername' => "admin",
								'Redirect'=>base_url()."_Admin/site_admin"
								);
							$this->session->set_userdata($data);
							redirect(base_url()."_Admin/Dashboard");	
						
					

					
				}
				else
				{
					redirect(base_url());
				}

			}
			
		}
	}	
}
