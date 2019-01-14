<?php

class Pages extends Front_Controller {



    public function __construct(){

        parent::__construct();		
		
		$this->load->model('free/Pages_model');
		$this->load->model('free/Banner_model');
		$this->load->model('free/Menu_model');
		$this->load->model('free/User_menu_model');		
		$this->load->model('free/Social_media_model');
		$this->load->model('free/Page_widgets_model');
		$this->data = $this->data_common;
	}


	public function index($sl = NULL, $blog_sl = NULL, $blog_sl1 = NULL, $blog_sl2 = NULL) 
	{
		
		$this->define_common_component();
		$is_page_exists = false;		
		
		//$this->data['item_data'] = $this->Products_front_model->feature_get_item_data();
		$menus = $this->data['menus'];
		
		$this->data['widget_contents'] = array();
				
		/** get page content **/
		foreach($menus as $menuObj)
		{
			
			if(is_null($sl)) {
				/** home page **/
				if($menuObj->page_type == 'is_home') {
					// get current page
					$page = $this->Pages_model->get_by(array('menu_id' => $menuObj->id), TRUE);
					
					if(isset($page->id))
					$this->data['widget_contents'] = $this->Page_widgets_model->getRelatedWidgets($page->id);
					
					// get banner for current page
					if(isset($menuObj->id))
						$banner= $this->Banner_model->get_by(array('menu_id' => $menuObj->id), FALSE);
					
					// current menu
					$current_menu = $menuObj;
					
					$is_page_exists = true;
					break;
				}
			}
			else {				
				/** other pages **/
				if($sl == $menuObj->slug) {
					// check against ecommerce module
					if(!$this->data['site_settings']->is_ecommerce_enabled and $menuObj->is_product)
						break;
					
					// get current page
					$page = $this->Pages_model->get_by(array('menu_id' => $menuObj->id), TRUE);
					
					if(isset($page->id))
					$this->data['widget_contents'] = $this->Page_widgets_model->getRelatedWidgets($page->id);
					
					// get banner for current page
					if(isset($menuObj->id))
					$banner = $this->Banner_model->get_by(array('menu_id' => $menuObj->id), FALSE);	
				
					$current_menu = $menuObj;
										
					
					$is_page_exists = true;
					break;
				}
			}	
		}
		//print_r($this->data['widget_contents']);exit;
		$this->data['banner'] = isset($banner) ? $banner : array();
		
		// page not found 404
		if(!$is_page_exists) {
			
			$this->output->set_status_header('404');
			$this->load->view($this->data['selected_template_path'].'/'.$this->data['user_template'].'/404',$this->data);
			//show_404();
			
		} else {
			
			// get breadcrumb menu lists
			$this->Menu_model->setBreadcrumbLists($current_menu);
			$breadcrumb_lists = $this->Menu_model->getBreadcrumbLists();
			$this->data['breadcrumb_lists'] = array_reverse($breadcrumb_lists);
			
			$this->data['sl'] = $sl;
			$this->data['current_menu'] = $current_menu;
			$this->data['error_message'] = '';
			
			if(isset($page->id))
				$this->data['page'] =  $page;
			
			// get category_extension for current page 
			$menu_id = isset($current_menu->id) ? $current_menu->id : '';
			
			// Widget module
			$this->load->model('cms/Sponsors_model');
			
			$testimonial_folder = $this->config->item('testimonial_icon_folder');
			$this->data['customer_testimonial_url'] = $this->config->item('customer_source_url') . '/' . $testimonial_folder . '/';
			
			$gallery_folder = $this->config->item('gallery_folder');
			$this->data['customer_gallery_url'] = $this->config->item('customer_source_url') . '/' . $gallery_folder . '/';
			
			$this->data['testimonials'] = array();
			$this->data['gallery_images_widget'] = array(); // $limit -> 8
			$this->data['articles_widget'] = array(); // $limit -> 4
			$this->data['sponsors_widget'] = array();
				
							
			$this->load->view($this->data['selected_template_path'].'/'.$this->data['user_template'].'/index',$this->data);	
		}

	}
	
	public function unsubscribe($encrypt_key)
	{
		$this->define_common_component();
		
		$this->load->model('cms/Newsletter_subscription_model');
		$this->data['msg'] = 'Invalid email id';
		
		$unsubscribed = $this->session->userdata('unsubscribed');
		
		if($unsubscribed == 'yes') {
			
			redirect('');
			
		} else {
		
			$this->data['subscribe'] = $this->Newsletter_subscription_model->get_by(array('encrypt_key' => $encrypt_key), TRUE);
			
			if($this->data['subscribe']) {
				
				$this->session->set_userdata('unsubscribed', 'yes');
				$dataval = array();
				$dataval['is_subscribed'] = 0;	
				$dataval['encrypt_key'] = '';
				$this->Newsletter_subscription_model->save($dataval, $this->data['subscribe']->id);
				
				$this->data['msg'] = 'You are unsubscribed successfully';
				
			}
		}
		
		// meta detail
		$meta_obj = new stdClass;
		$meta_obj->title = 'Unsubscribe';
		$meta_obj->meta_keywords = '';
		$meta_obj->meta_description = '';
		$meta_obj->content = '';
		$this->data['page'] = $meta_obj;
		
		$this->load->view($this->data['selected_template_path'].'/'.$this->data['user_template'].'/unsubscribe',$this->data);	
	}
	
	public function newsletter_subscribe()
	{
		$this->load->model('cms/Newsletter_subscription_model');
		
		// Form Vaidation
		$rules = $this->Newsletter_subscription_model->rules;
		$this->form_validation->set_rules($rules);
		
		// reset unsubscribe session 
		$this->session->unset_userdata('unsubscribed', '');
		
		// Process the form
		if ($this->form_validation->run() == TRUE) 
		{
			// check if already exists
			$subscribe = $this->Newsletter_subscription_model->get_by(array('email' => $this -> input -> post('newsletterEmail')), TRUE);
			if($subscribe) {
				
				$dataval = array();			
				$dataval['created'] = date('Y-m-d H:i:s');				
				$dataval['is_subscribed'] = 1;	
				//$dataval['encrypt_key'] = md5($this -> input -> post('newsletterEmail').'jg_cms');
				$this->Newsletter_subscription_model->save($dataval, $subscribe->id);	
				$dataval['email'] = $this -> input -> post('newsletterEmail');
				
			} else {
			
				$dataval = array();			
				$dataval['created'] = date('Y-m-d H:i:s');	
				$dataval['email'] = $this -> input -> post('newsletterEmail');				
				$dataval['is_subscribed'] = 1;	
				//$dataval['encrypt_key'] = md5($dataval['email'].'jg_cms');
				$this->Newsletter_subscription_model->save($dataval);
			}
			
			// send mail to user
			/*
			$subject = 'Thank you for your subscription - [SITE_TITLE]';
			$this->_send_mail($dataval, 'subscribe_user', $subject);
			*/
				
			$status['statusmsg'] = "Subscribed Successfully";
			$status['status'] = 1;
			echo json_encode($status);
			
		}
		else
		{
			//Ajax Error 
			$status['statusmsg'] = validation_errors();
			$status['status'] = 0;
			echo json_encode($status);
		}
	}
	
	public function contact()
	{
		$this->load->model('free/Contact_model');
		$this->load->model('cms/User_model');
		
		
		// Validation the form
		$this -> form_validation -> set_rules('first_name', 'Enter a name', 'required|trim|xss_clean');
		$this -> form_validation -> set_rules('email', 'Enter a email', 'required|trim|xss_clean');
		$this -> form_validation -> set_rules('phone', 'Enter a phone number', 'required|trim|xss_clean');
		$this -> form_validation -> set_rules('subject', 'Enter a subject', 'required|trim|xss_clean');
		$this -> form_validation -> set_rules('comment', 'Enter a comment', 'required|trim|xss_clean');
		if ($this -> form_validation -> run() == FALSE)
		{

			$status['status'] = 0;
			$status['statusmsg'] = validation_errors();
			echo json_encode($status);
		}
		else
		{
			$data['name'] = $this -> input -> post('first_name');
			$data['email'] = $this -> input -> post('email');
			$data['phone'] = $this -> input -> post('phone');
			$data['subject'] = $this -> input -> post('subject');
			$data['message'] = $this -> input -> post('comment');
			$data['created'] = date('Y-m-d H:i:s');
			
			$result = $this->Contact_model->save($data);
			
			
			if ($result == FALSE)
			{
				$status['statusmsg'] = "Something wrong while processing your request. Please try again.";
				$status['status'] = 0;
				echo json_encode($status);
			}
			else
			{
				
				// send mail to user
				$user_mail_data = $data;
				$user_mail_data['email'] = $this -> input -> post('email');
				$subject = 'Thank you for contacting [SITE_TITLE]';//'Thank you for contact us - [SITE_TITLE]';
				$this->_send_mail($user_mail_data, 'contact_us_user', $subject);
				
				// send mail to admin
				$subject = 'New query for [SITE_TITLE] '.date('Y');//'New contact us form recieved - [SITE_TITLE]';
				$this->_send_mail_to_admin($data, 'contact_us_admin', $subject);
				
				
				$status['statusmsg'] = "Your enquiry sent successfully. Our staff wil contact you shortly.";
				$status['status'] = 1;
				echo json_encode($status);
			}

		}

	}
	
	
	public function _unique_subscribe_email ($str)
	{
		
		$this->db->where('email', $this->input->post('newsletterEmail'));
		$this->db->where('is_subscribed', 1);

		$user = $this->Newsletter_subscription_model->get();

		if (count($user)) {

			$this->form_validation->set_message('_unique_subscribe_email', 'You have already subscribed');
			return FALSE;

		}

		return TRUE;

	}

}