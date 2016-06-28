<?php
	//Load the Admin Header
	$data["title"] = "Edit Sidebar";
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
            New Sidebar
          </div>

          <div class="panel-body">

          	<div class="form-group">
                <label>Title</label>
                <input type="text" name="title" class="form-control" />
            </div>

            <hr />


            <div class="form-group">
                <label>Content</label>
                <textarea name="content" class="form-control" style="height:500px;"></textarea>
            </div>

            <hr />

            <div class="form-group">
                <label>Enabled</label>
                <select name="enabled" class="form-control">
					<option value="1">Enabled</option>
					<option value="0">Disabled</option>
				</select>
            </div>

            <hr />
           </div>
          </div>
          <div class="text-right">
            <button type="submit" class="btn btn-primary">Create Sidebar</button>
        </div>
	</form>
<?php
	//Load the Admin Footer
	$this->load->view('globals/admin_footer.php');
?>