<?php


if (!isset($L_LOGINPART)){
	$L_LOGINPART[0]="Tárolt ügyfél adatok";
	$L_LOGINPART[1]="Meghibásodás bejelentése";
	$L_LOGINPART[2]="Bejelentett hibák";
	$L_LOGINPART[3]="Teljes név";
	$L_LOGINPART[4]="E-mail cím";
	$L_LOGINPART[5]="Telefonszám";
	$L_LOGINPART[6]="Település";
	$L_LOGINPART[7]="Utca, házszám";
	$L_LOGINPART[8]="Adószám";
	$L_LOGINPART[9]="Ügyfélnév";
	$L_LOGINPART[10]="Kapcsolat";
	$L_LOGINPART[11]="Hibás eszköz";
	$L_LOGINPART[12]="Hibajelenség";
	$L_LOGINPART[13]="Hiba";
	$L_LOGINPART[14]="Mehet";
	$L_LOGINPART[15]="Üzenet";
	$L_LOGINPART[16]="Adatok tárolva.";
	$L_LOGINPART[17]="Bejelentés ideje";
	$L_LOGINPART[18]="Hibás eszköz";
	$L_LOGINPART[19]="Hiba";
	$L_LOGINPART[20]="Állapot";
}

if ($SQL_CONNECT){
	sql_run_command("select * from hd_partners;");
	$sdb=sql_result_num();
	for($i=0;$i<$sdb;$i++){
		$t=sql_result($i);
		$USERS_DATA[$i+1]=array($t[1],$t[2],$SYS_USER_ROLE[3]);
	}
}


$LOGGED_IN=false;
if (isset($LOGIN)){
	get_login_data();
	if (login_check($SYS_USER_ROLE[3])){
		$LOGGED_IN=true;
	}
}

if (!$LOGGED_IN){
	if (isset($LOGIN)){
		login_form_start();
		if (isset($PARAMFORM)){
			paramform("pagename","login-partner");
		}
		login_form();
		login_form_end();
	}
}else{

	if (isset($_POST["form-0"])){
		# all data arrived
		$db=count($_POST);
		$dt=array("","","","","","","","","","","","","","","","","");
		for($i=0;$i<$db-2;$i++){
			if (isset($_POST["form-$i"])){
				$dt[$i]=$_POST["form-$i"];
				$l=$_POST["form-$i"];
			}else{
				$dt[$i]="";
				$l="";
			}
		}
		if ($dt[1]<>""){
			mess_ok($L_LOGINPART[15],$L_LOGINPART[16]);
			$id=id();
			$sql="insert into `hd_tickets` (`tid`, `uid`, `cont`, `dev`, `err`, 
				`stat`, `worker`, `work`, `part`, `hour`, `km`, `wdate`) 
				values ('$id', '$dt[1]', '$dt[2]', '$dt[3]', '$dt[4]', 
				'', '', '', '', 0, 0, '');";
		}
		#echo($sql);
		sql_run_command($sql);
	}

	$pdata=array();
	if ($SQL_CONNECT){
		sql_run_command("select * from hd_partners where name='$LOGIN_NAME';");
		$sdb=sql_result_num();
		for($i=0;$i<$sdb;$i++){
			$t=sql_result($i);
			if (($t[1]==$LOGIN_NAME)and($t[2]==$LOGIN_PASS)){
				$pdata=$t;
			}
		}
	}
	$edata=array();
	if ($SQL_CONNECT){
		sql_run_command("select * from hd_tickets where uid='$pdata[4]' order by tid desc;");
		$sdb=sql_result_num();
		if ($sdb>20){
			$sdb=$LOCAL_MAX_DATA_TABLE;
		}
		for($i=0;$i<$sdb;$i++){
			$t=sql_result($i);
			$tdate=substr($t[0],0,12);
			$tdate=substr($t[0],0,4).'.'.substr($t[0],4,2).'.';
			$tdate=$tdate.substr($t[0],6,2).'. '.substr($t[0],8,2).':';
			$tdate=$tdate.substr($t[0],10,2).'.';
			$k=$i+1;
			$tab[$k]=array($t[0],$tdate,$t[3],$t[4],$t[5]);
		}
	}

	if (isset($pdata[0])){
		if (isset($COLLAPSE)){
			$header=array($L_LOGINPART[0],$L_LOGINPART[1],$L_LOGINPART[2]);

			$d1="<center><table width=80%>";
			$d1=$d1."<tr><td align=right width=49%>$L_LOGINPART[3]</td><td width=2%></td><td align=left>$pdata[4]</td></tr>";
			$d1=$d1."<tr><td align=right width=49%>$L_LOGINPART[4]</td><td width=2%></td><td align=left>$pdata[3]</td></tr>";
			$d1=$d1."<tr><td align=right width=49%>$L_LOGINPART[5]</td><td width=2%></td><td align=left>$pdata[7]</td></tr>";
			$d1=$d1."<tr><td align=right width=49%>$L_LOGINPART[6]</td><td width=2%></td><td align=left>$pdata[5]</td></tr>";
			$d1=$d1."<tr><td align=right width=49%>$L_LOGINPART[7]</td><td width=2%></td><td align=left>$pdata[6]</td></tr>";
			$d1=$d1."<tr><td align=right width=49%>$L_LOGINPART[8]</td><td width=2%></td><td align=left>$pdata[8]</td></tr>";
			$d1=$d1."</table></center>";
			collapse_start($L_LOGINPART[0]);
			echo($d1);
			collapse_end();

			$data=array("",$pdata[4],$pdata[3]." ".$pdata[7],"","","","","","","","","","","","");
			$formdata = array
				(
				array("ID","hidden","","","100","$data[0]"),
				array($L_LOGINPART[9],"text",	$L_LOGINPART[9],"","100","$data[1]"),
				array($L_LOGINPART[10],"text",	$L_LOGINPART[10],"","200","$data[2]"),
				array($L_LOGINPART[11],"textarea",$L_LOGINPART[11],"","","$data[3]"),
				array($L_LOGINPART[12],"textarea",$L_LOGINPART[12],"","","$data[4]"),
				);

			collapse_start($L_LOGINPART[1]);
			form_start();
			if ($LOGIN){
				login_to_form();
			}
			if (isset($PARAMFORM)){
				paramform("pagename","login-partner");
			}
			form($L_LOGINPART[13],$formdata,$L_LOGINPART[14]);
			form_end();
			collapse_end();

			collapse_start($L_LOGINPART[2]);
			tabler_form_start();
			if ($LOGIN){
				login_to_form();
			}
			$tab[0]=array("","$L_LOGINPART[17]","$L_LOGINPART[18]","$L_LOGINPART[19]","$L_LOGINPART[20]");
			tablernofilter($tab,false);
			tabler_form_end();
			collapse_end();
	
		}else{
		}
	}

}


?>
