<?php
	//Load the Admin Header
	$data["title"] = "Ban Management";
	$this->load->view('globals/admin_header.php', $data);
?>
    <script>
    $(function() {
        $( "#datepicker" ).datepicker();
    });
    </script>
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
    
    <form role="form" action="" method="post" enctype="multipart/form-data">

        <div class="panel panel-info">
          <div class="panel-heading">
            New Ban
          </div>

          <div class="panel-body">

            <div class="form-group">
                <label>Ban by</label>
                <select name="search_type" class="form-control">
                    <option value="userid">User ID</option>
                    <option value="userip">IP Address</option>
                </select>
            </div>  

            <div class="form-group">
                <label>User ID/ User IP</label>
                <input type="text" name="value" class="form-control" />
            </div>

            <hr />

            <div class="form-group">
                <label>Reason</label>
                <input type="text" name="reason" class="form-control" />
            </div>

            <hr />

            <div class="form-group">
                <label>Lift Date</label>
                <input type="text" name="lift_date" id="datepicker" class="form-control" />
            </div>

            <hr />
           </div>
          </div>
          <div class="text-right">
            <button type="submit" class="btn btn-primary">Process Ban</button>
        </div>
    </form>
<?php
	//Load the Admin Footer
	$this->load->view('globals/admin_footer.php');
?>