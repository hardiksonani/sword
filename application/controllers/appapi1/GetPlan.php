<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class GetPlan extends CI_Controller { 
	
	public function logentry($data)
	{
	/*	$filename = "and2.txt";
		if (!file_exists($filename)) 
		{
			file_put_contents($filename, '');
		} 
		$this->load->library("common");

		$this->load->helper('file');
	
		$sapretor = "------------------------------------------------------------------------------------";
		
write_file($filename." .\n", 'a+');
write_file($filename, $data."\n", 'a+');
write_file($filename, $sapretor."\n", 'a+');
*/

	}
	private function getOperatorCode($company_id)
	{
		if($company_id == 29)
		{
			return "Airteldth";
		}
		if($company_id == 30)
		{
			return "Sundirect";
		}
		if($company_id == 31)
		{
			return "TataSky";
		}
		if($company_id == 33)
		{
			return "Videocon";
		}
		if($company_id == 37)
		{
			return "Dishtv";
		}
		
	}
	public function index() 
	{  
	    $MplanKeyRslt = $this->db->query("select value from admininfo where param = 'MPLAN_KEY' and host_id = 1");
        $MplanKey = $MplanKeyRslt->row(0)->value;
	    
	    
	    $this->logentry(json_encode($this->input->get()));
		if(isset($_GET["username"]) and isset($_GET["pwd"]) and isset($_GET["number"]) and isset($_GET["operator"]))		
		{
			
			
			
		    
			
				$number = trim($_GET["number"]);
				$operator = trim($_GET["operator"]);
				if($operator == "RV")
				{
				    $operator = "Vodafone";
				}
				if($operator == "RA" or $operator == "AR")
				{
				    $operator = "Airtel";
				}
				if($operator == "RI")
				{
				    $operator = "Idea";
				}
				if($operator == "RB" or $operator == "TB")
        		{
        			  $operator =  "BSNL";
        		}
        		if($operator == "RD" or $operator == "TD")
        		{
        			$operator =  "Tata Docomo";
        		}
				
				$url = 'https://www.mplan.in/api/plans.php?apikey='.$MplanKey.'&offer=roffer&tel='.$number.'&operator='.rawurlencode($operator);
			   // echo $url;exit;
			//	$url = 'http://masterpay.in/iphoneapp/getPlan?key2=r3t3ZU5fdMbj2NorgUJTmoTdMMKsia4b&number='.$number.'&operator='.$operator;
			$url = 'http://manpay.in/appapi1/getPlan?key=akjsdfajsdfoiu7234&number='.$number.'&operator='.$operator.'&wwe=sdf&username=&pwd=4';
				$ch = curl_init();		
        		curl_setopt($ch,CURLOPT_URL,  $url);
        		
        		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        		$buffer = curl_exec($ch);		
        		curl_close($ch);
        		
        	//	echo "resp : ".$buffer;exit;
				//$this->logentry($buffer);
				echo $buffer;exit;
				
			
		}
		else if(isset($_GET["username"]) and isset($_GET["pwd"]) and isset($_GET["circle"]) and isset($_GET["operator"]))		
		{
			// $this->logentry("step2");
			$temparray["records"] = array();
			$username = trim($_GET["username"]);
			$pwd = trim($_GET["pwd"]);
			
			
			$userinfo = $this->db->query("select user_id from tblusers where mobile_no = ? and password = ? ",array($username,$pwd));
				$this->logentry("num_rows : ".$userinfo->num_rows() );
			if($userinfo->num_rows() == 1)
			{
		//	$this->logentry("step3");
				$operator = trim($_GET["operator"]);
				$circle = trim($_GET["circle"]);
				
				if($operator == "RV")
				{
				    $operator = "Vodafone";
				}
				if($operator == "RA")
				{
				    $operator = "Airtel";
				}
				if($operator == "RI")
				{
				    $operator = "Idea";
				}
				if($operator == "RB" or $operator == "TB")
        		{
        			  $operator =  "BSNL";
        		}
        		if($operator == "RD" or $operator == "TD")
        		{
        			$operator =  "Tata Docomo";
        		}
        		if($operator == "JO" or $operator == "JIO")
        		{
        			$operator =  "Jio";
        		}
				
				
				//$url = 'https://www.mplan.in/api/plans.php?apikey='.$MplanKey.'&cricle='.rawurlencode($circle).'&operator='.rawurlencode($operator);
			    $url = 'http://manpay.in/appapi1/getPlan?key=akjsdfajsdfoiu7234&circle='.rawurlencode($circle).'&operator='.trim($_GET["operator"]).'&wwe=sdf&username=&pwd=4';
				$resp =  $this->common->callurl($url);
				$this->logentry($resp);
			    echo $resp;exit;
			}
		}
	}
	public function getmixedplan_html()
	{
	    
	    $MplanKeyRslt = $this->db->query("select value from admininfo where param = 'MPLAN_KEY' and host_id = 1");
        $MplanKey = $MplanKeyRslt->row(0)->value;
	    
				$number = trim($_GET["number"]);
				$operator = trim($_GET["operator"]);
				
				
		        $mcode = "";
		        $rsltcompany = $this->db->query("select mcode from tblcompany where company_id = ?",array($operator));
		       // print_r($rsltcompany->result());exit;
		        if($rsltcompany->num_rows() == 1)
		        {
		            $mcode = $rsltcompany->row(0)->mcode;
		        }
		    	//$url = 'http://masterpay.in/iphoneapp/getPlan?key2=r3t3ZU5fdMbj2NorgUJTmoTdMMKsia4b&number='.$number.'&operator='.$mcode;
		    	if($mcode == "RV")
				{
				    $operator = "Vodafone";
				}
				if($mcode == "RA" or $mcode == "AR")
				{
				    $operator = "Airtel";
				}
				if($mcode == "RI")
				{
				    $operator = "Idea";
				}
				if($mcode == "RB" or $mcode == "TB")
        		{
        			  $operator =  "BSNL";
        		}
        		if($mcode == "RD" or $mcode == "TD")
        		{
        			$operator =  "Tata Docomo";
        		}
        		if($mcode == "JO" or $mcode == "JIO")
        		{
        			$operator =  "Jio";
        		}
				
				$url = 'https://www.mplan.in/api/plans.php?apikey='.$MplanKey.'&offer=roffer&tel='.$number.'&operator='.rawurlencode($operator);
				$url = 'http://manpay.in/appapi1/getPlan?key=akjsdfajsdfoiu7234&number='.$number.'&operator='.$mcode.'&wwe=sdf&username=&pwd=4';
				$response = $this->common->callurl($url);
				$jsonarr = json_decode($response);
			
			    $str_resp = '';
			    $str_resp .= '<table class="table table-bordered">
			    <tr>
			    <th>Denomination</th>
			    <th>Commission</th>
			    <th>Offer Detail</th>
			    </tr>';
			    	foreach($jsonarr->records as $rw)
    				{
    			//	print_r($rw);exit;
    					if(isset($rw->rs))
    					{
    						$str_resp .= '
    						
    						<tr>
    						<td style="width:100px">
        						<a> <span class="p_amount">
                                    <button class="btn btn-success" onClick="setValuetoAmount(\''.$rw->rs.'\')" class="btn btn_plan">Rs. '.$rw->rs.'</button>
                                    </span> 
                                </a>
                            </td>
                            <td style="width:100px">
        						<a> <span class="p_amount"> Rs. '.$rw->comm.'</span> </a>
                            </td>
                        <td>
                        <span class="p_detail">
                        <p>'.$rw->desc.'</p>
                        <i></i> </span> 
                        
                        </td>
                        </tr>
                       
                        ';
    					}
    					else
    					{
    						$str_resp .= '<a> <span class="p_amount">
    						
    						</span> <span class="p_detail">
    						<p>No Offer Found For This Number</p>
    						<i></i> </span> </a>';
    					}
    					
    					
    				}
    				$str_resp .= '</table>';
    				echo $str_resp;
			    
			    //echo json_encode($mainarray);
				
				
			
				
			
		
	}

	public function getmixedplan_normal_html()
	{
	    
	    $MplanKeyRslt = $this->db->query("select value from admininfo where param = 'MPLAN_KEY' and host_id = 1");
        $MplanKey = $MplanKeyRslt->row(0)->value;
	    
				$number = trim($_GET["number"]);
				$operator = trim($_GET["operator"]);
				
				
		        $mcode = "";
		        $rsltcompany = $this->db->query("select mcode from tblcompany where company_id = ?",array($operator));
		       // print_r($rsltcompany->result());exit;
		        if($rsltcompany->num_rows() == 1)
		        {
		            $mcode = $rsltcompany->row(0)->mcode;
		        }
		    	//$url = 'http://masterpay.in/iphoneapp/getPlan?key2=r3t3ZU5fdMbj2NorgUJTmoTdMMKsia4b&number='.$number.'&operator='.$mcode;
		    	if($mcode == "RV")
				{
				    $operator = "Vodafone";
				}
				if($mcode == "RA" or $mcode == "AR")
				{
				    $operator = "Airtel";
				}
				if($mcode == "RI")
				{
				    $operator = "Idea";
				}
				if($mcode == "RB" or $mcode == "TB")
        		{
        			  $operator =  "BSNL";
        		}
        		if($mcode == "RD" or $mcode == "TD")
        		{
        			$operator =  "Tata Docomo";
        		}
        		if($mcode == "JO" or $mcode == "JIO")
        		{
        			$operator =  "Jio";
        		}
				
				$url = 'https://www.mplan.in/api/plans.php?apikey='.$MplanKey.'&offer=roffer&tel='.$number.'&operator='.rawurlencode($operator);
				$url = 'http://manpay.in/appapi1/getPlan?key=akjsdfajsdfoiu7234&number='.$number.'&operator='.$mcode.'&wwe=sdf&username=&pwd=4';
				$response = $this->common->callurl($url);
				$jsonarr = json_decode($response);
			
			    $str_resp = '';
			    $str_resp .= '<table class="table table-bordered">
			    <tr>
			    <th>Denomination</th>
			    <th>Commission</th>
			    <th>Offer Detail</th>
			    </tr>';
			    	foreach($jsonarr->records as $rw)
    				{
    			//	print_r($rw);exit;
    					if(isset($rw->rs))
    					{
    						$str_resp .= '
    						
    						<tr>
    						<td style="width:100px">
        						<a> <span class="p_amount">
                                    <button class="btn btn-success" onClick="setValuetoAmount(\''.$rw->rs.'\')" class="btn btn_plan">Rs. '.$rw->rs.'</button>
                                    </span> 
                                </a>
                            </td>
                            <td style="width:100px">
        						<a> <span class="p_amount"> Rs. '.$rw->comm.'</span> </a>
                            </td>
                        <td>
                        <span class="p_detail">
                        <p>'.$rw->desc.'</p>
                        <i></i> </span> 
                        
                        </td>
                        </tr>
                       
                        ';
    					}
    					else
    					{
    						$str_resp .= '<a> <span class="p_amount">
    						
    						</span> <span class="p_detail">
    						<p>No Offer Found For This Number</p>
    						<i></i> </span> </a>';
    					}
    					
    					
    				}
    				$str_resp .= '</table>';
    				echo $str_resp;
			    
			    //echo json_encode($mainarray);
				
				
			
				
			
		
	}






	public function getmixed_dthinfo_html()
	{
	    $MplanKeyRslt = $this->db->query("select value from admininfo where param = 'MPLAN_KEY' and host_id = 1");
        $MplanKey = $MplanKeyRslt->row(0)->value;
	    
	    
	    $number = trim($_GET["number"]);
		$operator = trim($_GET["operator"]);
		
		
        $mcode = "";
        $rsltcompany = $this->db->query("select mcode from tblcompany where company_id = ?",array($operator));
        if($rsltcompany->num_rows() == 1)
        {
            $mcode = $rsltcompany->row(0)->mcode;
        }
        
        
        
        if($mcode == "DA")
		{
			$operator =  "Airteldth";
		}
		if($mcode == "DS")
		{
			$operator =  "Sundirect";
		}
		if($mcode == "DT")
		{
			$operator =  "TataSky";
		}
		if($mcode == "DV")
		{
			$operator =  "Videocon";
		}
		if($mcode == "DD")
		{
			$operator =  "Dishtv";
		}
        
    
    	$url = 'https://www.mplan.in/api/plans.php?apikey='.$MplanKey.'&offer=roffer&tel='.$number.'&operator='.rawurlencode($operator);
    
		$response = $this->common->callurl($url);
		$jsonarr = json_decode($response);
		if(isset($jsonarr->records))
		{
		    $records = $jsonarr->records[0];
		    if(isset($records->MonthlyRecharge))
		    {
		        $MonthlyRecharge =  $records->MonthlyRecharge;
		        $Balance =  $records->Balance;
		        $customerName =  $records->customerName;
		        $status =  $records->status;
		        $NextRechargeDate =  $records->NextRechargeDate;
		        $lastrechargedate =  $records->lastrechargedate;
		        $lastrechargeamount =  $records->lastrechargeamount;
		        $planname =  $records->planname;
		        
		        $str = '<table class="table table-bordered bordered table-stripped">';
    		        $str .= '<tr>';
        		            $str .= '<td><b>Number</b></td>';
        		            $str .= '<td><b>'.$number.'</b></td>';
    		        $str .= '</tr>';
    		        $str .= '<tr>';
    		            $str .= '<td><b>Customer Name</b></td>';
    		            $str .= '<td><b>'.$customerName.'</b></td>';
    		        $str .= '</tr>';
    		        $str .= '<tr>';
    		            $str .= '<td><b>Balance</b></td>';
    		            $str .= '<td><b>'.$Balance.'</b></td>';
    		        $str .= '</tr>';
    		        $str .= '<tr>';
    		            $str .= '<td><b>MonthlyRecharge</b></td>';
    		            $str .= '<td><b>'.$MonthlyRecharge.'</b></td>';
    		        $str .= '</tr>';
    		        $str .= '<tr>';
    		            $str .= '<td><b>NextRechargeDate</b></td>';
    		            $str .= '<td><b>'.$NextRechargeDate.'</b></td>';
    		        $str .= '</tr>';
    		        $str .= '<tr>';
    		            $str .= '<td><b>Plan Name</b></td>';
    		            $str .= '<td><b>'.$planname.'</b></td>';
    		        $str .= '</tr>';
		        $str .= '</table>';
		        echo $str;exit;
		        
		        
		    }
		    
		}
	}
}
//50.22.77.79