<?php include_once( 'header.php' );
	include_once( 'libs/delete.php' );
?>
<div id="calendar">
	<?php if(isset($error)){ echo '<div id="alertMessage" class="error">'.$error.'</div>'; } ?>
	<?php if(isset($success)){ echo '<div id="alertMessage" class="success">'.$success.'</div>'; } ?>
	<div id="calendar_wrap">
		<div class="title_bar">
			<div class="create_one">
				<a href="index.php" title="List All Events" class="uibutton icon add ">List All Events</a>
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
			<div id="alertMessage"> Are you sure you want to delete this event ?</div>
			<div style="text-align:center;">
				<a href="delete.php?id=<?php echo $_GET['id']; ?>&&action=true" title="Delete" class="uibutton special"> Yes Delete This </a>
				<a href="index.php" title="NO" class="uibutton"> Do Not Delete </a>
			</div>
		</div><!-- end list_wrapper -->
	</div><!-- end calendar_wrap -->
</div>
<?php include_once( 'footer.php' ); ?>
