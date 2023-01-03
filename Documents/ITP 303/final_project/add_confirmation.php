<?php
	if ( !isset($_POST['album_name']) || trim($_POST['album_name']) == ''
		|| !isset($_POST['artist_id']) || trim($_POST['artist_id']) == ''
		|| !isset($_POST['genre_id']) || trim($_POST['genre_id']) == ''
		|| !isset($_POST['release_year_id']) || trim($_POST['release_year_id']) == '') {
		var_dump($_POST);
		$error = "Please fill in all the fields.";
	} else {
		$host = "303.itpwebdev.com";
		$user = "sunaysan_db_user";
		$pass = "uscitp2022";
		$db = "sunaysan_music_db";

		$mysqli = new mysqli($host, $user, $pass, $db);
		if ($mysqli->connect_errno) {
			echo $mysqli->connect_error;
			exit();
		}

		//var_dump($_POST);

		
		if( isset($_POST["artist_id"]) && !empty($_POST["artist_id"]) ) {
			$artist_id = $_POST["artist_id"];
		}

		if( isset($_POST["genre_id"]) && !empty($_POST["genre_id"]) ) {
			$genre_id = $_POST["genre_id"];
		}
		if( isset($_POST["release_year_id"]) && !empty($_POST["release_year_id"]) ) {
			$release_year_id = $_POST['release_year_id'];
		}

		$album_name1 = $_POST["album_name"];
		
		

		$sql = "INSERT INTO music_info (artist_id, genre_id, album_name, release_year_id) VALUES ($artist_id, $genre_id, '$album_name1', $release_year_id);";
		$result = $mysqli->query($sql);

		if(!$result){
			echo $mysqli->error;
			$mysql->close();
			exit();
		}

		echo "<pre>";
		echo $sql;
		echo "</pre>";
		$mysqli->close();
		
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Add Confirmation | Album Database</title>
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
				<li><a href="index.php">Home</a></li>
				<li><a href="search_music.php">Search for Albums</a></li>
				<li><a href="add_album.php" class="active">Add an Album</a></li>
				<li><a href="view_favorites.php">View Your Favorites</a></li>
			</ul>
		</div>
	</div>

	<div class="container">

		<div class="row">
			<h1 class="col-12 mt-4">Add a Album</h1>
		</div> <!-- .row -->
	</div> <!-- .container -->
	<div class="container">
		<div class="row mt-4">
			<div class="col-12">

				<?php if ( isset($error) && !empty($error)) : ?>

				<div class="text-danger font-italic"><?php echo $error; ?></div>

				<?php else:?>

				<div class="text-success"><span class="font-italic"><?php echo $_POST['album_name']; ?></span> was successfully added.</div>
			<?php endif; ?>

			</div> <!-- .col -->
		</div> <!-- .row -->
		<div class="row mt-4 mb-4">
			<div class="col-12">
				<a href="add_album.php" role="button" class="btn btn-primary">Go Back to Add Form</a>
			</div> <!-- .col -->
		</div> <!-- .row -->
		<div id="footer" class="container-fluid text-center">
			Sunay Sanghani Final Project &copy; 2022
		</div>
	</div> <!-- .container -->
</body>
</html>