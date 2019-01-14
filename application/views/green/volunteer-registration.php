	<?php $this->load->view($selected_template_path.'/'.$user_template.'/common/breadcrumb'); ?>
	
	<div class="container mt-20 reg-form-bg">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<h2>Volunteer for Hyderabad Triathlon 2016</h2>
			<h5>Please fill in the form below to register as a volunteer for Hyderabad Triathlon 2016</h5>
			<h6><span class="cl-red">* Required<span></h6>
			</div>
		</div>
		<hr/>
		<?php
		$success_message = $this->session->flashdata('success_message');
		if($error_message):
		?>
		<div class="alert alert-danger"><?php echo $error_message;?></div>
		<?php endif;?>
		<?php if($success_message):?>
		<div class="alert alert-success"><?php echo $success_message;?></div>
		<?php endif;?>
		
		<form action="" method="POST" role="form" id="frmAdd">
		<div class="row">
			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
			<div class="form-group">
			<label for="usr">Full Name *</label>
			<input type="text" class="form-control" name="name" value="<?php echo set_value('name')?>" >
			</div>
			</div>
			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
			<div class="form-group">
			<label for="email">Email address *</label>
			<input type="text" class="form-control" name="email" value="<?php echo set_value('email')?>" >
			</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
			<div class="form-group">
			<label for="comment">Address</label>
			<textarea class="form-control" rows="5" name="address"><?php echo set_value('address')?></textarea>
			</div>
			</div>
			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
			<div class="form-group">
			<label for="city">City *</label>
			<input type="text" class="form-control" name="city" value="<?php echo set_value('city')?>" >
			</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
			<div class="form-group">
			<label for="mobile">Mobile No *</label>
			<input type="text" class="form-control" name="mobile" value="<?php echo set_value('mobile')?>" >
			</div>
			</div>
			
			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
			<div class="form-group">
			<label for="email">Emergency Contact Name *</label>
			<input type="text" class="form-control" name="emergency_contact_name" value="<?php echo set_value('emergency_contact_name')?>" >
			</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
			<div class="form-group">
			<label for="email">Emergency Contact Num *</label>
			<input type="text" class="form-control" name="emergency_contact_num" value="<?php echo set_value('emergency_contact_num')?>" >
			</div>
			</div>
			
			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
			<label>Are you having any volunteering experience *</label>
			<div class="form-group mt-5">
			<div class="radio-inline"><input type="radio" name="experience">Yes</div>
			<div class="radio-inline"><input type="radio" name="experience">No</div>
			</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
			<div class="form-group">
			<label for="email">If yes, which organization/event?</label>
			<input type="text" class="form-control" name="organization" value="<?php echo set_value('organization')?>" >
			</div>
			</div>
			
			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
			<div class="form-group">
			<label for="email">Best time to reach you?</label>
			<input type="text" class="form-control" name="time_to_reach" value="<?php echo set_value('time_to_reach')?>" >
			</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
			<div class="form-group">
			<label for="email">	T-shirt size</label>
			<input type="text" class="form-control" name="tshirt_size" value="<?php echo set_value('tshirt_size')?>" >
			</div>
			</div>
			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
			<div class="form-group">
			<label for="email">	Any Comments?</label>
			<textarea class="form-control" rows="5" name="comments"><?php echo set_value('comments')?></textarea>
			</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12 col-md-6 col-sm-12 col-xs-12 align-center mb-20 mt-20">
				<button type="submit" class="btn btn-default" id="submit-bt">Submit</button>
			</div>
		</div>
		<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
		</form>
	</div>