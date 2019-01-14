<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8" >
	<meta content="text/html" charset="UTF-8" http-equiv="content-type" >
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" >
	<title>Licence key update</title>
	<style>
	.alert-danger {
		background-color: #E04B4A;
		color: #FFF;
		border-color: #af4342;
	}
	.alert-success {
		background-color: #95b75d;
		color: #FFF;
		border-color: #90b456;
	}
	.alert {
		float: left;
		width: 100%;
		margin-bottom: 10px;
		line-height: 21px;
	}
	</style>
</head>
<body>
	<div class="container">
		<?php
		$lkey = $site_settings->lkey;
		$gen_key = !empty($site_settings->gen_key) ? $site_settings->gen_key : '--';
		
		$error_message = validation_errors();
		$success_message = $this->session->flashdata('success_message');
		if($error_message):
		?>
		<div class="alert alert-danger"><?php echo $error_message;?></div>
		<?php endif;?>
		<?php if($success_message):?>
		<div class="alert alert-success"><?php echo $success_message;?></div>
		<?php endif;?>
		<form method="POST" role="form" id="frmAdd" enctype="multipart/form-data">
			<div class="form-group"> 
				<label  class="">Key:</label> 
				<input type="text" name="lkey" placeholder="Key" class="form-control" value="<?php echo set_value('lkey', $lkey);?>">
			</div> 
			<div class="form-group" style="display:none;"> 
				<label  class="">Generated Key:</label> 
				<?php echo $gen_key;?>
			</div>
			
			<div class="form-group" style="margin-top:20px;">  
				<input type="submit" value="Generate" class="btn btn-primary btnadd" id="btnadd" name="siteupdate" />  
			</div>     
			<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
		</form>
	</div>
</body>
</html>