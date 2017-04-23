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
	
	$track_id = $_POST['trackid'];
	$vinyl_id = $_POST['vinylid'];
	
	$track_name = $conn->real_escape_string($_POST['track_name']);
	$track_no = $conn->real_escape_string($_POST['track_no']);
	$length = $conn->real_escape_string($_POST['track_length']);
	$writers = $conn->real_escape_string($_POST['writers']);
	
	$track_length = convertSecToMinSec($length);
	
	$sql = $conn->query("UPDATE vinyl_tracks SET track_name='".$track_name."', track_no='".$track_no."', 
			track_length='".$track_length."', writers='".$writers."' WHERE track_id='".$track_id."'");
			
	header("Location: http://lisa.bendiksens.net/vinyl_library/index.php?x=infoVinyl&id=".$vinyl_id);
?>