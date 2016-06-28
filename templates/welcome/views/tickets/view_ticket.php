<?php
	//forums_home template file
	//@author Irate Designs
	//Include the Global Files.
	$this->load->view('globals/global_header.php');
?>

<ol class="breadcrumb">
  <li><a href="<?php url(); ?>">Home</a></li>
  <li class="active">View Ticket</li>
</ol>

<div class="row-fluid">
    <div class="col-lg-8">
        <div class="row-fluid">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><?php echo $ticket['subject']; ?></h3>
                </div>
                <div class="panel-body">

            <div class="media post">
                <div class="pull-left post-info">
                <a href="<?php echo $this->userinfo->construct_profile_link($ticket["userid"]); ?>">
                    <img class="media-object" src="<?php echo $this->userinfo->avatar($ticket['userid']); ?>" width="100">
                </a>
                </div>
                <div class="media-body post-body">
                    <h4 class="media-heading"><a href="<?php echo $this->userinfo->construct_profile_link($ticket["userid"]); ?>"><?php echo $this->userinfo->get($ticket['userid'], 'username'); ?></a></h4>
                    <hr />
                    <b>Category: <?php echo $cat_title; ?></b>
                    <hr />
                    <b>Subject: <?php echo $ticket["subject"]; ?></b>
                    <hr />
                    <?php echo parse_bbcode($ticket['content']); ?>
                    <hr />
                    <?php
                        if(!empty($ticket["proof"])):
                        $proof = unserialize($ticket["proof"]);
                        foreach($proof as $key => $url):
                    ?>
                        <div class="ticket-proof-title">Proof #<?php echo $key; ?>
                            <hr />
                            <?php if(empty($url)): ?>
                                No proof provided.
                            <?php else: ?>
                                <a href="<?php echo $url; ?>" target="_blank"><?php echo $url; ?></a>
                            <?php endif; ?>
                        </div>
                        <hr />
                    <?php
                        endforeach;
                        endif;
                    ?>
                </div>
            </div>
    	
        <?php foreach($replies as $reply): ?>

            <div class="media post">
                <div class="pull-left post-info">
                    <a href="<?php echo $this->userinfo->avatar($reply['userid']); ?>">
                        <img class="media-object" src="<?php echo $this->userinfo->avatar($reply['userid']); ?>" width="100">
                    </a>
                </div>
                <div class="media-body post-body">
                    <h4 class="media-heading"><a href="<?php echo $this->userinfo->construct_profile_link($reply["userid"]); ?>"><?php echo $this->userinfo->get($reply['userid'], 'username'); ?></a></h4>
                    <hr />
                    <?php echo parse_bbcode($reply['content']); ?>
                </div>
            </div>

        <?php endforeach; ?>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Reply</h3>
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
            		<table class="table">
            			<tr>
            				<td>

            					<textarea id="reply-textarea" class="form-control" name="content" style="height:100px;width:100%;"></textarea>

            				</td>
            			</tr>
            			<tr>
            				<td>
            					<div class="reply-right">
            						<input class="btn btn-primary btn-sm" type="submit" value="Reply" />
            					</div>
            				</td>
            			</tr>
            		</table>
            		</form>
                </div>
            </div>
        </div>
   </div></div></div>
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