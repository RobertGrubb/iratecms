<?php
	//Load the Admin Header
	$data["title"] = "Add Forum";
	$this->load->view('globals/admin_header.php', $data);
?>
	
	<div class="errors">
		<?php echo validation_errors(); ?>
	</div>

	<form role="form" action="" method="post" enctype="multipart/form-data">

		<div class="panel panel-info">
          <div class="panel-heading">
            New Forum
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
            </div>

            <hr />
           </div>
          </div>
          <div class="text-right">
            <button type="submit" class="btn btn-primary">Add Forum</button>
        </div>
	</form>

<?php
	//Load the Admin Footer
	$this->load->view('globals/admin_footer.php');
?>