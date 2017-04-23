<?php
	include_once '../library/config.php';
	session_start();
	if($_SESSION['fhjd'] != "ja"){
	header('location: http://lisa.bendiksens.net');
	}
?>
<div class = "row">
<h2>Random Movie</h2>

<?php
	$sql = "SELECT id, image, title FROM movies ORDER BY rand() LIMIT 1";
	$result = $conn->query($sql);
	
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			echo '
			<div class="movie">
				<div class="specmoviecover" id="randomcover">
					<a class="title_link" title="'.$row['title'].'" href="?x=infoMovie&id='.$row['id'].'">
						<img  src="'.$row['image'].'" />
					</a>
				</div>
				<div class="movie_title" id="biggertitle">
					<a class="title_link" title="'.$row['title'].'" href="?x=infoMovie&id='.$row['id'].'">
						<p>'.$row['title'].'</p>
					</a>
				</div>
			</div>';
		}
	}
	else {
		echo "0 results";
	}
?>
<br>
<a href="index.php?x=randomTitle">
	<img title="Random title" class="btn" src="/library/images/movie_randomBtn.png" />
</a>

</div>