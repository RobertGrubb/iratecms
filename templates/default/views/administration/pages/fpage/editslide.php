<?php
	//Load the Admin Header
	$data["title"] = "Editing Slide";
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
				<td><input type="text" name="title" value="<?php echo $slide["title"]; ?>" class="glob-input" /></td>
			</tr>
            <tr>
				<td class="left" valign="top">Description</td>
				<td><input type="text" name="desc" value="<?php echo $slide["desc"]; ?>" class="glob-input" /><br />
                    BBCode Allowed</td>
			</tr>
            <tr>
				<td class="left" valign="top">Image</td>
				<td>
                    <img src="<?php url(); ?>uploads/slides/<?php echo $slide["image"]; ?>" width="500" />
                </td>
			</tr>
			<tr>
				<td class="left" valign="top"></td>
				<td>
					<input type="submit" value="Update Slide" class="glob-button" />
				</td>
			</tr>
		</table>
	</form>
<?php
	//Load the Admin Footer
	$this->load->view('administration/globals/admin_footer.php');
?>