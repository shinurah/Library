<?php
	include_once '../library/config.php';
	session_start();
	if($_SESSION['fhjd'] != "ja"){
	header('location: http://lisa.bendiksens.net');
	}
?>
<div class = "row">
<h2>Random Vinyl</h2>

<?php
	$sql = "SELECT id, image, title, artist FROM vinyls ORDER BY rand() LIMIT 1";
	$result = $conn->query($sql);
	
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			echo '
			<div class="vinyl">
				<a class="title_link" title="'.$row['artist'].'" href="?x=infoVinyl&id='.$row['id'].'">
					<p>'.$row['artist'].'</p>
				</a>
				<div class="vinyl_image" id="randomcover">
					<a class="title_link" title="'.$row['title'].'" href="?x=infoVinyl&id='.$row['id'].'">
						<img  src="'.$row['image'].'" />
					</a>
				</div>
				<a class="title_link" title="'.$row['title'].'" href="?x=infoMovie&id='.$row['id'].'">
					<p>'.$row['title'].'</p>
				</a>
			</div>';
		}
	}
	else {
		echo "0 results";
	}
?>
<br>
<a href="index.php?x=randomTitle">
	<img title="Random title" class="btn" src="/library/images/vinyl_randomBtn.png" />
</a>

</div>