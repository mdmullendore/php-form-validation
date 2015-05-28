<?php
	// database creds
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "forms";

	// Create connection
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	if (!$conn)
	{
		die('Could not connect: ' . mysql_error());
	}

	$first_nameErr = "";
	$last_nameErr = "";

	//onsubmit
	if(isset($_POST['submit']))
	{
		//declare variables
		$first_name = $_POST['first_name'];
		$last_name = $_POST['last_name'];
		$first_nameErr = "";
		$last_nameErr = "";

		if (empty($first_name)) {
			$first_nameErr = "* First name is required.";
		}else{
			$first_name = addslashes ($_POST['first_name']);
			$first_nameErr = false;
		}

		if (empty($last_name)) {
			$last_nameErr = "* Last Name is required.";
		}else{
			$last_name = addslashes ($_POST['last_name']);
			$last_nameErr = false;
		}

		// submit to db if errors are false
		if(!$first_nameErr && !$last_nameErr){
			// prepare query
			$SQL = "INSERT INTO contact_table (first_name, last_name) VALUES ('$first_name', '$last_name')";
			$result = mysqli_query($conn, $SQL);
		}
	}
	// close connection
	mysqli_close($conn);

?>
<!DOCTYPE html>
<html>
	<head>
		<title>PHP Forms</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">

		<!-- Mobile Specific Metas
		–––––––––––––––––––––––––––––––––––––––––––––––––– -->
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<!-- FONT
		–––––––––––––––––––––––––––––––––––––––––––––––––– -->
		<link href='//fonts.googleapis.com/css?family=Raleway:400,300,600' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="css/normalize.css">
		<link rel="stylesheet" href="css/skeleton.css">
		<style>
		.container{
			padding-top:80px;
		}
		input,label{
			display: block;
			margin:10px 0px;
		}
		.error{
			color: red;
			float: right;
			margin-top: -27px;
			font-size: 13px;
		}
		</style>
	</head>
	<body>
		<section class="container">
			<div class="row">
				<article class="six columns">
					<h5>Input Data</h5>
					<form method="post">
						<label>First Name</label>
						<span class="error"><?php echo $first_nameErr;?></span>
						<input type="text" class="u-full-width" name="first_name" />
						<label>Last Name</label>
						<span class="error"><?php echo $last_nameErr;?></span>
						<input type="text" class="u-full-width" name="last_name" />
						<input class="button-primary" type="submit" name="submit" value="Add Data">
					</form>
				</article>
			</div>
		</section>
	</body>
</html>