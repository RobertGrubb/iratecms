<?php
	//Load the Admin Header
	$data["title"] = "Edit Blog Post";
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
				<td><input type="text" name="title" class="glob-input" value="<?php echo $b["title"]; ?>" /></td>
			</tr>
            <tr>
				<td class="left" valign="top">Short Description</td>
				<td><input type="text" name="short_desc" class="glob-input" value="<?php echo $b["short_desc"]; ?>" /></td>
			</tr>
            <tr>
				<td class="left" valign="top">Cover Image</td>
				<td>
                    <?php if(!empty($b['image'])): ?>
                        <img src="<?php echo url(); ?>uploads/blogs/<?php echo $b['image']; ?>" style="width:120px;max-width:120px;" /><br />
                    <?php else: ?>
                        This news article does not have a cover image.<br />
                    <?php endif; ?>
                    <input type="file" name="userfile" class="glob-input" />
                </td>
			</tr>
			<tr>
				<td class="left" valign="top">Content</td>
				<td>
                    <textarea id="reply-textarea" name="content" style="height:500px;width:100%;"><?php echo $b["content"]; ?></textarea>
				</td>
			</tr>
			<tr>
				<td class="left" valign="top"></td>
				<td>
					<input type="submit" value="Save Blog" class="glob-button" />
				</td>
			</tr>
		</table>
	</form>
<?php
	//Load the Admin Footer
	$this->load->view('administration/globals/admin_footer.php');
?>