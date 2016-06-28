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
				<td><input type="text" name="title" class="glob-input" value="<?php echo $t["title"]; ?>" /></td>
			</tr>
            <tr>
                <td class="left" valign="top">Start Date</td>
                <td><input type="text" name="start_date" class="glob-input" id="datepicker" value="<?php echo $t["start_date"]; ?>" /></td>
            </tr>
            <tr>
                <td class="left" valign="top">End Date</td>
                <td><input type="text" name="end_date" class="glob-input" id="datepicker2" value="<?php echo $t["end_date"]; ?>" /></td>
            </tr>
            <tr>
				<td class="left" valign="top">Active</td>
				<td>
                    <select name="active" class="glob-select">
                        <option value="1" <?php if($t["active"]){echo " selected='selected'";} ?>>Yes</option>
                        <option value="0" <?php if(!$t["active"]){echo " selected='selected'";} ?>>No</option>
                    </select>
                </td>
			</tr>
            <tr>
				<td class="left" valign="top">Join Status</td>
				<td>
                    <select name="status" class="glob-select">
                        <option value="1" <?php if($t["status"]){echo " selected='selected'";} ?>>Open</option>
                        <option value="0" <?php if(!$t["status"]){echo " selected='selected'";} ?>>Closed</option>
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
                                    <option value="<?php echo $a['id']; ?>" <?php if($t["arenaid"] == $a["id"]){echo " selected='selected'";} ?>><?php echo $a['title']; ?></option>
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
                        <option value="1" <?php if($t["stream_enabled"]){echo " selected='selected'";} ?>>Yes</option>
                        <option value="0" <?php if(!$t["stream_enabled"]){echo " selected='selected'";} ?>>No</option>
                    </select>
                </td>
			</tr>
            <tr>
				<td class="left" valign="top">TwitchTV Username</td>
				<td><input type="text" name="twitch_stream_username" class="glob-input" value="<?php echo $t["twitch_stream_username"]; ?>" /></td>
			</tr>
			<tr>
				<td class="left" valign="top">Description</td>
				<td>
                    <textarea id="reply-textarea" name="description" class="glob-textarea" style="height:150px;"><?php echo $t["description"]; ?></textarea>
				</td>
			</tr>
            <tr>
				<td class="left" valign="top">Prize</td>
				<td>
                    <textarea id="prize-textarea" name="prize" class="glob-textarea" style="height:150px;"><?php echo $t["prize"]; ?></textarea>
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
							<textarea id="rules-textarea" name="rules" style="height:500px;width:100%;"><?php echo $t["rules"]; ?></textarea>
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
                    <select name="max_teams" class="glob-select">
                        <option value="4" <?php if($t["max_teams"] == 4){echo " selected='selected'";} ?>>4</option>
                        <option value="8" <?php if($t["max_teams"] == 8){echo " selected='selected'";} ?>>8</option>
                        <option value="16" <?php if($t["max_teams"] == 16){echo " selected='selected'";} ?>>16</option>
                        <option value="32" <?php if($t["max_teams"] == 32){echo " selected='selected'";} ?>>32</option>
                        <option value="64" <?php if($t["max_teams"] == 64){echo " selected='selected'";} ?>>64</option>
                    </select>
				</td>
			</tr>
            <tr>
				<td class="left" valign="top">Teams Joined</td>
				<td>
                    <?php echo $team_num; ?>
				</td>
			</tr>
            <tr>
				<td class="left" valign="top">View Team</td>
				<td>
                    <select id="team_id" style="float: left;" class="glob-select">
                        <?php foreach($teams as $team): ?>
                            <option value="<?php echo $team["id"]; ?>"><?php echo $team["name"]; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <input type="button" class="glob-button" style="float: left;margin-left:5px;"  value="View Team" onclick="window.location.href = '<?php admin_url(); ?>tournaments/view_team/'+$('#team_id option:selected').val();" />
				</td>
			</tr>
            <?php if($t["bracket_generated"]): ?>
            <tr>
				<td class="left" valign="top">Show Brackets</td>
				<td>
                    <select name="show_brackets" class="glob-select">
                        <option value="1" <?php if($t["show_brackets"]){echo " selected='selected'";} ?>>Yes</option>
                        <option value="0" <?php if(!$t["show_brackets"]){echo " selected='selected'";} ?>>No</option>
                    </select>
                </td>
			</tr>
            <tr>
                <td class="left" valign="top">Brackets</td>
                <td>

                    <a href="<?php admin_url(); ?>tournaments/generate_bracket/<?php echo $t["id"]; ?>" class="glob-button">Regenerate Bracket (<font color="red">REMOVES ALL MATCH RESULTS!</font>)</a>
                    <br /><br />
                    <small><i>Bracket Updates after ever alteration. Please edit carefully.</i></small><br />
                    <script>
                        var saveData = {
                            <?php if(!empty($t["bracket_data"])){echo $t["bracket_data"];}else{echo'"teams":[["",""]],"results":[[null,null]]';} ?>
                        
                        }
                        function saveFn(data, userData) {
                          var json = JSON.stringify(data)
                          //You can also inquiry the current data
                          $.ajax({
                                url: "<?php url(); ?>tournaments/update_bracket/<?php echo $t["id"]; ?>",
                                type: "POST",
                                data: "data="+json
                          })
                        }
                        $(function() {
                            var container = $('div#brackets')
                            container.bracket({
                              init: saveData,
                              save: saveFn,
                              userData: ""})
                          })
                    </script>
                	<div id="brackets"></div>

                </td>
            </tr>
            <?php else: ?>
            <tr>
				<td class="left" valign="top">Bracket</td>
				<td>
                    <a href="<?php admin_url(); ?>tournaments/generate_bracket/<?php echo $t["id"]; ?>" class="glob-button">Generate Bracket</a>
                </td>
			</tr>
            <?php endif; ?>
			<tr>
				<td class="left" valign="top"></td>
				<td>
					<input type="submit" value="Save Tournament" onclick="wswgEditor.doCheck();" class="glob-button" />
				</td>
			</tr>
		</table>
	</form>
<?php
	//Load the Admin Footer
	$this->load->view('administration/globals/admin_footer.php');
?>