<?php
	//forums_home template file
	//@author Irate Designs
	//Include the Global Files.
    foreach($video as $v):
    $data["extra_title"] = $v["title"];
	$this->load->view('globals/global_header.php', $data);
?>


<ol class="breadcrumb">
  <li><a href="<?php url(); ?>">Home</a></li>
  <li class="active">Video: <?php echo $v["title"];?></li>
</ol>

<div class="row-fluid">
    <div class="col-lg-8">
        <div class="row-fluid">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><?php echo $v["title"];?></h3>
                </div>
                <div class="panel-body">
                    <div class="flex-video widescreen">
                        <iframe width="677" height="381" src="//www.youtube.com/embed/<?php echo $v['source']; ?>" frameborder="0" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
            <?php if(settings('show_facebook_comments')): ?>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Comments</h3>
                </div>
                <div class="panel-body">
                    <div class="fb-comments" data-href="<?php url(); ?>videos/view/<?php echo $v["id"]; ?>" data-num-posts="6" data-width="677" data-colorscheme="light"></div>
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