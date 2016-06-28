<?php
	//Load the Admin Header
	$data["title"] = "Pages Manager";
	$this->load->view('globals/admin_header.php', $data);
?>
    <div class="row">
      <div class="col-lg-12">
        <div class="text-right">
            <a href="<?php admin_url(); ?>pages/newpage/" class="btn btn-md btn-primary">
                New Page
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
            To access pages you make, you use the callname you provide in the page settings. Example: http://www.yoursite.com/<i>callname</i>
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
                    <?php foreach($pages as $page): ?>
                    <tr>
                    <td class="text-center" width="10%">
                        <?php echo $page['id']; ?>
                    </td>
                    <td width="60%">
                        <?php echo $page["title"]; ?>
                    </td>
                    <td class="text-center">
                    <a href="<?php url(); ?><?php echo $page["callname"]; ?>" target="_blank" class="btn btn-success">View Page</a>
                    <a href="<?php admin_url(); ?>pages/editpage/<?php echo $page["id"]; ?>" class="btn btn-primary">Edit</a>
                    <a href="#" onclick="Fury.Admin.ConfirmDelete('<?php admin_url(); ?>pages/deletepage/<?php echo $page["id"]; ?>');" class="btn btn-danger">Delete</a>
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