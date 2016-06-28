<?php
	//Load the Admin Header
	

    //Get the Number of Users:
    $uq = $this->db->get("users");
    //Get the Number of rows:
    $num_users = $uq->num_rows();
    //Get the admin news:
    $this->db->order_by('date', 'desc');
    $acp_news = $this->db->get("acp_news");
    $news = $acp_news->result_array();
    //Get Members today:
    $mtq = $this->db->query("SELECT * FROM users WHERE created >= CURDATE() AND created < (CURDATE() + INTERVAL 1 DAY)");
    $mems_today = $mtq->num_rows();
?>

    <div class="row">
      <div class="col-lg-12">
        <div class="alert alert-success alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          Welcome to the new Irate CMS Administration Panel. We have worked very hard to bring you the next best admin panel. Look forward to many updates that will allow you to
          administrate your site more than ever!  
        </div>
      </div>
    </div><!-- /.row -->

    <div class="row">
      <div class="col-lg-6">
        <div class="panel panel-info">
          <div class="panel-heading">
            <div class="row">
              <div class="col-xs-6">
                <i class="fa fa-users fa-5x"></i>
              </div>
              <div class="col-xs-6 text-right">
                <p class="announcement-heading"><?php echo $num_users; ?></p>
                <p class="announcement-text">Total Members!</p>
              </div>
            </div>
          </div>
          <!--
          <a href="#">
            <div class="panel-footer announcement-bottom">
              <div class="row">
                <div class="col-xs-6">
                  View Members
                </div>
                <div class="col-xs-6 text-right">
                  <i class="fa fa-arrow-circle-right"></i>
                </div>
              </div>
            </div>
          </a>
          -->
        </div>
      </div>

      <div class="col-lg-6">
        <div class="panel panel-warning">
          <div class="panel-heading">
            <div class="row">
              <div class="col-xs-6">
                <i class="fa fa-plus-circle fa-5x"></i>
              </div>
              <div class="col-xs-6 text-right">
                <p class="announcement-heading"><?php echo $mems_today; ?></p>
                <p class="announcement-text">Joined Today!</p>
              </div>
            </div>
          </div>
          <!--
          <a href="#">
            <div class="panel-footer announcement-bottom">
              <div class="row">
                <div class="col-xs-6">
                  View Today's Members
                </div>
                <div class="col-xs-6 text-right">
                  <i class="fa fa-arrow-circle-right"></i>
                </div>
              </div>
            </div>
          </a>
          -->
        </div>
      </div>
    </div>


    <?php if(count($news) >= 1): ?>
    <?php foreach($news as $n): ?>


    <div class="row">
      <div class="col-lg-12">
        <div class="panel panel-primary">
          <div class="panel-heading">
            <h3 class="panel-title"><i class="fa fa-edit"></i> <?php echo $n["title"]; ?></h3>
          </div>
          <div class="panel-body">
            <?php echo parse_bbcode($n['content']); ?>
          </div>
          <div class="panel-footer text-right">
            Posted by <?php echo $this->userinfo->get($n['userid'], 'colored_username'); ?> on <?php echo date('F jS, Y g:i:s a T', strtotime($n['date'])); ?>&nbsp;&nbsp;&nbsp;
        </div>
        </div>
      </div>
    </div><!-- /.row -->

    <?php endforeach; ?>
    <?php endif; ?>

