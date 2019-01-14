<?php $this->load->view($selected_template_path.'/'.$user_template.'/header'); ?>
	<div class="container text-center" style="margin-bottom:30px;">
		<div class="logo-404">
			<a href="<?php echo site_url().$customer_url_base;?>">
				<?php if(isset($logo)):?>
					<img src="<?php echo site_url();?><?php echo $logo;?>" alt="" />
				<?php endif;?>
			</a>
		</div>
		<div class="content-404">
			<img src="<?php echo site_url();?><?php echo $asset_path;?>/images/404/404.png" class="img-responsive" alt="" />
			<h1><b>OPPS!</b> We Couldn’t Find this Page</h1>
			<p>Uh... So it looks like you brock something. The page you are looking for has up and Vanished.</p>
			<h2><a href="<?php echo site_url().$customer_url_base;?>">Bring me back Home</a></h2>
		</div>
	</div>
<?php $this->load->view($selected_template_path.'/'.$user_template.'/footer'); ?>