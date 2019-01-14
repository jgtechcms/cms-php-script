<?php 
$this->load->view($selected_template_path.'/'.$user_template.'/common/head'); 
$this->load->view($selected_template_path.'/'.$user_template.'/common/header');

if(count($banner)!='0') {
	$this->load->view($selected_template_path.'/'.$user_template.'/common/slider');
}

if($current_menu->page_type == 'is_home') {
	
	$this->load->view($selected_template_path.'/'.$user_template.'/home');
	
} else if($current_menu->page_type == 'is_gallery') {
	
	$this->load->view($selected_template_path.'/'.$user_template.'/gallery');
	
} else if($current_menu->page_type == 'is_blog') {
	
	$this->load->view($selected_template_path.'/'.$user_template.'/'.$sub_view);
	
} else if($current_menu->page_type == 'is_contact') {
	
	$this->load->view($selected_template_path.'/'.$user_template.'/contact');
	
} else if($current_menu->page_type == 'is_custom') {
	
	$this->load->view($selected_template_path.'/'.$user_template.'/'.$current_menu->slug);
	
} else {
	
	$this->load->view($selected_template_path.'/'.$user_template.'/other');
}
?>

<?php $this->load->view($selected_template_path.'/'.$user_template.'/common/footer'); ?>