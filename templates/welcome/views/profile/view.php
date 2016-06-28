<?php
	//forums_home template file
	//@author Irate Designs
	//Include the Global Files.
	$this->load->view('globals/global_header.php');
?>

<ol class="breadcrumb">
  <li><a href="<?php url(); ?>">Home</a></li>
  <li class="active"><?php echo ucfirst($user["username"]); ?>'s Profile</li>
</ol>

<div class="row-fluid">
    <div class="col-lg-8">
        <div class="row-fluid">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><?php echo ucfirst($user["username"]); ?>'s Profile</h3>
                </div>
                <div class="panel-body">
                    <div class="media">
                        <a class="pull-left" href="#">
                            <img class="media-object" src="<?php echo $this->userinfo->avatar($user["id"]); ?>" width="200">
                        </a>
                        <div class="media-body">
                            <h4 class="media-heading"><?php echo $user["username"]; ?></h4>
                            <hr class="profile-hr" />

                            <a href="<?php echo base_url(); ?>messages/inbox/<?php echo $user['username']; ?>#compose" class="btn btn-primary btn-sm">Send Message</a>
                            <?php if($this->userinfo->is_friends($user['id'])): ?>
                            <a href="<?php echo base_url(); ?>user/removefr/<?php echo $user['id']; ?>" class="btn btn-primary btn-sm">Remove Friend</a>
                            <?php elseif($this->userinfo->is_pending($user['id'])): ?>
                            <a href="<?php echo base_url(); ?>user/cancelfr/<?php echo $user['id']; ?>" class="btn btn-primary btn-sm">Cancel Request</a>
                            <?php else: ?>
                            <a href="<?php echo base_url(); ?>user/sendfr/<?php echo $user['id']; ?>" class="btn btn-primary btn-sm">Add Friend</a>
                            <?php endif; ?>

                            <hr class="profile-hr" />

                            <?php if(!empty($user['skype'])): ?>
                              <span><a href="skype:<?php echo $user["skype"]; ?>?call"><i class="fa fa-facebook"></i> <?php echo $user["skype"]; ?></a></span>
                              <hr class="profile-hr" />
                           <?php endif; ?>
                           
                           <?php if(!empty($user['youtube'])): ?>
                              <span><a href="http://www.youtube.com/<?php echo $user["youtube"]; ?>"><i class="fa fa-youtube"></i> <?php echo $user["youtube"]; ?></a></span>
                              <hr class="profile-hr" />
                           <?php endif; ?>
                           
                           <?php if(!empty($user['twitter'])): ?>
                              <span><a href="http://www.twitter.com/<?php echo $user["twitter"]; ?>"><i class="fa fa-twitter"></i> @<?php echo $user["twitter"]; ?></a></span>
                              <hr class="profile-hr" />
                           <?php endif; ?>


                            <?php if(!empty($user['bio'])): ?>
                            <?php echo $user['bio']; ?>
                            <?php else: ?>
                            Bio unavailable.
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Friends</h3>
                </div>
                <div class="panel-body">
                    <?php if(count($friends) < 1): ?>
                        <center>Sorry, nothing to see here!</center>
                    <?php else: ?>
                        <?php foreach($friends as $friend): ?>
                            <a href="<?php echo base_url(); ?>profile/<?php echo $this->userinfo->get($friend, "username"); ?>"><img src="<?php echo $this->userinfo->avatar($friend); ?>" width="80" height="80" style="margin-right: 10px;background:#000;" /></a>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>

            <div class="col-lg-12 well">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#threads" data-toggle="tab">Threads</a></li>
                    <li><a href="#posts" data-toggle="tab">Posts</a></li>
                </ul>
                <div class="tab-content">
                    <div id="threads" class="tab-pane active">
                        <div class="profile-activity">
                            <?php if(count($threads) < 1): ?>
                                <center>Sorry, nothing to see here!</center>
                            <?php else: ?>
                            <?php foreach($threads as $thread): ?>
                            <div class="item">Created thread <a href="<?php echo base_url(); ?>threads/view/<?php echo $thread['id']; ?>"><?php echo $thread["title"]; ?></a></div>
                            <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div id="posts" class="tab-pane">
                        <div class="profile-activity">
                            <?php if(count($posts) < 1): ?>
                                <center>Sorry, nothing to see here!</center>
                            <?php else: ?>
                            <?php foreach($posts as $post): ?>
                            <?php
                                $this->db->where("id", $post["tid"]);
                                $t = $this->db->get("threads");
                                $t = $t->result_array();
                                $t = $t[0];
                            ?>
                            <div class="item">Posted on <a href="<?php echo base_url(); ?>threads/view/<?php echo $t['id']; ?>"><?php echo $t["title"]; ?></a></div>
                            <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
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