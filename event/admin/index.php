<?php include_once( 'header.php' );
	include_once( 'libs/list_events.php' );
?>
<link rel="stylesheet" href="../datatable.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script type="text/javascript" src="../js/datatables.js"></script>
<script type="text/javascript">
	$(function(){
		$('table.display').dataTable({
			"sDom": '<"top"f>rt<"bottom"ip><"clear">'
		});
	});
</script>
<div id="calendar">
	<div id="calendar_wrap">
		<div class="title_bar">
			<div class="create_one">
				<a href="create.php" title="Create Event" class="uibutton icon add ">Create New Event</a>
				<a href="../index.php" title="See Calendar" class="uibutton icon add">See Calendar</a>
				<a href="logout.php" class="logout" title="Logout">
					<img class="disconnect" alt="disconnect" name="connect" src="../images/connect.png" style="opacity: 1;">
				</a>
			</div><!-- end create_one -->
		</div><!-- end title_bar -->
		<div class="clear"></div>
		<div class="sub_head">
			<h2> Events List </h2>
		</div><!-- end sub_head -->
		
		<div class="list_wrapper">
			<table class="display">
				<thead>
					<tr>
						<th> Title </th>
						<th> Description </th>
						<th> On Date </th>
						<th> Actions </th>
					</tr>
				</thead>
				<tbody>
					<?php if(isset($output)) { echo $output; } ?>
				</tbody>
			</table>
		</div><!-- end list_wrapper -->
		
		
	</div><!-- end calendar_wrap -->
</div>
<?php include_once( 'footer.php' ); ?>
