<?php
	//Load the Admin Header
	$data["title"] = "Manage Galleries";
	$this->load->view('globals/admin_header.php', $data);
?>

	<div class="row">
      <div class="col-lg-12">
        <div class="text-right">
            <a href="<?php admin_url(); ?>galleries/addgallery/" class="btn btn-md btn-primary">
                New Gallery
            </a>
        </div>

            <div class="clearfix"></div>
            <br />
      </div>
    </div><!-- /.row -->



	<div class="col-lg-12">
            <div class="table-responsive">
              <table class="table table-bordered table-hover table-striped tablesorter">
                <thead>
                  <tr>
                    <th class="text-center">ID <i class="fa fa-sort"></i></th>
                    <th>Name <i class="fa fa-sort"></i></th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                    <?php foreach($galleries as $g): ?>
                    <tr>
                    <td class="text-center" width="10%">
                        <?php echo $g['id']; ?>
                    </td>
                    <td width="70%">
                        <?php echo $g["title"]; ?>
                    </td>
                    <td class="text-center">

                    <a href="<?php admin_url(); ?>galleries/viewgallery/<?php echo $g["id"]; ?>" class="btn btn-primary">View</a>
                    <a href="<?php admin_url(); ?>galleries/editgallery/<?php echo $g["id"]; ?>" class="btn btn-default">Edit</a>
                    <a href="#" onclick="Fury.Admin.ConfirmDelete('<?php admin_url(); ?>galleries/deletegallery/<?php echo $g["id"]; ?>');" class="btn btn-danger">Delete</a>
                
                    </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div><!-- /.row -->

<?php
	//Load the Admin Footer
	$this->load->view('globals/admin_footer.php');
?>