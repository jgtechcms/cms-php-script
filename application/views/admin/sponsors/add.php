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
										<div class="form-group required"> <label  class="">Name </label>
										<input type="text" name="name"   class="form-control" value="<?php echo set_value('name')?>" >   
										</div>      
										<div class="form-group required"> <label  class="">Icon </label> 
										
										<div style="clear:both;"></div>
										<input id="uploadFile" placeholder="Choose File" disabled="disabled" class="upload_txt_box"  style=" "/>
										<div class="fileUpload btn btn-primary">
											<span> Browse</span>
											<input id="product_image" type="file" name="icon" class="upload" />
										</div>
										<div style="clear:both;"></div>

										<style>
										.upload_txt_box{
												float:left;
												padding: 4px 12px;
												font-size: 14px;
												line-height: 1.42857143;
												color: #555;   
												border: 1px solid #ccc;
												border-radius: 4px;
												-webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
												box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
												-webkit-transition: border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;
												-o-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
												transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
											}
											.fileUpload {
												position: relative;
												overflow: hidden; margin-left:2px;
												
											}
											.fileUpload input.upload {
												position: absolute;
												top: 0;
												right: 0;
												margin: 0;
												padding: 0;
												font-size: 20px;
												cursor: pointer;
												opacity: 0;
												filter: alpha(opacity=0);
											}
										</style>
										
										
										 <!--<div id="fileselector">
												<label class="btn btn-default" id="uploadfile" for="upload-file-selector">
										<input type="file" id="upload-file-selector" name="icon"/><i class="glyphicon glyphicon-search" style="margin-top: 1px;"></i>Browse</label>
												</div>-->
										</div>  
										<div class="form-group"> <label  class="">URL</label>
										<input type="text" name="url" placeholder="http://" class="form-control" value="<?php echo set_value('url')?>" >
										</div>  
										<div class="form-group required"> <label  class="">Status</label>
											<select name="status" class="form-control">
												<option value="1" selected>Active</option>
												<option value="0">In-Active</option>
											</select>
										</div>  
										
										<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
										                  
										<div class="form-group">  <input type="submit" value="Add" class="btn btn-primary" id="btnadd" />  </div>   

									</form>
								</div>
							</div>
						
						</div>

                          
                                
                    </div>
			</div>
			
										<script>
											document.getElementById("product_image").onchange = function () {
												document.getElementById("uploadFile").value = this.value;
											};
										</script>
			<?php $this->load->view($selected_template_path.'/common/script');?>