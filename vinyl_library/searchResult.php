<?php
	include_once '../library/config.php';
	session_start();
	if($_SESSION['fhjd'] != "ja"){
		header('location: http://lisa.bendiksens.net');
	}
?>

<?php
 $search = $_GET['search'];
 $min_length = 3;
 
 echo '<h2>You searched for: ' .$search.'</h2>';
 
 if(strlen($search)>= $min_length){
 	$search = htmlspecialchars($search);
	//$search = mysqli_real_escape_string($search);
	
	$sql ="SELECT * FROM vinyls WHERE (title LIKE '%".$search."%') 
		OR (artist LIKE '%".$search."%')
		OR (genre LIKE '%".$search."%') 
		OR (label LIKE '%".$search."%') 
		OR (release_year LIKE '%".$search."%')
		OR (producer LIKE '%".$search."%')";
		/*
		OR (writers LIKE '%".$search."%')
		OR (track_name LIKE '%".$search."%')" ;*/
	
	$trackSql = "SELECT * FROM vinyl_tracks WHERE (track_name LIKE '%".$search."%')
				OR (writers LIKE '%".$search."%')";	

	$raw_result =  $conn->query($sql);
	$track_raw_result = $conn->query($trackSql);
	
	/**/
	/*$vinyl = $track_raw_result->fetch_object();
	$vinylId = $vinyl->vinyl_id;
	
	$getAlbumSql = "SELECT title FROM vinyls WHERE id='".$vinylId."'";
	$getAlbumRaw = $conn->query($getAlbumSql);*/
?>
<div>
<h3>Album Results</h3>
<?php echo $raw_result->num_rows. ' hits'.'<br/>';?>
<div class="row">
	<div id="cover">
<?php
	if($raw_result->num_rows > 0){	
		while($result = $raw_result->fetch_assoc()){		
			echo '
			<div class="vinyl">
				<a class="title_link" title="'.$result['artist'].'" href="?x=infoVinyl&id='.$result['id'].'">
					<p>'.$result['artist'].'</p>
				</a>
				<div class="vinyl_image">
					<a class="title_link" title="'.$result['title'].'" href="?x=infoVinyl&id='.$result['id'].'">
						<img src="'.$result['image'].'" />
						</a>
				</div>
				<a class="title_link" title="'.$result['title'].'" href="?x=infoVinyl&id='.$result['id'].'">
					<p>'.$result['title'].'</p>
				</a>
			</div>';
		}
	} else {
		echo 'No result.';
	}
 
?>
	</div>
</div>
<h3>Track Results</h3>
<?php echo $track_raw_result->num_rows. ' hits'.'<br/>';?>
<div class="row">
	<div id="cover">
		<table>	
		<tr id="colorchange">
			<td>No.</td>
			<td>Title</td>
			<td>Writer(s)</td>
			<td>Length</td>
		</tr>
<?php
	if($track_raw_result->num_rows > 0){	
		while($track_result = $track_raw_result->fetch_assoc()/* && $getAlbum = $getAlbumRaw->fetch_assoc()*/){		
			echo '
			<tr>
				<td>'.$track_result['track_no'].'</td>
				<td>'.$track_result['track_name'].'</td>
				<td>'.$track_result['writers'].'</td>
				<td>'.substr($track_result['track_length'], 0, -3).'</td> 
				<td> from album </td>
				<td> X </td>
			</tr>';

		}
	} else {
		echo 'No result.';
	}
 }
 else {
 	echo "Minimum length is " .$min_length;
 }
?>
	</div>
</div>
</div>