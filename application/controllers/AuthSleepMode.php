<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AuthSleepMode extends CI_Controller {
	function __construct()
    {
        parent:: __construct();
        $this->is_logged_in();
        $this->clear_cache();
    }
	function is_logged_in() 
    {
	 	
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
		
		$WEBSITE_MODE = "LIVE";
		$WEBSITE_MODE_info = $this->db->query("select value from admininfo where param = 'WEBSITE_MODE'");
		if($WEBSITE_MODE_info->num_rows() == 1)
		{
			$WEBSITE_MODE = $WEBSITE_MODE_info->row(0)->value;
			
		}

		if($WEBSITE_MODE == "LIVE")
		{
			redirect(base_url()."login");
			
		}
		else
		{
			$this->view_data["message"] = "";
			$this->load->view("AuthSleepMode_view",$this->view_data);
		}
	}	
}
