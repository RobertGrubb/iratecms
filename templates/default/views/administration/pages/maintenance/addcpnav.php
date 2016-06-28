<?php
	//Load the Admin Header
	$data["title"] = "Add CP Navigation Section";
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
				<td class="left">Title</td>
				<td><input type="text" class="glob-input" name="title" /></td>
			</tr>
            <tr>
				<td class="left">Permission</td>
				<td><input type="text" class="glob-input" name="perms" /><br />
                    <i>Use the Permisison call name (Ex: can_admin_navigation).</i></td>
			</tr>
			<tr>
				<td class="left"></td>
				<td>
					<input type="submit" value="Add Section" class="glob-button" />
				</td>
			</tr>
		</table>
	</form>
<?php
	//Load the Admin Footer
	$this->load->view('administration/globals/admin_footer.php');
?>