<?php

if (!isset($L_HEADER)){
	$L_HEADER[0]="Ügyfélkapu";
	$L_HEADER[1]="Helpdesk";
	$L_HEADER[2]="Kilépés";
}


echo("<header>");

if (isset($MENU)){
	$menu_empty=array();
	$menu = array
		(
			array($L_HEADER[0],"","login-partner"),
			array($L_HEADER[1],"","login-hd"),
			array($L_HEADER[2],"","logout")
		);
	if ($LOGGED_IN){
		$mdb=count($menu);
		$menu[$mdb]=array($L_HEADER[5],"","i5");
		menuform_start();
		login_to_form();
		menuform_end();
	}
	menu_line($menu);
}



echo("</header>");


# ------------------------------------------------
# Content

echo("<div class=content>");

?>
