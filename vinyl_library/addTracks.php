<?php
	include_once '../library/config.php';
	session_start();
	if($_SESSION['fhjd'] != "ja"){
	header('location: http://lisa.bendiksens.net');
	}
?>
<?php
if($_GET['id'] == '') {
	header('location: http://lisa.bendiksens.net/vinyl_library/index.php?x=addVinyl');
}
else {
			
}

$vinylId = $_GET['id'];
$result = $conn->query("SELECT * FROM vinyls WHERE id='".$vinylId."'");
$vinyl = $result->fetch_object();
$title = $vinyl->title;
$artist = $vinyl->artist;
?>
<div class="container">
<div class="form">
	<h2>Add tracks for <?=$title?> by <?=$artist?></h2>
	<form action="doAddTracks.php" method="post">
		<table>
			<tr>
				<td>Track name: </td>
				<td><input required type="text" name="track_name"></td>
			</tr>
			<tr>
				<td>Track number: </td>
				<td><input required type="text" name="track_no"> </td>
			</tr>
			<tr>
				<td>Track length: </td>
				<td><input required type="number" name="track_length"></td>
				<td>in seconds</td>
			</tr>
			<tr>
				<td>Writer(s): </td>
				<td><input type="text" name="writers"</td>
			</tr>
		</table>
		<input type='hidden' name='id' value="<?echo $vinylId;?>">
		<input title="Add vinyl to library" class="btn" id="addTrackbtn" type="submit" value="">
	</form>	
</div>
<div class="addedTracks">
	<h2>Added Tracks</h2>
	<table>
		<tr>
			<td>No.</td>
			<td>Title</td>
			<td>Length</td>
			<td>Writer(s)</td>
		</tr>

	<?php
		$tracks = $conn->query("SELECT * FROM vinyl_tracks WHERE vinyl_id = ".$vinylId." ORDER BY track_no ASC");
		if($tracks->num_rows > 0) {
			while ($row = $tracks->fetch_assoc()) {
				echo '
				<tr>
					<td>'.$row['track_no'].'</td>
					<td>'.$row['track_name'].'</td>
					<td>'.substr($row['track_length'], 0, -3).'</td>
					<td>'.$row['writers'].'</td>
				</tr>';
			}
		}
		else {
			echo '0 results';
		}
		echo '</table>';
	?>

<a href="index.php?x=infoVinyl&id=<?=$vinylId?>">
	<img title="Done adding tracks" id="floatright" class="btn" src="/library/images/vinyl_doneBtn.png" />
</a>
</div>
</div>
