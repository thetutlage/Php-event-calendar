<?php
function count_events($day,$month,$year) {
	$sql = 'SELECT * FROM calendar_event WHERE day = "'.$day.'" AND month = "'.$month.'" AND year = "'.$year.'"';
	$query = mysql_query($sql);
	if ($query) {
		$num_rows = mysql_num_rows($query);
		if($num_rows > 0) { 
		
		if($num_rows > 1) { $event = "Events"; } else { $event = "Event"; }
		$counted = $num_rows . " " . $event;
		}
		return $counted;
	}
}
function list_events($day,$month,$year) {
	$sql = 'SELECT * FROM calendar_event WHERE day = "'.$day.'" AND month = "'.$month.'" AND year = "'.$year.'" ORDER BY time_from';
	$query = mysql_query($sql);
	
	if ($query) {
		$num_rows = mysql_num_rows($query);
		echo "<div class='list'>";
		if($num_rows == 0) {
			echo "<div id='blank'>No events</div>";
			} else {
			
			echo "<div id='event_row_last'><b>";
			if($num_rows > 1) { echo " $num_rows Events Found"; } else { echo "$num_rows Event Found"; }
			echo "</b></div>";
			$x = 0;
			while($row = mysql_fetch_array($query)) {
				$x++;
				$from = str_split($row['time_from'], 2);
				$from_hr = $from[0].' :';
				if($from_hr >= 12) { $dial_from = 'PM'; } else { $dial_from = 'AM'; }
				$from_min = $from[1]." ".$dial_from;
				
				$to = str_split($row['time_until'], 2);
				$to_hr = $to[0].' :';
				if($to_hr >= 12) { $dial_to = 'PM'; } else { $dial_to = 'AM'; }
				$to_min = $to[1]." ".$dial_to;
				
			echo "<div id='event_row'><h4> Event ".$x." </h2>";
				echo "<h2><small> TITLE : </small>" . stripslashes($row['event']) . "</h2>";
				echo "<h2><small> From : </small>".$from_hr." ".$from_min."</h2>";
				echo "<h2><small> To : </small>".$to_hr." ".$to_min."</h2>";
				echo "<div class='content'><small> Description : </small>".stripslashes($row['description'])."</div>";
			echo "</div>";
			}
		}
		echo "</div>";
	}
}

?>