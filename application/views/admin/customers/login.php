	<div class="container">
        <div class="card card-container">
            <div style="text-align:center">
				<?php if(isset($site_settings->logo) and $site_settings->logo):?>
					<img src="<?php echo site_url(config_item('customer_source_url'));?>/<?php echo $site_settings->logo;?>" alt="" id="nv-logo" style="max-height:80px;" />
				<?php else:?>
					<?php echo $site_settings->site_title;?>
				<?php endif;?>
			</div>
            <p id="profile-name" class="profile-name-card"></p>
            
            <?php
				$success_message = $this->session->flashdata('reg_succes');
				$error = $this->session->flashdata('error');
				?>
				<div class="alert alert-success<?php if(!$success_message):?> hidden<?php endif;?>">
				<?php if($success_message):?>
				<?php echo $success_message;?>
				<?php endif;?>
				</div>
				
				<div class="alert alert-danger<?php if(!$error):?> hidden<?php endif;?>">
                <?php if($error):?>
				<?php echo $error;?>
				<?php endif;?>
                </div>
                
            <form action="" class="form-signin" autocomplete="off" method="post">
                <input type="text" class="form-control" placeholder="Login name" name="username" value="<?php echo set_value('username'); ?>" autofocus />
								<span style="color:#e04b4a;"><?php echo form_error('username'); ?></span>
                <input type="password" class="form-control" placeholder="Password" name="password" value="" />
								<span style="color:#e04b4a;"><?php echo form_error('password'); ?></span>
                
                <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">Sign in</button>
                
                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
            </form><!-- /form -->
            <a href="<?php echo site_url() . 'users/forgot-password';?>" class="forgot-password">
                Forgot the password?
            </a>
        </div><!-- /card-container -->
    </div><!-- /container -->	