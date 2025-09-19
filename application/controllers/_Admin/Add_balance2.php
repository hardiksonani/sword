<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Add_balance2 extends CI_Controller {
	

	private $msg='';
	public function index() 
	{
		
		if ($this->session->userdata('aloggedin') != TRUE) 
		{ 
			redirect(base_url().'login'); 
		}				
		else 		
		{
			if(isset($_POST["ddlaction"]) and isset($_POST["txtAmount"]) and isset($_POST["txtRemark"]) ) 	
			{
				$ddlaction = trim($this->input->post("ddlaction"));
				$txtAmount = trim($this->input->post("txtAmount"));
				$txtRemark = trim($this->input->post("txtRemark"));
				$hidid = trim($this->input->post("hidid"));
				
				$this->load->model("Ew2");
				$userinfo = $this->db->query("select user_id,businessname,username,usertype_name from tblusers where user_id = ?",array($hidid));
				if($ddlaction == "ADD")
				{
					$description = "Admin To ".$userinfo->row(0)->businessname;
					$payment_type = "CASH";
					
					$this->Ew2->tblewallet_Payment_CrDrEntry($hidid,1,$txtAmount,$txtRemark,$description,$payment_type);
				}
				else if($ddlaction == "REVERT")
				{
					$description = "Admin To ".$userinfo->row(0)->businessname;
					$payment_type = "CASH";
					$this->Ew2->tblewallet_Payment_CrDrEntry(1,$hidid,$txtAmount,$txtRemark,$description,$payment_type);
				}
				if($userinfo->row(0)->usertype_name == "MasterDealer")
				{
					redirect(base_url()."_Admin/md_list?crypt=".$this->Common_methods->encrypt("MyData"));
				}
				else if($userinfo->row(0)->usertype_name == "Distributor")
				{
					redirect(base_url()."_Admin/distributor_list?crypt=".$this->Common_methods->encrypt("MyData"));
				}
				else
				{
					redirect(base_url()."_Admin/agent_list?crypt=".$this->Common_methods->encrypt("MyData"));
				}
				
			}
			else
			{
				if(isset($_GET["encrid"]))
				{
					$encrid = $this->Common_methods->decrypt(trim($_GET["encrid"]));
					
					$userinfo = $this->db->query("select user_id,businessname,username,usertype_name,add_date from tblusers where user_id = ?",array($encrid));
					if($userinfo->num_rows() == 1)
					{
						$this->view_data["message"] = "";
						$this->view_data["userinfo"] = $userinfo;
						$this->load->view("_Admin/add_balance2_view",$this->view_data);
					}
					
				}
				
			}
		}
	}	
}