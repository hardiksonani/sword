<?php
class Sms extends CI_Model 
{	
	function _construct()
	{
		  // Call the Model constructor
		  parent::_construct();
	}
	public function receiveBalance($user_info,$amount)
	{
		
		$user_id = $user_info->row(0)->user_id;
		$bal = $this->Common_methods->getAgentBalance($user_id);
		
		
	/*	$rsltparent = $this->db->query("select user_id,businessname,parentid,usertype_name,mobile_no from tblusers where user_id = ?",array($user_info->row(0)->parentid));
		$parentid = $user_info->row(0)->parentid;*/
	//	$parent_bal = $this->Common_methods->getAgentBalance($parentid);
		$this->load->library("common");	
		
		$BALANCE_ADD_rslt = $this->db->query("select str_template,is_sms,is_notification from sms_templates where template_name = 'BALANCE_ADD' and host_id = 1");
		$smsMessage = $BALANCE_ADD_rslt->row(0)->str_template;
		
		$smsMessage = str_replace("@retailername",substr($user_info->row(0)->businessname,0,15),$smsMessage);
		$smsMessage = str_replace("@amt",$amount,$smsMessage);
		$smsMessage = str_replace("@retailerbalance",round($bal,2),$smsMessage);
		
		
	//	$this->db->query("insert into tempsms(message,to_mobile) values(?,?)",array($smsMessage,$user_info->row(0)->mobile_no));
		
			/*
$smsMessageSENDER = "Dear Business Partner, Your Transfered Amount to ".$user_info->row(0)->businessname." is ".$amount." Your Updated Balance is ".($parent_bal)."Thank You";
$message  = urlencode($smsMessageSENDER);
*/

//$smsMessageCUSTOMER = "Dear Business Partner, Your Received Amount is ".$amount.", Your Updated Balance is ".($bal).", MasterPay.co.in";
//$smsMessageCUSTOMER = "Dear Business Partner,Your Received Amount is ".$amount."Your Updated Balance is ".($bal)."Thank You";
//$message2  = urlencode($smsMessageCUSTOMER);				
				$result_sms = $this->common->ExecuteSMSApi($user_info->row(0)->mobile_no,$smsMessage);
					
				//$result_sms1 = $this->common->ExecuteSMSApi($rsltparent->row(0)->mobile_no,$smsMessageSENDER);
			//	echo $result_sms .'?'. $result_sms1 ;	
	}
	public function revertBalance($user_info,$amount)
	{
		$user_id = $user_info->row(0)->user_id;
		$bal = $this->Common_methods->getAgentBalance($user_id);
		$smsMessage = 
'Dear '.$user_info->row(0)->businessname.', Your account has been debited with Rs. '.$amount.', Your Old bal. is Rs. '.($bal + $amount).' and  new bal. Rs. '.$bal.'.  Thanks.';	
		$result_sms = $this->common->ExecuteSMSApi($user_info->row(0)->mobile_no,$smsMessage);
	}
	public	function addSentMessage($mobile_no,$message,$buffer)
	{
		
		$this->load->library('common');
		$date = $this->common->getDate();
		$date1 = $this->common->getMySqlDate();
		$str_query = "INSERT INTO `tblsentsms`(`toNumber`, `message`, `response`, `add_date`) VALUES (?,?,?,?)";
		$result = $this->db->query($str_query,array($mobile_no,rawurldecode($message),$buffer,$date));
		
			
	}	
	public function sendRechargeSMS($company_name,$Mobile,$Amount,$TransactionID,$status,$balance,$senderMobile)
	{
		$smsMessage = "Dear Your Request is Com : ".$company_name." Number : ".$Mobile." Amt : ".$Amount." Tx id : ".$TransactionID." Status : ".$status." A/C Bal : ".$balance." thanks";	
$result = $this->common->ExecuteSMSApi($senderMobile,$smsMessage);
			
	}
	public function registration($password,$mobile_no,$txnpwd,$emailid,$name)
	{
	    $REGISTRATION_rslt = $this->db->query("select str_template,is_sms,is_notification from sms_templates where template_name = 'REGISTRATION' and host_id = 1");
		$smsMessage = $REGISTRATION_rslt->row(0)->str_template;
		
		$smsMessage = str_replace("@retailername",substr($name,0,15),$smsMessage);
		$smsMessage = str_replace("@username",$mobile_no,$smsMessage);
		$smsMessage = str_replace("@password",$password,$smsMessage);
		$smsMessage = str_replace("@pin",$txnpwd,$smsMessage);
		$smsMessage = str_replace("@websiteurl","",$smsMessage);
		$smsMessage = str_replace("@websitename","",$smsMessage);
		$smsMessage = str_replace("@passcode","",$smsMessage);
	    
	    
	/*	$smsMessage = 
'Your account has been successfully created. User Name : '.$mobile_no.' Password : '.$password.' Tpin : '.$txnpwd.' Thank You';*/
		$result_sms = $this->common->ExecuteSMSApi($mobile_no,$smsMessage);	
		$to = $emailid;
		$subject = $this->common_value->getSubject();
		$message = $this->common_value->getEmailMessage($mobile_no,$password,$name);
		$from = $this->common_value->getFromEmail();
		$headers = "From:" . $from;
		$headers .= "\nContent-Type: text/html";
		mail($to,$subject,$message,$headers);		
			
	}
	public function passwordreset($username,$password,$mobile_no,$emailid,$name)
	{
		$userinf  = $this->db->query("select txn_password from tblusers where username = ?",array($username));
		$smsMessage = 
'Your password has been successfully Reset. User Name : '.$username.' Password : '.$password.' Tpin : '.$userinf->row(0)->txn_password.' Thank You';
		$result_sms = $this->common->ExecuteSMSApi($mobile_no,$smsMessage);	
		$to = $emailid;
		$subject = $this->common_value->getSubject();
		$message = $this->common_value->getEmailMessage($username,$password,$name);
		$from = $this->common_value->getFromEmail();
		$headers = "From:" . $from;
		$headers .= "\nContent-Type: text/html";
		mail($to,$subject,$message,$headers);		
			
	}
	public function activatemsg($userinfo,$password)
	{
		
				$smsMessage = 
'Your account has been successfully Activated. User Name : '.$userinfo->row(0)->username.' Password : '.$password.' MasterMoney';
//$result_sms = $this->common->ExecuteSMSApi($userinfo->row(0)->mobile_no,$smsMessage);

		$to = $userinfo->row(0)->emailid;
		$subject = $this->common_value->getSubject();
		$message = $this->common_value->getEmailMessage($userinfo->row(0)->username,$password,$userinfo->row(0)->businessname);
		$from = $this->common_value->getFromEmail();
		$headers = "From:" . $from;
		$headers .= "\nContent-Type: text/html";
		mail($to,$subject,$message,$headers);		
	}
	public function BalanceSms($userinfo,$balance)
	{
		$message = "Your Current Balance Is ".$balance;
		$this->common->ExecuteSMSApi($userinfo->row(0)->mobile_no,$message) ;
				
	}

















	//////////whatsapp notifications
	public function sendWhatsappNotificationall($message)
	{
		$mobile_no = '';
		$users = $this->db->query("select mobile_no from tblusers where status = 1 and (usertype_name = 'Agent' or usertype_name = 'Distributor' or usertype_name = 'MasterDealer')");
		foreach($users->result() as $rw)
		{
			$mobile_no .= "91".$rw->mobile_no;
			$url2 = 'https://whatsbot.tech/api/send_sms?api_token=4a43d301-55d2-4aad-b1f5-df159024598b&mobile='.$mobile_no.'&message='.urlencode($message);
			
			$ch = curl_init();
			curl_setopt($ch,CURLOPT_URL,$url2);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			
			$buffer = curl_exec($ch);
		
			curl_close($ch);
			$this->addSentMessage($mobile_no,$message,"Whatsapp:".$buffer);
			
		}
		
		
	}
	
	
}

?>