<?php

include("../public/prepare.php");

?>

<style>

@page {
  size: A4;
  margin: 0;
}
@media print {
  html, body {
    width: 210mm;
    height: 297mm;
  }
}

</style>

<?php

echo("<page size=\"A4\">");

if (!isset($LANG_ERR)){
        if (file_exists($SYS_CONTENT_DIR."admin/admin.$LANGUAGE_TITLE")){
		include($SYS_CONTENT_DIR."admin/admin.$LANGUAGE_TITLE");
	}
	if (!isset($LANG_ERR)){
		$LANG_WP[0]="Nem érkezett adat.";
		$LANG_WP[1]="Munkalap";
		$LANG_WP[2]="Hibajegy azonosítója";
		$LANG_WP[3]="Ügyfél neve";
		$LANG_WP[4]="Ügyfél elérhetősége";
		$LANG_WP[5]="Átvett eszköz";
		$LANG_WP[6]="Hibajelenség";
		$LANG_WP[7]="Javítást végezte";
		$LANG_WP[8]="Elvégzett munka leírása";
		$LANG_WP[9]="Felhasznált anyag / alkatrész";
		$LANG_WP[10]="Munkaidő (óra)";
		$LANG_WP[11]="Kiszállás (km)";
		$LANG_WP[12]="Javítás befejezve";
		$LANG_WP[13]="Megrendelő (bélyegző)";
		$LANG_WP[14]="Átadás dátuma / Javítás végző";
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
	echo("<div class=center><span style=\"font-size:1.5em;font-weight:bold;\">$LANG_WP[1]</span></div>");
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
	echo("<tr><td width=50%>$LANG_WP[2]</td><td>$t[0]</td></tr>");
	echo("</table>");
	echo("<div class=spaceline10></div>");
	echo("<table width=100%>");
	echo("<tr><td width=50%>$LANG_WP[3]</td><td>$t[1]</td></tr>");
	echo("<tr><td width=50%>$LANG_WP[4]</td><td>$t[2]</td></tr>");
	echo("<tr><td width=50%>$LANG_WP[5]</td><td>$t[3]</td></tr>");
	echo("<tr><td width=50%>$LANG_WP[6]</td><td>$t[4]</td></tr>");
	echo("</table>");
	echo("<div class=spaceline10></div>");
	echo("<table width=100%>");
	echo("<tr><td width=50%>$LANG_WP[7]</td><td>$t[6]</td></tr>");
	$t[7]=str_replace(PHP_EOL,"<br>",$t[7]);
	echo("<tr><td width=50% valign=top>$LANG_WP[8]</td><td>$t[7]</td></tr>");
	$t[8]=str_replace(PHP_EOL,"<br>",$t[8]);
	echo("<tr><td width=50% valign=top>$LANG_WP[9]</td><td>$t[8]</td></tr>");
	echo("<tr><td width=50%>$LANG_WP[10]</td><td>$t[9]</td></tr>");
	echo("<tr><td width=50%>$LANG_WP[11]</td><td>$t[10]</td></tr>");
	echo("<tr><td width=50%>$LANG_WP[12]</td><td>$t[11]</td></tr>");
	echo("</table>");

	echo("</div>");
	echo("<div class=spaceline10></div>");

	echo("<div class=borderbox>");
	echo("<p style=\"font-weight:bold;\">$LANG_WP[13]</p>");
	echo("<div class=spaceline20></div>");
	echo("</div>");
	echo("<div class=spaceline10></div>");

	echo("<div class=borderbox>");
	echo("<p style=\"font-weight:bold;\">$LANG_WP[14]</p>");
	$d=date('Y.m.d. H:i.');
	echo("<p style=\"font-weight:bold;\">$d</p>");
	echo("<div class=spaceline20></div>");
	echo("</div>");

	echo("<div class=spaceline10></div>");

	echo("</div>");

}else{
	echo("<br />$LANG_WP[0]");
}


echo("</page>");

include("../public/prepare_end.php");

?>
