<?php
	//Load the Admin Header
	$data["title"] = "Administration Index";
	$this->load->view('administration/globals/admin_header.php', $data);
?>

    <div class="glob-left-box">
        <div class="stat-inner">
            <center>
                <h1>Total Members</h1>
                <h1><?php echo $num_users; ?></h1>
            </center>
        </div>
    </div>	
    
    <div class="glob-right-box">
        <div class="stat-inner">
            <center>
                <h1>Members Joined Today</h1>
                <h1><?php echo $mems_today; ?></h1>
            </center>
        </div>    
    </div>
    <br clear="all" />
    <br />
    <?php if(count($news) >= 1): ?>
    <?php foreach($news as $n): ?>
    <table class="glob-table">
        <tr>
            <td>
                <h3><?php echo $n["title"]; ?></h3>
                <hr />
                    <?php echo parse_bbcode($n['content']); ?>
                <hr />
                <div class="glob-padded-box">
                    Posted by <?php echo $this->userinfo->get($n['userid'], 'colored_username'); ?> on <?php echo date('F jS, Y g:i:s a T', strtotime($n['date'])); ?>&nbsp;&nbsp;&nbsp;
                </div>
            </td>
        </tr>
    </table>
    <?php endforeach; ?>
    <?php endif; ?>

<?php
	//Load the Admin Footer
	$this->load->view('administration/globals/admin_footer.php');
?>