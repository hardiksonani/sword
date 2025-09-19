<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Payment_history extends CI_Controller {
	
	
	private $msg='';
	
	
	public function index() 
	{
				$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
$this->output->set_header("Pragma: no-cache"); 

		if($this->session->userdata('aloggedin') != TRUE) 
		{ 
			redirect(base_url().'login'); 
		}					
		else 		
		{ 	
			if($this->input->post('btnSearch') == "Search")
			{
			
				$from_date = $this->input->post("txtFrom",TRUE);
				$to_date = $this->input->post("txtTo",TRUE);
				$ddltype = $this->input->post("ddltype",TRUE);
			
				$this->view_data['from'] = $from_date;
				$this->view_data['to'] = $to_date;
				$this->view_data['pagination'] = NULL;
				$this->view_data['result_mdealer'] = $this->db->query("select tblautopayreq.*,businessname,username,usertype_name from tblautopayreq,tblusers where 
				tblusers.user_id = tblautopayreq.user_id and   
				Date(tblautopayreq.add_date) >= ? and 
				Date(tblautopayreq.add_date) <= ? and 
				tblautopayreq.status != 'Pending' and
				if(? != 'ALL',tblautopayreq.status = ?,true)
				",array($from_date,$to_date,$ddltype,$ddltype));
				
				
				$this->view_data['ddltype'] =$ddltype;
				$this->view_data['flagopenclose'] =1;
				$this->view_data['message'] =$this->msg;
				$this->load->view('_Admin/payment_history_view',$this->view_data);		
			}					
			
			else
			{
				$user=$this->session->userdata('ausertype');
				if(trim($user) == 'Admin')
				{
				
					$today_date = $this->common->getMySqlDate();
				
			
					
					$this->view_data['from'] = $today_date;
					$this->view_data['ddltype'] = "ALL";
					$this->view_data['to'] = $today_date;
					$this->view_data['pagination'] = NULL;
					
					
					$this->view_data['result_mdealer'] = $this->db->query("select tblautopayreq.*,businessname,username,usertype_name from tblautopayreq,tblusers where tblusers.user_id = tblautopayreq.user_id and   Date(tblautopayreq.add_date) >= ? 
					and Date(tblautopayreq.add_date) <= ? 
					and tblautopayreq.status != 'Pending' 
					and if(? != 'ALL',tblautopayreq.status = ?,true)",array($today_date,$today_date,"ALL","ALL"));
					//$this->view_data['result_mdealer'] = $this->db->query("select * from tblautopayreq where  Date(add_date) >= ? and Date(add_date) <= ?",array($today_date,$today_date));
					$this->view_data['flagopenclose'] =1;
					$this->view_data['message'] =$this->msg;
					$this->load->view('_Admin/payment_history_view',$this->view_data);		
				}
				else
				{redirect(base_url().'login');}																								
			}
		} 
	}	
}