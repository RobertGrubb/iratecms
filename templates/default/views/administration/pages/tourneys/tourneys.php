<?php
	//Load the Admin Header
	$data["title"] = "Manage Tournaments";
	$this->load->view('administration/globals/admin_header.php', $data);
?>
	<div class="submit-bar">
        <div class="align-right">
            <div class="align-right"><a href="<?php admin_url(); ?>tournaments/add/" class="glob-button">New Tournament</a></div>
        </div>
        <br clear="all" />
    </div>
    <br />
    <table class="glob-table">
        <?php foreach($tournaments as $t): ?>
		<tr>
			<td><?php echo $t["title"]; ?></td>
			<td>
				<div class="align-right">
                    <a href="<?php admin_url(); ?>tournaments/edit/<?php echo $t["id"]; ?>" class="glob-button">Edit</a>
                    <a href="#" onclick="Fury.Admin.ConfirmDelete('<?php admin_url(); ?>tournaments/delete/<?php echo $t["id"]; ?>');" class="glob-button">Delete</a>
                </div>
			</td>
		</tr>
        <?php endforeach; ?>
	</table>
<?php
	//Load the Admin Footer
	$this->load->view('administration/globals/admin_footer.php');
?>