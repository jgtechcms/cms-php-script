
             
                                
                <!-- START CONTENT FRAME -->
                <div class="content-frame">                                    
                    <div class="row">
					<?php $this->load->view($selected_template_path.'/components/breadcrumb'); ?>
					</div>
                    
                    
                    <!-- START CONTENT FRAME BODY -->
                    
					<!--  Add Menu -->
                    <div class="content-frame-body menu" id="editpro"  >
                        
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
									<form method="POST" role="form" id="frmEdit"> 
										<div class="form-group required"> <label  class="">Menu Type</label> </div> 
										<div class="form-group">  <span id="cnt"><?php if(count($menu_type)): foreach($menu_type as $menu_type): ?>	
										<label class="check"> <input type="checkbox" name="m_t_id[]" value="<?php echo $menu_type->id;?>" class="icheckbox">
										<?php echo $menu_type->title;?>
										</label>
										<?php endforeach; ?>
										<?php else: ?>

										<?php endif; ?>	  </span> 
										</div>   
										<div class="form-group required"> <label  class="">Title</label>
										<input type="text" name="title" id="title" class="form-control" value="">   </div> 
										<div class="form-group required"> <label  class="">Slug</label>
										<input type="text" name="slug" id="slug" class="form-control" value="">
                                        [page url will be: http://jgtech.com/demo/{slug}]   </div> 
										<div class="form-group required"> <label  class="">Sub Menu</label>
										<select name="parent_id" id="parent_id" class="form-control select">
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
										<input type="text" name="order_by" id="order_by" class="form-control" value=""></div>
										        
										<div class="form-group">  <input type="button" value="Update" class="btn btn-primary btnedit" id="btnedit" />  </div>    
										<input type="hidden" name="id" id="id" value="">
										<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">		 
									</form>
								</div>
							</div>                          
                                
						</div>
												   
					</div>
                        
                </div>      
                
                
                
				<?php $this->load->view($selected_template_path.'/common/script');?>
				
				<script>
				$(document).ready(function(){	
					var res = <?php echo $menu_detail;?>;
					renderListform(res);
				});
				function renderListform(view_details){ 
					$('#id').val(view_details.id);
					$('#title').val(view_details.title);
					$('#slug').val(view_details.slug);
					$('#order_by').val(view_details.order_by);
					$('#cnt input').filter(':checkbox').prop('checked',false);
					$('#rad input[value='+view_details.page_type_id+']').filter(':radio').prop('checked',true);
					$('#parent_id').val(view_details.parent_id);
					$('#fa_icon_value').val(view_details.fa_icon_value);
					//$('.parent_id').selectpicker('refresh');
					 // $('select[name="page_type_id"]').val(view_details.page_type_id); 
					  
					var myArray=[];
					if(view_details.m_t_id)
						myArray = view_details.m_t_id.split(',');	
					
					 for(var i=0;i<myArray.length;i++){      
						 $('#cnt input[value='+myArray[i]+']').filter(':checkbox').prop('checked',true);
					}
					var page_type = view_details.page_type;
					$("input[name=dynamic_page_type][value="+page_type+"]").prop('checked', true);
					
				}
					</script>

				<script type="text/javascript">
					/**
				 *Updated Form 
				 */	
						
				$(document).on("click", "#btnedit", edits);
				 function edits(){
							$(".alert-danger").addClass('hidden') ;
							$(".alert-success").addClass('hidden') ;
							
							var post = $("#frmEdit").serialize();
							$.post('<?php echo site_url($customer_admin['dashboard_url'].'/menu/process_edit');?>', post, function(data){
									var result = $.parseJSON(data) ;			
									if(result.status == 0 )
									{
										$(".alert-success").addClass('hidden') ;
										$(".alert-danger").html(result.statusmsg).removeClass('hidden');	
									}
									else {
									$(".alert-danger").addClass('hidden') ;
									$(".alert-success").html(result.statusmsg).removeClass('hidden');									
									//location.reload();
									}
									$('html,body').animate({scrollTop:0},0);
							})
						}		
				</script>
				<script type="text/javascript">
				$(document).on("click", ".showmenu", showmenu);
					function showmenu(){
						$('.editpro').fadeOut("slow");
							$('.menu').fadeIn("slow");
						}
						
						$(document).on("click", ".showmenu_order", showmenu_order);
					function showmenu_order(){
						$('.editpro').fadeOut("slow");
							$('.menu').fadeOut("slow");
							 $('.menu_order').fadeIn("slow");
						}
						
					</script>
					
				<script type="text/javascript">
				 function deleteRow(id)
					{
						
						if (confirm("Are you sure want to delete the selected menu?") == true) {
						  var id = id;
						$('#hide'+id).show();
						$.ajax({
							type: 'POST',
							data: {<?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo $this->security->get_csrf_hash(); ?>'},
							url:"<?php echo site_url($customer_admin['dashboard_url'].'/menu/delete');?>/"+id,
							dataType: "json", // data type of response		
							success:function(result)
							{
								if(result.status == 0 )
								{
									$(".editpro .alert-success").addClass('hidden') ;
									$(".editpro .alert-danger").html(result.statusmsg).removeClass('hidden');	
								}
								else 
								{
									location.reload();
								}
							},
							   
							});
						}
					}

				</script>