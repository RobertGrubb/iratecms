<?php
	//Load the Admin Header
	$data["title"] = "Ban Management";
	$this->load->view('administration/globals/admin_header.php', $data);
?>
    <div class="submit-bar">
		<div class="align-right">
			<div class="align-right"><a href="<?php admin_url(); ?>users/addban/" class="glob-button">Ban User</a></div>
		</div>
		<br clear="all" />
	</div>
    
    <div class="alert warning">
        <div class="icon"></div>
        <div class="clear"></div>
        <p>
            At this time you may add a ban, however, bans are unable to be removed unless done so directly fromt he database.
        </p>
    </div>
    
    <table class="glob-table">
        <thead>
        <tr>
            <td>User ID</td>
            <td>User IP</td>
            <td>Reason</td>
            <td>Ban Date</td>
            <td>Lift Date</td>
        </tr>
        </thead>
        <tbody>
            <?php foreach($bans as $ban): ?>
                <tr>
                    <td><?php echo $ban["userid"]; ?></td>
                    <td><?php echo $ban["userip"]; ?></td>
                    <td><?php echo $ban["reason"]; ?></td>
                    <td><?php echo $ban["ban_date"]; ?></td>
                    <td><?php echo $ban["lift_date"]; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>	
<?php
	//Load the Admin Footer
	$this->load->view('administration/globals/admin_footer.php');
?>