<?php
	//Load the Admin Header
	$data["title"] = "Manage Blog Posts";
	$this->load->view('administration/globals/admin_header.php', $data);
?>

	<div class="submit-bar">
        <div class="align-right">
            <div class="align-right">
                <form action="<?php echo admin_url(); ?>/galleries/addimages/<?php echo $galleryid; ?>" method="post" enctype="multipart/form-data">
                    <div class="inputWrapper">
                        <input type="file" name="userfile[]" multiple="multiple" />
                    </div>
                    <div class="submit_options_bar">
                        <input type="submit" class="glob-button" id="upload-button" value="Add Images" />
                    </div>
                </form>
            </div>
        </div>
        <br clear="all" />
    </div>
    <br />
    <div id="gallery">
        <?php foreach($images as $i): ?>
        <div class="image-outter">
        
            <div class="image-inner">
                <div class="image" style="background: url('<?php echo url(); ?>uploads/galleries/<?php echo $i["image"]; ?>') center center no-repeat;">
                    <div class="image-options"><a href="<?php admin_url(); ?>/galleries/deleteimage/<?php echo $i["id"]; ?>" class="glob-button">Delete</a></div>
                </div>
            </div>
        
        </div>
        <?php endforeach; ?>
    </div>
<?php
	//Load the Admin Footer
	$this->load->view('administration/globals/admin_footer.php');
?>