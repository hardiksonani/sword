<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Dashboard extends CI_Controller 
{
        
    private $msg='';
	function __construct()
    {
        parent:: __construct();
        $this->is_logged_in();
        $this->clear_cache();
    }
	function is_logged_in() 
    {
	 	if ($this->session->userdata('ApiUserType') != "APIUSER") { 
			redirect(base_url().'login?crypt='.$this->Common_methods->encrypt("MyData")); 
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
		    		
			
		
			$this->view_data["message"]  = "";	
			$this->view_data["message"]  = ""; 
			$this->load->view("API/Dashboard_view",$this->view_data);
		
		
	}



public function getBalance()
	{		
		
		$balance = $this->Common_methods->getAgentBalance($this->session->userdata("ApiId"));	
		echo $balance;
	}
	public function ShowRetailerprofile1()
	{

		if(isset($_POST["retailerid"]))
		{
			$user_id   = $this->session->userdata("ApiId");

			//echo $this->input->post();exit;

			$retailerid = $this->Common_methods->decrypt(trim($this->input->post("retailerid")));

//echo $retailerid;exit;
			if($retailerid == $user_id)
			{
				$rsltuserinfo = $this->db->query("SELECT a.user_id,a.parentid,a.businessname,a.mobile_no,a.usertype_name,a.add_date,b.emailid,b.postal_address,b.pincode ,a.state_id,a.city_id,
				state.state_name,city.city_name
				FROM 
				tblusers a 
				left join tblusers_info b on a.user_id = b.user_id 
				left join tblstate state on a.state_id = state.state_id
				left join tblcity city on a.city_id = city.city_id
				where a.user_id = ?",array($retailerid));	
				if($rsltuserinfo->num_rows() == 1)
				{
					$businessname = $rsltuserinfo->row(0)->businessname;
					$mobile_no = $rsltuserinfo->row(0)->mobile_no;
					$emailid = $rsltuserinfo->row(0)->emailid;
					$postal_address = $rsltuserinfo->row(0)->postal_address;
					$pincode = $rsltuserinfo->row(0)->pincode;
					$state_id = $rsltuserinfo->row(0)->state_id;
					$city_name = $rsltuserinfo->row(0)->city_name;


					$ersparray = array(
								"RetailerId"=>$retailerid,
								"Frm_Name"=>$businessname,
								"city"=>$city_name,
								"Address"=>$postal_address,
								"Pincode"=>$pincode,
								"State"=>$state_id,
								"District"=>1,
					);
					echo json_encode($ersparray);exit;

				}
			}
			
		}
		$ersparray = array(
								"RetailerId"=>$retailerid,
								"Frm_Name"=>"",
								"city"=>"",
								"Address"=>"",
								"Pincode"=>"",
								"State"=>"",
								"District"=>1,
					);
		echo json_encode($ersparray);exit;	

		

		/*
			{"RetailerId":"c3e92f06-c833-44e6-b3a1-6ede18ec6607","Frm_Name":"RAVIKANT","city":null,"Address":"HIMATNAGAR TA HIMATNAGAR DSABARKANMTHAGDFGDFGDFG","Pincode":0,"State":12,"District":1}
		*/
	}



	public function UpdateRetailerProfile()
	{
		$user_id = $this->session->userdata("ApiId");

		
		$txtCallbackUrl = trim($this->input->post("txtCallbackUrl"));
		$txtIpAddress = trim($this->input->post("txtIpAddress"));
		$txtIpAddress2 = trim($this->input->post("txtIpAddress2"));

		if(true)
		{
			$this->db->query("update tblusers_info set client_ip = ?,client_ip2 = ?,call_back_url = ? where user_id = ?",array($txtIpAddress,$txtIpAddress2,$txtCallbackUrl,$user_id));

		}

	redirect(base_url()."API/profile");
		
	}

	public function AddressFieldcheck()
	{
		/*
		{
			"pancardPath":"\\Retailer_image\\d2caa6e7-4c14-43b3-a94e-89f5f261c8e2_download.jpg",
			"aadharcardPath":"\\Retailer_image\\72fdb1c0-04f8-4094-8700-a92ef7fae928_download.jpg",
			"PSAStatus":"Y",
			"AadhaarStatus":"Y"
		}
		*/



		$rsltuserprofile = $this->db->query("select pancardPath,aadharcardPath,PSAStatus,AadhaarStatus,soapselfiePath,gstcertificatePath,service_agreementPath,AddressProofPath from tblusersprofile where user_id = ?",array($this->session->userdata("ApiId")));
		if($rsltuserprofile->num_rows() == 1)
		{
			$PSAStatus = "N";
			$AadhaarStatus = "N";
			if($rsltuserprofile->row(0)->PSAStatus == "yes")
			{
				$PSAStatus = "Y";
			}
			if($rsltuserprofile->row(0)->aadharcardPath == "yes")
			{
				$AadhaarStatus = "Y";
			}


			$resparray = array(

				"pancardPath"=>$rsltuserprofile->row(0)->pancardPath,
				"aadharcardPath"=>$rsltuserprofile->row(0)->aadharcardPath,
				"PSAStatus"=>$PSAStatus,
				"AadhaarStatus"=>$AadhaarStatus,
			);
			echo json_encode($resparray);exit;
		}
		else
		{
			$resparray = array(

				"pancardPath"=>"",
				"aadharcardPath"=>"",
				"PSAStatus"=>"N",
				"AadhaarStatus"=>"N",
			);
			echo json_encode($resparray);exit;
		}
	}






		public function getTodaysHourSale()
		{
			$user_id = $this->session->userdata("ApiId");
			$hours = '';
			$total = 0;
			$totalcount = 0;
			$totalcharge = 0;
			$dbrslt = $this->db->query("SELECT count(Id) as totalcount,Sum(Amount) as sale,Sum(Charge_Amount) as totalcharge,add_date FROM `mt3_transfer` where Date(add_date) = ? and status = 'SUCCESS' and user_id = ? group by hour(add_date)  order by Id",array($this->common->getMySqlDate(),$user_id));
			foreach($dbrslt->result() as $rw)
			{
				$hours .=$rw->sale.",";
				$total +=floatval($rw->sale);
				$totalcount +=floatval($rw->totalcount);
				$totalcharge += floatval($rw->totalcharge);
			}
			$reaparray = array(
				"hourlysale"=>$hours,
				"totalsale"=>$total,
				"totalcount"=>$totalcount,
				"totalcharge"=>round($totalcharge,2),
			);
			echo json_encode($reaparray);exit;
		}
		public function getSummary()
		{
			$user_id = $this->session->userdata("ApiId");
			$hours = '';
			$totalsuccess = 0;
			$totalpending = 0;
			$totalfailure = 0;
			$dbrslt = $this->db->query("SELECT count(recharge_id) as totalcount,Sum(Amount) as sale,recharge_status as Status,Sum(commission_amount) as totalcommission,add_date FROM `tblrecharge` where Date(add_date) = ?  and user_id = ? group by recharge_status  order by recharge_id",array($this->common->getMySqlDate(),$user_id));
			foreach($dbrslt->result() as $rw)
			{
				if($rw->Status == "Success")
				{
					$totalsuccess += floatval($rw->sale);
				}	
				if($rw->Status == "Failure")
				{
					$totalfailure += floatval($rw->sale);
				}
				if($rw->Status == "Pending")
				{
					$totalpending += floatval($rw->sale);
				}
			}
			$reaparray = array(
				"SUCCESS"=>$totalsuccess,
				"PENDING"=>$totalpending,
				"FAILURE"=>$totalfailure,
				"BALANCE"=>$this->Common_methods->getAgentBalance($user_id)
			);
			echo json_encode($reaparray);exit;
		}
		
		
		public function getLastTransactions()
		{
			$resp = '<table class="table table-bordered table-striped" style="color:#00000E">
              <thead class="thead-colored thead-primary" >
                  <tr class="tx-10">
                    <th class="pd-y-5">RechargeId</th>
					<th class="pd-y-5">DateTime</th>
					<th class="pd-y-5">Operator Name</th>
                    <th class="pd-y-5">Mobile Number</th>
                    <th class="pd-y-5">Amount</th>
					<th class="pd-y-5">Status</th>
					<th class="pd-y-5">Transaction Id</th>
					<th class="pd-y-5"></th>
                  </tr>
                </thead>
                <tbody>';
			$user_id = $this->session->userdata("ApiId");
			$rsltreport = $this->db->query('
				 select Id,number,amount, company_name,status,add_date,mcode,type,transaction_id,operator_id,customer_mobile,customer_name
                from (
                    select  
                        t.recharge_id as Id,t.mobile_no as number,t.amount as amount,
                        t.add_date,t.recharge_status as status, o.company_name,
                        o.mcode,
                        (select "RECHARGE") as type,
                        (select "") as customer_name,
                        (select "") as customer_mobile,
                        t.transaction_id,t.operator_id
                    from (select * from tblrecharge order by recharge_id desc limit 15) t
                    left join tblcompany o on t.company_id = o.company_id
                    where t.user_id = ?  
                    
                
                    union all
                
                    select 
                        bils.Id,bils.service_no as number,bils.bill_amount,
                        bils.add_date,bils.status ,ob.company_name,ob.mcode,
                        (select "BILL") as type,
                        bils.customer_name,
                        bils.customer_mobile,
                        bils.Id as transaction_id,bils.opr_id as operator_id
                    from (select * from tblbills order by Id desc limit 10) bils
                    left join tblcompany ob on bils.company_id = ob.company_id
                    where bils.user_id = ?
                    
                ) t
                order by add_date desc limit 15',array($user_id,$user_id));
			
			
			
			
		/*	$rsltreport = $this->db->query("SELECT a.recharge_id,a.add_date,b.company_name,a.mobile_no,a.amount,a.recharge_status,a.operator_id
                                                        FROM `tblrecharge` a
                                                        left join tblcompany b on a.company_id = b.company_id
                                            where a.user_id = ? order by recharge_id desc limit 10",array($user_id));*/
			foreach($rsltreport->result() as $rw)
			{
			
				if($rw->status == "Success")
				{
					$sclass = "success";
				}
				if($rw->status == "Failure")
				{
					$sclass = "danger";
				}
				if($rw->status == "Pending")
				{
					$sclass = "primary";
				}
				$resp.= '<tr>
                    <td class="pd-l-20">
                      '.$rw->Id.'
                    </td>
					<td class="pd-l-20">
                      '.date_format(date_create($rw->add_date),'d-m-Y h:i:s A').'
                    </td>
					<td class="pd-l-20">
                      '.$rw->company_name.'
                    </td>
                    <td class="pd-l-20" style="min-width:180px;">
                      '.$rw->number.'
                      <br>
                      Cust.Mob '.$rw->customer_mobile.'
                      <br>
                      '.$rw->customer_name.'
                    </td>
                    <td class="pd-l-20">
                      '.$rw->amount.'
                    </td>
                    <td class="pd-l-20">
                      <span class="btn btn-sm btn-'.$sclass.'">'.$rw->status.'</span>
                    </td>
                   
					<td class="tx-12">
						<span style="font-size:16px;">'.$rw->operator_id.'</span>
                    </td>';
                    
                    if($rw->type == "BILL" and ($rw->status == "Success" or $rw->status == "Pending"))
                    {
                        $resp.= '
                        <td class="tx-12">
                        <a class="btn btn-outline-primary" href="'.base_url().'API/print_bill_online_copy?idstr='.$this->Common_methods->encrypt($rw->Id).'&idstr2='.$this->Common_methods->encrypt($rw->user_id).'" target="_blank">Print</a>
                        </td>
                        ';	
                    }
                    
                  $resp.= '</tr>';	
			}
			$resp.= '</table>';
			echo $resp;exit;
		}
		public function getLastTransactions2()
		{
			$resp = '<table class="table table-bordered table-striped" style="color:#00000E">
              <thead class="thead-colored thead-primary" >
                  <tr class="tx-10">
                    <th class="pd-y-5">RechargeId</th>
					<th class="pd-y-5">DateTime</th>
					<th class="pd-y-5">Operator Name</th>
                    <th class="pd-y-5">Mobile Numer</th>
                    <th class="pd-y-5">Amount</th>
					<th class="pd-y-5">Status</th>
					<th class="pd-y-5">Transaction Id</th>
                  </tr>
                </thead>
                <tbody>';
			$user_id = $this->session->userdata("ApiId");
			$rsltreport = $this->db->query("SELECT a.recharge_id,a.add_date,b.company_name,a.mobile_no,a.amount,a.recharge_status,a.operator_id
                                                        FROM `tblrecharge` a
                                                        left join tblcompany b on a.company_id = b.company_id
                                            where a.user_id = ? order by recharge_id desc limit 10",array($user_id));
			foreach($rsltreport->result() as $rw)
			{
			
				if($rw->recharge_status == "Success")
				{
					$sclass = "success";
				}
				if($rw->recharge_status == "Failure")
				{
					$sclass = "danger";
				}
				if($rw->recharge_status == "Pending")
				{
					$sclass = "primary";
				}
				$resp.= '<tr>
                    <td class="pd-l-20">
                      '.$rw->recharge_id.'
                    </td>
					<td class="pd-l-20">
                      '.date_format(date_create($rw->add_date),'d-m-Y h:i:s A').'
                    </td>
					<td class="pd-l-20">
                      '.$rw->company_name.'
                    </td>
                    <td class="pd-l-20">
                      '.$rw->mobile_no.'
                    </td>
                    <td class="pd-l-20">
                      '.$rw->amount.'
                    </td>
                    <td class="pd-l-20">
                      <span class="btn btn-sm btn-'.$sclass.'">'.$rw->recharge_status.'</span>
                    </td>
                   
					<td class="tx-12">
						'.$rw->operator_id.'
                    </td>
                    
                  </tr>';	
			}
			$resp.= '</table>';
			echo $resp;exit;
		}
		
		
		// public function getBalance()
		// {
		// 	echo $this->Common_methods->getAgentBalance($this->session->userdata("ApiId"))."#".$this->Ew2->getAgentBalance($this->session->userdata("ApiId"));
		// }
	}