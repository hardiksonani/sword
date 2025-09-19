<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Recharge_home extends CI_Controller 
{
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
		



		ini_set('display_errors',1);
		error_reporting(-1);
		$this->db->debug = TRUE;
    }



 	public function getBalance()
	{		
		
		$balance = $this->Common_methods->getAgentBalance($this->session->userdata("ApiId"));	
		echo $balance;
	}






		public function dispute()
		{
			if(isset($_POST["id"]))
			{
				$user_id = $this->session->userdata("ApiId");
				$recharge_id = intval($this->input->post("id"));
				$hidmsg = "NOT";
				$rsltrecharge = $this->db->query("select recharge_id,add_date from tblrecharge where recharge_id = ? and recharge_status != 'Pending' and user_id = ? ",array($recharge_id,$user_id));
				if($rsltrecharge->num_rows() == 1)
				{
				
				
					$rsltcheckcomplain = $this->db->query("select * from tblcomplain where recharge_id = ? and complain_status = 'Pending'",array($recharge_id));
					if($rsltcheckcomplain->num_rows() == 1)
					{
						echo "Complain Already In Pending Process";exit;
					}
					else
					{
						$txtToDate = date_format(date_create($rsltrecharge->row(0)->add_date),'y-m-d');
					$date = $this->common->getMySqlDate();
					$date1= strtotime($txtToDate);
					$date2= strtotime($date);
					$secs = $date2 - $date1;// == return sec in difference
					$days = $secs / 86400;
				
					
						$this->db->query("insert into tblcomplain(user_id,complain_date,complain_status,message,complain_type,recharge_id) values(?,?,?,?,?,?)",array($user_id,$this->common->getDate(),'Pending',$hidmsg,'Recharge',$recharge_id));
						echo "Complain Submitted Successfully";exit;
					
					}
				}
				else
				{
					echo "Invalid Recharge";exit;
				}
			}
		}


	public function Show_commsion()
	{

		$str = '<table id="showoptcomm" class="table table-striped table-bordered" style="width:100%;border-top: 1px solid #aaa4a4;">
    <tbody><tr class="operator-showoptcomm">
        <th>Operator </th>
        <th>Status </th>
        <th>Offer</th>
    </tr>';

		$scheme_id = $this->session->userdata("AgentSchemeId");

		if(isset($_GET["type"]))
		{
			$type = $this->input->get("type");
			if($type == "Prepaid")
			{
				$service_id = 1;
			}
			else if($type == "DTH")
			{
				$service_id = 2;
			}
			else if($type == "Landline")
			{
				$service_id = 8;
			}
			else if($type == "Electricity")
			{
				$service_id = 16;
			}
			else if($type == "Gas")
			{
				$service_id = 17;
			}
			
			else
			{
				$service_id = 8;
			}



			$mycomm = $this->db->query("
		select 
		    a.company_name,
		    IFNULL(b.commission,0) as commission,
		    CASE b.commission_type
		        WHEN 'PER' THEN '%'
		        WHEN 'AMOUNT' THEN ''
		        END commission_type
		     
		    from tblcompany a 
		    left join tbluser_commission b on a.company_id = b.company_id  and b.user_id=?
		    where   a.service_id = ?  order by a.service_id,a.company_name",array($this->session->userdata("ApiId"),$service_id));
		    foreach($mycomm->result() as $rw)
		    {

                $str .='<tr class="tableimgsecond">
                    <td>'.$rw->company_name.'</td>
                    <td class="img-rightss"><i class="fa fa-thumbs-o-up up-beforen" style="font-size:13px;color:green;"></i>&nbsp;&nbsp;Live!</td>
                    <td>'.$rw->commission.'&nbsp;'.$rw->commission_type.'</td>
                </tr>';
                
    
		    }


		}
		$str .= '</tbody></table>';
		echo $str;exit;
	}

	public function viewbill()
	{
		//OperatorName,OptCode,mobileno,Amount,optional1,optional2,optional3,optional4
		if(isset($_POST["OperatorName"]) and isset($_POST["OptCode"]) and isset($_POST["mobileno"]) and isset($_POST["optional1"]))
		{
			$userinfo = $this->db->query("select * from tblusers where user_id = ?",array($this->session->userdata("ApiId")));
			$OperatorName = $this->input->post("OperatorName");
			$company_id = $this->input->post("OptCode");
			$service_no = $this->input->post("mobileno");
			$option1 = $this->input->post("optional1");
			//echo '{"Response":"SUCCESS","Price":"292","billduedate":"2020-11-14","DisplayValues":"[{\"label\":\"Customer Name : \",\"value\":\"DILIPBHAI PATEL\"}]"}';
			$CustomerMobile = "8238232303";

			$this->load->model("Swift");
			echo $this->Swift->fetchbill_swift($userinfo,$company_id,$service_no,$CustomerMobile,$option1);exit;
		}
	}

	
	public function showrecentrecharge()
	{
	
		//type=DTH
		if(isset($_GET["type"]))
		{
			$type = $this->input->get("type");
			if(true)
			{
				if($type == "Prepaid")
				{
					$service_id = 1;
				}
				else if($type == "DTH")
				{
					$service_id = 2;
				}
				else if($type == "Gas")
				{
					$service_id = 17;
				}
				else if($type == "Electricity")
				{
					$service_id = 16;
				}
				else if($type == "Landline")
				{
					$service_id = 8;
				}
				else
				{
					$service_id = 8;
				}
				

				$STR = '<div class="body" style="padding:0px;">
				<div class="body table-responsive" style="position:inherit;">
					<table id="example" class="table table-bordered example-recharge" cellspacing="0" style="width:100%;">
						<thead class="navbar" style="color:white;position:inherit;">
							<tr class="recharge-tableoperator">
								<th>Operator&nbsp;Name</th>
								<th>REQ ID</th>
								<th>Recharge&nbsp;No</th>

								<th>Amount</th>
							
								<th>Operator&nbsp;ID</th>
								<th>Req&nbsp;Time</th>
							</tr>
						</thead>
						<tbody>';
//echo $this->session->userdata("ApiId");exit;
				$lasttxns = $this->db->query("select a.recharge_id,a.mobile_no,a.amount,a.operator_id,a.recharge_status,a.add_date,b.company_name from tblrecharge a
                    left join tblcompany b on a.company_id = b.company_id where a.user_id = ? and b.service_id = ? order by a.recharge_id desc limit 10",array($this->session->userdata("ApiId"),intval($service_id)));
				
				//print_r($lasttxns->result());exit;

					foreach($lasttxns->result() as $rwtxns)
				
					{


					
					$STR .= '<tr style="color:green;">
										<td>';

										if($rwtxns->recharge_status == 'Success')
							        	{
							        		$STR .= '<img style="height:20px;width:20px;margin-right:3px;float:left; background-color:green;" src="http://maharshimulti.co.in/ashok-images/correct.svg">';
							                

							        	}
							        	
							        	else if($rwtxns->recharge_status == 'Failure' )
							        	{
							        		
							                   
							                    $STR .= '<img style="height: 20px;width: 18px;margin-right:5px;max-width: 100%;padding: 0; border-radius:50%; background-color:red" src="http://maharshimulti.co.in/ashok-images/closes.svg">';
										}

										$STR.='<i class=""></i>&nbsp;'.$rwtxns->company_name;



										$STR.='</td>
										<td><i class="fa fa-globe" style="font-size:14px;"></i>&nbsp;'.$rwtxns->recharge_id.' </td>
										<td>'.$rwtxns->mobile_no.'</td>

										<td>'.$rwtxns->amount.'</td>
										
										<td style="font-size:14px;">'.$rwtxns->operator_id.'</td>
										<td>
											<p style="font-size:14px;">
											'.$rwtxns->add_date.'

											</p>
										</td>
									</tr>';

			}		
				

				$STR .= '</tbody>

				</table>
			</div>

		</div>';


		echo $STR;exit;

			}
		}

	}



	public function getoperatorname()
	{
		if(isset($_GET["mobile_no"]))
		{
			$mobile = $this->input->get("mobile_no");
			$url = 'http://planapi.in/api/Mobile/OperatorFetch?apimember_id=3489&api_password=dilip2612&Mobileno='.$mobile;
			$resp = $this->common->callurl($url);
			//echo $resp;exit;
			$jsonresp = json_decode($resp);
			if(isset($jsonresp->Operator))
			{
				$operator_name = $jsonresp->Operator;
				$operatorrslt = $this->db->query("select company_id from tblcompany where sortname = ? order by company_id limit 1",array($operator_name));
				if($operatorrslt->num_rows() == 1)
				{
					echo $operatorrslt->row(0)->company_id;exit;
				}
			}
		}
		
	}

	public function RechargeBestofferplan()
	{

		if(isset($_POST["optname"]) and isset($_POST["mobileno"]))
		{
				$operator_name = $_POST["optname"];
				$mobileno = $_POST["mobileno"];
		}
		else
		{
			$operator_name = $_GET["optname"];
			$mobileno = $_GET["mobileno"];	
		}


		$is_prepaid = true;
		if($operator_name == 13)
		{
			$mcode = 23;
		}
		else if($operator_name == 12)
		{
			$mcode = 2;
		}
		else if($operator_name == 23)
		{
			$mcode = 6;
		}
		else if($operator_name == 16)//bsnl topup
		{
			$mcode = 4;
		}
		else if($operator_name == 35)//bsnl stv
		{
			$mcode = 5;
		}
		else if($operator_name == 57)// jio 
		{
			$mcode = 11;
		}


		else if($operator_name == 29)// airtel tv
		{
			$is_prepaid = false;
			$mcode = 24;
		}
		else if($operator_name == 30)// sun  tv
		{
			$is_prepaid = false;
			$mcode = 27;
		}
		else if($operator_name == 31)// tata sky tv
		{
			$is_prepaid = false;
			$mcode = 28;
		}
		else if($operator_name == 32)// big tv
		{
			$is_prepaid = false;
			$mcode = 26;
		}
		else if($operator_name == 33)// videocon tv
		{
			$is_prepaid = false;
			$mcode = 24;
		}
		else if($operator_name == 37)// dish tv
		{
			$is_prepaid = false;
			$mcode = 25;
		}

		if($is_prepaid == true)
		{
			$url = 'http://planapi.in/api/Mobile/RofferCheck?apimember_id=3489&api_password=dilip2612&mobile_no='.$mobileno.'&operator_code='.$mcode;
			$response = $this->common->callurl($url);
			$json_obj = json_decode($response);
			if(isset($json_obj->ERROR) and isset($json_obj->STATUS) )
			{
				$ERROR = $json_obj->ERROR;
				$STATUS = $json_obj->STATUS;


				$resp_array = array();
				$resp_array["status"] = "SUCCESS";
				$data_array = array();

				if($STATUS == "1")
				{
					$RDATA = $json_obj->RDATA;
					foreach($RDATA as $rw)
					{
						$price = $rw->price;
						$commissionUnit = $rw->commissionUnit;
						$ofrtext = $rw->ofrtext;
						$logdesc = $rw->logdesc;
						$commissionAmount = $rw->commissionAmount;
						$temparray = array(
							"price"=>$price,
							"offer"=>$ofrtext,
							"offerDetails"=>$logdesc,
							"commAmount"=>$commissionAmount,
							"commType"=>$commissionUnit,
						);
						array_push($data_array,$temparray);
					}
					$resp_array["Response"] = $data_array;
				}
			}

			echo json_encode($resp_array);exit;
		}
		else
		{
			$url = 'http://planapi.in/api/Mobile/DTHINFOCheck?apimember_id=3489&api_password=dilip2612&Opcode=28&mobile_no=1140267020';
			$url = 'http://planapi.in/api/Mobile/DTHINFOCheck?apimember_id=3489&api_password=dilip2612&mobile_no='.$mobileno.'&Opcode='.$mcode;
			$response = $this->common->callurl($url);
			$json_obj = json_decode($response);
			if(isset($json_obj->ERROR) and isset($json_obj->STATUS) )
			{
				$ERROR = $json_obj->ERROR;
				$STATUS = $json_obj->STATUS;


				$resp_array = array();
				$resp_array["status"] = "SUCCESS";
				$data_array = array();

				if($STATUS == "1")
				{
					$RDATA = $json_obj->RDATA;
					foreach($RDATA as $rw)
					{
						$price = $rw->price;
						$commissionUnit = $rw->commissionUnit;
						$ofrtext = $rw->ofrtext;
						$logdesc = $rw->logdesc;
						$commissionAmount = $rw->commissionAmount;
						$temparray = array(
							"price"=>$price,
							"offer"=>$ofrtext,
							"offerDetails"=>$logdesc,
							"commAmount"=>$commissionAmount,
							"commType"=>$commissionUnit,
						);
						array_push($data_array,$temparray);
					}
					$resp_array["Response"] = $data_array;
				}
			}

			echo json_encode($resp_array);exit;
		}
		



	}


	public function index()
	{	
		if ($this->session->userdata('ApiUserType') != "APIUSER") { 
			redirect(base_url().'login'); 
		} 
		else 
		{ 
			$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
			$this->output->set_header("Pragma: no-cache"); 
			$user=$this->session->userdata('ApiUserType');			
			if(trim($user) == 'APIUSER')
			{
				echo "";exit;
			} 
		}
	}
	public function getcusname()
	{
		$mob = $_GET["mob"];
		$rslt = $this->db->query("select custname from tblrecharge where mobile_no = ? and user_id = ? order by recharge_id desc limit 1",array($mob,$this->session->userdata('ApiId')));
		if($rslt->num_rows() > 0)
		{
			echo $rslt->row(0)->custname;
		}
	}
}	