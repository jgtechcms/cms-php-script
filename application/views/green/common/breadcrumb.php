		<?php
		if($page) {
			
			$page_title = $page->title;
			
		}
		?>
		<div class="container" id="breadcrum">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mt-20">
					<ol class="breadcrumb">
                        <li><a href="<?php echo site_url();?>">Home</a></li>
                        <?php 
						$cnt = count($breadcrumb_lists);
						$i = 1;
						foreach($breadcrumb_lists as $menu):
								$url = site_url().$customer_url_base.$menu->slug;
								$target = '';
								if(isset($menu->external_url) and $menu->external_url != '') {
									
									$target = ' target="_blank"';
									
									if(strpos($menu->external_url, 'http://') !== false)
										$url = $menu->external_url;
									else if(strpos($menu->external_url, 'https://') !== false)
										$url = $menu->external_url;
									else
										$url = 'http://' . $menu->external_url;
								}
								if(isset($menu->has_no_link) and $menu->has_no_link)
									$url = 'javascript:void(0);';
						?>							
							<?php if($i != $cnt):?>
								<li><a href="<?php echo $url;?>"> &nbsp;<?php echo $menu->title;?>&nbsp;</a></li>
							<?php else:?>
								<li class="active"><?php echo $menu->title;?></li>
							<?php endif;?>
						<?php 
							$i++;
						endforeach;?>
                    </ol>                     
				</div>
                
                <?php if(isset($page_title) and $page_title):?>
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<h1 class="page-title text-center">
						<?php echo $page_title;?>
					</h1>
				</div>
                <?php endif;?>
			</div>
		</div>
		
		