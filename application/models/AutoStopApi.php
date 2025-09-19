<?php
class AutoStopApi extends CI_Model 
{	
var $k=0;
function _construct()
{		  
	  parent::_construct();
}


	
	public  function increment_failure_counter($api_id,$company_id,$status)
	{
		$rslt = $this->db->query("select api_id,company_id from autostopapi where api_id = ? and company_id = ?",array($api_id,$company_id));
		if($rslt->num_rows() == 0)
		{

			$failure_limit = "";






			$failure_count = 1;
			if($status != "Failure")
			{
				$failure_count = 0;
			}
			
			$stop_datetime = "";
			$stop_for_minutes = "";
			$next_start_datetime = "";
			$this->db->query("insert into autostopapi(api_id,company_id,failure_limit,failure_count,stop_datetime,stop_for_minutes,next_start_datetime) values(?,?,?,?,?,?,?)",
				array($api_id,$company_id,$failure_limit,$failure_count,$stop_datetime,$stop_for_minutes,$next_start_datetime));
		}
		else
		{
			if($status != "Failure")
			{
				$this->db->query("update autostopapi set failure_count = 0 where api_id = ? and company_id = ?",array($api_id,$company_id));
			}
			else
			{

					$this->db->query("update autostopapi set failure_count = failure_count + 1 where api_id = ? and company_id = ?",array($api_id,$company_id));	
					$check_failureCount = $this->db->query("select failure_count,failure_limit from autostopapi where failure_limit > 0 and failure_limit <= failure_count and api_id = ? and company_id = ?",array($api_id,$company_id));
					if($check_failureCount->num_rows() == 1)
					{
						$this->db->query("update operatorpendinglimit set status = '' where api_id = ? and company_id = ?",array($api_id,$company_id));	
						$this->db->query("update autostopapi set failure_count = 0  where api_id = ? and company_id = ?",array($api_id,$company_id));	

						$api_info = $this->db->query("select api_name from api_configuration where Id = ?",array($api_id));
						$company_info = $this->db->query("select company_name from tblcompany where company_id = ?",array($company_id));
						$sms_message = $api_info->row(0)->api_name." API FOR ".$company_info->row(0)->company_name." STOPPED DUE TO FAILURE LIMIT OVER";
						$this->common->ExecuteSMSApiWhatsapp("",$sms_message);
						$this->common->ExecuteSMSApiWhatsapp("",$sms_message);
					}
			}
			
		}
	}


	public  function update_failure_limit($api_id,$company_id,$failure_limit)
	{
		$rslt = $this->db->query("select api_id,company_id from autostopapi where api_id = ? and company_id = ?",array($api_id,$company_id));
		if($rslt->num_rows() == 0)
		{

			$failure_limit = $failure_limit;
			$failure_count = 1;
			if($status != "Failure")
			{
				$failure_count = 0;
			}
			
			$stop_datetime = "";
			$stop_for_minutes = "";
			$next_start_datetime = "";
			$this->db->query("insert into autostopapi(api_id,company_id,failure_limit,failure_count,stop_datetime,stop_for_minutes,next_start_datetime) values(?,?,?,?,?,?,?)",
				array($api_id,$company_id,$failure_limit,$failure_count,$stop_datetime,$stop_for_minutes,$next_start_datetime));
		}
		else
		{
			$this->db->query("update autostopapi set failure_limit = ? where api_id = ? and company_id = ?",array($failure_limit,$api_id,$company_id));
		}
	}
}
?>