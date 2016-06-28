<?php
	//Load the Admin Header
	$data["title"] = "Frontpage Settings";
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
				<td class="left" valign="top">Featured Video</td>
				<td><input type="text" class="glob-input" name="featured_video" value="<?php echo $settings["featured_video"]; ?>" /></td>
			</tr>
            <tr>
				<td class="left" valign="top">Facebook Like Box</td>
				<td><input type="text" class="glob-input" name="facebook_url" value="<?php echo $settings["facebook_url"]; ?>" /><br />
                    <small><i>Please provide the <b>FULL</b> url to your facebook page.</i></small>
                </td>
			</tr>
			<tr>
				<td class="left" valign="top"></td>
				<td>
					<input type="submit" value="Save Settings" class="glob-button" />
				</td>
			</tr>
		</table>
	</form>
<?php
	//Load the Admin Footer
	$this->load->view('administration/globals/admin_footer.php');
?>