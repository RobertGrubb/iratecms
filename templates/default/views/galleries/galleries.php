<?php
	//forums_home template file
	//@author Irate Designs
	//Include the Global Files.
	$data["extra_title"] = "Galleries";
	$this->load->view('globals/global_header.php', $data);
?>

<ol class="breadcrumb">
  <li><a href="<?php url(); ?>">Home</a></li>
  <li class="active">Galleries</li>
</ol>

<div class="row-fluid">
    <div class="col-lg-8">
        <div class="row-fluid">
            <?php foreach($galleries as $gallery): ?>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"> <a href="<?php echo url(); ?>galleries/view/<?php echo $gallery["id"]; ?>/<?php echo url_title($gallery["title"]); ?>"><?php echo $gallery["title"]; ?></a></h3>
                </div>
                <div class="panel-body">
                    <div class="slideshow" data-cycle-fx="carousel" data-cycle-timeout="1000">
                        <?php
                            $this->db->where("galleryid", $gallery["id"]);
                            $this->db->limit(6);
                            $images = $this->db->get("gallery_images");
                            $images = $images->result_array();
                            foreach($images as $image):
                        ?>
                        <img src="<?php echo url(); ?>uploads/galleries/thumbnails/<?php echo $image["thumbnail"]; ?>" class="gallery-carousel-img" />
                        <?php endforeach; ?>
                    </div>
                    <div class="gallery-button">
                        <a href="<?php echo url(); ?>galleries/view/<?php echo $gallery["id"]; ?>/<?php echo url_title($gallery["title"]); ?>" class="btn btn-primary btn-sm pull-right">View</a>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    <!-- Right Content -->
    <div class="col-lg-4">
        <div class="row-fluid">
            <?php $this->load->view("widgets/sidebars/sidebars"); ?>
        </div>
    </div>
</div>

<!--
<div class="f-nav">
    <ul>
        <li><a href="<?php url(); ?>">Home</a></li>
        <li>&#8594;</li>
        <li><a href="<?php url(); ?>blog">Blog Index</a></li>
    </ul>
</div>



<div id="left-content">
    <div class="full-block">
        <div class="title">Galleries</div>
        <div class="inner">
                <div id="gallery-preview">
                    <?php foreach($galleries as $gallery): ?>
                        <div class="item">
                            <div class="title">
                                <a href="<?php echo url(); ?>galleries/view/<?php echo $gallery["id"]; ?>/<?php echo url_title($gallery["title"]); ?>"><?php echo $gallery["title"]; ?></a>
                            </div>
                            <div class="image-canvas">
                                <?php
                                    $this->db->where("galleryid", $gallery["id"]);
                                    $this->db->limit(6);
                                    $images = $this->db->get("gallery_images");
                                    $images = $images->result_array();
                                    foreach($images as $image):
                                ?>
                                
                                <a href="<?php echo url(); ?>galleries/view/<?php echo $gallery["id"]; ?>/<?php echo url_title($gallery["title"]); ?>"><div class="gimage" style="background: #222 url('<?php echo url(); ?>uploads/galleries/thumbnails/<?php echo $image["thumbnail"]; ?>') center center no-repeat;"></div></a>
                                
                                <?php endforeach; ?>
                                <div class="clear"></div>
                            </div>
                            
                                <div class="view">
                                    <a href="<?php echo url(); ?>galleries/view/<?php echo $gallery["id"]; ?>/<?php echo url_title($gallery["title"]); ?>" class="fancy-button">View Gallery &gt;&gt;</a>
                                </div>
                        </div>
                    <?php endforeach; ?>
                </div>
        </div>
    </div>
</div>

<div id="right-content">
    <?php $this->load->view("widgets/sidebars/sidebars"); ?>
</div>
-->
<?php
	//Include the Global Footer:
	$this->load->view('globals/global_footer.php');
?>