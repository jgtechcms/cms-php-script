				<div class="row">
				<?php $this->load->view($selected_template_path.'/components/breadcrumb'); ?>
				</div> 
                        
                <div class="panel panel-default">
                    <?php /*<div class="panel-heading">
                       <h4 style="margin:0; padding:0;">View Enquiry Details</h4>
                    </div>*/?>
                    <div class="panel-body">
                        
                        <div class="row placeholders">
                            <div class="col-xs-12 col-sm-12 placeholder">
                              <div class="starter-template">
                                <?php
                                $error = $this->session->flashdata('error');
                                $success = $this->session->flashdata('success');
                                ?>
                                <?php if($error):?>
                                <div class="alert alert-danger"><?php echo $error;?></div>
                                <?php endif;?>
                                <?php if($success):?>
                                <div class="alert alert-success"><?php echo $success;?></div>
                                <?php endif;?>
                                
                                <form class="form-horizontal" method="post" action="">
                                 <label for="name" class="cols-sm-2 control-label">Current Password</label>
                                    <input type="password" class="form-control" name="cur_password" id="cur_password"  placeholder="Current Password" value="<?php echo set_value('cur_password'); ?>"/>
                                            <span style="color:#e04b4a;"><?php echo form_error('cur_password'); ?></span>
                                    <label for="name" class="cols-sm-2 control-label">New Password</label>
                                    <input type="password" class="form-control" name="new_password" id="new_password"  placeholder="New Password" value="<?php echo set_value('new_password'); ?>"/>
                                            <span style="color:#e04b4a;"><?php echo form_error('new_password'); ?></span>
                                    <label for="username" class="cols-sm-2 control-label">Confirm New Password</label>
                                    <input type="password" class="form-control" placeholder="Confirm Password" name="password" value="<?php echo set_value('password'); ?>" />
                                            <span style="color:#e04b4a;"><?php echo form_error('password'); ?></span>
                                    <br />	<br />
                                    <button type="submit" class="btn btn-primary" style="color:#fff;">Update</button>
                                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                </form>
                                

                              </div>
                            </div>
                          
                        </div>
                        
                    </div>

                  
                        
                    </div>
<?php $this->load->view($selected_template_path.'/common/script');?>                    