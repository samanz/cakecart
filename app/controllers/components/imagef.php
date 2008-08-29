<?php
class ImagefComponent extends Object {
   function checkType($mime, $name) {
	   if($mime=="image/jpeg" || $mime=="image/pjpeg" || $mime =="image/png" || $mime == "image/gif") {
	 	   $array = explode(".", $name);
	  	   $nr    = count($array);
	  	   $ext  = $array[$nr-1];
	  	   if($ext=="jpg" || $ext == "JPG" || $ext== "JPEG" || $ext=="GIF" || $ext=="PNG" || $ext=="jpeg" || $ext=="gif" || $ext=="png") {
	    		return true;
	  	   } else {
			   return false;
		   }
   	} else {
		   return false;
	   }
	}
	function check($file) {
	   if($file['name'] == '')
	      return false;
	   if(!$this->checkType($file['type'], $file['name']))
	      return false;
	   if($file['error'] != 0)
	      return false;
	   return true;
	}
   function save($file) {
      $img_url = $file['name'];
      $tmp_name = $file['tmp_name'];
      $mime = $file['type'];
   	if($this->checkType($mime, $img_url)) {
   		$imgpath = WWW_ROOT . Configure::read('Image.folder');				
   		$uploadfile = $imgpath . $img_url;
   		if (copy($tmp_name , $uploadfile )) {
   			return $img_url;
   		} else {
   		   die('An Error has occured.');
   			return '';
   		}	
   	} else {
   		return '';
   	}
   }
   function saveCat($file) {
      $img_url = $file['name'];
      $tmp_name = $file['tmp_name'];
      $mime = $file['type'];
   	if($this->checkType($mime, $img_url)) {
   		$imgpath = WWW_ROOT . Configure::read('Image.cat_folder');			
   		$uploadfile = $imgpath . $img_url;
   		if (copy($tmp_name , $uploadfile )) {
   			return $img_url;
   		} else {
   		   die('An Error has occured.');
   			return '';
   		}	
   	} else {
   		return '';
   	}
   }
}
?>