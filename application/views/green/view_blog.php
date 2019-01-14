<?php $this->load->view($selected_template_path.'/'.$user_template.'/common/breadcrumb'); ?>

<div class="container">
	<div class="row">
        <div class="col-md-9">
            <h2><?php echo $article->title;?></h2>
            <?php if($article->image_name):?>
            <p class="text-center">
                <img src="<?php echo site_url();?><?php echo config_item('customer_source_url').'/'.config_item('blog_post_featured_image_folder').'/'.$article->image_name;?>" class="img-responsive" alt="">
            </p>
            <?php endif;?>
            <p><?php echo $article->body_desc;?></p>
               
        </div>
        <div class="col-md-3">
            <div class="widget-sidebar">
              	<h2 class="title-widget-sidebar"> CATEGORIES</h2>
                 <?php foreach($article_categories as $category):?>
                  <div><a class="categories-btn" href="<?php echo site_url().$sl.'/category/'.$category->slug;?>"><?php echo $category->name;?></a></div>
                  <?php endforeach;?>
             </div> 
        </div>
    </div>
</div>