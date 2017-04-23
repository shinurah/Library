<!DOCTYPE html>
<html>
	<head>
		<title>Vinyl Library</title>
		<link href="vinyl_style.css" type="text/css" rel="stylesheet" />
		<script src="functions.js" ></script>
		<link href="https://fonts.googleapis.com/css?family=Questrial" rel="stylesheet">
	</head>
	<body>
	<div class="header">
		<div class="subheader">
			
			<div class="dropdownlibrary">
				<ul>
					<li><img class="btn" id="dropbtn" title="Choose Library" src="/library/images/vinyl_chooseLibraryBtn.png" />
					<ul>
						<li title="Movie Library">
							<a class="btn" id="movieLib" href="http://lisa.bendiksens.net/movie_library/index.php">
								<img src="/library/images/movie_chooseLibraryBtn_v2.png" />Movie Library
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
					<img title="Home" id="title" src="/library/images/logo_vinylLibrary.png" />
				</a>
			</div>
			<ul role="navigation">
				<li><a href="?x=addVinyl">Add Vinyl</a></li>
				<li><a href="?x=randomTitle">Random Title</a></li>
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
						<img title="Log out" class="btn" id="logoutbtn" src="/library/images/vinyl_logoutBtn.png" />
					</a>
				</div>
			</div>
	</div>
	<div class= "main">
