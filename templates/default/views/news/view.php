<?php
    //forums_home template file
    //@author Irate Designs
    //Include the Global Files.
    foreach($news as $n):
    $data["extra_title"] = $n["title"];
	$this->load->view('globals/global_header.php', $data);
?>

<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
<script type="text/javascript">stLight.options({publisher: "5d067e52-a212-4bfd-ac2d-7f2827a0ab82", doNotHash: true, doNotCopy: true, hashAddressBar: false});</script>


<ol class="breadcrumb">
  <li><a href="<?php url(); ?>">Home</a></li>
  <li><a href="<?php url(); ?>news">News</a></li>
  <li class="active"><?php echo $n["title"];?></li>
</ol>

<div class="row-fluid">
    <div class="col-lg-8">
        <div class="row-fluid">
            <div class="col-lg-12 well post-box">
                <h2><?php echo $n["title"];?></h2>
                <small>Posted by <a href="<?php echo $this->userinfo->construct_profile_link($n['authorid']); ?>"><?php echo $this->userinfo->get($n['authorid'], 'colored_username');?></a> on <?php echo get_date($n['date']); ?></small>
                <hr />
                <div id="sharethis">
                    <span class='st_facebook_hcount' displayText='Facebook'></span>
                    <span class='st_twitter_hcount' displayText='Tweet'></span>
                    <span class='st_linkedin_hcount' displayText='LinkedIn'></span>
                    <span class='st_pinterest_hcount' displayText='Pinterest'></span>
                </div>
                <hr />
                <?php echo contentFix(htmlspecialchars_decode($n["content"], ENT_NOQUOTES)); ?>
            </div>
            <?php if(settings('show_facebook_comments')): ?>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Comments</h3>
                </div>
                <div class="panel-body">
                    <div class="fb-comments" data-href="<?php url(); ?>news/view/<?php echo $n["id"]; ?>" data-num-posts="6" data-width="677" data-colorscheme="light"></div>
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
    endforeach;
    //Include the Global Footer:
    $this->load->view('globals/global_footer.php');
?>