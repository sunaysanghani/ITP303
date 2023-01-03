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

	$sql_genres = "SELECT * FROM genre;";
	$results_genres = $mysqli->query($sql_genres);
	if ( $results_genres == false ) {
		echo $mysqli->error;
		exit();
	}

	$sql_artists = "SELECT * FROM artist;";
	$results_artists = $mysqli->query($sql_artists);
	if ( $results_artists == false ) {
		echo $mysqli->error;
		exit();
	}

	
	$sql_release_year = "SELECT * FROM release_year;";
	$results_release_year = $mysqli->query($sql_release_year);
	if ( $results_release_year == false ) {
		echo $mysqli->error;
		exit();
	}

	

	$sql_count_by_artist = "SELECT artist.artist_name AS artist_name, COUNT(music_info.artist_id) AS count_id
							FROM music_info 
							LEFT JOIN artist
								ON music_info.artist_id = artist.id
							GROUP BY artist_name";

	$sql_count_by_artist = $sql_count_by_artist . ";";
	$results_by_artist = $mysqli ->query($sql_count_by_artist);
	if (!$results_by_artist) {
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

		h3{
			padding-top:20px;
		}
		img{
			width:60%;

		}

		table{
			margin-left:auto;
			margin-right:auto;
		}
		table, th, td{
			border: 1px solid;
			text-align:center;
		}

		th{
			background-color: green;
		}

		#table_artist{
			margin:5px;
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
				<li><a href="search_music.php" class="active">Search for Albums</a></li>
				<li><a href="add_album.php">Add an Album</a></li>
				<li><a href="view_favorites.php">View Your Favorites</a></li>
			</ul>
		</div>
	</div>

	<div class="container">
		<div class="row">
			<h1 class="col-12 mt-4 mb-4">Search for An Album</h1>
		</div> <!-- .row -->
	</div> <!-- .container -->

	<div class="container">

		<form action="search_results.php" method="GET">

			<div class="form-group row">
				<label for="album-id" class="col-sm-3 col-form-label text-sm-right">Album Title:</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" id="album-id" name="album_name">
				</div>
			</div> <!-- .form-group -->

			<div class="form-group row">
				<label for="artist-id" class="col-sm-3 col-form-label text-sm-right">Artist:</label>
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
				<label for="genre-id" class="col-sm-3 col-form-label text-sm-right">Genre:</label>
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
				<label for="genre-id" class="col-sm-3 col-form-label text-sm-right">Release Year:</label>
				<div class="col-sm-9">
					<select name="release_year_id" id="release-year-id" class="form-control">
						<option value="" selected disabled>-- Select One --</option>

						<?php while( $row = $results_release_year->fetch_assoc() ): ?>

							<option value="<?php echo $row['id']; ?>">
								<?php echo $row['release_year']; ?>
							</option>

						<?php endwhile; ?>

					</select>
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
		<h3> Count of Albums By Artist in this Database(For Reference)</h3>
		<div id="table_artist" class="col-12">
				<table>
					<thead>
						<tr>
							<th>Artist</th>
							<th>Number of Songs</th>
						</tr>
					</thead>
					<tbody>
						<?php while ($row_artist = $results_by_artist->fetch_assoc() ): ?>
							<tr>
								
								<td>
									<?php echo $row_artist['artist_name']; ?>
								</td>
								<td>
									<?php echo $row_artist['count_id']; ?>
								</td>
							</tr>
						<?php endwhile; ?>
					</tbody>
				</table>
			</div> <!-- .col -->
		</div> <!-- .row -->
		<div id="footer" class="container-fluid text-center">
			Sunay Sanghani Final Project &copy; 2022
		</div>
	</div> <!-- .container -->
</body>
</html>