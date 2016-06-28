<?php
	//Load the Admin Header
	$data["title"] = "Store Configuration";
	$this->load->view('administration/globals/admin_header.php', $data);
?>
	<div class="errors">
		<?php echo validation_errors(); ?>
		<?php
			if(!empty($error) && $error != null)
				echo "<p>" . $error . "</p>";
		?>
	</div>
	<div class="msg">
		<?php
			if(!empty($msg) && $msg != null)
				echo "<p>" . $msg . "</p>";
		?>
	</div>
	<form action="" method="post">
		<table class="glob-table">
			<tr>
				<td class="left" valign="top">Payment Gateway</td>
				<td>
					<select name="payment_gateway" class="glob-select">
						<option value="paypal">Paypal Express</option>
					</select>
				</td>
			</tr>
			<tr>
				<td class="left" valign="top">Gateway API Username</td>
				<td>
                    <input type="text" name="paypal_api_username" class="glob-input" value="<?php echo $paypal_api_username; ?>" />
				</td>
			</tr>
			<tr>
				<td class="left" valign="top">Gateway API Password</td>
				<td>
                    <input type="text" name="paypal_api_password" class="glob-input" value="<?php echo $paypal_api_password; ?>" />
				</td>
			</tr>
			<tr>
				<td class="left" valign="top">Gateway API Signature</td>
				<td>
                    <input type="text" name="paypal_api_signature" class="glob-input" value="<?php echo $paypal_api_signature; ?>" />
				</td>
			</tr>
			<tr>
				<td class="left" valign="top">Test Mode</td>
				<td>
					<select name="test_mode" class="glob-select">
						<option value="1" <?php if($test_mode): ?>selected="selected"<?php endif; ?>>Enabled</option>
						<option value="0" <?php if(!$test_mode): ?>selected="selected"<?php endif; ?>>Disabled</option>
					</select>
				</td>
			</tr>
			<tr>
				<td class="left" valign="top"></td>
				<td>
					<input type="submit" value="Save Store Configuration" class="glob-button" />
				</td>
			</tr>
		</table>
	</form>
<?php
	//Load the Admin Footer
	$this->load->view('administration/globals/admin_footer.php');
?>