<?php
	//Load the Admin Header
	$data["title"] = "Edit Blog Post";
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
            Edit Entry
          </div>

          <div class="panel-body">

          	<div class="form-group">
                <label>Title</label>
                <input type="text" name="title" value="<?php echo $b["title"]; ?>" class="form-control" />
            </div>

            <hr />

            <div class="form-group">
                <label>Short Description</label>
                <input type="text" name="short_desc" value="<?php echo $b["short_desc"]; ?>" class="form-control" />
            </div>

            <hr />

            <div class="form-group">
                <label>Cover Image</label>
                <?php if(!empty($b['image'])): ?>
                    <br /><img src="<?php echo url(); ?>uploads/blogs/<?php echo $b['image']; ?>" style="width:120px;max-width:120px;" /><br />
                <?php else: ?>
                    
                <?php endif; ?>
                <input type="file" name="userfile" class="form-control" />
            </div>

            <hr />

            <div class="form-group">
                <label>Content</label>
                <textarea name="content" class="form-control" value="<?php echo $b["content"]; ?>" style="height:500px;"></textarea>
            </div>

            <hr />
           </div>
          </div>
          <div class="text-right">
            <button type="submit" class="btn btn-primary">Save Entry</button>
        </div>
	</form>
<?php
	//Load the Admin Footer
	$this->load->view('globals/admin_footer.php');
?>