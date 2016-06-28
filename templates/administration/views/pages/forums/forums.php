<?php
	//Load the Admin Header
	$data["title"] = "Forums Manager";
	$this->load->view('globals/admin_header.php', $data);
?>
	<div class="errors">
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
	<?php foreach($categories as $cat): ?>
	<script>
    $(function() {
        $( "#cat-<?php echo $cat["id"]; ?>" ).sortable({
        	cursor: 'move',
	        update: function () {          
	            serial = $(this).sortable('toArray');
                $.ajax({
                    url: "<?php admin_url(); ?>forums/forumOrder/",
                    type: "POST",
                    data: 'catid=<?php echo $cat["id"]; ?>'+'&order='+serial,
                    error: function(){
                        alert("theres an error with AJAX");
                    }
                });
	        }
	    }); 
    });
    </script>
    <div class="table-responsive">
	<table class="table table-bordered table-hover">
		<tr>
			<td>
				<div class="pull-left"><h6><?php echo $cat["title"]; ?></h6></div>
				<div class="pull-right"><a href="<?php admin_url(); ?>forums/addforum/<?php echo $cat["id"]; ?>" class="btn btn-primary">Add Forum</a></div>
			</td>
		</tr>
		<tr>
			<td>
				<div class="row" style="padding:15px;" id="cat-<?php echo $cat["id"]; ?>">
					<?php $count = 1; ?>
					<?php foreach($cat["forums"] as $forum): ?>
						<div class="col-lg-12 well" id="<?php echo $forum["id"]; ?>">
							<div class="pull-left"><?php echo $forum["title"]; ?></div>
							<div class="pull-right">
								<a href="<?php admin_url(); ?>forums/forumperms/<?php echo $forum["id"]; ?>" class="btn btn-primary">Permissions</a>
								<a href="<?php admin_url(); ?>forums/editforum/<?php echo $forum["id"]; ?>" class="btn btn-default">Edit</a>
								<a href="#" onclick="Fury.Admin.ConfirmDelete('<?php admin_url(); ?>forums/deleteforum/<?php echo $forum["id"]; ?>');" class="btn btn-danger">Delete</a>
							</div>
							<br clear="all" />
						</div>
					<?php $count++; ?>
					<?php endforeach; ?>
 				</div>
			</td>
		</tr>
	</table>
	</div>
	<?php endforeach; ?>
<?php
	//Load the Admin Footer
	$this->load->view('globals/admin_footer.php');
?>