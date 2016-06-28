<?php
	//Load the Admin Header
	$data["title"] = "<b>[" . $group_title . "]</b> Permissions";
	$this->load->view('administration/globals/admin_header.php', $data);
?>
	<div class="submit-bar">
		<div class="align-right">
			<div class="align-right"><a href="<?php admin_url(); ?>usergroups/" class="glob-button">Back</a></div>
		</div>
		<br clear="all" />
	</div>
	<form action="" method="post">
	<?php foreach($perms as $perm): ?>
	<table class="glob-table">
		<tr>
			<td>
				<?php echo $perm["title"]; ?>
			</td>
		</tr>
		<tr>
			<td>
				<table class="glob-table inner-rows">
					<?php foreach($perm["permissions"] as $p): ?>
						<tr>
							<td class="left">
								<?php echo $p["title"]; ?>
							</td>
							<td align="right">
								<?php if($this->acl->perm($p["perm"], $groupid)): ?>
									<input type="radio" name="perm[<?php echo $p["perm"]; ?>]" value="true" checked="checked" /> Yes 
									<input type="radio" name="perm[<?php echo $p["perm"]; ?>]" value="false" /> No
								<?php else: ?>
									<input type="radio" name="perm[<?php echo $p["perm"]; ?>]" value="true" /> Yes 
									<input type="radio" name="perm[<?php echo $p["perm"]; ?>]" value="false" checked="checked" /> No
								<?php endif; ?>
							</td>
						</tr>
					<?php endforeach; ?>
				</table>
			</td>
		</tr>
	</table>
	<?php endforeach; ?>
	<div class="submit-bar">
		<div class="align-right">
			<input type="hidden" name="update" value="true" />
			<input type="submit" class="glob-button" name="save" value="Save" />
		</div>
		<br clear="all" />
	</div>
	</form>
<?php
	//Load the Admin Footer
	$this->load->view('administration/globals/admin_footer.php');
?>