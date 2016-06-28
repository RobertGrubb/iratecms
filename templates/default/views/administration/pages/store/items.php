<?php
	//Load the Admin Header
	$data["title"] = "Item Management";
	$this->load->view('administration/globals/admin_header.php', $data);
?>

	Item Management Index

<?php
	//Load the Admin Footer
	$this->load->view('administration/globals/admin_footer.php');
?>