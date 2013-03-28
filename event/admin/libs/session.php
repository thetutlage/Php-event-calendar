<?php
	session_start();
	if(!isset($_SESSION['event_username'])){
		header("location: login.php");
	}

?>