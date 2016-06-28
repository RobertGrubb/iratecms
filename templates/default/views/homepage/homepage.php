<?php

	//home_page template file
	//@author Irate Designs

	//Include the Global Files.
	$this->load->view('globals/global_header.php');
?>
    <div class="row-fluid">
        <div class="col-lg-8">
            <div class="row-fluid">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Latest News</h3>
                    </div>
                    <div class="panel-body">
                        <?php $count = 1; ?>
                        <?php foreach($news as $post): ?>
                        <div class="media">
                            <a class="pull-left" href="<?php url(); ?>news/view/<?php echo $post["id"]; ?>">
                                <img  src="<?php if(empty($post['image']) || is_null($post['image'])): ?><?php echo url(); ?>uploads/avatars/default.jpg<?php else: ?><?php echo url(); ?>uploads/news/<?php echo $post['image']; ?><?php endif; ?>" alt="<?php echo $post["title"]; ?>"  width="100"/>
                            </a>
                            <div class="media-body">
                                <h4 class="media-heading"><a href="<?php url(); ?>news/view/<?php echo $post["id"]; ?>"><?php echo $post["title"]; ?></a></h4>
                                <?php echo $post['short_desc']; ?> <br />
                                <small>Posted by <a href="<?php echo $this->userinfo->construct_profile_link($post['authorid']); ?>"><?php echo $this->userinfo->get($post['authorid'], 'colored_username');?></a> on <?php echo get_date($post['date']); ?></small> 
                            </div>
                        </div>
                        <?php if($count != count($news)): ?><hr /><?php endif; ?>
                        <?php $count ++; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="panel panel-default half-panel hidden-sm hidden-xs hidden-md">
                    <div class="panel-heading">
                        <h3 class="panel-title">Facebook</h3>
                    </div>
                    <div class="panel-body">
                        <iframe src="//www.facebook.com/plugins/likebox.php?href=<?php echo $settings['facebook_url']; ?>&amp;width=327&amp;height=316&amp;colorscheme=light&amp;show_faces=true&amp;border_color=%23DDDDDD&amp;stream=false&amp;header=false&amp;appId=233947343289787" scrolling="no" frameborder="0" style="border:none; overflow:hidden; height: 316px; width: 327px" allowTransparency="true"></iframe>
                    </div>
                </div>
                <?php $this->load->view("widgets/homepage/latest_threads.php"); ?>
                <div class="clearfix"></div>
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