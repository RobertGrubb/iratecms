<?php
	//Load the Admin Header
	$data["title"] = "Frontpage Widgets";
	$this->load->view('globals/admin_header.php', $data);
?>
	<script>
    $(function() {
        $( "#sortable" ).sortable({
        	cursor: 'move',
	        update: function () {          
	            serial = $(this).sortable('toArray');
                $.ajax({
                    url: "<?php admin_url(); ?>fpage/widgetorder/",
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
    <div class="msg">
		<?php
			if(!empty($msg) && $msg != null)
				echo "<p>" . $msg . "</p>";
		?>
	</div>
    <form action="" method="post">
	<ul class="glob-sortable" id="sortable">
		<?php foreach($widgets as $widget): ?>
			<li class="ui-state-default" id="<?php echo $widget["id"]; ?>">
				<div class="align-left">
					<?php echo $widget["title"]; ?>
				</div>
				<div class="glob-button-holder">
                    <?php if($widget["enabled"]): ?>
						<input type="radio" name="widget[<?php echo $widget["id"]; ?>]" value="1" checked="checked" /> Enabled 
						<input type="radio" name="widget[<?php echo $widget["id"]; ?>]" value="0" /> Disabled
					<?php else: ?>
						<input type="radio" name="widget[<?php echo $widget["id"]; ?>]" value="1" /> Enabled 
						<input type="radio" name="widget[<?php echo $widget["id"]; ?>]" value="0" checked="checked" /> Disabled
					<?php endif; ?>
                </div>
				<br clear="all" />
			</li>
		<?php endforeach; ?>
	</ul>
    <br />
    <div class="submit-bar">
        <div class="align-right">
            <div class="align-right">
                <input type="hidden" value="true" name="update" />
                <input type="submit" value="Save" class="glob-button" />
            </div>
        </div>
        <br clear="all" />
    </div>
    </form>
<?php
	//Load the Admin Footer
	$this->load->view('globals/admin_footer.php');
?>