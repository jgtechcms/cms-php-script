<nav class="header navbar navbar-inverse" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a href="<?php echo site_url().$customer_url_base;?>" class="navbar-brand logo">
				<?php if(isset($logo) and $logo):?>
					<img src="<?php echo site_url();?><?php echo $logo;?>" alt="" id="nv-logo" />
				<?php else:?>
					<?php echo $site_title;?>
				<?php endif;?>
			</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="head_menu collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <?php $this->load->view($selected_template_path.'/'.$user_template.'/common/menu'); ?>	
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>