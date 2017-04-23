<?php
 	session_start();
	if($_SESSION['fhjd'] != "ja"){
		header('location: http://lisa.bendiksens.net');
	}
	
	
	require "../library/config.php";
	include "menu.php";
	
	if($_GET["x"] == "") {
		include "home.php";
	}
	
	include "../movie_library/footer.php";
?>
	