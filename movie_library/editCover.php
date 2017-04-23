<?php
	include_once '../library/config.php';
	session_start();
	if($_SESSION['fhjd'] != "ja"){
	header('location: http://lisa.bendiksens.net');
	}
?>
<?php
$movieId = $_GET['id'];

$result = $conn->query("SELECT * FROM movies WHERE id='".$movieId."'");
$movie = $result->fetch_object();

$e_title = $movie->title;
?>
<div>
	<h2>Edit cover for <?=$e_title?></h2>
	<form id="covercontent" action="doEditCover.php" method="post" enctype="multipart/form-data">
		<input type="file" name="fileToUpload" id="fileToUpload">
		<input type='hidden' name='id' value="<?echo $movieId;?>">
		<input title="Update movie" class="btn" id="donebtn" type="submit" value="">	
	</form>
</div>