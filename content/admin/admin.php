<?php

 #
 # Portal and HelpDesk - admin site
 #
 # info: main folder copyright file
 #
 #



if (!isset($LANG_ADMIN)){
        if (file_exists($SYS_CONTENT_DIR."admin/admin.$LANGUAGE_TITLE")){
		include($SYS_CONTENT_DIR."admin/admin.$LANGUAGE_TITLE");
	}
	if (!isset($LANG_ADMIN)){
		$LANG_ADMIN[0]="Felhasználók";
		$LANG_ADMIN[1]="Hibajegyek";
		$LANG_ADMIN[2]="Ügyfelek";
		$LANG_ADMIN[3]="Dolgozók";
		$LANG_ADMIN[4]="Statisztika";
		$LANG_ADMIN[5]="Kilépés";
		$LANG_ADMIN[6]="Letiltott";
		$LANG_ADMIN[7]="Adminisztrátor";
		$LANG_ADMIN[8]="Szerkesztő";
		$LANG_ADMIN[9]="Vendég";
		$LANG_ADMIN[10]="Nyitólap";
	}
}


$SYS_USER_ROLE=array($LANG_ADMIN[6],$LANG_ADMIN[7],$LANG_ADMIN[8],$LANG_ADMIN[9]);



if (file_exists($LOCAL_JS_BEGIN)){
    include("$LOCAL_JS_BEGIN");
}


if (file_exists("$SYS_CONTENT_DIR/$LOCAL_CSS")){
    include("$SYS_CONTENT_DIR/$LOCAL_CSS");
}



if ($SQL_CONNECT){
	sql_run_command("select * from hd_users;");
	$sdb=sql_result_num();
	for($i=0;$i<$sdb;$i++){
		$t=sql_result($i);
		$USERS_DATA[$i+1]=array($t[1],$t[2],$t[4]);
	}
}




echo("<header>");

$LOGGED_IN=false;
if (isset($LOGIN)){
	get_login_data();
	if (login_check($SYS_USER_ROLE[1])){
		$LOGGED_IN=true;
	}
}


if (isset($MENU)){
	if ($LOGGED_IN){
		$menu = array
			(
				array($LANG_ADMIN[0],"","a0"),
				array($LANG_ADMIN[1],"","a1"),
				array($LANG_ADMIN[2],"","a2"),
				array($LANG_ADMIN[3],"","a3"),
				array($LANG_ADMIN[4],"","a4"),
				array($LANG_ADMIN[5],"","a5")
			);
	}else{
		$menu = array();
	}

	if ($LOGGED_IN){
		menuform_start();
		login_to_form();
		menuform_end();
	}
	menu_line($menu);
}

echo("</header>");

echo("<div class=\"content\">");



if (isset($MENU)and($LOGGED_IN)){
	get_menu_name();
	switch ($MENUNAME){
			case "a0":			#Felhasználók
				if (file_exists($SYS_CONTENT_DIR."admin/auser.php")){
					include($SYS_CONTENT_DIR."admin/auser.php");
				}
				break;
			case "a1":			#Hibajegyek
				if (file_exists($SYS_CONTENT_DIR."admin/aticket.php")){
					include($SYS_CONTENT_DIR."admin/aticket.php");
				}
				break;
			case "a2":			#Ügyfelek
				if (file_exists($SYS_CONTENT_DIR."admin/apartner.php")){
					include($SYS_CONTENT_DIR."admin/apartner.php");
				}
				break;
			case "a3":			#Dolgozók
				if (file_exists($SYS_CONTENT_DIR."admin/aworker.php")){
					include($SYS_CONTENT_DIR."admin/aworker.php");
				}
				break;
			case "a4":			#Statisztika
				if (file_exists($SYS_CONTENT_DIR."admin/astat.php")){
					include($SYS_CONTENT_DIR."admin/astat.php");
				}
				break;
			case "a5":			#Kilépés
				login_logout();
				menu_submit();
				break;
			default:
				if (file_exists($SYS_CONTENT_DIR."admin/a0.php")){
					include($SYS_CONTENT_DIR."admin/a0.php");
				}
				break;
	}
}



if (!$LOGGED_IN){
	if (isset($LOGIN)){
		login_only();
	}
}




if (isset($GDPR)){
	gdpr();
}

if (isset($GOTOTOP)){
	gototop();
}


echo("</div>");


echo("<footer>");

if (isset($FOOTER)){
	$copyr=$SYS_COPYRIGHT."<a href='../public'>$LANG_ADMIN[10]</a>";
	footer($copyr,$SYS_DEVELOPER,$SYS_DEVELOPER_NAME,$SYS_DEVELOPER_MAIL);
}

echo("</footer>");



if (file_exists($LOCAL_JS_END)){
    include("$LOCAL_JS_END");
}



?>
