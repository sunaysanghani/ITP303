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
	$sql =  "SELECT music_info.album_id, music_info.album_name, artist.artist_name, genre.genre_name, release_year.release_year
			FROM music_info
			LEFT JOIN artist
				ON music_info.artist_id = artist.id
			LEFT JOIN release_year
				ON music_info.release_year_id = release_year.id
			LEFT JOIN genre
				ON music_info.genre_id = genre.id
				WHERE 1 = 1";
		

		if (isset($_GET["album_name"]) && !empty($_GET["album_name"]) ) {
			$album_name = $_GET['album_name'];
			$sql = $sql . " AND music_info.album_name LIKE '%$album_name%'";
		}

		if (isset($_GET["artist_id"]) && !empty($_GET["artist_id"]) ) {
			$artist = $_GET['artist_id'];
			$sql = $sql . " AND music_info.artist_id = $artist";
		}

		if (isset($_GET["genre_id"]) && !empty($_GET["genre_id"])) {
			$genre_id = $_GET['genre_id'];
			$sql = $sql . " AND music_info.genre_id = $genre_id";
		}

		if (isset($_GET["release_year_id"]) && !empty($_GET["release_year_id"])) {
			$release_year_id = $_GET['release_year_id'];
			$sql = $sql . " AND music_info.release_year_id = $release_year_id";
		}

		
		$sql = $sql . ";";
		$results = $mysqli ->query($sql);
		if (!$results) {
			echo $mysqli->error;
			exit();
		}


		$total_results = $results->num_rows;
		$results_per_page = 5;
		$last_page = ceil($total_results / $results_per_page);

		if ( isset($_GET['page']) && trim($_GET['page']) != '') {
			$current_page = $_GET['page'];
		} else {
			$current_page = 1;
		}

		if ( $current_page < 1 || $current_page > $last_page) {
			$current_page = 1;
		}
		

		$start_index = ($current_page - 1) * $results_per_page;

		

		$sql = rtrim($sql, ';');


		$sql = $sql . " LIMIT $start_index, $results_per_page;";


		$results = $mysqli ->query($sql);
		if (!$results) {
			echo $mysqli->error;
			exit();
		}
		
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Album Search Results</title>
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
			<h1 class="col-12 mt-4">Album Search Results</h1>
		</div> <!-- .row -->
	</div> <!-- .container -->
	<div class="container">
		<div class="row mb-4">
			<div class="col-12 mt-4">
				<a href="search_music.php" role="button" class="btn btn-primary">Back to Form</a>
			</div> <!-- .col -->
		</div> <!-- .row -->
		<div class="row">
			
			<div class="col-12">

				Showing <?php echo $results->num_rows; ?> result(s).

			</div> <!-- .col -->
			<div class="col-12">
				<table>
					<thead>
						<tr>
							<th></th>
							<th>Album Title</th>
							<th>Genre</th>
							<th>Artist</th>
							<th>Release Year</th>
						</tr>
					</thead>
					<tbody>
						<?php while ($row =$results->fetch_assoc() ): ?>
							<tr>
								<td>
									<a href="delete.php?album_id=<?php echo $row['album_id']; ?>&album_name=<?php echo $row['album_name'];?>" class="btn btn-outline-danger" onclick="return confirm( 'Are you sure you want to delete this album?')">
										Delete
									</a>
								</td>
								
								<td>
									<a href="details.php?album_id=<?php echo $row['album_id']; ?>">
										<?php echo $row['album_name']; ?>
									</a>
								</td>
								<td>
									<?php echo $row['genre_name']; ?>
								</td>
								<td>
									<?php echo $row['artist_name']; ?>
								</td>
								<td>
									<?php echo $row['release_year']; ?>
								</td>
							</tr>
						<?php endwhile; ?>
					</tbody>
				</table>
			</div> <!-- .col -->
		</div> <!-- .row -->


			<div class="col-12">

				<nav aria-label="Page navigation example">
					<ul class="pagination justify-content-center">
						<li class="page-item <?php if ( $current_page <= 1 ) { echo 'disabled';} ?>">
							<a class="page-link" href="<?php $_GET['page'] = 1; echo $_SERVER['PHP_SELF'] . "?" . http_build_query($_GET);?>">First</a>
						</li>
						<li class="page-item <?php if ( $current_page <= 1 ) { echo 'disabled';} ?>">
							<a class="page-link" href="<?php $_GET['page'] = $current_page - 1; echo $_SERVER['PHP_SELF'] . "?" . http_build_query($_GET);?>">Previous</a>
						</li>
						<li class="page-item active">
							<a class="page-link" href="">
								<?php echo $current_page; ?>
							</a>
						</li>
						<li class="page-item <?php if ( $current_page >= $last_page ) { echo 'disabled';} ?>">
							<a class="page-link" href="<?php $_GET['page'] = $current_page + 1; echo $_SERVER['PHP_SELF'] . "?" . http_build_query($_GET);?>">Next</a>
						</li>
						<li class="page-item <?php if ( $current_page >= $last_page ) { echo 'disabled';} ?>">
							<a class="page-link" href="<?php 
								$_GET['page'] = $last_page;
								echo $_SERVER['PHP_SELF'] . "?" . http_build_query($_GET);
							?>">Last</a>
						</li>
					</ul>
				</nav>
			</div> <!-- .col -->
		<div class="row mt-4 mb-4">
			<div class="col-12">
				<a href="search_music.php" role="button" class="btn btn-primary">Back to Form</a>
			</div> <!-- .col -->
		</div> <!-- .row -->
		<div id="footer" class="container-fluid text-center">
			Sunay Sanghani Final Project &copy; 2022
		</div>

	</div> <!-- .container -->

</body>
</html>

