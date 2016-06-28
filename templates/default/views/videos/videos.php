<?php
	//forums_home template file
	//@author Irate Designs
	//Include the Global Files.
	$data["extra_title"] = "Videos";
	$this->load->view('globals/global_header.php', $data);
?>

<ol class="breadcrumb">
  <li><a href="<?php url(); ?>">Home</a></li>
  <li class="active">Videos</li>
</ol>

<div class="row-fluid">
    <div class="col-lg-8">
        <div class="row-fluid">
            <?php 
                $count = 0;
                foreach($videos as $video): 
            ?>
            <div class="col-lg-6 well video-item">
                <div class="video-inner">
                    <a href="<?php url(); ?>videos/view/<?php echo $video['id']; ?>">
                        <img src="http://img.youtube.com/vi/<?php echo $video['source']; ?>/0.jpg" class="video-image" />
                        <div class="video-title"><?php echo $video['title']; ?></div>
                    </a>
                </div>
            </div>
            <?php if($count % 2 != 0): ?><div class="clear"></div><?php endif; ?>
            <?php 
                $count++;
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