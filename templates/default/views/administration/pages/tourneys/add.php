<?php
	//Load the Admin Header
	$data["title"] = "Edit Tournament";
	$this->load->view('administration/globals/admin_header.php', $data);
?>
	<div class="errors">
		<?php echo validation_errors(); ?>
		<?php
			if(!empty($error) && $error != null)
				echo "<p>" . $error . "</p>";
		?>
	</div>
	<div class="msg">
		<?php
			if(!empty($msg) && $msg != null)
				echo "<p>" . $msg . "</p>";
		?>
	</div>
    <script>
    $(function() {
        $( "#datepicker" ).datepicker();
        $( "#datepicker2" ).datepicker();
    });
    </script>
	<form action="" method="post">
		<table class="glob-table">
			<tr>
				<td class="left" valign="top">Title</td>
				<td><input type="text" name="title" class="glob-input" value="" /></td>
			</tr>
            <tr>
                <td class="left" valign="top">Start Date</td>
                <td><input type="text" name="start_date" class="glob-input" id="datepicker" /></td>
            </tr>
            <tr>
                <td class="left" valign="top">End Date</td>
                <td><input type="text" name="end_date" class="glob-input" id="datepicker2" /></td>
            </tr>
            <tr>
				<td class="left" valign="top">Active</td>
				<td>
                    <select name="active" class="glob-select">
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                    </select>
                </td>
			</tr>
            <tr>
				<td class="left" valign="top">Join Status</td>
				<td>
                    <select name="status" class="glob-select">
                        <option value="1">Open</option>
                        <option value="2">Closed</option>
                    </select>
                </td>
			</tr>
            <tr>
				<td class="left" valign="top">Arena</td>
				<td>
                    <select name="arenaid" class="glob-select">
                        <?php foreach($platforms as $p): ?>
                            <optgroup label="<?php echo $p['title']; ?>">
                                <?php foreach($p['arenas'] as $a): ?>
                                    <option value="<?php echo $a['id']; ?>"><?php echo $a['title']; ?></option>
                                <?php endforeach; ?>
                            </optgroup>
                        <?php endforeach; ?>
                    </select>
                </td>
			</tr>
            <tr>
				<td class="left" valign="top">Stream Enabled</td>
				<td>
                    <select name="stream_enabled" class="glob-select">
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                    </select>
                </td>
			</tr>
            <tr>
				<td class="left" valign="top">TwitchTV Username</td>
				<td><input type="text" name="twitch_stream_username" class="glob-input" value="" /></td>
			</tr>
			<tr>
				<td class="left" valign="top">Description</td>
				<td>
                    <textarea id="reply-textarea" name="description" class="glob-textarea" style="height:150px;"></textarea>
				</td>
			</tr>
            <tr>
				<td class="left" valign="top">Prize</td>
				<td>
                    <textarea id="prize-textarea" name="prize" class="glob-textarea" style="height:150px;"></textarea>
				</td>
			</tr>
            <tr>
				<td class="left" valign="top">Rules</td>
				<td>
                    <div class="richeditor">
						<div class="editbar">
							<button title="bold" onclick="wswgEditor.doClick('bold');" type="button"><b>B</b></button>
							<button title="italic" onclick="wswgEditor.doClick('italic');" type="button"><i>I</i></button>
							<button title="underline" onclick="wswgEditor.doClick('underline');" type="button"><u>U</u></button>
							<button title="hyperlink" onclick="wswgEditor.doLink();" type="button" style="background-image:url('<?php static_url(); ?>js/libs/wysiwyg/images/url.gif');"></button>
							<button title="image" onclick="wswgEditor.doImage();" type="button" style="background-image:url('<?php static_url(); ?>js/libs/wysiwyg/images/img.gif');"></button>
							<button title="list" onclick="wswgEditor.doClick('InsertUnorderedList');" type="button" style="background-image:url('<?php static_url(); ?>js/libs/wysiwyg/images/icon_list.gif');"></button>
						</div>
						<div class="container">
							<textarea id="rules-textarea" name="rules" style="height:500px;width:100%;"></textarea>
						</div>
					</div>
					<script type="text/javascript">
						wswgEditor.initEditor("rules-textarea", true);
					</script>
				</td>
			</tr>
            <tr>
				<td class="left" valign="top">Max Teams</td>
				<td>
                    <select id="max_teams" class="glob-select">
                        <option value="4">4</option>
                        <option value="8">8</option>
                        <option value="16">16</option>
                        <option value="32">32</option>
                        <option value="64">64</option>
                    </select>
				</td>
			</tr>
			<tr>
				<td class="left" valign="top"></td>
				<td>
					<input type="submit" value="Add Tournament" onclick="wswgEditor.doCheck();" class="glob-button" />
				</td>
			</tr>
		</table>
	</form>
<?php
	//Load the Admin Footer
	$this->load->view('administration/globals/admin_footer.php');
?>