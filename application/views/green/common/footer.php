        <footer>
            <div class="footer" id="footer">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-2  col-md-2 col-sm-4 col-xs-12">
                            <?php if($footer_menu_1):?>
                            <h3> Site Links </h3>
                            <ul>
                                <?php foreach($footer_menu_1 as $menu):?>
                                <li><a href="<?php echo site_url().$customer_url_base;?><?php echo $menu->slug;?>"><?php echo $menu->title;?></a></li>
                                <?php endforeach;?>	
                            </ul>
                            <?php endif;?>
                        </div>
                        <div class="col-lg-2  col-md-2 col-sm-4 col-xs-12">
                            <?php if($footer_menu_2):?>
                            <h3> Site Links </h3>
                            <ul>
                                <?php foreach($footer_menu_2 as $menu):?>
                                <li><a href="<?php echo site_url().$customer_url_base;?><?php echo $menu->slug;?>"><?php echo $menu->title;?></a></li>
                                <?php endforeach;?>	
                            </ul>
                            <?php endif;?>
                        </div>
                        <div class="col-lg-2  col-md-2 col-sm-4 col-xs-12">
                            <?php if($footer_menu_3):?>
                            <h3> Site Links </h3>
                            <ul>
                                <?php foreach($footer_menu_3 as $menu):?>
                                <li><a href="<?php echo site_url().$customer_url_base;?><?php echo $menu->slug;?>"><?php echo $menu->title;?></a></li>
                                <?php endforeach;?>	
                            </ul>
                            <?php endif;?>
                        </div>
                        
                        <div class="clearfix visible-sm"></div>
                        
                        <div class="col-lg-3  col-md-3 col-sm-6 col-xs-12">
                            <?php if($site_address || $site_phone):?>
                            <h3> Contact Info </h3>
                            <ul>
                                <?php if($site_address):?>
                                	<li><?php echo $site_address;?></li>
                                <?php endif;?>
                                <?php if($site_phone):?>
                                	<li><?php echo $site_phone;?></li>
                                <?php endif;?>
                            </ul>
                            <?php endif;?>
                        </div>
                        
                        <div class="col-lg-3  col-md-3 col-sm-6 col-xs-12 ">
                            <h3> Folow Us </h3>
                            <?php if($social_medias):?>
                            <ul class="social">
                                <?php 
                                foreach($social_medias as $social_media): 
                                ?>
                                 <li><a href="<?php echo $social_media->url;?>" target="_blank"><i class="fa <?php echo $social_media->icon;?> icon2x text-white" aria-hidden="true"></i></a> </li>
                                <?php endforeach;?> 
                            </ul>
                            <?php endif;?>
                        </div>
                    </div>
                    <!--/.row--> 
                </div>
                <!--/.container--> 
            </div>
            <!--/.footer-->
            
            <div class="footer-bottom">
                <div class="container">
                    <p class=""> Developed by <a href="http://jgtech.in" target="_blank">JG Technologies</a></p>
                    
                </div>
            </div>
            <!--/.footer-bottom--> 
        </footer>
        
		
		<?php $this->load->view($selected_template_path.'/'.$user_template.'/common/script');?>
		
	</body>
</html>