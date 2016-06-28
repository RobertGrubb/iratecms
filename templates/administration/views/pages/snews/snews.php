<?php
	//Load the Admin Header
	$data["title"] = "Manage Site News";
	$this->load->view('globals/admin_header.php', $data);
?>


    <div class="row">
      <div class="col-lg-12">
        <div class="text-right">
            <a href="<?php admin_url(); ?>snews/addnews/" class="btn btn-md btn-primary">
                New Article
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
                    <?php foreach($news as $n): ?>
                    <tr>
                    <td class="text-center" width="10%">
                        <?php echo $n["id"]; ?>
                    </td>
                    <td width="70%">
                        <?php echo $n["title"]; ?>
                    </td>
                    <td class="text-center">

                    <a href="<?php admin_url(); ?>snews/edit/<?php echo $n["id"]; ?>" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i> Edit</a>
                    <a href="#" onclick="Fury.Admin.ConfirmDelete('<?php admin_url(); ?>snews/delete/<?php echo $n["id"]; ?>');" class="btn btn-sm btn-danger"><i class="fa fa-trash-o"></i> Delete</a>
                
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