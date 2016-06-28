<?php
	//Load the Admin Header
	$data["title"] = "Ticket Category Management";
	$this->load->view('administration/globals/admin_header.php', $data);
?>

	<script>
    $(function() {
        $( "#sortable" ).sortable({
        	cursor: 'move',
	        update: function () {          
	            serial = $(this).sortable('toArray');
                $.ajax({
                    url: "<?php admin_url(); ?>tickets/catorder/",
                    type: "POST",
                    data: 'order='+serial,
                    error: function(){
                        alert("theres an error with AJAX");
                    }
                });
	        }
	    }); 
    });
    </script>
    <div class="msg">
		<?php
			if(!empty($msg) && $msg != null)
				echo "<p>" . $msg . "</p>";
		?>
	</div>
    <div class="submit-bar">
        <div class="align-right">
            <div class="align-right">
                <a href="<?php admin_url(); ?>tickets/addcat/" class="glob-button">New Category</a>
            </div>
        </div>
        <br clear="all" />
    </div>
    <br />
	<ul class="glob-sortable" id="sortable">
		<?php foreach($categories as $cat): ?>
			<li class="ui-state-default" id="<?php echo $cat["id"]; ?>">
				<div class="align-left">
					<?php echo $cat["title"]; ?>
				</div>
                <div class="align-right">
                    <a class="glob-button" href="<?php admin_url(); ?>tickets/editcat/<?php echo $cat["id"]; ?>">Edit</a>
                    <a href="#" onclick="Fury.Admin.ConfirmDelete('<?php admin_url(); ?>tickets/deletecat/<?php echo $cat["id"]; ?>');" class="glob-button">Delete</a>
                </div>
				<br clear="all" />
			</li>
		<?php endforeach; ?>
	</ul>

<?php
	//Load the Admin Footer
	$this->load->view('administration/globals/admin_footer.php');
?>