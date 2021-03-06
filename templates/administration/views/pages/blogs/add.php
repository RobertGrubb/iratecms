<?php
	//Load the Admin Header
	$data["title"] = "Add Blog Post";
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
            New Blog Post
          </div>

          <div class="panel-body">

          	<div class="form-group">
                <label>Title</label>
                <input type="text" name="title" class="form-control" />
            </div>

            <hr />

            <div class="form-group">
                <label>Short Description</label>
                <input type="text" name="short_desc" class="form-control" />
            </div>

            <hr />

            <div class="form-group">
                <label>Cover Image</label>
                <input type="file" name="userfile" class="form-control" />
            </div>

            <hr />

            <div class="form-group">
                <label>Content</label>
                <textarea name="content" class="form-control" style="height:500px;"></textarea>
            </div>

            <hr />
           </div>
          </div>
          <div class="text-right">
            <button type="submit" class="btn btn-primary">Post Entry</button>
        </div>
	</form>
<?php
	//Load the Admin Footer
	$this->load->view('globals/admin_footer.php');
?>