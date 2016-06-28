<?php
	//Load the Admin Header
	$data["title"] = "Ban Management";
	$this->load->view('administration/globals/admin_header.php', $data);
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
    <form action="" method="post">
	<table class="glob-table">
        <tr>
            <td class="left">
                Ban by:
            </td>
            <td>
                <select name="search_type" class="glob-select">
                    <option value="userid">User ID</option>
                    <option value="userip">IP Address</option>
                </select>
            </td>
        <tr>
            <td class="left">UserID/UserIP</td>
            <td>
                <input type="text" name="value" class="glob-input" />
            </td>
        </tr>
        <tr>
            <td class="left">
                Reason:
            </td>
            <td>
                <input type="text" name="reason" class="glob-input" />
            </td>
        </tr>
        <tr>
            <td class="left">
                Lift Date:
            </td>
            <td>
                <input type="text" name="lift_date" class="glob-input" id="datepicker" />
            </td>
        </tr>
        <tr>
            <td class="left">
            </td>
            <td>
                <input type="submit" class="glob-button" value="Ban" />
            </td>
        </tr>
    </table>
    </form>		
<?php
	//Load the Admin Footer
	$this->load->view('administration/globals/admin_footer.php');
?>