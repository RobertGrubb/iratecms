<?php
	//Load the Admin Header
	$data["title"] = "Slider Management";
	$this->load->view('globals/admin_header.php', $data);
?>
    <script>
    $(function() {
        $( "#sortable" ).sortable({
        	cursor: 'move',
	        update: function () {          
	            serial = $(this).sortable('toArray');
                $.ajax({
                    url: "<?php admin_url(); ?>fpage/slideorder/",
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
            <a href="<?php admin_url(); ?>fpage/addslide/" class="btn btn-md btn-primary">
                Add Slide
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
          You may drag each slide up or down to change the order of listing on your site.    
        </div>
      </div>
    </div><!-- /.row -->


    <div class="row" style="padding:15px;" id="sortable">
		<?php foreach($slides as $slide): ?>
			<div class="col-lg-12 well" id="<?php echo $slide["id"]; ?>">
				<div class="pull-left">
					<?php echo $slide["title"]; ?>
				</div>
				<div class="pull-right">
                    <a href="<?php admin_url(); ?>fpage/editslide/<?php echo $slide["id"]; ?>" class="btn btn-default">Edit</a>
                    <a href="#" onclick="Fury.Admin.ConfirmDelete('<?php admin_url(); ?>fpage/deleteslide/<?php echo $slide["id"]; ?>');" class="btn btn-danger">Delete</a>
				</div>
				<br clear="all" />
			</div>
		<?php endforeach; ?>
    </div>

<?php
	//Load the Admin Footer
	$this->load->view('globals/admin_footer.php');
?>