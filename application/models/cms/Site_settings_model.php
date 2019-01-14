<?php

class Site_settings_model extends MY_Model

{

	protected $_table_name = 'site_settings';

	protected $_order_by = 'id desc';

	protected $_timestamps = TRUE;

	public $rules = array(
	
		'sitetitle' => array(

			'field' => 'sitetitle', 

			'label' => 'Site title', 

			'rules' => 'trim|required|max_length[150]'

		), 
		
		'address' => array(

			'field' => 'address', 

			'label' => 'Address', 

			'rules' => 'trim|required|max_length[150]'

		), 

		'phone' => array(

			'field' => 'phone', 

			'label' => 'Phone No', 

			'rules' => 'trim|required|max_length[20]'

		), 

		'subdomain' => array(

			'field' => 'subdomain', 

			'label' => 'Sub Domain', 

			'rules' => 'trim|required|max_length[100]|callback__unique_subdomain|xss_clean'

		),
		
		'name' => array(

			'field' => 'name', 

			'label' => 'Login Name', 

			'rules' => 'trim|required|max_length[100]|callback__unique_loginname|xss_clean'

		),
		
		'pass' => array(

			'field' => 'pass', 

			'label' => 'Login Password', 

			'rules' => 'trim|required'

		),
		
	);
	
	public $rules_edit = array(
	
		'sitetitle' => array(

			'field' => 'sitetitle', 

			'label' => 'Site title', 

			'rules' => 'trim|required|max_length[150]'

		), 
		/*
		'address' => array(

			'field' => 'address', 

			'label' => 'Address', 

			'rules' => 'trim|required|max_length[150]'

		),

		'phone' => array(

			'field' => 'phone', 

			'label' => 'Phone No', 

			'rules' => 'trim|required|max_length[20]'

		), 

		*/
		
	);
	
	public $rules_email_smtp = array(
	
		'smtp_host_name' => array(

			'field' => 'smtp_host_name', 

			'label' => 'SMTP Hostname', 

			'rules' => 'trim|required|max_length[100]'

		), 
	
		'smtp_username' => array(

			'field' => 'smtp_username', 

			'label' => 'SMTP Username', 

			'rules' => 'trim|required|max_length[150]'

		), 
	
		'smtp_password' => array(

			'field' => 'smtp_password', 

			'label' => 'SMTP Password', 

			'rules' => 'trim|required|max_length[50]'

		), 
	
		'smtp_port' => array(

			'field' => 'smtp_port', 

			'label' => 'SMTP Port', 

			'rules' => 'trim|required|max_length[6]'

		), 
		
		
	);
	
	public function getEmailConfigFromSettings($site_settings)
	{
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
	

}