<?php
	//Load the Admin Header
	$data["title"] = "Edit User";
	$this->load->view('globals/admin_header.php', $data);
    foreach($user as $u):
?>
    <div class="errors">
		<?php echo validation_errors(); ?>
	</div>
	<div class="msg">
		<?php
			if(!empty($msg) && $msg != null)
				echo "<p>" . $msg . "</p>";
		?>
	</div>

    <form action="" method="post">


    <div class="panel panel-primary">
      <div class="panel-heading">
        Update User
      </div>

      <div class="panel-body">

        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped">
                <tr>
                    <td >User ID:</td>
                    <td>
                        <input type="text" class="glob-input" name="id" value="<?php echo $u["id"]; ?>" readonly="readonly" />
                    </td>
                </tr>
                <tr>
                    <td >Last Known IP Address:</td>
                    <td>
                        <input type="text" class="glob-input" name="id" value="<?php echo $u["userip"]; ?>" readonly="readonly" />
                    </td>
                </tr>
                <tr>
                    <td >Username:</td>
                    <td>
                        <input type="text" class="glob-input" name="username" value="<?php echo $u["username"]; ?>" />
                    </td>
                </tr>
                <tr>
                    <td >Usergroup:</td>
                    <td>
                        <select name="groupid" class="glob-select">
                            <?php foreach($usergroups as $usergroup): ?>
                                <option<?php if($usergroup["id"] == $u["groupid"]): ?> selected="selected" <?php endif; ?> value="<?php echo $usergroup["id"]; ?>"><?php echo $usergroup["title"]; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td >Suspended:</td>
                    <td>
                        <select name="suspended" class="glob-select">
                            <?php if($u["suspended"]): ?>
                                <option value="1" selected="selected">Yes</option>
                                <option value="0">No</option>
                            <?php else: ?>
                                <option value="1">Yes</option>
                                <option value="0" selected="selected">No</option>
                            <?php endif; ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td >Email:</td>
                    <td>
                        <input type="text" class="glob-input" name="email" value="<?php echo $u["email"]; ?>" />
                    </td>
                </tr>
                <tr>
                    <td >Youtube:</td>
                    <td>
                        <input type="text" class="glob-input" name="youtube" value="<?php echo $u["youtube"]; ?>" />
                    </td>
                </tr>
                <tr>
                    <td >Twitter:</td>
                    <td>
                        <input type="text" class="glob-input" name="twitter" value="<?php echo $u["twitter"]; ?>" />
                    </td>
                </tr>
                <tr>
                    <td >Facebook:</td>
                    <td>
                        <input type="text" class="glob-input" name="facebook" value="<?php echo $u["facebook"]; ?>" />
                    </td>
                </tr>
                <tr>
                    <td >Skype:</td>
                    <td>
                        <input type="text" class="glob-input" name="skype" value="<?php echo $u["skype"]; ?>" />
                    </td>
                </tr>
                <tr>
                    <td >Location:</td>
                    <td>
                        <input type="text" class="glob-input" name="location" value="<?php echo $u["location"]; ?>" />
                    </td>
                </tr>
                <tr>
                    <td >Signature:</td>
                    <td>
                        <textarea name="signature" class="glob-textarea"><?php echo $u["signature"]; ?></textarea>
                    </td>
                </tr>
            </table>
            </div>
        </div>
    </div>



          <div class="text-right">
            <button type="submit" class="btn btn-primary">Update User</button>
        </div>
        
            </form>
<?php
    endforeach;
	//Load the Admin Footer
	$this->load->view('globals/admin_footer.php');
?>