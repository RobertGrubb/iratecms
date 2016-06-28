<?php
	//Load the Admin Header
	$data["title"] = "[" . $plat["title"] . "] [" . $arena["title"] . "] Ladders";
	$this->load->view('administration/globals/admin_header.php', $data);
?>

	<div class="submit-bar">
        <div class="align-right">
            <div class="align-right">
            	<a href="<?php admin_url(); ?>platforms/addladder/<?php echo $arena['id']; ?>" class="glob-button">New Ladder</a>
            	<a href="<?php admin_url(); ?>platforms/" class="glob-button">Back</a>
            </div>
        </div>
        <br clear="all" />
    </div>
    <br />

    <ul class="glob-sortable">
			<?php foreach($ladders as $ladder): ?>
				<li class="ui-state-default">
					<div class="align-left">
						<?php echo $ladder["title"]; ?> 
						<?php if($ladder["active"]): ?>
							<font color="green"><b>[ACTIVE]</b></font>
						<?php else: ?>
							<font color="red"><b>[INACTIVE]</b></font>
						<?php endif; ?>
					</div>
					<div class="glob-button-holder">
						<a href="<?php admin_url(); ?>platforms/editladder/<?php echo $ladder["id"]; ?>" class="glob-button">Edit</a>
						<a href="#" onclick="Fury.Admin.ConfirmDelete('<?php admin_url(); ?>platforms/deleteladder/<?php echo $ladder["id"]; ?>');" class="glob-button">Delete</a>
					</div>
					<br clear="all" />
				</li>
			<?php endforeach; ?>
		</ul>

<?php
	//Load the Admin Footer
	$this->load->view('administration/globals/admin_footer.php');
?>