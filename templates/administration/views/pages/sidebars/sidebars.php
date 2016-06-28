<?php
	//Load the Admin Header
	$data["title"] = "Sidebars";
	$this->load->view('globals/admin_header.php', $data);
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

    <div class="row">
      <div class="col-lg-12">
        <div class="text-right">
            <a href="<?php admin_url(); ?>sidebars/add/" class="btn btn-md btn-primary">
                New Sidebar
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
          You may drag each sidebar up or down to change the order of listing on your site.    
        </div>
      </div>
    </div><!-- /.row -->

	<div class="row" style="padding:15px;" id="sortable">
		<?php foreach($sidebars as $sidebar): ?>
		<div class="col-lg-12 well" id="<?php echo $sidebar["id"]; ?>">
			<div class="pull-left">
				<b><?php echo $sidebar["title"]; ?></b>
			</div>
			<div class="pull-right">
                <a href="<?php admin_url(); ?>sidebars/edit/<?php echo $sidebar["id"]; ?>" class="btn btn-primary">Edit</a>
                <a href="#" onclick="Fury.Admin.ConfirmDelete('<?php admin_url(); ?>sidebars/delete/<?php echo $sidebar["id"]; ?>');" class="btn btn-danger">Delete</a>
            </div>
            <div class="clearfix"></div>
		</div>
		<?php endforeach; ?>
	</div>
<?php
	//Load the Admin Footer
	$this->load->view('globals/admin_footer.php');
?>