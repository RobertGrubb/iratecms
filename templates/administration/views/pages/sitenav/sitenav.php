<?php
	//Load the Admin Header
	$data["title"] = "Navigation Management";
	$this->load->view('globals/admin_header.php', $data);
?>
    <script>
    $(function() {
        $( "#navsections" ).sortable({
        	cursor: 'move',
	        update: function () {          
	            serial = $(this).sortable('toArray');
                $.ajax({
                    url: "<?php admin_url(); ?>sitenav/secorder/",
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
            <a href="<?php admin_url(); ?>sitenav/addsection/" class="btn btn-md btn-primary">
                New Section
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
          You may drag sections and links to change the order of display.     
        </div>
      </div>
    </div><!-- /.row -->



    <div class="row" style="padding:15px;" id="navsections">
        <?php foreach($navs as $nav): ?>
		<div class="col-lg-12 well" id="<?php echo $nav["id"]; ?>">
            <div class="pull-left">
			    <b><?php echo $nav["title"]; ?></b>
            </div>
            <div class="pull-right">
                <a href="<?php admin_url(); ?>sitenav/addlink/<?php echo $nav["id"]; ?>" class="btn btn-primary">Add Sub Link</a>
                <a href="<?php admin_url(); ?>sitenav/editsection/<?php echo $nav["id"]; ?>" class="btn btn-default">Edit</a>
                <a href="#" onclick="Fury.Admin.ConfirmDelete('<?php admin_url(); ?>sitenav/deletesection/<?php echo $nav["id"]; ?>');" class="btn btn-danger">Delete</a>
            </div>
            <br />
			<br clear="all" />
                <script>
                $(function() {
                    $( "#nav-<?php echo $nav["id"]; ?>" ).sortable({
                    	cursor: 'move',
            	        update: function () {          
            	            serial = $(this).sortable('toArray');
                            $.ajax({
                                url: "<?php admin_url(); ?>sitenav/linkorder/",
                                type: "POST",
                                data: 'secid=<?php echo $nav["id"]; ?>'+'&order='+serial,
                                error: function(){
                                    alert("theres an error with AJAX");
                                }
                            });
            	        }
            	    }); 
                });
                </script>
                <hr />
                <div class="row" style="padding:15px;" id="nav-<?php echo $nav["id"]; ?>">
                    <?php if(count($nav["links"]) >= 1): ?>
                    <?php foreach($nav["links"] as $link): ?>
                    <div class="col-lg-12 well" id="<?php echo $link["id"]; ?>">
            			<div class="pull-left"><?php echo $link["title"]; ?></div>
                        <div class="pull-right">
                            <a href="<?php admin_url(); ?>sitenav/editlink/<?php echo $link["id"]; ?>" class="btn btn-default">Edit</a>
                            <a href="#" onclick="Fury.Admin.ConfirmDelete('<?php admin_url(); ?>sitenav/deletelink/<?php echo $link["id"]; ?>');" class="btn btn-danger">Delete</a>
                        </div>
            			<br clear="all" />
            		</div>
                    <?php endforeach; ?>
                    <?php else: ?>
                        <li>
                			There are no links for this section.
                		</li>  
                    <?php endif; ?>
                </div>
		</div>
        <?php endforeach; ?>
    </div>
<?php
	//Load the Admin Footer
	$this->load->view('globals/admin_footer.php');
?>