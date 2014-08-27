<?php
/*
Uploadify
Copyright (c) 2012 Reactive Apps, Ronnie Garcia
Released under the MIT License <http://www.opensource.org/licenses/mit-license.php> 
*/

// Define a destination
$targetFolder = (isset($_REQUEST['baseurl']))? $_REQUEST['baseurl'].'/uploads' : '/uploads'; // Relative to the root

if (!empty($_FILES)) {
	$tempFile = $_FILES['Filedata']['tmp_name'];
	$targetPath = $_SERVER['DOCUMENT_ROOT'] . $targetFolder;
	$filename = $_FILES['Filedata']['name'];
	//$ext = preg_replace('/^.*\.([^.]+)$/D', '$1', $filename);
	//$filename = $filename.'SEPX'.uniqid().'.'.$ext;
	$real_filename = $filename;
	$storage_filename = md5($f.uniqid()).'.'.preg_replace('/^.*\.([^.]+)$/D', '$1', $real_filename);
	$targetFile = rtrim($targetPath,'/') . '/' .$storage_filename;
	
	// Validate the file type
	$fileTypes = array('jpg','jpeg','gif','png','doc','docx','xls','xlsx','pdf'); // File extensions
	$fileParts = pathinfo($_FILES['Filedata']['name']);
	
	
	
	//if (in_array($fileParts['extension'],$fileTypes)) {
	if(move_uploaded_file($tempFile,$targetFile)){		
		//echo '1';
		echo $real_filename.'*'.$storage_filename;
		//echo $_REQUEST['folder'];
	} else {
		echo 'Upload failed.';
	}

}
?>