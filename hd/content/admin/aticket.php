<?php


if (!isset($LANG_ADMIN_TICKET)){
	$LANG_ADMIN_TICKET[0]="Érkezett, kiadva";
	$LANG_ADMIN_TICKET[1]="Bevizsgálás alatt";
	$LANG_ADMIN_TICKET[2]="Alkatrészre vár";
	$LANG_ADMIN_TICKET[3]="Javított, lezárva";
	$LANG_ADMIN_TICKET[4]="Üzenet";
	$LANG_ADMIN_TICKET[5]="Adat törlése megtörtént!";
	$LANG_ADMIN_TICKET[6]="Új adat rögzítése megtörtént.";
	$LANG_ADMIN_TICKET[7]="Az adat javítása megtörtént.";
	$LANG_ADMIN_TICKET[8]="Dátum";
	$LANG_ADMIN_TICKET[9]="Bejelentő";
	$LANG_ADMIN_TICKET[10]="Hiba";
	$LANG_ADMIN_TICKET[11]="Státusz";
	$LANG_ADMIN_TICKET[12]="Hiba bejelentője";
	$LANG_ADMIN_TICKET[13]="Kapcsolat (telefon/e-mail)";
	$LANG_ADMIN_TICKET[14]="Hibás eszköz";
	$LANG_ADMIN_TICKET[15]="Hiba leírása";
	$LANG_ADMIN_TICKET[16]="Státusz";
	$LANG_ADMIN_TICKET[17]="Javítást végző";
	$LANG_ADMIN_TICKET[18]="Elvégzett munka leírása";
	$LANG_ADMIN_TICKET[19]="Felhasznált alkatrészek";
	$LANG_ADMIN_TICKET[20]="Munkaidő";
	$LANG_ADMIN_TICKET[21]="Kiszállás (km)";
	$LANG_ADMIN_TICKET[22]="Módosítás / Befejezés dátuma";
	$LANG_ADMIN_TICKET[23]="Új hibajegy mentése";
	$LANG_ADMIN_TICKET[24]="Új hibajegy";
	$LANG_ADMIN_TICKET[25]="Új hibajegy";
	$LANG_ADMIN_TICKET[26]="Hibajegy törlése";
	$LANG_ADMIN_TICKET[27]="Töröl";
	$LANG_ADMIN_TICKET[28]="Saját feladat";
	$LANG_ADMIN_TICKET[29]="Hiba bejelentő";
	$LANG_ADMIN_TICKET[30]="Hiba bejelentő";
	$LANG_ADMIN_TICKET[31]="Munkalap";
	$LANG_ADMIN_TICKET[32]="Munkalap";
	$LANG_ADMIN_TICKET[33]="Új hibajegy";
	$LANG_ADMIN_TICKET[34]="Hibajegy módosítása";
	$LANG_ADMIN_TICKET[35]="Módosít";
}


$status=array($LANG_ADMIN_TICKET[0],$LANG_ADMIN_TICKET[1],$LANG_ADMIN_TICKET[2],$LANG_ADMIN_TICKET[3]);


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


# check data from page

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



if (isset($_POST["form-0"])){
	if (!isset($_POST["form-3"])){
		# only ID - delete record
		mess_ok($LANG_ADMIN_TICKET[4],$LANG_ADMIN_TICKET[5]);
		$d=$_POST["form-0"];
		$sql="delete from hd_tickets where tid='$d';";
	}else{
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
				mess_ok($LANG_ADMIN_TICKET[4],$LANG_ADMIN_TICKET[6]);
				$id=id();
				$sql="insert into `hd_tickets` (`tid`, `uid`, `cont`, `dev`, `err`, 
					`stat`, `worker`, `work`, `part`, `hour`, `km`, `wdate`) 
					values ('$id', '$dt[1]', '$dt[2]', '$dt[3]', '$dt[4]', 
					'$dt[5]', '$dt[6]', '$dt[7]', '$dt[8]', $dt[9], 
					$dt[10], '$dt[11]')";
			}
		}else{
			# ID no empty - change data record
			mess_ok($LANG_ADMIN_TICKET[4],$LANG_ADMIN_TICKET[7]);
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



#echo("<div class=spaceline50></div>");

if (isset($TABLER)){
	$tab=array
		(
			array("-",$LANG_ADMIN_TICKET[8],$LANG_ADMIN_TICKET[9],$LANG_ADMIN_TICKET[10],$LANG_ADMIN_TICKET[11])
		);
	sql_run_command("select * from hd_tickets;");
	$sdb=sql_result_num();
	for($i=0;$i<$sdb;$i++){
		$t=sql_result($i);
		$k=$i+1;
		$tdate=substr($t[0],0,12);
		$tdate=substr($t[0],0,4).'.'.substr($t[0],4,2).'.';
		$tdate=$tdate.substr($t[0],6,2).'. '.substr($t[0],8,2).':';
		$tdate=$tdate.substr($t[0],10,2).'.';
		$tab[$k]=array($t[0],$tdate,$t[1],$t[4],$t[5]);
	}
	tabler_form_start();
	if ($MENU){
		menu_to_form();
	}
	if ($LOGIN){
		login_to_form();
	}
	tablerallfilter($tab,false);
	tabler_form_end();
}

echo("<div class=spaceline50></div>");
echo("<div class=spaceline50></div>");

if (isset($FORM)){

	$workerline="";
	$sql="select * from hd_workers;";
	sql_run_command($sql);
	$sdb=sql_result_num();
	if ($sdb>0){
		for($i=0;$i<$sdb;$i++){
			$wline=sql_result($i);
			$workerline=$workerline.";".$wline[5];
		}
	}

	$partner="$LOCAL_COMPANY_NAME - $LANG_ADMIN_TICKET[28]";
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
	$formdata = array
		(
			array("ID","hidden","","","100","$data[0]"),
			array($LANG_ADMIN_TICKET[12],"select",	$LANG_ADMIN_TICKET[12],"$partner","100","$data[1]"),
			array($LANG_ADMIN_TICKET[13],"text",	$LANG_ADMIN_TICKET[13],"","200","$data[2]"),
			array($LANG_ADMIN_TICKET[14],"textarea",$LANG_ADMIN_TICKET[14],"","",	"$data[3]"),
			array($LANG_ADMIN_TICKET[15],"textarea",$LANG_ADMIN_TICKET[15],"","",	"$data[4]"),
			array($LANG_ADMIN_TICKET[16],"select",	$LANG_ADMIN_TICKET[16],"$status[0];$status[1];$status[2];$status[3]","100","$data[5]"),
			array($LANG_ADMIN_TICKET[17],"select",	$LANG_ADMIN_TICKET[17],"$workerline","100","$data[6]"),
			array($LANG_ADMIN_TICKET[18],"textarea",$LANG_ADMIN_TICKET[18],"","",	"$data[7]"),
			array($LANG_ADMIN_TICKET[19],"textarea",$LANG_ADMIN_TICKET[19],"","",	"$data[8]"),
			array($LANG_ADMIN_TICKET[20],"text",	$LANG_ADMIN_TICKET[20],"","4",	"$data[9]"),
			array($LANG_ADMIN_TICKET[21],"text",	$LANG_ADMIN_TICKET[21],"","6",	"$data[10]"),
			array($LANG_ADMIN_TICKET[22],"text",	$LANG_ADMIN_TICKET[22],"","20",	"$data[11]"),
		);

	form_start();
	if ($MENU){
		menu_to_form();
	}
	if ($LOGIN){
		login_to_form();
	}
	if ($data[0]==""){
		$text=$LANG_ADMIN_TICKET[33];
		$g=$LANG_ADMIN_TICKET[23];
	}else{
		$text=$LANG_ADMIN_TICKET[34];
		$g=$LANG_ADMIN_TICKET[35];
	}
	form($text,$formdata,$g);
	form_end();
	
	if ($data[0]<>""){
		form_start();
		if ($MENU){
			menu_to_form();
		}
		if ($LOGIN){
			login_to_form();
		}
		$formd=array();
		form($LANG_ADMIN_TICKET[25],$formd,$LANG_ADMIN_TICKET[25]);
		form_end();



		form_start();
		if ($MENU){
			menu_to_form();
		}
		if ($LOGIN){
			login_to_form();
		}
		$formd=array(
					array("ID","hidden","","","100","$data[0]")
				);
		form($LANG_ADMIN_TICKET[26],$formd,$LANG_ADMIN_TICKET[27]);
		form_end();


		form_start();
		if ($MENU){
			menu_to_form();
		}
		if ($LOGIN){
			login_to_form();
		}
		form_to_input("ERRPAGE","$data[0]");
		$formd=array();
		form($LANG_ADMIN_TICKET[29],$formd,$LANG_ADMIN_TICKET[30]);
		form_end();


		form_start();
		if ($MENU){
			menu_to_form();
		}
		if ($LOGIN){
			login_to_form();
		}
		form_to_input("WORKPAGE","$data[0]");
		$formd=array();
		form($LANG_ADMIN_TICKET[31],$formd,$LANG_ADMIN_TICKET[32]);
		form_end();
	}
}


echo("<div class=spaceline50></div>");
echo("<div class=spaceline50></div>");

?>
