<?php

class MY_Controller extends CI_Controller {

	

	public $data = array();

	public function __construct() {

		parent::__construct();
		
		$this->lang->load('messages_lang');

		$this->data['errors'] = array();

		$this->data['site_name'] = config_item('site_name');

	}
	
	protected function _getSiteSettings()
	{
		$site_settings = $this->session->userdata('site_settings');
		
		if($site_settings and !$this->_isDemo()) {
			
			// do nothing
			
		} else {
			
			$site_settings = $this->Site_settings_model->get(NULL, TRUE);
			
			$this->session->set_userdata('site_settings', $site_settings);
		}
		
		// check l i c e n c e
		if(0) {
			// no check
		} else {
			if(uri_string() != 'lkeys/update') {
				$lkey = $site_settings->lkey;
				$gen_key = $site_settings->gen_key;
				$domain_name = 'lcalhost';
				if(defined('DOMAIN_WO_WWW'))
					$domain_name = DOMAIN_WO_WWW;
				$gen_key_check = $this->Site_settings_model->hash($domain_name.$lkey);
				if($gen_key_check != $gen_key) {
					echo base64_decode('SW52YWxpZCBMaWNlbnNlIEtleTogUGxlYXNlIGNvbnRhY3QgdXMgdG8gdXBkYXRlIGxpY2VuY2Uga2V5IGZvciB5b3VyIHNpdGUu');
					exit;
				}
			}
		}
		
		return $site_settings;
	}
	
	public function _isDemo()
	{
		if(ENVIRONMENT == 'development') {
			return true;
		}
		return true;//return false;
	}
	
	public function _isNotEditable()
	{
		
		if(defined('IS_DEMO'))
			return true;
		
		// access given
		return false;
	}
	
	
	
	public function _valid_url($url)
	{
				
		$pattern = "|^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i";
		
        if (!preg_match($pattern, $url)){
			
            $this->form_validation->set_message('_valid_url', 'Invalid %s. Valid url format Eg: http://jgtech.in');
			
            return FALSE;
        }
 
        return TRUE;
		
	}

}