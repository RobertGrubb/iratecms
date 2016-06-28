<?php
	$data["title"] = "Dashboard";

	$this->load->view("globals/admin_header.php", $data);
	$this->load->view("pages/frontpage.php");
	$this->load->view("globals/admin_footer.php");
?>