<?php
	//Load the Admin Header
	$data["title"] = "View Gallery";
	$this->load->view('globals/admin_header.php', $data);
?>


    <form role="form" action="<?php echo admin_url(); ?>/galleries/addimages/<?php echo $galleryid; ?>" method="post" enctype="multipart/form-data">

        <div class="panel panel-info">
          <div class="panel-heading">
            Upload Images
          </div>

          <div class="panel-body">

            <div class="form-group">
                <label>Upload Images</label>
                <input type="file" name="userfile[]" multiple="multiple" class="form-control" />
            </div>

            <hr />

            <div class="text-right">
                <button type="submit" class="btn btn-primary">Upload</button>
            </div>

           </div>
          </div>
          
    </form>

    <hr />


    <?php $count=1; ?>
        <?php foreach($images as $i): ?>
        <?php if($count == 1): ?>
            <div class="row">
        <?php endif; ?>


            <div class="col-lg-3">
                <img src="<?php echo url(); ?>uploads/galleries/<?php echo $i["image"]; ?>" class="img-thumbnail" width="100%" />
                <div class="well text-center">
                    <a href="<?php admin_url(); ?>/galleries/deleteimage/<?php echo $i["id"]; ?>" class="btn btn-sm btn-danger">Remove Image</a>
                </div>
            </div>
        
        <?php if($count == 4): ?>
            </div>
            <hr />
        <?php endif; ?>

        <?php if($count == 4): ?>
            <?php $count = 1; ?>
        <?php else: ?>
            <?php $count++; ?>
        <?php endif; ?>
        <?php endforeach; ?>


<?php
	//Load the Admin Footer
	$this->load->view('globals/admin_footer.php');
?>