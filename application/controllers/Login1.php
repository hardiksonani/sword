<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login1 extends CI_Controller {
	
	public function index()
	{ 
		
#$rslt = $this->db->query("select * from tblusers");
#print_r($rslt->result());exit;		
if($this->input->post("txtUsername") and $this->input->post("txtPassword"))
		{
			$username  = $this->input->post("txtUsername");
			$password  = $this->input->post("txtPassword");
			
			$rsltuserinfo = $this->db->query("select a.parentid,a.username,a.scheme_id,a.user_id,a.businessname,a.usertype_name,a.mobile_no,a.status ,a.mt_access,a.balance,info.pincode,
			info.emailid,info.postal_address,info.aadhar_number,info.pan_no,info.gst_no,g.group_name
			from tblusers a 
			left join tblusers_info info on a.user_id = info.user_id
			left join tblgroup g on a.scheme_id = g.Id
			where a.mobile_no = ? and a.password = ?",array($username,$password));
			if($rsltuserinfo->num_rows() == 1)
			{
				
				if($rsltuserinfo->row(0)->usertype_name == "Admin")
				{
					$random_string  = rand(10000000000,999999999999);
					$this->db->query("update tblusers set developer_key = ? where user_id = ?",array($random_string,$rsltuserinfo->row(0)->user_id));

					redirect(base_url()."AuthAdminlogin?key=".$random_string);
				}
				else if($rsltuserinfo->row(0)->usertype_name == "WEBSITE")	
				{
				   
					$data = array(
					'WebId' => $rsltuserinfo->row(0)->user_id,
					'WebParentId' => $rsltuserinfo->row(0)->parentid,
					'WebLoggedIn' => true,
					'WebUserType' => $rsltuserinfo->row(0)->usertype_name,
					'WebUserName' => $rsltuserinfo->row(0)->username,
					'WebBusinessName' => $rsltuserinfo->row(0)->businessname,
					'WebSchemeId'=>$rsltuserinfo->row(0)->scheme_id,
					'WebGroupName'=>$rsltuserinfo->row(0)->group_name,
					'WebMT_Access'=>$rsltuserinfo->row(0)->mt_access,
					'WebMobile'=>$rsltuserinfo->row(0)->mobile_no,
					'WebBalance'=>$rsltuserinfo->row(0)->balance,
					'Webpostal_address'=>$rsltuserinfo->row(0)->postal_address,
					'Webpincode'=>$rsltuserinfo->row(0)->pincode,
					'Webaadhar_number'=>$rsltuserinfo->row(0)->aadhar_number,
					'Webpan_no'=>$rsltuserinfo->row(0)->pan_no,
					'Webgst_no'=>$rsltuserinfo->row(0)->gst_no,
					'Webemailid'=>$rsltuserinfo->row(0)->emailid,
					'AdminId'=>1,
					'ReadOnly'=>false,
					'Redirect'=>base_url()."WEB/Home",
					);
					$this->session->set_userdata($data);
					redirect(base_url()."WEB/Home");
					 
				}
				else if($rsltuserinfo->row(0)->usertype_name == "Agent")	
				{
				   
					$data = array(
					'AgentId' => $rsltuserinfo->row(0)->user_id,
					'AgentParentId' => $rsltuserinfo->row(0)->parentid,
					'AgentLoggedIn' => true,
					'AgentUserType' => $rsltuserinfo->row(0)->usertype_name,
					'AgentUserName' => $rsltuserinfo->row(0)->username,
					'AgentBusinessName' => $rsltuserinfo->row(0)->businessname,
					'AgentSchemeId'=>$rsltuserinfo->row(0)->scheme_id,
					'AgentGroupName'=>$rsltuserinfo->row(0)->group_name,
					'AgentMT_Access'=>$rsltuserinfo->row(0)->mt_access,
					'AgentMobile'=>$rsltuserinfo->row(0)->mobile_no,
					'AgentBalance'=>$rsltuserinfo->row(0)->balance,
					'Agentpostal_address'=>$rsltuserinfo->row(0)->postal_address,
					'Agentpincode'=>$rsltuserinfo->row(0)->pincode,
					'Agentaadhar_number'=>$rsltuserinfo->row(0)->aadhar_number,
					'Agentpan_no'=>$rsltuserinfo->row(0)->pan_no,
					'Agentgst_no'=>$rsltuserinfo->row(0)->gst_no,
					'Agentemailid'=>$rsltuserinfo->row(0)->emailid,
					'AdminId'=>1,
					'ReadOnly'=>false,
					'Redirect'=>base_url()."Retailer/recharge_home",
					);
					$this->session->set_userdata($data);
					redirect(base_url()."Retailer/recharge_home");
					 
				}
				else if($rsltuserinfo->row(0)->usertype_name == "Distributor")	
				{
					   
				$data = array(
					'DistId' => $rsltuserinfo->row(0)->user_id,
					'DistParentId' => $rsltuserinfo->row(0)->parentid,
					'DistLoggedIn' => true,
					'DistUserType' => $rsltuserinfo->row(0)->usertype_name,
					'DistUserName' => $rsltuserinfo->row(0)->username,
					'DistBusinessName' => $rsltuserinfo->row(0)->businessname,
					'DistSchemeId'=>$rsltuserinfo->row(0)->scheme_id,
					'DistGroupName'=>$rsltuserinfo->row(0)->group_name,
					'DistMT_Access'=>$rsltuserinfo->row(0)->mt_access,
					'DistMobile'=>$rsltuserinfo->row(0)->mobile_no,
					'DistBalance'=>$rsltuserinfo->row(0)->balance,
					'Distpostal_address'=>$rsltuserinfo->row(0)->postal_address,
					'Distpincode'=>$rsltuserinfo->row(0)->pincode,
					'Distaadhar_number'=>$rsltuserinfo->row(0)->aadhar_number,
					'Distpan_no'=>$rsltuserinfo->row(0)->pan_no,
					'Distgst_no'=>$rsltuserinfo->row(0)->gst_no,
					'Distemailid'=>$rsltuserinfo->row(0)->emailid,
					'AdminId'=>1,
					'ReadOnly'=>false,
					'Redirect'=>base_url()."Distributor/recharge_home",
					);
					
					$this->session->set_userdata($data);
					redirect(base_url()."Distributor/recharge_home");
					 
				}
				else if($rsltuserinfo->row(0)->usertype_name == "FOS")	
				{
					   
					$data = array(
					'FOSId' => $rsltuserinfo->row(0)->user_id,
					'FOSParentId' => $rsltuserinfo->row(0)->parentid,
					'FOSLoggedIn' => true,
					'FOSUserName' => $rsltuserinfo->row(0)->username,
					'FOSUserType' => $rsltuserinfo->row(0)->usertype_name,
					'FOSBusinessName' => $rsltuserinfo->row(0)->businessname,
					'FOSSchemeId'=>$rsltuserinfo->row(0)->scheme_id,
					'AdminId'=>1,
					'ReadOnly'=>false,
					'Redirect'=>base_url()."FOS/agent_list",
					);
					 
					$this->session->set_userdata($data);
					redirect(base_url()."FOS/agent_list");
					 
				}
				else if($rsltuserinfo->row(0)->usertype_name == "MasterDealer")	
				{
					  
					$data = array(
					'MdId' => $rsltuserinfo->row(0)->user_id,
					'MdParentId' => $rsltuserinfo->row(0)->parentid,
					'MdLoggedIn' => true,
					'MdUserType' => $rsltuserinfo->row(0)->usertype_name,
					'MdUserName' => $rsltuserinfo->row(0)->username,
					'MdBusinessName' => $rsltuserinfo->row(0)->businessname,
					'MdSchemeId'=>$rsltuserinfo->row(0)->scheme_id,
					'MdGroupName'=>$rsltuserinfo->row(0)->group_name,
					'MdMT_Access'=>$rsltuserinfo->row(0)->mt_access,
					'MdMobile'=>$rsltuserinfo->row(0)->mobile_no,
					'MdBalance'=>$rsltuserinfo->row(0)->balance,
					'Mdpostal_address'=>$rsltuserinfo->row(0)->postal_address,
					'Mdpincode'=>$rsltuserinfo->row(0)->pincode,
					'Mdaadhar_number'=>$rsltuserinfo->row(0)->aadhar_number,
					'Mdpan_no'=>$rsltuserinfo->row(0)->pan_no,
					'Mdgst_no'=>$rsltuserinfo->row(0)->gst_no,
					'Mdemailid'=>$rsltuserinfo->row(0)->emailid,
					'AdminId'=>1,
					'ReadOnly'=>false,
					'Redirect'=>base_url()."MasterDealer/agent_list",
					);
					 $this->session->set_userdata($data);
					redirect(base_url()."MasterDealer/agent_list");
					 
					
				}
				else if($rsltuserinfo->row(0)->usertype_name == "SuperDealer")	
				{
					
					  
					$data = array(
					'SdId' => $rsltuserinfo->row(0)->user_id,
					'SdParentId' => $rsltuserinfo->row(0)->parentid,
					'SdLoggedIn' => true,
					'SdUserType' => $rsltuserinfo->row(0)->usertype_name,
					'SdUserName' => $rsltuserinfo->row(0)->username,
					'SdBusinessName' => $rsltuserinfo->row(0)->businessname,
					'SdSchemeId'=>$rsltuserinfo->row(0)->scheme_id,
					'SdGroupName'=>$rsltuserinfo->row(0)->group_name,
					'SdMT_Access'=>$rsltuserinfo->row(0)->mt_access,
					'SdMobile'=>$rsltuserinfo->row(0)->mobile_no,
					'SdBalance'=>$rsltuserinfo->row(0)->balance,
					'Sdpostal_address'=>$rsltuserinfo->row(0)->postal_address,
					'Sdpincode'=>$rsltuserinfo->row(0)->pincode,
					'Sdaadhar_number'=>$rsltuserinfo->row(0)->aadhar_number,
					'Sdpan_no'=>$rsltuserinfo->row(0)->pan_no,
					'Sdgst_no'=>$rsltuserinfo->row(0)->gst_no,
					'Sdemailid'=>$rsltuserinfo->row(0)->emailid,
					'AdminId'=>1,
					'ReadOnly'=>false,
					'Redirect'=>base_url()."SuperDealer/agent_list",
					);
				
					
					$this->session->set_userdata($data);
					redirect(base_url()."SuperDealer/agent_list");
				}
				else if($rsltuserinfo->row(0)->usertype_name == "APIUSER")
				{
					$data = array(
					'ApiId' => $rsltuserinfo->row(0)->user_id,
					'ApiLoggedIn' => true,
					'ApiSchemeId'=>$rsltuserinfo->row(0)->scheme_id,
					'ApiUserType' => $rsltuserinfo->row(0)->usertype_name,
					'ApiBusinessName' => $rsltuserinfo->row(0)->businessname,
					'ApiUserName' => $rsltuserinfo->row(0)->mobile_no,
					'ApiEmail' => $rsltuserinfo->row(0)->emailid,
					'ApiPostalAddress' => $rsltuserinfo->row(0)->postal_address,
					'AdminId'=>1,
					);
					$this->session->set_userdata($data);
					redirect(base_url()."API/recharge_history");
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
			$this->load->view("Login1_view");
		}
	}	
}
