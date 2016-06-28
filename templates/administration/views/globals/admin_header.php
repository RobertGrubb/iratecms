<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo settings('site_title'); ?> AdminCP</title>


    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url(); ?>templates/administration/assets/css/bootstrap.css" rel="stylesheet">

    <link rel="stylesheet" href="http://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css" />
    <script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
        <script src="http://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>

    <script src="<?php echo base_url(); ?>templates/administration/assets/js/bootstrap.js"></script>

    <!-- Add custom CSS here -->
    <link href="<?php echo base_url(); ?>templates/administration/assets/css/sb-admin.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url(); ?>templates/administration/assets/font-awesome/css/font-awesome.min.css">
    <!-- Page Specific CSS -->
    <link rel="stylesheet" href="http://cdn.oesmith.co.uk/morris-0.4.3.min.css">
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
    <script type="text/javascript" src="<?php echo base_url(); ?>plugins/js/tinymce/tinymce.min.js"></script>
	<script type="text/javascript">
	tinymce.init({
	    selector: "textarea",
	    relative_urls : false,
	    plugins: [
	         "advlist autolink link image lists charmap print preview hr anchor pagebreak",
	         "searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
	         "table contextmenu directionality emoticons paste textcolor responsivefilemanager"
	   ],
	   toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect",
	   toolbar2: "| responsivefilemanager | link unlink anchor | image media | forecolor backcolor  | print preview code ",
	   image_advtab: true ,
	   
	   external_filemanager_path:"<?php echo base_url(); ?>plugins/filemanager/",
	   filemanager_title:"File Manager" ,
	   external_plugins: { "filemanager" : "<?php echo base_url(); ?>plugins/filemanager/plugin.min.js"}
	 });
	</script>
    <?php endif; ?>
  </head>

  <body>

    <div id="wrapper">

      <!-- Sidebar -->
      <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?php echo admin_url(); ?>">
          	<img src="<?php echo static_url(); ?>images/logo/logo.png" height="30" />
          </a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
          <ul class="nav navbar-nav side-nav">

            <?php

            //Get Navigation

            //Get the navigation sections:
			$nq  = $this->db->query("SELECT * FROM acp_nav_sections ORDER BY orderid ASC");
			//set the information to a variable:
			$nav = $nq->result_array();
			//Run through each section
			foreach($nav as $key => $row)
			{
			    //Set where clause:
                $this->db->where('secid', $row['id']);
                $this->db->order_by('orderid', 'ASC');
				//Retrieve the links from the database
				$linkq = $this->db->get('acp_nav_links');
				//Set the information to a sub-array of the navigation sections:
				$row["links"]   = $linkq->result_array();
				$nav[$key] 	    = $row;
			}

            ?>

            <?php foreach($nav as $n): ?>
			<?php if($this->acl->perm($n["perms"])): ?>
				<li class="dropdown">
	              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-caret-square-o-down"></i> <?php echo $n["title"]; ?> <b class="caret"></b></a>
	              <ul class="dropdown-menu">
					<?php foreach($n["links"] as $link): ?>
	                <?php if($this->acl->perm($link["perms"])): ?>
					<?php
	                    $action = $link["action"] . "/";
	                    if(!empty($link["sub_action"]))
	                        $action .= $link["sub_action"] . "/";
	                        
	                    if(!empty($link["options"]))
	                        $action .= $link["options"];
	                ?>
	                	<li><a href="<?php admin_url(); echo $action; ?>"><?php echo $link["title"]; ?></a></li>
	                <?php endif; ?>
					<?php endforeach; ?>
					</ul>
            	</li>
            
			<?php endif; ?>
			<?php endforeach; ?>
		  </ul>
          <ul class="nav navbar-nav navbar-right navbar-user">
            <li class="dropdown user-dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $this->session->userdata("username"); ?> <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="<?php echo $this->userinfo->construct_profile_link(); ?>"><i class="fa fa-user"></i> Profile</a></li>
                <li><a href="<?php url(); ?>messages/inbox/"><i class="fa fa-envelope"></i> Inbox <span class="badge"><?php echo $this->msgs->UnreadMessageNum(); ?></span></a></li>
                <li><a href="<?php url(); ?>user/edit/"><i class="fa fa-gear"></i> Settings</a></li>
                <li class="divider"></li>
                <li><a href="<?php url(); ?>user/logout/"><i class="fa fa-power-off"></i> Log Out</a></li>
              </ul>
            </li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </nav>


      <div id="page-wrapper">

      	<div class="row">
          <div class="col-lg-12">
            <h1><?php echo $title; ?></h1>
            <ol class="breadcrumb">
              <li class="active"><a href="<?php echo admin_url(); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
              <?php if($this->uri->segment(2)): ?>
				<li class="active"><?php echo ucfirst($this->uri->segment(2)); ?></li>
              <?php endif; ?>

              <?php if($this->uri->segment(3)): ?>
				<li class="active"><?php echo ucfirst($this->uri->segment(3)); ?></li>
              <?php endif; ?>
            </ol>
          </div>
        </div><!-- /.row -->