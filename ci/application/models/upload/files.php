<?php
/**
 * Upload Model
 **/
	class files extends CI_Model
	{

        /**
    	 * @Method: process_options()
    	 * @Info: Returns configuration for
    	 *        Image Upload.
    	 **/
    	private function process_settings($directory = null)
    	{   
    	//  upload an image options
    	    $config = array();
            $config['max_size']	= '9999';
            if(!is_null($directory))
            {
                $config['upload_path'] = './uploads/' . $directory . '/';
            }
    	    else
            {
                $config['upload_path'] = './uploads/images/';
            }
    		$config['allowed_types'] = 'gif|jpg|png';
    		$config['file_name'] = time() . "_" . rand(10,100);
    	    return $config;
    	}
    
    	/**
    	 * @Method: process()
    	 * @Info: Upload image submitted
    	 *        from the form.
    	 **/
    	function process($directory = null)
    	{
    		//Load the upload library
    	    $this->load->library('upload');
    	    //Load the image library
    	    $this->load->library('image_lib');
    	    //Set output to empty by default
    	    $output = ""; 
            //Initialize the uploader with the config settings
    	    $this->upload->initialize($this->process_settings($directory));
    	    //Do the upload
    	    if($this->upload->do_upload())
    	    {
    	    	//Get the data from our new upload.
    	    	$data = array('upload_data' => $this->upload->data());
    		    //Set the database array
    	    	$dbarray = array("filename" => $data["upload_data"]["file_name"], "image" => $data["upload_data"]["file_name"]);
                $this->db->insert("images", $dbarray);
                $output = $data["upload_data"]["file_name"];
                return $output;
    	    }
    	    else{
    	       return false;
    	    }
    	}
        
        /**
    	 * @Method: upload_gallery_images()
    	 * @Info: Uploads gallery images submitted
    	 *        from the form.
    	 **/
        function upload_gallery_images($galleryid)
        {
            $this->load->library('upload');
            $this->upload->initialize(array(
                "upload_path"   => "./uploads/galleries/",
                "file_name"     => time() . "_" . rand(10,100),
                "allowed_types" => 'gif|jpg|jpeg|png'
            ));
            if($this->upload->do_multi_upload("userfile")){
                $return = $this->upload->get_multi_upload_data();
                
                $this->load->library('image_lib');
                foreach($return as $image)
                {
                    
                    $config = array(
                        'source_image' => $image['full_path'],
                        'new_image' => "./uploads/galleries/thumbnails/thumb_" . $image['file_name'],
                        'maintain_ration' => true,
                        'width' => 180,
                        'height' => 180,
                    );
                
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();
                    $this->image_lib->clear();
                    
                    
                    $this->db->insert("gallery_images", array(
                        "galleryid" => $galleryid, 
                        "image"     => $image["file_name"],
                        "thumbnail" => "thumb_" . $image['file_name']
                    ));
                }
            }   
        }
        
        
        /**
         * AVATAR UPLOAD
         **/
         
         /**
    	 * @Method: avatar_settings()
    	 * @Info: Returns configuration for
    	 *        avatar Image Upload.
    	 **/
    	private function avatar_settings()
    	{   
    	    //upload an image options
    	    $config = array();
            $config['max_size']	= '9999';
            $config['upload_path'] = './uploads/avatars/';
    		$config['allowed_types'] = 'gif|jpg|png';
    		$config['file_name'] = time() . "_" . rand(10,100);
    	    return $config;
    	}
    
    	/**
    	 * @Method: upload_avatar()
    	 * @Info: Upload avatar submitted
    	 *        from the form.
    	 **/
    	function upload_avatar($directory = null)
    	{
    		//Load the upload library
    	    $this->load->library('upload');
    	    //Load the image library
    	    $this->load->library('image_lib');
    	    //Set output to empty by default
    	    $output = ""; 
            //Initialize the uploader with the config settings
    	    $this->upload->initialize($this->avatar_settings($directory));
    	    //Do the upload
    	    if($this->upload->do_upload())
    	    {
    	    	//Get the data from our new upload.
    	    	$data = array('upload_data' => $this->upload->data());
    		    //Set the database array
    	    	$dbarray = array("filename" => $data["upload_data"]["file_name"], "image" => $data["upload_data"]["file_name"]);
                $this->db->insert("images", $dbarray);
                $output = $data["upload_data"]["file_name"];
                return $output;
    	    }
    	    else{
    	       return false;
    	    }
    	}  
    }  
?>