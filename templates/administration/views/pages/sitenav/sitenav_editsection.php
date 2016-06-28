<?php
	//Load the Admin Header
	$data["title"] = "Edit Navigation Section";
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
            Edit Section
          </div>

          <div class="panel-body">

          	<div class="form-group">
                <label>Title</label>
                <input type="text" name="title" class="form-control" value="<?php echo $section["title"]; ?>" />
            </div>

            <hr />

            <div class="form-group">
                <label>URL</label>
                <input type="text" name="href" class="form-control" value="<?php echo $section["href"]; ?>" />
            </div>
           </div>
          </div>
          <div class="text-right">
            <button type="submit" class="btn btn-primary">Update Section</button>
        </div>
	</form>
<?php
	//Load the Admin Footer
	$this->load->view('globals/admin_footer.php');
?>