<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mt_commission_slab extends CI_Controller {
	
	
	private $msg='';
	
	
	public function index() 
	{
				$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
$this->output->set_header("Pragma: no-cache"); 

		if ($this->session->userdata('aloggedin') != TRUE) 
		{ 
			redirect(base_url().'adminlogin'); 
		}				
		else 		
		{
		
			$data['message']='';				
			if($this->input->post("btnSubmit") == "Submit")
			{
				$group_id = $this->Common_methods->decrypt($this->input->post("hidgroupid",TRUE));
				$AmountFrom = $this->input->post("txtAmountFrom",TRUE);
				$AmountTo = $this->input->post("txtAmountTo",TRUE);
				$Commission = $this->input->post("txtCommission",TRUE);				
				$com_isper = $this->input->post("ddlcom_isper",TRUE);
				$RetOnScharge= $this->input->post("txtRetOnScharge",TRUE);	
				$ROS_Type= $this->input->post("ddlROS_Type",TRUE);	
				$tds = $this->input->post("txtTds",TRUE);	
				$gst = $this->input->post("txtGst",TRUE);	
				
				
				
				$checkgroup = $this->db->query("select * from  mt3_group where Id = ?",array($group_id));
				if($checkgroup->num_rows() == 1)
				{
					$rsltresult = $this->db->query("select * from mt_commission_slabs where range_from = ? and range_to = ? and group_id = ?",array($AmountFrom,$AmountTo,$group_id ));
					if($rsltresult->num_rows() == 0)
					{
						$this->db->query("insert into mt_commission_slabs(group_id,range_from,range_to,charge_amount,add_date,ipaddress,charge_type,cashback,cashback_type,tds,gst) values(?,?,?,?,?,?,?,?,?,?,?)",
						array($group_id,$AmountFrom,$AmountTo,$Commission ,$this->common->getDate(),$this->common->getRealIpAddr(),$com_isper,$RetOnScharge,$ROS_Type,$tds,$gst));
					}
					redirect(base_url()."_Admin/mt_commission_slab?crypt1=".$this->input->post("hidgroupname")."&crypt2=".$this->input->post("hidgroupid"));	
				}
				
				
				
			}
			else if($this->input->post("btnSubmit") == "Update")
			{
			    
			    $slab_id = $this->input->post("hidSlabId",TRUE);
				$group_id = $this->Common_methods->decrypt($this->input->post("hidgroupid",TRUE));
				$AmountFrom = $this->input->post("txtAmountFrom",TRUE);
				$AmountTo = $this->input->post("txtAmountTo",TRUE);
				$Commission = $this->input->post("txtCommission",TRUE);				
				$com_isper = $this->input->post("ddlcom_isper",TRUE);
				$RetOnScharge= $this->input->post("txtRetOnScharge",TRUE);	
				$ROS_Type= $this->input->post("ddlROS_Type",TRUE);	
				$tds = $this->input->post("txtTds",TRUE);	
				$gst = $this->input->post("txtGst",TRUE);	
				
				$checkgroup = $this->db->query("select * from  mt_commission_slabs where Id = ?",array($slab_id));
				if($checkgroup->num_rows() == 1)
				{
				    $this->db->query("
				            update 
				                mt_commission_slabs set range_from=?,range_to=?,charge_type=?,
				                charge_amount=?,edit_date=?,cashback=?,cashback_type = ?,tds=?,gst=? where Id = ?",
				                array($AmountFrom,$AmountFrom,$com_isper,$Commission,$this->common->getDate(),
				                $RetOnScharge,$ROS_Type ,$tds,
				                $gst,
				                $slab_id
				                ));
					redirect(base_url()."_Admin/mt_commission_slab?crypt1=".$this->input->post("hidgroupname")."&crypt2=".$this->input->post("hidgroupid"));	
				}
				
			}
			else if( $this->input->post("hidValue") && $this->input->post("action") ) 
			{	
				$Id = $this->input->post("hidValue",TRUE);
				$this->db->query("delete from mt_commission_slabs where Id = ?",array($Id));	
				redirect(base_url()."_Admin/mt_commission_slab?crypt1=".$this->input->post("hidgroupname")."&crypt2=".$this->input->post("hidgroupid"));	
			}
			else
			{
				if(isset($_GET["crypt1"]) and isset($_GET["crypt2"]))
				{
					$user=$this->session->userdata('ausertype');
					if(trim($user) == 'Admin')
					{
					    $slabgroup_id = $this->Common_methods->decrypt($this->input->get("crypt2"));
					    $rslt_slabgroup = $this->db->query("select * from mt3_group where Id = ?",array($slabgroup_id));
					    if($rslt_slabgroup->num_rows() == 1)
					    {
					        $this->view_data['result_slabs'] = $this->db->query("select a.*,b.Name from mt_commission_slabs a left join mt3_group b on a.group_id = b.Id where a.group_id = ? order by a.range_from",array($this->Common_methods->decrypt($this->input->get("crypt2"))));
    					    $this->view_data['slab_result'] = $rslt_slabgroup;
    						$this->view_data['message'] =$this->msg;
    						$this->load->view('_Admin/mt_margin_slabs_view',$this->view_data);	
					    }
					   	
					}
					else
					{redirect(base_url().'adminlogin');}																					
				}
				else
				{
					redirect(base_url()."_Admin/dmr_margin_slab?crypt=".$this->Common_methods->encrypt("MyData"));
				}
					
			}
		
		} 
	}
}