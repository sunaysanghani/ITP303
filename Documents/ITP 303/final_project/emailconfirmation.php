<?php


if(!isset($_POST['email']) || trim($_POST['email']) == ''){
	$error = "Please enter your email.";
} elseif(strpos("'" . $_POST['email'] . "'", '@') == false){
	$error = "Please enter a valid email.";
}
else{

	$destination = $_POST['email'];
	$subject = "My Favorite Playlist";
	$message = '<h1>Here are my favorite albums!<h1>' . "\n\n" . $_POST['message'];
	$header = ["content-type" => "text/html",
				"from" => "sunaysan@usc.edu",
				"reply-to" => "sunaysan@usc.edu"
	];

	if(mail($destination, $subject, $message, $header)){
		$result = 'Success! Your email was sent to ' . $destination;
	} else{
	$result = 'Error';
	}
}

?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Email Confirmation | Album Island</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<style>
		body{
		background-color:mintcream;
		}

		h1{
			text-align:center;
			line-height:40px;
			padding: 70px;
		}

		h2{
			margin-top:15px;
			font-size:25px;
			line-height:30px;
			background-color:tan;
			padding:12px;
		}

		img{
			width:60%;

		}

		#center{
			text-align:center;
		}

		#container {
			margin-left:auto;
			margin-right:auto;
		}

		#nav-wrapper {
			background-color:#D5E7D4;
			border: black solid;
		}

		
		#nav {
			width: 1000px;
			margin-left: auto;
			margin-right: auto;	
			font-size:0;
		}


		#nav a {
			background-color: #D5E7D4;
			width: 250px;
			height: 50px;
			line-height: 50px;
			display: inline-block;
			text-align: center;	
			color: #000;
			font-size:21px;
		}
		
		#nav a:hover {
			background-color: #CAEC95;
			color:black;
		}

		#nav ul {
		    list-style-type: none;
		    padding: 0px;
		    margin: 0px;
		}
		#nav li {
		    width: 250px;
		    display: inline-block;
		    text-align: center;
		    position: relative;
		    z-index: 2;
		}

		#nav a.active {
			color:black;
		}
		#footer{
			background-color:black;
			color:white;
		}
	</style>
</head>
<body>
	<h1> Album Island: Favorite Album Picker </h1>
	<div id="clearfloat"></div>
	<div id="nav-wrapper">
		<div id="nav">
			<ul>
				<li><a href="index.php" class="active">Home</a></li>
				<li><a href="search_music.php">Search for Albums</a></li>
				<li><a href="add_album.php">Add an Album</a></li>
				<li><a href="view_favorites.php">View Your Favorites</a></li>
			</ul>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<h1 class="col-12 mt-4">Email Confirmation</h1>
		</div> <!-- .row -->
	</div> <!-- .container -->
	<div class="container">
		<div class="row mt-4">
			<div class="col-12">

				<?php if(isset($error) && !empty($error)) : ?>
					<div class="text-danger">
						<?php echo $error; ?>
					</div>
				<?php else : ?>
					<div class="text-success">
						<span class="font-italic">Your email was sent to <?php echo $_POST['email']; ?></span>.
					</div>
				<?php endif; ?>

				
			</div> <!-- .col -->
		</div> <!-- .row -->
	<div id="footer" class="container-fluid text-center">
			Sunay Sanghani Final Project &copy; 2022
		</div>
	</div> <!-- .container -->
</body>
</html>