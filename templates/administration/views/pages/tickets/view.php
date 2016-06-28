<?php
	//Load the Admin Header
	$data["title"] = "Viewing Ticket: " . $ticket["id"];
	$this->load->view('globals/admin_header.php', $data);
?>
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


    <form role="form" action="" method="post" enctype="multipart/form-data">

        <div class="panel panel-info">
          <div class="panel-heading">
            Ticket Information
          </div>

          <div class="panel-body">

            <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped">
                    <tr>
                        <td class="left">Username</td>
                        <td>
                            <a href="<?php admin_url(); ?>users/edit/<?php echo $ticket["userid"]; ?>">
                                <?php echo $this->userinfo->get($ticket["userid"], 'colored_username'); ?>
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td class="left">Usergroup</td>
                        <td>
                            <?php echo $this->userinfo->usergroup($this->userinfo->get($ticket["userid"], 'groupid'), 'title'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="left">IP Address</td>
                        <td>
                            <?php echo $ticket["userip"]; ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="left">Category</td>
                        <td class="left">
                            <select class="form-control" name="category">
                                <?php foreach($categories as $cat): ?>
                                    <?php if($cat["id"] == $cat_id): ?>
                                        <option value="<?php echo $cat["id"]; ?>" selected="selected"><?php echo $cat["title"]; ?></option>
                                    <?php else: ?>
                                        <option value="<?php echo $cat["id"]; ?>"><?php echo $cat["title"]; ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="left">Subject</td>
                        <td>
                            <input type="text" name="subject" value="<?php echo $ticket["subject"]; ?>" class="form-control" />
                        </td>
                    </tr>
                    <tr>
                        <td class="left" valign="top">Content</td>
                        <td>
                            <?php echo parse_bbcode($ticket["content"]); ?>
                        </td>
                    </tr> 
                    <?php
                        if(!empty($ticket["proof"])):
                    ?>
                    <tr>
                        <td class="left" valign="top">Proof</td>
                        <td>
                    <?php
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
                    ?>
                        </td>
                    </tr>
                    <?php
                        endif;
                    ?>
                </table>


           </div>
           </div>
          </div>



          <div class="panel panel-info">
            <div class="panel-heading">
                Replies
            </div>

            <div class="panel-body">

                <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped">
                    <?php if(count($replies) < 1): ?>
                    <tr>
                        <td>
                            No replies to this ticket at this time.
                        </td>
                    </tr>
                    <?php else: ?>
                    <?php foreach($replies as $reply): ?>
                        <tr>
                            <td width="140">
                                <center><b><?php echo $this->userinfo->get($reply['userid'], 'colored_username'); ?></b></center><br />
                                <div class="ticket-avatar"></div>
                            </td>
                            <td>
                                <?php echo parse_bbcode($reply["content"]); ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    <?php endif; ?>
                </table>
                </div>

            </div>
          </div>

          <div class="panel panel-info">
            <div class="panel-heading">
                Resolution
            </div>

            <div class="panel-body">

                <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped">
                    <tr>
                        <td>Status: 
                            <font color="green"><b>[OPEN]</b></font> <input name="status" value="0" <?php if(!$ticket["status"]) : ?>checked="checked" <?php endif; ?>type="radio" checked="checked" />
                            <font color="red"><b>[CLOSED]</b></font> <input name="status" value="1" <?php if($ticket["status"]) : ?>checked="checked" <?php endif; ?>type="radio" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div>
                                <div>
                                    <textarea id="reply-textarea" name="content" style="height:200px;"></textarea>
                                </div>
                            </div>
                        </td>
                    </tr>
                </table>
                </div>

            </div>
          </div>

          <div class="text-right">
            <button type="submit" class="btn btn-primary">Resolve Ticket</button>
        </div>

    </form>

<?php
	//Load the Admin Footer
	$this->load->view('globals/admin_footer.php');
?>