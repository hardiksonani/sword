<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Agentlogout extends CI_Controller {
	
	public function index()
	{ 
		if($this->session->userdata('ApiUserType') == "Agent")
		{
			$this->session->unset_userdata('ApiId');
			$this->session->unset_userdata('AgentParentId');		
			$this->session->unset_userdata('ApiLoggedIn');
			$this->session->unset_userdata('AgentBusinessName');
			$this->session->unset_userdata('AgentFirstTimeLogin');
			$this->session->unset_userdata('AgentSchemeId');
			$this->session->unset_userdata('AgentIsAPI');
			$this->session->unset_userdata('Redirect');
			$this->session->unset_userdata('ApiUserType');		
			$data['message']='';
			redirect(base_url()."login");	
		}
	}	
}
