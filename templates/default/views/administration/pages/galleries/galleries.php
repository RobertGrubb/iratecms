<?php
	//Load the Admin Header
	$data["title"] = "Manage Galleries";
	$this->load->view('administration/globals/admin_header.php', $data);
?>

	<div class="submit-bar">
        <div class="align-right">
            <div class="align-right"><a href="<?php admin_url(); ?>galleries/addgallery/" class="glob-button">New Gallery</a></div>
        </div>
        <br clear="all" />
    </div>
    <br />
    <table class="glob-table">
        <?php foreach($galleries as $g): ?>
		<tr>
			<td><?php echo $g["title"]; ?></td>
			<td>
				<div class="align-right">
                    <a href="<?php admin_url(); ?>galleries/viewgallery/<?php echo $g["id"]; ?>" class="glob-button">View</a>
                    <a href="<?php admin_url(); ?>galleries/editgallery/<?php echo $g["id"]; ?>" class="glob-button">Edit</a>
                    <a href="#" onclick="Fury.Admin.ConfirmDelete('<?php admin_url(); ?>galleries/deletegallery/<?php echo $g["id"]; ?>');" class="glob-button">Delete</a>
                </div>
			</td>
		</tr>
        <?php endforeach; ?>
	</table>
<?php
	//Load the Admin Footer
	$this->load->view('administration/globals/admin_footer.php');
?>