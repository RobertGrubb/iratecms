<!doctype html>
<html>
    <head>
        <title><?php if(isset($extra_title) && !empty($extra_title)): ?><?php echo $extra_title; ?> - <?php endif; ?><?php echo settings('site_title'); ?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="<?php static_url(); ?>css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="<?php static_url(); ?>css/font-awesome.min.css"/>
        <link rel="stylesheet" href="<?php echo base_url(); ?>plugins/js/libs/ui-lightness/jquery-ui-1.9.1.custom.min.css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>plugins/bootstrap-wysihtml5.css" />
        <meta name="description" content="<?php echo settings('site_desc'); ?>" />
        <meta name="keywords" content="<?php echo settings('site_keywords'); ?>" />
        <?php if('show_facebook_comments'): ?>
        <meta property="fb:app_id" content="<?php echo settings('facebook_app_id'); ?>" />
        <?php endif; ?>
        <link href="<?php static_url(); ?>css/style.css" type="text/css" rel="stylesheet" />
        <link rel="stylesheet" href="<?php echo url(); ?>plugins/lightbox/magnific-popup.css"> 
    </head>
    <body>
        <?php if(settings('show_facebook_comments')): ?>
        <script>(function(d, s, id) {
              var js, fjs = d.getElementsByTagName(s)[0];
              if (d.getElementById(id)) return;
              js = d.createElement(s); js.id = id;
              js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=<?php echo settings('facebook_app_id'); ?>";
              fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));
        </script>
        <?php endif; ?>
        <div class="navbar navbar-inverse navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="logo-link" href="<?php echo base_url(); ?>"><img src="<?php static_url(); ?>images/logo/logo.png" height="50" alt="logo"/></a>
                </div>
                <div class="navbar-collapse collapse">
                    <ul class="nav navbar-nav navbar-right" id="nav">
                        <li class="parent">
                            <a href="<?php url(); ?>">Home</a>
                        </li>
                        <?php 
                        echo $this->navigation->general_links();   
                        ?>
                        <?php if($this->session->userdata('logged_in')): ?>
                        <li>
                            <a href="javascript:void(0);" id="dropdownMenu1" data-toggle="dropdown"><?php echo $this->session->userdata("username"); ?> <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                                <?php if($this->acl->accesscp()): ?>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php admin_url(); ?>">Administration Panel</a></li>
                                <li role="presentation" class="divider"></li>
                                <?php endif; ?>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo $this->userinfo->construct_profile_link(); ?>">My Profile</a></li>
                                <li role="presentation" class="divider"></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php url(); ?>messages/inbox/">My Inbox (<?php echo $this->msgs->UnreadMessageNum(); ?>)</a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php url(); ?>messages/inbox/#compose">Compose a Message</a></li>
                                <li role="presentation" class="divider"></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php url(); ?>messages/inbox/#frequests">Friend Requests (<?php echo $this->userinfo->frnum(); ?>)</a></li>
                                <li role="presentation" class="divider"></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php url(); ?>tickets/all/">My Support Tickets</a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php url(); ?>tickets/all/#new">New Support Ticket</a></li>
                                <li role="presentation" class="divider"></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php url(); ?>user/edit/">Edit Account</a></li>
                                <li role="presentation" class="divider"></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php url(); ?>user/logout/">Log Out</a></li>
                            </ul>
                        </li>
                        <?php else: ?>
                        <li><a href="<?php url(); ?>user/login/">Login</a></li>
                        <li><a href="<?php url(); ?>user/register/">Register</a></li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="head-space"></div>
        <?php $this->load->view("widgets/homepage/slider.php"); ?>
        <!-- Start Content Area -->
        <div id="content-area">
            <div class="container">
                <div class="content-inner">