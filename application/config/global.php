<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config['site_name'] 			= 'JG Technologies';
$config['default_model'] 		= 'cms';
$config['assets_path'] 			= ASSET;
$config['default_template_id'] 	= 1;
$config['user_type'] 			= array(
									'admin' => 1,
									'user'	=> 2
								);
$config['page_types'] 			= array(	// FROM page_types table
									'home'		=> 1,
									'product'	=> 2,
									'contact'	=> 3,
									'other'		=> 4
								);
$config['dynamic_page_types'] 	= array(
									'is_contact',
									'is_home',
									'is_product',
									'other'
								);

$config['filter_types'] 		= array(
									'dropdown'		=> 'Dropdown',
									'checkbox'		=> 'Checkbox',
									'radio'			=> 'Radio Button'
								);
$config['menu_types'] 			= array(	// FROM menu_type table
									'header'	=> 1,
									'footer1'	=> 2,
									'footer2'	=> 3,
									'footer3'	=> 4,
									'footer4'	=> 5
								);
$config['sorting_options'] 			= array(
									'newest' => 'Newest First',
									'price_low' => 'Price -- Low to High',
									'price_high' => 'Price -- High to Low'
								);								
$config['renewal_status'] 	= array(
			'progress'	=> 1,
			'expired'	=> 2,
			'renewed'	=> 3,
			'ended'		=> 4
);

$config['default_template_type'] = 'free'; // free/custom
$config['subdomain'] 			= ''; // will be set dynamically in hooks

/** Folder paths **/
$config['customer_asset_folder']= dirname(APPPATH) . DIRECTORY_SEPARATOR . ASSET;
$config['customer_view_folder'] = VIEWPATH;
$config['folder_permission'] 	= 0755;
$config['customer_source_url'] 	= ASSET;
$config['banner_folder'] 		= 'banner';
$config['social_icon_folder'] 	= 'social_icon';
$config['sponsor_icon_folder'] 	= 'sponsors';
$config['free_product_folder'] 	= 'products';
$config['testimonial_icon_folder'] 	= 'testimonials';
$config['gallery_folder'] 		= 'gallery';
$config['blog_category_folder']	= 'blog_category';
$config['blog_post_featured_image_folder']	= 'blog-post-featured';

$config['product_category_folder']= 'product_category';
$config['product_manufactures_folder']= 'manufactures';
$config['product_item_folder']= 'product_images';
$config['product_item_thumbs']= array(
			'small'		=> array('folder' => 'small', 'width' => 80, 'height' => 85),
			'medium'	=> array('folder' => 'medium', 'width' => 212, 'height' => 228),
			'large'		=> array('folder' => 'large', 'width' => 330, 'height' => 380)
);
$config['product_item_size'] = 600; // kb
$config['product_item_image_limit'] = 5;

$config['site_models'] 	= array(
			'cms'	=> 'cms',
			'admin'		=> 'admin',
			'free'		=> 'free',
			'cms'		=> 'cms',
			'ecommerce'	=> 'ecommerce',
			'extension'	=> 'extension'
);

$config['report_group_by'] 	= array(
			'year'		=> 'Years',
			'month'		=> 'Months',
			'week'		=> 'Weeks',
			'day'		=> 'Days'
);

$config['settings_email'] 	= array(
			'sendmail'	=> 'Sendmail',
			'smtp'		=> 'SMTP'
);

$config['payment_gateway'] 	= array(
			'paypal'	=> 1,
			'ebs'		=> 2
);

/** Tooltips **/
// Menu
$config['tooltip_settings_to_email'] 	= 'Set this for your \'From\' email id';
$config['tooltip_menu_footer'] 	= 'Set this to display menu in footer';
$config['tooltip_menu_title'] 	= 'Set this to change menu display text';
// Pages
$config['tooltip_pages_menu'] 	= 'Select the menu to add the content, then save';
$config['tooltip_pages_title'] 	= 'Set this to display page title';
// Banner
$config['tooltip_banner_add'] 	= 'Select the image using below \'widget\' to upload your banner';

/** Default form field value **/
// Pages
$config['form_field_pages_title'] 	= 'Your page title';
$config['form_field_pages_meta_tag'] 	= 'Your site meta keywords';
$config['form_field_pages_meta_description'] 	= 'Your site meta description';
$config['form_field_pages_body'] 	= 'Please add content, then save... which will be displayed in your page';

/** Free product layouts **/
$config['free_product_layout'] 	= array(
			'title'				=> 'Lorem Ipsum Dollor',
			'price_strike'		=> '$100',
			'price'				=> '$80',
			'description'		=> 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.'
);

/** width x height **/
$config['banner_width'] 	= 1920;
$config['banner_min_width'] = 900;
$config['banner_height'] 	= 600;
$config['banner_size'] 		= 600; // 1024 kb = 1 mb

$config['logo_width'] 		= 200;
$config['logo_height'] 		= 80;
$config['logo_size'] 		= 100; // kb

$config['favicon_width'] 	= 17;
$config['favicon_height'] 	= 17;

$config['social_icon_width'] 	= 25;
$config['social_icon_height'] 	= 25;

$config['sponsor_icon_width'] 	= 150;
$config['sponsor_icon_height'] 	= 150;

$config['testimonial_icon_width'] 	= 75;
$config['testimonial_icon_height'] 	= 75;

$config['free_product_width'] 	= 150;
$config['free_product_height'] 	= 150;
$config['free_product_size'] 	= 300; // kb

$config['template_background_image_width'] 	= 1920;
$config['template_background_image_height'] = 998;
$config['template_background_size'] 		= 600; // kb

$config['product_category_width'] 	= 150;
$config['product_category_height'] 	= 150;
$config['product_category_thumb_width'] 	= 100;
$config['product_category_thumb_height'] 	= 80;


$config['per_page'] = 10;

$config['full_tag_open'] = '<div class="pagination"><ul class="tsc_pagination tsc_paginationA tsc_paginationA01>';
$config['full_tag_close'] = '</ul></div>';

$config['first_link'] = '« First';
$config['first_tag_open'] = '<li class="prev page">';
$config['first_tag_close'] = '</li>';

$config['last_link'] = 'Last »';
$config['last_tag_open'] = '<li class="next page">';
$config['last_tag_close'] = '</li>';

$config['next_link'] = 'Next →';
$config['next_tag_open'] = '<li class="next page">';
$config['next_tag_close'] = '</li>';

$config['prev_link'] = '← Previous';
$config['prev_tag_open'] = '<li class="prev page">';
$config['prev_tag_close'] = '</li>';

$config['cur_tag_open'] = '<li class="active"><a href="">';
$config['cur_tag_close'] = '</a></li>';

$config['num_tag_open'] = '<li class="page">';
$config['num_tag_close'] = '</li>';


$config['allowed_types'] = 'jpg|jpeg|png';

