
             
                                
                <!-- START CONTENT FRAME -->
	<div class="content-frame">                                    
		<div class="row">
		<?php $this->load->view($selected_template_path.'/components/breadcrumb'); ?>
		</div>
                    
                    
                    <!-- START CONTENT FRAME BODY -->
                    
					<!--  Add Menu -->
                    <div class="content-frame-body menu" id="pro"  >
                        
                        <div class="panel panel-default">
                            <div class="panel-body">
                                
                                <!--Add Menu Type Form-->
								<?php
								$success_message = $this->session->flashdata('success_message');
								$error_message = $this->session->flashdata('error_message');
								?>
								<div class="alert alert-danger<?php if(!$error_message):?> hidden<?php endif;?>">
								<?php
								if($error_message):
								?><?php echo $error_message;?>
								<?php endif;?>
								</div>
								<div class="alert alert-success<?php if(!$success_message):?> hidden<?php endif;?>">
								<?php if($success_message):?>
								<?php echo $success_message;?>
								<?php endif;?>
								</div>
								<div class="col-md-8">
									<form method="POST" role="form" id="frmAdd"> 
										<div class="form-group required"> <label  class="">Menu Type</label> </div> 
										<div class="form-group">  <?php if(count($menu_type)): foreach($menu_type as $menu_type): ?>	
										<label class="check"> <input type="checkbox" name="m_t_id[]" value="<?php echo $menu_type->id;?>" class="icheckbox">
										<?php echo $menu_type->title;?>
										</label>
										<?php endforeach; ?>
										<?php else: ?>

										<?php endif; ?>	   
										</div>   
										<div class="form-group required"> <label  class="">Title</label>
										<input type="text" name="title"  class="form-control" value="">   </div> 
										<div class="form-group required"> <label  class="">Slug</label>
										<input type="text" name="slug"  class="form-control" value="">
                                        [page url will be: http://jgtech.com/demo/{slug}]
                                        </div> 
										<div class="form-group required"> <label  class="">Sub Menu</label>
										<select name="parent_id" class="form-control select">
										<option value="0">Parent Menu</option>
										<?php if(count($sub_menu)): foreach($sub_menu as $sub_menu): ?>	
										<?php if($sub_menu->parent_id==0){?> <option value="<?php echo $sub_menu->id;?>"><?php echo $sub_menu->title;?></option>
										<?php echo get_sub_option($sub_menu->id);?>
										<?php }?>
										<?php endforeach; ?>
										<?php else: ?>

										<?php endif; ?>	
										</select>   
										</div>
										<div class="form-group required"> <label  class="">Page Type</label> </div>  
										<div class="form-group"> 
										<?php foreach($page_types as $page_type): ?>
											<input type="radio" value="<?php echo $page_type->slug;?>" name="dynamic_page_type"<?php if($page_type->slug == 'other'):?> checked="checked"<?php endif;?>/> <?php echo $page_type->name;?>
										<?php endforeach; ?>
										
										<?php /*<input type="radio" value="<?php echo config_item('page_types')['dynamic'];?>" name="page_type_id" checked="checked"/> Dynamic Page										
										<label class="radio"><input type="radio" value="2" name="page_type_id" class="iradio"/> Static Page</label>*/?>
										
										</div> 

										<div class="form-group"> <label  class="">Order</label>
										<input type="text" name="order_by" class="form-control" value=""></div>
										        
										<div class="form-group">  <input type="button" value="Add" class="btn btn-primary btnadd" id="btnadd" />  </div>     
										<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">		 
									</form>
								</div>
							</div>                          
                                
						</div>
												   
					</div>
                        
                </div>      
                
                
                
				<?php $this->load->view($selected_template_path.'/common/script');?>
				

				<script>
					setTimeout(function() {$(".alert").addClass('hidden').slideUp("slow") ; }, 10000);
					
					/**
				 *Add Form
				 */		
				$(document).on("click", "#btnadd", add);
						function add(){
							var post = $("#frmAdd").serialize();
							$(".spinner").removeClass('hidden') ;
							$.post('<?php echo site_url($customer_admin['dashboard_url']);?>/menu/process_add', post, function(data){
									var result = $.parseJSON(data) ;					
									if(result.status == 0 )
									{$(".menu .alert-success").addClass('hidden') ;
										$(".menu .alert-danger").html(result.statusmsg).removeClass('hidden');	
										$('html,body').animate({scrollTop:0},0);
									}
									else {
									$(".menu .alert-danger").addClass('hidden') ;
									//$('.menu #title').val('');
									//$(".menu .alert-success").html(result.statusmsg).removeClass('hidden');
									location.reload(); 
								$(".spinner").addClass('hidden') ;}
							})
						}
				</script>