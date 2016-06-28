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
                    <h3 class="panel-title">New Thread</h3>
                </div>
                <div class="panel-body">
					<div class="errors">
						<?php echo validation_errors(); ?>
						<?php
							if(!empty($error) && $error != null)
								echo "<p>" . $error . "</p>";
						?>
					</div>
					<form action="" method="post">
						<!-- Start Post Content -->
						<table class="table table-bordered">
							<tr>
								<td>
									<input type="text" class="form-control" name="title" placeholder="Thread Title" />
								</td>
							</tr>
							<tr>
								<td class="no-bg">
									<textarea id="content" class="form-control" name="content" style="height:500px;width:100%;"></textarea>
								</td>
							</tr>
							<tr>
								<td>
									<div class="pull-right">
										<input class="btn btn-primary btn-sm" type="submit" value="Create Thread" />
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