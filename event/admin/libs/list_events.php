<?php

	include_once( 'connection.php' );
	
	$sql = mysql_query("SELECT * FROM calendar_event ORDER BY id DESC");
	$row = mysql_num_rows($sql);
	$output = '';
	if($row >= 1)
	{
		while($result = mysql_fetch_assoc($sql))
		{
			$date = $result['month'].'/'.$result['day'].'/'.$result['year'];
				$from = str_split($result['time_from'], 2);
				$from_hr = $from[0].' :';
				if($from_hr >= 12) { $dial_from = 'PM'; } else { $dial_from = 'AM'; }
				$from_min = $from[1]." ".$dial_from;

				$to = str_split($result['time_until'], 2);
				$to_hr = $to[0].' :';
				if($to_hr >= 12) { $dial_to = 'PM'; } else { $dial_to = 'AM'; }
				$to_min = $to[1]." ".$dial_to;
		
			$output .= '<tr>
				<td>'.$result['event'].'</td>
				<td>'.$result['description'].'</td>
				<td>'.$date.'</td>
				<td><span class="tip">
				<a href="edit.php?id='.$result['id'].'">
				<img src="../images/icon_edit.png">
				</a>
				</span>
				<span class="tip">
				<a href="delete.php?id='.$result['id'].'">
				<img src="../images/icon_delete.png">
				</a>
				</span>
				</td>
			</tr>';
		}
	}
?>