<!DOCTYPE html>
<html>
	<head>
		<title>Movie Library</title>
		<link href="movie_style.css" type="text/css" rel="stylesheet" />
		<script src="functions.js" ></script>
		<link href="https://fonts.googleapis.com/css?family=Questrial" rel="stylesheet">
		<meta name="viewport" content="width=device-width, initial-scale=1" />
	</head>
	<body>
	<div class="header">
		<div class="subheader">
			<div class="dropdownlibrary">
				<ul>
					<li>
						<a class="btn" id="movieLib" href="http://lisa.bendiksens.net/movie_library/index.php">
							<img class="btn" id="dropbtn" title="Choose Library" src="/library/images/movie_chooseLibraryBtn_v2.png" />
						</a>
					<ul>
						<li title="Vinyl Library">
							<a class="btn" id="vinylLib" href="http://lisa.bendiksens.net/vinyl_library/index.php">
								<img src="/library/images/vinyl_chooseLibraryBtn.png" />Vinyl Library
							</a>
						</li>
						<li title="Game Library">
							<a class="btn" id="gameLib" href="http://lisa.bendiksens.net/game_library/index.php">
								<img src="/library/images/game_chooseLibraryBtn.png" />Game Library
							</a>
						</li>
					</ul>
					</li>
				</ul>
			</div>
			<div class="logo">
				<a href="index.php">
					<img title="Home" id="title" src="/library/images/logo_movieLibrary.png" />
				</a>
			</div>
			<ul class="navigation">
				<li><a href="?x=addMovie">Add Movie</a></li>
				<li><a href="?x=randomTitle">Random Title</a></li>
				<li><a href="?x=wishlist">Wishlist</a></li>
				<li><a href="?x=advancedSearch">Advanced Search</a></li>
			</ul>
			
			<div class="sub_right">
				<form action="index.php" method="GET">
					<input type="hidden" name="x" value="searchResult" />
					<input type="text" name="search" />
					<input type="submit" id="searchbtn" value="">
				</form>			
				<div>
					<div id="loggedin">		
						Logged in as 
						<?php echo $_SESSION['username']; ?>
					</div>
					<a href="http://lisa.bendiksens.net/library/?f=logout">
						<img title="Log out" class="btn" id="logoutbtn" src="/library/images/movie_logoutBtn.png" />
					</a>
				</div>
			</div>
		</div>
	</div>
	<div class= "main">
