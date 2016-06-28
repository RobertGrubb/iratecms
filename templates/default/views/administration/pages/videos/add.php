<?php
	//Load the Admin Header
	$data["title"] = "Add Video";
	$this->load->view('administration/globals/admin_header.php', $data);
?>
	<div class="errors">
		<?php echo validation_errors(); ?>
		<?php
			if(!empty($error) && $error != null)
				echo "<p>" . $error . "</p>";
		?>
	</div>
	<form action="" method="post">
		<table class="glob-table">
			<tr>
				<td class="left" valign="top">Title</td>
				<td><input type="text" name="title" class="glob-input" /></td>
			</tr>
			<tr>
				<td class="left" valign="top">Youtube Video ID</td>
				<td>
					<input type="text" name="source" class="glob-input" /><br />
					<small><i>Only supports youtube at this time.</i></small>
				</td>
			</tr>
			<tr>
				<td class="left" valign="top"></td>
				<td>
					<input type="submit" value="Add Video" class="glob-button" />
				</td>
			</tr>
		</table>
	</form>
<?php
	//Load the Admin Footer
	$this->load->view('administration/globals/admin_footer.php');
?>