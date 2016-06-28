<?php
	//Load the Admin Header
	$data["title"] = "PHP Info";
	$this->load->view('administration/globals/admin_header.php', $data);
?>

	<?php phpinfo(); ?>

<?php
	//Load the Admin Footer
	$this->load->view('administration/globals/admin_footer.php');
?>