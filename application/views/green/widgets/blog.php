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
if($articles_widget):?>
<div class="row<?php echo $hidden_xs;?>">
	<?php 
	foreach($articles_widget as $article):
		$day = date('d', strtotime($article->created));
		$month = date('M', strtotime($article->created));
	?>
    <div class="col-sm-3">
        <div class="owl-carousel">
            <div class="post-slide">
                <?php if($article->image_name):?>
                <div class="post-img">                    
                    	<img src="<?php echo site_url();?><?php echo config_item('customer_source_url').'/'.config_item('blog_post_featured_image_folder').'/'.$article->image_name;?>" alt="" class="img-responsive">                    
                    <div class="post-date">
                        <span class="date"><?php echo $day;?></span>
                        <span class="month"><?php echo $month;?></span>
                    </div>
                </div>
                <?php endif;?>
                <div class="post-content">
                    <h3 class="post-title">
                        <a href="<?php echo site_url().article_link($article);?>"><?php echo $article->title;?></a>
                    </h3>
                    <p class="post-description"><?php echo html_excerpt($article->body_desc, 150);?></p>
                    <a href="<?php echo site_url().article_link($article);?>" class="read-more">Read More</a>
                    <?php if(!$article->image_name):?>
                    <div class="post-img">&nbsp;</div>
                    <?php endif;?>
                </div>
            </div>
        </div>
    </div>
	<?php endforeach;?>    
</div>
<?php endif;?>