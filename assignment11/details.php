<?php
	if ( !isset($_GET['album_id']) || empty($_GET['album_id']) ) {
		$error = "Invalid Album ID(Album Not Found).";
	}
	else{
		$host = "303.itpwebdev.com";
		$user = "sunaysan_db_user";
		$pass = "uscitp2022";
		$db = "sunaysan_music_db";

		$mysqli = new mysqli($host, $user, $pass, $db);
		if ($mysqli->connect_errno) {
			echo $mysqli->connect_error;
			exit();
		}

		$sql = "SELECT music_info.album_id, music_info.album_name AS album_name, artist.artist_name AS artist_name, genre.genre_name AS genre_name, release_year.release_year AS release_year
			FROM music_info 
			LEFT JOIN genre
				ON music_info.genre_id = genre.id
			LEFT JOIN artist
				ON music_info.artist_id = artist.id
			LEFT JOIN release_year
				ON music_info.release_year_id = release_year.id
			WHERE music_info.album_id =" . $_GET["album_id"] . ";";


	


		$results = $mysqli->query($sql);

		if(!$results) {
			echo $mysqli->error;
			$mysqli->close();
			exit();
		}

		$row = $results ->fetch_assoc();

		$mysqli->close();
	}
	

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Details | Album Database</title>
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
			<h1 class="col-12 mt-4">Album Details</h1>
		</div> <!-- .row -->
	</div> <!-- .container -->

	<div class="container">

		<div id="center"><img src="img/island.jpg" alt="Island"> </div>

		<div class="row mt-4">
			<div class="col-12">
				<?php if(isset($error) && !empty($error)) : ?>

				<div class="text-danger font-italic"><?php echo $error; ?>
					
				</div>
				<?php endif; ?>
				<table class="table table-responsive">

					<tr>
						<th class="text-right">Album Name:</th>
						<td><?php echo $row['album_name']; ?></td>

					</tr>

					<tr>
						<th class="text-right">Artist:</th>
						<td><?php echo $row['artist_name']; ?></td>
					</tr>

					<tr>
						<th class="text-right">Genre:</th>
						<td><?php echo $row['genre_name']; ?></td>
					</tr>

					<tr>
						<th class="text-right">Release Year:</th>
						<td><?php echo $row['release_year']; ?></td>
					</tr>

				</table>


			</div> <!-- .col -->
		</div> <!-- .row -->
		<div class="row mt-4 mb-4">
			<div class="col-12">
				<a href="search_music.php" role="button" class="btn btn-primary">Back to Search Form</a>
				<a href="edit_album.php?album_id=<?php echo $row['album_id']; ?>" class="btn btn-outline-warning">Edit This Album</a>
			</div> <!-- .col -->
		</div> <!-- .row -->
		<div id="footer" class="container-fluid text-center">
			Sunay Sanghani Final Project &copy; 2022
		</div>
	</div> <!-- .container -->
</body>
</html>