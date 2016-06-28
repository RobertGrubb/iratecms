<?php
	//Load the Admin Header
	$data["title"] = "Ban Management";
	$this->load->view('globals/admin_header.php', $data);
?>
    <div class="row">
      <div class="col-lg-12">
        <div class="text-right">
            <a href="<?php admin_url(); ?>users/addban/" class="btn btn-md btn-primary">
                Ban User
            </a>
        </div>

            <div class="clearfix"></div>
            <br />
      </div>
    </div><!-- /.row -->

    <div class="row">
      <div class="col-lg-12">
        <div class="alert alert-warning alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            At this time you may add a ban, however, bans are unable to be removed unless done so directly fromt he database.
        </div>
      </div>
    </div><!-- /.row -->

    
    <table class="table table-bordered table-hover table-striped">
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
	$this->load->view('globals/admin_footer.php');
?>