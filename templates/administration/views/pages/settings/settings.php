<?php
	//Load the Admin Header
	$data["title"] = "Site Settings";
	$this->load->view('globals/admin_header.php', $data);
?>
    <div class="row">
      <div class="col-lg-12">
        <div class="alert alert-warning alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          Attention! Use caution when editing the following settings. Changing certain options may show unwanted results.
        </div>
      </div>
    </div><!-- /.row -->

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
	<form >
    <form role="form" action="" method="post">
        <?php foreach($sections as $section): ?>

        <div class="panel panel-info">
          <div class="panel-heading">
            <?php echo $section["title"]; ?>
          </div>

          <div class="panel-body">

            <?php foreach($section["settings"] as $setting): ?>

            <div class="form-group">
                <label><?php echo $setting["title"]; ?></label>
                <?php 
                    //Run a switch through each Setting.
                    //------------------------------------
                    switch ($setting["input_type"])
                    {
                        //If setting uses the
                        //text input:
                        case 'text':
                            echo '<input type="text" name="setting[' . $setting["variable"] . ']"  class="form-control" value="' . $setting["value"] . '" />';
                            break;
                            
                        //If the setting uses the
                        //select input:
                        case 'select':
                            //Start the select
                            echo '<select name="setting[' . $setting["variable"] . ']"  class="form-control">';
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
                                        echo '<br /><input type="radio" name="setting[' . $setting["variable"] . ']" value="' . $opt_value . '" checked="checked" />' . $opt_title . ' ';
                                    //Else just output a simple option.
                                    else
                                        echo '<br /><input type="radio" name="setting[' . $setting["variable"] . ']" value="' . $opt_value . '" />' . $opt_title . ' ';
                                }
                            }
                            break;
                        
                        //If the setting is using
                        //the Textarea input.
                        case 'textarea':
                            echo '<textarea name="setting[' . $setting["variable"] . ']" class="form-control">' . $setting["value"] . '</textarea>';
                            break;
                    }
                    //------------------------------------
                    if(!empty($setting["desc"]))
                    {
                        echo "<p class='help-block'>" . $setting["desc"] . "</p>";
                    }
                ?>                        
            </div>
            <hr />
            <?php endforeach; ?>
            </div>
            </div>
            
        <?php endforeach; ?>

        <div class="text-right">
            <button type="submit" class="btn btn-default">Save Settings</button>
        </div>
	</form>
<?php
	//Load the Admin Footer
	$this->load->view('globals/admin_footer.php');
?>