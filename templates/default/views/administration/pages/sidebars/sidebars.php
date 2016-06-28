<?php
	//Load the Admin Header
	$data["title"] = "Sidebars";
	$this->load->view('administration/globals/admin_header.php', $data);
?>
	<script>
    $(function() {
        $( "#sortable" ).sortable({
        	cursor: 'move',
	        update: function () {          
	            serial = $(this).sortable('toArray');
                $.ajax({
                    url: "<?php admin_url(); ?>sidebars/reorder/",
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
            <div class="align-right"><a href="<?php admin_url(); ?>sidebars/add/" class="glob-button">New Sidebar</a></div>
        </div>
        <br clear="all" />
    </div>
    <br />

	<ul class="glob-sortable" id="sortable">
		<?php foreach($sidebars as $sidebar): ?>
			<li class="ui-state-default" id="<?php echo $sidebar["id"]; ?>">
				<div class="align-left">
					<?php echo $sidebar["title"]; ?>
				</div>
				<div class="glob-button-holder">
                    <a href="<?php admin_url(); ?>sidebars/edit/<?php echo $sidebar["id"]; ?>" class="glob-button">Edit</a>
                    <a href="#" onclick="Fury.Admin.ConfirmDelete('<?php admin_url(); ?>sidebars/delete/<?php echo $sidebar["id"]; ?>');" class="glob-button">Delete</a>
                </div>
				<br clear="all" />
			</li>
		<?php endforeach; ?>
	</ul>
<?php
	//Load the Admin Footer
	$this->load->view('administration/globals/admin_footer.php');
?>