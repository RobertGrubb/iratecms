<?php
	//Load the Admin Header
	$data["title"] = "Edit Platform";
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
	<form action="" method="post" enctype="multipart/form-data">
		<table class="glob-table">
			<tr>
				<td class="left" valign="top">Title</td>
				<td><input type="text" name="title" class="glob-input" value="<?php echo $plat["title"]; ?>" /></td>
			</tr>
			<tr>
				<td class="left" valign="top">Call Name</td>
				<td><input type="text" name="link-format" class="glob-input" value="<?php echo $plat["link-format"]; ?>" /><br />
					<small>Only dashes, all lowercase, no spaces or numbers</small></td>
			</tr>
			<tr>
				<td class="left" valign="top">Active</td>
				<td>
					<select name="active" class="glob-select">
						<option value="1" <?php if($plat["active"]): ?>selected="selected"<?php endif; ?>>Yes</option>
						<option value="0" <?php if(!$plat["active"]): ?>selected="selected"<?php endif; ?>>No</option>
					</select>
				</td>
			</tr>
			<tr>
				<td class="left" valign="top">Image</td>
				<td><img src="<?php url(); ?>display/image/<?php echo $plat["banner_img"]; ?>" /><br />
					<input type="file" name="banner_image" /></td>
			</tr>
			<tr>
				<td class="left" valign="top"></td>
				<td>
					<input type="submit" value="Edit Platform" class="glob-button" />
				</td>
			</tr>
		</table>
	</form>
<?php
	//Load the Admin Footer
	$this->load->view('administration/globals/admin_footer.php');
?>