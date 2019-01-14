<style>
.list-group-item span:first-child{
	width: 150px;
	display: inline-block;
}
.list-group-item span:last-child{
}
.placeholders a:hover {color:#fff; text-decoration:none;}
</style>
<link rel="stylesheet" href="<?php echo site_url(ASSET);?>/admin/css/dashboard.css" />
	
	<div class="content-frame">                                    
	<div class="row">
		<?php $this->load->view($selected_template_path.'/components/breadcrumb'); ?>
		</div>
			
			<div class="content-frame-body menu">                     
				<div class="panel panel-default">
									
					<div class="panel-body">  
						
						<div class="row">              
                          <!-- pie -->
						  <div class="col-lg-12">
							  <section class="panel">
                                  <header class="panel-heading">
                                      <h3>Recent Enquiries</h3>
                                  </header>
                                  <div class="panel-body text-center">
                                    <table class="table table-striped table-bordered">
                                        <tr>
                                            <th style="text-align:center;">Date</th>
                                            <th style="text-align:center;">Name</th>
                                            <th style="text-align:center;">Email</th>
                                            <th style="text-align:center;">Phone</th>
                                            <th style="text-align:center;">Subject</th>
                                            <th style="text-align:center;">Message</th>
                                        </tr>
										<?php foreach($contacts as $contact):?>
                                        <tr>
                                          <td><?php echo date('j', strtotime($contact->created));?> <?php echo date('M', strtotime($contact->created)), ' ', date('Y', strtotime($contact->created));?> </td>
                                          <td><?php echo $contact->name;?></td>
                                          <td><?php echo $contact->email;?></td>
                                          <td><?php echo $contact->phone;?></td>
                                          <td><?php echo $contact->subject;?></td>
											<td><?php echo $contact->message;?></td>
                                        </tr>
                                        <?php endforeach;?>
                                      
                                  </div>
                              </section>
                          </div>   
                      </div>
					  
					  
					  
					</div>
				</div>
			</div>
			
		</div>
		<!-- END CONTENT FRAME -->
<?php //$this->load->view($selected_template_path.'/common/script');?>
<?php //$this->load->view($selected_template_path.'/dashboard/graph'); ?>