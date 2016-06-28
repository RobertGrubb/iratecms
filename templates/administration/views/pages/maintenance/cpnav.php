<?php
	//Load the Admin Header
	$data["title"] = "Control Panel Navigation";
	$this->load->view('globals/admin_header.php', $data);
?>
    <script>
    $(function() {
        $( "#navsections" ).sortable({
        	cursor: 'move',
	        update: function () {          
	            serial = $(this).sortable('toArray');
                $.ajax({
                    url: "<?php admin_url(); ?>maintenance/cpnavsecorder/",
                    type: "POST",
                    data: 'order='+serial,
                    error: function(){
                        alert("theres an error with AJAX");
                    }
                }).done(function() {
                    window.open('<?php admin_url(); ?>/navigation/', 'nav-frame');
                });
	        }
	    }); 
    });
    </script>
    <div class="submit-bar">
        <div class="align-right">
            <div class="align-right"><a href="<?php admin_url(); ?>maintenance/addcpnav/" class="glob-button">New Section</a></div>
        </div>
        <br clear="all" />
    </div>
    <div class="alert warning">
        <div class="icon"></div>
        <div class="clear"></div>
        <p>
            It is not recommended to edit these links unless you understand what you're doing!
        </p>
    </div>
    <ul class="glob-sortable white" id="navsections">
        <?php foreach($navs as $nav): ?>
		<li class="ui-state-default" id="<?php echo $nav["id"]; ?>">
            <div class="align-left">
			    <b><?php echo $nav["title"]; ?></b>
            </div>
            <div class="align-right">
                <a href="<?php admin_url(); ?>maintenance/addcplink/<?php echo $nav["id"]; ?>" class="glob-button">Add Sub Link</a>
                <a href="<?php admin_url(); ?>maintenance/editcpsection/<?php echo $nav["id"]; ?>" class="glob-button">Edit</a>
                <a href="#" onclick="Fury.Admin.ConfirmDelete('<?php admin_url(); ?>maintenance/deletecpsection/<?php echo $nav["id"]; ?>');" class="glob-button">Delete</a>
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
                                url: "<?php admin_url(); ?>maintenance/cplinkorder/",
                                type: "POST",
                                data: 'secid=<?php echo $nav["id"]; ?>'+'&order='+serial,
                                error: function(){
                                    alert("theres an error with AJAX");
                                }
                            }).done(function() {
                                window.open('<?php admin_url(); ?>/navigation/', 'nav-frame');
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
                            <a href="<?php admin_url(); ?>maintenance/editcplink/<?php echo $link["id"]; ?>" class="glob-button">Edit</a>
                            <a href="#" onclick="Fury.Admin.ConfirmDelete('<?php admin_url(); ?>maintenance/deletecplink/<?php echo $link["id"]; ?>');" class="glob-button">Delete</a>
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
	$this->load->view('globals/admin_footer.php');
?>