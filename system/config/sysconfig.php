<?php

 #
 # System config
 #
 # info: main folder copyright file
 #
 #


$SYS_COPYRIGHT="(C) 2018.";
$SYS_DEVELOPER="<a href=\"mailto:wswdteam@gmail.com\">WSWDTeam</a>";
$SYS_DEVELOPER_NAME="WSWDTeam";
$SYS_DEVELOPER_MAIL="wswdteam@gmail.com";


$SYS_ADMIN_NAME="admin";
$SYS_ADMIN_PASS="5f4dcc3b5aa765d61d8327deb882cf99";

$SYS_SITENAME="MiniCMS - Helpdesk";
$SYS_SITE_TITLE="Helpdesk";
$SYS_SITE_HOME="http://www.example.com";


# directory structure
$SYS_SYSTEM_DIR="../system/";
$SYS_CFG_DIR=$SYS_SYSTEM_DIR."config/";
$SYS_CSS_DIR=$SYS_SYSTEM_DIR."include/";
$SYS_LIB_DIR=$SYS_SYSTEM_DIR."lib/";
$SYS_IMG_DIR=$SYS_SYSTEM_DIR."images/";
$SYS_PLUGINS_DIR=$SYS_SYSTEM_DIR."plugins/";
$SYS_ADMIN_PLUGINS_DIR=$SYS_SYSTEM_DIR."pluginsa/";
$SYS_CONTENT_DIR="../content/";
$SYS_INCLUDE_DIR=$SYS_SYSTEM_DIR."include/";
$SYS_LOG_DIR=$SYS_SYSTEM_DIR."log/";

$SYS_IMG_FAVICON=$SYS_IMG_DIR."favicon.png";


# meta page parameters (need reconfigured in local config file)
$SYS_META=array("<!DOCTYPE html>",
				"<html lang=\"hu\">",
				"<head>",
				"<meta charset=\"utf-8\">",
				"<meta http-equiv=\"Content-Type\" content=\"text/html;charset=UTF-8\">",
				"<title>$SYS_SITE_TITLE</title>",
				"<meta name=\"viewport\" content=\"initial-scale=1.0\">",
				"<link rel=\"shortcut icon\" href=\"$SYS_IMG_FAVICON\">",
				"<link href=\"https://fonts.googleapis.com/icon?family=Material+Icons\" rel=\"stylesheet\">",
				"</head>",
				"");



# starter files
$SYS_LOADER_FILE="../public/index.php";
$SYS_PREPARE_FILE="../public/prepare.php";
$SYS_PREPARE_END_FILE="../public/prepare_end.php";


# local system config
$SYS_LOCAL_CONFIG=$SYS_CFG_DIR."config.php";
$SYS_MAIN_COMMANDER=$SYS_CONTENT_DIR."index.php";
$ADMIN_MAIN_COMMANDER=$SYS_CONTENT_DIR."admin/admin.php";


# system components
$SYS_MAIN_CSS=array("site.css");
$SYS_MAIN_JS_BEFORE=array("lib.js");
$SYS_MAIN_JS_AFTER=array();
$SYS_MAIN_LIB_FILES=array(	"main.php",
				"lib-1.php",
				"lib-2.php",
				"lib-lang.php",
				"mysql.php");


# plugins to load
$SYS_ACTIVE_PLUGINS_BEFORE=array(	"gdpr",
					"button",
					"menu",
					"tabler",
					"collapse",
					"card",
					"paramform",
					"column",
					"footer",
					"rightclick",
					"login",
					"form");

$SYS_ACTIVE_PLUGINS_AFTER=array("");

# admin plugins to load
$SYS_ADMIN_ACTIVE_PLUGINS_BEFORE=array(		"menu",
						"footer",
						"gototop",
						"form",
						"tabler",
						"card",
						"rightclick",
						"login");

$SYS_ADMIN_ACTIVE_PLUGINS_AFTER=array("");

if (!isset($ADMIN_SITE)){
    $ADMIN_SITE=false;
}


# user role
$SYS_USER_ROLE=array();

# log
$SYS_ERROR_LOG=true;
$SYS_ERROR_LOG_FILE="php.log";


# cookies
$SYS_COOKIES_NAME=array();
$SYS_COOKIES_DATA=array();
$SYS_COOKIES_STORED_DATA=array();
$SYS_COOKIES_TIME=array(); 
# seconds ! 1 day = 3600000*24
$SYS_SESSION=false;


# site privacy policy file ?.php (need redecralate in local config file)
$SYS_PRIVACY_POLICY="";


# language file(need redecralate in local config file)
$LANGUAGE_FILE="";
$LANGUAGE_TITLE="hu";


# paramter to start instead of index.php
$SYS_PARAM_FILE="file";


# mysql connect
$SQL_SUPPORT=false;
$SQL_SERVER="localhost";
$SQL_PORT="";
$SQL_DATABASE="hd";
$SQL_USER="hd";
$SQL_PASSWORD="MiniCMS";
$SQL_CONNECT=false;
$SQL_ERROR="";
$SQL_ERROR_SHOW=FALSE;


# smtp connect
$SMTP_HOST="ssl://smtp.gmail.com";
$SMTP_SECURE="ssl";
$SMTP_PORT="465";
$SMTP_PORT2="587";
$SMTP_USER="";
$SMTP_PASSWORD="";
$SMTP_FROM="";
$SMTP_DOMAIN="";
$SMTP_TO="";
$PHPMAIL=FALSE;


?>
