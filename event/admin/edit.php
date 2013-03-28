<?php include_once( 'header.php' );
	include_once( 'libs/individual.php' );
	include_once( 'libs/edit_event.php' );
?>
<link rel="stylesheet" type="text/css" href="../editor/jquery.cleditor.css" />
<link rel="stylesheet" type="text/css" href="../ui/css/redmond/jquery-ui-1.8.21.custom.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script type="text/javascript" src="../editor/jquery.cleditor.js"></script>
<script type="text/javascript" src="../ui/js/jquery-ui-1.8.21.custom.min.js"></script>
<script type="text/javascript" src="../ui/js/timePicker.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$("#event_desc").cleditor({
		width: 590,
		controls:     // controls to add to the toolbar
				"bold italic underline strikethrough subscript superscript | font size " +
				"style | color highlight removeformat | bullets numbering | outdent " +
				"indent | alignleft center alignright justify"
		});
		$( "#due_on_date" ).datepicker();
		$( "#from_time").timepicker({});
		$( "#to_time").timepicker({});
	});
	</script>
<div id="calendar">
	<?php if(isset($error)){ echo '<div id="alertMessage" class="error">'.$error.'</div>'; } ?>
	<?php if(isset($info)){ echo '<div id="alertMessage" class="">'.$info.'</div>'; } ?>
	<?php if(isset($success)){ echo '<div id="alertMessage" class="success">'.$success.'</div>'; } ?>
	<div id="calendar_wrap">
		<div class="title_bar">
			<div class="create_one">
				<a href="index.php" title="List All Event" class="uibutton icon add">List All Events</a>
				<a href="../index.php" title="See Calendar" class="uibutton icon add">See Calendar</a>
				<a href="logout.php" class="logout" title="Logout">
					<img class="disconnect" alt="disconnect" name="connect" src="../images/connect.png" style="opacity: 1;">
				</a>
			</div><!-- end create_one -->
		</div><!-- end title_bar -->
		<div class="clear"></div>
		<div class="sub_head">
			<h2> Edit Event </h2>
		</div><!-- end sub_head -->
		
		<div class="list_wrapper">
			<form method="post" action="edit.php?id=<?php echo $_GET['id']; ?>">
				<div class="form">
					<div class="section">
						<label for="Event Title">Event Title</label>
						<div>
							<input type="text" name="event_title" id="event_title" class="full" value="<?php if(isset($event_title)) { echo $event_title; } ?>"/>
						</div>
					</div>
					<div class="section">
						<label for="Event Title">Event Description</label>
						<div>
							<textarea name="event_desc" id="event_desc" class="full"><?php if(isset($event_desc)) { echo $event_desc; } ?></textarea>
						</div>
					</div>
					<div class="section">
						<label for="Due On">On Date</label>
						<div>
							<input type="text" name="due_on_date" id="due_on_date" value="<?php if(isset($due_on_date)) { echo $due_on_date; } ?>"/>
						</div>
					</div>

					<div class="section">
						<label for="Due On">From Time</label>
						<div>
							<input type="text" name="from_time" id="from_time" value="<?php if(isset($_POST['from_time'])) { echo $_POST['from_time']; } elseif(isset($from_time)) { echo $from_time; } ?>"/>
						</div>
					</div>

					<div class="section">
						<label for="Due On">To Time</label>
						<div>
							<input type="text" name="to_time" id="to_time" value="<?php if(isset($_POST['to_time'])) { echo $_POST['to_time']; } elseif(isset($to_time)) { echo $to_time; } ?>"/>
						</div>
					</div>

					<div class="section last">
						<div><input type="submit" name="add_event" value="Edit Event" class="uibutton"/>
						</div>
					</div>

				</div><!-- end form -->
			</form>
		</div><!-- end list_wrapper -->
		
		
	</div><!-- end calendar_wrap -->
</div>
<?php include_once( 'footer.php' ); ?>
