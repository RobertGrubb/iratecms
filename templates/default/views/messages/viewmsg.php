<?php
	//forums_home template file
	//@author Irate Designs
	//Include the Global Files.
	$this->load->view('globals/global_header.php');
?>


<ol class="breadcrumb">
  <li><a href="<?php url(); ?>">Home</a></li>
  <li class="active">View Message</li>
</ol>

<div class="row-fluid">
    <div class="col-lg-8">
        <div class="row-fluid">

            <?php if($parent_message["sendid"] == $this->session->userdata('userid') && $parent_message["sender_deleted"] || 
                 $parent_message["recvid"] == $this->session->userdata('userid') && $parent_message["recv_deleted"]): ?>
                <div class="panel panel-danger">
                    <div class="panel-heading">
                        <h3 class="panel-title"><?php echo $parent_message['title']; ?></h3>
                    </div>
                    <div class="panel-body">
                        This message has been deleted.
                    </div>
                </div>
            <?php else: ?>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><?php echo $parent_message['title']; ?></h3>
                    </div>
                    <div class="panel-body">
                        <div class="media post">
                            <div class="pull-left post-info">
                                <center><h5><a href="<?php echo $this->userinfo->construct_profile_link($parent_message["sendid"]); ?>"><?php echo $this->userinfo->get($parent_message['sendid'], 'username'); ?></a></h5>
                                <img class="media-object" src="<?php echo $this->userinfo->avatar($parent_message['sendid']); ?>" width="100">
                                <br />
                                Posts: <?php echo $this->userinfo->posts($parent_message['sendid']); ?>
                                <br />
                                <?php echo $this->userinfo->get($parent_message['sendid'], 'location'); ?>
                                </center>
                            </div>
                            <div class="media-body post-body">
                                <span class="pull-right"><?php echo date('F jS, Y g:i:s a T', strtotime($parent_message['date'])); ?></span>
                                <hr />
                                <?php echo parse_bbcode($parent_message['message']); ?>
                                <?php if($this->userinfo->get($parent_message['sendid'], 'signature') != null): ?>
                                    <hr />
                                    <div class="post-signature">
                                        <?php echo parse_bbcode($this->userinfo->get($parent_message['sendid'], 'signature')); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <?php foreach($replies as $reply): ?>
                            <div class="media post">
                                <div class="pull-left post-info">
                                    <center><h5><a href="<?php echo $this->userinfo->construct_profile_link($reply["sendid"]); ?>"><?php echo $this->userinfo->get($reply['sendid'], 'username'); ?></a></h5>
                                    <img class="media-object" src="<?php echo $this->userinfo->avatar($reply['sendid']); ?>" width="100">
                                    <br />
                                    Posts: <?php echo $this->userinfo->posts($reply['sendid']); ?>
                                    <br />
                                    <?php echo $this->userinfo->get($reply['sendid'], 'location'); ?>
                                    </center>
                                </div>
                                <div class="media-body post-body">
                                    <span class="pull-right"><?php echo date('F jS, Y g:i:s a T', strtotime($reply['date'])); ?></span>
                                    <hr />
                                    <?php echo parse_bbcode($reply['message']); ?>
                                    <?php if($this->userinfo->get($reply['sendid'], 'signature') != null): ?>
                                        <hr />
                                        <div class="post-signature">
                                            <?php echo parse_bbcode($this->userinfo->get($reply['sendid'], 'signature')); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>


                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Reply</h3>
                    </div>
                    <div class="panel-body">
                        <?php if($parent_message["sendid"] == $this->session->userdata('userid') && $parent_message["recv_deleted"] || 
                                 $parent_message["recvid"] == $this->session->userdata('userid') && $parent_message["sender_deleted"]): ?>
                        <center><b>Sorry, but the recipient has deleted this conversation. You may not reply to this message.</b></center>
                        <?php else: ?>
                        <form action="" method="post">
                        <table class="table table-bordered">
                            <tr>
                                <td>
                                    <textarea id="reply-textarea" class="form-control" name="message" style="height:100px;width:100%;"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="pull-right">
                                        <input class="btn btn-primary btn-sm" type="submit" value="Reply" />
                                    </div>
                                </td>
                            </tr>
                        </table>
                        </form>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>
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