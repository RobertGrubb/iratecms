<?php
	//Load the Admin Header
	$data["title"] = "Forums Manager";
	$this->load->view('administration/globals/admin_header.php', $data);
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
	<table class="glob-table">
		<tr>
			<td>
				<div class="align-left"><?php echo $cat["title"]; ?></div>
				<div class="align-right"><a href="<?php admin_url(); ?>forums/addforum/<?php echo $cat["id"]; ?>" class="glob-button">Add Forum</a></div>
			</td>
		</tr>
		<tr>
			<td>
				<ul class="glob-sortable" id="cat-<?php echo $cat["id"]; ?>">
					<?php $count = 1; ?>
					<?php foreach($cat["forums"] as $forum): ?>
						<li class="ui-state-default" id="<?php echo $forum["id"]; ?>">
							<div class="align-left"><?php echo $forum["title"]; ?></div>
							<div class="align-right">
								<a href="<?php admin_url(); ?>forums/forumperms/<?php echo $forum["id"]; ?>" class="glob-button">Permissions</a>
								<a href="<?php admin_url(); ?>forums/editforum/<?php echo $forum["id"]; ?>" class="glob-button">Edit</a>
								<a href="#" onclick="Fury.Admin.ConfirmDelete('<?php admin_url(); ?>forums/deleteforum/<?php echo $forum["id"]; ?>');" class="glob-button">Delete</a>
							</div>
							<br clear="all" />
						</li>
					<?php $count++; ?>
					<?php endforeach; ?>
 				</ul>
			</td>
		</tr>
	</table>
	<?php endforeach; ?>
<?php
	//Load the Admin Footer
	$this->load->view('administration/globals/admin_footer.php');
?>