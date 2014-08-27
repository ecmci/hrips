<?php
class Attachments{
	public static function saveAttachments($form_model, $attachment_model, $uploads=array()){
		foreach($uploads as $f){
			$filename = explode("*",$f);
			$file = new $attachment_model;
			$file->form_model_id = $form_model->id;
			$file->real_filename = $filename[0];
			$file->storage_filename = $filename[1];
			$file->save(false);
		}
	}
  
  public static function generateStorageFilename($filename_real){
      return md5($filename_real.uniqid()).'.'.preg_replace('/^.*\.([^.]+)$/D', '$1', $filename_real);
  }	
}
?>