<?php


if (!isset($LANG_ADMIN_S)){
        if (file_exists($SYS_CONTENT_DIR."admin/admin.$LANGUAGE_TITLE")){
		include($SYS_CONTENT_DIR."admin/admin.$LANGUAGE_TITLE");
	}
	if (!isset($LANG_ADMIN_S)){
		$LANG_ADMIN_S[0]="Statisztika";
		$LANG_ADMIN_S[1]="Felhasználók száma";
		$LANG_ADMIN_S[2]="Ügyfelek száma";
		$LANG_ADMIN_S[3]="Dolgozók száma";
		$LANG_ADMIN_S[4]="Bejelentett hibák száma";
		$LANG_ADMIN_S[5]="Nincs kiosztva";
		$LANG_ADMIN_S[6]="Összes";
		$LANG_ADMIN_S[7]="Dolgozók szerint (Összes)";
	}
}


echo("<div class=sspaceline25></div>");
echo("<h1>$LANG_ADMIN_S[0]</h1>");
echo("<div class=spaceline25></div>");


$table="<center><table width=80%>";

$sql="select * from hd_users;";
sql_run_command($sql);
$sdb=sql_result_num();
$table=$table."<tr><td align=right width=49%>$LANG_ADMIN_S[1]</td><td width=2%></td><td align=left>$sdb</td></tr>";

$sql="select * from hd_partners;";
sql_run_command($sql);
$sdb=sql_result_num();
$table=$table."<tr><td align=right width=49%>$LANG_ADMIN_S[2]</td><td width=2%></td><td align=left>$sdb</td></tr>";

$sql="select * from hd_workers;";
sql_run_command($sql);
$sdb=sql_result_num();
$table=$table."<tr><td align=right width=49%>$LANG_ADMIN_S[3]</td><td width=2%></td><td align=left>$sdb</td></tr>";

$table=$table."</table></center>";

echo($table);
echo("<div class=spaceline50></div>");

$table="<center><table width=80%>";

$sql="select * from hd_tickets;";
sql_run_command($sql);
$sdb=sql_result_num();
$table=$table."<tr><td align=right width=49%><b>$LANG_ADMIN_S[4] ($LANG_ADMIN_S[6])</b></td><td width=2%></td><td align=left>$sdb</td></tr>";

#$table=$table."</table></center>";
#echo($table);
#echo("<div class=spaceline25></div>");
#$table="<center><table width=80%>";

$sql="select count(tid),stat from hd_tickets group by stat;";
sql_run_command($sql);
$sdb=sql_result_num();
for($i=0;$i<$sdb;$i++){
	$t=sql_result($i);
	$table=$table."<tr><td align=right width=49%>- $t[1]</td><td width=2%></td><td align=left>$t[0]</td></tr>";
}


$table=$table."</table></center>";

echo($table);
echo("<div class=spaceline25></div>");

$table="<center><table width=80%>";
$table=$table."<tr><td align=right width=49%><b>$LANG_ADMIN_S[7]</b></td><td width=2%></td><td align=left></td></tr>";
$sql="select count(tid),worker,stat from hd_tickets group by worker,stat;";
sql_run_command($sql);
$sdb=sql_result_num();
$wo="";
for($i=0;$i<$sdb;$i++){
	$t=sql_result($i);
	if ($t[1]<>$wo){
		$wo=$t[1];
		#$table=$table."<tr><td align=right width=49% style='color:white;'>-</td><td width=2%></td><td align=left></td></tr>";
	}
	if ($t[1]==""){
		$t[1]=$LANG_ADMIN_S[5];
	}
	$table=$table."<tr><td align=right width=49%>- $t[1] ($t[2])</td><td width=2%></td><td align=left>$t[0]</td></tr>";
}

$table=$table."</table></center>";

echo($table);

echo("<div class=spaceline25></div>");
$table="<center><table width=80%>";

$y=date('Y');
$d=$y."%";

$sql="select * from hd_tickets where tid like '$d';";
sql_run_command($sql);
$sdb=sql_result_num();
$table=$table."<tr><td align=right width=49%><b>$y</b> - $LANG_ADMIN_S[4]</td><td width=2%></td><td align=left>$sdb</td></tr>";

$sql="select count(tid),stat from hd_tickets where tid like '$d' group by stat;";
sql_run_command($sql);
$sdb=sql_result_num();
for($i=0;$i<$sdb;$i++){
	$t=sql_result($i);
	$table=$table."<tr><td align=right width=49%>- $t[1]</td><td width=2%></td><td align=left>$t[0]</td></tr>";
}

$table=$table."</table></center>";

echo($table);

echo("<div class=spaceline25></div>");
$table="<center><table width=80%>";


$y=date('Y')-1;
$d=$y."%";

$sql="select * from hd_tickets where tid like '$d';";
sql_run_command($sql);
$sdb=sql_result_num();
$table=$table."<tr><td align=right width=49%><b>$y</b> - $LANG_ADMIN_S[4]</td><td width=2%></td><td align=left>$sdb</td></tr>";

$sql="select count(tid),stat from hd_tickets where tid like '$d' group by stat;";
sql_run_command($sql);
$sdb=sql_result_num();
for($i=0;$i<$sdb;$i++){
	$t=sql_result($i);
	$table=$table."<tr><td align=right width=49%>- $t[1]</td><td width=2%></td><td align=left>$t[0]</td></tr>";
}


$table=$table."</table></center>";

echo($table);

echo("<div class=spaceline50></div>");

?>
