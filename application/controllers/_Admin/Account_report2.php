<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account_report2 extends CI_Controller {
	
	
	private $msg='';
	
	public function index()  
	{
				$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
$this->output->set_header("Pragma: no-cache"); 

		if ($this->session->userdata('aloggedin') != TRUE) 
		{ 
			redirect(base_url().'login'); 
		}				
		else 		
		{ 	
			if($this->input->post('btnSearch') == "Search")
			{
				
				$from_date = $this->input->post("txtFrom",TRUE);
				$to_date = $this->input->post("txtTo",TRUE);
				$balnacetype = $this->input->post("ddlbalnacetype",TRUE);
				$user_id = $this->session->userdata("adminid");
				$this->view_data['pagination'] = NULL;
				$this->view_data['result_mdealer'] = $this->AccountLedger_getReport($this->session->userdata("adminid"),$from_date,$to_date,$balnacetype);
				$this->view_data['message'] =$this->msg;
				
				$rsltdebit = $this->db->query("select IFNULL(Sum(debit_amount),0) as total from tblewallet2 where user_id = ? and Date(add_date) >= ? and Date(add_date) <= ? ",array($this->session->userdata("adminid"),$from_date,$to_date));
				$this->view_data['totalcredit'] =$this->gettotalcredit($user_id,$from_date,$to_date);
				$this->view_data['totaldebit'] =$this->gettotaldebit($user_id,$from_date,$to_date);
				$this->view_data['from_date']  = $from_date;
				$this->view_data['to_date']  = $to_date;
				$this->view_data['ddlbalnacetype']  = $balnacetype;
				$this->load->view('_Admin/account_report2_view',$this->view_data);		
			}					
			else if($this->input->post('hidaction') == "Set")
			{								
				$status = $this->input->post("hidstatus",TRUE);
				$user_id = $this->input->post("hiduserid",TRUE);
				$this->load->model('Report');
				$result = $this->Report->updateAction($status,$user_id);
				if($result == true)
				{
					$this->msg="Action Submit Successfully.";
					$this->pageview();	
				}
			}
			else
			{
				$user=$this->session->userdata('ausertype');
				if(trim($user) == 'Admin' or trim($user) == 'EMP')
				{
				
				$from_date = $to_date  = $this->common->getMySqlDate();

				$this->view_data['pagination'] = NULL;
				$this->view_data['result_mdealer'] = $this->AccountLedger_getReport($this->session->userdata("adminid"),$from_date,$to_date,"");
				$this->view_data['message'] =$this->msg;
				$rsltcredit = $this->db->query("select IFNULL(Sum(credit_amount),0) as total from tblewallet2 where user_id = ? and Date(add_date) >= ? and Date(add_date) <= ? ",array($this->session->userdata("adminid"),$from_date,$to_date));
				$rsltdebit = $this->db->query("select IFNULL(Sum(debit_amount),0) as total from tblewallet2 where user_id = ? and Date(add_date) >= ? and Date(add_date) <= ? ",array($this->session->userdata("adminid"),$from_date,$to_date));
				$this->view_data['totalcredit'] =$rsltcredit->row(0)->total;
				$this->view_data['totaldebit'] =$rsltdebit->row(0)->total;
				$this->view_data['from_date']  = $from_date;
				$this->view_data['to_date']  = $to_date;
				$this->view_data['ddlbalnacetype']  = "";
				$this->load->view('_Admin/account_report2_view',$this->view_data);	
				}
				else
				{redirect(base_url().'login');}																								
			}
		} 
	}	
	private function AccountLedger_getReport($user_id,$from_date,$to_date,$balnacetype)
	{
	
		$remarkcheck = "'%".$balnacetype."%'";
			$str_query = "select tblewallet2.*,
			(select tblpayment2.add_date from tblpayment2 where tblpayment2.payment_id = tblewallet2.payment_id) as payment_date,
			(select businessname from tblusers where tblusers.user_id = (select cr_user_id from tblpayment2 where tblpayment2.payment_id = tblewallet2.payment_id)) as bname,
			(select username from tblusers where tblusers.user_id = (select cr_user_id from tblpayment where tblpayment.payment_id = tblewallet2.payment_id)) as username,
			(select usertype_name from tblusers where tblusers.user_id = (select cr_user_id from tblpayment2 where tblpayment2.payment_id = tblewallet2.payment_id)) as usertype 
			from tblewallet2 
			where 
			user_id = '$user_id' and 
			DATE(add_date) >= '$from_date' and 
			DATE(add_date) <= '$to_date'  and
			if(? != 'ALL',remark NOT LIKE  '%Commiss%',true)
			
			order by tblewallet2.Id desc";
			$rslt = $this->db->query($str_query,array($balnacetype));
			return $rslt;
		
		
	}
	
	private function gettotalcredit($user_id,$from_date,$to_date)
	{
		$rsltcredit = $this->db->query("select IFNULL(Sum(credit_amount),0) as total from tblewallet2 where user_id = ? and Date(add_date) >= ? and Date(add_date) <= ? ",array($this->session->userdata("adminid"),$from_date,$to_date));
		return $rsltcredit->row(0)->total;
		
	}
	private function gettotaldebit($user_id,$from_date,$to_date)
	{
		$rsltcredit = $this->db->query("select IFNULL(Sum(debit_amount),0) as total from tblewallet2 where user_id = ? and Date(add_date) >= ? and Date(add_date) <= ? ",array($this->session->userdata("adminid"),$from_date,$to_date));
		return $rsltcredit->row(0)->total;
		
		
	}
}