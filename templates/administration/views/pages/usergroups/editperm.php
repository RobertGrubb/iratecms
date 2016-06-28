<?php
	//Load the Admin Header
	$data["title"] = "Editing Permission";
	$this->load->view('globals/admin_header.php', $data);
?>
	<div class="errors">
		<?php echo validation_errors(); ?>
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
            Edit Permission
          </div>

          <div class="panel-body">

          	<div class="form-group">
                <label>Title</label>
                <input type="text" name="title" value="<?php echo $perm_title; ?>" class="form-control" />
            </div>

            <hr />

            <div class="form-group">
                <label>Call Name</label>
                <input type="text" name="perm" value="<?php echo $perm_call; ?>" class="form-control" />
                <p class="help-block">No spaces, use underscores. (Ex. can_admin_settings)</p>
            </div>

            <hr />
           </div>
          </div>
          <div class="text-right">
            <button type="submit" class="btn btn-primary">Update Permission</button>
        </div>
	</form>
<?php
	//Load the Admin Footer
	$this->load->view('globals/admin_footer.php');
?>