			<div class="content-frame">                                    
                    <div class="row">
				<?php $this->load->view($selected_template_path.'/components/breadcrumb'); ?>
				</div> 


					<!-- START CONTENT FRAME BODY -->
                    <div class="content-frame-body menu" id="pro"  >
                        
                        <div class="panel panel-default">
                            <div class="panel-body">
								<div class="col-md-6">
									
									<!--Add Menu Type Form-->
									<?php
									$success_message = $this->session->flashdata('success_message');
									$error_message1 = $this->session->flashdata('error_message');
									if($error_message):
									?>
									<div class="alert alert-danger"><?php echo $error_message;?></div>
									<?php elseif($error_message1):?>
                                    <div class="alert alert-danger"><?php echo $error_message1;?></div>
									<?php endif;?>
									<?php if($success_message):?>
									<div class="alert alert-success"><?php echo $success_message;?></div>
									<?php endif;?>
									
									<form method="POST" role="form" id="frmAdd" enctype="multipart/form-data"> 
              
										<div class="form-group required"> <label  class="">Title </label>
											<input type="text" name="title" id="title" class="form-control" value="<?php echo set_value('title')?>">   </div> 
										<div class="form-group required"> <label  class="">Category</label>
											<?php 
											$article_category_id = set_value('article_category_id');
											?>
											<select name="article_category_id" id="article_category_id"  class="article_category_id select form-control">
											<option value="">Select</option>
											<?php if(count($article_categories)): foreach($article_categories as $article_category): ?>	
											<option value="<?php echo $article_category->id;?>"<?php if($article_category_id == $article_category->id):?> selected<?php endif;?>><?php echo $article_category->name;?></option>
											<?php endforeach; ?>
											<?php else: ?>
											We could not find any manufacture.
											<?php endif; ?>	
											</select>
										</div>
										<div class="form-group"> <label  class="">Meta Keywords</label>
										<input type="text" name="meta_tag" id="meta_tag" class="form-control" value="<?php echo set_value('meta_tag')?>">   </div> 

										<div class="form-group"> <label  class="">Meta Descripition</label></div> 
										<div class="form-group"> <textarea name="meta_desc" id="meta_desc" class="form-control" ><?php echo set_value('meta_desc')?></textarea>  </div> 
                                        
                                        <div class="form-group"> <label  class="">Featured Image </label> 	</div> 
										<div class="form-group">
                                        	<input id="product_image" class="form-control" type="file" name="file" class="upload" />
                                        </div>

										<div class="form-group required"> <label  class="">Content</label></div> 
										<div class="form-group">
										<textarea name="body_desc" class="tinymce" id="body_desc" ><?php echo set_value('body_desc')?></textarea>
										<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>"> 

										</div>
                                        		 
										<!--  id="ajaxfilemanager"-->
										<div class="form-group">  <input type="submit" value="Add" class="btn btn-primary btnadd" id="btnadd" />  </div>     

									</form>
								</div>
							</div>
						
						</div>

                          
                                
                    </div>
			</div>
			
			
			<?php $this->load->view($selected_template_path.'/common/script');?>