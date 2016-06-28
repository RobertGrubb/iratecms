<?php
	//Load the Admin Header
	$data["title"] = "Permissions Manager";
	$this->load->view('administration/globals/admin_header.php', $data);
?>
    <div class="submit-bar">
		<div class="align-right">
			<div class="align-right"><a href="<?php admin_url(); ?>usergroups/addpermsection/" class="glob-button">Add Section</a></div>
		</div>
		<br clear="all" />
	</div>
    
    <div class="alert info">
        <div class="icon"></div>
        <div class="clear"></div>
        <p>
            Use caution when editing permissions. Some edits may cause you to not access parts of the site.
        </p>
    </div>
    
	<?php foreach($perms as $perm): ?>
	<table class="glob-table">
		<tr>
			<td>
				<?php echo $perm["title"]; ?>
                <div class="align-right">
                    <a href="<?php admin_url(); ?>usergroups/addperm/<?php echo $perm["id"]; ?>" class="glob-button">Add Permission</a>
                    <a href="<?php admin_url(); ?>usergroups/editpermsection/<?php echo $perm["id"]; ?>" class="glob-button">Edit Section</a>
                    <a href="#" onclick="Fury.Admin.ConfirmDelete('<?php admin_url(); ?>usergroups/deletepermsection/<?php echo $perm["id"]; ?>');" class="glob-button">Delete Section</a>
                </div>
                <br clear="all" />
			</td>
		</tr>
		<tr>
			<td>
				<table class="glob-table inner-rows">
					<?php foreach($perm["permissions"] as $p): ?>
						<tr>
							<td class="left">
								<?php echo $p["title"]; ?>
							</td>
							<td align="right">
								<a href="<?php admin_url(); ?>usergroups/editperm/<?php echo $p["id"]; ?>" class="glob-button">Edit</a>
                                <a href="#" onclick="Fury.Admin.ConfirmDelete('<?php admin_url(); ?>usergroups/deleteperm/<?php echo $p["id"]; ?>');" class="glob-button">Delete</a>
							</td>
						</tr>
					<?php endforeach; ?>
				</table>
			</td>
		</tr>
	</table>
	<?php endforeach; ?>
<?php
	//Load the Admin Footer
	$this->load->view('administration/globals/admin_footer.php');
?>