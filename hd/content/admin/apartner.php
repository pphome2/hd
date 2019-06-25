<?php


if (!isset($LANG_ADMIN_PARTNER)){
	$LANG_ADMIN_PARTNER[0]="Letiltott";
	$LANG_ADMIN_PARTNER[1]="Adminisztrátor";
	$LANG_ADMIN_PARTNER[2]="Szerkesztő";
	$LANG_ADMIN_PARTNER[3]="Vendég";
	$LANG_ADMIN_PARTNER[4]="Üzenet";
	$LANG_ADMIN_PARTNER[5]="Adat törlése megtörtént!";
	$LANG_ADMIN_PARTNER[6]="Új adat rögzítése megtörtént.";
	$LANG_ADMIN_PARTNER[7]="Az adat javítása megtörtént.";
	$LANG_ADMIN_PARTNER[8]="Ügyfél neve";
	$LANG_ADMIN_PARTNER[9]="E-mail";
	$LANG_ADMIN_PARTNER[10]="Telefon";
	$LANG_ADMIN_PARTNER[11]="Cím";
	$LANG_ADMIN_PARTNER[12]="Felhasználó";
	$LANG_ADMIN_PARTNER[13]="Jelszó";
	$LANG_ADMIN_PARTNER[14]="E-mail cím";
	$LANG_ADMIN_PARTNER[15]="Szerepkör";
	$LANG_ADMIN_PARTNER[16]="Ügyfél neve";
	$LANG_ADMIN_PARTNER[17]="Település";
	$LANG_ADMIN_PARTNER[18]="Utca, házszám";
	$LANG_ADMIN_PARTNER[19]="Telefon";
	$LANG_ADMIN_PARTNER[20]="Adószám";
	$LANG_ADMIN_PARTNER[21]="Megjegyzés";
	$LANG_ADMIN_PARTNER[22]="Ügyfél adatai";
	$LANG_ADMIN_PARTNER[23]="Új ügyfél mentése";
	$LANG_ADMIN_PARTNER[24]="Új ügyfél";
	$LANG_ADMIN_PARTNER[25]="Új ügyfél";
	$LANG_ADMIN_PARTNER[26]="Ügyfél törlése";
	$LANG_ADMIN_PARTNER[27]="Töröl";
	$LANG_ADMIN_PARTNER[28]="Új ügyfél";
	$LANG_ADMIN_PARTNER[29]="Módosít";
}




$data=array("","","","","","","","","","","");
if (isset($_POST["$TABLERPARAM"])){
	$code=$_POST["$TABLERPARAM"];
	$sql="select * from hd_partners where pid like '$code';";
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
		mess_ok($LANG_ADMIN_PARTNER[4],$LANG_ADMIN_PARTNER[5]);
		$d=$_POST["form-0"];
		$sql="delete from hd_partners where pid='$d';";
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
				mess_ok($LANG_ADMIN_PARTNER[4],$LANG_ADMIN_PARTNER[6]);
				$id=id();
				$dt[2]=md5($dt[2]);
				$sql="insert into `hd_partners` (`pid`, `name`, `pass`, `email`,
					`fname`, `addr1`, `addr2`, `phone`, `num`, `other`) 
					values ('$id', '$dt[1]', '$dt[2]', '$dt[3]', '$dt[4]', 
					'$dt[5]', '$dt[6]', '$dt[7]', '$dt[8]', '$dt[9]')";
			}
		}else{
			# ID no empty - change data record
			mess_ok($LANG_ADMIN_PARTNER[4],$LANG_ADMIN_PARTNER[7]);
			if (!checkmd5($dt[2])){
				$dt[2]=md5($dt[2]);
			}
			$sql="update hd_partners set name='$dt[1]', pass='$dt[2]', email='$dt[3]',
					fname='$dt[4]', addr1='$dt[5]', addr2='$dt[6]',
					phone='$dt[7]', num='$dt[8]', other='$dt[9]'
					where pid='$dt[0]';
					";
		}
	}
	sql_run_command($sql);
}



#echo("<div class=spaceline50></div>");

if (isset($TABLER)){
	$tab=array
		(
			array("-",$LANG_ADMIN_PARTNER[8],$LANG_ADMIN_PARTNER[9],$LANG_ADMIN_PARTNER[10],$LANG_ADMIN_PARTNER[11])
		);
	sql_run_command("select * from hd_partners;");
	$sdb=sql_result_num();
	for($i=0;$i<$sdb;$i++){
		$t=sql_result($i);
		$k=$i+1;
		$tab[$k]=array($t[0],$t[4],$t[3],$t[7],$t[6]);
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
	$formdata = array
		(
			array("ID","hidden","","","100","$data[0]"),
			array($LANG_ADMIN_PARTNER[12],"text",	$LANG_ADMIN_PARTNER[12],"","100","$data[1]"),
			array($LANG_ADMIN_PARTNER[13],"password",$LANG_ADMIN_PARTNER[13],"","100","$data[2]"),
			array($LANG_ADMIN_PARTNER[14],"text",	$LANG_ADMIN_PARTNER[14],"","100","$data[3]"),
			array($LANG_ADMIN_PARTNER[16],"text",	$LANG_ADMIN_PARTNER[16],"","100","$data[4]"),
			array($LANG_ADMIN_PARTNER[17],"text",	$LANG_ADMIN_PARTNER[17],"","100","$data[5]"),
			array($LANG_ADMIN_PARTNER[18],"text",	$LANG_ADMIN_PARTNER[18],"","100","$data[6]"),
			array($LANG_ADMIN_PARTNER[19],"text",	$LANG_ADMIN_PARTNER[19],"","100","$data[7]"),
			array($LANG_ADMIN_PARTNER[20],"text",	$LANG_ADMIN_PARTNER[20],"","100","$data[8]"),
			array($LANG_ADMIN_PARTNER[21],"textarea",$LANG_ADMIN_PARTNER[21],"","","$data[9]"),
		);

	form_start();
	if ($MENU){
		menu_to_form();
	}
	if ($LOGIN){
		login_to_form();
	}
	if ($data[0]==""){
		$text=$LANG_ADMIN_PARTNER[28];
	}else{
		$text=$LANG_ADMIN_PARTNER[22];
	}
	if ($data[0]==""){
		$g=$LANG_ADMIN_PARTNER[23];
	}else{
		$g=$LANG_ADMIN_PARTNER[29];
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
		form($LANG_ADMIN_PARTNER[24],$formd,$LANG_ADMIN_PARTNER[25]);
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
		form($LANG_ADMIN_PARTNER[26],$formd,$LANG_ADMIN_PARTNER[27]);
		form_end();
	}
}


echo("<div class=spaceline50></div>");
echo("<div class=spaceline50></div>");

?>
