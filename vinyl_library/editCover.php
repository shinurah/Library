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
?>
<div>
	<h2>Edit cover for <?=$e_title?> by <?=$e_artist?></h2>
	<form id="covercontent" action="doEditCover.php" method="post" enctype="multipart/form-data">
		<input type="file" name="fileToUpload" id="fileToUpload">
		<input type='hidden' name='id' value="<?echo $vinylId;?>">
		<input title="Update vinyl cover" class="btn" id="donebtn" type="submit" value="">	
	</form>
</div>