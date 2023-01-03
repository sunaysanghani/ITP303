<?php
	$host = "303.itpwebdev.com";
	$user = "sunaysan_db_user";
	$pass = "uscitp2022";
	$db = "sunaysan_music_db";

	$mysqli = new mysqli($host, $user, $pass, $db);
	if ($mysqli->connect_errno) {
		echo $mysqli->connect_error;
		exit();
	}


	$sql_albums = "SELECT * FROM music_info;";
	$results_albums = $mysqli->query($sql_albums);
	if ( $results_albums == false ) {
		echo $mysqli->error;
		exit();
	}

	$mysqli->close();

	
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Music Results</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<style>
		.form-check-label {
			padding-top: calc(.5rem - 1px * 2);
			padding-bottom: calc(.5rem - 1px * 2);
			margin-bottom: 0;
		}

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
			padding:10px;
		}






		#emailconf{
			margin-left:auto;
			margin-right:auto;
			text-align:center;
		}

		#center{
			text-align:center;
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
				<li><a href="index.php">Home</a></li>
				<li><a href="search_music.php">Search for Albums</a></li>
				<li><a href="add_album.php">Add an Album</a></li>
				<li><a href="view_favorites.php" class="active">View Your Favorites</a></li>
			</ul>
		</div>
	</div>


	<div class="container">
		<div class="row">
			<h1 class="col-12 mt-4 mb-4">Pick Your Favorites</h1>
		</div> <!-- .row -->
	</div> <!-- .container -->

	<div class="container">

			<div id="center"><img src="img/strandedalbum.jpeg" alt="Island"> </div>
			<div class="form-group row">
				<label for="album-id" class="col-sm-3 col-form-label text-sm-right">List of Favorite Album(s):</label>
				<div class="col-sm-9">
					<select name="album_id" id="album-id" class="form-control">
						<option value="" selected disabled>-- Select One --</option>

						<?php while( $row = $results_albums->fetch_assoc() ): ?>

							<option value="<?php echo $row['id']; ?>">
								<?php echo $row['album_name']; ?> 
							</option>

						<?php endwhile; ?>

					</select>
				</div>
			</div>

		<form id="emailconf" action="emailconfirmation.php" method="POST">

			My Favorite Playlists:<br><textarea rows="5" name="message" cols="30"></textarea><br>

			<div>
				<label for="email-id" class="text-paragraph">Enter Your Email Here:</label>
				<div>
					<input type="email" id="email-id" name="email" placeholder="Email">
				</div>
			</div>
		

		

			<div class="form-group row">
				<div class="col-sm-3"></div>
				<div class="col-sm-9 mt-2">
					<button type="submit" class="btn btn-primary">Submit</button>
					<button type="reset" class="btn btn-light">Reset</button>
				</div>
			</div> <!-- .form-group -->

		</form>
		<div id="footer" class="container-fluid text-center">
			Sunay Sanghani Final Project &copy; 2022
		</div>
	</div> <!-- .container -->
</body>
</html>