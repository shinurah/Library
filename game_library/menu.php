<!DOCTYPE html>
<html>
	<head>
		<title>Game Library</title>
		<link href="game_style.css" type="text/css" rel="stylesheet" />
		<script src="../movie_library/functions.js" ></script>
		<link href="https://fonts.googleapis.com/css?family=Questrial" rel="stylesheet">
	</head>
	<body>
	<div class="header">
		<div class="subheader">
			<div class="dropdownlibrary">
				<ul>
					<li><img class="btn" id="dropbtn" title="Choose Library" src="/library/images/game_chooseLibraryBtn.png" />
					<ul>
						<li title="Vinyl Library">
							<a class="btn" id="vinylLib" href="http://lisa.bendiksens.net/vinyl_library/index.php">
								<img src="/library/images/vinyl_chooseLibraryBtn.png" />Vinyl Library
							</a>
						</li>
						<li title="Movie Library">
							<a class="btn" id="movieLib" href="http://lisa.bendiksens.net/movie_library/index.php">
								<img src="/library/images/movie_chooseLibraryBtn_v2.png" />Movie Library
							</a>
						</li>
					</ul>
					</li>
				</ul>
			</div>
			<div class="logo">
				<a href="index.php">
					<img title="Home" id="title" src="/library/images/logo_gameLibrary.png" />
				</a>
			</div>
			<ul role="navigation">
				<li><a href="#">Add Game</a></li>
				<li><a href="#">Random Title</a></li>
				<li><a href="#">Wishlist</a></li>
				<li><a href="#">Advanced Search</a></li>
			</ul>
			<div class="sub_right">
				<form action="index.php" method="GET">
					<input type="hidden" name="x" value="searchResult" />
					<input type="text" name="search" />
					<input type="submit" id="searchbtn" value="">
				</form>			
				<div>				
					Logged in as 
					<?php echo $_SESSION['username']; ?>
					<a href="http://lisa.bendiksens.net/library/?f=logout">
						<img title="Log out" class="btn" id="logoutbtn" src="/library/images/game_logoutBtn.png" />
					</a>
				</div>
			</div>
	</div>
	<div class= "main">
