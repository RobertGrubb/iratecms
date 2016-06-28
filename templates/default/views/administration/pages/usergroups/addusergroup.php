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
	<form action="" method="post">
		<table class="glob-table">
			<tr>
				<td><input type="text" class="glob-input" name="title" placeholder="Usergroup Title" /></td>
			</tr>
            <tr>
				<td><input type="text" class="glob-input" name="color" placeholder="Usergroup Color (Include #)" /></td>
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
												<input type="radio" name="perm[<?php echo $p["perm"]; ?>]" value="true" /> Yes 
												<input type="radio" name="perm[<?php echo $p["perm"]; ?>]" value="false" checked="checked" /> No
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
						<input type="submit" class="glob-button" value="Add Usergroup" />
					</div>
				</td>
			</tr>
		</table>
	</form>
<?php
	//Load the Admin Footer
	$this->load->view('administration/globals/admin_footer.php');
?>