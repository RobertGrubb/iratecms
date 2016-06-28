<?php
	//Load the Admin Header
	$data["title"] = "Manage Videos";
	$this->load->view('globals/admin_header.php', $data);
?>

    <div class="row">
      <div class="col-lg-12">
        <div class="text-right">
            <a href="<?php admin_url(); ?>videos/add/" class="btn btn-md btn-primary">
                New Video
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
          At this time, the videos system only supports <a href="http://www.youtube.com">YouTube</a> videos.  
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
                    <?php foreach($videos as $v): ?>
                    <tr>
                    <td class="text-center" width="10%">
                        <?php echo $v['id']; ?>
                    </td>
                    <td width="70%">
                        <?php echo $v["title"]; ?>
                    </td>
                    <td class="text-center">

                    <a href="<?php admin_url(); ?>videos/edit/<?php echo $v["id"]; ?>" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i> Edit</a>
                    <a href="#" onclick="Fury.Admin.ConfirmDelete('<?php admin_url(); ?>videos/delete/<?php echo $v["id"]; ?>');" class="btn btn-sm btn-danger"><i class="fa fa-trash-o"></i> Delete</a>
                
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