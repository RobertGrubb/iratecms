<?php
	//forums_home template file
	//@author Irate Designs
	//Include the Global Files.
	$this->load->view('globals/global_header.php');
?>
<ol class="breadcrumb">
  <li><a href="<?php url(); ?>">Home</a></li>
  <li class="active">Account Settings</li>
</ol>
    
<div class="row-fluid">
    <div class="col-lg-8">
        <div class="row-fluid">
            <div class="col-lg-12 well">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs">
              <li class="active"><a href="#account-settings" data-toggle="tab">Account Settings</a></li>
              <li><a href="#change-avatar" data-toggle="tab">Change Avatar</a></li>
              <li><a href="#change-password" data-toggle="tab">Change Password</a></li>
            </ul>
            <div class="tab-content">
                <div class="errors">
                	<?php echo validation_errors(); ?>
                </div>
                <div class="msg">
                	<?php
                		if(!empty($msg) && $msg != null)
                			echo "<p>" . $msg . "</p>";
                	?>
                	<?php
                        $errors = $this->session->flashdata('errors');
                		if(!empty($errors) && $errors != null)
                			echo "<p>" . $errors . "</p>";
                	?>
                </div>
                    <div id="account-settings"  class="tab-pane active">
                        <?php echo form_open('user/edit/#account-settings'); ?>
                    		<table  class="table table-bordered">
                                <tr>
                    				<td class="td-left">Email</td>
                    				<td><input type="text" name="email" class="form-control"  value="<?php echo $info["email"]; ?>"/></td>
                    			</tr>
                    			<tr>
                    				<td class="td-left">Location</td>
                    				<td><input type="text" name="location" class="form-control"  value="<?php echo $info["location"]; ?>"/></td>
                    			</tr>
                    			<tr>
                    				<td class="td-left">Timezone</td>
                    				<td>
                    					<select name="timezone" class="form-control">
                                            <?php foreach($timezones as $timezone): ?>
                    						  <option value="<?php echo $timezone["id"]; ?>"<?php if($info["timezone"] == $timezone["id"]): ?> selected="selected"<?php endif; ?>><?php echo $timezone["timezoneName"]; ?></option>
                                            <?php endforeach; ?>
                    					</select>
                    				</td>
                    			</tr>
                    			<tr>
                    				<td class="td-left">DST Options</td>
                    				<td>
                    					<select name="dst" class="form-control">
                    						<option value="1">Automatically Detect DST Settings</option>
                                            <option value="1" selected="selected">DST Corrections always on</option>
                                            <option value="0">DST Corrections always off</option>
                    					</select>
                    				</td>
                    			</tr>
                    			<tr>
                    				<td class="td-left">Skype</td>
                    				<td><input type="text" name="skype" class="form-control"  value="<?php echo $info["skype"]; ?>"/></td>
                    			</tr>
                    			<tr>
                    				<td class="td-left">Youtube</td>
                    				<td><input type="text" name="youtube" class="form-control"  value="<?php echo $info["youtube"]; ?>"/></td>
                    			</tr>
                    			<tr>
                    				<td class="td-left">Facebook</td>
                    				<td><input type="text" name="facebook" class="form-control"  value="<?php echo $info["facebook"]; ?>"/></td>
                    			</tr>
                    			<tr>
                    				<td class="td-left">Twitter</td>
                    				<td><input type="text" name="twitter" class="form-control"  value="<?php echo $info["twitter"]; ?>"/></td>
                    			</tr>
                                <tr>
                    				<td class="td-left">Bio</td><td><textarea class="form-control" cols="42" rows="6" name="bio"><?php echo $info["bio"]; ?></textarea></td>
                    			</tr>
                    			<tr>
                    				<td class="td-left">Signature</td><td><textarea class="form-control" cols="42" rows="6" name="sig"><?php echo $info["signature"]; ?></textarea></td>
                    			</tr>
                                <tr>
                                    <td></td>
                    				<td class="register-submit">
                    					<div class="register-right">
                                            <input type="hidden" name="update" value="editinfo" />
                    						<input class="btn btn-primary" type="submit" value="Edit Account" />
                    					</div>
                    				</td>
                    			</tr>
                    		</table>
                    	</form>
                    </div>
                    <div id="change-avatar" class="tab-pane">
                        <form action="<?php echo url(); ?>user/edit/#change-avatar" method="post" enctype="multipart/form-data">
                        	<div class="messages">
                        		<table  class="table table-bordered">
                        			<tr>
                        				<td class="td-left">
                                            <img src="<?php echo $this->userinfo->avatar($info['id']); ?>" class="user-avatar" />
                                        </td>
                                        <td><input type="file" name="userfile" class="form-control" /></td>
                        			</tr>
                        		</table>
                        	</div>
                        	<div class="messages">
                        		<table  class="table table-bordered">
                        			<tr>
                        				<td class="register-submit">
                        					<div class="register-right">
                                                <input type="hidden" name="update" value="changeavatar" />
                        						<input class="btn btn-primary" type="submit" value="Edit Avatar" />
                        					</div>
                        				</td>
                        			</tr>
                        		</table>
                        	</div>
                    	</form>
                    </div>
                    <div id="change-password" class="tab-pane">
                        <?php echo form_open('user/edit/#change-password'); ?>
                        	<div class="messages">
                        		<table  class="table table-bordered">
                        			<tr>
                        				<td class="td-left">Password</td><td><input type="password" name="password" class="form-control" /></td>
                        			</tr>
                        			<tr>
                        				<td class="td-left">Confirm Password</td><td><input type="password" name="passconf" class="form-control" /></td>
                        			</tr>
                        		</table>
                        	</div>
                        	<div class="messages">
                        		<table  class="table table-bordered">
                        			<tr>
                        				<td class="register-submit">
                        					<div class="register-right">
                                                <input type="hidden" name="update" value="changepass" />
                        						<input class="btn btn-primary" type="submit" value="Edit Password" />
                        					</div>
                        				</td>
                        			</tr>
                        		</table>
                        	</div>
                    	</form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Right Content -->
    <div class="col-lg-4">
        <div class="row-fluid">
            <?php $this->load->view("widgets/sidebars/sidebars"); ?>
        </div>
    </div>
</div>
<?php
	//Include the Global Footer:
	$this->load->view('globals/global_footer.php');
?>