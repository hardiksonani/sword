<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Agent_edit extends CI_Controller {
	
	public function process()
	{
		$this->index();
	}
	function __construct()
    { 
        parent:: __construct();
        $this->is_logged_in();
        $this->clear_cache();
    }
	function is_logged_in() 
    {
		if ($this->session->userdata('MdUserType') != "MasterDealer") 
		{ 
			redirect(base_url().'login'); 
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
		$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
$this->output->set_header("Pragma: no-cache"); 

		if ($this->session->userdata('MdUserType') != "MasterDealer") 
		{ 
			redirect(base_url().'login'); 
		}	
		else 
		{ 
			$data['message']='';				
			$this->load->view('MasterDealer/agent_edit_view',$data);
			
		} 			
	}
	
	
	public function change_commission()
	{
	   if(isset($_POST["user_id"]) and isset($_POST["company_id"]) and isset($_POST["commission"]))
	   {
	       $user_id = trim($this->input->post("user_id"));
	       $company_id = trim($this->input->post("company_id"));
	       $commission = floatval(trim($this->input->post("commission")));
	      
	        if( $commission > 0 and $commission < 4)
	        {
	            $userinfo = $this->db->query("select user_id from tblusers where user_id = ? and usertype_name = 'Distributor' and parentid = ?",array(intval($user_id),$this->session->userdata("MdId")));
	            if($userinfo->num_rows() == 1)
    	       {
    	           
    	           $dist_commissioninfo = $this->db->query("select * from tbluser_commission where user_id = ? and company_id = ?",array($this->session->userdata("MdId"),intval($company_id)));
    	           if($dist_commissioninfo->num_rows() == 1)
    	           {
    	               $dist_commission = floatval($dist_commissioninfo->row(0)->commission);
    	               if($dist_commission > $commission)
    	               {
    	                   $getcommissioninfo = $this->db->query("select * from tbluser_commission where user_id = ? and company_id = ?",array(intval($user_id),intval($company_id)));
            	           if($getcommissioninfo->num_rows() == 1)
            	           {
            	               $this->db->query("update tbluser_commission set commission = ? where user_id = ? and company_id = ?",array($commission,intval($user_id),intval($company_id)));
            	               echo "done";exit;
            	           }
            	           else
            	           {
            	               $this->db->query("insert into tbluser_commission(user_id,company_id,commission_type,commission,add_date,ipaddress) values(?,?,?,?,?,?)",
            	               array($user_id,$company_id,"PER",$commission,$this->common->getDate(),$this->common->getRealIpAddr()));
            	               echo "done";exit;
            	           } 
    	               }
    	               else
    	               {
    	                   echo "You Cant Set Commission Grater Than You Receive";exit;
    	               } 
    	           }
    	           else
    	           {
    	               echo "Your Commission Not Configured. Contact Administrator";exit;
    	           }
    	       }   
	        }
	   }
	}
}
