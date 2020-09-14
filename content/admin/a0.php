<?php


if (!isset($LANG_ADMIN_H)){
        if (file_exists($SYS_CONTENT_DIR."admin/admin.$LANGUAGE_TITLE")){
		include($SYS_CONTENT_DIR."admin/admin.$LANGUAGE_TITLE");
	}
	if (!isset($LANG_ADMIN_H)){
		$LANG_ADMIN_H[0]="Adminisztráció";
		$LANG_ADMIN_H[1]="Használat";
	}
}



echo("<div class=spaceline25></div>");
echo("<h1>$SYS_SITENAME</h1>");
echo("<div class=spaceline25></div>");
echo("<h1>$LANG_ADMIN_H[0]</h1>");
echo("<div class=spaceline25></div>");

echo("<b>$LANG_ADMIN_H[1]</b>");

if (file_exists("$LOCAL_MANUAL_TEXT")){
	include("$LOCAL_MANUAL_TEXT");
}

echo("<div class=spaceline50></div>");

?>
