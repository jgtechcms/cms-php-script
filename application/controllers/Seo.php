<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Seo extends Front_Controller {



    public function __construct(){

        parent::__construct();	
		
		$this->data = $this->data_common;

		$this->load->model('free/User_menu_model');
		$this->load->model($this->data['site_models']['ecommerce'].'/Product_category_model');
		$this->load->model($this->data['site_models']['ecommerce'].'/Products_front_model');
		
		
	}
	

    public function sitemap()
    {
		$customer_url_base = $this->data['customer_url_base'];
		$site_settings = $this->data['site_settings'];
		$header_menu = $this->User_menu_model->getUserMenu('header');
		$cat_lists = $this->Product_category_model->getCategoryWithSubcategory();
		$item_data = $this->Products_front_model->get_productlist_item_data();
		$manufatures = $this->_getManufacture();
		
		$menus = array();
		$categories = array();
		$sub_categories = array();
		$brands = array();
		$products = array();
		if($site_settings->is_ecommerce_enabled)
			$products[] = $customer_url_base.'products';
		
        foreach($header_menu as $menu) {
			if($menu->slug)
				$menus[] = $customer_url_base.$menu->slug;
		}
		foreach($cat_lists['category'] as $cats) {
			
			$categories[] = $customer_url_base.'category/'.$cats->slug;
			
			$subcats = $cats->subcategory;
			foreach($subcats as $subcat) {
				$sub_categories[] = $customer_url_base.'category/'.$subcat->slug;
			}
		}
		foreach($manufatures as $manufature) {
			if($manufature->slug)
				$brands[] = $customer_url_base.'brands/'.$manufature->slug;
		}
		foreach($item_data as $item) {
			if($item->slug)
				$products[] = $customer_url_base.'products/product_details/'.$item->slug;
		}
		$this->data['menus'] = $menus;
		$this->data['categories'] = $categories;
		$this->data['sub_categories'] = $sub_categories;
		$this->data['brands'] = $brands;
		$this->data['products'] = $products;
		//print_r($cat_lists);exit;
		
        header("Content-Type: text/xml;charset=iso-8859-1");
        $this->load->view("sitemap", $this->data);
    }
}