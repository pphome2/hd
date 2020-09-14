<?php


if (!isset($LANG_ADMIN_USER)){
	$LANG_ADMIN_USER[0]="Letiltott";
	$LANG_ADMIN_USER[1]="Adminisztrátor";
	$LANG_ADMIN_USER[2]="Szerkesztő";
	$LANG_ADMIN_USER[3]="Vendég";
	$LANG_ADMIN_USER[4]="Üzenet";
	$LANG_ADMIN_USER[5]="Adat törlése megtörtént!";
	$LANG_ADMIN_USER[6]="Új adat rögzítése megtörtént.";
	$LANG_ADMIN_USER[7]="Az adat javítása megtörtént.";
	$LANG_ADMIN_USER[8]="Felhasználó";
	$LANG_ADMIN_USER[9]="E-mail";
	$LANG_ADMIN_USER[10]="Név";
	$LANG_ADMIN_USER[11]="Cím";
	$LANG_ADMIN_USER[12]="Felhasználó";
	$LANG_ADMIN_USER[13]="Jelszó";
	$LANG_ADMIN_USER[14]="E-mail cím";
	$LANG_ADMIN_USER[15]="Szerepkör";
	$LANG_ADMIN_USER[16]="Teljes név";
	$LANG_ADMIN_USER[17]="Település";
	$LANG_ADMIN_USER[18]="Utca, házszám";
	$LANG_ADMIN_USER[19]="Telefon";
	$LANG_ADMIN_USER[20]="Adószám";
	$LANG_ADMIN_USER[21]="Megjegyzés";
	$LANG_ADMIN_USER[22]="Felhasználó adatai";
	$LANG_ADMIN_USER[23]="Új felhasználó mentése";
	$LANG_ADMIN_USER[24]="Új felhasználó";
	$LANG_ADMIN_USER[25]="Új felhasználó";
	$LANG_ADMIN_USER[26]="Felhasználó törlése";
	$LANG_ADMIN_USER[27]="Töröl";
	$LANG_ADMIN_USER[28]="Új felhasználó";
	$LANG_ADMIN_USER[29]="Módosít";
}





$data=array("","","","","","","","","","","");
if (isset($_POST["$TABLERPARAM"])){
	$code=$_POST["$TABLERPARAM"];
	$sql="select * from hd_users where id like '$code';";
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
		mess_ok($LANG_ADMIN_USER[4],$LANG_ADMIN_USER[5]);
		$d=$_POST["form-0"];
		$sql="delete from hd_users where id='$d';";
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
				mess_ok($LANG_ADMIN_USER[4],$LANG_ADMIN_USER[6]);
				$id=id();
				$dt[2]=md5($dt[2]);
				$sql="insert into `hd_users` (`id`, `name`, `pass`, `email`, `role`, 
					`fname`, `addr1`, `addr2`, `phone`, `num`, `other`) 
					values ('$id', '$dt[1]', '$dt[2]', '$dt[3]', '$dt[4]', 
					'$dt[5]', '$dt[6]', '$dt[7]', '$dt[8]', '$dt[9]', '$dt[10]')";
			}
		}else{
			# ID no empty - change data record
			mess_ok($LANG_ADMIN_USER[4],$LANG_ADMIN_USER[7]);
			if (!checkmd5($dt[2])){
				$dt[2]=md5($dt[2]);
			}
			$sql="update hd_users set name='$dt[1]', pass='$dt[2]', email='$dt[3]',
					role='$dt[4]', fname='$dt[5]', addr1='$dt[6]', addr2='$dt[7]',
					phone='$dt[8]', num='$dt[9]', other='$dt[10]'
					where id='$dt[0]';
					";
		}
	}
	sql_run_command($sql);
}



#echo("<div class=spaceline50></div>");

if (isset($TABLER)){
	$tab=array
		(
			array("-",$LANG_ADMIN_USER[8],$LANG_ADMIN_USER[9],$LANG_ADMIN_USER[10],$LANG_ADMIN_USER[11])
		);
	sql_run_command("select * from hd_users;");
	$sdb=sql_result_num();
	for($i=0;$i<$sdb;$i++){
		$t=sql_result($i);
		$k=$i+1;
		$tab[$k]=array($t[0],$t[1],$t[3],$t[5],$t[6]);
	}
	tabler_form_start();
	if ($MENU){
		menu_to_form();
	}
	if ($LOGIN){
		login_to_form();
	}
	tabler($tab,0,false);
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
			array($LANG_ADMIN_USER[12],"text",	$LANG_ADMIN_USER[12],"","100","$data[1]"),
			array($LANG_ADMIN_USER[13],"password",	$LANG_ADMIN_USER[13],"","100","$data[2]"),
			array($LANG_ADMIN_USER[14],"text",	$LANG_ADMIN_USER[14],"","100","$data[3]"),
			array($LANG_ADMIN_USER[15],"radio",	"","$SYS_USER_ROLE[0];$SYS_USER_ROLE[1];$SYS_USER_ROLE[2];$SYS_USER_ROLE[3]","","$data[4]"),
			array($LANG_ADMIN_USER[16],"text",	$LANG_ADMIN_USER[16],"","100","$data[5]"),
			array($LANG_ADMIN_USER[17],"text",	$LANG_ADMIN_USER[17],"","100","$data[6]"),
			array($LANG_ADMIN_USER[18],"text",	$LANG_ADMIN_USER[18],"","100","$data[7]"),
			array($LANG_ADMIN_USER[19],"text",	$LANG_ADMIN_USER[19],"","100","$data[8]"),
			array($LANG_ADMIN_USER[20],"text",	$LANG_ADMIN_USER[20],"","100","$data[9]"),
			array($LANG_ADMIN_USER[21],"textarea",	$LANG_ADMIN_USER[21],"","","$data[10]"),
		);

	form_start();
	if ($MENU){
		menu_to_form();
	}
	if ($LOGIN){
		login_to_form();
	}
	if ($data[0]==""){
		$text=$LANG_ADMIN_USER[28];
		$g=$LANG_ADMIN_USER[23];
	}else{
		$text=$LANG_ADMIN_USER[22];
		$g=$LANG_ADMIN_USER[29];
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
		form($LANG_ADMIN_USER[24],$formd,$LANG_ADMIN_USER[25]);
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
		form($LANG_ADMIN_USER[26],$formd,$LANG_ADMIN_USER[27]);
		form_end();
	}
}


echo("<div class=spaceline50></div>");
echo("<div class=spaceline50></div>");

?>
