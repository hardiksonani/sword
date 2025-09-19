<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Commission_settings extends CI_Controller {
	
	
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
        $this->load->model("Commission");	
        // error_reporting(-1);
        // ini_set('display_errors',1);
        // $this->db->db_debug = TRUE;
        		
    }
	public function pageview()
	{ 
		$rslt = $this->db->query("select company_id,company_name from tblcompany");
		$this->view_data['result_company'] = $rslt;
		$this->view_data['message'] =$this->msg;
		$this->load->view('_Admin/groupapi_view',$this->view_data);		
	}
	
	

	public function index() 
	{
	    
	    if(isset($_GET["act"]) and isset($_GET["id"]))
	    {
	        $group_id = intval(trim($_GET["id"]));
	        $group_info = $this->db->query("select * from tblgroup where Id = ?",array($group_id));
	        $data_array = array();
    	    $service_array = array();
    	    $operator_rslt = $this->db->query("
    	    select 
    	    a.company_id,
    	    a.company_name,
    	    a.mcode,
    	    a.service_id,
    	    b.service_name,
    	    IFNULL(g.commission,0.00) as commission,
    	    g.commission_type,
    	    g.commission_slab
    	    from tblcompany a 
    	    left join tblservice b on a.service_id = b.service_id 
    	    left join tblgroupapi g on g.group_id = ? and a.company_id = g.company_id
    	    
    	    order by service_id,a.company_name",array($group_id));
    	    foreach($operator_rslt->result() as $rw)
    	    {
    	        if(!isset($data_array[$rw->service_name]))
    	        {
    	             $data_array[$rw->service_name] = array();
    	        }
    	       
    	        array_push( $service_array,$rw->service_name);
    	        array_push( $data_array[$rw->service_name],$rw);
    	       // $data_array[$rw->service_name][$rw->company_id] = $rw;
    	    }
    	    $service_array = array_unique($service_array);
    	    
    	    //print_r($data_array);exit;
    	    $this->view_data["data"]  = $data_array;
    	     $this->view_data["group_info"]  = $group_info;
    	    $this->view_data["group_id"]  = $group_id;
    	     $this->view_data["service_array"]  = $service_array;
    		$this->load->view("_Admin/commission_settings_view",$this->view_data);	
	    }
	    else if(isset($_POST["btnsearch"]))
	    {
	       $ddlgroup = intval($this->input->post("ddlgroup"));
	       if($ddlgroup > 0)
	       {
	            $data_array = array();
        	    $service_array = array();
        	    $operator_rslt = $this->db->query("select a.company_id,a.company_name,a.mcode,a.service_id,b.service_name from tblcompany a left join tblservice b on a.service_id = b.service_id order by service_id");
        	    foreach($operator_rslt->result() as $rw)
        	    {
        	        if(!isset($data_array[$rw->service_name]))
        	        {
        	             $data_array[$rw->service_name] = array();
        	        }
        	       
        	        array_push( $service_array,$rw->service_name);
        	        array_push( $data_array[$rw->service_name],$rw);
        	       // $data_array[$rw->service_name][$rw->company_id] = $rw;
        	    }
        	    $service_array = array_unique($service_array);
        	    
        	    //print_r($data_array);exit;
        	    $this->view_data["data"]  = $data_array;
        	     $this->view_data["service_array"]  = $service_array;
        		$this->load->view("_Admin/commission_settings_view",$this->view_data);	
	       }
	       else
	       {
	            $data_array = array();
        	    $service_array = array();
        	    $operator_rslt = $this->db->query("select a.company_id,a.company_name,a.mcode,a.service_id,b.service_name from tblcompany a left join tblservice b on a.service_id = b.service_id order by service_id");
        	    foreach($operator_rslt->result() as $rw)
        	    {
        	        if(!isset($data_array[$rw->service_name]))
        	        {
        	             $data_array[$rw->service_name] = array();
        	        }
        	       
        	        array_push( $service_array,$rw->service_name);
        	        array_push( $data_array[$rw->service_name],$rw);
        	       // $data_array[$rw->service_name][$rw->company_id] = $rw;
        	    }
        	    $service_array = array_unique($service_array);
        	    
        	    //print_r($data_array);exit;
        	    $this->view_data["data"]  = $data_array;
        	     $this->view_data["service_array"]  = $service_array;
        		$this->load->view("_Admin/commission_settings_view",$this->view_data);	
	       }
	       
	    }
	    else
	    {
	        $data_array = array();
    	    $service_array = array();
    	    $operator_rslt = $this->db->query("
    	    select 
    	    a.company_id,
    	    a.company_name,
    	    a.mcode,
    	    a.service_id,
    	    b.service_name,
    	    g.commission,
    	    g.commission_type,
    	    g.commission_slab
    	    from tblcompany a 
    	    left join tblservice b on a.service_id = b.service_id 
    	    left join tblgroupapi g on g.Id = ? and a.company_id = g.company_id
    	    order by service_id",array());
    	    foreach($operator_rslt->result() as $rw)
    	    {
    	        if(!isset($data_array[$rw->service_name]))
    	        {
    	             $data_array[$rw->service_name] = array();
    	        }
    	       
    	        array_push( $service_array,$rw->service_name);
    	        array_push( $data_array[$rw->service_name],$rw);
    	       // $data_array[$rw->service_name][$rw->company_id] = $rw;
    	    }
    	    $service_array = array_unique($service_array);
    	    
    	    //print_r($data_array);exit;
    	    $this->view_data["data"]  = $data_array;
    	     $this->view_data["service_array"]  = $service_array;
    		$this->load->view("_Admin/commission_settings_view",$this->view_data);	
	    }
	   
	}
	function ChangeCommission()
	{
		

		$objarray = $_POST["params"];
	    $group_id =  intval($_POST["group_id"]);
	    $groupinfo = $this->db->query("select * from tblgroup where Id = ?",array($group_id));
		if($groupinfo->num_rows() == 1)
		{
		    $company_rslt = $this->db->query("select company_id,company_name from tblcompany order by company_name");
    		foreach($company_rslt->result() as $rwcomp)
    		{
    		    $company_id = $rwcomp->company_id;
    		    if(isset($objarray[$rwcomp->company_id]))
    		    {
    		        $paramrslt = $objarray[$rwcomp->company_id];
    		       if( preg_match('/@/',$paramrslt) == 1)
    		       {
    		           $param_arr = explode("@",$paramrslt);
    		           if(count($param_arr) == 3)
    		           {
    		              $commission =  floatval($param_arr[0]);
    		              $commission_type =  $param_arr[1];
    		              $commission_slab =  intval($param_arr[2]);
    		              $rslt = $this->db->query("select * from tblgroupapi where group_id = $group_id and company_id = $company_id");
        				if($rslt->num_rows() > 0)
        				{
                            $insertgroupapi = $this->db->query("update tblgroupapi set commission=?,commission_type=?,commission_slab = ? where group_id = ? and company_id = ?",array($commission,$commission_type, $commission_slab,$group_id,$company_id));
        				}
        				else
        				{
        					$this->db->query("delete from tblgroupapi  where group_id = $group_id and company_id = $company_id");
        					$this->db->query("insert into tblgroupapi(company_id,commission,commission_type,commission_slab,group_id,add_date,ipaddress) values(?,?,?,?,?,?,?)",array($company_id,$commission_type,$commission_type, $commission_slab,$group_id,$this->common->getDate(),$this->common->getRealIpAddr()));
        				}	
    		              
    		           }
    		       }
    		    }
    		}
		}
		
        echo "Commission Set Successfully";exit;
	}
	public function changecommissionodl()
	{
		$comm = $_GET["com"];
		$mincom = $_GET["mincom"];
		$maxcom = $_GET["maxcom"];
		$comtype = $_GET["comtype"];
		$group_id = $_GET["groupid"];
		$company_id = $_GET["company_id"];
		$rslt = $this->db->query("select * from tblgroupapi where group_id = $group_id and company_id = $company_id");
		if($rslt->num_rows() > 0)
		{
			
			$insertgroupapi = $this->db->query("update tblgroupapi set commission=?,min_com_limit = ?,max_com_limit = ?,commission_type=? where group_id = ? and company_id = ?",array($comm,$mincom,$maxcom,$comtype,$group_id,$company_id));
			
			echo true;
		}
		else
		{
			$this->db->query("delete from tblgroupapi  where group_id = $group_id and company_id = $company_id");
			$this->db->query("insert into tblgroupapi(company_id,commission,min_com_limit,max_com_limit,commission_type,group_id,add_date,ipaddress) values(?,?,?,?,?,?,?,?)",array($company_id,$comm,$mincom,$maxcom,$comtype,$group_id,$this->common->getDate(),$this->common->getRealIpAddr()));
			echo true;
		}
		
	}
	public function changeapi()
	{
		$company_id = $_GET["company_id"];
		$api_id = $_GET["api_id"];
		$group_id = $_GET["group_id"];
		$rslt = $this->db->query("select * from tblgroupapi where group_id = $group_id and company_id = $company_id");
		if($rslt->num_rows() > 0)
		{
			$str_qry ="update tblgroupapi set api_id=? where group_id = $group_id and company_id = ?";
			$insertgroupapi = $this->db->query($str_qry,array($api_id,$company_id));
			echo true;
		}
		
	}
	private function changeusercommission($group_id,$commission,$company_id)
	{
	
			
			$rsltusers = $this->db->query("select user_id from tblusers where scheme_id = ?",array($group_id));
			foreach($rsltusers->result() as $user)
			{
				$check_rslt = $this->db->query("select * from tbluser_commission where user_id = ? and company_id = ?",array($user->user_id, $company_id));
				if($check_rslt->num_rows()  == 1)
				{
				
					$rslt = $this->db->query("update tbluser_commission set commission = ? where Id = ?",array($commission,$check_rslt->row(0)->Id));
				}
				else
				{
					$this->db->query("delete from tbluser_commission where user_id = ? and company_id = ?",array($user->user_id, $company_id));
					$add_date = $this->common->getDate();
					$str_qry = "insert into tbluser_commission(user_id,company_id,commission,add_date) values( ? , ?, ? , ?)";
					$rslt_in = $this->db->query($str_qry,array($user->user_id,$company_id,$commission,$add_date));
				}	
			}	
		}
	
	
}