				<?php $this->load->view($selected_template_path.'/components/breadcrumb'); ?>				
                                
                <!-- START CONTENT FRAME -->
                <div class="content-frame">                                    
                    <!-- START CONTENT FRAME TOP -->
                    <div class="content-frame-top">                        
                        <div class="page-title">                    
                            <h2><span class="fa fa-file-text"></span> Add a Template </h2>
                        </div>                                                                           
                                              
                    </div>
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
										
										<form method="POST" role="form" id="frmAdd"> 
		
											<div class="form-group"> <label  class="">Name</label>
												<input type="text" name="templatename" placeholder="Template Name" class="form-control" value="<?=set_value('templatename')?>" style="width:200px;">  <div class="err"><?php echo form_error('templatename'); ?></div> </div> 
												<!--  id="ajaxfilemanager"-->
												<div class="form-group">  <input type="submit" value="Save" class="btn btn-primary btnadd" id="btnadd" />  
											</div>     

										</form>
										

									  </div>
									</div>
								  
								</div>
								
								<div class="row placeholders">
									<div class="col-xs-12 col-sm-12 placeholder">
									  <div class="starter-template">
										
										<table class="table table-striped table-bordered table-condensed">
											<tr>
											<td><strong>ID</strong></td>
											<td><strong>Template Name</strong></td>
											<td><strong>Delete</strong></td>
											</tr> 
											<?php 
											foreach($all_templates as $user){     
													?>
													<tr><td><?php echo $user->id;?></td><td><?php echo $user->name;?></td><td><a href="<?php echo site_url($customer_admin['dashboard_url']."/templates/delete/".$user->id)?>">Delete Template</a></td></tr>     
													<?php 
												} 
											?>  
										</table> 
										

									  </div>
									</div>
								  
								</div>
								
							</div>

                          
                                
                            </div>
                                                       
                        </div>
					</div>