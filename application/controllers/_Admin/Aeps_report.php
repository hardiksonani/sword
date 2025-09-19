<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Aeps_report extends CI_Controller {
  
  
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
        $user_id = 1;
        $this->view_data['pagination'] = NULL;
        
        $this->view_data['result_aeps'] = $this->db->query("SELECT a.*,b.businessname,b.mobile_no,b.username FROM `minkspay_aeps` a left join tblusers b on a.user_id = b.user_id 
where a.RESP_status = 'success' and Date(a.add_date) BETWEEN ? and ? order by a.Id desc",array($from_date,$to_date));
        $this->view_data['message'] =$this->msg;
        
      
        
        $this->view_data['summary'] =$this->getsummary($from_date,$to_date);
       
        $this->view_data['from_date']  = $from_date;
        $this->view_data['to_date']  = $to_date;
        $this->load->view('_Admin/Aeps_report_view',$this->view_data);   
      }         
      else
      {
        $user=$this->session->userdata('ausertype');
        if(trim($user) == 'Admin' or trim($user) == 'EMP')
        {
          $from_date = $this->common->getMySqlDate();
          $to_date = $this->common->getMySqlDate();
          $user_id = 1;
          $this->view_data['pagination'] = NULL;
          
          $this->view_data['result_aeps'] = $this->db->query("SELECT a.*,b.businessname,b.mobile_no,b.username FROM `minkspay_aeps` a left join tblusers b on a.user_id = b.user_id 
  where a.RESP_status = 'success' and Date(a.add_date) BETWEEN ? and ? order by a.Id desc",array($from_date,$to_date));
          $this->view_data['message'] =$this->msg;
          
        
          
          $this->view_data['summary'] =$this->getsummary($from_date,$to_date);
         
          $this->view_data['from_date']  = $from_date;
          $this->view_data['to_date']  = $to_date;
          $this->load->view('_Admin/Aeps_report_view',$this->view_data);  
        }
        else
        {redirect(base_url().'login');}                                               
      }
    } 
  } 
  public function getsummary($from,$to)
  {
    $total_success = 0;
    $total_failure = 0;
    $total_pending = 0;
    
    
    
    
    $rslt = $this->db->query("
    SELECT IFNULL(Sum(amount),0) as totalamount,status FROM minkspay_aeps where type = 'TFR' and Date(add_date) BETWEEN ? and ?  
group by status",array($from,$to));
    
    foreach($rslt->result() as $rw)
    {
      //echo  $rw->Status."  ".$rw->total;exit;
      if($rw->status == "Success" or $rw->status == "SUCCESS")
      {
        $total_success += $rw->totalamount;
      }
      else if($rw->status == "FAILURE" or $rw->status == "Failure" )
      {
        $total_failure += $rw->totalamount;
      }
      else if($rw->status == "PENDING" or $rw->status == "Pending")
      {
        $total_pending += $rw->totalamount;
      }
    }
    //echo $total_success;exit;
    $arr = array(
        "Success"=>$total_success,
        "Failure"=>$total_failure,
        "Pending"=>$total_pending
      );
    return $arr;
  }
  public function dataexport()
  {
     
    if ($this->session->userdata('aloggedin') != TRUE) 
    { 
      echo "session expired"; exit;
    }
    if(isset($_GET["from"]) and isset($_GET["to"]))
    {
      ini_set('memory_limit', '-1');
      $from = trim($_GET["from"]);
      $to = trim($_GET["to"]);
      $db = trim($_GET["db"]);
      
      $data = array();
      
      if($db == "ARCHIVE")
      {
          $str_query = "select 
    
            a.Id,
            a.add_date,
            a.description,
            a.remark,
            a.credit_amount,
            a.debit_amount,
            a.balance,
            a.payment_id,
            a.user_id,
        pay.cr_user_id,
        pay.dr_user_id,
        cr.businessname as cr_businessname,
        cr.username as cr_username,
        cr.usertype_name  as cr_usertype_name,
        dr.businessname as dr_businessname,
        dr.username as dr_username,
        dr.usertype_name  as dr_usertype_name,
        p.businessname as parent_name,
        p.username as parent_username,
        p.mobile_no as parent_mobile,
        p.usertype_name as parent_type
        
            from masterpa_archive.tblewallet a 
            left join tblusers b on a.user_id = b.user_id 
            
            
        left join masterpa_archive.tblpayment pay on a.payment_id = pay.payment_id
        left join tblusers cr on pay.cr_user_id = cr.user_id
        left join tblusers dr on pay.dr_user_id = dr.user_id
        left join tblusers p on cr.parentid = p.user_id
        
        
        
         where 
         Date(a.add_date) >= ? and
         Date(a.add_date) <= ? and
         a.user_id = 1
         order by Id";
            $rslt = $this->db->query($str_query,array($from,$to));
      }
      else
      {
          $str_query = "select 
    
            a.Id,
            a.add_date,
            a.description,
            a.remark,
            a.credit_amount,
            a.debit_amount,
            a.balance,
            a.payment_id,
            a.user_id,
        pay.cr_user_id,
        pay.dr_user_id,
        cr.businessname as cr_businessname,
        cr.username as cr_username,
        cr.usertype_name  as cr_usertype_name,
        dr.businessname as dr_businessname,
        dr.username as dr_username,
        dr.usertype_name  as dr_usertype_name,
        p.businessname as parent_name,
        p.username as parent_username,
        p.mobile_no as parent_mobile,
        p.usertype_name as parent_type
        
            from tblewallet a 
            left join tblusers b on a.user_id = b.user_id 
            
            
        left join tblpayment pay on a.payment_id = pay.payment_id
        left join tblusers cr on pay.cr_user_id = cr.user_id
        left join tblusers dr on pay.dr_user_id = dr.user_id
        left join tblusers p on cr.parentid = p.user_id
        
        
        
         where 
         Date(a.add_date) >= ? and
         Date(a.add_date) <= ? and
         a.user_id = 1
         order by Id";
    $rslt = $this->db->query($str_query,array($from,$to));
      }
      
        
    $i = 0;
    foreach($rslt->result() as $rw)
    {
      $mobile = "";
      $amount = "";
      $description = $rw->description;
      if (preg_match('/Refund :/',$rw->description) == 1 ) 
      {
          //Refund : Mobile : 7354585761 Amount : 49 | Revert Date = 202
        $company_name = "";
        $mobile = $this->get_string_between($description, "Mobile : ", " Amount");
        $amount = $this->get_string_between($description, "Amount : ", " | Revert");
      }
      else if ($rw->transaction_type == "Recharge" ) 
      {
          //Vodafone | 7354585761 | 49 | Id = 314590
        $recarr = explode("|", $description);
        $company_name =  $recarr[0];
        $mobile = $recarr[1];
        $amount = $recarr[2];
      }
      
      $temparray = array(
      
                  "Sr" =>  $i, 
                  "payment_id" => $rw->payment_id, 
                  "add_date" => $rw->add_date, 
                  "payment_from" =>$rw->dr_businessname, 
                  "payment_from_UserId" =>$rw->dr_username, 
                
                  "blank"=>"",
                  "payment_to" =>$rw->cr_businessname, 
                  "payment_to_UserId" =>$rw->cr_username, 
                  "payment_to_UserType" =>$rw->cr_usertype_name, 
                    
                  "ParentName" =>$rw->parent_name, 
                  "ParentId" =>$rw->parent_username, 
                  "ParentMobile" =>$rw->parent_mobile,
                  "ParentType" =>$rw->parent_type,  
                    
                  
                  "blank2"=>"",
                  "OperatorName" =>$company_name,   
                  "Mobile_Number" =>$mobile,  
                  "Amount" =>$amount,   
                  "CreditAmount" => $rw->credit_amount, 
                  "DebitAmount" =>$rw->debit_amount, 
                  "Balance" =>$rw->balance, 
                  "Description" =>$rw->description, 
                  "Remark" =>$rw->remark,
                  
                );
          
          
          
          array_push( $data,$temparray);
          $i++;
  }
  function filterData(&$str)
    {
        $str = preg_replace("/\t/", "\\t", $str);
        $str = preg_replace("/\r?\n/", "\\n", $str);
        if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
    }
    
    // file name for download
    $fileName = "Account Ledger Report From ".$from." To  ".$to.".xls";
    
    // headers for download
    header("Content-Disposition: attachment; filename=\"$fileName\"");
    header("Content-Type: application/vnd.ms-excel");
    
    $flag = false;
    foreach($data as $row) {
        if(!$flag) {
            // display column names as first row
            echo implode("\t", array_keys($row)) . "\n";
            $flag = true;
        }
        // filter data
        array_walk($row, 'filterData');
        echo implode("\t", array_values($row)) . "\n";
    }
    
    exit;       
    }
    else
    {
      echo "parameter missing";exit;
    }
  }
  
}