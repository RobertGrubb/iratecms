<?php

	$url = 'http'.(isset($_SERVER['HTTPS'])?'s':'').'://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']);

	$url = str_replace("plugins/filemanager", "", $url);

	echo $url;
