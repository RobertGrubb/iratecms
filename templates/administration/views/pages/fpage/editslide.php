<?php
	//Load the Admin Header
	$data["title"] = "Editing Slide";
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
            Update Slide
          </div>

          <div class="panel-body">

          	<div class="form-group">
                <label>Title</label>
                <input type="text" name="title" class="form-control" value="<?php echo $slide["title"]; ?>" />
            </div>

            <hr />


            <div class="form-group">
                <label>Description</label>
                <input type="text" name="desc" class="form-control" value="<?php echo $slide["desc"]; ?>" />
                <p class="help-block">BBCode is allowed.</p>
            </div>

            <hr />

            <div class="form-group">
                <label>Image</label>
                <img src="<?php url(); ?>uploads/slides/<?php echo $slide["image"]; ?>" width="500" />
            </div>

            <hr />
           </div>
          </div>
          <div class="text-right">
            <button type="submit" class="btn btn-primary">Update Slide</button>
        </div>
	</form>
<?php
	//Load the Admin Footer
	$this->load->view('globals/admin_footer.php');
?>