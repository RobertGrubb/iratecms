<?php
	//Load the Admin Header
	$data["title"] = "Create Page";
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

	<form role="form" action="" method="post">

		<div class="panel panel-info">
          <div class="panel-heading">
            New Page
          </div>

          <div class="panel-body">

          	<div class="form-group">
                <label>Title</label>
                <input type="text" name="title" class="form-control" />
            </div>

            <hr />

            <div class="form-group">
                <label>Call Name</label>
                <input type="text" name="callname" class="form-control" />
                <p class="help-block">No spaces, only underscores. This is what you will use in the URL.</p>
            </div>

            <hr />

            <div class="form-group">
                <label>Content</label>
                <textarea name="content" class="form-control" style="height:500px;"></textarea>
            </div>

            <hr />

            <div class="form-group">
                <label>Template</label>
                <select name="template" class="form-control">
						<option value="full">Full Width</option>
						<option value="sidebars">Page with Sidebars</option>
					</select>
            </div>

            <hr />

            <div class="form-group">
                <label>Comments Enabled</label>
                <select name="comments" class="form-control">
						<option value="1">Yes</option>
						<option value="0">No</option>
					</select>
            </div>

            <hr />
           </div>
          </div>
          <div class="text-right">
            <button type="submit" class="btn btn-primary">Create Page</button>
        </div>
	</form>
<?php
	//Load the Admin Footer
	$this->load->view('globals/admin_footer.php');
?>