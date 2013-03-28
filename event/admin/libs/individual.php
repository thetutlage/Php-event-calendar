<?php

	include_once( 'connection.php' );
	$id = $_GET['id'];
	$sql = mysql_query("SELECT * FROM calendar_event WHERE id = '$id' ORDER BY id DESC");
	$row = mysql_num_rows($sql);
	$output = '';
	if($row >= 1)
	{
		while($result = mysql_fetch_assoc($sql))
		{
			$date = $result['year'].'-'.$result['month'].'-'.$result['day'];
				$from = str_split($result['time_from'], 2);

				$from_hr = $from[0].':';
				$from_min = $from[1];
				$from_time = $from_hr.$from_min;

				$to = str_split($result['time_until'], 2);
				$to_hr = $to[0].':';
				$to_min = $to[1];
				$to_time = $to_hr.$to_min;

				$event_title = $result['event'];
				$event_desc = $result['description'];
				$due_on_date = $result['month'].'/'.$result['day'].'/'.$result['year'];
		}
	}
?>