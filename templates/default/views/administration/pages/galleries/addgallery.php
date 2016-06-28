<?php
	//Load the Admin Header
	$data["title"] = "Add Gallery";
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
				<td class="left" valign="top">Desc</td>
				<td>
					<input type="text" name="desc" class="glob-input" />
				</td>
			</tr>
            <tr>
				<td class="left" valign="top">Images</td>
				<td>
					<input type="file" name="userfile[]" multiple="multiple" />
                    <i>You may select multiple images. GIF|PNG|JPEG</i>
				</td>
			</tr>
			<tr>
				<td class="left" valign="top"></td>
				<td>
					<input type="submit" value="Add Gallery" class="glob-button" />
				</td>
			</tr>
		</table>
	</form>
<?php
	//Load the Admin Footer
	$this->load->view('administration/globals/admin_footer.php');
?>