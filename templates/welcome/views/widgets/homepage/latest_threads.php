<?php
    $this->db->limit(6);
    $this->db->order_by("date", "DESC");
    $threads = $this->db->get("threads");
    $num_threads = $threads->num_rows();
    $threads = $threads->result_array();
?>
<!-- Start HTML: WIDGET // Latest Threads -->
<div class="panel panel-default half-panel" style="margin-left:10px;">
    <div class="panel-heading">
        <h3 class="panel-title">Forum Activity</h3>
    </div>
    <div class="panel-body">
        <?php if($num_threads < 1): ?>
            <b>Sorry, no threads were found.</b>
        <?php else: ?>
            <div id="lt">
            <?php foreach($threads as $thread): ?>
                    <div class="item">
                        <a href="<?php echo base_url(); ?>threads/view/<?php echo $thread['id']; ?>" class="title"><?php echo $thread['title']; ?></a><br />
                        <div class="desc">Posted by <a href="<?php echo $this->userinfo->construct_profile_link($thread['userid']); ?>"><?php echo $this->userinfo->get($thread['userid'], "colored_username"); ?></a> on <?php echo get_date($thread['date']); ?></div>
                    </div>
            <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</div>
<!-- End HTML: WIDGET // Latest Threads -->