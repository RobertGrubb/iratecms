<?php
	//Load the Admin Header
	$data["title"] = "Forum Permissions";
	$this->load->view('globals/admin_header.php', $data);
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


	<form role="form" action="" method="post" enctype="multipart/form-data">

	<div class="panel panel-info">
            <div class="panel-heading">
                <div class="pull-left">
                	<?php echo $forum["title"]; ?>
                </div>
                <div class="pull-right">
                	<a href="<?php admin_url(); ?>forums/forums/" class="btn btn-sm btn-default">Back</a>
                </div>
                <div class="clearfix"></div>
            </div>

            <div class="panel-body">

                <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped">
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
                </table>
                </div>

            </div>
          </div>

          <div class="text-right">
          	<input type="hidden" name="update" value="true" />
            <button type="submit" class="btn btn-primary">Save</button>
        </div>

    </form>
<?php
	endforeach;
	//Load the Admin Footer
	$this->load->view('globals/admin_footer.php');
?>