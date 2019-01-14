<?php 
$hidden_xs = '';
if($content->disable_in_mobile) {
	$hidden_xs = ' hidden-xs';
}
if($content->section_title != ''):?>
<div class="row<?php echo $hidden_xs;?>">
<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
    <h1 class="page-header text-center">
       <?php echo $content->section_title;?>
    </h1>
</div>
</div>
<?php endif;?>
<?php
// get testimonials
$galeries = $gallery_images_widget;//get_gellery_lists($content->page_limit);
$gallery_folder = config_item('customer_source_url') . '/' . config_item('gallery_folder') . '/';
?>
<?php if($galeries):?>
<div class="row<?php echo $hidden_xs;?>">
<div class="col-lg-12 col-md-12">
    <div class="row home_gallery">
		<?php 					
		foreach ($galeries as $row) {
		?>
        <div class="col-md-3 col-sm-4 col-xs-6">
        	<img class="img-responsive" src="<?php echo site_url();?><?php echo $gallery_folder.$row->images;?>" />
            <?php if($row->title):?><p class="text-center"><?php echo $row->title;?></p><?php endif;?>
        </div>
        <?php }?>
    </div>
</div>
</div>
<?php endif;?>