<?php

include("../public/prepare.php");

echo("<page size=\"A4\">");

if (!isset($LANG_ERR)){
        if (file_exists($SYS_CONTENT_DIR."admin/admin.$LANGUAGE_TITLE")){
		include($SYS_CONTENT_DIR."admin/admin.$LANGUAGE_TITLE");
	}
	if (!isset($LANG_ERR)){
		$LANG_ERR[0]="Nem érkezett adat.";
		$LANG_ERR[1]="Hibajegy / Eszköz átvétele";
		$LANG_ERR[2]="Hibajegy azonosítója";
		$LANG_ERR[3]="Ügyfél neve";
		$LANG_ERR[4]="Ügyfél elérhetősége";
		$LANG_ERR[5]="Átvett eszköz";
		$LANG_ERR[6]="Hibajelenség";
		$LANG_ERR[7]="Megrendelő (bélyegző)";
		$LANG_ERR[8]="Dátum / Átvevő";
		$LANG_ERR[9]="Vállalási feltételek";
		$LANG_ERR[10]="service-rules.txt";  # filename !!!
	}
}

if (isset($_GET["c"])){
	if (file_exists("$SYS_CONTENT_DIR/$LOCAL_CSS")){
		include("$SYS_CONTENT_DIR/$LOCAL_CSS");
	}

	echo("<div class=content style=\"font-size:0.8em;\">");

	echo("<div class=borderbox>");
	echo("<div style=\"width:100%;font-size:1.2em;font-weight:bold;\">$LOCAL_COMPANY_NAME</div>");
	echo("<div style=\"padding:5px;\"></div>");
	echo("<div style=\"\">$LOCAL_COMPANY_ADDR<br />");
	echo("$LOCAL_COMPANY_EMAIL<br />");
	echo("$LOCAL_COMPANY_PHONE</div>");
	echo("</div>");

	echo("<div class=spaceline10></div>");

	echo("<div class=borderbox>");
	echo("<div class=center><span style=\"font-size:1.5em;font-weight:bold;\">$LANG_ERR[1]</span></div>");
	echo("</div>");

	echo("<div class=spaceline10></div>");

	echo("<div class=borderbox>");
	$d=$_GET["c"];
	$sql="select * from hd_tickets where tid='$d';";
	#echo($sql);
	sql_run_command($sql);
	$sdb=sql_result_num();
	$t=sql_result(0);
	$xdb=count($t);
	echo("<table width=100%>");
	echo("<tr><td width=50%>$LANG_ERR[2]</td><td>$t[0]</td></tr>");
	echo("<tr><td width=50%>$LANG_ERR[3]</td><td>$t[1]</td></tr>");
	echo("<tr><td width=50%>$LANG_ERR[4]</td><td>$t[2]</td></tr>");
	echo("<tr><td width=50%>$LANG_ERR[5]</td><td>$t[3]</td></tr>");
	echo("<tr><td width=50%>$LANG_ERR[6]</td><td>$t[4]</td></tr>");
	echo("</table>");

	echo("</div>");
	echo("<div class=spaceline10></div>");

	echo("<div class=borderbox>");
	echo("<p style=\"font-weight:bold;\">$LANG_ERR[7]</p>");
	echo("<div class=spaceline20></div>");
	echo("</div>");
	echo("<div class=spaceline10></div>");

	echo("<div class=borderbox>");
	echo("<p style=\"font-weight:bold;\">$LANG_ERR[8]</p>");
	$d=date('Y.m.d. H:i.');
	echo("<p style=\"font-weight:bold;\">$d</p>");
	echo("<div class=spaceline20></div>");
	echo("</div>");

	echo("<div class=spaceline10></div>");

	echo("<div class=borderbox>");
	echo("<p style=\"font-weight:bold;\">$LANG_ERR[9]</p>");
	if (file_exists("$SYS_CONTENT_DIR/txt/$LANG_ERR[10]")){
		include("$SYS_CONTENT_DIR/txt/$LANG_ERR[10]");
	}
	echo("</div>");

	echo("</div>");

}else{
	echo("<br />$LANG_ERR[0]");
}

echo("</page>");

include("../public/prepare_end.php");

?>
