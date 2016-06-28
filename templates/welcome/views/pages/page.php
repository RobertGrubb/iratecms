<?php
	//forums_home template file
	//@author Irate Designs
	//Include the Global Files.
	$data["extra_title"] = $title;
	$this->load->view('globals/global_header.php', $data);
?>

<ol class="breadcrumb">
  <li><a href="<?php url(); ?>">Home</a></li>
  <li class="active"><?php echo $title; ?></li>
</ol>

<?php if($template == "full"): ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"><?php echo $title; ?></h3>
        </div>
        <div class="panel-body">
            <?php echo contentFix(htmlspecialchars_decode($content, ENT_NOQUOTES)); ?>
        </div>
    </div>
    <?php if(settings('show_facebook_comments')): ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Comments</h3>
            </div>
            <div class="panel-body">
                <div class="fb-comments" data-href="<?php url(); ?><?php echo $callname; ?>" data-num-posts="6" data-width="677" data-colorscheme="light"></div>
            </div>
        </div>
    <?php endif; ?>
<?php elseif($template == "sidebars"): ?>
<div class="row-fluid">
    <div class="col-lg-8">
        <div class="row-fluid">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><?php echo $title; ?></h3>
                </div>
                <div class="panel-body">
                    <?php echo htmlspecialchars_decode(contentFix($content), ENT_NOQUOTES); ?>
                </div>
            </div>
            <?php if(settings('show_facebook_comments')): ?>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Comments</h3>
                </div>
                <div class="panel-body">
                    <div class="fb-comments" data-href="<?php url(); ?><?php echo $callname; ?>" data-num-posts="6" data-width="677" data-colorscheme="light"></div>
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
<?php endif; ?>
    
<?php
	//Include the Global Footer:
	$this->load->view('globals/global_footer.php');
?>