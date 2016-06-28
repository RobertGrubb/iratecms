<?php
	//Load the Admin Header
	$data["title"] = "Manage Blog Posts";
	$this->load->view('administration/globals/admin_header.php', $data);
?>

	<div class="submit-bar">
        <div class="align-right">
            <div class="align-right"><a href="<?php admin_url(); ?>blogs/add/" class="glob-button">New Blog Post</a></div>
        </div>
        <br clear="all" />
    </div>
    <br />
    
    <div class="alert info">
        <div class="icon"></div>
        <div class="clear"></div>
        <p>
            Cover images for blog posts should be around 120x120 for best results. Remember to add a short description, as well!
        </p>
    </div>
    
    <table class="glob-table">
        <tr>
            <td class="col-num">ID</td>
            <td>Title</td>
            <td class="col-options">Options</td>
        </tr>
        <?php foreach($blogs as $b): ?>
		<tr>
            <td class="col-num"><?php echo $b["id"]; ?></td>
			<td><?php echo $b["title"]; ?></td>
			<td class="col-options">
                <a href="<?php admin_url(); ?>blogs/edit/<?php echo $b["id"]; ?>" class="glob-button">Edit</a>
                <a href="#" onclick="Fury.Admin.ConfirmDelete('<?php admin_url(); ?>blogs/delete/<?php echo $b["id"]; ?>');" class="glob-button">Delete</a>
			</td>
		</tr>
        <?php endforeach; ?>
	</table>
<?php
	//Load the Admin Footer
	$this->load->view('administration/globals/admin_footer.php');
?>