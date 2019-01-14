	<?php $this->load->view($selected_template_path.'/'.$user_template.'/common/breadcrumb'); ?>

	<div class="container">
		<div class="row">
			<div class="col-lg-12">

				<div class="filter"> 
                	<a href="#all">ALL</a> 
                <?php foreach($gallery as $gallery_list):?>
                    <a href="#<?php echo $gallery_list->title.'_'.$gallery_list->id;?>"><?php echo $gallery_list->title;?></a> 
                <?php endforeach;?>
                </div>
                
                <div class="gallery"> 
                <?php foreach($gallery_images as $gallery_list):?>
                    <a href="#" class="<?php echo $gallery_list->title.'_'.$gallery_list->g_id;?>" >
                    <img src="<?php echo $customer_gallery_url.$gallery_list->images;?>"></a>                     
                <?php endforeach;?>
                </div>

			</div>
		</div>
	</div>
    
    <?php $this->load->view($selected_template_path.'/'.$user_template.'/common/widget'); ?>