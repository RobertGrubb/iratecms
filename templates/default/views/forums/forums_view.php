<?php

	//forums_home template file
	//@author Irate Designs

	//Include the Global Files.
	foreach($forum as $f):
    $data["extra_title"] = $f["title"];
	$this->load->view('globals/global_header.php', $data);
	$this->load->view('forums/forums_nav.php', $nav);
?>
<div class="row-fluid">
    <div class="col-lg-8">
        <div class="row-fluid">
        	<div class="panel panel-primary">
	                <div class="panel-heading">
	                    <h3 class="panel-title"><?php echo $f["title"]; ?></h3>
	                </div>
	                <div class="panel-body">
						<?php if($this->session->userdata('logged_in')): ?>
							<a href="<?php url(); ?>forums/createthread/<?php echo $f["id"]; ?>" class="btn btn-primary btn-sm">New Thread</a>
						<?php endif; ?>
						<hr />
						<?php echo $this->pagination->create_links(); ?>
							<table class="table table-bordered">
					            <?php if(count($threads) >= 1): ?>
								<thead>
									<tr>
										<th class="visible-lg"></th>
										<th class="thead_align_left">Thread Title</th>
										<th>Replies/Views</th>
										<th class="visible-lg">Last Poster</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach($threads as $thread): ?>
									<tr>
										<td class="visible-lg">
											<div class="forum_img"></div>
										</td>
										<td class="forum_name">
											<a href="<?php url(); ?>threads/view/<?php echo $thread["id"]; ?>">
												<?php if($thread["type"] == 1): ?><span class="label label-primary">Sticky</span> <?php endif; ?>
											<?php echo $thread["title"]; ?></a>
											<br />
											<span class="f-desc"><i>Created by <a href="<?php echo $this->userinfo->construct_profile_link($thread["userid"]); ?>"><?php echo $this->userinfo->get($thread["userid"], 'username'); ?></a>
										    on <?php echo get_date($thread['date']); ?></i></span>
										</td>
										<td class="forum_posts">
											Replies: <?php echo replyCount($thread["id"]); ?>
											<br />
											Views: <?php echo getViews($thread['id']); ?>
										</td>
										<?php if(getLatestReply($thread["id"]) != null): ?>
										<?php $latestReply = getLatestReply($thread["id"]); ?>
										<td class="forum_posted_by visible-lg">
											Last post by: <a href="<?php echo $this->userinfo->construct_profile_link($latestReply["userid"]); ?>"><?php echo $this->userinfo->get($latestReply["userid"], 'username'); ?></a>
											<br />
											<?php echo get_date($latestReply['date']); ?>
										</td>
										<?php else: ?>
										<td class="forum_posted_by visible-lg">
											No replies
										</td>
										<?php endif; ?>
									</tr>
									<?php endforeach; ?>
					                <?php else: ?>
					                <tr>
					                    <td>Sorry, but there are no threads in this forum.</td>
					                </tr>
					                <?php endif; ?>
								</tbody>
							</table>
					
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