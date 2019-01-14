<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8" >
	<meta content="text/html" charset="UTF-8" http-equiv="content-type" >
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" >
	<title>Restaurant</title>

<!-- bootstrap -->
	<link rel="stylesheet" href="<?php echo site_url('assets/cms/css/bootstrap.min.css');?>" >

</head>
<body>
	<div class="wrapper">
		<?php
		if($error_message):
		?>
		<div class="alert alert-danger"><?php echo $error_message;?></div>
		<?php endif;?>
		<form method="POST" role="form" id="frmAdd" enctype="multipart/form-data"> 
          
			<div class="form-group"> 
				<label  class="">Product Image</label>
				<input type="file" name="product_image" id="product_image"  class="form-control">
				<div>
				<?php if(isset($default_image) and strpos($default_image, 'product-thumb.jpg') === false ):?>
				<input type="hidden" name="product_image_name" id="product_image_name" value="<?php echo set_value('product_image_name', $product_image_name)?>" />
				<img src="<?php echo $default_image;?>" width="100" height="100">
				<?php endif;?>
				[width x height: <?php echo $this->config->item('free_product_width') . ' x ' . $this->config->item('free_product_height');?>]
				</div>
			</div> 
            <div class="form-group">
				<label  class="">Title</label>
				<input type="text" name="title" id="title"  class="form-control" value="<?php echo set_value('title', $title)?>">
				<div class="err"><?php echo form_error('title'); ?></div>
			</div>   
            <div class="form-group">
				<label  class="">Price</label>
				<input type="text" name="price" id="price"  class="form-control" value="<?php echo set_value('price', $price)?>">
				<div class="err"><?php echo form_error('price'); ?></div>
			</div>
            <div class="form-group">
				<label  class="">Strike Price</label>
				<input type="text" name="strike_price" id="strike_price"  class="form-control" value="<?php echo set_value('strike_price', $strike_price)?>">
				<div class="err"><?php echo form_error('strike_price'); ?></div>
			</div>
            <div class="form-group">
				<label  class="">Description</label>
				<textarea name="description"  id="description" class="form-control"><?php echo set_value('description', $description)?></textarea>
				<div class="err"><?php echo form_error('description'); ?></div>
			</div>
			<div class="form-group">  
				<input type="submit" value="Update" class="btn btn-primary" id="btnedit" />
			</div>
			
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">      
			<input type="hidden" name="placeholder_id" value="<?php echo $placeholder_id;?>">
			
		</form>
		
	</div>

			<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
			<script src="<?php echo site_url('assets/cms/js/bootstrap.min.js');?>"></script>
			<?php if(isset($success_data) and !empty($success_data)):
			//print_r($success_data);
			?>
			<script>
			$(document).ready(function(){
				$( "a.blockShadow" , window.parent.document).each(function() {
					$id = $(this).data('id');
					
					if($id == '<?php echo $placeholder_id;?>') {
						$(this).find('img').attr('src', '<?php echo $success_data['default_image'];?>');
						$(this).find('.title').html('<?php echo $success_data['title'];?>');
						$(this).find('.description').html('<?php echo $success_data['description'];?>');
						$(this).find('.prices').html('<s><?php echo $success_data['strike_price'];?></s> - <?php echo $success_data['price'];?>');
						parent.jQuery.fn.colorbox.close();
						return false;
					}
				});
				
				//$('.blockShadow p', window.parent.document).html('aa');
			});
			</script>
			<?php endif;?>
</body>
</html>