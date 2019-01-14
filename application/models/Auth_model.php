<?php

class Auth_model extends MY_Model {
	
	protected $_table_name;
	protected $login_field;
	protected $password_field;
	protected $primary_field;
	var $user_type = 'user_type';

	public function __construct()
    {
        // Call the CI_Model constructor
        parent::__construct();
		
		//echo $this->_table_name = parent::_table_name;;
    }
	
	public function getLoginDetail($usertype)
	{
		$config_user_type = config_item('user_type');
		if(!isset($config_user_type[$usertype]))
			return array();
		
		$login_data = array(

			$this->login_field => $this->input->post($this->login_field),

			$this->password_field => $this->hash($this->input->post($this->password_field)),
			
			$this->user_type => $config_user_type[$usertype]

		);
		
		$user = $this->get_by($login_data, TRUE);
		
		return $user;
	}
	
	public function hash ($string)
	{
		return hash('sha512', $string . config_item('encryption_key'));
	}

}