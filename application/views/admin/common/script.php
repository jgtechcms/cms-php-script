	<!-- Datatables -->
    <script src="<?php echo site_url($assets_path);?>/admin/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo site_url($assets_path);?>/admin/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="<?php echo site_url($assets_path);?>/admin/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="<?php echo site_url($assets_path);?>/admin/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="<?php echo site_url($assets_path);?>/admin/vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="<?php echo site_url($assets_path);?>/admin/vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="<?php echo site_url($assets_path);?>/admin/vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="<?php echo site_url($assets_path);?>/admin/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="<?php echo site_url($assets_path);?>/admin/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="<?php echo site_url($assets_path);?>/admin/vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?php echo site_url($assets_path);?>/admin/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="<?php echo site_url($assets_path);?>/admin/vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>

	
	<script src="<?php echo site_url($assets_path)?>/tinymce/js/tinymce/tinymce.min.js"></script>
	<script type="text/javascript">
		var asset_path = "<?php echo $assets_path;?>";
		tinymce.init({
			selector: ".tinymce",theme: "modern", height: 300,
			fontsize_formats: '<?php $sep = ''; for($i=6; $i < 40; $i++){echo $sep.$i.'px'; $sep=' ';}?>',
			 plugins: [
				  "advlist autolink link image lists charmap print preview hr anchor pagebreak", "autoresize",
				  "searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
				  "table contextmenu directionality emoticons paste textcolor responsivefilemanager code"
			],
			toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat styleselect fontsizeselect hr",
			toolbar2: "| responsivefilemanager | link unlink anchor | image media | forecolor backcolor  | print preview code ",
			image_advtab: false ,
			image_dimensions: false,
			branding: false,
			document_base_url: '<?php echo site_url()?>',
			external_filemanager_path:"<?php echo site_url($assets_path)?>/file_manager/filemanager/",
			filemanager_title:"Responsive Filemanager" ,
			external_plugins: { "filemanager" : "<?php echo site_url($assets_path)?>/file_manager/filemanager/plugin.min.js"},
			valid_elements : '*[*]'
	  });
	</script>
	
	<script>
	$(document).ready(function(){	
		$('#listProducts').DataTable();
	});
	</script>