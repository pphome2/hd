<?php

 #
 # MiniCMS
 #
 # MySQL driver
 #
 # info: main folder copyright file
 #
 #


global	$SQL_SERVER,
	$SQL_PORT,
	$SQL_DATABASE,
	$SQL_USER,
	$SQL_PASSWORD,
	$SQL_LINK,
	$SQL_RESULT,
	$SQL_ERROR,
	$SQL_ERROR_SHOW,
	$SQL_SUPPORT,
	$SQL_CONNECT;


$SQL_SUPPORT=true;

$SQL_LINK=mysqli_connect($SQL_SERVER,$SQL_USER,$SQL_PASSWORD,$SQL_DATABASE);
if (!$SQL_LINK){
	$SQL_CONNECT=false;
	$SQL_ERROR=mysqli_connect_error();
	if (($SQL_ERROR<>"")and($SQL_ERROR_SHOW)){
		echo($SQL_ERROR);
	}
}else{
	$SQL_CONNECT=true;
	mysqli_close($SQL_LINK);
}



	function sql_server_close(){
		sql_connect_close();
	}


	function sql_server_connect(){
		global 	$SQL_SERVER,
				$SQL_PORT,
				$SQL_DATABASE,
				$SQL_USER,
				$SQL_PASSWORD,
				$SQL_LINK,
				$SQL_CONNECT,
				$SQL_ERROR,
				$SQL_RESULT;

		$SQL_LINK="";
		if ($SQL_CONNECT){
			$SQL_LINK=mysqli_connect($SQL_SERVER,$SQL_USER,$SQL_PASSWORD,$SQL_DATABASE);
			$SQL_ERROR=mysqli_error($SQL_LINK);
			if ($SQL_ERROR<>""){
			}
		}
	}


	function sql_server_query($sqlcomm=''){
		global	$SQL_LINK,
			$SQL_ERROR,
			$SQL_CONNECT,
			$SQL_ERROR_SHOW,
			$SQL_RESULT;

		if ($SQL_CONNECT){
		$SQL_RESULT=mysqli_query($SQL_LINK,$sqlcomm);
			$SQL_ERROR=mysqli_error($SQL_LINK);
			if (($SQL_ERROR<>"")and($SQL_ERROR_SHOW)){
				echo(SQL_ERROR);
			}
		}
	}


	function sql_connect_close(){
		global $SQL_LINK;

		if ($SQL_LINK){
			mysqli_close($SQL_LINK);
			$SQL_LINK="";
		}
	}


	function sql_run_command($sql_command=''){
		global 	$SQL_SERVER,
				$SQL_PORT,
				$SQL_DATABASE,
				$SQL_USER,
				$SQL_PASSWORD,
				$SQL_LINK,
				$SQL_RESULT;

		sql_server_connect($SQL_SERVER,$SQL_USER,$SQL_PASSWORD,$SQL_DATABASE);
		if ($SQL_LINK){
			sql_server_query($sql_command);
			sql_server_close();
		}
	}


	function sql_result_num(){
		global $SQL_RESULT;

		if ($SQL_RESULT){
			$d=mysqli_num_rows($SQL_RESULT);
		}else{
			$d=0;
		}
		return($d);
	}


	function sql_result_fields(){
		global $SQL_RESULT;

		if ($SQL_RESULT){
			$d=mysqli_num_fields($SQL_RESULT);
		}else{
			$d=0;
		}
		return($d);
	}


	function sql_result_alldata(){
		global $SQL_RESULT;

		$d=$SQL_RESULT;
		return($d);
	}


	function sql_result($s=''){
		global $SQL_RESULT;

		$datarow=array();
		if ($SQL_RESULT){
			if (mysqli_num_rows($SQL_RESULT)>$s){
				#$d=mysqli_result($SQL_RESULT,$s,$o);
				$SQL_RESULT->data_seek($s);
				$datarow=$SQL_RESULT->fetch_array();
			}
		}
		return($datarow);
	}


	function sql_table_search($table='',$field='',$q=''){
		global $SQL_RESULT;

		if (($table<>"")and($field<>"")and($q<>"")){
			$q=trim($q);
			$sqlcommand="select * from $table where $field like '%$q%';";
			$SQL_RESULT=sql_run_command($sqlcommand);
		}
	}


	function sql_result_all($s=''){
		global $SQL_RESULT;

		if (mysqli_num_rows($SQL_RESULT)>$s){
			$SQL_RESULT->data_seek($s);
			$SQL_RESULT=mysqli_fetch_row($SQL_RESULT);
		}
	}


	function sql_delete_alldata_table($tn=''){
		if ($tn<>""){
			$sqlcommand="delete from $tn;";
			sql_run_command($sqlcommand);
		}
	}


	function sql_insert_data_table($to='',$tn=''){
		if ($tn<>""){
		$c=count($to);
		$v=0;
		$sqlcommand="insert into $tn values(";
		while ($v<$c){
			if ($v>0){
			$sqlcommand=$sqlcommand.",";
			}
			$sqlcommand=$sqlcommand.'"'.$to[$v].'"';
			$v++;
		}
		$sqlcommand=$sqlcommand.");";
		sql_run_command($sqlcommand);
		}
	}


	function sql_table_insert_data($table='',$data=array()){
		$sqlcommand="insert into $table values (";
		$x=count($data);
		$y=0;
		while($y<$x){
			if ($y<>0){
			$sqlcommand=$sqlcommand.",";
		}
		$sqlcommand=$sqlcommand."\"".$data[$y]."\"";
		$y++;
		}
		$sqlcommand=$sqlcommand.");";
		sql_run_command($sqlcommand);
  }



	function sql_table_update_data($table='',$data=array(),$rowname='',$fname='',$where=''){
		$sqlcommand="update $table set ";
		$x=count($data);
		$y=0;
		while($y<$x){
			if ($y<>0){
				$sqlcommand=$sqlcommand.",";
			}
		$sqlcommand=$sqlcommand."$rowname[$y]=\"".$data[$y]."\"";
		$y++;
		}
		$sqlcommand=$sqlcommand." where $fname=\"$where\";";
		sql_run_command($sqlcommand);
	}


	function sql_table_delete_data($table='',$field='',$data=''){
		$sqlcommand="delete from $table where $field=\"$data\";";
		sql_run_command($sqlcommand);
	}


	function sql_table_select($table='',$name='',$where='',$order='',$desc=''){
		$sqlcommand="select *";
		$sqlcommand=$sqlcommand." from $table ";
		if ($where<>""){
			$sqlcommand=$sqlcommand." where $name=\"$where\" ";
		}
		if ($order<>""){
			$sqlcommand=$sqlcommand." order by $order ";
		}
		if ($desc<>""){
			$sqlcommand=$sqlcommand." desc ";
		}
		$sqlcommand=$sqlcommand.";";
		sql_run_command($sqlcommand);
	}


	function sql_pack_command($sqlresult=array(),$command=array()){
		$x=count($command);
		$y=0;
		while ($y<$x){
			$sqlresult[$y]=$sqlresult[$y].sql_run_command($command[$y]);
			$y++;
		}
	}


	function sql_db_create($db=''){
		$sqlcommand="create database $db;";
		sql_run_command($sqlcommand);
	}


	function sql_table_create($tname='',$tabledata=array(),$tablevar=array(),$mess=''){
		$sqlcommand="create table $tname (";
		$x=count($tabledata);
		$y=0;
		while ($y<$x){
			$sqlcommand=$sqlcommand."$tabledata[$y] $tablevar[$y], ";
			$y++;
		}
		$sqlcommand=$sqlcommand." unique ($tabledata[0])";
		$sqlcommand=$sqlcommand.");";
		sql_run_command($sqlcommand);
	}


	function sql_db_delete($db=''){
		$sqlcommand="drop database $db;";
		sql_run_command($sqlcommand);
	}


	function sql_table_delete($tname=''){
		$sqlcommand="drop table $tname;";
		sql_run_command($db,$sqlcommand);
	}


?>
