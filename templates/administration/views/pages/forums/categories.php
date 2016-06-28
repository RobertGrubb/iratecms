<?php
	//Load the Admin Header
	$data["title"] = "Category Administration";
	$this->load->view('globals/admin_header.php', $data);
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
	<div class="row">
      <div class="col-lg-12">
        <div class="text-right">
            <a href="<?php admin_url(); ?>forums/addcategory/" class="btn btn-md btn-primary">
                New Category
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
          You may drag each category up or down to change the order of listing on your site.    
        </div>
      </div>
    </div><!-- /.row -->



		<div class="row" style="padding:15px;" id="sortable">
			<?php foreach($categories as $cat): ?>
				<div class="col-lg-12 well" id="<?php echo $cat["id"]; ?>">
					<div class="pull-left">
						<?php echo $cat["title"]; ?>
					</div>
					<div class="pull-right">
                        <a href="<?php admin_url(); ?>forums/catperms/<?php echo $cat["id"]; ?>" class="btn btn-primary">Permissions</a>
						<a href="<?php admin_url(); ?>forums/editcategory/<?php echo $cat["id"]; ?>" class="btn btn-default">Edit</a>
						<a href="#" onclick="Fury.Admin.ConfirmDelete('<?php admin_url(); ?>forums/deletecat/<?php echo $cat["id"]; ?>');" class="btn btn-danger">Delete</a>
					</div>
					<br clear="all" />
				</div>
			<?php endforeach; ?>
		</div>
<?php
	//Load the Admin Footer
	$this->load->view('globals/admin_footer.php');
?>