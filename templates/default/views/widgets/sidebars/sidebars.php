<?php
    $this->db->order_by("orderid", "ASC");
    $this->db->where("enabled", "1");
    $sidebars = $this->db->get("sidebars");
    $sidebars = $sidebars->result_array();
?>
<?php foreach($sidebars as $sidebar): ?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><?php echo $sidebar["title"]; ?></h3>
    </div>
    <div class="panel-body">
    	<?php echo contentFix(htmlspecialchars_decode($sidebar["content"], ENT_NOQUOTES)); ?>
    </div>
</div>
<?php endforeach; ?>