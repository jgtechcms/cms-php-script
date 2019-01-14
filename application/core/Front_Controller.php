<?php
class Front_Controller extends MY_Controller {

	function __construct() {

		parent::__construct();
		
		$this->output->nocache();
		
		$this->load->library('auth');
		
		$dashborrd = $this->config->item('user_dashborrd');
		$login_check_uris = array(
			'users/profile',
			'users/change_password',
			'users/saved_addresses',
			'users/get_addresss',
			'users/delete_addresses',
			'users/orders',
			'users/order_complete',
			'users/cancel_orders',
			'users/order_details',
			'products/wishlist',
			'products/ajax_add_to_wishlist',
			'products/delete_wishlist',
			'products/add_wishlist_to_cart'
		);
		// check against logged in
		if (in_array(uri_string(), $login_check_uris)) {

			if ($this->auth->logged_in() == FALSE) {

				// check for ajax request
				if ($this->input->is_ajax_request()) {
					
					$return = array('status' => 0, 'msg' => 'Please login to perform this request.');
					echo json_encode($return);
					exit;
					
				} else {
				
					redirect($dashborrd['login_url']);
				}

			}

		} else if(uri_string() == $dashborrd['login_url']) {
			// check if already login
			if ($this->auth->logged_in()) {
				redirect($dashborrd['profile_url']);
			}
		}
		$site_models = $this->config->item('site_models');
		
		
		// Load the libraries
		$this->load->library('form_validation');
		$this->load->library('session');
		//$this->load->helper('string_helper');
		$this->load->helper('text_helper');
		$this->load->helper('cms_helper');
		$this->load->model('cms/Site_settings_model');
		
	 	$assets_path = $this->config->item('assets_path');
	 	//$page_name = 'register';	

	 	$this->data_common['site_models'] = $site_models;
		$this->data_common['dashborrd'] = $dashborrd;
		$this->data_common['customer_url_base'] = '';
	 	$this->data_common['assets_path'] = ASSET;
	 	$this->data_common['selected_template_path'] = '';
	 	$this->data_common['selected_template_asset_path'] = ASSET;
		
		$this->data_common['user_template'] = 'template1'; // default
		$this->data_common['asset_path'] = $this->data_common['selected_template_asset_path'] . '/' . $this->data_common['user_template'];	
		
		// set site settings
		$this->data_common['site_settings'] = $this->_getSiteSettings();
		
		/*
		$current_page = $this->router->fetch_class() . '/' . $this->router->fetch_method();
		$cach_exceptions = array (
			'users/login', 'users/register', 'users/profile',
			'products/add_to_cart', 'products/cart', 'products/index', 'products/checkout'
		);
		
		if(!in_array($current_page, $cach_exceptions)) {
			$minutes = 60 * 24; // 1 day
			$this->output->cache($minutes);
		} else {
			$this->db->cache_off();
		}
		*/

	}
	
	public function define_common_component()
	{	
		$this->load->model('free/Menu_model');
		$this->load->model('free/User_menu_model');		
		$this->load->model('free/Social_media_model');
		
		$banner_folder = $this->config->item('banner_folder');
		$customer_source_url = $this->config->item('customer_source_url');
		$customer_asset_folder = $this->config->item('customer_asset_folder');		
		$thumpath = 'thumbs_banner';
		$customer_banner_folder = $customer_source_url . '/' . $banner_folder . '/';
		
		// get site settings
		$site_settings = $this->_getSiteSettings();
		
		// get social media
		$this->data['social_medias'] = $this->Social_media_model->get_by(array('status' => 1));
		
		$menus = $this->Menu_model->get();
					
		// get user menu
		$header_menu = $this->User_menu_model->getUserMenu('header');
		$footer_menu_1 = $this->User_menu_model->getUserMenu('footer1');
		$footer_menu_2 = $this->User_menu_model->getUserMenu('footer2');
		$footer_menu_3 = $this->User_menu_model->getUserMenu('footer3');
		$footer_menu_4 = $this->User_menu_model->getUserMenu('footer4');
		
		$this->data['header_menu'] = $header_menu;
		$this->data['footer_menu_1'] = $footer_menu_1;
		$this->data['footer_menu_2'] = $footer_menu_2;
		$this->data['footer_menu_3'] = $footer_menu_3;
		$this->data['footer_menu_4'] = $footer_menu_4;
		$this->data['customer_banner_folder'] = $customer_banner_folder;
		
		$this->data['site_title'] = '';
		$this->data['site_address'] = '';
		$this->data['site_phone'] = '';
		$this->data['ga_code'] = '';
		$this->data['site_logo'] = '';
		$this->data['site_favicon'] = '';
		$this->data['custom_css'] =  '';
		if(isset($site_settings->id)) {
			$this->data['site_title'] =  $site_settings->site_title;
			$this->data['site_address'] =  nl2br($site_settings->address);
			$this->data['site_phone'] =  $site_settings->phone;
			$this->data['admin_email'] =  $site_settings->admin_email;
			$this->data['ga_code'] =  $site_settings->ga_code;
			$this->data['site_logo'] =  $site_settings->logo;
			$this->data['site_favicon'] =  $site_settings->favicon;
			$this->data['site_copy_right'] =  $site_settings->copy_right;
			$this->data['background_image'] =  $site_settings->background_image;
			$this->data['custom_css'] =  $site_settings->custom_css;
		}
		
		// check logo
		if(isset($site_settings->logo) and is_file($customer_asset_folder . '/' . $site_settings->logo))		
			$this->data['logo'] = $customer_source_url . '/' . $site_settings->logo;
		// check favicon
		if(isset($site_settings->favicon) and is_file($customer_asset_folder . '/' . $site_settings->favicon))		
			$this->data['favicon'] = $customer_source_url . '/' . $site_settings->favicon;
		// check background image
		if($site_settings->background_image and is_file($customer_asset_folder . '/' . $site_settings->background_image))		
			$this->data['background_image'] = $customer_source_url . '/' . $site_settings->background_image;
		
		$this->data['menus'] = $menus;
				
		// get template
		$current_template = $this->db->get_where('templates', array('id' => $site_settings->template_id), 1)->row();
		
		$this->data['user_template'] = $current_template->slug;
		$this->data['asset_path'] = $this->data['selected_template_asset_path'] . '/' . $this->data['user_template'];
		
		$this->data['banner'] = '';
		$this->data['current_menu'] = '';			
		$this->data['page'] = '';
		
		$this->data['show_searchbox'] = $this->_isShowSearchbox();
		
	}	
	
	public function _isShowSearchbox()
	{
		$show = true;
		$hide_pages = array('users/login', 'users/register');
		
		if(in_array($this->router->fetch_class().'/'.$this->router->fetch_method(), $hide_pages))
			$show = false;
		
		return $show;
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
		
		$config = $this->_getMailConfig();
		
		$this->load->library('email', $config);
		
		$this->email->from($from_email); // , 'Name of email id'
		$this->email->to($data['email']);
		$subject = str_replace('[SITE_TITLE]',  $site_settings->site_title, $subject);
		$this->email->subject($subject);    
        $body = $this->load->view('emails/'.$template, $data, TRUE);
		$this->email->message($body);   
        return $this->email->send();
	}
	
	public function _send_mail_to_admin($data, $template, $subject)
	{		
		// get site settings
		$site_settings = $this->_getSiteSettings();
		
		$data['site_settings'] = $site_settings;
		
		$this->load->model('cms/User_model');
		$user_type = config_item('user_type');
		$admin = $this->User_model->get_by(array('user_type' => $user_type['admin']),TRUE);
		$admin_notify_email = $from_email = $admin->email;
		
		if($site_settings->admin_notify_email)
			$admin_notify_email = $site_settings->admin_notify_email;
		
		if( $site_settings->admin_email )
			$from_email = $site_settings->admin_email;	
		
		$config = $this->_getMailConfig();
		
		$this->load->library('email', $config);
		
		$this->email->from($from_email); // , 'Name of email id'
		$this->email->to($admin_notify_email);
		$subject = str_replace('[SITE_TITLE]',  $site_settings->site_title, $subject);
		$this->email->subject($subject);    
        $body = $this->load->view('emails/'.$template, $data, TRUE);
		$this->email->message($body);   
        return $this->email->send();
	}
	
	public function _clearCacheAll()
	{
		$this->db->cache_delete_all();		
		$this->output->clear_all_cache();
	}
	
	public function _isLoggedIn()
	{
		$user_data = $this->session->userdata('data');
		
		if($user_data) {
			return true;
		}
		return false;
	}
	
	private function _getConfigCommon()
	{
		$config_data = $this->session->userdata('config_data');
		
		if($config_data and !$this->_isDemo()) {
			
			return $config_data;
			
		} else {
			
			$this->load->model('Config_common_model');
			
			$config_common =  $this->Config_common_model->get();
			
			$config_data = array();
			
			foreach($config_common as $config) {
				
				$config_data[$config->slug]['is_installed'] = $config->is_installed;
				
				if($config->is_installed) {
					
					$this->load->model($this->data['site_models']['extension'].'/'.$config->model_name);
					$config_data[$config->slug]['data'] = $this->{$config->model_name}->get();
				}
			}
			
			$this->session->set_userdata('config_data', $config_data);
			
			return $config_data;
		}
	}
	
	private function _getMailConfig()
	{
		// get site settings
		$site_settings = $this->_getSiteSettings();
		$config = $this->Site_settings_model->getEmailConfigFromSettings($site_settings);
		
		return $config;
	}
}