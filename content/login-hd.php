<?php

if (!isset($L_LOGINHD)){
	$L_LOGINHD[0]="Bejelentés ideje";
	$L_LOGINHD[1]="Hibás eszköz";
	$L_LOGINHD[2]="Hiba";
	$L_LOGINHD[3]="Állapot";
	$L_LOGINHD[4]="Ügyfél";
	$L_LOGINHD[5]="Érkezett, kiadva";
	$L_LOGINHD[6]="Bevizsgálás alatt";
	$L_LOGINHD[7]="Alkatrészre vár";
	$L_LOGINHD[8]="Javított, lezárva";
	$L_LOGINHD[9]="Üzenet";
	$L_LOGINHD[10]="Új hibajegy mentése";
	$L_LOGINHD[11]="Bejelentés adatai";
	$L_LOGINHD[12]="Hiba bejelentője";
	$L_LOGINHD[13]="Kapcsolat";
	$L_LOGINHD[14]="Hibás eszköz";
	$L_LOGINHD[15]="Hiba leírása";
	$L_LOGINHD[16]="Státusz";
	$L_LOGINHD[17]="Javítást végző";
	$L_LOGINHD[18]="Elvégzett munka leírása";
	$L_LOGINHD[19]="Felhasznált alkatrészek";
	$L_LOGINHD[20]="Munkaidő";
	$L_LOGINHD[21]="Kiszállás (km)";
	$L_LOGINHD[22]="Módosítás / Befejezés dátuma";
	$L_LOGINHD[23]="Módosít";
	$L_LOGINHD[24]="Új hibajegy";
	$L_LOGINHD[25]="Új hibajegy";
	$L_LOGINHD[26]="Hibajegy törlése";
	$L_LOGINHD[27]="Töröl";
	$L_LOGINHD[28]="Saját feladat";
	$L_LOGINHD[29]="Hiba bejelentő";
	$L_LOGINHD[30]="Hiba bejelentő";
	$L_LOGINHD[31]="Munkalap";
	$L_LOGINHD[32]="Munkalap";
	$L_LOGINHD[33]="Adatok tárolása megtörtént.";
	$L_LOGINHD[34]="Adatok módosítása megtörtént.";
}



if (isset($_POST["WORKPAGE"])){
	$code=$_POST["WORKPAGE"];
	echo("w $code");
	$f=$SYS_CONTENT_DIR."print_w.php";
	echo("<script>window.location = \"$f?c=$code\";</script>");
}

if (isset($_POST["ERRPAGE"])){
	$code=$_POST["ERRPAGE"];
	$f=$SYS_CONTENT_DIR."print_h.php";
	echo("<script>window.location = \"$f?c=$code\";</script>");
	echo("e $code");
}



if ($SQL_CONNECT){
	sql_run_command("select * from hd_workers;");
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
			paramform("pagename","login-hd");
		}
		login_form();
		login_form_end();
	}
}else{

	if (isset($_POST["form-0"])){
		if (isset($_POST["form-3"])){
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
			if ($dt[0]==""){
				# no ID - new change
				if ($dt[1]<>""){
					$id=id();
					mess_ok($L_LOGINHD[9],$L_LOGINHD[33]);
					$sql="insert into `hd_tickets` (`tid`, `uid`, `cont`, `dev`, `err`, 
						`stat`, `worker`, `work`, `part`, `hour`, `km`, `wdate`) 
						values ('$id', '$dt[1]', '$dt[2]', '$dt[3]', '$dt[4]', 
						'$dt[5]', '$dt[6]', '$dt[7]', '$dt[8]', $dt[9], 
						$dt[10], '$dt[11]')";
				}
			}else{
				# ID no empty - change data record
				mess_ok($L_LOGINHD[9],$L_LOGINHD[34]);
				$sql="update hd_tickets set uid='$dt[1]', cont='$dt[2]', dev='$dt[3]',
						err='$dt[4]', stat='$dt[5]', worker='$dt[6]', work='$dt[7]',
						part='$dt[8]', hour=$dt[9], km=$dt[10], wdate='$dt[11]'
						where tid='$dt[0]';
						";
			}
		}
		#echo($sql);
		sql_run_command($sql);
	}

	$status=array($L_LOGINHD[5],$L_LOGINHD[6],$L_LOGINHD[7],$L_LOGINHD[8]);

	$data=array("","","","","","","","","","0","0","","","","");
	if (isset($_POST["$TABLERPARAM"])){
		$code=$_POST["$TABLERPARAM"];
		$sql="select * from hd_tickets where tid like '$code';";
		sql_run_command($sql);
		$sdb=sql_result_num();
		if ($sdb>0){
			$data=sql_result(0);
		}
	}

	$pdata=array();
	if ($SQL_CONNECT){
		sql_run_command("select * from hd_workers where name='$LOGIN_NAME';");
		$sdb=sql_result_num();
		for($i=0;$i<$sdb;$i++){
			$t=sql_result($i);
			if (($t[1]==$LOGIN_NAME)and($t[2]==$LOGIN_PASS)){
				$pdata=$t;
			}
		}
	}
	$data[6]=$pdata[5];

	$edata=array();
	if ($SQL_CONNECT){
		sql_run_command("select * from hd_tickets where worker='$pdata[5]' and stat<>'$L_LOGINHD[8]' order by tid desc;");
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
			$tab[$k]=array($t[0],$tdate,$t[1],$t[3],$t[4],$t[5]);
		}
	}

	if (isset($pdata[0])){
			tabler_form_start();
			if ($LOGIN){
				login_to_form();
			}
			if (isset($PARAMFORM)){
				paramform("pagename","login-hd");
			}
			$tab[0]=array("","$L_LOGINHD[0]","$L_LOGINHD[4]","$L_LOGINHD[1]","$L_LOGINHD[2]","$L_LOGINHD[3]");
			tablerallfilter($tab,false);
			tabler_form_end();
	}

	echo("<div class=spaceline50></div>");
	echo("<div class=spaceline50></div>");

	if (isset($FORM)){

		$workerline="";
	
		$partner="$LOCAL_COMPANY_NAME - $L_LOGINHD[28]";
		$sql="select * from hd_partners;";
		sql_run_command($sql);
		$sdb=sql_result_num();
		if ($sdb>0){
			for($i=0;$i<$sdb;$i++){
				$pline=sql_result($i);
				$partner=$partner.";".$pline[4];
			}
		}
	
		# mezőnév, típus, placeholder, válastási lehetőségek, hossz (karakter), érték
		$data[11]=date('Y.m.d. H:i.');
		$stat=$status[0];$status[1];$status[2];$status[3];
		$formdata = array
			(
				array("ID","hidden","","","100","$data[0]"),
				array($L_LOGINHD[12],"select",	$L_LOGINHD[12],"$partner","100","$data[1]"),
				array($L_LOGINHD[13],"text",	$L_LOGINHD[13],"","200","$data[2]"),
				array($L_LOGINHD[14],"textarea",$L_LOGINHD[14],"","",	"$data[3]"),
				array($L_LOGINHD[15],"textarea",$L_LOGINHD[15],"","",	"$data[4]"),
				array($L_LOGINHD[16],"select",	$L_LOGINHD[16],"$stat","100","$data[5]"),
				array($L_LOGINHD[17],"readonly",$L_LOGINHD[17],"","100","$data[6]"),
				array($L_LOGINHD[18],"textarea",$L_LOGINHD[18],"","",	"$data[7]"),
				array($L_LOGINHD[19],"textarea",$L_LOGINHD[19],"","",	"$data[8]"),
				array($L_LOGINHD[20],"text",	$L_LOGINHD[20],"","4",	"$data[9]"),
				array($L_LOGINHD[21],"text",	$L_LOGINHD[21],"","6",	"$data[10]"),
				array($L_LOGINHD[22],"text",	$L_LOGINHD[22],"","20",	"$data[11]"),
			);
	
		form_start();
		if (isset($PARAMFORM)){
			paramform("pagename","login-hd");
		}
		if ($LOGIN){
			login_to_form();
		}
		if ($data[0]==""){
			$g=$L_LOGINHD[10];
		}else{
			$g=$L_LOGINHD[23];
		}
		form($L_LOGINHD[11],$formdata,$g);
		form_end();

		if ($data[0]<>""){
			form_start();
			if (isset($PARAMFORM)){
				paramform("pagename","login-hd");
			}
			if ($LOGIN){
				login_to_form();
			}
			$formd=array();
			form($L_LOGINHD[25],$formd,$L_LOGINHD[25]);
			form_end();
	
			form_start();
			if ($LOGIN){
				login_to_form();
			}
			if (isset($PARAMFORM)){
				paramform("pagename","login-hd");
			}
			form_to_input("ERRPAGE","$data[0]");
			$formd=array();
			form($L_LOGINHD[29],$formd,$L_LOGINHD[30]);
			form_end();

			form_start();
			if ($LOGIN){
				login_to_form();
			}
			if (isset($PARAMFORM)){
				paramform("pagename","login-hd");
			}
			form_to_input("WORKPAGE","$data[0]");
			$formd=array();
			form($L_LOGINHD[31],$formd,$L_LOGINHD[32]);
			form_end();
		}
	}


echo("<div class=spaceline50></div>");
echo("<div class=spaceline50></div>");





}


?>
