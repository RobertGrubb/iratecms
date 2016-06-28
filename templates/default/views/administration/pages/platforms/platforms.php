<?php
	//Load the Admin Header
	$data["title"] = "Platform Management";
	$this->load->view('administration/globals/admin_header.php', $data);
?>

	<div class="submit-bar">
        <div class="align-right">
            <div class="align-right"><a href="<?php admin_url(); ?>platforms/addplat/" class="glob-button">New Platform</a></div>
        </div>
        <br clear="all" />
    </div>
    <br />

	<?php foreach($platforms as $plat): ?>
	<table class="glob-table">
		<tr>
			<td>
				<div class="align-left"><?php echo $plat["title"]; ?></div>
				<div class="align-right">
					<a href="<?php admin_url(); ?>platforms/addarena/<?php echo $plat["id"]; ?>" class="glob-button">Add Arena</a>
					<a href="<?php admin_url(); ?>platforms/editplat/<?php echo $plat["id"]; ?>" class="glob-button">Edit Platform</a>
					<a href="#" onclick="Fury.Admin.ConfirmDelete('<?php admin_url(); ?>platforms/deleteplat/<?php echo $plat["id"]; ?>');" class="glob-button">Delete</a>
				</div>
			</td>
		</tr>
		<tr>
			<td>
				<ul class="glob-sortable">
					<?php foreach($plat["arenas"] as $arena): ?>
						<li class="ui-state-default">
							<div class="align-left"><?php echo $arena["title"]; ?></div>
							<div class="align-right">
								<a href="<?php admin_url(); ?>platforms/view_arena_ladders/<?php echo $arena["id"]; ?>" class="glob-button">View Ladders</a>
								<a href="<?php admin_url(); ?>platforms/editarena/<?php echo $arena["id"]; ?>" class="glob-button">Edit</a>
								<a href="#" onclick="Fury.Admin.ConfirmDelete('<?php admin_url(); ?>platforms/deletearena/<?php echo $arena["id"]; ?>');" class="glob-button">Delete</a>
							</div>
							<br clear="all" />
						</li>
					<?php endforeach; ?>
 				</ul>
			</td>
		</tr>
	</table>
	<?php endforeach; ?>

<?php
	//Load the Admin Footer
	$this->load->view('administration/globals/admin_footer.php');
?>