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
	
	$artist = $conn->real_escape_string($_POST['artist']);
	$title = $conn->real_escape_string($_POST['title']);
	$release_year = $conn->real_escape_string($_POST['release_year']);
	$genre = $conn->real_escape_string($_POST['genre']);
	$label = $conn->real_escape_string($_POST['label']);
	$producer = $conn->real_escape_string($_POST['producer']);
	$date = time();
	
	//save image to folder
	$randomFileName = makeRandomString();
	$target_dir = 'vinyl_images/';
	$target_file_origin = $_FILES['fileToUpload']['tmp_name'];
	$path_parts = pathinfo($_FILES['fileToUpload']['name']);
	$extension = $path_parts['extension'];
	$target_file = $target_dir . $randomFileName.".".$extension;
	move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
	
	$image = "http://lisa.bendiksens.net/vinyl_library/".$target_file;
	
	$vinylExist = $conn->query("SELECT title FROM vinyls WHERE title='".$title."'");
	if ($vinylExist->num_rows > 0) {
		header("Location: http://lisa.bendiksens.net/vinyl_library/index.php?x=addVinyl&vinyl=exists");
	}
	else 
	{
		$conn->query("INSERT INTO vinyls 
			(artist, title, release_year, genre, label, producer, date_created, image)
			VALUES ('".$artist."', '".$title."', '".$release_year."', '".$genre."',  
			'".$label."', '".$producer."', '".$date."', '".$image."' )");
			
			$id = $conn->insert_id;

		header("Location: http://lisa.bendiksens.net/vinyl_library/index.php?x=addTracks&id=".$id);
	}
?>