<?php
	//forums_home template file
	//@author Irate Designs
	//Include the Global Files.
	$this->load->view('globals/global_header.php');
?>
    <div class="register">
		<div class="title">Uh-oh!</div>
		<table class="register-table">
			<tr>
				<td>
                    Sorry, but you are currently banned from our site.
                    <br /><br />
                    If you feel this is a mistake, please follow the following
                    steps:
                    <ul>
                        <li>Contact a Site Administrator via the "Support" Link above.</li>
                        <li>When contacting a site administrator, provide valid proof of a ban appeal.</li>
                        <li>Wait up to 24 hours to recieve a response on the status of your ban appeal.</li>
                    </ul>
                </td>
			</tr>
		</table>
	</div>
<?php
	//Include the Global Footer:
	$this->load->view('globals/global_footer.php');
?>