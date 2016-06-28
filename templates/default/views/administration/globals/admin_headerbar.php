<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<html>
	<head>
		<link href="<?php static_url(); ?>css/administration_header.css" style="text/css" rel="stylesheet" />
	    <link href="<?php static_url(); ?>css/administration.css" style="text/css" rel="stylesheet" />
		<link rel="stylesheet" href="http://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css" />
		<script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
        <script src="<?php echo url(); ?>plugins/js/fury.js"></script>
    </head>
	<body>
        <div class="topnav">
            <ul class="nav-left">
                <li class="selected"><a href="<?php admin_url(); ?>frontpage/" target="body-frame">Admin CP</a></li>
                <li class="normal last"><a href="<?php url(); ?>" target="_parent">Site Home</a></li>
            </ul>
            <ul class="nav-right">
                <li><a href="<?php url(); ?>messages/inbox/" target="_blank">Messages</a></li>
                <li><a href="<?php url(); ?>user/logout/" target="_parent">Logout</a></li>
            </ul>
        </div>
		<div class="header">
			<div class="header-logo"></div>
		</div>
	</body>
</html>