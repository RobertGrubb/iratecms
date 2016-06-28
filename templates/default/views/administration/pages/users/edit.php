<?php
	//Load the Admin Header
	$data["title"] = "Edit User";
	$this->load->view('administration/globals/admin_header.php', $data);
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
    <table class="glob-table">
        <tr>
            <td class="left">User ID:</td>
            <td>
                <input type="text" class="glob-input" name="id" value="<?php echo $u["id"]; ?>" readonly="readonly" />
            </td>
        </tr>
        <tr>
            <td class="left">Last Known IP Address:</td>
            <td>
                <input type="text" class="glob-input" name="id" value="<?php echo $u["userip"]; ?>" readonly="readonly" />
            </td>
        </tr>
        <tr>
            <td class="left">Username:</td>
            <td>
                <input type="text" class="glob-input" name="username" value="<?php echo $u["username"]; ?>" />
            </td>
        </tr>
        <tr>
            <td class="left">Usergroup:</td>
            <td>
                <select name="groupid" class="glob-select">
                    <?php foreach($usergroups as $usergroup): ?>
                        <option<?php if($usergroup["id"] == $u["groupid"]): ?> selected="selected" <?php endif; ?> value="<?php echo $usergroup["id"]; ?>"><?php echo $usergroup["title"]; ?></option>
                    <?php endforeach; ?>
                </select>
            </td>
        </tr>
        <tr>
            <td class="left">Suspended:</td>
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
            <td class="left">Email:</td>
            <td>
                <input type="text" class="glob-input" name="email" value="<?php echo $u["email"]; ?>" />
            </td>
        </tr>
        <tr>
            <td class="left">Youtube:</td>
            <td>
                <input type="text" class="glob-input" name="youtube" value="<?php echo $u["youtube"]; ?>" />
            </td>
        </tr>
        <tr>
            <td class="left">Twitter:</td>
            <td>
                <input type="text" class="glob-input" name="twitter" value="<?php echo $u["twitter"]; ?>" />
            </td>
        </tr>
        <tr>
            <td class="left">Facebook:</td>
            <td>
                <input type="text" class="glob-input" name="facebook" value="<?php echo $u["facebook"]; ?>" />
            </td>
        </tr>
        <tr>
            <td class="left">Skype:</td>
            <td>
                <input type="text" class="glob-input" name="skype" value="<?php echo $u["skype"]; ?>" />
            </td>
        </tr>
        <tr>
            <td class="left">Location:</td>
            <td>
                <input type="text" class="glob-input" name="location" value="<?php echo $u["location"]; ?>" />
            </td>
        </tr>
        <tr>
            <td class="left">Signature:</td>
            <td>
                <textarea name="signature" class="glob-textarea"><?php echo $u["signature"]; ?></textarea>
            </td>
        </tr>
        <tr>
	       <td class="left"></td>
	       <td>
	           <input type="submit" value="Update User" class="glob-button" />
	       </td>
	   </tr>
    </table>
    </form>	
<?php
    endforeach;
	//Load the Admin Footer
	$this->load->view('administration/globals/admin_footer.php');
?>