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


	$mysqli->set_charset('utf8');
	$sql_albums = "SELECT * FROM music_info;";
	$results_albums = $mysqli->query($sql_albums);
	if ( $results_albums == false ) {
		echo $mysqli->error;
		exit();
	}

	$mysqli->set_charset('utf8');
	$sql_genres = "SELECT * FROM genre;";
	$results_genres = $mysqli->query($sql_genres);
	if ( $results_genres == false ) {
		echo $mysqli->error;
		exit();
	}
	
	$mysqli->set_charset('utf8');
	$sql_artists = "SELECT * FROM artist;";
	$results_artists = $mysqli->query($sql_artists);
	if ( $results_artists == false ) {
		echo $mysqli->error;
		exit();
	}

	$mysqli->set_charset('utf8');
	$sql_release_years = "SELECT * FROM release_year;";
	$results_release_years = $mysqli->query($sql_release_years);
	if ( $results_release_years == false ) {
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
	<title>Add Form | Album Database</title>
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
				<li><a href="index.php">Home</a></li>
				<li><a href="search_music.php">Search for Albums</a></li>
				<li><a href="add_album.php" class="active">Add an Album</a></li>
				<li><a href="view_favorites.php">View Your Favorites</a></li>
			</ul>
		</div>
	</div>




	<div class="container">
		<div class="row">
			<h1 class="col-12 mt-4 mb-4">Add an Album</h1>
		</div> <!-- .row -->
	</div> <!-- .container -->

	<div class="container">

		<form action="add_confirmation.php" method="POST">

			<div class="form-group row">
				<label for="title-id" class="col-sm-3 col-form-label text-sm-right">Album Title: <span class="text-danger">*</span></label>
				<div class="col-sm-9">
					<input type="text" class="form-control" id="title-id" name="album_name">
				</div>
			</div> <!-- .form-group -->

			<div class="form-group row">
				<label for="genre-id" class="col-sm-3 col-form-label text-sm-right">Artist:<span class="text-danger">*</span></label>
				<div class="col-sm-9">
					<select name="artist_id" id="artist-id" class="form-control">
						<option value="" selected disabled>-- Select One --</option>

						<?php while( $row = $results_artists->fetch_assoc() ): ?>

							<option value="<?php echo $row['id']; ?>">
								<?php echo $row['artist_name']; ?>
							</option>

						<?php endwhile; ?>

					</select>
				</div>
			</div> <!-- .form-group -->

			<div class="form-group row">
				<label for="genre-id" class="col-sm-3 col-form-label text-sm-right">Genre:<span class="text-danger">*</span></label>
				<div class="col-sm-9">
					<select name="genre_id" id="genre-id" class="form-control">
						<option value="" selected disabled>-- Select One --</option>

						<?php while( $row = $results_genres->fetch_assoc() ): ?>

							<option value="<?php echo $row['id']; ?>">
								<?php echo $row['genre_name']; ?>
							</option>

						<?php endwhile; ?>

					</select>
				</div>
			</div> <!-- .form-group -->
			<div class="form-group row">
				<label for="release-year-id" class="col-sm-3 col-form-label text-sm-right">Release Year:<span class="text-danger">*</span></label>
				<div class="col-sm-9">
					<select name="release_year_id" id="release-year-id" class="form-control">
						<option value="" selected disabled>-- Select One --</option>

						<?php while( $row = $results_release_years->fetch_assoc() ): ?>

							<option value="<?php echo $row['id']; ?>">
								<?php echo $row['release_year']; ?>
							</option>

						<?php endwhile; ?>

					</select>
				</div>
			</div> <!-- .form-group -->



			

			<div class="form-group row">
				<div class="ml-auto col-sm-9">
					<span class="text-danger font-italic">* Required</span>
				</div>
			</div> <!-- .form-group -->

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