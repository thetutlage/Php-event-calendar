<?php

	include_once( 'connection.php' );
	
	if(isset($_POST['login']))
	{
		$username = $_POST['username_id'];
		$password = $_POST['password'];
		
		if(empty($username) || empty($password)){
			$error = 'All fields are required';
		}
		else{
			$password = md5($password);
			$sql = mysql_query("SELECT * FROM calendar_users WHERE username = '$username' AND password = '$password' LIMIT 1");
			$num_rows = mysql_num_rows($sql);
	
			if($num_rows >= 1)
			{
				session_start();
				$_SESSION['event_username'] = $username;
				header("location: index.php");
			}
			else
			{
				$error = 'Invalid Credentials';
			}
		}
	}
	
?>