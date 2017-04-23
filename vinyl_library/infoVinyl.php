<?php
	ob_start();
	include_once '../library/config.php';
	session_start();
	if($_SESSION['fhjd'] != "ja"){
		header('location: http://lisa.bendiksens.net');
	}
?>
<?php
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
function convertSecToMinSec($time, $format = '%d:%s') {
	settype($time, 'integer');
	if($time < 0) {
		return;
	}
	$minutes = floor($time/60);
	$seconds = $time%60; //returns remaining seconds
	if ($seconds < 10) {
		$seconds = '0' . $seconds;
	} 
	return sprintf($format, $minutes, $seconds);
}
$vinylId = $_GET['id'];

$result = $conn->query("SELECT * FROM vinyls WHERE id='".$vinylId."'");
$vinyl = $result->fetch_object();
$artist = $vinyl->artist;
$title = $vinyl->title;
$date_created = $vinyl->date_created;
$date_created = date('d.m.Y',$date_created);
$genre = $vinyl->genre;
$image = $vinyl->image;
$label = $vinyl->label;
$release_year = $vinyl->release_year;
$producer = $vinyl->producer;

// Calculates total length of vinyl
$trackResult = $conn->query("SELECT * FROM vinyl_tracks WHERE vinyl_id='".$vinylId."'");
$sumTrackLength = 0;
// Goes through each track, converts the length from min/sec to sec, sums it up
foreach ($trackResult as $singletrack){
	$trackSeconds = convertToSec($singletrack['track_length']);
	$sumTrackLength += $trackSeconds;	
}
$trackTotalLength = 0;
// Converts length from sec to min/sec
$trackTotalLength = convertSecToMinSec($sumTrackLength);

$trackResult = $conn->query("SELECT * FROM vinyl_tracks WHERE vinyl_id='".$vinylId."'");
?>

<div class="content">
	<div id="infoVinylTitle">
		<ul class="infoVinylList">
			<li><?=$title?></li> 
			<li></li>
			<li> | </li>
			<li></li>
			<li>by <?=$artist?></li>
		</ul>	
	</div>	
	<div class="infoVinylContent">
		<div class="infoContent">
			<ul class="infoVinylList">
				<li class="maininfofix">Total Length: <?=$trackTotalLength?> </li>
				<li></li>
				<li class="maininfofix"> | </li>
				<li></li>
				<li class="maininfofix"> <?=$genre?></li>
				<li></li>
				<li class="maininfofix"> | </li>
				<li></li>
				<li class="maininfofix"> <?=$release_year?></li>
			</ul>
			<table id="tablespacing">
				<tr>
					<td>Label: </td>
					<td><p class="limitshowinfo"><?=$label?></p></td>
				</tr>
				<tr>
					<td>Producer: </td>
					<td><p class="limitshowinfo"><?=$producer?></p></td>
				</tr>
				<tr>
					<td>Date added to library: </td>
					<td><p class="limitshowinfo"><?=$date_created?></p></td>
				</tr>
			</table>
		</div>
		<div class="coverContent">
			<div class="vinylCover">
				<img src=<?=$image?> />
			</div>
			<a href="index.php?x=editCover&id=<?=$vinylId?>">
				<img class="btn" id="floatright" title="Edit vinyl cover" src="/library/images/vinyl_editCoverBtn.png" />
			</a>
		</div>
	</div>
	<div class="tracks">
		<h3>Tracklist</h3>
		<table>	
			<tr id="colorchange">
				<td>No.</td>
				<td>Title</td>
				<td>Writer(s)</td>
				<td>Length</td>
			</tr>
		<?php
			if ($trackResult->num_rows > 0) {
				while($tracks = $trackResult->fetch_assoc()) {
					echo '
					<tr>
						<td>'.$tracks['track_no'].'</td>
						<td>'.$tracks['track_name'].'</td>
						<td>'.$tracks['writers'].'</td>
						<td>'.substr($tracks['track_length'], 0, -3).'</td>
						<td id="tdbtn">
							<a href="index.php?x=editTracks&trackid='.$tracks['track_id'].'">
								<img title="Edit track" class="btn" src="/library/images/vinyl_editBtn.png" />
							</a>
						</td>
						<td id="tdbtn">
							<img class="btn" title="Delete track from vinyl" onclick="deleteTrack('.$vinylId.','.$tracks['track_id'].')" src="/library/images/vinyl_deleteBtn.png" />
						</td>
					</tr>';
				}
			}
			else {
				echo "0 results";
			}
		?>
		</table>
	</div>
	<div id="buttons">
		<img class="btn" id="floatright" title="Delete vinyl from library" onclick="deleteCheck(<?=$vinylId?>)" src="/library/images/vinyl_deleteBtn.png" />
		<a href="index.php?x=editVinyl&id=<?=$vinylId?>">
			<img class="btn" id="floatright" title="Edit vinyl information" src="/library/images/vinyl_editBtn.png" />
		</a>
	</div>
</div>

<?php
if($_GET['f'] == "delete"){
	//$id = $_GET['id'];
	$conn->query("DELETE FROM vinyls WHERE id = '".$vinylId."'");
	$conn->query("DELETE FROM vinyl_tracks WHERE vinyl_id = '".$vinylId."'");
	header("location: http://lisa.bendiksens.net/vinyl_library/index.php");
}

if($_GET['t'] == "delete"){
	$del_vinyl_id = $_GET['id'];
	$del_track_id = $_GET['trackid'];
	$conn->query("DELETE FROM vinyl_tracks WHERE track_id = '".$del_track_id."'");
	header("location: http://lisa.bendiksens.net/vinyl_library/index.php?x=infoVinyl&id=".$del_vinyl_id);
}
?>
