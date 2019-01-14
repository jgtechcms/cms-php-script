
 <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
 <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
<?php /*<script src="<?php echo site_url(ASSET)?>/admin/js/jquery-ui-autocomplete.js"></script>*/?>
<style>
  .sortable { list-style-type: none; margin: 0; padding: 0; width: 60%; }
  .sortable li { margin: 0 5px 5px 5px; padding: 5px; font-size: 1.2em; height: 1.5em; cursor: move; }
  html>body .sortable li { height: 1.5em; line-height: 1.2em; }
  .ui-state-highlight { height: 1.5em; line-height: 1.2em; }
  </style>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
    $( ".sortable" ).sortable({
		  placeholder: "ui-state-highlight"
    });
    $( ".sortable" ).disableSelection();
  } );
  
  $(document).ready(function (e){	
	$( "#related_product" ).autocomplete({
		source: function( request, response ) {
			$.ajax( {
			  type: 'POST',
			  url: '<?php echo site_url($customer_admin['dashboard_url'].'/widgets/get');?>',
			  dataType: "json",
			  data: {
				txt: request.term,
				<?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo $this->security->get_csrf_hash(); ?>'
			  },
			  success: function( data ) {
				var resp = {};
				$.each(data.view_details, function(index, prolist) {
						var product_related = [];
						$('input[name^="product_related"]').each(function() {
							product_related.push($(this).val());
						});
						if( jQuery.inArray( prolist.id, product_related ) < 0 ) {
							resp[index] = {};
							resp[index]['id'] = prolist.id;		
							resp[index]['value'] = prolist.name;	
							resp[index]['label'] = prolist.name;
						}
				});
				//console.log(resp);
				response( resp );
			  }
			} );
		},
		minLength: 0,
		//response: function( event, ui ) {}
		select: function( event, ui ) {
			//log( "Selected: " + ui.item.value + " aka " + ui.item.id );
		
			$('#widget-' + ui.item.id).remove();
			
			
				$('#product-related').append('<li class="ui-state-default" id="widget-' + ui.item.id + '"><i class="fa fa-minus-circle"></i> ' + ui.item.value + '<input type="hidden" name="product_related[]" value="' + ui.item.id + '" />' + 
				'<input type="hidden" name="product_related_value[' + ui.item.id + ']" value="' + ui.item.value + '" />' + '</li>');
			
				this.value = "";
				
				//$(this).autocomplete("search", "");
				
				return false;
			
		}
    }).focus(function () {
		$(this).autocomplete("search", "");
	});
	$('#product-related').delegate('.fa-minus-circle', 'click', function() {
		$(this).parent().remove();
	});
});
  </script>
             
                                
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
								//$error_message = $this->session->flashdata('error_message');
								$error_message1 = $this->session->flashdata('error_message');
								if($error_message):
								?>
								<div class="alert alert-danger"><?php echo $error_message;?></div>
								<?php elseif($error_message1):?>
								<div class="alert alert-danger"><?php echo $error_message1;?></div>
								<?php endif;?>
								<div class="alert alert-success<?php if(!$success_message):?> hidden<?php endif;?>">
								<?php if($success_message):?>
								<?php echo $success_message;?>
								<?php endif;?>
								</div>
								<div class="col-md-8">
									<form method="POST" role="form" id="frmAdd"> 
									  <div class="form-group required"> <label  class="">Menu</label> </div> 
									   <div class="form-group">  
										   <select id="menu_add_page" name="menu" class="form-control select menu_add_page" >      
												<option value="">Select</option>
											<?php if(count($sub_menu)): foreach($sub_menu as $menu): ?>	
												<option data-menu_name="<?php echo $menu->title;?>" data-is_product="<?php echo $menu->is_product;?>" value="<?php echo $menu->id;?>"<?php if(set_value('menu') == $menu->id){ echo ' selected';}?>><?php echo $menu->title;?></option>
												<?php //echo get_sub_option($sub_menu->id);?>
											<?php endforeach; ?>
											<?php else: ?>

											<?php endif; ?>	
											</select>   
										</div>  
										<div class="form-group"> <label  class="">H1 Title </label>
										<input type="text" name="title"  class="form-control" value="<?php echo set_value('title')?>" placeholder="H1 Title">   </div>  
										<div class="form-group"> <label  class="">Meta Title <?php //echo get_tooltip('tooltip_pages_title'); ?></label>
										<input type="text" name="meta_title"  class="form-control" value="<?php echo set_value('meta_title')?>" placeholder="<?php echo config_item('form_field_pages_title');?>">   </div> 
										<div class="form-group"> <label  class="">Meta Keywords</label>
										<input type="text" name="meta_tag"  class="form-control" value="<?php echo set_value('meta_tag')?>" placeholder="<?php echo config_item('form_field_pages_meta_tag');?>">   </div> 

										<div class="form-group"> <label  class="">Meta Description</label></div> 
										<div class="form-group"> <textarea name="meta_desc" class="form-control" placeholder="<?php echo config_item('form_field_pages_meta_description');?>"><?php echo set_value('meta_desc')?></textarea>  </div> 

										 
										<div class="form-group">
                                            <label  class="">Select Widgets</label>	<br />		
                                        <div class="multiselect ui-widget" id="relatedproducts">
                                            <input type="text" name="related_product" id="related_product"> [search by name and click it to add the list]
                                        
                                        </div>	
                                        <div class="ui-widget" style="margin-top:2em; font-family:Arial">
                                          Selected widget lists:
                                          <ul id="product-related" style="height: 250px; width: 300px; overflow: auto;" class="sortable ui-widget-content">
                                            <?php 
                                            foreach($product_related as $related):?>
                                                <li class="ui-state-default" id="widget-<?php echo $related->item_id;?>"><i class="fa fa-minus-circle"></i> <?php echo $related->item_name;?><input type="hidden" name="product_related[]" value="<?php echo $related->item_id;?>" /></li>
                                            <?php 
                                            endforeach;?>
                                            <?php
											if($product_related_post)
                                            foreach($product_related_post as $related_id):?>
                                                <li class="ui-state-default" id="widget-<?php echo $related_id;?>"><i class="fa fa-minus-circle"></i> <?php echo $product_related_value[$related_id];?><input type="hidden" name="product_related[]" value="<?php echo $related_id;?>" /></li>
                                            <?php 
                                            endforeach;?>
                                          </ul>
                                          [Drag widget to sort]
                                        </div>
                                        </div> 								
													  <!--  id="ajaxfilemanager"-->
										<div class="form-group">  <input type="submit" value="Add" class="btn btn-primary btnadd" id="btnadd" />  </div>     
										<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
										</form>
								</div>
							</div>                          
                                
						</div>
												   
					</div>
                        
                </div>      
                
                
                
				<?php $this->load->view($selected_template_path.'/common/script');?>