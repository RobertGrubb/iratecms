<?php
	//Load the Admin Header
	$data["title"] = "Usergroup Administration";
	$this->load->view('globals/admin_header.php', $data);
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

    <div class="row">
      <div class="col-lg-12">
        <div class="text-right">
            <a href="<?php admin_url(); ?>usergroups/addusergroup/" class="btn btn-md btn-primary">
                New Usergroup
            </a>
        </div>

            <div class="clearfix"></div>
            <br />
      </div>
    </div><!-- /.row -->

    <div class="row">
      <div class="col-lg-12">
        <div class="alert alert-warning alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          You may drag each usergroup up or down to change the order of listing on your site.    
        </div>
      </div>
    </div><!-- /.row -->


	<div class="row" style="padding:15px;" id="sortable">
		<?php foreach($usergroups as $usergroup): ?>
            <div class="col-lg-12 well" id="<<?php echo $usergroup["id"]; ?>">
				<div class="pull-left">
					<?php if($usergroup["static"]): ?>
                    <b>Static: </b>
			        <?php endif; ?>
			        <span style="color: <?php echo $usergroup["color"]; ?>;font-weight: bold;"><?php echo $usergroup["title"]; ?></span>
				</div>
				<div class="pull-right">
                    <?php if($this->acl->perm('can_admin_permissions')): ?>
                    <a href="<?php admin_url(); ?>usergroups/permissions/<?php echo $usergroup["id"]; ?>" class="btn btn-primary">Permissions</a>
    				<?php endif; ?>
                    <a href="<?php admin_url(); ?>usergroups/editusergroup/<?php echo $usergroup["id"]; ?>" class="btn btn-default">Edit</a>
    				<?php if(!$usergroup["static"]): ?>
    				<a href="#" onclick="Fury.Admin.ConfirmDelete('<?php admin_url(); ?>usergroups/deleteusergroup/<?php echo $usergroup["id"]; ?>');" class="btn btn-danger">Delete</a>
    				<?php endif; ?>
				</div>
				<br clear="all" />
			</div>
		<?php endforeach; ?>
	</div>

<?php
	//Load the Admin Footer
	$this->load->view('globals/admin_footer.php');
?>