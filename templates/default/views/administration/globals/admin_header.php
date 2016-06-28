<!doctype html>
<html>
	<head>
		<link href="<?php static_url(); ?>css/administration.css" style="text/css" rel="stylesheet" />
		<link rel="stylesheet" href="http://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css" />
		<script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
        <script src="http://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
        <script src="<?php echo url(); ?>plugins/js/fury.js"></script>
        <link  href="<?php echo url(); ?>plugins/js/libs/wysiwyg/editor.css" rel="Stylesheet" type="text/css" />
        <script type="text/javascript" src="<?php echo url(); ?>plugins/js/libs/wysiwyg/editor.js"></script>
        <script type="text/javascript">
            Fury.url = "<?php url(); ?>";
            Fury.admin_url = "<?php admin_url(); ?>";
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
	</head>
	<body>
		<div id="content">
			<div class="head">
				<?php echo $title; ?>
			</div>