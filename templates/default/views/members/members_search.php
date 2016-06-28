<?php

	//members_search_page template file
	//@author Irate Designs

	//Include the Global Files.
	$this->load->view('globals/global_header.php');
?>
	<div class="errors">
		<?php echo validation_errors(); ?>
	</div>
	<form action="" method="post">
		<table class="">
	        <tr>
	            <td class="left">
	                <select name="search_type" class="glob-select" style="width:150px;">
	                    <option value="username">Username</option>
	                </select>
	            </td>
	            <td>
	                <input type="text" name="value" class="glob-input" style="width:300px;"/>
	                <input type="submit" class="glob-button" value="Search" />
	            </td>
	        </tr>
	    </table>
		<div class="register">
			<div class="title">Members Search</div>
			<table class="register-table">
				<tr>
					<td class=""></td>
					<td class="td-left">Username</td>
					<td class="td-left">Location</td>
					<td class="td-left">Member Since</td>
					<td class="td-left">Contacts</td>
				</tr>
				<?php if($show_results): ?>
					<?php if(count($users) < 1): ?>
	                    <tr><td>No results for "<?php echo $search_value; ?>".</td></tr>
	                <?php else: ?>
					<?php foreach($users as $user): ?>
					<tr>
						<td class=""><img src="<?php static_url(); ?>theme/<?php echo settings('theme'); ?>/images/avatars/default.jpg" class="userbox-avatar-params" /></td>
						<td class="td-left"><?php echo $this->userinfo->get($user["id"], 'colored_username');?></td>
						<td class="td-left"><?php echo $user["location"]; ?></td>
						<td class="td-left"><?php echo date('F jS, Y', strtotime($user['created'])); ?></td>
						<td class="td-left">
							<?php if ($user["skype"]): ?>
					<a href="skype:<?php echo $user["skype"]?>?call"><img src="<?php static_url(); ?>theme/<?php echo settings('theme'); ?>/images/icons/Skype.png" /></a>
				<?php endif;?>
				<?php if ($user["facebook"]): ?>
					<a href="http://www.facebook.com/<?php echo $user["facebook"]?>"><img src="<?php static_url(); ?>theme/<?php echo settings('theme'); ?>/images/icons/Facebook.png" /></a>
				<?php endif;?>
				<?php if ($user["twitter"]): ?>
					<a href="https://twitter.com/<?php echo $user["twitter"]?>"><img src="<?php static_url(); ?>theme/<?php echo settings('theme'); ?>/images/icons/Twitter.png" /></a>
				<?php endif;?>
				<?php if ($user["youtube"]): ?>
					<a href="https://www.youtube.com/<?php echo $user["youtube"]?>"><img src="<?php static_url(); ?>theme/<?php echo settings('theme'); ?>/images/icons/youtube.png" /></a>
				<?php endif;?>
						</td>
					</tr>
					<?php endforeach; ?>
					<?php endif; ?>
				<?php endif; ?>
			</table>
		</div>
	</form>
<?php
	//Include the Global Footer:
	$this->load->view('globals/global_footer.php');
?>