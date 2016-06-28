<?php
	//Load the Admin Header
	$data["title"] = "Frontpage Settings";
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
            Frontpage Settings
          </div>

          <div class="panel-body">

          	<div class="form-group">
                <label>Featured Video</label>
                <input type="text" name="featured_video" class="form-control" value="<?php echo $settings["featured_video"]; ?>" />
            </div>

            <hr />


            <div class="form-group">
                <label>Facebook URL</label>
                <input type="text" name="facebook_url" class="form-control" value="<?php echo $settings["facebook_url"]; ?>" />
                <p class="help-block">Please provide the <b>FULL</b> url to your facebook page.</p>
            </div>

            <hr />
           </div>
          </div>
          <div class="text-right">
            <button type="submit" class="btn btn-primary">Save Settings</button>
        </div>
	</form>
<?php
	//Load the Admin Footer
	$this->load->view('globals/admin_footer.php');
?>