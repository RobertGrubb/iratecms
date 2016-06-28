<?php
	//Load the Admin Header
	$data["title"] = "Create Page";
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
				<td><input type="text" name="title" class="glob-input" /></td>
			</tr>
            <tr>
				<td class="left" valign="top">Call Name</td>
				<td><input type="text" name="callname" class="glob-input" /><br />
                    <i>No spaces, only underscores. This is what you will use in the URL.</i></td>
			</tr>
			<tr>
				<td class="left" valign="top">Content</td>
				<td>
					<textarea name="content" class="glob-textarea" style="height:500px"></textarea>
				</td>
			</tr>
			<tr>
				<td class="left" valign="top">Template</td>
				<td>
					<select name="template">
						<option value="full">Full Width</option>
						<option value="sidebars">Page with Sidebars</option>
					</select>
				</td>
			</tr>
			<tr>
				<td class="left" valign="top">Comments Enabled</td>
				<td>
					<select name="comments" class="glob-input">
						<option value="1">Yes</option>
						<option value="0">No</option>
					</select>
				</td>
			</tr>
			<tr>
				<td class="left" valign="top"></td>
				<td>
					<input type="submit" value="Create Page" class="glob-button" />
				</td>
			</tr>
		</table>
	</form>
<?php
	//Load the Admin Footer
	$this->load->view('administration/globals/admin_footer.php');
?>