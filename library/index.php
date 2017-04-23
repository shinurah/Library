<!DOCTYPE html>
<html>
	<head>
		<title>The Library</title>
		<link href="style.css" type="text/css" rel="stylesheet" />
	</head>	
<?php
ob_start();
session_start();

if($_SESSION['fhjd'] == "ja") {
	echo '
		<div class="library_buttons">
			<div class="libraryBtn">
				<a href="http://lisa.bendiksens.net/movie_library/index.php" title="Movie Library">
					<img class="btn" src="images/libraryMovie_btn.png" />
				</a>
		 	</div>
		 	<div class="libraryBtn">
				<a href="http://lisa.bendiksens.net/vinyl_library/index.php" title="Vinyl Library">
					<img class="btn" src="images/libraryVinyl_btn.png" />
				</a>
		 	</div>
		 	<div class="libraryBtn">
				<a href="http://lisa.bendiksens.net/game_library/index.php" title="Game Library">
					<img class="btn" src="images/libraryGame_btn.png" />
				</a>
		 	</div>
		</div>';
} else {
	include 'login.php';
}
if($_GET['f'] == "logout") {
	session_unset();
	session_destroy();
	
	header('location: http://lisa.bendiksens.net');
}
?>

	<body>
	</body>
</html>