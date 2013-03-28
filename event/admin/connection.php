<?php if(file_exists('../config.php')){ include_once( '../config.php' );}else{header("location: install.php");} ?>
<?php
$db = dbconn(DB_HOST,DB_NAME,DB_USER,DB_PASSWORD);
function dbconn($server,$database,$user,$pass){
	$db = mysql_connect($server,$user,$pass);
	$db_select = mysql_select_db($database,$db);
	return $db;
}