<style>
.err{color:red;}
</style>
<script type="text/javascript">
$(document).on("change", "select[name=widget_type_id]", showmenu);
	function showmenu(){
		var value = $(this).val();
		if(value == 5) {
			$('.custom_section').show();
			$('.dispay_limit_section').hide();
		} else {
			$('.dispay_limit_section').show();
			$('.custom_section').hide();
		}
				
	}
</script>
                                
                <!-- START CONTENT FRAME -->
                <div class="content-frame">                                    
                    <div class="row">
					<?php $this->load->view($selected_template_path.'/components/breadcrumb'); ?>
                    </div>
                    
					
                    
                    <!-- START CONTENT FRAME BODY -->
                    <div class="content-frame-body menu" id="pro">
                        
                        <div class="panel panel-default">
                            <?php /*<div class="panel-heading">
                               <h4 style="margin:0; padding:0;">View Enquiry Details</h4>
                            </div>*/?>
                            <div class="panel-body">
                                
								<div class="row">
									<div class="col-md-8">
									  <div class="starter-template">										
										
											<form method="POST" role="form" id="frmAdd" enctype="multipart/form-data"> 
											
												<?php
												//$error_message = $this->session->flashdata('error_message');
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
												
												<div class="form-group required"> 
													<label  class="">Widget name </label>
													<input type="text" name="name" class="form-control" value="<?php echo set_value('name', $widget->name);?>">
                                                </div>
												
												<div class="form-group required"> 
													<label  class="">Select widget type </label>
													<select name="widget_type_id" class="form-control select">
														<?php foreach($widget_types as $widget_type):?>
															<option value="<?php echo $widget_type->id;?>"<?php if($widget_type->id == set_value('widget_type_id', $widget->widget_type_id)):?> selected<?php endif;?>><?php echo $widget_type->name;?></option>
														<?php endforeach;?>
													</select> 
												</div> 
                                                <?php
												$widget_type_id = set_value('widget_type_id', $widget->widget_type_id);
												if($widget_type_id == 5) {
													$custom_display = '';
													$limit_display = ' style="display:none;"';
												} else {
													$custom_display = ' style="display:none;"';
													$limit_display = '';
												}
												?>
                                                
                                                <div class="form-group dispay_limit_section"<?php echo $limit_display;?>> 
													<label  class="">Display limit</label>
													<input type="text" name="page_limit" class="form-control" value="<?php echo set_value('page_limit', $widget->page_limit);?>">
                                                </div>
                                                
                                                <div class="form-group"> 
                                                    <label  class="">Section title</label>
                                                    <input type="text" name="section_title" class="form-control" value="<?php echo set_value('section_title', $widget->section_title);?>"> 
                                                </div>
                                                <?php
												$content_layout = set_value('content_layout', $widget->content_layout);
												
												if($content_layout == '')
													$default_content_layout = 'single_column';
												else
													$default_content_layout = $content_layout;
												?>
                                                
                                                <div class="custom_section"<?php echo $custom_display;?>> 
													
                                                    <div class="form-group"> <label  class="">Content Layout</label>
                                                    <select name="content_layout"  class="form-control select">   
                                                        <option value="single_column"<?php if($default_content_layout == 'single_column'):?> selected<?php endif;?>>Single column</option> 
                                                        <option value="two_column"<?php if($default_content_layout == 'two_column'):?> selected<?php endif;?>>Two column</option> 
                                                        <option value="three_column"<?php if($default_content_layout == 'three_column'):?> selected<?php endif;?>>Three column</option> 
                                                        <option value="four_column"<?php if($default_content_layout == 'four_column'):?> selected<?php endif;?>>Four column</option>
                                                    </select>
                                                    </div>
                                                    
                                                    <div id="single_column_content_section">
                                                        <div class="form-group"> 
                                                            <label class=""><span id="single_span">1st</span> Column Content <?php echo get_tooltip('single_column_content'); ?></label>
                                                        </div> 
                                                        <div class="form-group">
                                                        <textarea name="single_column_content" class="tinymce"><?php echo set_value('singe_column_content', $widget->single_column_content);?></textarea>
                                                        </div> 	
                                                    </div> 	
                                                    <div id="two_column_content_section">
                                                        <div class="form-group"> 
                                                            <label class="">2nd Column Content <?php echo get_tooltip('two_column_content'); ?></label>
                                                        </div> 
                                                        <div class="form-group">
                                                        <textarea name="two_column_content" class="tinymce"><?php echo set_value('two_column_content', $widget->two_column_content);?></textarea>
                                                        </div> 	
                                                    </div>
                                                    <div id="three_column_content_section">
                                                        <div class="form-group"> 
                                                            <label class="">3rd Column Content <?php echo get_tooltip('three_column_content'); ?></label>
                                                        </div> 
                                                        <div class="form-group">
                                                        <textarea name="three_column_content" class="tinymce"><?php echo set_value('three_column_content', $widget->three_column_content);?></textarea>
                                                        </div> 	
                                                    </div>
                                                    <div id="four_column_content_section">
                                                        <div class="form-group"> 
                                                            <label class="">4th Column Content <?php echo get_tooltip('four_column_content'); ?></label>
                                                        </div> 
                                                        <div class="form-group">
                                                        <textarea name="four_column_content" class="tinymce"><?php echo set_value('four_column_content', $widget->four_column_content);?></textarea>
                                                        </div> 	
                                                    </div>
                                                </div>
												<br />
												<div class="form-group"> 
													<label  class="">Disable in mobile?</label>
                                                    <?php
													$disable_in_mobile_yes = ' checked';
													$disable_in_mobile_no = '';
													if(set_value('disable_in_mobile', $widget->disable_in_mobile) == 0) {
														$disable_in_mobile_no = ' checked';
														$disable_in_mobile_yes = '';
													}
													?>
													<input type="radio" name="disable_in_mobile" class="" value="1"<?php echo $disable_in_mobile_yes;?> /> yes
													<input type="radio" name="disable_in_mobile" class="" value="0"<?php echo $disable_in_mobile_no;?> /> no
													
													</div>
												</div>
												
												
													  <!--  id="ajaxfilemanager"-->
												<div class="form-group">  
													<input type="submit" value="Update" class="btn btn-primary btnadd" id="btnadd" name="siteupdate" />
												</div>   
												
												<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                                <input type="hidden" name="id" id="id" value="<?php echo $widget->id;?>" />
											</form> 

									  </div>
									</div>
								  
								</div>
								
							</div>

                          
                                
                        </div>
                                                       
                    </div>

				</div>
                <?php $this->load->view($selected_template_path.'/common/script');?>
    <script>
	$(document).ready(function(){
		
		var content_layout = $('select[name=content_layout]').val();
		show_hide_section(content_layout);
		
		$(document).on("change", "select[name=content_layout]", content_layout_process);
		function content_layout_process(){
			var value = $(this).val();
			show_hide_section(value);
					
		}
		
		function show_hide_section(selected) {
			//var all_sections = ['single_column', 'two_column', 'three_column', 'four_column'];
			
			if(selected == 'single_column') {
				$('#single_span').html('Single');
			} else {
				$('#single_span').html('1st');
			}
			
			if(selected == 'single_column') {
				
				$('#single_column_content_section').show();
				$('#two_column_content_section').hide();
				$('#three_column_content_section').hide();
				$('#four_column_content_section').hide();
				
			} else if(selected == 'two_column') {
				
				$('#single_column_content_section').show();
				$('#two_column_content_section').show();
				$('#three_column_content_section').hide();
				$('#four_column_content_section').hide();
				
			} else if(selected == 'three_column') {
				
				$('#single_column_content_section').show();
				$('#two_column_content_section').show();
				$('#three_column_content_section').show();
				$('#four_column_content_section').hide();
				
			} else if(selected == 'four_column') {
				
				$('#single_column_content_section').show();
				$('#two_column_content_section').show();
				$('#three_column_content_section').show();
				$('#four_column_content_section').show();
			}
			
			
		}
		
	});
	
	
	</script>