<?php
	//Load the Admin Header
	$data["title"] = "User Logs";
	$this->load->view('administration/globals/admin_header.php', $data);
?>
    <div class="pagination">
		<?php echo $this->pagination->create_links(); ?>
	</div>
	<table class="glob-table">
        <thead>
            <th class="text-center">ID</th>
            <th class="text-center">User</th>
            <th class="text-center">Action</th>
            <th class="text-center">Controller</th>
            <th class="text-center">Date</th>
        </thead>
        <tbody>
            <?php foreach($logs as $log): ?>
            <tr>
                <td class="text-center"><?php echo $log["id"]; ?></td>
                <td class="text-center"><?php echo $this->userinfo->get($log["userid"], 'username'); ?> (UserID: <?php echo $log["userid"]; ?>)</td>
                <td class="text-center"><?php echo $log["action"]; ?></td>
                <td class="text-center"><?php echo $log["controller"]; ?></td>
                <td class="text-center"><?php echo date('F jS, Y g:i a', strtotime($log['date'])); ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php
	//Load the Admin Footer
	$this->load->view('administration/globals/admin_footer.php');
?>