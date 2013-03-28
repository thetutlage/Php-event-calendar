<?php
	session_start();
	if(isset($_SESSION['event_username']))
	{
		session_destroy();
	}
	header("location: login.php");
?>