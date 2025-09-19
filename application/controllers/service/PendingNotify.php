<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class PendingNotify extends CI_Controller {
	public function gethoursbetweentwodates($fromdate,$todate)
	{
		 $now_date = strtotime (date ($todate)); // the current date 
		$key_date = strtotime (date ($fromdate));
		$diff = $now_date - $key_date;
		return round(abs($diff) / 60,2);
	}
	public function index()
	{  
		$notify = false;
		$str = "Please Check Pending Recharges......\n";
		$rsltrecharges = $this->db->query("
			select a.*,
			b.company_name from tblpendingrechares a left join tblcompany b on a.company_id = b.company_id 
			order by recharge_id");
		$data_array = array();
		$i=1;
		foreach($rsltrecharges->result() as $rw)
		{
			$recharge_id = $rw->recharge_id;
			$mobile_no = $rw->mobile_no;
			$amount = $rw->amount;
			$company_name = $rw->company_name;
			$rec_datetime = $rw->add_date;
			


			$recdatetime =date_format(date_create($rec_datetime),'Y-m-d H:i:s');
			$cdate =date_format(date_create($this->common->getDate()),'Y-m-d H:i:s');

			$diff = $this->gethoursbetweentwodates($recdatetime,$cdate);
			if($diff > 5)
			{
				$notify = true;
				$temparray = array(
				"recharge_id"=>$recharge_id,
				"mobile_no"=>$mobile_no,
				"amount"=>$amount,
				"company_name"=>$company_name,
				"add_date"=>$rec_datetime,

				);
				array_push($data_array,$temparray);
				$str .= $i.")".$recharge_id." | ".$company_name." | ".$mobile_no." | ".$recdatetime." | ".$amount."\n";	
			}
		$i++;	
		}
		if($notify == true)
		{
			$this->common->ExecuteSMSApiWhatsapp("",$str);
			$this->common->ExecuteSMSApiWhatsapp("",$str);	
		}
		



		


	}	
}
