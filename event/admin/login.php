<?php include_once( 'login_header.php' ); 
	include_once( 'libs/login.php' );
?>
		<div id="form_wrapper">
			<?php if(isset($error)){ echo '<div id="alertMessage" class="error">'.$error.'</div>'; } ?>
			<div id="login_box">
				<div id="login_box_inner">
					<div class="logo">
						<img src="../images/logo.png" />
					</div><!-- end logo -->
					<div class="form">
						<form method="post" action="login.php">
							<div class="elements">
								<input type="text" name="username_id" id="username_id" placeholder="Enter your username"/>
							</div>
							<div class="elements">
								<input type="password" name="password" id="password" placeholder="Enter Password"/>
							</div>
							<div class="elements" style="padding-top: 30px;">
								<input type="submit" name="login" value="Login" class="uibutton normal" />
							</div>
						</form>
					</div><!-- end form -->
				</div><!-- end inner -->
			</div><!-- end login_box -->
		</div><!-- end form_wrapper -->

	</div><!-- end mainWrapper -->
<?php include_once( 'footer.php' ); ?>
