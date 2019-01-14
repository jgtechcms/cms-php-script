		<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                
				<?php if(isset($site_settings->logo) and $site_settings->logo):?>
					<a href="<?php echo site_url($customer_admin['dashboard_url']);?>" class="navbar-brand" style="padding: 5px 0 0 15px;">
                    <img src="<?php echo site_url(config_item('customer_source_url'));?>/<?php echo $site_settings->logo;?>" alt="" id="nv-logo" style="max-height:40px;" />
                    </a>
				<?php else:?>
					<a href="<?php echo site_url($customer_admin['dashboard_url']);?>" class="navbar-brand"><?php echo $site_settings->site_title;?></a>
				<?php endif;?>
				
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                
                <li>
					<a href="http://jgtech.in/user-guide" target="_blank">User Guide</a>
				</li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> My Account <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="<?php echo site_url($customer_admin['dashboard_url']);?>/users/change-password"> Change Password</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('/');?>" target="_blank">Front End</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="<?php echo site_url($customer_admin['dashboard_url']);?>/users/logout"> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                
                    
                    <li class="<?php  if($current_page == 'dashboard/index'){ echo 'active'; }?>">
                        <a href="<?php echo site_url($customer_admin['dashboard_url'])?>" title="Dashboard"><span class="fa fa-dashboard"></span> Dashboard</a>                        
                    </li>
                    <li class="<?php  if(in_array($current_page, $template_url)){ echo 'active'; }?>">
                        <a href="<?php echo site_url($customer_admin['dashboard_url'].'/templates/')?>" title="Templates"><span class="fa fa-desktop"></span> Templates</a>                        
                    </li>
                     <?php
                    $in = '';
                    $collapsed = 'collapsed';
                    $area = "false";
                    if(in_array($current_page, $menus_url)) {
                        $in = ' in';
                        $collapsed = '';
                        $area = "true";
                    }
                    ?>	
                    <li class="<?php  if(in_array($current_page, $menus_url)){ echo 'active'; }?>">                            
                        <a href="javascript:;" data-toggle="collapse" data-target="#menu_s"><span class="fa fa-file"></span> <span class="xn-text">Menu Management</span> <span class="caret"></span></a>
                        
                        <ul id="menu_s" class="dropdown-collapse collapse<?php echo $in;?>">    
                                    <li class="<?php  if($current_page=='menu/index'){ echo 'active'; }?>"><a href="<?php echo site_url($customer_admin['dashboard_url'].'/menu/')?>"> Menu Lists</a></li>                             
                                    <li class="<?php  if($current_page=='menu/add'){ echo 'active'; }?>"><a href="<?php echo site_url($customer_admin['dashboard_url'].'/menu/add')?>"> Add Menu</a></li>
                                </ul>
                        
                    </li><?php
                    $in = '';
                    $collapsed = 'collapsed';
                    $area = "false";
                    if(in_array($current_page, $pages_url)) {
                        $in = ' in';
                        $collapsed = '';
                        $area = "true";
                    }
                    ?>	
                    <li class="<?php  if(in_array($current_page, $pages_url)){ echo 'active'; }?>">                            
                        <a href="javascript:;" data-toggle="collapse" data-target="#pages_s"><span class="fa fa-files-o"></span> <span class="xn-text">Content Management</span> <span class="caret"></span></a>
                        
                        <ul id="pages_s" class="dropdown-collapse collapse<?php echo $in;?>">    
                                    <li class="<?php  if($current_page=='pages/index'){ echo 'active'; }?>"><a href="<?php echo site_url($customer_admin['dashboard_url'].'/pages/')?>"> Page Contents </a></li>                             
                                    <li class="<?php  if($current_page=='pages/add'){ echo 'active'; }?>"><a href="<?php echo site_url($customer_admin['dashboard_url'].'/pages/add')?>"> Add Page Content</a></li>
                                </ul>
                        
                    </li>
                     <?php
                    $in = '';
                    $collapsed = 'collapsed';
                    $area = "false";
                    if(in_array($current_page, $widgets_url)) {
                        $in = ' in';
                        $collapsed = '';
                        $area = "true";
                    }
                    ?>	
                     <li class="<?php  if(in_array($current_page, $widgets_url)){ echo 'active'; }?>">
                        <a href="javascript:;" data-toggle="collapse" data-target="#dropdown-4"><span class="fa fa-thumb-tack"></span> <span class="xn-text">Widget Management</span> <span class="caret"></span></a>
                        
                        <ul id="dropdown-4" class="dropdown-collapse collapse<?php echo $in;?>">    
                                    <li class="<?php  if($current_page=='widgets/index'){ echo 'active'; }?>"><a href="<?php echo site_url($customer_admin['dashboard_url'].'/widgets/')?>"> Widget Lists</a></li>                             
                                    <li class="<?php  if($current_page=='widgets/create'){ echo 'active'; }?>"><a href="<?php echo site_url($customer_admin['dashboard_url'].'/widgets/create')?>"> Add Widget</a></li>
                                </ul>
                    </li>
                     <?php
                    $in = '';
                    $collapsed = 'collapsed';
                    $area = "false";
                    if(in_array($current_page, $slider_url)) {
                        $in = ' in';
                        $collapsed = '';
                        $area = "true";
                    }
                    ?>	
                     <li class="<?php  if(in_array($current_page, $slider_url)){ echo 'active'; }?>">
                        <a href="javascript:;" data-toggle="collapse" data-target="#slider_s"><span class="fa fa-navicon"></span> <span class="xn-text">Slider Management</span> <span class="caret"></span></a>
                        
                        <ul id="slider_s" class="dropdown-collapse collapse<?php echo $in;?>">    
                                    <li class="<?php  if($current_page=='media/index'){ echo 'active'; }?>"><a href="<?php echo site_url($customer_admin['dashboard_url'].'/media/')?>"> Slider Lists</a></li>                             
                                    <li class="<?php  if($current_page=='media/add_banner'){ echo 'active'; }?>"><a href="<?php echo site_url($customer_admin['dashboard_url'].'/media/add_banner')?>"> Add Slider Image</a></li>
                                </ul>
                    </li>
                    
                    <?php
                    $in = '';
                    $collapsed = 'collapsed';
                    $area = "false";
                    if(in_array($current_page, $site_settings_url)) {
                        $in = ' in';
                        $collapsed = '';
                        $area = "true";
                    }
                    ?>								
                    <li class="<?php  if(in_array($current_page, $site_settings_url)){ echo 'active'; }?>">
                        <a href="javascript:;" data-toggle="collapse" data-target="#dropdown-1" title="Site Settings" class="<?php echo $collapsed;?>" aria-expanded="<?php echo $area;?>"><span class="fa fa-cog"></span> Site Settings</span> <span class="caret"></span></a>
                        <ul id="dropdown-1" class="dropdown-collapse collapse<?php echo $in;?>">
                                    <li class="<?php  if($current_page == 'site_settings/index'){ echo 'active'; }?>">
                                        <a href="<?php echo site_url($customer_admin['dashboard_url'].'/site_settings/')?>" title="General">
                                        <span class="fa fa-send"></span> General</a>
                                    </li>	
                                    <li class="<?php  if($current_page == 'site_settings/email'){ echo 'active'; }?>">
                                        <a href="<?php echo site_url($customer_admin['dashboard_url'].'/site_settings/email')?>" title="General">
                                        <span class="fa fa-send"></span> E-mail</a>
                                    </li>
                                </ul>		
                    </li>
                    <li class="<?php  if($current_page=='social_media/index'){ echo 'active'; }?>">
                        <a href="<?php echo site_url($customer_admin['dashboard_url'].'/social_media/')?>" title="Social Media"><span class="fa fa-globe"></span> Social Media</span> </a>
                        
                    </li>
                    <li class="<?php  if($current_page=='enquiry/index'){ echo 'active'; }?>">
                        <a href="<?php echo site_url($customer_admin['dashboard_url'].'/enquiry/')?>" title="Enquiry">
                        <span class="fa fa-envelope"></span> Contact Us Report</span> </a>
                        
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>



