<?php
	//Load the Admin Header
	$data["title"] = "Edit Permission Section";
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
	<form action="" method="post">
		<table class="glob-table">
			<tr>
				<td class="left">Title</td>
				<td><input type="text" class="glob-input" name="title" value="<?php echo $sec_title; ?>" /></td>
			</tr>
			<tr>
				<td class="left"></td>
				<td>
					<input type="submit" value="Update Permission Section" class="glob-button" />
				</td>
			</tr>
		</table>
	</form>
<?php
	//Load the Admin Footer
	$this->load->view('administration/globals/admin_footer.php');
?>