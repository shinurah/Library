<?php
	session_start();
	if($_SESSION['fhjd'] != "ja"){
		header('location: http://lisa.bendiksens.net');
	}
	include_once '../library/config.php';
?>

<?php
	$wishtitle = $conn->real_escape_string($_POST['title']);	
	$date = time();
	$user = $_SESSION['username'];

	$checkwishlist = $conn->query("SELECT wishtitle FROM wishlist WHERE wishtitle='".$wishtitle."'");
	$checkmovie = $conn->query("SELECT title FROM movies WHERE title='".$wishtitle."'");
	
	if($checkwishlist->num_rows > 0){
		header("Location: http://lisa.bendiksens.net/movie_library/index.php?x=wishlist&wish=inwish");
	}
	elseif ($checkmovie->num_rows > 0) {
		header("Location: http://lisa.bendiksens.net/movie_library/index.php?x=wishlist&wish=inlibrary");
	}
	else {
		$conn->query("INSERT INTO wishlist (wishtitle, date_created, username) VALUES 
			('".$wishtitle."', '".$date."', '".$user."')"); 
	
	//$userwishjoin = $conn->query("SELECT username, users.userid FROM users INNER JOIN wishlist ON users.userid = wishlist.userid");
	//echo $userwishjoin;
		header("Location: http://lisa.bendiksens.net/movie_library/index.php?x=wishlist&wish=success");
	}
?>