<?php
	//Load the Admin Header
	$data["title"] = "Edit CP Navigation Link";
	$this->load->view('globals/admin_header.php', $data);
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
				<td class="left">Title</td>
				<td><input type="text" class="glob-input" value="<?php echo $link["title"]; ?>" name="title" /></td>
			</tr>
            <tr>
				<td class="left">Action</td>
				<td><input type="text" class="glob-input" value="<?php echo $link["action"]; ?>" name="action" /><br />
                    Page your linking to (Ex. settings). <b>Required</b></td>
			</tr>
            <tr>
				<td class="left">Sub Action</td>
				<td><input type="text" class="glob-input" value="<?php echo $link["sub_action"]; ?>" name="sub_action" /><br />
                    Page your linking to (Ex. edit). <b>Optional</b></td>
			</tr>
            <tr>
				<td class="left">Permission</td>
				<td><input type="text" class="glob-input" value="<?php echo $link["perms"]; ?>" name="perms" /><br />
                    <i>Use the Permisison call name (Ex: can_admin_navigation).</i></td>
			</tr>
			<tr>
				<td class="left"></td>
				<td>
					<input type="submit" value="Edit Link" class="glob-button" />
				</td>
			</tr>
		</table>
	</form>
<?php
	//Load the Admin Footer
	$this->load->view('globals/admin_footer.php');
?>