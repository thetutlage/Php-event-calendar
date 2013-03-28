<?php
	include_once( 'connection.php' );
	
	if(isset($_GET['action']) && $_GET['action'] == 'true'){
		$id = $_GET['id'];
		
		$sql = mysql_query("DELETE FROM calendar_event WHERE id = '$id' LIMIT 1");
		$row = mysql_affected_rows();
		
		if($row >= 1)
		{
			$success = 'Event deleted successfully <a href="index.php" title="Go Back"> Go Back </a>';
		}
		else
		{
			$error = 'There was an error deleting this event';
		}
	}

?>