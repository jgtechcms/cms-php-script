			<?php if($content->section_title != ''):?>
        	<div class="row">	
                <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                    <h1 class="page-header text-center">
                       <?php echo $content->section_title;?>
                    </h1>
                </div>
            </div>
            <?php endif;?>
			
            <div class="row">
        	<?php if($content->content_layout == 'single_column'):?>
            	<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
            		<?php echo $content->single_column_content;?>
            	</div>
                
            <?php elseif($content->content_layout == 'two_column'):?>
				<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            		<?php echo $content->single_column_content;?>
                </div>                
                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            		<?php echo $content->two_column_content;?>
                </div>
                
			<?php elseif($content->content_layout == 'three_column'):?>
				<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
            		<?php echo $content->single_column_content;?>
                </div>
				<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
            		<?php echo $content->two_column_content;?>
                </div>
				<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
            		<?php echo $content->three_column_content;?>
                </div>
            <?php elseif($content->content_layout == 'four_column'):?>
				<div class="col-lg-3 col-sm-3 col-md-3 col-xs-6">
            		<?php echo $content->single_column_content;?>
                </div>
				<div class="col-lg-3 col-sm-3 col-md-3 col-xs-6">
            		<?php echo $content->two_column_content;?>
                </div>
				<div class="col-lg-3 col-sm-3 col-md-3 col-xs-6">
            		<?php echo $content->three_column_content;?>
                </div>
				<div class="col-lg-3 col-sm-3 col-md-3 col-xs-6">
            		<?php echo $content->four_column_content;?>
                </div>
			<?php endif;?>
			</div>