<?php if(!file_exists('config.php')) { header("location: install.php");} ?>
<?php
	error_reporting(0);
	include('connection.php');
	include('functions/functions.php');
	include('header.php');

	$first_day_of_week = 'Monday';
	$type = CAL_GREGORIAN;
	$month = trim(stripslashes(strip_tags($_GET['month'])));
	$year = trim(stripslashes(strip_tags($_GET['year'])));
	if(!$_GET['month'] || !is_numeric($_GET['month'])) $month = date('n');
	if(!$_GET['year'] || !is_numeric($_GET['year'])) $year = date('Y');
	$today = date('Y/n/d');
	$day_count = cal_days_in_month($type, $month, $year);

	echo "<div id='calendar'>";
	echo "<div id='calendar_wrap'>";

	$last_month = $month - 1;
	$next_month = $month + 1;
	
	$last_year = $year - 1;
	$next_year = $year + 1;

	if($month == 12): 
		$change_year = $year; 
		$change_month  = $last_month;
	elseif($month == 1): 
		$change_year = $last_year;
		$change_month  = '12'; 
	else:
		$change_year = $year; 
		$change_month  = $last_month;
	endif;
		
	if($month == 1): 
		$change_year_next = $year; 
		$change_month_next  = $next_month;
	elseif($month == 12): 
		$change_year_next = $next_year;
		$change_month_next  = '1'; 
	else: 
		$change_year_next = $year; 
		$change_month_next  = $next_month;
	endif;

	echo "<div class='title_bar'>";
	echo "<a href='index.php?month=". $change_month ."&year=". $change_year ."'><div class='previous'> Prev </div></a>";
	echo "<a href='index.php?month=". $change_month_next ."&year=". $change_year_next ."'><div class='next'> Next </div></a>";
	echo "</div><div class='clear'></div>";
	echo "<div class='sub_head'><h2 class='month'>" . date('F',  mktime(0,0,0,$month,1)) . "&nbsp;" . $year . "</h2></div><div id='calendar_event'>";
/* Previous Month */

	$first_day = date('N', mktime(0,0,0,$month,1,$year));

	if ( ($first_day_of_week=='Monday' && $first_day != 1) || ($first_day_of_week=='Sunday' && $first_day != 7) ) :

	$last_month_day_count = cal_days_in_month($type, $change_month, $change_year);
	
	if ($first_day_of_week=='Monday') :
		if ( 'Monday' == date('l', mktime(0,0,0,$change_month,$last_month_day_count,$change_year)) ) :
			$final_day = date('j', mktime(0,0,0,$change_month,$last_month_day_count,$change_year));
		else :
			$final_day = date('j', strtotime('last Monday', mktime(0,0,0,$change_month,$last_month_day_count,$change_year) ) );
		endif;
	else :
		if ( 'Sunday' == date('l', mktime(0,0,0,$change_month,$last_month_day_count,$change_year)) ) :
			$final_day = date('j', mktime(0,0,0,$change_month,$last_month_day_count,$change_year));
		else :
			$final_day = date('j', strtotime('last Sunday', mktime(0,0,0,$change_month,$last_month_day_count,$change_year) ) );
		endif;
	endif;
	
	for($i=$final_day; $i<=$last_month_day_count; $i++):
		
		$date = $change_year.'/'.$change_month.'/'.$i;
		
		$get_name = date('l', strtotime($date));
		$month_name = date('F', strtotime($date));
		$day_name = substr($get_name, 0, 3);
		
		$count = count_events($i,$change_month,$change_year);
			
		echo "<a href='day_view.php?day=$i&month=$change_month&year=$change_year' title='$i $month_name' rel='day_view'>";
		echo "<div class='event_day last_month'>";
			
			echo "<div class='event_heading'>" . $day_name . "</div>";
			
			if($count >= 1) echo "<div class='event_count'><span class='event'>" . $count . "</span></div>";
			
			if($today == $date): 
				echo "<div class='event_number today'>" . $i . "</div>";
			else: 
				echo "<div class='event_number'>" . $i . "</div>";
			endif;	
			
		echo "</div>";
		echo "</a>";
		
	endfor;

endif;

for($i=1; $i<= $day_count; $i++):

	$date = $year.'/'.$month.'/'.$i;
	
	$get_name = date('l', strtotime($date));
	$month_name = date('F', strtotime($date));
	$day_name = substr($get_name, 0, 3);
	
	$count = count_events($i,$month,$year);
		
	echo "<a href='day_view.php?day=$i&month=$month&year=$year' title='$i $month_name' rel='day_view'>";
	echo "<div class='event_day'>";
		
		echo "<div class='event_heading'>" . $day_name . "</div>";
		
		if($count >= 1) echo "<div class='event_count'><span class='event'>" . $count . "</span></div>";
		
		if($today == $date):
			echo "<div class='event_number today'>" . $i . "</div>";
		else: 
			echo "<div class='event_number'>" . $i . "</div>";
		endif;	
		
	echo "</div>";
	echo "</a>";
	
endfor;
$last_day = date('N', mktime(0,0,0,$month,$day_count,$year));

if ( ($first_day_of_week=='Monday' && $last_day != 7) || ($first_day_of_week=='Sunday' && $last_day != 1) ) :
	
	if ($first_day_of_week=='Monday') :
		if ( 'Sunday' == date('l', mktime(0,0,0,$change_month_next,1,$change_year_next)) ) :
			$first_day = date('j', mktime(0,0,0,$change_month_next,1,$change_year_next));
		else :
			$first_day = date('j', strtotime('first Sunday', mktime(0,0,0,$change_month_next,1,$change_year_next) ) );
		endif;
	else :
		if ( 'Saturday' == date('l', mktime(0,0,0,$change_month_next,1,$change_year_next)) ) :
			$first_day = date('j', mktime(0,0,0,$change_month_next,1,$change_year_next));
		else :
			$first_day = date('j', strtotime('first Saturday', mktime(0,0,0,$change_month_next,1,$change_year_next) ) );
		endif;	
	endif;
	
	
	for($i=1; $i<=$first_day; $i++): 
		
		$date = $change_year_next.'/'.$change_month_next.'/'.$i;
		
		$get_name = date('l', strtotime($date));
		$month_name = date('F', strtotime($date));
		$day_name = substr($get_name, 0, 3);
		
		$count = count_events($i,$change_month_next,$change_year_next);
			
		echo "<a href='day_view.php?day=$i&month=$change_month_next&year=$change_year_next' title='$i $month_name' rel='day_view'>";
		echo "<div class='event_day next_month'>";
			
			echo "<div class='event_heading'>" . $day_name . "</div>";
			
			if($count >= 1) echo "<div class='event_count'><span class='event'>" . $count . "</span></div>";
			
			if($today == $date): 
				echo "<div class='event_number today'>" . $i . "</div>";
			else:
				echo "<div class='event_number'>" . $i . "</div>";
			endif;
			
		echo "</a></div>";
		
	endfor;

endif;

	echo "</div>";
	echo "</div>
	</div>";
?>
<script type="text/javascript">
jQuery(document).ready(function(){ $("a[rel='day_view']").colorbox({width:"480px", height:"450px", iframe:true}); });
</script>
<?php include_once( 'footer.php' ); ?>