<?php if(isset($_GET['alldelete'])) { unlink("install.php"); unlink("install1.php"); unlink("install2.php"); unlink("home.css"); header("location: admin/index.php"); } ?>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
<script type="text/javascript">
			function fuck(){
			if(window.XMLHttpRequest)
				{
				xmlhttp = new window.XMLHttpRequest();
				}
				else
				{
					xmlhttp = new ActiveXObject('Microsoft.XMLHTTP');
				}

				xmlhttp.onreadystatechange = function() {
				if(xmlhttp.readyState == '4' && xmlhttp.status == '200')
					{
					
					if(xmlhttp.responseText == 'Deleted Successfully')
					{
					document.getElementById('msg').innerHTML = xmlhttp.responseText;
					$('#success').hide();
					setTimeout(window.location = 'install.php', 200000);
					}
					else
					{
					document.getElementById('msg').innerHTML = xmlhttp.responseText;	
					$('#success').hide();
					}
					}
				}
				finish1 = $('#finish').val();

				parameters = 'finish='+finish1;
				xmlhttp.open('POST', 'install2.php', true);
				xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
				xmlhttp.send(parameters);

			}
</script>
<?php
	if(isset($_POST['submitandcreateafileformepleaseiamreadytoinstallyouradmintheme']))
	{
		$host = $_POST['host'];
		$user = $_POST['user'];
		$pass = $_POST['pass'];
		$name = $_POST['name'];

		$myFile = "config.php";
		$fh = fopen($myFile, 'w') or die("can't open file");
		$stringData = 
		" <?php /*
		// Author:- ScriptsJungle
		// Version :- 1.0 
		// Project Name :- Php Events Calendar
		// You have the right to modify,use and re-distribute this script
		// without informing anyone.
		// As a curtusey you can keep my name there as it is.
		*/
		/* Name of the database */
		define('DB_NAME', '".$name."');
		/* Name of the database user */
		define('DB_USER', '".$user."');
		/* Password for the database */
		define('DB_PASSWORD', '".$pass."');
		/* Host name for the database */
		define('DB_HOST', '".$host."');
		/* Default Charset */
		define('DB_CHARSET', 'utf8');
		/* Default Collate */
		define('DB_COLLATE', ''); 
		?>";
		$write = fwrite($fh, $stringData);
		fclose($fh);
		
		if($write)
		{
		include_once 'config.php';
		$db_name = DB_NAME;
		$db_user = DB_USER;
		$db_pass = DB_PASSWORD;
		$db_host = DB_HOST;

		$success =  '<p>config.php ! Created successfully you can change this file manually whenever you want<br /><br />
		Unable to make database connection, delete config.php and try again with right credentials</p>';		


			$conn = mysql_connect($db_host,$db_user,$db_pass) or die();
			$db = mysql_select_db($db_name,$conn);
			
			if(isset($conn))
			{
				$sql = mysql_query("CREATE TABLE calendar_event(
				id INT NOT NULL AUTO_INCREMENT, 
				PRIMARY KEY(id),
				event VARCHAR(300),
				description TEXT NOT NULL,
				day INT(8),
				month INT(8),
				year INT(8),
  				time_from VARCHAR(10) NOT NULL,
				time_until VARCHAR(10))");
				
				$sql = mysql_query("CREATE TABLE calendar_users(
				id INT NOT NULL AUTO_INCREMENT, 
				PRIMARY KEY(id),
				username VARCHAR(100),
				password VARCHAR(200))");

		if($sql)
		{
			$success =  '<h2>You got it !! </h2>Neccessary tables created <a href="#" id="create">Next</a>';		
		}
		else
		{
		$error1 = '<b>Unable to create tables Make sure database name you entered does exists <br /> Delete the config.php file and follow the process again <input type="hidden" name="finish" value="finish" id="finish"/><input type="submit" name="click" value="Delete Now" id="click" onclick="fuck();" /></b>';
		}
		
		}
		else
		{
		$error = "Unable to create file please do it manually by copying the entire code or <b>contact us</b> ";
		}
		}
			else
			{
				$error = 'Unable to make database connection, delete config.php and try again with right credentials';
			}	

	}
?>

<!DOCTYPE html>
<html lang="name">
<head>
<title>Installing tutlageadmin</title>

	<meta http-equiv="Content-type" content="text/html; charset=UTF-8" />	
	<meta name="author" content="installing tutlageadmin" />
	<meta name="robots" content="installing tutlageadmin">
	<meta name="description" content="installation page for tutlageadmin"/>
	<meta name="keywords" content="installation" />

	<link rel="stylesheet" href="home.css" />
<link href='http://fonts.googleapis.com/css?family=Shadows+Into+Light' rel='stylesheet' type='text/css'>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
	<script type="text/javascript" src="js/custom.js"></script>	
	<script type="text/javascript">
	$(function(){
	
	$('#create').click(function(){
		window.location = 'install.php';
		$('#success').hide();
		return false;
	});
	
	var dash_email = $('#dash_email');
	var dash_pass1 = $('#dash_pass1');
	var dash_pass2 = $('#dash_pass2');
	var dash_username = $('#dash_username');


	var pass1Details = $('#pass1Details');
	var pass2Details = $('#pass2Details');
	var emailDetails = $('#emailDetails');
	var usernameDetails = $('#usernameDetails');

		dash_email.blur(validateEmail);
		dash_pass1.blur(validatePass1);
		dash_pass2.blur(validatePass2);
		dash_username.blur(validateUsername);

		dash_email.keyup(validateEmail);
		dash_pass1.keyup(validatePass1);
		dash_pass2.keyup(validatePass2);
		dash_username.keyup(validateUsername);

		$('#finalsubmit').click(function(){
			if(validateEmail() && validatePass1() && validatePass2() && validateUsername())
			{

				$('#user-form').fadeOut('fast');
				if(window.XMLHttpRequest)
				{
				xmlhttp = new window.XMLHttpRequest();
				}
				else
				{
					xmlhttp = new ActiveXObject('Microsoft.XMLHTTP');
				}

				xmlhttp.onreadystatechange = function() {
				if(xmlhttp.readyState == '4' && xmlhttp.status == '200')
					{
					
						document.getElementById('final-msg-ajax').innerHTML = xmlhttp.responseText;	
						$('#rest').hide();
					}
			}
				hidden1 = $('#hidden').val();
				email1 = dash_email.val();
				pass1a = dash_pass1.val();
				username = dash_username.val();
			
				parameters = 'email='+email1+'&pass1='+pass1a+'&username='+username;
				xmlhttp.open('POST', 'install1.php?get='+hidden1, true);
				xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
				xmlhttp.send(parameters);

			return true;
			}
			else
			{
				return false;
			}

		});

		function validateEmail(){
			var x = dash_email.val();
			var regex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/

			if(regex.test(x))
			{
			emailDetails.html('');
			return true;
			}
			else
			{
			emailDetails.text('Please enter a valid email address');
			return false;
			}
		}


		function validatePass1(){

			if(dash_pass1.val().length < 8)
			{
			pass1Details.text('Should be more than 8 digits');
			return false;
			}
			else
			{
			pass1Details.html('');
			return true;	
			}

		}

		function validatePass2(){

			if(dash_pass2.val().length > 0)
			{
			if(dash_pass2.val() != dash_pass1.val())
			{
			pass2Details.text('Password does not match');
			return false;
			}
			else
			{
			pass2Details.html('');
			return true;
			}
			return true;
			}
		}

		function validateUsername(){
			if(dash_username.val().length < 4)
			{
			usernameDetails.text('Username should be more than 4 digits');
			return false;
			}
			else
			{
			usernameDetails.html('');
			return true;
			}

		}
	});
	</script>
	
</head>
<body>
<div id="wrapper">
<?php if(file_exists("config.php")) { ?>

<div id="headerwrap">
	<div id="header">
		<h1><a href="../index.php">Tutlage Admin</a></h1>
	</div>

	<div id="install-main-content">
		<div class="coll-full">
		
		<div id="msg"></div>
		<div id="final-msg-ajax"></div>
			<div id="success">
			<?php if(isset($success)){ echo $success;} elseif(isset($error1)){ echo $error1;} else {  ?>
			</div>
			
			<div id="rest">
				<h1>Config<span class="red">ration</span></h1>
				<br />
				<p>This information will be used as your login credentials, after this you would be able 
				to create awesome quiz by using tutlage quiz engine.</p>
					<table id="final-steps">
					<tbody>
					<tr>
						<td><label for="Database Password">Username</label></td>
						<td><input type="text" name="dash_username" id="dash_username" />
						<small id="usernameDetails">Required for login</small></td>
					</tr>

					<tr>
						<td><label for="Database Name">Email</label></td>
						<td><input type="text" name="dash_email" id="dash_email" />
						<small id="emailDetails"></small></td>

					</tr>
					
					<tr>
						<td><label for="Database Name">Password</label></td>
						<td><input type="password" name="dash_pass1" id="dash_pass1" />
						<small id="pass1Details"></small></td>
					</tr>

					<tr>
						<td><label for="Database Name">Confirm-Password</label></td>
						<td><input type="password" name="dash_pass2" id="dash_pass2" />
						<small id="pass2Details"></small></td>
					</tr>
					<tr>
						<input type="hidden" name="hidden" value="hidden" id="hidden"/>
					</tr>
				</tbody>
			</table>
					<input type="submit" name="finalsubmit" id="finalsubmit" value="Submit" />
	
			</div>
		</div>
	</div>
</div>
<?php } ?>

	
<?php } else { error_reporting(0); if(!isset($_GET['act']) && ($_GET['act'] != '34d1f91fb2e514b8576fab1a75a89a6b')) { ?>

<div id="headerwrap">
	<div id="header">
		<h1><a href="../index.php">Tutlage Admin</a></h1>
	</div>

	<div id="install-main-content">
		<div class="coll-full">
		<?php if(isset($error)){ echo '<h1>'.$error.'</h1>'; }?>
		<h1>Installation <span class="red">Process</span></h1>
		
		
	
		<h3>Don't Worry just follow normal steps ! you will be up and running soon</h3>	
			<p>File config.php doesnot exists you can hit go to create a config.php file dynamically
			<br /> <br /><b>Note:- </b> This function might not support a ftp client in that case create a file config.php under admin folder 
			you can copy<br />
			the following code and paste it inside the config.php and change connection settings accordingly</p>
		
				<div id="code">
				<table>
				<tr>
				<td>
				/* You need to create one first */
				<br />
				define('DB_NAME', 'database_name');
				<br />
				/* the user to access the database */
				<br />
				define('DB_USER', 'root');
				<br />
				/* Password for that user */
				<br />
				define('DB_PASSWORD', '');
				<br />
				/* Database hostname */
				<br />
				define('DB_HOST', 'localhost');
				<br />
				/* Leave this to default */
				<br />
				define('DB_CHARSET', 'utf8');
				<br />
				/* Leave this to default */
				<br />
				</td></tr>
				</table>
				<br /><hr />
				<h1 id="hit">OR HIT</h1>
				<?php $url = 'go';
				$url = md5($url);
				?>
				<a href="install.php?act=<?php echo $url;?>" id="go">GO</a>
			</div>
		</div>
	</div>
</div>

<?php } else { ?>
	
<div id="headerwrap">
	<div id="header">
		<h1><a href="../index.php">Tutlage Admin</a></h1>
	</div>

	<div id="install-main-content">
		<div class="coll-full">
			<h1>Installation <span class="red">Process</span></h1>
			<table id="installation-table">
				<form method="post" action="install.php">
					<tbody>
					<tr>
						<td><label for="Db">Database Host</label></td>
						<td><input type="text" name="host" />
						<small id="hostDetails"></small></td>
					</tr>
					
					<tr>
						<td><label for="Database User">Database User</label></td>
						<td><input type="text" name="user" />
						<small id="userDetails"></small></td>

					</tr>
					
					<tr>
						<td><label for="Database Password">Database Password</label></td>
						<td><input type="password" name="pass" />
						<small id="passDetails"></small></td>
					</tr>
					
					<tr>
						<td><label for="Database Name">Database Name</label></td>
						<td><input type="text" name="name" />
						<br /><small>Make sure you create this database first</small></td>
						
					</tr>
					</tbody>
			</table>
				<input type="submit" id="a" name="submitandcreateafileformepleaseiamreadytoinstallyouradmintheme" value="Submit" />
			</form>
		</div>
	</div>
</div>
<?php } } ?>
</div>
</body>
