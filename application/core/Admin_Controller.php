<?php
class Admin_Controller extends MY_Controller {

	function __construct() {

		parent::__construct();
		
		$customer_admin = $this->config->item('customer_admin');
		$exception_uris = array(
			$customer_admin['login_url'],
			$customer_admin['logout_url']
		);
		$current_url = 'admin/'.$this->router->fetch_class() . '/' . $this->router->fetch_method();
		$this->load->library('auth');
		$this->load->library('session');
		//print_r($_SESSION);exit;
		// check against logged in
		if (in_array($current_url, $exception_uris) == FALSE) {

			if ($this->auth->logged_in('admin') == FALSE) {
				//print_r($_SESSION);exit;
				
				redirect($customer_admin['login_url']);

			}

		} else if($current_url == $customer_admin['login_url']) {
			// check if already login
			if ($this->auth->logged_in('admin')) {
				redirect($customer_admin['dashboard_url']);
			}
		}
		
		
		// Load the libraries
		$this->load->library('form_validation');
		$this->load->model('cms/Site_settings_model');
		$this->load->helper('cms_helper');
		
		$site_models = $this->config->item('site_models');
	 	$assets_path = $this->config->item('assets_path');

	 	//$this->data_common['page_name'] = $page_name;	
		$this->data_common['site_models'] = $site_models;
	 	$this->data_common['assets_path'] = ASSET;
	 	$this->data_common['selected_template_path'] = '';
	 	$this->data_common['selected_template_asset_path'] = ASSET;
		
		$template_path = '/admin';
		$this->data_common['customer_admin'] = $customer_admin;
		$this->data_common['selected_template_path'] = 'admin';
		$this->data_common['selected_template_asset_path'] = ASSET . $template_path;
		$this->data_common['customer_url_base'] = '';
		$this->_define_admin_tabs();		

		// set site settings
		$this->data_common['site_settings'] = $this->_getSiteSettings();
		
		$customer_asset_folder = $this->config->item('customer_asset_folder');
		$customer_source_url = $this->config->item('customer_source_url');
		if(isset($this->data_common['site_settings']->logo) and is_file($customer_asset_folder . '/' . $this->data_common['site_settings']->logo))		
			$this->data_common['logo'] = $customer_source_url . '/' . $this->data_common['site_settings']->logo;
		
		
		// Deletes cache for the currently requested URI
		//$this->output->delete_cache();
		//$this->db->cache_delete_all();
		
		// check post validate size
		if (isset($_SERVER["CONTENT_LENGTH"])) {
			$request_size = (int) $_SERVER['CONTENT_LENGTH'];
			$post_max_size = ini_get('post_max_size');
			$post_max_size_in_bytes = (int) $post_max_size*1024*1024;
			
			if( $request_size > $post_max_size_in_bytes) {
				$this->data_common['err_post_content_length'] = 'Process terminated. Requested data has more than ' . $post_max_size.' in SIZE.';
			}
		}
		
		$page_name = $this->router->fetch_class() . '/'. $this->router->fetch_method();
		$restricted_full_pages = array('site_settings/index', 'site_settings/email', 'social_media/index');
		
		$restricted_pages = array('process_add', 'add', 'process_edit', 'edit', 'create', 'add_banner', 'edit_banner', 'delete', 'gal_cat_add', 'gal_cat_edit', 'gal_cat_delete', 'add_gallery', 'edit_gallery');
		$restricted_controlers_noajax = array('pages', 'widgets', 'media', 'article_category', 'article', 'sponsors', 'testimonials');
		
		if(in_array($this->router->fetch_method(), $restricted_pages) 
			and in_array($this->router->fetch_class(), $restricted_controlers_noajax)
			and $_POST) 
		{
			if($this->_isNotEditable()) {
				$this->session->set_flashdata('error_message', $this->lang->line('error_permission_denied'));
				redirect(uri_string());
			}			
		}
		else if(in_array($page_name, $restricted_full_pages) and $_POST) 
		{
			if($this->_isNotEditable()) {
				$this->session->set_flashdata('error_message', $this->lang->line('error_permission_denied'));
				redirect(uri_string());
			}			
		}
		else if(in_array($this->router->fetch_method(), $restricted_pages)) 
		{
			if($this->_isNotEditable() and $this->input->is_ajax_request()) {
				$status['status'] = 0;
				$status['statusmsg'] = $this->lang->line('error_permission_denied');
				echo json_encode($status);
				exit;
			}			
		}

	}
	
	public function _send_mail($data, $template, $subject)
	{
		// get site settings
		$site_settings = $this->_getSiteSettings();
		$data['site_settings'] = $site_settings;
		if( $site_settings->admin_email ){
			$from_email = $site_settings->admin_email;
		} else {
			$admin_data = $this->session->userdata('data');
			$from_email = $admin_data->email;
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
        $this->email->send();
	}
	
	private function _getMailConfig()
	{
		// get site settings
		$site_settings = $this->_getSiteSettings();
		
		$config = Array(        
            'protocol' => 'mail', // mail, sendmail, or smtp
            //'smtp_host' => 'your domain SMTP host',
            //'smtp_port' => 25,
            //'smtp_user' => 'SMTP Username',
            //'smtp_pass' => 'SMTP Password',
            //'smtp_timeout' => '4',
			//'mailpath'	=> '/usr/sbin/sendmail',
            'mailtype'  => 'html', // text or html
            'charset'   => 'utf-8'
        );
		
		$protocol = $site_settings->mail_protocol;
		$mailpath = $site_settings->mail_path;
		
		if($protocol == 'sendmail') {
			
			$config['protocol'] = 'sendmail';
			$config['mailpath'] = $mailpath;
			
		} else if($protocol == 'smtp') {
			
			$config['protocol'] = 'smtp';
			$config['smtp_host'] = $site_settings->smtp_host_name;
			$config['smtp_user'] = $site_settings->smtp_username;
			$config['smtp_pass'] = $site_settings->smtp_password;
			$config['smtp_port'] = $site_settings->smtp_port;
			
			if($site_settings->smtp_timeout)
				$config['smtp_timeout'] = $site_settings->smtp_timeout;
						
		}
		
		
		return $config;
	}
	
	private function _define_admin_tabs()
	{
		// user interface
		$this->data_common['menus_url'] = array('menu/index', 'menu/add', 'menu/edit', 'menu_type/index');
		$this->data_common['pages_url'] = array('pages/index', 'pages/add', 'pages/edit');		
		$this->data_common['slider_url'] = array('media/index', 'media/add_banner', 'media/edit_banner');
		$this->data_common['sponsors_url'] = array('sponsors/index', 'sponsors/add', 'sponsors/edit');
		$this->data_common['testimonials_url'] = array('testimonials/index', 'testimonials/add', 'testimonials/edit');
		$this->data_common['template_url'] = array('templates/index', 'templates/add');
		$this->data_common['site_settings_url'] = array('site_settings/index', 'site_settings/email', 'site_settings/cart');
		$this->data_common['blog_url'] = array('article/index', 'article/add', 'article/edit', 'news/index', 'article_category/index'
											);
		$this->data_common['widgets_url'] = array('widgets/index', 'widgets/create', 'widgets/edit');
		
		$this->data_common['gallery_url'] = array('media/category', 'media/gallery', 'media/edit_gallery', 'media/add_gallery');
				
		
	}	
	
	public function _loadModel($model)
	{
		$this->load->model($this->data['site_models']['ecommerce'].'/'.$model);
	}
	
	public function _loadView($data, $subview)
	{
		$data['subview'] = $data['module_path'].'/'.$subview;
		$this->load->view($data['selected_template_path'].'/_layout_main', $data);
	}	
	
	public function _loadModelExtension($model, $inside_ecommerce = TRUE)
	{
		if($inside_ecommerce)
			$this->load->model($this->data['site_models']['ecommerce'].'/'.$model);
	}
	
	public function _loadViewExtension($data, $subview)
	{
		$data['module_path'] = $data['selected_template_path'].'/'.$data['site_models']['extension'];
		$data['subview'] = $data['module_path'].'/'.$subview;
		$this->load->view($data['selected_template_path'].'/_layout_main', $data);
	}
	
	public function _loadViewContentOnly($data, $subview)
	{
		$data['subview'] = $data['module_path'].'/'.$subview;
		$this->load->view($data['selected_template_path'].'/_layout_content_only', $data);
	}
}