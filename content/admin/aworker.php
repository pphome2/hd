<?php


if (!isset($LANG_ADMIN_WORKER)){
	$LANG_ADMIN_WORKER[0]="Letiltott";
	$LANG_ADMIN_WORKER[1]="Adminisztrátor";
	$LANG_ADMIN_WORKER[2]="Szerkesztő";
	$LANG_ADMIN_WORKER[3]="Vendég";
	$LANG_ADMIN_WORKER[4]="Üzenet";
	$LANG_ADMIN_WORKER[5]="Adat törlése megtörtént!";
	$LANG_ADMIN_WORKER[6]="Új adat rögzítése megtörtént.";
	$LANG_ADMIN_WORKER[7]="Az adat javítása megtörtént.";
	$LANG_ADMIN_WORKER[8]="Dolgozó";
	$LANG_ADMIN_WORKER[9]="E-mail";
	$LANG_ADMIN_WORKER[10]="Telefon";
	$LANG_ADMIN_WORKER[11]="Szerepkör";
	$LANG_ADMIN_WORKER[12]="Felhasználónév";
	$LANG_ADMIN_WORKER[13]="Jelszó";
	$LANG_ADMIN_WORKER[14]="E-mail cím";
	$LANG_ADMIN_WORKER[15]="Szerepkör";
	$LANG_ADMIN_WORKER[16]="Teljes név";
	$LANG_ADMIN_WORKER[17]="Telefon";
	$LANG_ADMIN_WORKER[18]="Megjegyzés";
	$LANG_ADMIN_WORKER[19]="Módosít";
	$LANG_ADMIN_WORKER[20]="Töröl";
	$LANG_ADMIN_WORKER[21]="Új dolgozó";
	$LANG_ADMIN_WORKER[22]="Dolgozó adatai";
	$LANG_ADMIN_WORKER[23]="Új dolgozó mentése";
	$LANG_ADMIN_WORKER[24]="Új dolgozó";
	$LANG_ADMIN_WORKER[25]="Új dolgozó";
	$LANG_ADMIN_WORKER[26]="Dolgozó törlése";
	$LANG_ADMIN_WORKER[27]="Töröl";
}




$data=array("","","","","","","","","","","");
if (isset($_POST["$TABLERPARAM"])){
	$code=$_POST["$TABLERPARAM"];
	$sql="select * from hd_workers where wid like '$code';";
	sql_run_command($sql);
	$sdb=sql_result_num();
	if ($sdb>0){
		$data=sql_result(0);
	}
}


# check data from page

if (isset($_POST["form-0"])){
	if (!isset($_POST["form-3"])){
		# only ID - delete record
		mess_ok($LANG_ADMIN_WORKER[4],$LANG_ADMIN_WORKER[5]);
		$d=$_POST["form-0"];
		$sql="delete from hd_workers where wid='$d';";
	}else{
		# all data arrived
		$db=count($_POST);
		$dt=array("","","","","","","","","","","","","","");
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
				mess_ok($LANG_ADMIN_WORKER[4],$LANG_ADMIN_WORKER[6]);
				$id=id();
				$dt[2]=md5($dt[2]);
				$sql="insert into `hd_workers` (`wid`, `name`, `pass`, `email`, `role`, 
					`fname`, `phone`, `other`) 
					values ('$id', '$dt[1]', '$dt[2]', '$dt[3]', '$dt[4]', 
					'$dt[5]', '$dt[6]', '$dt[7]')";
			}
		}else{
			# ID no empty - change data record
			mess_ok($LANG_ADMIN_WORKER[4],$LANG_ADMIN_WORKER[7]);
			if (!checkmd5($dt[2])){
				$dt[2]=md5($dt[2]);
			}
			$sql="update hd_workers set name='$dt[1]', pass='$dt[2]', email='$dt[3]',
					role='$dt[4]', fname='$dt[5]', phone='$dt[6]', other='$dt[7]'
					where wid='$dt[0]';
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
			array("-",$LANG_ADMIN_WORKER[8],$LANG_ADMIN_WORKER[9],$LANG_ADMIN_WORKER[10],$LANG_ADMIN_WORKER[11])
		);
	sql_run_command("select * from hd_workers;");
	$sdb=sql_result_num();
	for($i=0;$i<$sdb;$i++){
		$t=sql_result($i);
		$k=$i+1;
		$tab[$k]=array($t[0],$t[5],$t[3],$t[6],$t[4]);
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
	# mezőnév, típus, placeholder, válastási lehetőségek, hossz (karakter), érték
	if ($data[4]==""){
		$data[4]=$SYS_USER_ROLE[0];
	}
	$formdata = array
		(
			array("ID","hidden","","","100","$data[0]"),
			array($LANG_ADMIN_WORKER[12],"text",	$LANG_ADMIN_WORKER[12],"","100","$data[1]"),
			array($LANG_ADMIN_WORKER[13],"password",$LANG_ADMIN_WORKER[13],"","100","$data[2]"),
			array($LANG_ADMIN_WORKER[14],"text",	$LANG_ADMIN_WORKER[14],"","100","$data[3]"),
			array($LANG_ADMIN_WORKER[15],"radio",	"","$SYS_USER_ROLE[0];$SYS_USER_ROLE[1];$SYS_USER_ROLE[2];$SYS_USER_ROLE[3]","","$data[4]"),
			array($LANG_ADMIN_WORKER[16],"text",	$LANG_ADMIN_WORKER[16],"","100","$data[5]"),
			array($LANG_ADMIN_WORKER[17],"text",	$LANG_ADMIN_WORKER[17],"","100","$data[6]"),
			array($LANG_ADMIN_WORKER[18],"textarea",$LANG_ADMIN_WORKER[18],"","","$data[7]"),
		);

	form_start();
	if ($MENU){
		menu_to_form();
	}
	if ($LOGIN){
		login_to_form();
	}
	if ($data[0]==""){
		$text=$LANG_ADMIN_WORKER[21];
		$g=$LANG_ADMIN_WORKER[23];
	}else{
		$text=$LANG_ADMIN_WORKER[22];
		$g=$LANG_ADMIN_WORKER[19];
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
		form($LANG_ADMIN_WORKER[24],$formd,$LANG_ADMIN_WORKER[25]);
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
		form($LANG_ADMIN_WORKER[26],$formd,$LANG_ADMIN_WORKER[27]);
		form_end();
	}
}


echo("<div class=spaceline50></div>");
echo("<div class=spaceline50></div>");

?>
