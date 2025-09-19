<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SendSms extends MY_Controller 
{
	 public function __construct()
    {        
        parent::__construct();
    } 
	public function get_string_between($string, $start, $end)
	 { 
		$string = ' ' . $string;
		$ini = strpos($string, $start);
		if ($ini == 0) return '';
		$ini += strlen($start);
		$len = strpos($string, $end, $ini) - $ini;
		return substr($string, $ini, $len);
	}
	public function index()
	{
		//https://mastermoney.in/SendSms?number=8238232303&message=textmessage
		 $resp = json_encode($this->input->get());
		$this->logentry("get : ".$resp);
		
		/*
		Dear Ravikant, Thank you for registering with our DMR service. Please use this pin 409033 to login your account
		*/
		if(isset($_GET["number"]) and isset($_GET["message"]))
		{
			$number= trim($_GET["number"]);
			$message= trim($_GET["message"]);
			if (preg_match('/Please use this pin/',$message) == 1)
			{
				$pin = $this->get_string_between($message, "Please use this pin ", " to login your");
				$pin = trim($pin);
				$this->db->query("update mt3_remitter_registration set DEZIRE = 'yes',DEZIRE_PIN = ? where mobile = ?",array($pin,$number));
				echo $pin;exit;
			}
		}
	}
	public function logentry($data)
	{

		$filename = "dezsms.txt";
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
	}
}
