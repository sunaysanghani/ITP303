<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Your Favorite Music Albums</title>
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
	}
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
			<div id="center"><img src="img/vinyl.png" alt="Records and Vinyl"> </div>
			<h2> We have curated a list of popular albums. Please navigate to the search bar where you can edit, update, and delete some of the current album list. Additionally, you can add albums that may not exist already from current artists. I also recommend checking out your favorites where you can select all of the albums and send yourself your ideal album playlist! Which albums would you pick if you had to listen to them forever? Welcome to Album Island.</h2>
		</div> <!-- .container -->
		<div id="footer" class="container-fluid text-center">
			Sunay Sanghani Final Project &copy; 2022
		</div>
</body>
</html>