<?php


echo("</div>");

# End content

# ------------------------------------------

if (!isset($L_FOOTER)){
	$L_FOOTER[0]="Helpdesk";
	$L_FOOTER[1]="Ügyfélkapu";
	$L_FOOTER[2]="Kilépés";
}



echo("<footer>");

if (!$LOGGED_IN){
	echo("<div class=row>");
	echo("<div class=col3>");
	if (isset($BUTTON)){
		buttonform_start();
		button($L_FOOTER[0],"login-hd");
		buttonform_end();
	}
	echo("</div>");
	echo("<div class=col3>");
	echo("<div class=colcontent>");
	echo("</div>");
	echo("</div>");
	echo("<div class=col3>");
	if (isset($BUTTON)){
		buttonform_start();
		button($L_FOOTER[1],"login-partner");
		buttonform_end();
	}
	echo("</div>");
	echo("</div>");
}else{
	echo("<div class=row>");
		echo("<div class=col3>");
			echo("<div class=colcontent>");
			echo("</div>");
		echo("</div>");
		echo("<div class=col3>");
		if (isset($BUTTON)){
			buttonform_start();
			button($L_FOOTER[2],"logout");
			buttonform_end();
		}
		echo("</div>");
		echo("<div class=col3>");
			echo("<div class=colcontent>");
			echo("</div>");
		echo("</div>");
	echo("</div>");
}


if (isset($COLUMN)){
	$c = array
		(
			array("Autó","Renault","Saab"),
			array("Eladva",22,18),
			#array("Dobozolt"15,13),
			#array("Újszerű",5,2),
			array("Raktáron",17,12)
		);
	#column_footer($c);
}



if (isset($GDPR)){
	gdpr();
}

if (isset($GOTOTOP)){
	gototop();
}


if (isset($FOOTER)){
	$copyr=$SYS_COPYRIGHT." "."<a href='../admin'>A</a>";
	footer($copyr,$SYS_DEVELOPER,$SYS_DEVELOPER_NAME,$SYS_DEVELOPER_MAIL);
}


echo("</footer>");


?>
