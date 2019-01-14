<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 
/**
 * Code Igniter
 *
 * An open source application development framework for PHP 4.3.2 or newer
 *
 * @package		CodeIgniter
 * @author		Rick Ellis
 * @copyright	Copyright (c) 2006, pMachine, Inc.
 * @license		http://www.codeignitor.com/user_guide/license.html
 * @link		http://www.codeigniter.com
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * PayPal_Lib Controller Class (Paypal IPN Class)
 *
 * This CI library is based on the Paypal PHP class by Micah Carrick
 * See www.micahcarrick.com for the most recent version of this class
 * along with any applicable sample files and other documentaion.
 *
 * This file provides a neat and simple method to interface with paypal and
 * The paypal Instant Payment Notification (IPN) interface.  This file is
 * NOT intended to make the paypal integration "plug 'n' play". It still
 * requires the developer (that should be you) to understand the paypal
 * process and know the variables you want/need to pass to paypal to
 * achieve what you want.  
 *
 * This class handles the submission of an order to paypal as well as the
 * processing an Instant Payment Notification.
 * This class enables you to mark points and calculate the time difference
 * between them.  Memory consumption can also be displayed.
 *
 * The class requires the use of the PayPal_Lib config file.
 *
 * @package     CodeIgniter
 * @subpackage  Libraries
 * @category    Commerce
 * @author      Ran Aroussi <ran@aroussi.com>
 * @copyright   Copyright (c) 2006, http://aroussi.com/ci/
 *
 */

// ------------------------------------------------------------------------

class Ebs_lib {
	
	var $CI;
	var $fields;
	var $submit_btn;
	
	var $ebs_url;
	var $ebs_mode;
	var $channel;
	var $hash_data;
	
	function __construct()
	{
		$this->CI =& get_instance();
		$this->CI->load->helper('url');
		$this->CI->load->helper('form');
		
		$this->ebs_url ='https://secure.ebs.in/pg/ma/payment/request';
		$this->channel = '0'; // standared payment
		$this->fields = array();
		
	}
	
	function addAPIFilelds()
	{
		$this->CI->load->model('Payment_gateway_settings_model');
		
		$payment_gateway = $this->CI->config->item('payment_gateway');		
		$gateway_settings = $this->CI->Payment_gateway_settings_model->get_by(array('gateway_id' => $payment_gateway['ebs']));
		
		foreach($gateway_settings as $settings) {
			${$settings->variable_name} = $settings->value;
		}
		$mode = strtoupper($mode);
		$channel = $this->channel;
		$this->hash_data = $hash_data;
		
		$this->addField('account_id', $account_id);
		$this->addField('channel', $channel);
		$this->addField('currency', $currency_code);
		$this->addField('country', $country_code);
		$this->addField('mode', $mode);
	}

	function button($value)
	{
		$this->submit_btn = form_submit('pp_submit', $value, "class='btn btn-primary'");
	}


	function addField($field, $value) 
	{
		
		$this->fields[$field] = $value;
	}

	function generateForm() 
	{
		
		$this->button('Click here if you\'re not automatically redirected...');
		
		$html = '<p style="text-align:center;">Please wait, your order is being processed and you will be redirected to the third party website.</p>';
		$html .= $this->ebs_form('ebs_auto_form');
		
		return $html;
	}

	function ebs_form($form_name) 
	{
		$hashData = $this->hash_data;
		ksort($this->fields);
		
		foreach ($this->fields as $key => $value){
			if (strlen($value) > 0) {
				$hashData .= '|'.$value;
			}

		}

		if (strlen($hashData) > 0) {
			 $this->fields['secure_hash'] = strtoupper(hash("sha512",$hashData));
		}
		
		$str = '<form method="POST" action="'.$this->ebs_url.'" name="'.$form_name.'"/>' . "\n";	
		foreach ($this->fields as $name => $value) {
			
			$str .= form_hidden($name, $value) . "\n";
			
		}
		$str .= '<p style="text-align:center">'. $this->submit_btn . '</p>';
		$str .= form_close() . "\n";

		return $str;

	}
	
	
	function curlPost($paypalurl,$paypalreturnarr)
	{
		
		$req = 'cmd=_notify-validate';
		foreach($paypalreturnarr as $key => $value) 
		{
			$value = urlencode(stripslashes($value));
			$req .= "&$key=$value";
		}
			
		$ipnsiteurl=$paypalurl;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $ipnsiteurl);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
		$result = curl_exec($ch);
		curl_close($ch);
	
		return $result;
	}

}

?>