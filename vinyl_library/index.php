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
	if($_GET["x"] == "addVinyl") {
		include "addVinyl.php";
	}
	if($_GET["x"] == "randomTitle") {
		include "randomTitle.php";
	}
	
	if($_GET["x"] == "infoVinyl") {
		include "infoVinyl.php";
	}

	if($_GET["x"] == "editCover") {
		include "editCover.php";
		
	}
	if($_GET["x"] == "addTracks") {
		include "addTracks.php";
	}
	if($_GET["x"] == "editVinyl") {
		include "editVinyl.php";
	}
	if($_GET["x"] == "editTracks") {
		include "editTracks.php";
	}
	if($_GET["x"] == "searchResult") {
		include "searchResult.php";
	}
	
	include "footer.php";
?>
	