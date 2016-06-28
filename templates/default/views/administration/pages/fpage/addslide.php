<?php
	//Load the Admin Header
	$data["title"] = "Add Slide";
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
				<td class="left" valign="top">Description</td>
				<td><input type="text" name="desc" class="glob-input" /><br />
                    BBCode Allowed</td>
			</tr>
            <tr>
				<td class="left" valign="top">Image</td>
				<td><input type="file" name="userfile" /></td>
			</tr>
			<tr>
				<td class="left" valign="top"></td>
				<td>
					<input type="submit" value="Add Slide" class="glob-button" />
				</td>
			</tr>
		</table>
	</form>
<?php
	//Load the Admin Footer
	$this->load->view('administration/globals/admin_footer.php');
?>