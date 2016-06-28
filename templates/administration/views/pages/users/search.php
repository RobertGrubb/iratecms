<?php
	//Load the Admin Header
	$data["title"] = "Search For User";
	$this->load->view('globals/admin_header.php', $data);
?>
    <div class="errors">
		<?php echo validation_errors(); ?>
	</div>


    <div class="row" style="padding:15px;">
        <div class="col-lg-12 well">
            <form action="" method="post" class="form-inline">
                <div class="form-group">
                    <select name="search_type" class="form-control">
                        <option value="username">Username</option>
                        <option value="id">User ID</option>
                        <option value="userip">IP Address</option>
                    </select>
                </div>
                <div class="form-group">
                    <input type="text" name="value" class="form-control" />
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
            </form>
        </div>
    </div>
    <?php if($show_results): ?>

    <div class="row">
      <div class="col-lg-12">
        <div class="alert alert-info alert-dismissable">
          Search Results for "<b><?php echo $search_value; ?></b>".    
        </div>
      </div>
    </div><!-- /.row -->

    <table class="table table-bordered table-hover table-striped">
        <?php if(count($users) < 1): ?>
        <tr><td>No results for "<?php echo $search_value; ?>".</td></tr>
        <?php else: ?>
        <?php foreach($users as $user): ?>
        <tr>
            <td class="left"><?php echo $user["username"]; ?></td>
            <td align="right">
                <a href="<?php admin_url(); ?>users/edit/<?php echo $user["id"]; ?>" class="btn btn-sm btn-primary">View</a>
            </td>
        </tr>
        <?php endforeach; ?>
        <?php endif; ?>
    </table>
    <?php endif; ?>
<?php
	//Load the Admin Footer
	$this->load->view('globals/admin_footer.php');
?>