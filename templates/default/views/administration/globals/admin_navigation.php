<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<html>
	<head>
		<link href="<?php static_url(); ?>css/administration_navigation.css" style="text/css" rel="stylesheet" />
		<script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
        <script src="<?php echo url(); ?>plugins/js/libs/jquery.cookie.js"></script>
		<script src="<?php echo url(); ?>plugins/js/fury.js"></script>
	</head>
	<body>
		<?php foreach($nav as $n): ?>
			<?php if($this->acl->perm($n["perms"])): ?>
            <script type="text/javascript">
                $(document).ready(function(){
                    Fury.Admin.CheckNav('nav-<?php echo $n["id"]; ?>');
                });
            </script>
			<div class="nav-header" onclick="Fury.Admin.ToggleNav('nav-<?php echo $n["id"]; ?>');">
				<?php echo $n["title"]; ?>
			</div>
			<div class="nav-content" id="nav-<?php echo $n["id"]; ?>">
				<?php foreach($n["links"] as $link): ?>
                <?php if($this->acl->perm($link["perms"])): ?>
				<?php
                    $action = $link["action"] . "/";
                    if(!empty($link["sub_action"]))
                        $action .= $link["sub_action"] . "/";
                        
                    if(!empty($link["options"]))
                        $action .= $link["options"];
                ?>
                <a href="<?php admin_url(); echo $action; ?>" target="body-frame">
                    <div class="nav-item">
                        <?php echo $link["title"]; ?>
                    </div>
                </a>
                <?php endif; ?>
				<?php endforeach; ?>
			</div>
			<?php endif; ?>
		<?php endforeach; ?>
	</body>
</html>