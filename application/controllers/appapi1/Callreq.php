<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Callreq extends CI_Controller {
	
	
	
	
	public function index() 
	{



		if(isset($_GET['mobile']) && isset($_GET['EmailId'])  && isset($_GET['Name']))
		{
			$mobile = $_GET['mobile'];
			$EmailId =  $_GET['EmailId'];
			$Name =  $_GET['Name'];
	
		
			if(ctype_digit($mobile))
			{
				if(strlen($mobile) == 10)
				{
					$parent_id = 10;
					$distributer_name = $Name;
					$postal_address = "";
					$pincode = "";
					
					$contact_person = $Name;
					$mobile_no = $mobile;
					$landline = $retailer_type_id =0;
					$emailid = $EmailId;
					$usertype_name = "Agent";
					$status = 1;
					$state_id=$city_id = 0;
					$working_limit = 0;
					$username =$mobile;
                    $password = $this->common->GetPassword();
					$AIR=$MOBILE=$DTH=$GPRS=$SMS=$WEB="yes";
					
					 $gst = $downline_scheme = $downline_scheme2 = 0;

					 $aadhar = $pan = $gst = "";
					  $this->load->model("Service_model");
		            $service_rslt = $this->Service_model->getServices();
		            foreach($service_rslt->result() as $ser)
		            {
		                $service_array[$ser->service_name] = "on";
		            }
		            
					
                        $response = $this->Insert_model->tblusers_registration_Entry($parent_id,$Name,$postal_address,$pincode,$state_id,$city_id,$contact_person,$mobile_no,$emailid,$usertype_name,$status,$scheme_id,$username,$password,$aadhar,$pan,$gst,$downline_scheme,$downline_scheme2,$bdate,$service_array);
						echo $response;exit;
                        
				}
				else
				{
					$resparr = array(
						"message"=>"Please Enter 10 Digit Mobile Number",
						"status"=>1
						);
						echo json_encode($resparr);
				}
			}
			else
			{
				$resparr = array(
						"message"=>"Invalid Mobile Number",
						"status"=>1
						);
						echo  json_encode($resparr);
			}
		
	
		}

















	    if(isset($_GET['username']) && isset($_GET['pwd']))
			{
				$username = $_GET['username'];
				$pwd =  $_GET['pwd'];
			
			}
			else if(isset($_POST['username']) && isset($_POST['pwd'])  )
			{
				$username = $_POST['username'];
				$pwd =  $_POST['pwd'];
			
			}
			else
			{echo 'Paramenter is missing';exit;}			
	
			
			$host_id = $this->Common_methods->getHostId($this->white->getDomainName());
			$user_info = $this->db->query("select user_id,businessname,mobile_no from tblusers where username = ?  and password = ? and host_id = ?",array($username,$pwd,$host_id));
			if($user_info->num_rows() == 1)
			{
			    
			    
			    $checkcallreq = $this->db->query("select count(Id) as total from callreq where user_id = ? and status = 'PENDING'",array($user_info->row(0)->user_id));
			    if($checkcallreq->row(0)->total > 0)
			    {
			            $resparray = array(
        				'status'=>1,
        				'message'=>'Your Call Request Already Exist In The System. Our Customer Care Executive Contact You Shortly'
        				);
        			echo json_encode($resparray);exit;   
			    }
			    else
			    {
			        $this->db->query("insert into callreq(user_id,add_date,ipaddress,status) values(?,?,?,?)",array($user_info->row(0)->user_id,$this->common->getDate(),$this->common->getRealIpAddr(),"PENDING"));
    				$this->db->query("insert into tblnotification(title,message,messagefor,add_date,ipaddress,host_id) values(?,?,?,?,?,?)",array("CALL ME",$user_info->row(0)->businessname."  Mobile : ".$user_info->row(0)->mobile_no,"Admin",$this->common->getDate(),$this->common->getRealIpAddr(),$host_id));
    				$resparray = array(
        				'status'=>0,
        				'message'=>'Call Request Received Successfully'
        				);
        			echo json_encode($resparray);exit;   
			    }	
			}
			else
			{
				$resparray = array(
				'status'=>1,
				'message'=>'Unauthorised Access'
				);
				echo json_encode($resparray);exit;
			}
	
	
	}
	

}