<?php $this->load->view($selected_template_path.'/'.$user_template.'/header'); ?>

<div class="container" style="min-height:400px;">
	<div class="row">
		<div class="col-sm-12">
			<h2>Dear Member</h2>
			<span>Your payment was successful, thank you for purchase.</span><br/><br/>
			<span>Order Number : 
				<strong><?php echo $order_number; ?></strong>
			</span><br/>
			<span>TXN ID : 
				<strong><?php echo $txn_id; ?></strong>
			</span><br/>
			<span>Amount Paid : 
				<strong><?php echo $payment_amt.' '.$currency_code; ?></strong>
			</span><br/>
			<span>Payment Status : 
				<strong><?php echo $status; ?></strong>
			</span><br/>
		</div>
	</div>
</div>

<?php $this->load->view($selected_template_path.'/'.$user_template.'/footer'); ?>