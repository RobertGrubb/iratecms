<?php
	//Load the Admin Header
	$data["title"] = "Add Ladder";
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
				<td class="left" valign="top">Title</td>
				<td><input type="text" name="title" class="glob-input" value="<?php echo $ladder["title"]; ?>" /></td>
			</tr>
			<tr>
				<td class="left" valign="top">Call Name</td>
				<td><input type="text" name="callname" class="glob-input" value="<?php echo $ladder["callname"]; ?>" /><br />
					<small>Only dashes, all lowercase, no spaces or numbers</small></td>
			</tr>
			<tr>
				<td class="left" valign="top">Active</td>
				<td>
					<select name="active" class="glob-select">
						<option value="1" <?php if($ladder["active"]): ?>selected="selected"<?php endif; ?>>Yes</option>
						<option value="0" <?php if(!$ladder["active"]): ?>selected="selected"<?php endif; ?>>No</option>
					</select>
				</td>
			</tr>
			<tr>
				<td class="left" valign="top">Join Status</td>
				<td>
					<select name="status" class="glob-select">
						<option value="1" <?php if($ladder["status"]): ?>selected="selected"<?php endif; ?>>Yes</option>
						<option value="0" <?php if(!$ladder["status"]): ?>selected="selected"<?php endif; ?>>No</option>
					</select><br />
					<small>Determines whether teams can join this ladder or not.</small>
				</td>
			</tr>
			<tr>
				<td class="left" valign="top"></td>
				<td>
					<input type="submit" value="Add Ladder" class="glob-button" />
				</td>
			</tr>
		</table>
	</form>
<?php
	//Load the Admin Footer
	$this->load->view('administration/globals/admin_footer.php');
?>