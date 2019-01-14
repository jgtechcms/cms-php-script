<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Session extends CI_Session {
    
	public function __construct($params = array())
    {
        $CI =& get_instance();
		// Set all the session preferences, which can either be set
		// manually via the $params array above or via the config file
		foreach (array('sess_encrypt_cookie', 'sess_use_database', 'sess_table_name', 'sess_expiration', 'sess_expire_on_close', 'sess_match_ip', 'sess_match_useragent', 'sess_cookie_name', 'cookie_path', 'cookie_domain', 'cookie_secure', 'sess_time_to_update', 'time_reference', 'cookie_prefix', 'encryption_key') as $key)
		{
			$this->$key = (isset($params[$key])) ? $params[$key] : $CI->config->item($key);
		}
		
		if( isset( $_GET['session_id'] ) ) 
			$_COOKIE[ $this->sess_cookie_name ] = $_GET['session_id'];
	   // Session now looks up $_COOKIE[ 'session_id' ] to get the session_id
		//print_r($_COOKIE[ $this->sess_cookie_name ]);exit;
		parent::__construct();
    }
	
}