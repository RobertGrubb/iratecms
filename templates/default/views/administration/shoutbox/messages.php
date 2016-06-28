<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<html>
	<head>
		<link href="<?php static_url(); ?>theme/<?php echo settings('theme'); ?>/administration_shoutbox.css" style="text/css" rel="stylesheet" />
		<link rel="stylesheet" href="http://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css" />
		<script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
    </head>
	<body>
        <div id="message-container">
            <div class="item">
                <div class="avatar">
                    <img src="<?php static_url(); ?>theme/<?php echo settings('theme'); ?>/images/avatars/default.jpg" class="avatar-params" />
                </div>
                <div class="content">
                    <b>Irate</b>:
                    <hr />
                    This is a hard-coded message strictly for testing the sizing of the message item.
                </div>
                <br clear="all" />
            </div>
            <div class="item">
                <div class="avatar">
                    <img src="<?php static_url(); ?>theme/<?php echo settings('theme'); ?>/images/avatars/default.jpg" class="avatar-params" />
                </div>
                <div class="content">
                    <b>Irate</b>:
                    <hr />
                    This is a hard-coded message strictly for testing the sizing of the message item.
                </div>
                <br clear="all" />
            </div>
        </div>
	</body>
</html>