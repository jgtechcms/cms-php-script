		<?php $this->load->view($selected_template_path.'/'.$user_template.'/common/breadcrumb'); ?>
				
		<div class="container">
			<div class="row">				
				<div class="col-sm-6 col-sm-offset-3">
					<div class="form">
							<div class="alert alert-danger hidden alert_error"></div>
							<div class="alert alert-success hidden alert_success"></div>
							
							<div id="errormessage"></div>
							<form action="" method="post" role="form" class="contactForm" id="contact_form">
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
								<div class="form-group">
									<input type="text" id="first_name" name="first_name" class="form-control input-text" placeholder="Your Name">
									<span style="color: red;" class="error_block1"></span>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
								<div class="form-group">									
									<input type="text" id="email" name="email" class="form-control input-text" placeholder="Your Email">
								<span style="color: red;" class="error_block2"></span>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
								<div class="form-group">
									<input id="phone" name="phone" placeholder="Phone" class="form-control input-text" type="text">
									<span style="color: red;" class="error_block3"></span>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
								<div class="form-group">
									<input type="text" id="subject" name="subject" class="form-control input-text" placeholder="Subject">
								<span style="color: red;" class="error_block4"></span>
								</div>
							</div>
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">   
								<div class="form-group">
									
									<textarea name="comment" id="comment" class="form-control text-area" rows="8" placeholder="Your Message Here"></textarea>								
									<span style="color: red;" class="error_block5"></span>
								</div>
							</div>
							 <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">       
								<div class="text-center"><button type="submit" class="btn btn-default">Send Message</button></div>
							</div>
							<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
							</form>
					</div>	
				</div>
			</div>
		</div>
        
        <?php $this->load->view($selected_template_path.'/'.$user_template.'/common/widget'); ?>