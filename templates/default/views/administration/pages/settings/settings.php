<?php
	//Load the Admin Header
	$data["title"] = "Site Settings";
	$this->load->view('administration/globals/admin_header.php', $data);
?>
    <div class="alert info">
        <div class="icon"></div>
        <div class="clear"></div>
        <p>
            Use caution when editing these settings. Some edits may cause you to not access the site.
        </p>
    </div>

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
	<form action="" method="post">
        <?php foreach($sections as $section): ?>
        <table class="glob-table">
            <tr>
                <td>
                    <h3><?php echo $section["title"]; ?></h3>
                    <br />
            		<table class="glob-table">
                        <?php foreach($section["settings"] as $setting): ?>
                        <tr>
                            <td class="left"><?php echo $setting["title"]; ?></td>
                            <td>
                                <?php 
                                    //Run a switch through each Setting.
                                    //------------------------------------
                                    switch ($setting["input_type"])
                                    {
                                        //If setting uses the
                                        //text input:
                                        case 'text':
                                            echo '<input type="text" name="setting[' . $setting["variable"] . ']" class="glob-input" value="' . $setting["value"] . '" />';
                                            break;
                                            
                                        //If the setting uses the
                                        //select input:
                                        case 'select':
                                            //Start the select
                                            echo '<select name="setting[' . $setting["variable"] . ']" class="glob-select">';
                                            //Get the options from the setting
                                            $options = explode(',', $setting["options"]);
                                            //Iterate through each option
                                            foreach($options as $option)
                                            {
                                                $opt_params = explode('=>', $option);
                                                if(count($opt_params) == 2)
                                                {
                                                    $opt_title = $opt_params[0];
                                                    $opt_value = $opt_params[1];
                                                    //If the current option is the selected
                                                    if($setting["value"] == $opt_value)
                                                        echo '<option value="' . $opt_value . '" selected="selected">' . $opt_title . '</option>';
                                                    //Else just output a simple option.
                                                    else
                                                        echo '<option value="' . $opt_value . '">' . $opt_title . '</option>';
                                                }
                                            }
                                            echo '</select>';
                                            break;
                                            
                                        case 'radio':
                                            //Get the options from the setting
                                            $options = explode(',', $setting["options"]);
                                            //Iterate through each option
                                            foreach($options as $option)
                                            {
                                                $opt_params = explode('=>', $option);
                                                if(count($opt_params) == 2)
                                                {
                                                    $opt_title = $opt_params[0];
                                                    $opt_value = $opt_params[1];
                                                
                                                    //If the current option is the selected
                                                    if($setting["value"] == $opt_value)
                                                        echo '<input type="radio" name="setting[' . $setting["variable"] . ']" value="' . $opt_value . '" checked="checked" />' . $opt_title . ' ';
                                                    //Else just output a simple option.
                                                    else
                                                        echo '<input type="radio" name="setting[' . $setting["variable"] . ']" value="' . $opt_value . '" />' . $opt_title . ' ';
                                                }
                                            }
                                            break;
                                        
                                        //If the setting is using
                                        //the Textarea input.
                                        case 'textarea':
                                            echo '<textarea name="setting[' . $setting["variable"] . ']" class="glob-textarea">' . $setting["value"] . '</textarea>';
                                            break;
                                    }
                                    //------------------------------------
                                    if(!empty($setting["desc"]))
                                    {
                                        echo "<br /><i>" . $setting["desc"] . "</i>";
                                    }
                                ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </td>
            </tr>
        </table>
        <?php endforeach; ?>
        <br />
        <div class="submit-bar">
	        <div class="align-right">
	            <div class="align-right"><input type="submit" value="Save Settings" class="glob-button" /></div>
	        </div>
	        <br clear="all" />
	    </div>
	</form>
<?php
	//Load the Admin Footer
	$this->load->view('administration/globals/admin_footer.php');
?>