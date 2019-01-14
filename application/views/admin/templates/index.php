		<link rel="stylesheet" href="<?php echo site_url(ASSET);?>/admin/css/colorbox.css" />                                   
		<div class="row">
		<?php $this->load->view($selected_template_path.'/components/breadcrumb'); ?>
		</div>
		
		<!-- START CONTENT FRAME -->
		<div class="row">
							<?php
							$error_message = $this->session->flashdata('error_message');//validation_errors();
							$success_message = $this->session->flashdata('success_message');
							if($error_message):
							?>
							<div class="alert alert-danger"><?php echo $error_message;?></div>
							<?php endif;?>
							<?php if($success_message):?>
							<div class="alert alert-success"><?php echo $success_message;?></div>
							<?php endif;?>
							
							<?php
							foreach($all_templates as $template):
							?>
							<div class="col-lg-3 col-md-3 col-xs-12 col-sm-6">
								<div class="thumbnail">
								  <?php
								  $link = '';
								  $customer_banner_folder = $this->config->item('customer_asset_folder') . DIRECTORY_SEPARATOR;
								  //$jpg = $template->slug . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'preview.jpg';
								  $png = $template->slug . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'preview.png';
								  //if(is_file($customer_banner_folder.$jpg))
									  //$link = site_url(ASSET) . DIRECTORY_SEPARATOR . $jpg;
								  //else
									  $link = site_url(ASSET) . DIRECTORY_SEPARATOR . $png;
								  ?>								  
								  <a href="<?php echo $link;?>" class="colorbox">
								  <img src="<?php echo $link;?>" alt="">
								  </a>
								  <div class="caption">
									<h3><?php echo $template->name;?></h3>
									<div style="padding-top:10px;">
										<?php if($site_settings->template_id == $template->id):?>
											<div style="cursor: auto;" class="btn btn-default">Current Template</div>
										<?php else:?>
											
											<a href="javascript:void(0);" onclick="activateTemplate('<?php echo $template->id;?>')" class="btn btn-default">Activate</a>
										<?php endif;?>
										
										<?php /*<button type="button" class="btn btn-default" data-toggle="modal" data-target="#preview_<?php echo $template->id;?>">Preview</button>*/?>
									</div>
								  </div>
								</div>
								
							</div>
							<?php endforeach;?>
						</div>
		<!-- END CONTENT FRAME -->
		<?php $this->load->view($selected_template_path.'/common/script');?>
		<script src="<?php echo site_url(ASSET);?>/admin/js/jquery.colorbox-min.js"></script>
		<script>
			$(document).ready(function(){
				$(".colorbox").colorbox({width:"70%"});
			});
			setTimeout(function() {$(".alert").addClass('hidden').slideUp("slow") ; }, 10000);
		</script>
				
		<script type="text/javascript">
		 function activateTemplate(id)
			{
				window.location.href = "<?php echo site_url($customer_admin['dashboard_url'].'/templates/index/');?>/"+id;
			}

		</script>	