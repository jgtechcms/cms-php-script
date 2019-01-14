<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title><?php echo $meta_title; ?></title>
	<!-- Bootstrap -->
	<link href="<?php echo site_url('css/bootstrap.min.css'); ?>" rel="stylesheet">
	<link href="<?php echo site_url('css/admin.css'); ?>" rel="stylesheet">
	<link href="<?php echo site_url('css/datepicker.css'); ?>" rel="stylesheet">
			<link href="<?php echo site_url('css/acc_menu.css'); ?>" rel="stylesheet">

	<script src="http://code.jquery.com/jquery-latest.js"></script>
	<script src="<?php echo site_url('js/bootstrap.min.js'); ?>"></script>
    
    <script src="<?php echo site_url('js/modernizr.js'); ?>"></script>
    <script src="<?php echo site_url('js/acc_main.js'); ?>"></script>
	<script src="<?php echo site_url('js/bootstrap-datepicker.js'); ?>"></script>
	<?php if(isset($sortable) && $sortable === TRUE): ?>
	<script src="<?php echo site_url('js/jquery-ui-1.9.1.custom.min.js'); ?>"></script>
	<script src="<?php echo site_url('js/jquery.mjs.nestedSortable.js'); ?>"></script>
	<?php endif; ?>
	
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<!-- TinyMCE -->
    <script type="text/javascript" src="<?php echo site_url(); ?>jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
	tinyMCE.init({
		// General options
		mode : "exact",
		elements : "ajaxfilemanager",
		theme : "advanced",
		skin : "o2k7",		
		plugins : "safari,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave",

		// Theme options
		theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
		theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
		theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
		theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,

		// Example content CSS (should be your site CSS)
			content_css : "../examples/css/content.css",
			extended_valid_elements : "iframe[src|width|height|name|align]",/*"hr[class|width|size|noshade]",*/
			file_browser_callback : "ajaxfilemanager",
			paste_use_dialog : false,
			theme_advanced_resizing : true,
			theme_advanced_resize_horizontal : true,
			apply_source_formatting : true,
			force_br_newlines : true,
			force_p_newlines : false,	
			relative_urls : false
			//relative_urls : true

	});	
	
	function ajaxfilemanager(field_name, url, type, win) {
			var ajaxfilemanagerurl = "<?php echo site_url(); ?>jscripts/tiny_mce/plugins/ajaxfilemanager/ajaxfilemanager.php";
			switch (type) {
				case "image":
					ajaxfilemanagerurl += "?type=img";
					break;
				case "media":
					ajaxfilemanagerurl += "?type=media";
					break;
				case "flash": //for older versions of tinymce
					ajaxfilemanagerurl += "?type=media";
					break;
				case "file":
					ajaxfilemanagerurl += "?type=files";
					break;
				default:
					return false;
			}
            tinyMCE.activeEditor.windowManager.open({
                url: "<?php echo site_url(); ?>jscripts/tiny_mce/plugins/ajaxfilemanager/ajaxfilemanager.php",
                width: 782,
                height: 440,
                inline : "yes",
                close_previous : "no"
            },{
                window : win,
                input : field_name
            });
}
</script>
	    
    
	<!-- /TinyMCE -->
    
    
    
      <!-- Le styles -->
  <!--      <link href="<?php echo base_url(); ?>pagintaion/css/bootstrap.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>pagintaion/css/bootstrap-responsive.css" rel="stylesheet">-->
        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <!--[if IE 7]>
        <link rel="stylesheet" href="css/font-awesome-ie7.min.css">
        <![endif]-->
        <link rel="stylesheet" href="<?php echo base_url(); ?>pagintaion/css/font-awesome.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>pagintaion/css/select2.css">
        <link href="<?php echo base_url(); ?>pagintaion/css/custom.css" rel="stylesheet">
        <script src="<?php echo base_url(); ?>pagintaion/js/jquery-1.8.3.min.js"></script>
        <script src="<?php echo base_url(); ?>pagintaion/js/bootstrap.js"></script>
        <script src="<?php echo base_url(); ?>pagintaion/js/select2.js"></script>
        
        <script src="<?php echo base_url(); ?>pagintaion/js/jquery-bootalert.js"></script>
       <!-- <script src="<?php echo base_url(); ?>pagintaion/js/custom.js"></script>-->
        
        <!-- Tablesorter: required for bootstrap -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>pagintaion/css/theme.bootstrap.css">
        <script src="<?php echo base_url(); ?>pagintaion/js/jquery.tablesorter.js"></script>
        <script src="<?php echo base_url(); ?>pagintaion/js/jquery.tablesorter.widgets.js"></script>
        <script src="<?php echo base_url(); ?>pagintaion/js/jquery.metadata.js"></script>


    <!-- Tablesorter: optional -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>pagintaion/css/jquery.tablesorter.pager.css">
        <script src="<?php echo base_url(); ?>pagintaion/js/jquery.tablesorter.pager.js"></script>
        <script src="<?php echo base_url(); ?>pagintaion/js/tablesorter.js"></script>
        <script src="<?php echo base_url(); ?>pagintaion/js/bootbox.js"></script>
        <script type="text/javascript">$(document).ready(function() { 
    $("table") 
    .tablesorter({widthFixed: true, widgets: ['zebra']}) 
    .tablesorterPager({container: $("#pager")}); 
}); </script>
</head>