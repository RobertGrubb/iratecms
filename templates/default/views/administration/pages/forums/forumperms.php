<?php
	//Load the Admin Header
	$data["title"] = "Forum Permissions";
	$this->load->view('administration/globals/admin_header.php', $data);
	foreach($forums as $forum):
?>
	<div class="errors">
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
	<table class="glob-table">
		<tr>
			<td>
				<?php echo $forum["title"]; ?>
				<div class="align-right">
					<a href="<?php admin_url(); ?>forums/forums/" class="glob-button">Back</a>
				</div>
			</td>
		</tr>
		<tr>
			<td>
				<form action="" method="post">
				<table class="glob-table inner-rows">
					<?php foreach($usergroups as $usergroup): ?>
						<tr>
							<td>
								<?php echo $usergroup["title"]; ?>
							</td>
							<td align="right">
								<?php if($this->acl->access("forums", $forum["id"], $usergroup["id"])): ?>
									<input type="radio" name="groups[<?php echo $usergroup["id"]; ?>]" value="true" checked="checked" /> Yes 
									<input type="radio" name="groups[<?php echo $usergroup["id"]; ?>]" valie="false" /> No
								<?php else: ?>
									<input type="radio" name="groups[<?php echo $usergroup["id"]; ?>]" value="true" /> Yes 
									<input type="radio" name="groups[<?php echo $usergroup["id"]; ?>]" valie="false" checked="checked" /> No
								<?php endif; ?>
							</td>
						</tr>
					<?php endforeach; ?>
					<input type="hidden" name="update" value="true" />
				</table>
				<div class="submit-bar">
					<div class="align-right">
						<div class="align-right"><input type="submit" class="glob-button" name="save" value="Save" /></div>
					</div>
					<br clear="all" />
				</div>
				</form>
			</td>
		</tr>
	</table>
<?php
	endforeach;
	//Load the Admin Footer
	$this->load->view('administration/globals/admin_footer.php');
?>