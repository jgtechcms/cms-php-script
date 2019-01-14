<!DOCTYPE html>
<html lang="en" class="body-full-height">
    <head>        
        <!-- META SECTION -->
        <title>Admin Panel</title>            
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="icon" href="<?php echo site_url(ASSET);?>/favi.png" type="image"/>
       
        <!-- END META SECTION -->
        <link rel="stylesheet" href="<?php echo site_url();?><?php echo ASSET;?>/admin/css/bootstrap/bootstrap.min.css" >
        <!-- EOF CSS INCLUDE -->     
		<script>
		var surl='<?php echo site_url(ASSET);?>/admin/';
		</script>	
<!-- START PRELOADS -->
        <!-- END PRELOADS -->                  
        
    <!-- START SCRIPTS -->
        <!-- START PLUGINS -->
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo site_url(ASSET.'/admin/js/plugins/bootstrap/bootstrap.min.js');?>"></script>        
        <!-- END PLUGINS -->

        
</head>
<body>

	<div>
	
	
	<?php $this->load->view($subview); ?>
            

	</div>
        
</body>
</html>