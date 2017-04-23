<?php
	include_once '../library/config.php';
	session_start();
	if($_SESSION['fhjd'] != "ja"){
		header('location: http://lisa.bendiksens.net');
	}
?>

<?php
	$tag = $_GET['tag'];
	
	echo '<h2>Tag: '.$tag.'</h2>';
	
	$raw_result = $conn->query("SELECT * FROM movie_tags WHERE tag_name = '".$tag."'");
	echo $raw_result->num_rows. ' movies have this tag'.'<br/>';


	echo '<div class="row">';
	echo '<div id="cover">';
	foreach ($raw_result as $resultmovie) {

			$movies = $conn->query("SELECT image, title FROM movies WHERE id='".$resultmovie['movie_id']."'");
			while ($result = $movies->fetch_assoc()) {
			echo '
			<div class="movie">
				<div class="movie_image">
					<a class="title_link" title="'.$result['title'].'" rel="hovereffect" href="?x=infoMovie&id='.$resultmovie['movie_id'].'">
						<img src="'.$result['image'].'" />
					</a>
				</div>
				<div class="movie_title">
					<a class="title_link" title="'.$result['title'].'" rel="hovereffect" href="?x=infoMovie&id='.$resultmovie['movie_id'].'">
						<p>'.$result['title'].'</p>
					</a>
				</div>			
			</div>';
			}
	}	
?>


	</div>
</div>