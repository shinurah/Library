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
	
	if($_GET["x"] == "advancedSearch") {
		include "advancedSearch.php";
	}
	
	if($_GET["x"] == "randomTitle") {
		include "randomTitle.php";
	}
	
	if($_GET["x"] == "addMovie") {
		include "addMovie.php";
	}
	
	if($_GET["x"] == "wishlist") {
		include "wishlist.php";
	}
	
		
	if($_GET["x"] == "infoMovie") {
		include "infoMovie.php";
	}
	if($_GET["x"] == "searchResult") {
		include "searchResult.php";
	}
	if($_GET["x"] == "editMovie") {
		include "editMovie.php";
	}
	if($_GET["x"] == "editCover") {
		include "editCover.php";
	}
	if($_GET["x"] == "advancedSearchResult") {
		include "advancedSearchResult.php";
	}
	if($_GET["x"] == "tagResult") {
		include "tagResult.php";
	}
	
	include "footer.php";
?>
