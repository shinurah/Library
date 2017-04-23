<?php
	include_once '../library/config.php';
	session_start();
	if($_SESSION['fhjd'] != "ja"){
		header('location: http://lisa.bendiksens.net');
	}
?>

<?php
$s_title = $_GET['title'];
$s_releaseyear = $_GET['release_year'];
$s_genre = $_GET['genre'];
$s_actors = $_GET['actors'];
$s_directors = $_GET['directors'];
$s_writers = $_GET['writers'];
$s_tags = $_GET['tag'];
$s_imdb_rating = $_GET['imdb_rating'];
$s_summary = $_GET['summary'];
 
$s_title = htmlspecialchars($s_title);
$s_releaseyear = htmlspecialchars($s_releaseyear);
$s_actors = htmlspecialchars($s_actors);
$s_directors = htmlspecialchars($s_directors);
$s_writers = htmlspecialchars($s_writers);
$s_tags = htmlspecialchars($s_tags);
$s_imdb_rating = htmlspecialchars($s_imdb_rating);
$s_summary = htmlspecialchars($s_summary);

$sql ="SELECT * FROM movies WHERE (title LIKE '%".$s_title."%') 
		AND (release_year LIKE '%".$s_releaseyear."%')
		AND (genre LIKE '%".$s_genre."%')
		AND (actors LIKE '%".$s_actors."%') 
		AND (directors LIKE '%".$s_directors."%') 
		AND (writers LIKE '%".$s_writers."%')
		AND (tag LIKE '%".$s_tags."%') 
		AND (summary LIKE '%".$s_summary."%')" ;

$raw_result =  $conn->query($sql);
	
echo $raw_result->num_rows. ' hits'.'<br/>'; 
?>

<div class="row">
	<div id="cover">
<?php
	if($raw_result->num_rows > 0){	
		while($result = $raw_result->fetch_assoc()){		
			echo '
			<div class="movie">
				<div class="movie_image">
					<a class="title_link" title="'.$result['title'].'" rel="hovereffect" href="?x=infoMovie&id='.$result['id'].'"><img src="'.$result['image'].'" /></a>
				</div>
				<div class="movie_title">
					<a class="title_link" title="'.$result['title'].'" rel="hovereffect" href="?x=infoMovie&id='.$result['id'].'"><p>'.$result['title'].'</p></a>
				</div>
				
			</div>';
		}
	} else {
		echo 'No result.';
	}

?>
	</div>
</div>