<?php
$file = explode('*',$_REQUEST['f']);
if(isset($file[1]) && file_exists($_SERVER['DOCUMENT_ROOT'] . $_REQUEST['p'] . '/' . $file[1])){
	if(unlink($file[1])){
		echo 1;
	}else{
		echo 0;
	}
}else{echo 'no such file';}
?>