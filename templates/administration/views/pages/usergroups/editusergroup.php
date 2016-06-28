<?php
	//Load the Admin Header
	$data["title"] = "Add Usergroup";
	$this->load->view('globals/admin_header.php', $data);
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

	<form role="form" action="" method="post" enctype="multipart/form-data">

		<div class="panel panel-info">
          <div class="panel-heading">
            Edit Usergroup
          </div>

          <div class="panel-body">

          	<div class="form-group">
                <label>Title</label>
                <input type="text" name="title" value="<?php echo $usergroup["title"]; ?>" class="form-control" />
            </div>

            <hr />

            <div class="form-group">
                <label>Color</label>
                <input type="text" name="color" value="<?php echo $usergroup["color"]; ?>" class="form-control" />
                <p class="help-block">Include "#" in the color.</p>
            </div>

            <hr />

            <div class="form-group">
                <?php foreach($perms as $perm): ?>
				<div class="panel panel-primary">
		          <div class="panel-heading">
		            <?php echo $perm["title"]; ?>
		          </div>

		          <div class="panel-body">
						<div class="table-responsive">
                <table class="table table-bordered table-hover table-striped">
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
						</div>
					</div>
          		</div>
						
				<?php endforeach; ?>
            </div>

            <hr />
           </div>
          </div>
          <div class="text-right">
            <button type="submit" class="btn btn-primary">Update Usergroup</button>
        </div>
	</form>
<?php
	//Load the Admin Footer
	$this->load->view('globals/admin_footer.php');
?>