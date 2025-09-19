<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Purchase_report extends CI_Controller {
	
	
	private $msg='';
	function __construct()
    {
        parent:: __construct();
        $this->is_logged_in();
        $this->clear_cache();
    }
	function is_logged_in() 
    {
	 	if ($this->session->userdata('ausertype') != "Admin") 
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
				$ddldb = $this->input->post("ddldb",TRUE);
				$ddlpaymenttype = $this->input->post("ddlpaymenttype",TRUE);
				//echo $ddlpaymenttype;exit;
				$user_id = 1;
				$this->view_data['pagination'] = NULL;
				
				$this->view_data['result_mdealer'] = $this->AccountLedger_getReport(1,$from_date,$to_date,$ddlpaymenttype,$ddldb);
				$this->view_data['message'] =$this->msg;
				
			
				
				$this->view_data['totalcredit'] =$this->gettotalcredit($user_id,$from_date,$to_date,$ddldb);
				$this->view_data['totaldebit'] =$this->gettotaldebit($user_id,$from_date,$to_date,$ddldb);
				$this->view_data['from_date']  = $from_date;
				$this->view_data['to_date']  = $to_date;
				$this->view_data['ddldb']  = $ddldb;
				$this->view_data['ddlpaymenttype']  = $ddlpaymenttype;
				$this->load->view('_Admin/account_report_view',$this->view_data);		
			}					
			else
			{
				$user=$this->session->userdata('ausertype');
				if(trim($user) == 'Admin' or trim($user) == 'EMP')
				{
					
					$this->view_data['ddldb']  = "LIVE";
					$this->view_data['ddlpaymenttype']  = "ALL";
					$this->load->view('_Admin/Purchase_report_view',$this->view_data);	
				}
				else
				{redirect(base_url().'login');}																								
			}
		} 
	}
	public function getDatea()
	{
		error_reporting(-1);
		ini_set('display_errors',1);
		$this->db->db_debug = TRUE;
		if(isset($_POST["pdate"]) and isset($_POST["api"]))
		{
			$pdate = trim($this->input->post("pdate"));
			$api = trim($this->input->post("api"));
			
			//echo $api."<br>";


			//api opening balance calculation
			$opening_balnace = 0;
			$rsltapi_Opening = $this->db->query("SELECT * FROM `tblapibalance_log`  where api_id = ? and Date(add_date) < ? order by Id desc limit 1",array($api,$pdate));
			if($rsltapi_Opening->num_rows() == 1)
			{
				$opening_balnace = $rsltapi_Opening->row(0)->balance;
			}
			//echo "Opening Balance : ".$opening_balnace."<br>";



			//api Clossing balance calculation
			$clossing_balnace = 0;
			$rsltapi_Clossing = $this->db->query("SELECT * FROM `tblapibalance_log`  where api_id = ? and Date(add_date) <= ? order by Id desc limit 1",array($api,$pdate));
			if($rsltapi_Clossing->num_rows() == 1)
			{
				$clossing_balnace = $rsltapi_Clossing->row(0)->balance;
			}
			//echo "Clossing Balance : ".$clossing_balnace."<br>";



			$totalRecharge = 0;
			$totalAdminComm = 0;

			
			//api total recharge and commission
			$recharge_rslt = $this->db->query("select IFNULL(Sum(amount),0) as total,IFNULL(Sum(AdminComm),0) as AdminComm from tblrecharge where recharge_status = 'Success' and Date(add_date) = ? and ExecuteBy = (select api_name from api_configuration where Id = ?)",array($pdate,intval($api)));

			//print_r($recharge_rslt->result());

			if($recharge_rslt->num_rows() == 1)
			{
				$totalRecharge = $recharge_rslt->row(0)->total;
				$totalAdminComm = $recharge_rslt->row(0)->AdminComm;
			}
			//echo "Total Recharge : ".$totalRecharge."<br>";
			//echo "Admin Comm : ".$totalAdminComm."<br>";
			$resp_array = array(
				"Date"=>$pdate,
				"Opening"=>$opening_balnace,
				"Purchase"=>"",
				"Recharge"=>$totalRecharge,
				"Commission"=>$totalAdminComm,
				"Clossing"=>$clossing_balnace,
			);
			echo json_encode($resp_array);exit;
		}
	}
}