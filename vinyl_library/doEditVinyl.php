<?php
	session_start();
	if($_SESSION['fhjd'] != "ja"){
		header('location: http://lisa.bendiksens.net');
	}
	include_once '../library/config.php';
?>
<?php
	$vinylId = $_POST['id'];

	$artist = $conn->real_escape_string($_POST['artist']);
	$title = $conn->real_escape_string($_POST['title']);
	$release_year = $conn->real_escape_string($_POST['release_year']);
	$genre = $conn->real_escape_string($_POST['genre']);
	$label = $conn->real_escape_string($_POST['label']);
	$producer = $conn->real_escape_string($_POST['producer']);
	
	$sql = $conn->query("UPDATE vinyls SET artist='".$artist."', title='".$title."', release_year='".$release_year."', 
			genre='".$genre."', label='".$label."', producer='".$producer."' WHERE id='".$vinylId."'");

	header("Location: http://lisa.bendiksens.net/vinyl_library/index.php?x=addTracks&id=".$vinylId);
?>