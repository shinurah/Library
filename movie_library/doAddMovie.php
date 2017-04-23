<?php
	session_start();
	if($_SESSION['fhjd'] != "ja"){
		header('location: http://lisa.bendiksens.net');
	}
	include_once '../library/config.php';
?>
<?php
	function makeRandomString($max=10){
		$i = 0; //Reset the counter
		$possible_keys = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$keys_length = strlen($possible_keys);
		$str = ''; //Declare the string, to add later
		while($i<$max) {
			$rand = mt_rand(1,$keys_length-1);	
			$str.= $possible_keys[$rand];
			$i++;
		}
		return $str;
	}

	function convertToHoursMins($time, $format = '%d:%s') {
		settype($time, 'integer');
		if($time < 0 || $time >= 1440) {
			return;
		}
		$hours = floor($time/60);
		$minutes = $time%60; //returns remaining minutes
		if ($minutes < 10) {
			$minutes = '0' . $minutes;
		} 
		return sprintf($format, $hours, $minutes);
	}
	
	$title = $conn->real_escape_string($_POST['title']);	
	$release_year = $conn->real_escape_string($_POST['release_year']);
	$genre = $conn->real_escape_string($_POST['genre']);
	$actors = $conn->real_escape_string($_POST['actors']);
	$directors = $conn->real_escape_string($_POST['directors']);
	$writers = $conn->real_escape_string($_POST['writers']);
	$tag = $conn->real_escape_string($_POST['tag']);
	$imdb_link = $conn->real_escape_string($_POST['imdb_link']);
	$imdb_rating = $conn->real_escape_string($_POST['imdb_rating']);
	//$image = $conn->real_escape_string($_POST['fileToUpload']);
	$date = time();
	$summary = $conn->real_escape_string($_POST['summary']);
	$length = $conn->real_escape_string($_POST['length']);
	
	//convert the movie length from minutes to hours+minutes
	$movie_length = convertToHoursMins($length);
	
	//save image to folder
	$randomFileName = makeRandomString();
	$target_dir = 'movie_images/';
	$target_file_origin = $_FILES['fileToUpload']['tmp_name'];
	$path_parts = pathinfo($_FILES['fileToUpload']['name']);
	$extension = $path_parts['extension'];
	$target_file = $target_dir . $randomFileName.".".$extension;
	move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
	
	$image = "https//lisa.bendiksens.net/movie_library/".$target_file;

	$checkwishlist = $conn->query("SELECT wishtitle FROM wishlist WHERE wishtitle='".$title."'");
	if($checkwishlist->num_rows > 0){
		$conn->query("DELETE FROM wishlist WHERE wishtitle = '".$title."'");
	}
	
	$sep_tags = explode (", ", $tag);
	
	$checkmovie = $conn->query("SELECT title FROM movies WHERE title='".$title."'");
	if ($checkmovie->num_rows > 0) {
		header("Location: http://lisa.bendiksens.net/movie_library/index.php?x=addMovie&movie=exists");
	}
	else 
	{
		$conn->query("INSERT INTO movies 
			(title, release_year, genre, actors, directors, writers, tag, 
			imdb_link, imdb_rating, image, date_created, summary, movie_length)
			VALUES ('".$title."', '".$release_year."', '".$genre."', '".$actors."', 
			'".$directors."', '".$writers."', '".$tag."', '".$imdb_link."',
			'".$imdb_rating."', '".$image."','".$date."', '".$summary."', '".$movie_length."' )");
		
		$id = $conn->insert_id;
		// X	 explode tags on comma -> array
		// X	 query get last movie id
		// X 	loop through array
			// X		conn query insert 1xtag into movie_tags every loop
		// SAME FOR EDIT MOVIE PLS THANKS
		// check if exist, if not-> create. remove tag from taglist->
		
		foreach ($sep_tags as $single_tag) {
			$conn->query("INSERT INTO movie_tags (movie_id, tag_name) 
				VALUES ('".$id."', '".$single_tag."')");
		}
		
		header("Location: http://lisa.bendiksens.net/movie_library/index.php");
	}
	

?>
