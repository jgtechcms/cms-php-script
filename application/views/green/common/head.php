<!DOCTYPE html>
<html lang="en-US">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo isset($page->meta_title)? $page->meta_title : '';?></title>
	<meta name="description" content="<?php echo isset($page->meta_description)? $page->meta_description : '';?>">
	<meta name="keywords" content="<?php echo isset($page->meta_keywords)? $page->meta_keywords : '';?>">
	<?php if(isset($favicon)):?>
		<link href="<?php echo site_url();?><?php echo $favicon;?>" rel="shortcut icon" type="image/x-icon">
	<?php endif;?>	
    
    <!-- Bootstrap Core CSS -->
    <link href="<?php echo site_url();?><?php echo $asset_path;?>/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo site_url();?><?php echo $asset_path;?>/css/modern-business.css" rel="stylesheet">    
    <link href="<?php echo site_url();?><?php echo $asset_path;?>/css/style.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo site_url();?><?php echo $asset_path;?>/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    
    <?php $ga_code;?>
    
    <?php if($custom_css):?>
    <style>
	<?php echo $custom_css;?>
	</style>
    <?php endif;?>
  </head>  
  
  <body>