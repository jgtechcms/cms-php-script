<?php $this->load->view($selected_template_path.'/'.$user_template.'/common/breadcrumb'); ?>

<div class="container">
	<div class="row">
        <div class="col-md-9 blog_page">
            <?php foreach($blog as $blog): ?>	
            <div class="row">
        		<?php  
				$class = 'col-md-12 col-sm-12';
				if($blog->image_name):
					$class = 'col-md-8 col-sm-8';
				?>
                <div class="col-md-4 col-sm-4">
                <figure>
                    <a href="<?php echo site_url().article_link($blog);?>"><img class="img-responsive" src="<?php echo site_url();?><?php echo config_item('customer_source_url').'/'.config_item('blog_post_featured_image_folder').'/'.$blog->image_name;?>" alt=""></a>									
                </figure>
                </div>
                <?php endif; ?>
                <div class="<?php echo $class;?>">
                    <h2><a href="<?php echo site_url().article_link($blog);?>"><?php echo $blog->title;?></a></h2>
                    <p><?php echo get_excerpt($blog)?></p>
                       
                    <hr>
            	</div>
            </div>
            <?php endforeach; ?>
            
             <div class="row text-center">
                    
				<?php 
                    if($pagination_links): 
                        echo $pagination_links;
                    ?>
                    <?php endif; ?>	
              </div>
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

<?php $this->load->view($selected_template_path.'/'.$user_template.'/common/widget'); ?>