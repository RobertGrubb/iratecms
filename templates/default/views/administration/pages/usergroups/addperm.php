<?php
	//Load the Admin Header
	$data["title"] = "Adding Permission";
	$this->load->view('administration/globals/admin_header.php', $data);
?>
	<div class="errors">
		<?php echo validation_errors(); ?>
	</div>
	<form action="" method="post">
		<table class="glob-table">
			<tr>
				<td class="left">Title</td>
				<td><input type="text" class="glob-input" name="title" /></td>
			</tr>
            <tr>
				<td class="left">Call Name</td>
				<td><input type="text" class="glob-input" name="perm" /><br /><i>No spaces, use underscores. (Ex. can_admin_settings)</i></td>
			</tr>
			<tr>
				<td class="left"></td>
				<td>
					<input type="submit" value="Add Permission" class="glob-button" />
				</td>
			</tr>
		</table>
	</form>
<?php
	//Load the Admin Footer
	$this->load->view('administration/globals/admin_footer.php');
?>