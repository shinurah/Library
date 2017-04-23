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

$vinylId = $_GET['id'];

$result = $conn->query("SELECT * FROM vinyls WHERE id='".$vinylId."'");
$vinyl = $result->fetch_object();

$e_title = $vinyl->title;
$e_artist = $vinyl->artist;
$e_genre = $vinyl->genre;
$e_label = $vinyl->label;
$e_release_year = $vinyl->release_year;
$e_producer = $vinyl->producer;
?>
<div class="form">
	<h2>Edit Vinyl</h2>
	<form action="doEditVinyl.php" method="post" enctype="multipart/form-data">
		<table>
			<tr>
				<td>Artist: </td>
				<td><input required type="text" name="artist" value="<?echo $e_artist; ?>"></td>
			</tr>
			<tr>
				<td>Title: </td>
				<td><input required type="text" name="title" value="<?echo $e_title; ?>"></td>
			</tr>
			<tr>
				<td>Release year: </td>
				<td><input required type="text" name="release_year" value="<?echo $e_release_year; ?>"></td>
			</tr>
			<tr>
				<td>Genre: </td>
				<td><select required class="dropdown" id="dropdownwidth" name="genre">
						<option value="<? echo $e_genre; ?>" selected><? echo $e_genre; ?></option>
						<option value="Blues">Blues</option>
						<option value="Country">Country</option>
						<option value="Electronic">Electronic</option>
						<option value="Hip Hop">Hip Hop</option>
						<option value="Jazz">Jazz</option>
						<option value="Pop">Pop</option>
						<option value="Rock">Rock</option>

						<option value="EDM">EDM</option>
					</select>
				</td>
			</tr>
			<tr>
				<td>Label: </td>
				<td><input required type="text" name="label" value="<? echo $e_label; ?>"></td>
			</tr>
			<tr>
				<td>Producer: </td>
				<td><input required type="text" name="producer" value="<? echo $e_producer; ?>"></td>
			</tr>
		</table>
		<input type='hidden' name='id' value="<?echo $vinylId;?>">
		<input title="Update vinyl" class="btn" id="nextbtn" type="submit" value="">
	</form>
</div>
