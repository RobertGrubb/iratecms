<?php
	//Load the Admin Header
	$data["title"] = "Add Slide";
	$this->load->view('globals/admin_header.php', $data);
?>
	<div class="errors">
		<?php echo validation_errors(); ?>
		<?php
			if(!empty($error) && $error != null)
				echo "<p>" . $error . "</p>";
		?>
	</div>

	<form role="form" action="" method="post" enctype="multipart/form-data">

		<div class="panel panel-info">
          <div class="panel-heading">
            New Slide
          </div>

          <div class="panel-body">

          	<div class="form-group">
                <label>Title</label>
                <input type="text" name="title" class="form-control" />
            </div>

            <hr />


            <div class="form-group">
                <label>Description</label>
                <input type="text" name="desc" class="form-control" />
                <p class="help-block">BBCode is allowed.</p>
            </div>

            <hr />

            <div class="form-group">
                <label>Image</label>
                <input type="file" name="userfile" class="form-control" />
            </div>

            <hr />
           </div>
          </div>
          <div class="text-right">
            <button type="submit" class="btn btn-primary">Add Slide</button>
        </div>
	</form>
<?php
	//Load the Admin Footer
	$this->load->view('globals/admin_footer.php');
?>