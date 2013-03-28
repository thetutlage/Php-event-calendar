<?php include('connection.php'); include('functions/functions.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<link rel="stylesheet" href="custom.css" />
</head>
<body style="background: #fff;">
<div class="event_wrapper">
	<?php $day = $_GET['day']; $month = $_GET['month']; $year = $_GET['year']; list_events($day,$month,$year);?>
</div>
</body> 
</html>