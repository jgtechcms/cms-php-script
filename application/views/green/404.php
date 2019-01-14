<?php 
$this->load->view($selected_template_path.'/'.$user_template.'/common/head'); 
$this->load->view($selected_template_path.'/'.$user_template.'/common/header');
?>
	<div class="container text-center" style="margin:100px;">
		
		<div class="content-404">
			<h1><b>OPPS!</b> We Couldn’t Find this Page</h1>
			<p>Uh... So it looks like you brock something. The page you are looking for has up and Vanished.</p>
			<h2><a href="<?php echo site_url().$customer_url_base;?>">Bring me back Home</a></h2>
		</div>
	</div>
<?php $this->load->view($selected_template_path.'/'.$user_template.'/common/footer'); ?>