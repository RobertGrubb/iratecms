<?php
	//Load the Admin Header
	$data["title"] = "Add Usergroup";
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
				<td><input type="text" class="glob-input" name="title" value="<?php echo $usergroup["title"]; ?>" placeholder="Usergroup Title" /></td>
			</tr>
            <tr>
				<td><input type="text" class="glob-input" name="color" value="<?php echo $usergroup["color"]; ?>" placeholder="Usergroup Color (Include #)" /></td>
			</tr>
			<tr>
				<td>
					<?php foreach($perms as $perm): ?>
					<table class="glob-table">
						<tr>
							<td>
								<h3><?php echo $perm["title"]; ?></h3>
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
                                                <?php if($this->acl->perm($p["perm"], $usergroup["id"])): ?>
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
				</td>
			</tr>
			<tr>
				<td>
					<div class="align-right">
						<input type="submit" class="glob-button" value="Edit Usergroup" />
					</div>
				</td>
			</tr>
		</table>
	</form>
<?php
	//Load the Admin Footer
	$this->load->view('administration/globals/admin_footer.php');
?>