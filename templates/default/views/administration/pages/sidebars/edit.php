<?php
	//Load the Admin Header
	$data["title"] = "Edit Sidebar";
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
				<td><input type="text" name="title" class="glob-input" value="<?php echo $s["title"]; ?>" /></td>
			</tr>
			<tr>
				<td class="left" valign="top">Content</td>
				<td>
					<textarea name="content" class="glob-textarea" style="height:500px"><?php echo $s["content"]; ?></textarea>
				</td>
			</tr>
			<tr>
				<td class="left" valign="top">Enabled</td>
				<td>
					<select name="enabled">
						<option value="1" <?php if($s['enabled']): ?>selected="selected"<?php endif; ?>>Enabled</option>
						<option value="0" <?php if(!$s['enabled']): ?>selected="selected"<?php endif; ?>>Disabled</option>
					</select>
				</td>
			</tr>
			<tr>
				<td class="left" valign="top"></td>
				<td>
					<input type="submit" value="Save Sidebar" class="glob-button" />
				</td>
			</tr>
		</table>
	</form>
<?php
	//Load the Admin Footer
	$this->load->view('administration/globals/admin_footer.php');
?>