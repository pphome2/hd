<?php

 #
 # MiniCMS
 #
 # info: main folder copyright file
 #
 #



function session_init(){
	global $SYS_SESSION;

	session_start();
	session_set("name","1");
	$SYS_SESSION=session_live("name");
}


function session_set($name='',$data=''){
	$_SESSION['$name']=$data;

}


function session_get($name=''){
	$ret=$_SESSION['$name'];
	return($ret);
}


function session_live($name=''){
	$ret=false;
	if (isset($_SESSION['$name'])){
		$ret=true;
	}
	return($ret);
}


function session_end(){
	session_unset(); 
	session_destroy(); 
}


function fileup($target_dir=''){;
	$ret=FALSE;
	$target_file=basename($_FILES["fileupload"]["name"]);
	if ($target_file<>""){
		#$target_file=toascii($target_file);
		if ($target_dir<>""){
			$target_file=$target_dir."/".$target_file;
		}
		$c=$_FILES["fileupload"]["tmp_name"];
		if (move_uploaded_file($_FILES["fileupload"]["tmp_name"],$target_file)) {
			$ret=TRUE;
		}
	}
	return($ret);
}



function fileupplus($fname='',$tdir='./',$delifexists=FALSE,$fsize=1000000,$onlyimg=FALSE){
	$target_dir=$tdir."/";
	$target_file=$target_dir.basename($_FILES[$fname]["name"]);
	$ok=TRUE;
	$imageFileType=strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	// Check if image file is a actual image or fake image
	// Check if file already exists
	if (file_exists($target_file)) {
		if ($delifexists){
			$ok=unlink($target_file);
		}else{
			$ok=FALSE;
		}
	}
	// Check file size
	if ($_FILES[$fname]["size"]>$fsize) {
		echo "Sorry, your file is too large.";
		$ok=FALSE;
	}
	// Allow image file formats
	if ($onlyimg){
		$ok=getimagesize($_FILES[$fname]["tmp_name"]);
	}
	// Check if $k is set to 0 by an error
	if ($ok) {
		if (move_uploaded_file($_FILES["$fname"]["tmp_name"], $target_file)) {
		}else{
			$ok=FALSE;
		}
	}
	return($ok);
}

?>
