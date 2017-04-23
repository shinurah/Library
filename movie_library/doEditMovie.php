<?php
	session_start();
	if($_SESSION['fhjd'] != "ja"){
		header('location: http://lisa.bendiksens.net');
	}
	include_once '../library/config.php';
?>

<?php
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
	
	
	$movieId = $_POST['id'];
	
	$title = $conn->real_escape_string($_POST['title']);	
	$release_year = $conn->real_escape_string($_POST['release_year']);
	$genre = $conn->real_escape_string($_POST['genre']);
	$actors = $conn->real_escape_string($_POST['actors']);
	$directors = $conn->real_escape_string($_POST['directors']);
	$writers = $conn->real_escape_string($_POST['writers']);
	$tag = $conn->real_escape_string($_POST['tag']);
	$imdb_link = $conn->real_escape_string($_POST['imdb_link']);
	$imdb_rating = $conn->real_escape_string($_POST['imdb_rating']);
	$summary = $conn->real_escape_string($_POST['summary']);
	$length = $conn->real_escape_string($_POST['length']);
	
	$sep_tags = explode (", ", $tag);
	
	//get all tags belonging to this id and put it in array
	$checktagremove = $conn->query("SELECT * FROM movie_tags WHERE movie_id='" .$movieId. "'");
	
	$db_array = array();
	while($rows = mysqli_fetch_array($checktagremove)) {
     	$db_array[]=$rows['tag_name'];
    }
	//find difference between database array and new tag array 
	$del_result = array_diff($db_array, $sep_tags);
	
	foreach ($sep_tags as $single_tag) {
			
		$checktaglist = $conn->query("SELECT * FROM movie_tags WHERE movie_id='".$movieId."' AND tag_name='".$single_tag."'");
		if ($checktaglist->num_rows > 0) {
			//tag already exists for this movie id, do nothing
		}

		else {
			//tag doesn't exist for this movie id, add it
			$conn->query("INSERT INTO movie_tags (movie_id, tag_name) 
				VALUES ('".$movieId."', '".$single_tag."')");
		}		
	}	
	foreach ($del_result as $del_tag){
		$conn->query("DELETE FROM movie_tags WHERE tag_name = '".$del_tag."' AND movie_id='".$movieId."'");
	}		
	
	$movie_length = convertToHoursMins($length);
	
		$sql = $conn->query("UPDATE movies SET title='".$title."', 
			release_year='".$release_year."', genre='".$genre."', 
			actors='".$actors."', directors='".$directors."', writers='".$writers."', tag='".$tag."',
			imdb_link='".$imdb_link."', imdb_rating='".$imdb_rating."', summary='".$summary."', 
			movie_length='".$movie_length."' WHERE id='".$movieId."'");
	

	header("Location: http://lisa.bendiksens.net/movie_library/index.php?x=infoMovie&id=".$movieId);
?>