<?php
	//Load the Admin Header
	$data["title"] = "Manage Blog Posts";
	$this->load->view('globals/admin_header.php', $data);
?>
    <div class="row">
      <div class="col-lg-12">
        <div class="text-right">
            <a href="<?php admin_url(); ?>blogs/add/" class="btn btn-md btn-primary">
                New Blog
            </a>
        </div>

            <div class="clearfix"></div>
            <br />
      </div>
    </div><!-- /.row -->
    
    <div class="row">
      <div class="col-lg-12">
        <div class="alert alert-warning alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            Cover images for blog posts should be around 120x120 for best results. Remember to add a short description, as well!
        </div>
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
                    <?php foreach($blogs as $b): ?>
                    <tr>
                    <td class="text-center" width="10%">
                        <?php echo $b["id"]; ?>
                    </td>
                    <td width="70%">
                        <?php echo $b["title"]; ?>
                    </td>
                    <td class="text-center">

                    <a href="<?php admin_url(); ?>blogs/edit/<?php echo $b["id"]; ?>" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i> Edit</a>
                    <a href="#" onclick="Fury.Admin.ConfirmDelete('<?php admin_url(); ?>blogs/delete/<?php echo $b["id"]; ?>');" class="btn btn-sm btn-danger"><i class="fa fa-trash-o"></i> Delete</a>
                
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