<style>
label {
    width: 200px;
}	
.btnadd {margin-top:50px;}		
</style>
				
<!-- START CONTENT FRAME -->
<div class="content-frame">                                    
	<!-- START CONTENT FRAME TOP -->
	<?php $this->load->view($selected_template_path.'/components/breadcrumb'); ?>
	<!-- END CONTENT FRAME TOP -->
	
	
	
	<!-- START CONTENT FRAME BODY -->
	<div class="content-frame-body menu" id="pro" style="margin-left: 10px;" >
		
		<div class="panel panel-default">
			<?php /*<div class="panel-heading">
			   <h4 style="margin:0; padding:0;">View Enquiry Details</h4>
			</div>*/?>
			<div class="panel-body">
				
				<div class="row placeholders">
					<div class="col-xs-12 col-sm-12 placeholder">
					  <div class="starter-template">
						
						
							<form method="POST" role="form" id="frmAdd" enctype="multipart/form-data"> 
							
								<?php
								foreach($services as $service) {
									$variable_name = $service->variable_name;
									$is_enable = $service->is_enable;
									
									$$variable_name = $is_enable;
								}
								
								$error_message = $this->session->flashdata('error_message');//validation_errors();
								$success_message = $this->session->flashdata('success_message');
								if($error_message):
								?>
								<div class="alert alert-danger"><?php echo $error_message;?></div>
								<?php endif;?>
								<?php if($success_message):?>
								<div class="alert alert-success"><?php echo $success_message;?></div>
								<?php endif;?>
																
								<div class="col-xs-6 col-sm-6">
									<h3 style="margin:30px 0 20px 0;">Cart Link</h3>
									<div class="form-group"> 
										<label  class="">Header</label>
										<input type="radio" value="1" name="header"<?php if($header == 1):?> checked="true"<?php endif;?>  class=""> <span class="checkspan">Enable</span></input> 
										<input type="radio" value="0" name="header" class=""<?php if($header == 0):?> checked="true"<?php endif;?>> <span class="checkspan">Disable</span></input>
									</div>
									
									<h3 style="margin:30px 0 20px 0;">Add to cart Button</h3>
									<div class="form-group"> 
										<label  class="">Product page</label>
										<input type="radio" value="1" name="product_page"<?php if($product_page == 1):?> checked="true"<?php endif;?>  class=""> <span class="checkspan">Enable</span></input> 
										<input type="radio" value="0" name="product_page" class=""<?php if($product_page == 0):?> checked="true"<?php endif;?>> <span class="checkspan">Disable</span></input>
									</div>
									<div class="form-group"> 
										<label  class="">Product detail page</label>
										<input type="radio" value="1" name="product_detail_page"<?php if($product_detail_page == 1):?> checked="true"<?php endif;?>  class=""> <span class="checkspan">Enable</span></input> 
										<input type="radio" value="0" name="product_detail_page" class=""<?php if($product_detail_page == 0):?> checked="true"<?php endif;?>> <span class="checkspan">Disable</span></input>
									</div>
									<div class="form-group"> 
										<label  class="">Category page</label>
										<input type="radio" value="1" name="category_page"<?php if($category_page == 1):?> checked="true"<?php endif;?>  class=""> <span class="checkspan">Enable</span></input> 
										<input type="radio" value="0" name="category_page" class=""<?php if($category_page == 0):?> checked="true"<?php endif;?>> <span class="checkspan">Disable</span></input>
									</div>
									<div class="form-group"> 
										<label  class="">Subcategory page</label>
										<input type="radio" value="1" name="subcategory_page"<?php if($subcategory_page == 1):?> checked="true"<?php endif;?>  class=""> <span class="checkspan">Enable</span></input> 
										<input type="radio" value="0" name="subcategory_page" class=""<?php if($subcategory_page == 0):?> checked="true"<?php endif;?>> <span class="checkspan">Disable</span></input>
									</div>
									<div class="form-group"> 
										<label  class="">Brand page</label>
										<input type="radio" value="1" name="brand_page"<?php if($brand_page == 1):?> checked="true"<?php endif;?>  class=""> <span class="checkspan">Enable</span></input> 
										<input type="radio" value="0" name="brand_page" class=""<?php if($brand_page == 0):?> checked="true"<?php endif;?>> <span class="checkspan">Disable</span></input>
									</div>
									<div class="form-group"> 
										<label  class="">Featured products</label>
										<input type="radio" value="1" name="featured_section"<?php if($featured_section == 1):?> checked="true"<?php endif;?>  class=""> <span class="checkspan">Enable</span></input> 
										<input type="radio" value="0" name="featured_section" class=""<?php if($featured_section == 0):?> checked="true"<?php endif;?>> <span class="checkspan">Disable</span></input>
									</div>
								</div>							
							
								<div class="col-xs-12 col-sm-12"><div class="form-group">  <input type="submit" value="Save" class="btn btn-primary btnadd" id="btnadd" name="siteupdate" />  </div>     
								<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>"></div>	
							</form>

					  </div>
					</div>
				  
				</div>
				
			</div>

		  
				
		</div>
									   
	</div>

</div>

<script>
$(document).ready(function() {
	$("body").delegate('input[name=t_background_image]', 'click', function() {
		$t_background_image = $(this).val();
		
		if ($t_background_image == 2) {
			$('.custom_section').show();
		} else {
			$('.custom_section').hide();
		}
	});
});
</script>