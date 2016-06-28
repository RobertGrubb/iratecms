<?php
	//Load the Admin Header
	$data["title"] = "Edit Forum";
	$this->load->view('administration/globals/admin_header.php', $data);
?>
	
	<div class="errors">
		<?php echo validation_errors(); ?>
	</div>
	<div class="msg">
		<?php
			if(!empty($msg) && $msg != null)
				echo "<p>" . $msg . "</p>";
		?>
	</div>
	<?php foreach($forum as $f): ?>
	<form action="" method="post">
		<table class="glob-table">
			<tr>
				<td class="left">Title</td>
				<td><input type="text" class="glob-input" name="title" value="<?php echo  $f["title"]; ?>" /></td>
			</tr>
			<tr>
				<td class="left">Description</td>
				<td><input type="text" class="glob-input" name="desc" value="<?php echo  $f["desc"]; ?>" /></td>
			</tr>
			<tr>
				<td class="left"></td>
				<td>
					<input type="submit" value="Update Forum" class="glob-button" />
				</td>
			</tr>
		</table>
	</form>
	<?php endforeach; ?>

<?php
	//Load the Admin Footer
	$this->load->view('administration/globals/admin_footer.php');
?>