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
                    <h3 class="panel-title">Login</h3>
                </div>
                <div class="panel-body">

		        	<div class="errors">
						<?php echo validation_errors(); ?>
						<?php
							if(!empty($login_error) && $login_error != null)
								echo "<p>" . $login_error . "</p>";
						?>
				        <?php
				            $flash_error = $this->session->flashdata('flash_error');
							if(!empty($flash_error) && $flash_error != null)
								echo "<p>" . $flash_error . "</p>";
						?>
					</div>
					<div class="msg">
						<?php
							if(!empty($msg) && $msg != null)
								echo "<p>" . $msg . "</p>";
						?>
					</div>

		        	<?php echo form_open('user/login'); ?>
			            <table class="table table-bordered">
							<tr>
								<td class="td-left">Username</td><td><input type="text" name="username" class="form-control" /></td>
							</tr>
							<tr>
								<td class="td-left">Password</td><td><input type="password" name="password" class="form-control" /></td>
							</tr>
							<tr>
								<td class="td-left" colspan="2">Forgot your password? <a href="<?php url(); ?>user/forgot/">Reset it!</a></td>
							</tr>
							<tr>
								<td class="register-submit" colspan="2">
									<div class="pull-right">
										<input class="btn btn-primary btn-sm" type="submit" value="Login" />
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