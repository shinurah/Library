<?php
	session_start();
	if($_SESSION['fhjd'] != "ja"){
		header('location: http://lisa.bendiksens.net');
	}
	include_once '../library/config.php';
?>

<?php
	function convertSecToMinSec($time, $format = '%d:%s') {
		settype($time, 'integer');
		if($time < 0 || $time >= 1440) {
			return;
		}
		$minutes = floor($time/60);
		$seconds = $time%60; //returns remaining seconds
		if ($seconds < 10) {
			$seconds = '0' . $seconds;
		} 
		return sprintf($format, $minutes, $seconds);
	}
	$vinylId = $_POST['id'];

	$track_name = $conn->real_escape_string($_POST['track_name']);
	$track_no = $conn->real_escape_string($_POST['track_no']);
	$length = $conn->real_escape_string($_POST['track_length']);
	$writers = $conn->real_escape_string($_POST['writers']);
	
	$track_length = convertSecToMinSec($length);
	
	$conn->query("INSERT INTO vinyl_tracks 
		(vinyl_id, track_name, track_length, writers, track_no)
		VALUES ('".$vinylId."', '".$track_name."', '".$track_length."', '".$writers."', 
		'".$track_no."' )");
			
	header("Location: http://lisa.bendiksens.net/vinyl_library/index.php?x=addTracks&id=".$vinylId);
?>