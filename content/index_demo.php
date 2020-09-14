<?php

 #
 # Portal and HelpDesk
 #
 # info: main folder copyright file
 #
 #




if (file_exists($LOCAL_JS_BEGIN)){
    include("$LOCAL_JS_BEGIN");
}

if (file_exists("$SYS_CONTENT_DIR/$LOCAL_CSS")){
    include("$SYS_CONTENT_DIR/$LOCAL_CSS");
}

if (file_exists($LOCAL_HEADER)){
    include($LOCAL_HEADER);
}

if (!isset($L_INDEX)){
        if (file_exists($SYS_CONTENT_DIR."config/lang.$LANGUAGE_TITLE")){
		include($SYS_CONTENT_DIR."config/lang.$LANGUAGE_TITLE");
	}
	if (!isset($L_INDEX)){
		$L_INDEX[0]="Letiltott";
		$L_INDEX[1]="Adminisztrátor";
		$L_INDEX[2]="Szerkesztő";
		$L_INDEX[3]="Vendég";
	}
}



$SYS_USER_ROLE=array($L_INDEX[0],$L_INDEX[1],$L_INDEX[2],$L_INDEX[3]);


# Header end
# -------------------------------------------------------


$page="";

if (isset($PARAMFORM)){
    $page=paramform_get("pagename");
}

if ($page==""){
	if (isset($BUTTON)){
		$page=buttonform_get();
	}
}

if ($page==""){
	if (isset($MENU)){
		get_menu_name();
		$page=$MENUNAME;
	}
}


$LOGGED_IN=false;

#echo("?$page?");
if ($page<>""){
	switch ($page){
		case "i0":
			break;
		case "i1":
			break;
		case "i2":
			break;
		case "i3":
			break;
		case "i4":
			break;
		case "i5":
			login_logout();
			menu_submit();
			break;
		case "search":
			if (file_exists($SYS_CONTENT_DIR."search.php")){
				include($SYS_CONTENT_DIR."search.php");
			}
			break;
		case "login-hd":
			if (file_exists($SYS_CONTENT_DIR."login-hd.php")){
				include($SYS_CONTENT_DIR."login-hd.php");
			}
			break;
		case "login-partner":
			if (file_exists($SYS_CONTENT_DIR."login-part.php")){
				include($SYS_CONTENT_DIR."login-part.php");
			}
			break;
		case "logout":
			login_logout();
			menu_submit();
			break;
		default:
			if (file_exists($SYS_CONTENT_DIR."index_cont.php")){
				include($SYS_CONTENT_DIR."index_cont.php");
			}
			break;
	}
}else{
	if (file_exists($SYS_CONTENT_DIR."index_cont.php")){
		include($SYS_CONTENT_DIR."index_cont.php");
	}
}



# -------------------------------------------------------
# Footer start


if (file_exists($LOCAL_FOOTER)){
    include("$LOCAL_FOOTER");
}

if (file_exists($LOCAL_JS_END)){
    include("$LOCAL_JS_END");
}

?>
