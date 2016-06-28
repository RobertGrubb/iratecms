<?php
	//Load the Admin Header
	$data["title"] = "Add Arena";
	$this->load->view('administration/globals/admin_header.php', $data);
?>
	<div class="errors">
		<?php echo validation_errors(); ?>
		<?php
			if(!empty($error) && $error != null)
				echo "<p>" . $error . "</p>";
		?>
	</div>
	<form action="" method="post" enctype="multipart/form-data">
		<table class="glob-table">
			<tr>
				<td class="left" valign="top">Title</td>
				<td><input type="text" name="title" class="glob-input" /></td>
			</tr>
			<tr>
				<td class="left" valign="top">Call Name</td>
				<td><input type="text" name="callname" class="glob-input" /><br />
					<small>Only dashes, all lowercase, no spaces or numbers</small></td>
			</tr>
			<tr>
				<td class="left" valign="top">Active</td>
				<td>
					<select name="active" class="glob-select">
						<option value="1">Yes</option>
						<option value="0">No</option>
					</select>
				</td>
			</tr>
			<tr>
				<td class="left" valign="top">Join Status</td>
				<td>
					<select name="status" class="glob-select">
						<option value="1">Yes</option>
						<option value="0">No</option>
					</select><br />
					<small>Determines whether team join is closed or not.</small>
				</td>
			</tr>
			<tr>
				<td class="left" valign="top">Arena Avatar</td>
				<td><input type="file" name="avatar_img" /></td>
			</tr>
			<tr>
				<td class="left" valign="top"></td>
				<td>
					<input type="submit" value="Add Arena" class="glob-button" />
				</td>
			</tr>
		</table>
	</form>
<?php
	//Load the Admin Footer
	$this->load->view('administration/globals/admin_footer.php');
?>