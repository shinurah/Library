<?php
	include_once '../library/config.php';
	session_start();
	if($_SESSION['fhjd'] != "ja"){
	header('location: http://lisa.bendiksens.net');
	}
?>
<?php
if($_GET['id'] == '') {
	header('location: http://lisa.bendiksens.net/vinyl_library/index.php');
}
else {
			
}

$track_id = $_GET['trackid'];


$trackResult = $conn->query("SELECT * FROM vinyl_tracks WHERE track_id='".$track_id."'");
$track = $trackResult->fetch_object();
$track_name = $track->track_name;
$track_length = $track->track_length;
$writers = $track->writers;
$track_no = $track->track_no;
$vinyl_id = $track->vinyl_id;

$result = $conn->query("SELECT * FROM vinyls WHERE id='".$vinyl_id."'");
$vinyl = $result->fetch_object();
$title = $vinyl->title;
$artist = $vinyl->artist;

function convertToSec ($min) {
	if(strstr($min, ':')) {
		$separatedData = split(':', $min);
		
		$secondsInMinutes = $separatedData[0] * 60;
		$seconds = $separatedData[1];
		
		$totalSeconds = $secondsInMinutes + $seconds;
	} else {
		$totalSeconds = $min * 60;
	}
	return $totalSeconds;
}

$track_length = convertToSec($track_length);
?>
<div class="container">
<div class="form">
	<h2>Edit <?=$track_name?> for <?=$title?> by <?=$artist?></h2>
	<form action="doEditTracks.php" method="post">
		<table>
			<tr>
				<td>Track name: </td>
				<td><input required type="text" name="track_name" value="<?=$track_name?>"></td>
			</tr>
			<tr>
				<td>Track number: </td>
				<td><input required type="text" name="track_no" value="<?=$track_no?>"> </td>
			</tr>
			<tr>
				<td>Track length: </td>
				<td><input required type="number" name="track_length" value="<?=$track_length?>"></td>
				<td>in seconds</td>
			</tr>
			<tr>
				<td>Writer(s): </td>
				<td><input type="text" name="writers" value="<?=$writers?>"></td>
			</tr>
		</table>
		<input type='hidden' name='vinylid' value='<?echo $vinyl_id;?>'>
		<input type='hidden' name='trackid' value="<?echo $track_id;?>">
		<input title="Done editing track" class="btn" id="donebtn" type="submit" value="">
	</form>	
</div>
</div>
