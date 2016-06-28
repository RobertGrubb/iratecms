<?php

	//members_list_page template file
	//@author Irate Designs

	//Include the Global Files.
	$this->load->view('globals/global_header.php');
?>

	<div class="register">
		<div class="title">Members List</div>
		<div class="left" style="margin-top: 7px;">
                    <div id="msg-pagination">
                		<?php echo $this->pagination->create_links(); ?>
                	</div>
                </div>
		<table class="register-table">
			<tr>
				<td class=""></td>
				<td class="td-left td-center">Username</td>
				<td class="td-left td-center">Location</td>
				<td class="td-left td-center">Member Since</td>
				<td class="td-left td-center">Contacts</td>
			</tr>
			<?php foreach($info as $uinfo):?>
			<tr>
				<td class=""><img src="<?php static_url(); ?>theme/<?php echo settings('theme'); ?>/images/avatars/default.jpg" class="userbox-avatar-params" /></td>
				<td class="td-left td-center"><?php echo $this->userinfo->get($uinfo["id"], 'colored_username');?></td>
				<td class="td-left td-center"><?php echo $uinfo["location"];?></td>
				<td class="td-left td-center"><?php echo date('F jS, Y', strtotime($uinfo['created'])); ?></td>
				<td class="td-left td-center">
				<?php if ($uinfo["skype"]): ?>
					<a href="skype:<?php echo $uinfo["skype"]?>?call"><img src="<?php static_url(); ?>theme/<?php echo settings('theme'); ?>/images/icons/Skype.png" /></a>
				<?php endif;?>
				<?php if ($uinfo["facebook"]): ?>
					<a href="http://www.facebook.com/<?php echo $uinfo["facebook"]?>"><img src="<?php static_url(); ?>theme/<?php echo settings('theme'); ?>/images/icons/Facebook.png" /></a>
				<?php endif;?>
				<?php if ($uinfo["twitter"]): ?>
					<a href="https://twitter.com/<?php echo $uinfo["twitter"]?>"><img src="<?php static_url(); ?>theme/<?php echo settings('theme'); ?>/images/icons/Twitter.png" /></a>
				<?php endif;?>
				<?php if ($uinfo["youtube"]): ?>
					<a href="https://www.youtube.com/<?php echo $uinfo["youtube"]?>"><img src="<?php static_url(); ?>theme/<?php echo settings('theme'); ?>/images/icons/youtube.png" /></a>
				<?php endif;?>
				</td>
			</tr>
			<?php endforeach;?>
		</table>
		
	</div>

<?php
	//Include the Global Footer:
	$this->load->view('globals/global_footer.php');
?>