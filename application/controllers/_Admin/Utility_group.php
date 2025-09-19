<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Utility_group extends CI_Controller {
	
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
	private $msg='';

	public function pageview()
	{
		
		$start_row = $this->uri->segment(3);
		$per_page = $this->common_value->getPerPage();
		if(trim($start_row) == ""){$start_row = 0;}
		$result = $this->db->query("select count(Id) as total from utility_group");
		$total_row = $result->row(0)->total;		
		$this->load->library('pagination');
		$config['base_url'] = base_url()."_Admin/Utility_group/pageview";
		$config['total_rows'] = $total_row;
		$config['per_page'] = $per_page; 
		$this->pagination->initialize($config); 
		$this->view_data['pagination'] = $this->pagination->create_links();
		$this->view_data['result_group'] = $this->db->query("select a.* from utility_group a  order by a.Name limit ?,?",array($start_row,$per_page));
		$this->view_data['message'] =$this->msg;
		$this->load->view('_Admin/Utility_group_view',$this->view_data);		
	}
	
	public function index() 
	{
				$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
$this->output->set_header("Pragma: no-cache"); 

		if ($this->session->userdata('ausertype') != "Admin") 
		{ 
			redirect(base_url().'login'); 
		} 
		else 
		{ 
			$data['message']='';		
		//	print_r($this->input->post());exit;
			if($this->input->post("HIDACTION") == "INSERT")
			{
				$GroupName = $this->input->post("txtGroupName",TRUE);
				$ipaddress = $this->common->getRealIpAddr();
				$add_date = $this->common->getDate();
				$check = $this->db->query("select * from utility_group where Name = ? ",array($GroupName));
				if($check->num_rows() < 1)
				{
					$this->db->query("insert into utility_group(Name,add_date,ipaddress ) values(?,?,?)",array($GroupName,$add_date,$ipaddress));
				}
				
				
				
				$this->pageview();
			}
			else if($this->input->post("HIDACTION") == "UPDATE")
			{
				$hidPrimaryId = $this->input->post("hidPrimaryId",TRUE);
				$GroupName = $this->input->post("txtGroupName",TRUE);
				$add_date = $this->common->getDate();
				$check = $this->db->query("select * from utility_group where Id = ? ",array($hidPrimaryId));
				if($check->num_rows() == 1)
				{
					$this->db->query("update utility_group set Name = ? where Id = ?",array($GroupName,$hidPrimaryId));
				}
				$this->pageview();
			}
			else if($this->input->post("HIDACTION") == "DELETE")
			{
			    $hidPrimaryId = $this->input->post("hidPrimaryId",TRUE);
				$GroupName = $this->input->post("txtGroupName",TRUE);
				
				$add_date = $this->common->getDate();
				$check = $this->db->query("select * from utility_group where Id = ?",array($hidPrimaryId));
				if($check->num_rows() == 1)
				{
					$this->db->query("delete from utility_group where Id = ?",array($hidPrimaryId));
				}
				
				
				
				$this->pageview();
			}
			else
			{
				
				$this->pageview();
			}
		} 
	}	
	public function  togglegroup()
	{
		if(isset($_GET["id"]) and isset($_GET["sts"]))
		{
			$id = trim($_GET["id"]);
			$sts = trim($_GET["sts"]);
			$this->db->query("update utility_group set service=? where Id = ?",array($sts,$id));
			echo "Success";exit;
		}
	}
}