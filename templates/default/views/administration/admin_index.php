<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<html>
	<head>
		<title><?php echo settings('site_title'); ?> AdminCP</title>
		<link href="<?php static_url(); ?>css/administration.css" style="text/css" rel="stylesheet" />
        <script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
        <script src="http://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
        <?php if($this->acl->accesscp()): ?>
        <script src="<?php echo url(); ?>plugins/js/fury.js"></script>
        <script type="text/javascript">
            Fury.url = "<?php url(); ?>";
            Fury.admin_url = "<?php admin_url(); ?>";
            //Call the credential checker.
            $(document).ready(function(){
               Fury.Core.Credentials(4); //Param: Seconds it runs again. 
            });
        </script>
        <?php endif; ?>
	</head>
	<?php if($this->acl->accesscp()): ?>
		<frameset rows="90, *" frameborder="no">
			<frame src="<?php admin_url(); ?>header/" noresize="noresize" scrolling="no" id="header-frame">
			<frameset cols="250, *" frameborder="no" id="main-frame">
			    <frame src="<?php admin_url(); ?>navigation/" noresize="noresize" name="nav-frame" id="nav-frame">
			    <frame src="<?php admin_url(); ?>frontpage/" noresize="noresize" name="body-frame" id="body-frame">
			    <noframes>
			  		Your browser does not support frames.
			    </noframes>
			</frameset>
		</frameset>
	<?php endif; ?>
	<body>
		<?php if(!$this->acl->loggedIn()): ?>
		<!-- Do HTML Work inside of here. -->
        <?php $this->session->set_flashdata('redirect', '/administration/'); ?>
		<form action="<?php url(); ?>user/login/" method="post">
			<div id="login-box">
				<div class="title">Administrator Login</div>
				<table align="center" class="login-table">
					<tr>
						<td><input type="text" class="input" name="username" placeholder="Username" /></td>
					</tr>
					<tr>
						<td><input type="password" class="input" name="password" placeholder="Password" /></td>
					</tr>
					<tr>
						<td align="right"><input type="submit" class="button" value="Login" /></td>
					</tr>
				</table>
			</div>
		</form>
		<!-- End HTML work -->
		<?php endif; ?>
	</body>
</html>