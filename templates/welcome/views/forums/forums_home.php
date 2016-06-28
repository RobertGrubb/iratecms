<?php

	//forums_home template file
	//@author Irate Designs

	//Include the Global Files.
	$data["extra_title"] = "Forums Home";
	$this->load->view('globals/global_header.php', $data);
    $this->load->view('forums/forums_nav.php');
?>

<div class="row-fluid">
    <div class="col-lg-8">
        <div class="row-fluid">
			<?php
				
				foreach($categories as $cat):

			?>
			   
			    <?php if($this->acl->access("categories", $cat["id"])): ?>
				<div class="panel panel-primary">
	                <div class="panel-heading">
	                    <h3 class="panel-title"><?php echo $cat["title"]; ?></h3>
	                </div>
	                <div class="panel-body">
						<table class="table table-bordered">
							<thead>
								<tr>
									<th class="visible-lg"></th>
									<th>Forum name</th>
									<th>Threads</th>
				                    <th>Posts</th>
									<th class="visible-lg">Latest Post</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach($cat["forums"] as $forum): ?>
									<?php if($this->acl->access("forums", $forum["id"])): ?>
									<?php $latestPost = getLatestPost($forum["id"]); ?>
										<tr>
											<td class="visible-lg">
												<div class="forum_img"></div>
											</td>
											<td class="forum_name">
												<a href="<?php url(); ?>forums/view/<?php echo $forum["id"]; ?>"><?php echo $forum["title"]; ?></a>
												<br />
												<span class="f-desc"><?php echo $forum["desc"]; ?></span>
											</td>
											<td class="forum_topics">
												<?php echo forumThreadCount($forum["id"]); ?>
											</td>
				                            <td class="forum_posts">
				                                <?php echo forumPostCount($forum["id"]); ?>
				                            </td>
											<td class="forum_posted_by visible-lg">
												<?php if(!$latestPost): ?>
													No posts in this forum.
												<?php else: ?>
												<a href="<?php echo url(); ?>threads/view/<?php echo $latestPost["tid"]; ?>"><?php echo $latestPost["t_title"]; ?></a>
												<br />
												Last post by: <a href="<?php echo $this->userinfo->construct_profile_link($latestPost["userid"]); ?>"><?php echo $latestPost["username"]; ?></a>
												<?php endif; ?>
											</td>
										</tr>
									<?php endif; ?>
								<?php endforeach; ?>
							</tbody>
						</table>
					</div>
				</div>
			    <?php endif; ?>
			<?php
				endforeach;
			    
			?>
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