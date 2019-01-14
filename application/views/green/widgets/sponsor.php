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
if($sponsors_widget):?>
<div class="container-fluid<?php echo $hidden_xs;?>">

  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
      <div class="carousel carousel-showmanymoveone slide" id="itemslider">
        <div class="carousel-inner">
			<?php
			foreach($sponsors_widget as $i => $sponsor): 
				$sponsor_icon_folder = $this->config->item('sponsor_icon_folder');
				$customer_sponsor_icon_folder = $this->config->item('customer_source_url') . '/' . $sponsor_icon_folder . '/';
			?>
                <div class="item<?php if($i==0):?> active<?php endif;?>">
                    <div class="col-xs-12 col-sm-6 col-md-2">
                        <?php if($sponsor->url):?>
                        	<a href="<?php echo $sponsor->url;?>" target="_blank">
                            	<img src="<?php echo site_url();?><?php echo $customer_sponsor_icon_folder . $sponsor->icon;?>" class="img-responsive center-block">
                            </a>
                        <?php else:?>
                        <img src="<?php echo site_url();?><?php echo $customer_sponsor_icon_folder . $sponsor->icon;?>" class="img-responsive center-block">
                        <?php endif;?>
                        <?php /*<h4 class="text-center">MAYORAL SUKNJA</h4>
                        <h5 class="text-center">4000,00 RSD</h5>*/?>
                    </div>
                </div>
			<?php endforeach;?>

        </div>

        <div id="slider-control">
        <a class="left carousel-control" href="#itemslider" data-slide="prev"><img src="https://s12.postimg.org/uj3ffq90d/arrow_left.png" alt="Left" class="img-responsive"></a>
        <a class="right carousel-control" href="#itemslider" data-slide="next"><img src="https://s12.postimg.org/djuh0gxst/arrow_right.png" alt="Right" class="img-responsive"></a>
      </div>
      </div>
    </div>
  </div>
</div>
<?php endif;?>