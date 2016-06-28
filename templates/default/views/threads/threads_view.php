<?php

	//forums_home template file
	//@author Irate Designs

	//Include the Global Files.
	
	foreach($thread as $t):
    $data["extra_title"] = $t['title'];
	$this->load->view('globals/global_header.php', $data);
    $this->load->view('forums/forums_nav.php', $nav);
?>

<div class="row-fluid">
    <div class="col-lg-8">
        <div class="row-fluid">
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
			<div class="well well-sm">
				<div class="pull-left">
					<span class="thread-title"><?php echo $t['title']; ?></span>
				</div>
				<div class="pull-right">
					<?php if($this->acl->perm('can_move_threads') && $t['locked'] == 0): ?>
	                    <a href="<?php echo base_url(); ?>threads/close/<?php echo $t['id']; ?>" class="btn btn-primary btn-xs">Close Thread</a>
	                <?php elseif($this->acl->perm('can_move_threads') && $t['locked'] == 1): ?>
	                    <a href="<?php echo base_url(); ?>threads/open/<?php echo $t['id']; ?>" class="btn btn-primary btn-xs">Open Thread</a>
	                <?php endif; ?>
	                
	                <?php if($this->acl->perm('can_sticky_thread') && $t['type'] == 0): ?>
	                    <a href="<?php echo base_url(); ?>threads/sticky/<?php echo $t['id']; ?>" class="btn btn-primary btn-xs">Sticky</a>
	                <?php elseif($this->acl->perm('can_sticky_thread') && $t['type'] == 1): ?>
	                    <a href="<?php echo base_url(); ?>threads/unsticky/<?php echo $t['id']; ?>" class="btn btn-primary btn-xs">Unsticky</a>
	                <?php endif; ?>
				</div>
				<div class="clearfix"></div>
			</div>

			<hr class="thread-hr" />
			<?php echo $this->pagination->create_links(); ?>
			

			<div class="media post">
                <div class="pull-left post-info">
                    <center><h5><a href="<?php echo $this->userinfo->construct_profile_link($t["userid"]); ?>"><?php echo $this->userinfo->get($t['userid'], 'username'); ?></a></h5>
                    <img class="media-object" src="<?php echo $this->userinfo->avatar($t['userid']); ?>" width="100">
                    <br />
                    Posts: <?php echo $this->userinfo->posts($t['userid']); ?>
                    <br />
                    <?php echo $this->userinfo->get($t['userid'], 'location'); ?>
                    </center>
                </div>
                <div class="media-body post-body">
                	<div class="well well-sm">
                		<span class="pull-left">
                			<?php if($this->acl->perm('can_edit_threads') || $t["userid"] == $this->session->userdata('userid')): ?>
                            	<a class="btn btn-primary btn-xs" href="<?php url(); ?>threads/editpost/t/<?php echo $t["id"]; ?>">Edit</a>
                            <?php endif; ?>
                		</span>
                		<span class="pull-right"><?php echo date('F jS, Y g:i:s a T', strtotime($t['date'])); ?></span>
                		<div class="clearfix"></div>
                	</div>
                    <hr />
                    <?php echo parse_bbcode($t['content']); ?>
                    <?php if($this->userinfo->get($t['userid'], 'signature') != null): ?>
                        <hr />
                        <div class="post-signature">
                            <?php echo parse_bbcode($this->userinfo->get($t['userid'], 'signature')); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <hr class="thread-hr" />

			<?php foreach($t["replies"] as $reply): ?>


			<div class="media post">
                <div class="pull-left post-info">
                    <center><h5><a href="<?php echo $this->userinfo->construct_profile_link($reply["userid"]); ?>"><?php echo $this->userinfo->get($reply['userid'], 'username'); ?></a></h5>
                    <img class="media-object" src="<?php echo $this->userinfo->avatar($reply['userid']); ?>" width="100">
                    <br />
                    Posts: <?php echo $this->userinfo->posts($reply['userid']); ?>
                    <br />
                    <?php echo $this->userinfo->get($reply['userid'], 'location'); ?>
                    </center>
                </div>
                <div class="media-body post-body">
                	<div class="well well-sm">
                		<span class="pull-left">
                			<?php if($this->acl->perm('can_edit_threads') || $reply["userid"] == $this->session->userdata('userid')): ?>
                            	<a class="btn btn-primary btn-xs" href="<?php url(); ?>threads/editpost/p/<?php echo $reply["id"]; ?>">Edit</a>
                            <?php endif; ?>
                		</span>
                		<span class="pull-right"><?php echo date('F jS, Y g:i:s a T', strtotime($reply['date'])); ?></span>
                		<div class="clearfix"></div>
                	</div>
                    <hr />
                    <?php echo parse_bbcode($reply['content']); ?>
                    <?php if($this->userinfo->get($reply['userid'], 'signature') != null): ?>
                        <hr />
                        <div class="post-signature">
                            <?php echo parse_bbcode($this->userinfo->get($reply['userid'], 'signature')); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
			<?php endforeach; ?>

			<?php echo $this->pagination->create_links(); ?>

			<hr class="thread-hr" />

            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Reply</h3>
                </div>
                <div class="panel-body">
					<?php if($this->session->userdata('logged_in')): ?>
			            <?php if($t['locked'] == 1): ?>
			                <table class="table table-bordered">
			        			<tr>
			        				<td>
			        					<center>Sorry, you may not reply. This thread is locked.</center>
			        				</td>
			        			</tr>
			        		</table>
			            <?php else: ?>
			    		<form action="" method="post">
			    		<!-- Start Post Content -->
			    		<table class="table table-bordered">
			    			<tr>
			    				<td>
			    					<textarea id="reply-textarea" class="form-control" name="content" style="height:100px;width:100%;"></textarea>
			    				</td>
			    			</tr>
			    			<tr>
			    				<td>
			    					<div class="pull-right">
			    						<input class="btn btn-primary btn-sm" type="submit" onclick="wswgEditor.doCheck();" value="Reply" />
			    					</div>
			    				</td>
			    			</tr>
			    		</table>
			    		</form>
			            <?php endif; ?>
					<?php else: ?>
					<table class="table table-bordered">
						<tr>
							<td>
								<center>You must be <a href="<?php url(); ?>user/login/">logged in</a> to reply.</center>
							</td>
						</tr>
					</table>
					<?php endif; ?>
					<!-- End Post Content -->
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
	endforeach;
	//Include the Global Footer:
	$this->load->view('globals/global_footer.php');
?>