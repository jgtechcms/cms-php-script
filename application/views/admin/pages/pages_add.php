<?php $this->load->view($default_model.'/admin/common/head'); ?>

    <?php $this->load->view($default_model.'/admin/common/header_menu'); ?>

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
          <?php $this->load->view($default_model.'/admin/common/sidebar'); ?>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
		<?php 
		if(isset($pagevalues)){?>
          <h1 class="page-header">Edit Page </h1>
		<?php } else {  ?>
			<h1 class="page-header">Add a Page </h1>
		<?php } ?>
          <div class="row placeholders">
            <div class="col-xs-12 col-sm-12 placeholder">
              <div class="starter-template">
				
				<?php
				
				//Get the page id
				$pageid = $this->uri->segment('5');
				
				if($pageid == 1)//home
					$page_type_id = 2;
				else if($pageid == 2)//about us
					$page_type_id = 2;
				else if($pageid == 3)//product
					$page_type_id = 4;
				else if($pageid == 4)//contact
					$page_type_id = 3;
					?>
				<form method="POST" role="form" id="frmAdd"> 
				<?php
				
				if(isset($pagevalues))
				{
					//print_r($pagevalues);exit;
				?>
					<div class="form-group"> <label  class="">Title</label>
					<input type="text" name="pagetitle" placeholder="Site Title" class="form-control" value="<?php echo $pagevalues[0]->title; ?>">  <div class="err"><?php echo form_error('pagetitle'); ?></div> </div> 
					
					<div class="form-group"> <label  class="">Slug</label>
					<input type="text" name="slug" placeholder="Slug" class="form-control" value="<?php echo $pagevalues[0]->slug; ?>">  <div class="err"><?php echo form_error('slug'); ?></div> </div> 
					
					<div class="form-group"> <label  class="">Meta Title</label>
					<input type="text" name="metatitle" placeholder="Meta Title" class="form-control" value="<?php echo $pagevalues[0]->meta_title; ?>">  <div class="err"><?php echo form_error('metatitle'); ?></div> </div> 
					
					<div class="form-group"> <label  class="">Meta Tag</label>
					<input type="text" name="metatag" placeholder="Meta Tag" class="form-control" value="<?php echo $pagevalues[0]->meta_keywords; ?>">  <div class="err"><?php echo form_error('metatag'); ?></div> </div> 
					
					
					<div class="form-group"> <label  class="">Meta Description</label>
					<textarea name="metadesc" placeholder="Meta Description" class="form-control" value=""><?php echo $pagevalues[0]->meta_description; ?></textarea>   <div class="err">
					<?php echo form_error('metadesc'); ?></div></div> 
					<input type="hidden" name="page_type_id" id="page_type_id" value="<?php echo $page_type_id;?>"></input>
					
					<div class="form-group" style="display:none;"> <label  class="">Page Type</label> </div> 
					<div class="form-group" style="display:none;">  <select name="pagetype" class="select" >  
						   
					<?php if(count($pagetypearry)): foreach($pagetypearry as $pagetypeval): ?>	
					 <option value="<?php echo $pagetypeval->id;?>"><?php echo $pagetypeval->name;?></option>
					<?php endforeach; ?>
					<?php endif; ?>	
					</select>   </div> 
					<div class="form-group"> <label  class="">Body</label></div> 
					<div class="form-group">
					<textarea name="body_desc" class="richtext" id="body_desc" ><?php echo $pagevalues[0]->content; ?></textarea>
					</div>
					
					 
						  <!--  id="ajaxfilemanager"-->
					<div class="form-group">  <input type="submit" value="Update" class="btn btn-primary btnadd" id="btnadd" name="pageupdate" />  </div>   </div>
					</form>
					
				<?php
				}
				else
				{
				?>
					<div class="form-group"> <label  class="">Title</label>
					<input type="text" name="pagetitle" placeholder="Site Title" class="form-control" value="">  <div class="err"><?php echo form_error('pagetitle'); ?></div> </div> 
					
					<div class="form-group"> <label  class="">Slug</label>
					<input type="text" name="slug" placeholder="Slug" class="form-control" value="">  <div class="err"><?php echo form_error('slug'); ?></div> </div> 
					
					<div class="form-group"> <label  class="">Meta Title</label>
					<input type="text" name="metatitle" placeholder="Meta Title" class="form-control" value="">  <div class="err"><?php echo form_error('metatitle'); ?></div> </div> 
					
					<div class="form-group"> <label  class="">Meta Tag</label>
					<input type="text" name="metatag" placeholder="Meta Tag" class="form-control" value="">  <div class="err"><?php echo form_error('metatag'); ?></div> </div> 
					
					
					<div class="form-group"> <label  class="">Meta Description</label>
					<textarea name="metadesc" placeholder="Meta Description" class="form-control" value=""></textarea>   <div class="err">
					<?php echo form_error('metadesc'); ?></div></div> 
					<input type="hidden" name="page_type_id" id="page_type_id" value="<?php echo $page_type_id;?>"></input>
					
					<div class="form-group" style="display:none;"> <label  class="">Page Type</label> </div> 
					<div class="form-group" style="display:none;">  <select name="pagetype" class="select" >  
						   
					<?php if(count($pagetypearry)): foreach($pagetypearry as $pagetypeval): ?>	
					 <option value="<?php echo $pagetypeval->id;?>"><?php echo $pagetypeval->name;?></option>
					<?php endforeach; ?>
					<?php endif; ?>	
					</select>   </div> 
					<div class="form-group"> <label  class="">Body</label></div> 
					<div class="form-group">
					<textarea name="body_desc" class="richtext" id="body_desc" ></textarea>
					</div>
						  <!--  id="ajaxfilemanager"-->
					<div class="form-group">  <input type="submit" value="Save" class="btn btn-primary btnadd" id="btnadd" />  </div>   </div>
				<?php	
				}
				?>
				 
				
				     
			 
				</form>

			  </div>
            </div>
          
          </div>
        </div>
      </div>
    </div>

    <?php $this->load->view($default_model.'/admin/common/footer'); ?>