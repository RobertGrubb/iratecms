<?php
	//forums_home template file
	//@author Irate Designs
	//Include the Global Files.
	$data["extra_title"] = "Blogs";
	$this->load->view('globals/global_header.php', $data);
?>
<ol class="breadcrumb">
  <li><a href="<?php url(); ?>">Home</a></li>
  <li class="active">Blog Index</li>
</ol>

<div class="row-fluid">
    <div class="col-lg-8">
        <div class="row-fluid">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Blog Posts</h3>
                </div>
                <div class="panel-body">
                    <?php echo $this->pagination->create_links(); ?>
                    <hr />
                    <?php $count = 1; ?>
                    <?php foreach($blogs as $post): ?>
                    <div class="media">
                        <a class="pull-left" href="<?php url(); ?>blog/view/<?php echo $post["id"]; ?>">
                            <img class="media-object" src="<?php if(empty($post['image']) || is_null($post['image'])): ?><?php echo url(); ?>uploads/avatars/default.jpg<?php else: ?><?php echo url(); ?>uploads/blogs/<?php echo $post['image']; ?><?php endif; ?>" alt="<?php echo $post["title"]; ?>" width="100">
                        </a>
                        <div class="media-body">
                            <h4 class="media-heading"><a href="<?php url(); ?>blog/view/<?php echo $post["id"]; ?>"><?php echo $post["title"]; ?></a></h4>
                            <?php echo $post['short_desc']; ?>  
                            <br />
                            <small>Posted by <a href="<?php echo $this->userinfo->construct_profile_link($post['authorid']); ?>"><?php echo $this->userinfo->get($post['authorid'], 'colored_username');?></a> on <?php echo get_date($post['date']); ?></small>  
                        </div>
                    </div>
                    <?php if($count != count($blogs)): ?><hr /><?php endif; ?>
                    <?php $count ++; ?>
                    <?php endforeach; ?>
                    <hr />
                    <div class="pagination no-margin">
                        <?php echo $this->pagination->create_links(); ?>
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