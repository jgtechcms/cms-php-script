<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Paypal extends Front_Controller 
{
     function  __construct(){
        parent::__construct();
        $this->load->library('paypal_lib');
        $this->data = $this->data_common;
     }
     
     function success(){
        
		$this->define_common_component();
		
		//get the transaction data
        $paypalInfo = $this->input->post();//print_r($paypalInfo);exit;
		$custom = json_decode($paypalInfo['custom'], true);
          
        $this->data['order_number']    = $custom["order_number"]; 
        $this->data['txn_id'] = $paypalInfo["txn_id"];
        $this->data['payment_amt'] = $paypalInfo["mc_gross"];
        $this->data['currency_code'] = $paypalInfo["mc_currency"];
        $this->data['status'] = $paypalInfo["payment_status"];
        
        //pass the transaction data to view
        $this->load->view('paypal/success', $this->data);
     }
     
     function cancel(){
        
		$this->define_common_component();
		
        $this->load->view('paypal/cancel', $this->data);
     }
     
     function ipn(){
        //paypal return transaction details array
        $paypalInfo    = $this->input->post();//mail('jerosilinvinoth@gmail.com', 'ipn request', print_r($paypalInfo, TRUE));
		$custom = json_decode($paypalInfo['custom'], true);
        
		$data['user_id'] = $custom['user_id'];
        $data['order_id']    = $custom["order_number"];
        $data['txn_id']    = $paypalInfo["txn_id"];
        $data['payment_gross'] = $paypalInfo["payment_gross"];
        $data['currency_code'] = $paypalInfo["mc_currency"];
        $data['payer_email'] = $paypalInfo["payer_email"];
        $data['payment_status']    = $paypalInfo["payment_status"];

        $paypalURL = $this->paypal_lib->paypal_url;        
        $result    = $this->paypal_lib->curlPost($paypalURL,$paypalInfo);
		
		//mail('jerosilinvinoth@gmail.com', 'ipn result', print_r($result, TRUE));exit;
        
        //check whether the payment is verified
        if(preg_match("/VERIFIED/i",$result)){
            //insert the transaction data into the database
            //$this->product->insertTransaction($data);
			
			$this->db->cache_delete_all();
			
			$this->db->insert('payments', $data);
			
			// update order status
			$update_data = array(
				'ord_status' => 2 // New Order from order_status table
			);
			$this->db->where('ord_order_number', $data['order_id']);
			$this->db->update('order_summary', $update_data);
        }
    }
}