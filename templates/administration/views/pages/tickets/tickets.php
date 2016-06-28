<?php
	//Load the Admin Header
	$data["title"] = "Ticket Manager";
	$this->load->view('globals/admin_header.php', $data);
?>

	<div class="pagination">
		<?php echo $this->pagination->create_links(); ?>
	</div>

    <div class="col-lg-12">
            <div class="table-responsive">
              <table class="table table-bordered table-hover table-striped tablesorter">
                <thead>
                  <tr>
                    <th class="text-center">ID <i class="fa fa-sort"></th>
                    <th class="text-left">User <i class="fa fa-sort"></th>
                    <th class="text-left">Category <i class="fa fa-sort"></th>
                    <th class="text-left">Subject <i class="fa fa-sort"></th>
                    <th class="text-center">Date <i class="fa fa-sort"></th>
                    <th class="text-center">Status <i class="fa fa-sort"></th>
                    <th class="text-center">Options <i class="fa fa-sort"></th>
                  </tr>
                </thead>
                <tbody>
                    <?php 
                        foreach($tickets as $ticket):
                        //Get Category:
                        //-----------------------------------------
                        $this->db->where('id', $ticket["catid"]);
                        $catq = $this->db->get("ticket_categories");
                        
                        if($catq->num_rows < 1)
                        {
                            $cat_title = "OTHER";
                        } 
                        else
                        {
                            $cat = $catq->result_array();
                            $cat_title = $cat[0]["title"];
                        } 
                        //-----------------------------------------
                        if($ticket["status"] == 0)
                            $status = "<b><font color='green'>[OPEN]</font></b>"; 
                        elseif($ticket["status"] == 1)
                            $status = "<b><font color='red'>[CLOSED]</font></b>"; 
                    ?>
                    <tr>
                        <td class="text-center"><?php echo $ticket["id"]; ?></td>
                        <td class="text-left">
                            <a href="<?php admin_url(); ?>users/edit/<?php echo $ticket["userid"]; ?>">
                                <?php echo $this->userinfo->get($ticket["userid"], 'colored_username'); ?>
                            </a>
                        </td>
                        <td class="text-left"><?php echo $cat_title; ?></td>
                        <td class="text-left"><?php echo $ticket["subject"]; ?></td>
                        <td class="text-center"><?php echo date('F jS, Y', strtotime($ticket['created'])); ?></td>
                        <td class="text-center"><?php echo $status; ?></td>
                        <td class="text-center"><a href="<?php admin_url(); ?>tickets/view/<?php echo $ticket["id"]; ?>" class="btn btn-default">View Ticket</a></td>
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