<?php
class App_Controller extends CI_Controller {

	function __construct() {
		
		parent::__construct();

		/*if( isset( $_GET['session_id'] ) )
			$this->load->library('session', $_GET['session_id']);
		else
			$this->load->library('session');
		*/
		$this->load->library('session');
		// check if the request is from mobile
		
		$site_models = $this->config->item('site_models');
	 	$this->data_common['site_models'] = $site_models;

	}
	
	public function printOutput($response = null)
	{
		if(is_null($response))
			$response = array('status' => 0, 'msg' => 'Invalid request.');

		$response = $this->unsetUnwanted($response);
		
		// get ci_session and pass to device
		$sess_cookie_name = $this->config->item('sess_cookie_name');
		if( isset($_COOKIE[$sess_cookie_name]) )
			$response['session_id'] = $_COOKIE[$sess_cookie_name];
		else if(session_id() != null)
			$response['session_id'] = session_id();
		
		$this->output
				->set_status_header(200)
				->set_content_type('application/json', 'utf-8')
				->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
				->_display();
		exit;
	}
	
	public function unsetUnwanted($response)
	{
		if(isset($response['site_models']))
			unset($response['site_models']);
		
		return $response;
	}
	
	public function _send_mail($data, $template, $subject)
	{
		// get site settings
		$site_settings = $this->_getSiteSettings();
		$data['site_settings'] = $site_settings;
		if( $site_settings->admin_email ){
			$from_email = $site_settings->admin_email;
		} else {
			$this->load->model('cms/User_model');
			$user_type = config_item('user_type');
			$admin = $this->User_model->get_by(array('user_type' => $user_type['admin']),TRUE);
			$from_email = $admin->email;
		}
		// logo
		$customer_source_url = $this->config->item('customer_source_url');
		$customer_asset_folder = $this->config->item('customer_asset_folder');
		if(isset($site_settings->logo) and is_file($customer_asset_folder . '/' . $site_settings->logo))		
			$data['logo'] = $customer_source_url . '/' . $site_settings->logo;	
		
		$config = $this->_getMailConfig($site_settings);
		
		$this->load->library('email', $config);
		
		$this->email->from($from_email); // , 'Name of email id'
		$this->email->to($data['email']);
		$subject = str_replace('[SITE_TITLE]',  $site_settings->site_title, $subject);
		$this->email->subject($subject);    
        $body = $this->load->view('emails/'.$template, $data, TRUE);
		$this->email->message($body);   
        $this->email->send();
	}
	
	public function _getSiteSettings()
	{
		$this->load->model('cms/Site_settings_model');
		
		$site_settings =  $this->Site_settings_model->get(NULL, TRUE);
			
		return $site_settings;
	}
	
	private function _getMailConfig($site_settings = '')
	{
		// get site settings
		if($site_settings == '')
			$site_settings = $this->_getSiteSettings();
		
		$config = $this->Site_settings_model->getEmailConfigFromSettings($site_settings);
		
		return $config;
	}
	
	public function _unique_username ($str)
	{
		
		$id = $this->input->post('id');
		
		$this->db->where('username', $this->input->post('username'));

		!$id || $this->db->where('id !=', $id);

		$user = $this->Customers_model->get();

		if (count($user)) {

			$this->form_validation->set_message('_unique_username', 'Username already exists');
			return FALSE;

		}

		return TRUE;

	}
	
	public function _unique_email ($str)
	{
		
		$id = $this->input->post('id');
		
		$this->db->where('email', $this->input->post('email'));

		!$id || $this->db->where('id !=', $id);

		$user = $this->Customers_model->get();

		if (count($user)) {

			$this->form_validation->set_message('_unique_email', 'Email id already exists');
			return FALSE;

		}

		return TRUE;

	}
}