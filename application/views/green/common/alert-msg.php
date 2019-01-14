					<?php
					$danger_hidden_cls = ' hidden';
					$success_hidden_cls = ' hidden';
					$danger_msg = '';
					$success_msg = '';
					if(isset($error_message) and $error_message) {
						$danger_hidden_cls = '';
						$danger_msg = $error_message;
					}
					if(isset($success_message) and $success_message) {
						$success_hidden_cls = '';
						$success_msg = $success_message;
					}
					?>
					<div class="alert alert-danger<?php echo $danger_hidden_cls;?> alert_error">
						<a href="#" class="close"  data-hide="alert" aria-label="close">×</a>
						<p><?php echo $danger_msg;?></p>
					</div>
					<div class="alert alert-success<?php echo $success_hidden_cls;?> alert_success">
						<a href="#" class="close"  data-hide="alert" aria-label="close">×</a>
						<p><?php echo $success_msg;?></p>
					</div>