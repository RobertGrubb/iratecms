<?php
	//Load the Admin Header
	$data["title"] = "Navigation Management";
	$this->load->view('administration/globals/admin_header.php', $data);
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
    <div class="submit-bar">
        <div class="align-right">
            <div class="align-right"><a href="<?php admin_url(); ?>sitenav/addsection/" class="glob-button">New Section</a></div>
        </div>
        <br clear="all" />
    </div>
    <br />
    <ul class="glob-sortable white" id="navsections">
        <?php foreach($navs as $nav): ?>
		<li class="ui-state-default" id="<?php echo $nav["id"]; ?>">
            <div class="align-left">
			    <b><?php echo $nav["title"]; ?></b>
            </div>
            <div class="align-right">
                <a href="<?php admin_url(); ?>sitenav/addlink/<?php echo $nav["id"]; ?>" class="glob-button">Add Sub Link</a>
                <a href="<?php admin_url(); ?>sitenav/editsection/<?php echo $nav["id"]; ?>" class="glob-button">Edit</a>
                <a href="#" onclick="Fury.Admin.ConfirmDelete('<?php admin_url(); ?>sitenav/deletesection/<?php echo $nav["id"]; ?>');" class="glob-button">Delete</a>
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
                <ul class="glob-sortable" id="nav-<?php echo $nav["id"]; ?>">
                    <?php if(count($nav["links"]) >= 1): ?>
                    <?php foreach($nav["links"] as $link): ?>
            		<li class="ui-state-default" id="<?php echo $link["id"]; ?>">
            			<div class="align-left"><?php echo $link["title"]; ?></div>
                        <div class="align-right">
                            <a href="<?php admin_url(); ?>sitenav/editlink/<?php echo $link["id"]; ?>" class="glob-button">Edit</a>
                            <a href="#" onclick="Fury.Admin.ConfirmDelete('<?php admin_url(); ?>sitenav/deletelink/<?php echo $link["id"]; ?>');" class="glob-button">Delete</a>
                        </div>
            			<br clear="all" />
            		</li>
                    <?php endforeach; ?>
                    <?php else: ?>
                        <li>
                			There are no links for this section.
                		</li>  
                    <?php endif; ?>
                </ul>
		</li>
        <?php endforeach; ?>
    </ul>
<?php
	//Load the Admin Footer
	$this->load->view('administration/globals/admin_footer.php');
?>