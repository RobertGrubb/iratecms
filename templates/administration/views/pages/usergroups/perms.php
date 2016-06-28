<?php
	//Load the Admin Header
	$data["title"] = "Permissions Manager";
	$this->load->view('globals/admin_header.php', $data);
?>

    <div class="row">
      <div class="col-lg-12">
        <div class="text-right">
            <a href="<?php admin_url(); ?>usergroups/addpermsection/" class="btn btn-md btn-primary">
                Add Section
            </a>
        </div>

            <div class="clearfix"></div>
            <br />
      </div>
    </div><!-- /.row -->

    <div class="row">
      <div class="col-lg-12">
        <div class="alert alert-danger alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          Use caution when editing permissions. Some edits may cause you to not access parts of the site.    
        </div>
      </div>
    </div><!-- /.row -->
    
	<?php foreach($perms as $perm): ?>
				<div class="panel panel-info">
		          <div class="panel-heading">
		          	<div class="pull-left">
		            <?php echo $perm["title"]; ?>
		            </div>
		            <div class="pull-right">
	                    <a href="<?php admin_url(); ?>usergroups/addperm/<?php echo $perm["id"]; ?>" class="btn btn-sm btn-primary">Add Permission</a>
	                    <a href="<?php admin_url(); ?>usergroups/editpermsection/<?php echo $perm["id"]; ?>" class="btn btn-sm btn-default">Edit Section</a>
	                    <a href="#" onclick="Fury.Admin.ConfirmDelete('<?php admin_url(); ?>usergroups/deletepermsection/<?php echo $perm["id"]; ?>');" class="btn btn-sm btn-danger">Delete Section</a>
	                
		            </div>
		            <div class="clearfix"></div>
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
											<a href="<?php admin_url(); ?>usergroups/editperm/<?php echo $p["id"]; ?>" class="btn btn-sm btn-default">Edit</a>
			                                <a href="#" onclick="Fury.Admin.ConfirmDelete('<?php admin_url(); ?>usergroups/deleteperm/<?php echo $p["id"]; ?>');" class="btn btn-sm btn-danger">Delete</a>
										</td>
									</tr>
								<?php endforeach; ?>
							</table>
						</div>
					</div>
          		</div>
						
	<?php endforeach; ?>
<?php
	//Load the Admin Footer
	$this->load->view('globals/admin_footer.php');
?>