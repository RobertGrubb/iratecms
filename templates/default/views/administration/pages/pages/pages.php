<?php
	//Load the Admin Header
	$data["title"] = "Pages Manager";
	$this->load->view('administration/globals/admin_header.php', $data);
?>
	<div class="submit-bar">
		<div class="align-right">
			<div class="align-right"><a href="<?php admin_url(); ?>pages/newpage/" class="glob-button">New Page</a></div>
		</div>
		<br clear="all" />
	</div>
	<div class="alert info">
        <div class="icon"></div>
        <div class="clear"></div>
        <p>
            To access pages you make, you use the callname you provide in the page settings. Example: http://www.yoursite.com/<i>callname</i>
        </p>
    </div>
	<table class="glob-table">
        <?php foreach($pages as $page): ?>
		<tr>
			<td class="left" valign="top"><?php echo $page["title"]; ?></td>
			<td>
				<div class="align-right">
                    <a href="<?php url(); ?><?php echo $page["callname"]; ?>" target="_blank" class="glob-button">View Page</a>
                    <a href="<?php admin_url(); ?>pages/editpage/<?php echo $page["id"]; ?>" class="glob-button">Edit</a>
                    <a href="#" onclick="Fury.Admin.ConfirmDelete('<?php admin_url(); ?>pages/deletepage/<?php echo $page["id"]; ?>');" class="glob-button">Delete</a>
                </div>
			</td>
		</tr>
        <?php endforeach; ?>
	</table>
<?php
	//Load the Admin Footer
	$this->load->view('administration/globals/admin_footer.php');
?>