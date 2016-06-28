<!-- Start Advertisement -->
<ol class="breadcrumb">
	<li><a href="<?php url(); ?>forums/">Forums Home</a></li>
	<!-- Forum Title Navigation -->
	<?php if(!empty($f_title)): ?>
		<?php if(empty($t_title) && empty($title)): ?>
			<li class="active"><?php echo $f_title; ?></li>
		<?php else: ?>
			<li><a href="<?php url(); ?>forums/view/<?php echo $fid; ?>"><?php echo $f_title; ?></a></li>
		<?php endif; ?>
	<?php endif; ?>
	<!-- Thread Title Navigation -->
	<?php if(!empty($t_title)): ?>
	<li class="active"><?php echo $t_title; ?></li>
	<?php endif; ?>

	<!-- Custom Page Title -->
	<?php if(!empty($title)): ?>
	<li class="active"><?php echo $title; ?></li>
	<?php endif; ?>
</ol>