<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Groupapi_utility extends CI_Controller {
	
	
	private $msg='';
	function __construct()
    { 
        parent:: __construct();
        $this->is_logged_in();
        $this->clear_cache();
    }
	function is_logged_in() 
    {

       if($this->session->userdata('aloggedin') != TRUE) 
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
	public function pageview()
	{ 
		$rslt = $this->db->query("select service_id,company_name from tblcompany");
		$this->view_data['result_company'] = $rslt;
		$this->view_data['message'] =$this->msg;
		$this->load->view('_Admin/groupapi_utility_view',$this->view_data);		
	}
	
	
	public function getresult()
	{
		$group_id = $_GET["groupid"];
		//$userinfo = $this->Userinfo_methods->getUserInfo($group_id);
		$group_info = $this->db->query("select * from utility_group where Id = ?",array($group_id));
		$str = '<div>Commission Structure of '.$group_info->row(0)->Name.'</div><input type="hidden" id="uid" name="uid" value="'.$group_id.'"><table class="table table-striped table-bordered bootstrap-datatable datatable responsive" >
				<tr>  
				<th>Sr No.</th>
				<th>Service Name</th>
				<th>Sd Commission</th>
				<th>Md Commission</th>
				<th>Dist Commission</th>
				<th>Retailer Commission</th>
				<th>Commission Type</th>
				<th></th>
				</tr>';
    	$i = 0;
		$result_company = $this->db->query("select * from tblservice where service_id > 2 order by service_id");
		foreach($result_company->result() as $row) 	
		{
		
					$rslt  = $this->db->query("select * from tblutilitycommission where group_id = ? and service_id = ?",array($group_id,$row->service_id));
				
				if($i % 2 == 0)
				{
					$str .='<tr class="row1">';
				}
				else
				{
					$str .='<tr class="row2">';
				}
					$str.='
			
					<td >'.$i.'</td>
					<td >'.$row->service_name.'</td>';
					
					
					
					
					if($rslt->num_rows() > 0)
					{
							$str.= '<td >';
							$str.= '<input style="width:150px;" class="form-control" type="text" width="30" id="txtSdComm'.$row->service_id.'" name="txtSdComm'.$row->service_id.'" value="'.$rslt->row(0)->SdComm.'"/>';
							$str.= '</td>';
							$str.= '<td >';
							$str.= '<input style="width:150px;" class="form-control" type="text" width="30" id="txtMdComm'.$row->service_id.'" name="txtMdComm'.$row->service_id.'" value="'.$rslt->row(0)->MdComm.'"/>';
							$str.= '</td>';
							$str.= '<td >';
							$str.= '<input style="width:150px;" class="form-control" type="text" width="30" id="txtDComm'.$row->service_id.'" name="txtDComm'.$row->service_id.'" value="'.$rslt->row(0)->DComm.'"/>';
							$str.= '</td>';
							$str.= '<td >';
							$str.= '<input style="width:150px;" class="form-control" type="text" width="30" id="txtRComm'.$row->service_id.'" name="txtRComm'.$row->service_id.'" value="'.$rslt->row(0)->RComm.'"/>';
							$str.= '</td>';
							$str.= '<td>';
							if($rslt->row(0)->commission_type == "PER")
							{
								$str.= '<select id="ddlcommission_type'.$row->service_id.'" name="ddlcommission_type'.$row->service_id.'" class="form-control" >
								<option value="PER">Percentage</option>
								<option value="AMOUNT">Amount</option>';
								$str.= '</select>';
							}
							else
							{
								$str.= '<select id="ddlcommission_type'.$row->service_id.'" name="ddlcommission_type'.$row->service_id.'" class="form-control" >
								<option value="AMOUNT">Amount</option>
								<option value="PER">Percentage</option>';
								$str.= '</select>';
							}
							$str.= '</td>';
					}
					else
					{
						$str.= '<td >';
						$str.= '<input style="width:150px;" class="form-control" type="text" width="30" id="txtSdComm'.$row->service_id.'" name="txtSdComm'.$row->service_id.'">';
						$str.= '</td>';
						$str.= '<td >';
						$str.= '<input style="width:150px;" class="form-control" type="text" width="30" id="txtMdComm'.$row->service_id.'" name="txtMdComm'.$row->service_id.'">';
						$str.= '</td>';
						$str.= '<td >';
						$str.= '<input style="width:150px;" class="form-control" type="text" width="30" id="txtDComm'.$row->service_id.'" name="txtDComm'.$row->service_id.'">';
						$str.= '</td>';
						$str.= '<td >';
						$str.= '<input style="width:150px;" class="form-control" type="text" width="30" id="txtRComm'.$row->service_id.'" name="txtRComm'.$row->service_id.'">';
						$str.= '</td>';
						
						$str.= '<td>';
							
						$str.= '<select id="ddlcommission_type'.$row->service_id.'" name="ddlcommission_type'.$row->service_id.'" class="form-control" >
						<option value="PER">Percentage</option>
						<option value="AMOUNT">Amount</option>';
						$str.= '</select>';
							
							$str.= '</td>';
						
					}
					$str.='
					<td ><input class="btn btn-primary" type="button" id="btnsubmit" name="btnsubmit" value="Submit" onclick="changecommission('.$row->service_id.',\''.$group_id.'\')"/></td>
					</tr>
					';
					$i++;
				
		} 
       $str.='</table>';
				echo $str;
	}
	public function index() 
	{
					$this->pageview();		
	}
	public function changecommission()
	{
		error_reporting(-1);
		ini_set('display_errors',1);
		$this->db->db_debug = TRUE;
		if($this->session->userdata("ausertype") != "Admin")
		{
			"UN Authorized Access";exit;
		}
		
		$SdComm = trim($_GET["SdComm"]);
		$MdComm = trim($_GET["MdComm"]);
		$DComm = trim($_GET["DComm"]);
		$RComm = trim($_GET["RComm"]);
		$comtype = $_GET["comtype"];
		$group_id = $_GET["groupid"];
		$service_id = $_GET["service_id"];
		
		

		
		
		$groupinfo = $this->db->query("select * from utility_group where Id = ?",array($group_id));
		if($groupinfo->num_rows() == 1)
		{
			//	if($maxcom >= 0 and $mincom >= 0)
			if(true)
				{
					
						$rslt = $this->db->query("select * from tblutilitycommission where group_id = $group_id and service_id = $service_id");
						if($rslt->num_rows() > 0)
						{

							$insertgroupapi = $this->db->query("update tblutilitycommission set SdComm=?,MdComm = ?,DComm = ?,RComm = ?,commission_type=? where group_id = ? and service_id = ?",array($SdComm,$MdComm,$DComm,$RComm,$comtype,$group_id,$service_id));

							echo "OK";exit;
						}
						else
						{
							$this->db->query("delete from tblutilitycommission  where group_id = $group_id and service_id = $service_id");
							$this->db->query("insert into tblutilitycommission(service_id,SdComm,MdComm,DComm,RComm,commission_type,group_id,add_date,ipaddress)values(?,?,?,?,?,?,?,?,?)",array($service_id,$SdComm,$MdComm,$DComm,$RComm,$comtype,$group_id,$this->common->getDate(),$this->common->getRealIpAddr()));
							echo "OK";exit;
						}	
				}
				else
				{
					echo "Minus Value Not Allowed";exit;
				}
		}
	}
}