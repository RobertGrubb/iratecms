<?php
	//Load the Admin Header
	$data["title"] = "Add Video";
	$this->load->view('globals/admin_header.php', $data);
?>
	<div class="errors">
		<?php echo validation_errors(); ?>
		<?php
			if(!empty($error) && $error != null)
				echo "<p>" . $error . "</p>";
		?>
	</div>
	<form role="form" action="" method="post">

		<div class="panel panel-info">
          <div class="panel-heading">
            Add New Video
          </div>

          <div class="panel-body">

          	<div class="form-group">
                <label>Title</label>
                <input type="text" name="title" class="form-control" />
            </div>

            <hr />

            <div class="form-group">
                <label>Video ID</label>
                <input type="text" name="source" class="form-control" />
                <p class="help-block">Only supports <a href="http://www.youtube.com">YouTube</a> videos at this time.</p>
            </div>
           </div>
          </div>
          <div class="text-right">
            <button type="submit" class="btn btn-primary">Add Video</button>
        </div>
	</form>
<?php
	//Load the Admin Footer
	$this->load->view('globals/admin_footer.php');
?>