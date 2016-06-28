<?php
/**
 * Forum ACL Model
 **/
	class autoset extends CI_Model
	{

		public function __construct()
		{
			$this->set_theme();
		}

		public function set_theme()
		{

			echo "WOOHOO";

			//Load the config:
			$this->config->load('config', TRUE);
    		$theme = $this->config->item("theme");


			$this->db->where("variable", "theme");
			$setting = $this->db->get("settings");
			$setting = $setting->result_array();
			$setting = $setting[0];

			if(!is_null($setting["value"]) && !empty($setting["value"]) && $setting["value"] != $theme)
			{
				echo "Setting current theme to: " . $setting["value"];
				$current_theme = $setting["value"];
			}
			else
			{
				$current_theme = "default";
			}

			$this->config->set_item('theme', $current_theme);

			echo $current_theme;
			
		}

	}

?>