<?php

 #
 # MiniCMS
 #
 # System main prebuild
 #
 # info: main folder copyright file
 #
 #



# build site

$db=count($SYS_COOKIES_NAME);
for ($i=0;$i<$db;$i++){
	$SYS_COOKIES_STORED_DATA[$i]=get_cookie($SYS_COOKIES_NAME[$i]);
}





# end of build site
# ---------------------------------------


function main(){
	global $SYS_META;
	
	#echo("<html>\n");
	$db=count($SYS_META);
	for ($i=0;$i<$db;$i++){
		echo($SYS_META[$i]."\n");
	}
	echo("<body>\n");
}

function main_end(){
	echo("</body></html>");
}



function plugin_load($pluginname=''){
	global $SYS_PLUGINS_DIR;

	$file=$SYS_PLUGINS_DIR."$pluginname/$pluginname.php";
	if (file_exists($file)){
		include($file);
	}
}







# file load

function file_include($file=''){
	$ret=false;
	if (file_exists($file)){
		$ret=include($file);
	}
	return($ret);
}






# cookie support

function set_all_cookie(){
	global $SYS_COOKIES_DATA,$SYS_COOKIES_NAME,$SYS_COOKIES_TIME;
	
	$db=count($SYS_COOKIES_NAME);
	for ($i=0;$i<$db;$i++){
		if ($SYS_COOKIES_DATA[$i]<>""){
			set_cookie($SYS_COOKIES_NAME[$i],$SYS_COOKIES_DATA[$i],$SYS_COOKIES_TIME[$i]);
		}else{
			del_cookie($SYS_COOKIES_NAME[$i]);
		}
	}
}



function set_cookie($name='',$data='',$min=''){
	setcookie($name,$data,time()+$min,"/");
}



function get_cookie($name=''){
	$ret="";
	if (isset($_COOKIE[$name])){
		$ret=$_COOKIE[$name];
	}
	return($ret);
}



function del_cookie($name=''){
	if (isset($_COOKIE[$name])){
		unset($_COOKIE[$name]);
	}
	setcookie($name,"",time()-10,"/");
}


function set_js_cookie($name='',$data='',$min=''){
	$m=time()+$min;
	echo("<script>setCookie($name,$data,$m)</script>");
}



function get_js_cookie($name=''){
	$ret="";
	if (isset($_COOKIE[$name])){
		$ret=$_COOKIE[$name];
	}
	return($ret);
}



function del_js_cookie($name=''){
	echo("<script>delCookie($name)</script>");
}



?>
