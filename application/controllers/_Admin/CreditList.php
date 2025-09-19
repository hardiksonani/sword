<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CreditList extends CI_Controller {
	
	
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
        error_reporting(-1);
        ini_set('display_errors',1);
        $this->db->db_debug = TRUE;
    }
	public function index()  
	{
				$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
				$this->output->set_header("Pragma: no-cache"); 

		 	
			$user_id = 1;
			$data_array = array();
			$rslt = $this->db->query("select b.user_id,a.chield_id,b.businessname,b.username,b.usertype_name,b.mobile_no from creditmaster a left join tblusers b on a.chield_id  = b.user_id
				where 
				a.parent_id = ? and a.chield_id != 1 
				group by a.chield_id
				order by b.businessname
				",array($user_id));
			$this->load->model("Credit_master");
			$totalcredit = 0;

			foreach($rslt->result() as $rw)
			{
				$credit = $this->Credit_master->getcredit($user_id,$rw->user_id);
				if($credit != 0)
				{
					$temparray = array(
						"user_id"=>$rw->user_id,
						"businessname"=>$rw->businessname,
						"mobile_no"=>$rw->mobile_no,
						"usertype_name"=>$rw->usertype_name,
						"credit"=>floatval($credit)
					);
					$totalcredit += $credit;
					array_push($data_array,$temparray);	
				}
				
			}
			$this->sortArrayByKey($data_array,"credit",true);
			
			$this->view_data['data_array']  = $data_array;
			$this->view_data['totalcredit']  = $totalcredit;
			$this->load->view('_Admin/CreditList_view',$this->view_data);	
		
		 
	}
	public function sortArrayByKey(&$array,$key,$string = false,$asc = true)
	{
    
        usort($array,function ($a, $b) use(&$key,&$asc)
        {
            if(floatval($a[$key]) == floatval($b{$key}) ){return 0;}
            if($asc) return (floatval($a{$key}) < floatval($b{$key})) ? -1 : 1;
            else     return (floatval($a{$key}) > floatval($b{$key}) ) ? -1 : 1;

        });
    
}
	public function CashReceiveEntry()
	{
		$Amount = floatval(trim($this->input->post("amount")));
		$paymenttype = trim($this->input->post("paymenttype"));
		$Remark = trim($this->input->post("Remark"));
		$user = intval(trim($this->input->post("user")));
		$userinfo = $this->db->query("select * from tblusers where username = ? ",array($user));
		
		if($userinfo->num_rows() == 1)
		{
			$user_id = $userinfo->row(0)->user_id;
			$parentid = 1;

			$credit_amount = 0;
			$creditrevert = 0;

			$payment_received = $Amount;
			$remark = $Remark;
			$transaction_date = $this->common->getMySqlDate();
			$payment_type = $paymenttype;
			$this->load->model("Credit_master");
			$this->Credit_master->credit_entry($parentid,$user_id,$credit_amount,$creditrevert,$payment_received,$remark,$transaction_date,$payment_type);
			echo "DONE";exit;
		}

	}
}