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
$testimonials = $testimonials;//get_testimonial_lists($content->page_limit);
$testimonial_icon_folder = config_item('customer_source_url') . '/' . config_item('testimonial_icon_folder') . '/';
?>
<?php if($testimonials):?>
<div class="row<?php echo $hidden_xs;?>">
<div class='col-md-offset-2 col-md-8'>
      <div class="carousel slide" data-ride="carousel" id="quote-carousel">
        <!-- Bottom Carousel Indicators -->
        <ol class="carousel-indicators">
          	<?php 
			$i=0;						
			foreach ($testimonials as $row) {
				if($i==0){$add="active";}else{$add=null;}
			?>
			<li data-target="#quote-carousel" data-slide-to="<?php echo $i;?>" class="<?php echo $add;?>"></li>
			<?php $i++;}?>
        </ol>
        
        <!-- Carousel Slides / Quotes -->
        <div class="carousel-inner">
        	
            <?php 
			$i=1;						
			foreach ($testimonials as $row) { 
				
				$body_desc = word_limiter($row->body_desc, 100);
				$title = $row->title;
				$designation = $row->designation;
				$company = $row->company;
				$company_url = $row->company_url;
				if($company and $company_url)
					$company = '<a href="'.$company_url.'" target="_blank">'.$company.'</a>';
				else if($company_url)
					$company = '<a href="'.$company_url.'" target="_blank">'.$company_url.'</a>';
					
				$text = $title;
				if($designation)
					$title .= ', ' . $designation;
				if($company)
					$title .= ', ' . $company;
				
				if($i==1){$add="active";$id = ' id="hm-bg"';}else{$add=null;$id = '';}
			?>
              <div class="item <?php echo $add;?>">
                <blockquote>
                  <div class="row">
                    <div class="col-sm-3 text-center">
                      <img class="img-circle" src="<?php echo site_url();?><?php echo $testimonial_icon_folder.$row->image_name;?>" style="width: 100px;height:100px;">
                    </div>
                    <div class="col-sm-9">
                      <p><?php echo $body_desc;?></p>
                      <small><?php echo $title;?></small>
                    </div>
                  </div>
                </blockquote>
              </div>
          <?php $i++;}?>
          
        </div>
        
        <!-- Carousel Buttons Next/Prev -->
        <a data-slide="prev" href="#quote-carousel" class="left carousel-control"><i class="fa fa-chevron-left"></i></a>
        <a data-slide="next" href="#quote-carousel" class="right carousel-control"><i class="fa fa-chevron-right"></i></a>
      </div>                          
    </div>
   </div>
<?php endif;?>