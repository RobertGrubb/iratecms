<?php
	//Load the Admin Header
	$data["title"] = "Viewing Ticket: " . $ticket["id"];
	$this->load->view('administration/globals/admin_header.php', $data);
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
    <form action="" method="post">
    <table class="glob-table">
        <tr>
            <td><h3>Ticket Information</h3>
                <br />
            	<table class="glob-table">
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
                            <select class="glob-select" name="category">
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
                            <input type="text" name="subject" value="<?php echo $ticket["subject"]; ?>" class="glob-input" />
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
             </td>
        </tr>
    </table>
    
    <table class="glob-table">
        <tr>
            <td><h3>Replies</h3>
                <br />
            	<table class="glob-table">
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
             </td>
        </tr>
    </table>
    
    <table class="glob-table">
        <tr>
            <td><h3>Resolution</h3>
                <br />
            	<table class="glob-table">
                    <tr>
                        <td>Status: 
                            <font color="green"><b>[OPEN]</b></font> <input name="status" value="0" <?php if(!$ticket["status"]) : ?>checked="checked" <?php endif; ?>type="radio" checked="checked" />
                            <font color="red"><b>[CLOSED]</b></font> <input name="status" value="1" <?php if($ticket["status"]) : ?>checked="checked" <?php endif; ?>type="radio" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="richeditor">
        						<div class="editbar">
        							<button title="bold" onclick="wswgEditor.doClick('bold');" type="button"><b>B</b></button>
        							<button title="italic" onclick="wswgEditor.doClick('italic');" type="button"><i>I</i></button>
        							<button title="underline" onclick="wswgEditor.doClick('underline');" type="button"><u>U</u></button>
        							<button title="hyperlink" onclick="wswgEditor.doLink();" type="button" style="background-image:url('<?php static_url(); ?>js/libs/wysiwyg/images/url.gif');"></button>
        							<button title="image" onclick="wswgEditor.doImage();" type="button" style="background-image:url('<?php static_url(); ?>js/libs/wysiwyg/images/img.gif');"></button>
        							<button title="list" onclick="wswgEditor.doClick('InsertUnorderedList');" type="button" style="background-image:url('<?php static_url(); ?>js/libs/wysiwyg/images/icon_list.gif');"></button>
        						</div>
        						<div class="container">
        							<textarea id="reply-textarea" name="content" style="height:200px;width:100%;"></textarea>
        						</div>
        					</div>
        					<script type="text/javascript">
        						wswgEditor.initEditor("reply-textarea", true);
        					</script>
                        </td>
                    </tr>
                </table>
             </td>
        </tr>
    </table>
    
    <div class="submit-bar">
        <div class="align-right">
            <div class="align-right">
                <input type="submit" value="Resolve Ticket" onclick="wswgEditor.doCheck();" class="glob-button" />
            </div>
        </div>
        <br clear="all" />
    </div>
    </form>

<?php
	//Load the Admin Footer
	$this->load->view('administration/globals/admin_footer.php');
?>