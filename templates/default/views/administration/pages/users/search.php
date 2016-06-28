<?php
	//Load the Admin Header
	$data["title"] = "Search For User";
	$this->load->view('administration/globals/admin_header.php', $data);
?>
    <div class="errors">
		<?php echo validation_errors(); ?>
	</div>
    <form action="" method="post">
	<table class="glob-table">
        <tr>
            <td class="left">
                <select name="search_type" class="glob-select">
                    <option value="username">Username</option>
                    <option value="id">User ID</option>
                    <option value="userip">IP Address</option>
                </select>
            </td>
            <td>
                <input type="text" name="value" class="glob-input" />
                <input type="submit" class="glob-button" value="Search" />
            </td>
        </tr>
    </table>
    </form>
    <?php if($show_results): ?>
    <br />
    <table class="glob-table">
        <tr>
            <td>Search Results for "<b><?php echo $search_value; ?></b>".</td>
        </tr>
        <tr>
            <td>
                <table class="glob-table inner-rows">
                    <?php if(count($users) < 1): ?>
                    <tr><td>No results for "<?php echo $search_value; ?>".</td></tr>
                    <?php else: ?>
                    <?php foreach($users as $user): ?>
                    <tr>
                        <td class="left"><?php echo $user["username"]; ?></td>
                        <td align="right">
                            <a href="<?php admin_url(); ?>users/edit/<?php echo $user["id"]; ?>" class="glob-button">View</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php endif; ?>
                </table>
            </td>
        </tr>
    </table>
    <?php endif; ?>
<?php
	//Load the Admin Footer
	$this->load->view('administration/globals/admin_footer.php');
?>