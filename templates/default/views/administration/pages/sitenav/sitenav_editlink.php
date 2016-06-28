<?php
	//Load the Admin Header
	$data["title"] = "Edit Navigation Link";
	$this->load->view('administration/globals/admin_header.php', $data);
?>
	<div class="errors">
		<?php echo validation_errors(); ?>
        <?php
			if(!empty($error) && $error != null)
				echo "<p>" . $error . "</p>";
		?>
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
				<td><input type="text" class="glob-input" value="<?php echo $link["title"]; ?>" name="title" /></td>
			</tr>
            <tr>
				<td class="left">URL</td>
				<td><input type="text" class="glob-input" value="<?php echo $link["href"]; ?>" name="href" /></td>
			</tr>
			<tr>
				<td class="left"></td>
				<td>
					<input type="submit" value="Edit Link" class="glob-button" />
				</td>
			</tr>
		</table>
	</form>
<?php
	//Load the Admin Footer
	$this->load->view('administration/globals/admin_footer.php');
?>