<?php
	//Load the Admin Header
	$data["title"] = "Manage Videos";
	$this->load->view('administration/globals/admin_header.php', $data);
?>

	<div class="submit-bar">
        <div class="align-right">
            <div class="align-right"><a href="<?php admin_url(); ?>videos/add/" class="glob-button">New Video</a></div>
        </div>
        <br clear="all" />
    </div>
    
    <div class="alert warning">
        <div class="icon"></div>
        <div class="clear"></div>
        <p>
            This system only supports YouTube videos at this time. Any other videos may cause un-wanted results.
        </p>
    </div>
    
    <table class="glob-table">
        <?php foreach($videos as $v): ?>
		<tr>
			<td><?php echo $v["title"]; ?></td>
			<td>
				<div class="align-right">
                    <a href="<?php admin_url(); ?>videos/edit/<?php echo $v["id"]; ?>" class="glob-button">Edit</a>
                    <a href="#" onclick="Fury.Admin.ConfirmDelete('<?php admin_url(); ?>videos/delete/<?php echo $v["id"]; ?>');" class="glob-button">Delete</a>
                </div>
			</td>
		</tr>
        <?php endforeach; ?>
	</table>
<?php
	//Load the Admin Footer
	$this->load->view('administration/globals/admin_footer.php');
?>