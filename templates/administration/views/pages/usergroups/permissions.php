<?php
	//Load the Admin Header
	$data["title"] = "<b>[" . $group_title . "]</b> Permissions";
	$this->load->view('globals/admin_header.php', $data);
?>

	<div class="row">
      <div class="col-lg-12">
        <div class="text-right">
            <a href="<?php admin_url(); ?>usergroups/" class="btn btn-md btn-danger">
                Back
            </a>
        </div>

            <div class="clearfix"></div>
            <br />
      </div>
    </div><!-- /.row -->


	<form action="" method="post">

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
			</div>
		</div>
		</div>
			
	<?php endforeach; ?>

	<div class="text-right">
		<input type="hidden" name="update" value="true" />

            <button type="submit" class="btn btn-primary">Save</button>
        </div>


	</form>
<?php
	//Load the Admin Footer
	$this->load->view('globals/admin_footer.php');
?>