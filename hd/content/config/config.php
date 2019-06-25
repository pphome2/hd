<?php

 #
 # Local config file
 #
 # info: main folder copyright file
 #
 #

# configuration - need change it
# change from sysconfig.sys

$SYS_COPYRIGHT="© 2018. <a href=https://github.com/pphome2/minicms>Helpdesk</a>";
$SYS_DEVELOPER="<a href=\"mailto:wswdteam@gmail.com\">WSWDTeam</a>";

# need md5 passcode: password
#$SYS_ADMIN_PASS="5f4dcc3b5aa765d61d8327deb882cf99";

$SYS_SITENAME="MiniCMS - Helpdesk";
$SYS_SITE_HOME="http://www.example.com";

$LANGUAGE_FILE=$SYS_CONTENT_DIR."config/lang.hu";
$SYS_PRIVACY_POLICY=$SYS_CONTENT_DIR."privacy.php";

#$SYS_META=array("");


# local site config

$LOCAL_COMPANY_NAME="Service Lan-Net Kft.";
$LOCAL_COMPANY_ADDR="5000, Szolnok, Kalap út 11.";
$LOCAL_COMPANY_EMAIL="helpdesk@service.hu";
$LOCAL_COMPANY_PHONE="56/321-321";
$LOCAL_COMPANY_LOGO="logo.png";


$LOCAL_CSS=$SYS_CONTENT_DIR."css/site.css";
$LOCAL_JS_BEGIN="";
$LOCAL_JS_END="";
$LOCAL_HEADER=$SYS_CONTENT_DIR."header.php";
$LOCAL_FOOTER=$SYS_CONTENT_DIR."footer.php";

$LOCAL_MANUAL_TEXT="$SYS_CONTENT_DIR/txt/manual.txt";
$LOCAL_PRIVACY_TEXT="$SYS_CONTENT_DIR/txt/privacy.txt";

$LOCAL_MAX_DATA_TABLE=20;

?>
