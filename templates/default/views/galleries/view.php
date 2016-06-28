<?php
	//forums_home template file
	//@author Irate Designs
	//Include the Global Files.
	$data["extra_title"] = $gallery["title"];
	$this->load->view('globals/global_header.php', $data);
?>

<ol class="breadcrumb">
  <li><a href="<?php url(); ?>">Home</a></li>
  <li class="active">Gallery: <?php echo $gallery["title"]; ?></li>
</ol>

<div class="row-fluid">
    <div class="col-lg-8">
        <div class="row-fluid">
            <?php foreach($images as $i): ?>
                <div class="col-lg-3 col-sm-4 col-6">
                    <a href="<?php echo url(); ?>uploads/galleries/<?php echo $i["image"]; ?>" class="thumbnail gallery-modal">
                         <img src="<?php echo url(); ?>uploads/galleries/thumbnails/<?php echo $i["thumbnail"]; ?>" class="gallery-img" />
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="clearfix"></div>
        <?php if(settings('show_facebook_comments')): ?>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Comments</h3>
                </div>
                <div class="panel-body">
                    <div class="fb-comments" data-href="<?php url(); ?>galleries/view/<?php echo $gallery["id"]; ?>/<?php echo url_title($gallery["title"]); ?>" data-num-posts="6" data-width="677" data-colorscheme="light"></div>
                </div>
            </div>
        <?php endif; ?>
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