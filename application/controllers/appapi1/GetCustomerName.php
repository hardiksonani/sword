<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class GetCustomerName extends CI_Controller { 
	
	public function logentry($data)
	{
	/*	$filename = "and3.txt";
		if (!file_exists($filename)) 
		{
			file_put_contents($filename, '');
		} 
		$this->load->library("common");

		$this->load->helper('file');
	
		$sapretor = "------------------------------------------------------------------------------------";
		
write_file($filename." .\n", 'a+');
write_file($filename, $data."\n", 'a+');
write_file($filename, $sapretor."\n", 'a+');*/

	}
	private function getOperatorCode($company_id)
	{
		if($company_id == "DA")
		{
			return "Airteldth";
		}
		if($company_id == "DS")
		{
			return "Sundirect";
		}
		if($company_id == "DT")
		{
			return "TataSky";
		}
		if($company_id == "DV")
		{
			return "Videocon";
		}
		if($company_id == "DD")
		{
			return "Dishtv";
		}
		
	}
	public function index() 
	{  
	     $this->logentry(json_encode($this->input->get()));
		if(isset($_GET["username"]) and isset($_GET["pwd"]) and isset($_GET["mcode"]))		
		{
		     $this->logentry("step1");
			$username = trim($_GET["username"]);
			$pwd = trim($_GET["pwd"]);
			$mcode = trim($_GET["mcode"]);
			$number = trim($_GET["number"]);
			$rsltcompany_info = $this->db->query("select company_id from tblcompany where mcode = ?",array($mcode));
			if($rsltcompany_info->num_rows() == 1)
			{
			       $this->logentry("step2");
			$url = 'http://manpay.in/appapi1/getCustomerName?key=akjsdfajsdfoiu7234&number='.$number.'&mcode='.$mcode.'&wwe=sdf';
				//echo $url;exit;
				//$url = 'http://www.himachalpay.com/api_users/getCustomerName?username=500002&pwd=0000&mcode='.$this->getOperatorCode($mcode)."&number=".$number;
				//$url = 'http://masterpay.in/iphoneapp/getCustomerName?username=110001&pwd=12345&number='.$number.'&mcode='.$mcode;
				$resp = $this->common->callurl($url);
				echo $resp;exit;
				
			}
		}
		else if(isset($_GET["key"]) and isset($_GET["number"]) and isset($_GET["mcode"]))		
		{
		
			$mcode = trim($_GET["mcode"]);
			$number = trim($_GET["number"]);
			$rsltcompany_info = $this->db->query("select company_id from tblcompany where mcode = ?",array($mcode));
			if($rsltcompany_info->num_rows() == 1)
			{
			   
				$url = 'http://manpay.in/appapi1/getCustomerName?key=akjsdfajsdfoiu7234&number='.$number.'&mcode='.$mcode.'&wwe=sdf';
				//echo 
				$resp = $this->common->callurl($url);
				echo $resp;exit;
				
			}
		}
	}	
}
//50.22.77.79