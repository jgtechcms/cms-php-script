<?php if($widget_contents):?>
<div class="container">
	<?php 
    foreach($widget_contents as $content) {
    ?>		
		<?php $this->load->view($selected_template_path.'/'.$user_template.'/widgets/'.$content->slug, array('content' => $content));?>		
    
	<?php 
    }
    ?>
</div>
<?php endif;?>