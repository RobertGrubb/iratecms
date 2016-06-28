<?php
	//Load the Admin Header
	$data["title"] = "Add Site News";
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
				<td class="left" valign="top">Short Description</td>
				<td><input type="text" name="short_desc" class="glob-input" /></td>
			</tr>
            <tr>
				<td class="left" valign="top">Cover Image</td>
				<td><input type="file" name="userfile" class="glob-input" /></td>
			</tr>
			<tr>
				<td class="left" valign="top">Content</td>
				<td>
					<textarea name="content" class="glob-textarea" style="height:500px"></textarea>
				</td>
			</tr>
			<tr>
				<td class="left" valign="top"></td>
				<td>
					<input type="submit" value="Add Article" class="glob-button" />
				</td>
			</tr>
		</table>
	</form>
<?php
	//Load the Admin Footer
	$this->load->view('administration/globals/admin_footer.php');
?>