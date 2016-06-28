<?php
	//Load the Admin Header
	$data["title"] = "Editing Category";
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
	<?php foreach($category as $cat): ?>
	<form role="form" action="" method="post" enctype="multipart/form-data">

		<div class="panel panel-info">
          <div class="panel-heading">
            Save Category
          </div>

          <div class="panel-body">

          	<div class="form-group">
                <label>Title</label>
                <input type="text" name="title" class="form-control" value="<?php echo $cat["title"]; ?>" />
            </div>

            <hr />
           </div>
          </div>
          <div class="text-right">
            <button type="submit" class="btn btn-primary">Save Category</button>
        </div>
	</form>
	<?php endforeach; ?>
<?php
	//Load the Admin Footer
	$this->load->view('globals/admin_footer.php');
?>