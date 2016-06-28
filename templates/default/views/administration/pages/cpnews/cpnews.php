<?php
	//Load the Admin Header
	$data["title"] = "CP News Management";
	$this->load->view('administration/globals/admin_header.php', $data);
?>

	<div class="submit-bar">
        <div class="align-right">
            <div class="align-right"><a href="<?php admin_url(); ?>cpnews/addnews/" class="glob-button">New Post</a></div>
        </div>
        <br clear="all" />
    </div>
    <br />
    <table class="glob-table">
        <?php foreach($news as $n): ?>
		<tr>
			<td><?php echo $n["title"]; ?></td>
			<td>
				<div class="align-right">
                    <a href="<?php admin_url(); ?>cpnews/edit/<?php echo $n["id"]; ?>" class="glob-button">Edit</a>
                    <a href="#" onclick="Fury.Admin.ConfirmDelete('<?php admin_url(); ?>cpnews/delete/<?php echo $n["id"]; ?>');" class="glob-button">Delete</a>
                </div>
			</td>
		</tr>
        <?php endforeach; ?>
	</table>

<?php
	//Load the Admin Footer
	$this->load->view('administration/globals/admin_footer.php');
?>