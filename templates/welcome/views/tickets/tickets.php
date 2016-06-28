<?php
	//forums_home template file
	//@author Irate Designs
	//Include the Global Files.
	$this->load->view('globals/global_header.php');
?>

<ol class="breadcrumb">
  <li><a href="<?php url(); ?>">Home</a></li>
  <li class="active">Tickets</li>
</ol>
    
<div class="row-fluid">
    <div class="col-lg-8">
        <div class="row-fluid">
            <div class="col-lg-12 well">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs">
              <li class="active"><a href="#tickets" data-toggle="tab">My Tickets</a></li>
              <li><a href="#new" data-toggle="tab">New Ticket</a></li>
            </ul>
            <div class="tab-content">
                <div id="tickets"  class="tab-pane active">
                <table class="table table-bordered">
        			<thead>
        				<tr>
        					<th>Category</th>
        					<th class="td-left">Subject</th>
        					<th>Date</th>
                            <th>Status</th>
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
                                $cat_id    = 0;
                            }
                            else
                            {
                                $cat = $catq->result_array();
                                $cat_title = $cat[0]["title"];
                                $cat_id    = $cat[0]["id"];
                            }
                            //-----------------------------------------
                            
                            
                            if($ticket["status"] == 0)
                                $status = '<b><font color="green">[OPEN]</font></b>';
                            elseif($ticket["status"] == 1)
                                $status = '<b><font color="red">[CLOSED]</font></b>';
                        ?>
                        <tr>
                            <td class="td-center"><?php echo $cat_title; ?></td>
                            <td class="td-left"><a href="<?php url(); ?>tickets/view/<?php echo $ticket["id"]; ?>"><?php echo $ticket["subject"]; ?></a></td>
                            <td class="td-center"><?php echo date('F jS, Y', strtotime($ticket['created'])); ?></td>
                            <td class="td-center"><?php echo $status; ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div id="new" class="tab-pane">
                <div class="errors">
            		<?php echo validation_errors(); ?>
            		<?php
            			if(!empty($error) && $error != null)
            				echo "<p>" . $error . "</p>";
            		?>
            	</div>
                <form action="<?php url(); ?>tickets/all/#new" method="post">
                    <table class="table table-bordered">
                        <tr>
                            <td>Category: </td>
                            <td>
                                <select name="category" class="form-control">
                                    <?php foreach($categories as $cat): ?>
                                        <option value="<?php echo $cat["id"]; ?>"><?php echo $cat["title"]; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Subject: </td>
                            <td><input type="text" name="subject" class="form-control" /></td>
                        </tr>
                        <tr>
                            <td>Proof: </td>
                            <td>
                                <input type="text" name="url[1]" class="form-control" placeholder="Url #1" /><br />
                                <input type="text" name="url[2]" class="form-control" placeholder="Url #2" /><br />
                                <input type="text" name="url[3]" class="form-control" placeholder="Url #3" /><br />
                                <input type="text" name="url[4]" class="form-control" placeholder="Url #4" /><br />
                                <input type="text" name="url[5]" class="form-control" placeholder="Url #5" /><br />
                                <small><i>Provide image/vide proof by leaving the urls above.</i></small>
                            </td>
                        </tr>
                        <tr>
                            <td valign="top">Message: </td>
                            <td>
            					<textarea id="reply-textarea" class="form-control" name="content" style="height:500px;width:100%;"></textarea>

                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><input type="submit" class="btn btn-primary btn-sm" /></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
        </div>

    </div>
    </div>
    <!-- Right Content -->
    <div class="col-lg-4">
        <div class="row-fluid">
            <?php $this->load->view("widgets/sidebars/sidebars"); ?>
        </div>
    </div>
</div>     
    
    
<?php
	//Include the Global Footer:
	$this->load->view('globals/global_footer.php');
?>