<?php

class Api extends App_Controller {

    public function __construct() {

        parent::__construct();
		
		$this->load->model('Api_model');
		
		$this->data = $this->data_common;
		$this->data['status'] = 1;
	}
	
	public function settings()
	{
		
		$this->data['site_settings'] =  $this->_getSiteSettings();
		$customer_source_url = $this->config->item('customer_source_url');
		$this->data['site_settings']->logo = site_url($customer_source_url .'/' . $this->data['site_settings']->logo);
		$this->data['site_settings']->favicon = site_url($customer_source_url .'/' . $this->data['site_settings']->favicon);
		
		// unset unwanted
		unset($this->data['site_settings']->id);
		unset($this->data['site_settings']->ga_code);
		unset($this->data['site_settings']->template_type);
		unset($this->data['site_settings']->template_id);
		unset($this->data['site_settings']->template_modified);
		unset($this->data['site_settings']->template_request_id);
		unset($this->data['site_settings']->custom_template_name);
		unset($this->data['site_settings']->copy_right);
		unset($this->data['site_settings']->background_image);
		//unset($this->data['site_settings']->is_ecommerce_enabled);
		unset($this->data['site_settings']->lkey);
		unset($this->data['site_settings']->gen_key);
		
		$this->printOutput($this->data);
	}
	
	public function menu()
	{
		$this->load->model('free/User_menu_model');	
		
		$this->data['menu'] = $this->User_menu_model->getUserMenu('header');
		
		$this->printOutput($this->data);
	}
	
	public function page($slug = '')
	{
		$this->data['pages'] = $this->Api_model->getPage($slug);
		
		if($this->data['pages']) {
			
			if($this->data['pages']->is_product)
				$this->data['pages'] = $this->Api_model->getPage($slug);
			
			$this->printOutput($this->data);
		}
		
		$this->printOutput();
	}
	
	public function login()
	{
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			
			$this->load->model('free/User_model', 'Customers_model');
			$this->load->library('form_validation');
			
			$rules = $this->Customers_model->rules;

			$this->form_validation->set_rules($rules);			
			
			if ($this->form_validation->run() == TRUE) {
				
				$this->load->library('auth');
				
				$this->table_config = $this->Customers_model->getTableConfig();
				
				$this->data['user'] = $this->auth->login_app();
			
				if ($this->data['user'] == FALSE) {
					$this->printOutput(array('status' => 0, 'msg' => 'The Login name/password combination does not exist.'));
				}
				else {
					$this->printOutput($this->data);
				}

			} else {
				$this->printOutput(array('status' => 0, 'msg' => validation_errors()));
			}
			
		} 
		
		$this->printOutput();
	}
	
	public function register()
	{
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			
			$this->load->model('free/User_model', 'Customers_model');
			$this->load->library('form_validation');
			
			$rules = $this->Customers_model->rules_register;
			$this->form_validation->set_rules($rules);
			
			if ($this->form_validation->run() == TRUE) {
				
				$result = $this->Customers_model->save_data();
				
				if($result) {
					$subject = 'Welcome to [SITE_TITLE]';
					$this->_send_mail($result, 'register', $subject);
				}
				
				$this->printOutput(array('status' => 1, 'msg' => 'Registered successfully <br/>Login to continue...'));				
				
			} else {
				$this->printOutput(array('status' => 0, 'msg' => validation_errors()));
			}
		}
		
		$this->printOutput();
	}
	
	public function get_category()
	{
		$this->load->model($this->data['site_models']['ecommerce'].'/Product_category_model');
		$cat_lists = $this->Product_category_model->getCategoryWithSubcategory();
		$this->data['category'] = $cat_lists['category'];
		//$this->data['sub_category'] = $cat_lists['sub_category'];
		
		$this->printOutput($this->data);
	}
	
	public function get_products()
	{
		$page = ($this->input->post('page') == '') ? 1 : $this->input->post('page');
		$sort = $this->input->post('sort');
		$brand = $this->input->post('brand');
		$category_id = $this->input->post('category_id');
		$subcategory_id = $this->input->post('subcategory_id');
		$search = $this->input->post('search');
		
		$filter_data = array('category_id' => $category_id, 'subcategory_id' => $subcategory_id, 'search' => $search, 'brand' => $brand);
		
		$this->_defineEcommerce();
		
		$this->_loadModel('Products_front_model');
		$this->data['item_data'] = $this->Products_front_model->get_productlist_item_data($page,$sort,$filter_data);
		
		$this->printOutput($this->data);
	}
	
	public function product_details($id = null)
	{
		if(!is_null($id)) 
		{
			$this->_loadModel('Products_front_model');
			$this->_loadModel('Product_banner_model');
			$this->_loadModel('Product_reviews_model');
			
			$this->_defineEcommerce();
			
			$this->data['product_item'] = $this->Products_front_model->getProductDetailById($id);
			$this->data['product_images'] = $this->Product_banner_model->get_by(array('product_id' => $id));
			$this->data['product_reviews'] = $this->Product_reviews_model->getProductReviews($id, 0);
			$this->printOutput($this->data);
		}
		
		$this->printOutput();
	}
	
	public function get_reviews($item_id, $offset = 0)
	{
		$this->load->model($this->data['site_models']['ecommerce'].'/Product_reviews_model');
		
		$this->data['product_reviews'] = $this->Product_reviews_model->getProductReviews($item_id, $offset);
		
		$this->printOutput($this->data);
	}
	
	public function add_review()
	{
			
		$response = array('status' => 0, 'msg' => 'Invalid request.');
		
		if($this->input->server('REQUEST_METHOD') == 'POST') {
			
			$this->load->model($this->data['site_models']['ecommerce'].'/Product_reviews_model');
			
			// Validation the form
			$rules = $this->Product_reviews_model->rules;
			
			$this->form_validation->set_rules($rules);
			
			if ($this->form_validation->run() == FALSE)
			{
				$response['msg'] = validation_errors();
			}
			else
			{
				
				//if($this -> input -> post('id')){$id = $this -> input -> post('id');} 
				$data['added_date'] = date('Y-m-d H:i:s');
				$data['product_id'] = $this -> input -> post('product_id');
				$data['name'] = $this -> input -> post('name');
				$data['email'] = $this -> input -> post('email');
				$data['website'] = '';//$this->input->post('website');
				$data['comments'] = $this->input->post('comments');
				$data['rating'] = $this -> input -> post('rating');
				$data['user_id'] = $this -> input -> post('user_id');
				$data['status'] = 0;
								
				$review_id = $this->Product_reviews_model->save($data);	
				
				if ($review_id == FALSE)
				{
					$response['msg'] = 'Something wrong while processing data. Please try again.';
				}
				else
				{
					
					$response['msg'] = 'Thank you. Your review will be published after admin approval.';
					$response['status'] = 1;
				}

			}
		}
		
		$this->printOutput($response);
	}
	
	public function get_wishlists() 
	{		
		$this->load->model($this->data['site_models']['ecommerce'].'/Product_wishlists_model');
				
		$user_id = $this -> input -> post('user_id');
		
		$this->data['wishlists'] = $this->Product_wishlists_model->getWishlists($user_id);
		
		$this->printOutput($this->data);
	}	
	public function add_wishlist()
	{
		$response = array('status' => 0, 'msg' => 'Invalid request.');
		
		if($this->input->server('REQUEST_METHOD') == 'POST') {
		
			$item_id = $this->input->post('item_id');
			$user_id = $this -> input -> post('user_id');
			
			$wishlist_data = array(
				'product_id' => $item_id, 
				'user_id' => $user_id, 
				'added_date' => date('Y-m-d H:i:s')
			);

			$this->load->model($this->data['site_models']['ecommerce'].'/Product_wishlists_model');
			
			if(!$this->Product_wishlists_model->ifWishlistExists($wishlist_data)) {
				$added = $this->Product_wishlists_model->save($wishlist_data);
				
				$response = array('status' => 1, 'msg' => 'Product added to wishlist.');
			
				if($added == FALSE)
					$response = array('status' => 0, 'msg' => 'Something wrong while processing your data. Please try again later.');
			} else {
				$response = array('status' => 0, 'msg' => 'Product already exists in wishlist.');
			}
			
		}
		
		$this->printOutput($response);
	}	
	public function delete_wishlist()
	{
		if($this->input->server('REQUEST_METHOD') == 'POST') {
			
			$this->load->model($this->data['site_models']['ecommerce'].'/Product_wishlists_model');
			
			$item_id = $this -> input -> post('item_id');
			$user_id = $this -> input -> post('user_id');
			
			$wishlist_data = array(
				'product_id' => $item_id, 
				'user_id' => $user_id
			);
			
			if($this->Product_wishlists_model->ifWishlistExists($wishlist_data)) {
			
				$this->Product_wishlists_model->removeProduct($user_id, $item_id);
				
				$this->data['msg'] = 'Product removed from wishlist';
				$this->printOutput($this->data);
				
			} 
		}
		
		$this->printOutput();
	}
	
	public function add_to_cart($item_id = null)
	{
		$this->_defineEcommerce();
		
		$this->_loadModel('Products_front_model');
		
		$return = array('status' => 0, 'msg' => 'Invalid request.');
		
		if($item_id) {
			
			if($this->Products_front_model->isValidQuantity()) {
				
				$ret = $this->Products_front_model->insert_item_to_cart($item_id);
				
				if($ret) {
				
					$this->_save_cart_data();

					$return = array('status' => 1, 'msg' => 'Product added to cart.');
				}
				
			} else {
			
				$return = array('status' => 0, 'msg' => $this->lang->line('item_stock_insufficient'));//'There is insufficient stock to fulfill the quantity of items in the cart.'
			}
		}
		
		$this->printOutput($return);
	}
	
	public function delete_cart_item($row_id = FALSE) 
	{
		$this->_defineEcommerce();
		
		$this->flexi_cart->delete_items($row_id);
		
		// re-save cart table
		$cart_items = $this->flexi_cart->cart_items();
		$this->delete_cart_data();
		if(!empty($cart_items)) {
			$this->_save_cart_data();
		}
		
		$return = array('status' => 1, 'msg' => 'Product removed from cart.');	

		$this->printOutput($return);
	}
	
	public function delete_cart_data() 
	{
		if($this->session->userdata('id'))
		{		
			// The load/save/delete cart data functions require the flexi cart ADMIN library.
			$this->load->library('flexi_cart_admin');
			
			$sql_where = array(
				$this->flexi_cart->db_column('db_cart_data', 'user') => $this->session->userdata('id'),
				$this->flexi_cart->db_column('db_cart_data', 'readonly_status') => 0
			);
			
			// Delete the saved cart data from the database.
			$this->flexi_cart_admin->delete_db_cart_data($sql_where);
		}
		
	}
	
	public function get_cart()
	{
		$this->_defineEcommerce();
		
		// Update cart contents and settings.
		if ($this->input->post('update'))
		{
			$this->update_cart();
		}
		// Update discount codes.
		else if ($this->input->post('update_discount'))
		{
			$this->update_discount_codes();
		}
		// Remove discount code.
		else if ($this->input->post('remove_discount_code'))
		{
			$this->remove_discount_code();
		}
		// Remove all discount codes.
		else if ($this->input->post('remove_all_discounts'))
		{
			$this->remove_all_discounts();
		}
				
		$cart_items = $this->flexi_cart->cart_items();
		$cart_items_re_arranged = array();
		foreach($cart_items as $cart) {
			$cart_items_re_arranged[] = array(
				'row_id'		=> $cart['row_id'],
				'item_id'		=> $cart['id'],
				'name'			=> $cart['name'],
				'quantity'		=> $cart['quantity'],
				'unit_price'	=> $cart['price'],
				'unit_weight'	=> $cart['weight'],
				'image'			=> $cart['banner'],
				'price_total'	=> $cart['price_total']
			);
		}
		
		$this->data['cart_items'] = $cart_items_re_arranged;
		if($cart_items_re_arranged) {
			$this->data['cart_summary'] = $this->flexi_cart->cart_summary();
			// unset unwanted
			unset($this->data['cart_summary']['total_reward_points']);
			unset($this->data['cart_summary']['reward_voucher_total']);
			if (!$this->flexi_cart->surcharge_status())
				unset($this->data['cart_summary']['surcharge_total']);
			
			$this->data['cart_summary']['tax'] = $this->flexi_cart->tax_name()." @ ".$this->flexi_cart->tax_rate();
		}
		
		// discounts
		$this->data['discounts'] = $this->flexi_cart->summary_discount_data();
		
		// shipping data
		$countries = $states = $postal_codes = $shipping_options = array();
		$sql_select = array($this->flexi_cart->db_column('locations', 'id'), $this->flexi_cart->db_column('locations', 'name')); 	
		$countries_temp = $this->flexi_cart->get_shipping_location_array($sql_select, 0);
		$states_temp = $this->flexi_cart->get_shipping_location_array($sql_select, 1);
		$postal_codes = $this->flexi_cart->get_shipping_location_array($sql_select, 2);
		$shipping_options_temp = $this->flexi_cart->get_shipping_options();
		foreach($countries_temp as $country) {
			$country['selected'] = $this->flexi_cart->match_shipping_location_id($country['loc_id']);
			$countries[] = $country;
		}
		foreach($states_temp as $state) {
			$state['selected'] = $this->flexi_cart->match_shipping_location_id($state['loc_id']);
			$states[] = $state;
		}
		foreach($shipping_options_temp as $shipping) {
			$shipping['selected'] = ($shipping['id'] == $this->flexi_cart->shipping_id()) ? true : false;
			$shipping_options[] = $shipping;
		}
		 	
		$this->data['countries'] = $countries;
		$this->data['states'] = $states;
		$this->data['postal_codes'] = $postal_codes;
		$this->data['default_postal_code'] = $this->flexi_cart->shipping_location_name(3);
		$this->data['shipping_options'] = $shipping_options;
		
		$this->printOutput($this->data);
	}
	
	public function checkout() 
	{
		$this->_defineEcommerce();
		
		$this->_loadModel('Products_front_model');
		
		if (! $this->flexi_cart->cart_status())
		{			
			$this->data['status'] = 0;
			$this->data['msg'] = 'You must add an item to the cart before you can checkout.';

			$this->printOutput($this->data);
			
		} else {
			
			if ($this->input->post('checkout'))
			{
				$response = $this->Products_front_model->demo_save_order();
				
				if($response) {
					
					$this->data['order_number'] = $order_number = $this->flexi_cart->order_number();
					
					$this->load->library('flexi_cart_admin');
					
					$sql_where = array($this->flexi_cart_admin->db_column('order_summary', 'order_number') => $this->data['order_number']);
					
					if ($order_data = $this->flexi_cart_admin->get_db_order_summary_row_array('ord_demo_email', $sql_where))
					{
						$this->data['user_email'] = $order_data['ord_demo_email'];
						$orderdata = $this->flexi_cart_admin->get_email_order($order_number);
					
						if($orderdata) {
							
							$orderdata['email'] = $order_data['ord_demo_email'];				
							$orderdata['order_no'] = $order_number;
							
							$subject = '[SITE_TITLE] - Order Confirmation '.$order_number;
							$this->_send_mail($orderdata, 'order_confirm', $subject);
							
							/*$quantity = (int)$orderdata['summary_data'][$this->flexi_cart_admin->db_column('order_summary', 'total_items')];
							$amount = (int)$orderdata['summary_data'][$this->flexi_cart_admin->db_column('order_summary', 'total')];
							$name = $orderdata['summary_data']['ord_demo_bill_name'];										
							$address = $orderdata['summary_data']['ord_demo_bill_address_01'];
							$address .= $orderdata['summary_data']['ord_demo_bill_address_02'];											
							$city = $orderdata['summary_data']['ord_demo_bill_city'];
							$state = $orderdata['summary_data']['ord_demo_bill_state'];
							$postal_code = $orderdata['summary_data']['ord_demo_bill_post_code'];
							$country = $orderdata['summary_data']['ord_demo_bill_country'];
							$email = $orderdata['summary_data']['ord_demo_email'];
							$phone = $orderdata['summary_data']['ord_demo_phone'];*/

							$payment_type = 'cod';//$this -> input -> post('payment_type');
							
							if($payment_type == 'cod') 
							{ // Cash on delivery
								
								//$orderdata['payment_type'] = $payment_type;
								
								// Piegon place order
								
								/*$this->load->library('piegon_lib');
								$this->piegon_lib->process_place_order($orderdata);
								
								$shipping_order_response_data = $this->piegon_lib->shipping_order_response_data;
								$response_status = 'Failure';
								if($this->piegon_lib->is_success_order()) {
									$response_data = $this->piegon_lib->response_data;
									$response_status = 'Success';
									
									// send mail
									//$orderdata['shipping_partner'] = $response_data->awb_detail->partner;
									//$orderdata['awb'] = $response_data->awb_detail->awb;
									//$subject = '[SITE_TITLE] - Order '.$order_number.' - Shipment Detail';
									//$this->_send_mail($orderdata, 'order_shipping', $subject);
									
								}
								
								$this->Products_front_model->updateShippingResponse($order_number, $response_status, json_decode($shipping_order_response_data));*/
								
								$this->Products_front_model->updateOrderStatus($order_number, 2); // 2 => New Order from order_status table
								
								$this->flexi_cart->destroy_cart();
								
								$this->data['status'] = 1;
								$this->data['msg'] = 'Thank you. Your order has been processed successfully.';
								
								$this->printOutput($this->data);
								
							} 
							else 
							{
								$this->data['status'] = 0;
								$this->data['msg'] = 'Invalid payment type!';
								
								$this->printOutput($this->data);
							}
							
							
						} else {
					
							$this->data['status'] = 0;
							$this->data['msg'] = 'Invalid order!';
							
							$this->printOutput($this->data);
						}
						
					} else {
					
						$this->data['status'] = 0;
						$this->data['msg'] = 'Invalid order!';
						
						$this->printOutput($this->data);
					}
					
				} else {
					
					$this->data['status'] = 0;
					$this->data['msg'] = $this->flexi_cart->get_messages();
					
					$this->printOutput($this->data);
				}
				
			} else {
					
				$this->data['status'] = 0;
				$this->data['msg'] = 'Invalid request!';
				
				$this->printOutput($this->data);
			}
		}
	}
	
	public function _save_cart_data() 
	{
		$user_session_data = $this->session->userdata('data');
		
		if(isset($user_session_data->id)) {
		
			// The load/save/delete cart data functions require the flexi cart ADMIN library.
			$this->load->library('flexi_cart_admin');
	
			// Save the cart data to the database.
			$this->flexi_cart_admin->save_cart_data($user_session_data->id);

		}
	}
	
	public function update_cart()
	{
		// Load custom demo function to retrieve data from the submitted POST data and update the cart.
		$this->_loadModel('Products_front_model');
		$this->Products_front_model->demo_update_cart();
		
		//$this->session->set_flashdata('message', $this->flexi_cart->get_messages());
	}
	
	public function update_discount_codes()
	{
		// Get the discount codes from the submitted POST data.
		$discount_data = $this->input->post('discount');
		
		$this->flexi_cart->update_discount_codes($discount_data);
		
		//$this->session->set_flashdata('message', $this->flexi_cart->get_messages());
		
	}
	
	public function remove_discount_code()
	{
		// This examples gets the discount code from the array key of the submitted POST data.
		$discount_code = key($this->input->post('remove_discount_code'));

		$this->flexi_cart->unset_discount($discount_code);
		
		//$this->session->set_flashdata('message', $this->flexi_cart->get_messages());
		
	}
	
	public function remove_all_discounts()
	{
		
		$this->flexi_cart->unset_discount();		
		
		// Set a message to the CI flashdata so that it is available after the page redirect.
		//$this->session->set_flashdata('message', $this->flexi_cart->get_messages());

	}
	
	private function _loadModel($model)
	{
		$this->load->model($this->data['site_models']['ecommerce'].'/'.$model);
	}
	
	private function _defineEcommerce()
	{
		$this->flexi = new stdClass;
		$this->load->library('flexi_cart');	
		$this->data['flexi_cart_library'] = 'flexi_cart';
		
		$customer_source_url = $this->config->item('customer_source_url');
		$product_item_folder = $this->config->item('product_item_folder');
		$product_item_thumbs = $this->config->item('product_item_thumbs');
		$this->data['product_image_base_url'] = array(
			'small'		=> site_url($customer_source_url .'/' . $product_item_folder . '/' . $product_item_thumbs['small']['folder']),
			'medium'	=> site_url($customer_source_url .'/' . $product_item_folder . '/' . $product_item_thumbs['medium']['folder']),
			'large'		=> site_url($customer_source_url .'/' . $product_item_folder . '/' . $product_item_thumbs['large']['folder'])
		);
	}
}