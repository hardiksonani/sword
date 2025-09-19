<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class GetMinksPayCallback extends CI_Controller {
	public function logentry($data)
	{
		$filename = "inlogs/aepsresp.txt";
		if (!file_exists($filename)) 
		{
			file_put_contents($filename, '');
		} 
		$this->load->library("common");

		$this->load->helper('file');
	
		$sapretor = "------------------------------------------------------------------------------------";
		
		write_file($filename." .\n", 'a+');
		write_file($filename, $this->common->getDate()."\n", 'a+');
		write_file($filename, $this->common->getRealIpAddr()."\n", 'a+');
		write_file($filename, $data."\n", 'a+');
		write_file($filename, $sapretor."\n", 'a+');
	}
	
	public function index()
	{ 

		/*
		{"status":"success","message":"","data":{"aeps_txn_id":"16123468059641270","txn_req_id":"10000045","partner_agent_id":"1684684515","amount":"100.0000","status":1,"remark":"Success","bank_rrn":"103415076527","udd":"","settlement_acceptor_type":"API_PARTNER_ACCOUNT","mobile_no":"9428556279","bank_name":"HDFC Bank","device_imei":"173f19b7933cc401","latitude":"72.4587","longitude":"43.6686","aadhaar_no":"xxxxxxxx4700","ip_address":"43.249.230.56","balance_amt":"6103.9100","txn_type":"WITHDRAWAL"},"code":0}
		*/

		$response = file_get_contents('php://input');
		$this->logentry("inputstream ".$response);
		$data = json_encode($this->input->get());
		$datapost = json_encode($this->input->post());
		$this->logentry("get: ".$data);
		$this->logentry("POST : ".$datapost);

			// error_reporting(-1);
			// ini_set('display_errors',1);
			// $this->db->db_debug = TRUE;
			// $response = '{"status":"success","message":"","data":{"aeps_txn_id":"16123468059641270","txn_req_id":"10000045","partner_agent_id":"1684684515","amount":"100.0000","status":1,"remark":"Success","bank_rrn":"103415076527","udd":"","settlement_acceptor_type":"API_PARTNER_ACCOUNT","mobile_no":"9428556279","bank_name":"HDFC Bank","device_imei":"173f19b7933cc401","latitude":"72.4587","longitude":"43.6686","aadhaar_no":"xxxxxxxx4700","ip_address":"43.249.230.56","balance_amt":"6103.9100","txn_type":"WITHDRAWAL"},"code":0}';

		$json_obj = json_decode($response);
		if(isset($json_obj->status))
		{
			$RESP_status = $json_obj->status;
			$RESP_message = $json_obj->message;
			if(isset($json_obj->data))
			{
				$data = $json_obj->data;
				if(isset($data->aeps_txn_id) and isset($data->txn_req_id))
				{
					$aeps_txn_id = $data->aeps_txn_id;
					$txn_req_id = $data->txn_req_id;
					$partner_agent_id = $data->partner_agent_id;
					$RESP_amount = $data->amount;
					$aeps_status = $data->status;
					$remark = $data->remark;
					$bank_rrn = $data->bank_rrn;

					$udd = $data->udd;
					$settlement_acceptor_type = $data->settlement_acceptor_type;
					$mobile_no = $data->mobile_no;

					$bank_name = $data->bank_name;
					$device_imei = $data->device_imei;
					$latitude = $data->latitude;
					$longitude = $data->longitude;


					$aadhaar_no = $data->aadhaar_no;
					$ip_address = $data->ip_address;
					$balance_amt = $data->balance_amt;
					$txn_type = $data->txn_type;
						$code = $json_obj->code;

					$aepsinfo = $this->db->query("select * from minkspay_aeps where Id = ? and status = 'Pending'",array($txn_req_id));
					if($aepsinfo->num_rows() == 1)
					{


							$resp_date = $this->common->getDate();
							$resp_ip = $this->common->getRealIpAddr();
							$credit_amount = $RESP_amount;
							$commission = 0;
							$status = $aeps_status;




						$this->db->query("update minkspay_aeps set RESP_status = ?,RESP_message = ?,aeps_txn_id=?,txn_req_id=?,partner_agent_id=?,RESP_amount=?,aeps_status=?,remark=?,bank_rrn=?,udd=?,settlement_acceptor_type=?,mobile_no=?,bank_name=?,device_imei=?,latitude=?,longitude=?,aadhaar_no=?,ip_address=?,balance_amt=?,txn_type=?,code=?,resp_date=?,resp_ip=? where Id = ?",
							array(
									$RESP_status,$RESP_message,$aeps_txn_id,$txn_req_id,$partner_agent_id,$RESP_amount,$aeps_status,$remark,$bank_rrn,$udd,$settlement_acceptor_type,$mobile_no,$bank_name,$device_imei,$latitude,$longitude,$aadhaar_no,$ip_address,$balance_amt,$txn_type,$code,$resp_date,$resp_ip,$txn_req_id
							));

							//credit_amount=?,commission=?
						//$credit_amount,$commission
						if($aeps_status == "1")
						{
							$status = "Success";
							$credit_user_id = $aepsinfo->row(0)->user_id;
							$debit_user_id = 1;
							$amount = $RESP_amount;
							$remark = "TXN ID : ".$bank_rrn." Bank :".$bank_name;
							$description = "AEPS PAYMENT : ID :".$txn_req_id;
							$payment_type = "AEPS";
							$admin_remark = "AEPS PAYMENT";


							$this->db->query("update minkspay_aeps set status='Success',credit_amount = ?,commission = ? where Id = ?",
							array(
									$amount,0,$txn_req_id
							));



							$this->load->model("Insert_model");
							$this->Insert_model->tblewallet_Payment_CrDrEntry_AEPS($credit_user_id,$debit_user_id,$amount,$remark,$description,$payment_type,$admin_remark);


							$commission = (($amount * 0.25)/100);
							if($commission > 8)
							{
								$commission = 8;
							}

							$remark = "AEPS COMMISSION";
							$description = "COMMISSION ON :".$description;
							$admin_remark = "Aeps Commission";
							$this->Insert_model->tblewallet_Payment_CrDrEntry_AEPS($credit_user_id,$debit_user_id,$commission,$remark,$description,$payment_type,$admin_remark);


						}
					}
				}
				






			}
		}


	/*
{"status":"success","message":"","data":{"aeps_txn_id":"16123468059641270","txn_req_id":"10000045","partner_agent_id":"1684684515","amount":"100.0000","status":1,"remark":"Success","bank_rrn":"103415076527","udd":"","settlement_acceptor_type":"API_PARTNER_ACCOUNT","mobile_no":"9428556279","bank_name":"HDFC Bank","device_imei":"173f19b7933cc401","latitude":"72.4587","longitude":"43.6686","aadhaar_no":"xxxxxxxx4700","ip_address":"43.249.230.56","balance_amt":"6103.9100","txn_type":"WITHDRAWAL"},"code":0}
	*/
	
	
	}	




}
