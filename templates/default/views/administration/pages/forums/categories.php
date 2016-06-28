<?php
	//Load the Admin Header
	$data["title"] = "Category Administration";
	$this->load->view('administration/globals/admin_header.php', $data);
?>
	<script>
    $(function() {
        $( "#sortable" ).sortable({
        	cursor: 'move',
	        update: function () {          
	            serial = $(this).sortable('toArray');
                $.ajax({
                    url: "<?php admin_url(); ?>forums/catOrder/",
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
    	<div class="submit-bar">
	        <div class="align-right">
	            <div class="align-right"><a href="<?php admin_url(); ?>forums/addcategory/" class="glob-button">New Category</a></div>
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
					<div class="glob-button-holder">
                        <a href="<?php admin_url(); ?>forums/catperms/<?php echo $cat["id"]; ?>" class="glob-button">Permissions</a>
						<a href="<?php admin_url(); ?>forums/editcategory/<?php echo $cat["id"]; ?>" class="glob-button">Edit</a>
						<a href="#" onclick="Fury.Admin.ConfirmDelete('<?php admin_url(); ?>forums/deletecat/<?php echo $cat["id"]; ?>');" class="glob-button">Delete</a>
					</div>
					<br clear="all" />
				</li>
			<?php endforeach; ?>
		</ul>
<?php
	//Load the Admin Footer
	$this->load->view('administration/globals/admin_footer.php');
?>