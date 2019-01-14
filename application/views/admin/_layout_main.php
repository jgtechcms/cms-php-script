<?php 
$this->load->view($selected_template_path.'/common/head');
$this->load->view($selected_template_path.'/common/header');

?>    
<!-- page content -->
<div id="page-wrapper">
	<div class="container-fluid">
	
		<script type="text/javascript" src="<?php echo site_url(ASSET.'/admin/js/jquery.js');?>"></script>
		
		
		
		<?php $this->load->view($subview); ?>
		
	</div>
</div>
	
	<script type="text/javascript" src="<?php echo site_url(ASSET.'/admin/js/bootstrap.min.js');?>"></script>

</body>

</html>