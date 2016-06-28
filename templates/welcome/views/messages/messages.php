<?php
	//forums_home template file
	//@author Irate Designs
	//Include the Global Files.
	$this->load->view('globals/global_header.php');
?>

<ol class="breadcrumb">
  <li><a href="<?php url(); ?>">Home</a></li>
  <li class="active">Messages</li>
</ol>
    
<div class="row-fluid">
    <div class="col-lg-8">
        <div class="row-fluid">
            <div class="col-lg-12 well">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs">
              <li class="active"><a href="#allmessages" data-toggle="tab">Conversations</a></li>
              <li><a href="#frequests" data-toggle="tab">Friend Requests</a></li>
              <li><a href="#compose" data-toggle="tab">Compose</a></li>
            </ul>
            <div class="tab-content">
                <div id="allmessages"  class="tab-pane active">
                    <form action="<?php url(); ?>messages/delete/" method="post">
                        <div class="table-responsive mail-box">
                            <div class='pull-left'>
                                <?php echo $this->pagination->create_links(); ?>
                            </div>
                            <input type="submit" class="btn btn-primary pull-right btn-sm" value="Delete Selected" />
                            <div class="clearfix"></div>
                            <hr class="profile-hr" />

                            <table class="table table-bordered">
                    			<thead>
                    				<tr>
                    					<th></th>
                    					<th>Recipient</th>
                    					<th class="td-left">Subject</th>
                    					<th>Date</th>
                                        <th></th>
                    				</tr>
                    			</thead>
                                <tbody>
                                    <?php foreach($messages as $message): ?>
                                    <tr>
                                        <td>
                                            <?php if($message["sendid"] == $this->session->userdata('userid') && !$message["sender_read"] || 
                                                     $message["recvid"] == $this->session->userdata('userid') && !$message["recv_read"]): ?>
                                                <div class="newmail"></div>
                                            <?php else: ?>
                                                <div class="oldmail"></div>
                                            <?php endif; ?>
                                        </td>
                                        <td class="td-center">
                                            <a href="#">
                                                <?php if($message["sendid"] == $this->session->userdata('userid')): ?>
                                                <?php echo $this->userinfo->get($message['recvid'], 'username'); ?>
                                                <?php else: ?>
                                                <?php echo $this->userinfo->get($message['sendid'], 'username'); ?>
                                                <?php endif; ?>
                                            </a>
                                        </td>
                                        <td class="td-left"><a href="<?php url(); ?>messages/convo/<?php echo $message["id"]; ?>"><?php echo $message["title"]; ?></a></td>
                                        <td class="td-center"><?php echo date('F jS, Y g:i:s a T', $message['last_reply_date']); ?></td>
                                        <td class="td-center"><input type="checkbox" name="messages[<?php echo $message["id"]; ?>]" /></td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>
                <div id="frequests"  class="tab-pane">
                    <table  class="table table-bordered">
                			<thead>
                				<tr>
                					<th width="20"></th>
                					<th style="text-align: left;">From</th>
                                    <th width="150" class="td-center"></th>
                				</tr>
                			</thead>
                            <tbody>
                                <?php if(count($requests) < 1): ?>
                                    <tr><td colspan="3"><center>No friend requests pending.</center></td></tr>
                                <?php else: ?>
                                    <?php foreach($requests as $rq): ?>
                                    <tr>
                                        <td>
                                            <div class="newmail"></div>
                                        </td>
                                        <td>
                                            <a href="<?php echo $this->userinfo->construct_profile_link($rq["userid"]); ?>">
                                                <?php echo $this->userinfo->get($rq["userid"], "colored_username"); ?>
                                            </a>
                                        </td>
                                        <td class="td-center">
                                            <a href="<?php echo base_url(); ?>messages/acceptfr/<?php echo $rq['userid']; ?>" class="btn btn-primary btn-sm">
                                                Accept
                                            </a> 
                                            <a href="<?php echo base_url(); ?>messages/declinefr/<?php echo $rq['userid']; ?>" class="btn btn-primary btn-sm">
                                                Decline
                                            </a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                </div>
                <div id="compose"  class="tab-pane">
                    <div class="errors">
                		<?php echo validation_errors(); ?>
                		<?php
                			if(!empty($error) && $error != null)
                				echo "<p>" . $error . "</p>";
                		?>
                	</div>
                    <form action="<?php url(); ?>messages/inbox/#compose" method="post" class="form-horizontal" role="form">
                        <table class="table table-bordered">
                            <tr>
                                <td>To: </td>
                                <td><input type="text" name="username" class="form-control" value="<?php echo $this->uri->segment(3); ?>" /></td>
                            </tr>
                            <tr>
                                <td>Subject: </td>
                                <td><input type="text" name="title" class="form-control" /></td>
                            </tr>
                            <tr>
                                <td valign="top">Message: </td>
                                <td>
                					<textarea class="form-control" name="message" style="height:500px;width:100%;"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><input type="submit" class="btn btn-primary btn-sm" /></td>
                            </tr>
                        </table>
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