<?php

	//forums_home template file
	//@author Irate Designs

	//Include the Global Files.
	$this->load->view('globals/global_header.php');
	$this->load->view('forums/forums_nav.php', $nav);
?>
<div class="row-fluid">
    <div class="col-lg-8">
        <div class="row-fluid">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Registration</h3>
                </div>
                <div class="panel-body">
					<div class="errors">
						<?php echo validation_errors(); ?>
						<?php
							if(!empty($reg_error) && $reg_error != null)
								echo "<p>" . $reg_error . "</p>";
						?>
					</div>
					<?php echo form_open('user/register/'); ?>
						<table class="table table-bordered">
							<tr>
								<td class="td-left">Username</td><td><input type="text" name="username" class="form-control" /></td>
							</tr>
							<tr>
								<td class="td-left">Password</td><td><input type="password" name="password" class="form-control" /></td>
							</tr>
							<tr>
								<td class="td-left">Confirm Password</td><td><input type="password" name="passconf" class="form-control" /></td>
							</tr>
							<tr>
								<td class="td-left">Email Address</td><td><input type="text" name="email" class="form-control" /></td>
							</tr>

							<tr>
								<td class="td-left">Location</td><td><input type="text" name="location" class="form-control" /></td>
							</tr>
							<tr>
								<td class="td-left">Timezone</td>
								<td>
									<select name="timezone" class="form-control">
				                        <?php foreach($timezones as $timezone): ?>
										  <option value="<?php echo $timezone["id"]; ?>"><?php echo $timezone["timezoneName"]; ?></option>
				                        <?php endforeach; ?>
									</select>
								</td>
							</tr>
							<tr>
								<td class="td-left">DST Option</td>
								<td>
									<select name="dst" class="form-control">
										<option value="1">Automatically Detect DST Settings</option>
				                        <option value="1">DST Corrections always on</option>
				                        <option value="0">DST Corrections always off</option>
									</select>
								</td>
							</tr>
							<tr>
								<td class="register-submit" colspan="2">
									<div class="pull-left">
										<div class="checkbox">
											<label>
												<input name="agree" type="checkbox" /> I have read and agree to the rules stated above.
											</label>
										</div>
									</div>
									<div class="pull-right">
										<input class="btn btn-primary btn-sm" type="submit" value="Register" />
									</div>
								</td>
							</tr>
						</table>
					</form>
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