<?php
	//Load the Admin Header
	$data["title"] = "Edit Page";
	$this->load->view('administration/globals/admin_header.php', $data);
?>

    <div class="submit-bar">
		<div class="align-right">
			<div class="align-right"><a href="<?php url(); ?><?php echo $page["callname"]; ?>" target="_blank" class="glob-button">View Page</a></div>
		</div>
		<br clear="all" />
	</div>

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
				<td><input type="text" name="title" class="glob-input" value="<?php echo $page["title"]; ?>" /></td>
			</tr>
            <tr>
				<td class="left" valign="top">Call Name</td>
				<td><input type="text" name="callname" class="glob-input" value="<?php echo $page["callname"]; ?>" /><br />
                    <i>No spaces, only underscores. This is what you will use in the URL.</i></td>
			</tr>
			<tr>
				<td class="left" valign="top">Content</td>
				<td>
					<textarea name="content" class="glob-textarea" style="height:500px"><?php echo $page["content"]; ?></textarea>
				</td>
			</tr>
			<tr>
				<td class="left" valign="top">Template</td>
				<td>
					<select name="template" class="glob-input">
						<option value="full" <?php if($page['template'] == "full"): ?>selected="selected"<?php endif; ?>>Full Width</option>
						<option value="sidebars" <?php if($page['template'] == "sidebars"): ?>selected="selected"<?php endif; ?>>Page with Sidebars</option>
					</select>
				</td>
			</tr>
			<tr>
				<td class="left" valign="top">Comments Enabled</td>
				<td>
					<select name="comments" class="glob-input">
						<option value="1" <?php if($page['comments'] == "1"): ?>selected="selected"<?php endif; ?>>Yes</option>
						<option value="0" <?php if($page['comments'] == "0"): ?>selected="selected"<?php endif; ?>>No</option>
					</select>
				</td>
			</tr>
			<tr>
				<td class="left" valign="top"></td>
				<td>
					<input type="submit" value="Save Page" class="glob-button" />
				</td>
			</tr>
		</table>
	</form>
<?php
	//Load the Admin Footer
	$this->load->view('administration/globals/admin_footer.php');
?>