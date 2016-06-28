<?php
	//Load the Admin Header
	$data["title"] = "Usergroup Administration";
	$this->load->view('administration/globals/admin_header.php', $data);
?>
    <script>
    $(function() {
        $( "#sortable" ).sortable({
        	cursor: 'move',
	        update: function () {          
	            serial = $(this).sortable('toArray');
                $.ajax({
                    url: "<?php admin_url(); ?>usergroups/groupOrder/",
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
            <div class="align-right"><a href="<?php admin_url(); ?>usergroups/addusergroup/" class="glob-button">New Usergroup</a></div>
        </div>
        <br clear="all" />
    </div>
    <br />
	<ul class="glob-sortable" id="sortable">
		<?php foreach($usergroups as $usergroup): ?>
			<li class="ui-state-default" id="<?php echo $usergroup["id"]; ?>">
				<div class="align-left">
					<?php if($usergroup["static"]): ?>
                    <b>Static: </b>
			        <?php endif; ?>
			        <span style="color: <?php echo $usergroup["color"]; ?>;font-weight: bold;"><?php echo $usergroup["title"]; ?></span>
				</div>
				<div class="glob-button-holder">
                    <?php if($this->acl->perm('can_admin_permissions')): ?>
                    <a href="<?php admin_url(); ?>usergroups/permissions/<?php echo $usergroup["id"]; ?>" class="glob-button">Permissions</a>
    				<?php endif; ?>
                    <a href="<?php admin_url(); ?>usergroups/editusergroup/<?php echo $usergroup["id"]; ?>" class="glob-button">Edit</a>
    				<?php if(!$usergroup["static"]): ?>
    				<a href="#" onclick="Fury.Admin.ConfirmDelete('<?php admin_url(); ?>usergroups/deleteusergroup/<?php echo $usergroup["id"]; ?>');" class="glob-button">Delete</a>
    				<?php endif; ?>
				</div>
				<br clear="all" />
			</li>
		<?php endforeach; ?>
	</ul>

<?php
	//Load the Admin Footer
	$this->load->view('administration/globals/admin_footer.php');
?>