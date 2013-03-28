<?php
	include_once( 'connection.php' );
	
	if(isset($_POST['add_event']))
	{
		$event_title = trim($_POST['event_title']);
		$event_desc = $_POST['event_desc'];
		$due_on_date = $_POST['due_on_date'];
		$from_time = $_POST['from_time'];
		$to_time = $_POST['to_time'];
		
		if(empty($event_title) || empty($event_desc) || empty($due_on_date) || empty($from_time) ||
		empty($to_time))
		{
			$error = 'All fields are required';
		}
		else
		{
			$from_time = str_replace(':','',$from_time);
			$to_time = str_replace(':','',$to_time);
			if($from_time >= $to_time)
			{
				$error = 'From time cannot be greater than to time';
			}
			else
			{
				$break_date = explode('/',$due_on_date);
				$month = $break_date[0];
				$day = $break_date[1];
				$year = $break_date[2];
				$sql = mysql_query("INSERT INTO calendar_event (event,description,day,month,year,time_from,time_until) 
					VALUES ('$event_title','$event_desc','$day','$month','$year','$from_time','$to_time')
				");
				
				$affect = mysql_affected_rows();
				if($affect >= 1)
				{
					$success = 'Event added successfully';
				}
				else
				{
					$error = 'There was an error';
				}
			}
		}
	}
?>