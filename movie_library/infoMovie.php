<?php
	ob_start();
	include_once '../library/config.php';
	session_start();
	if($_SESSION['fhjd'] != "ja"){
		header('location: http://lisa.bendiksens.net');
	}
?>
<?php
$movieId = $_GET['id'];

$result = $conn->query("SELECT title, release_year, genre, 
						image, directors, writers, actors, 
						date_created, movie_length, 
						imdb_rating, imdb_link, summary 
						FROM movies WHERE id='".$movieId."'");
$movie = $result->fetch_object();
$title = $movie->title;
$release_year = $movie->release_year;
$genre = $movie->genre;
$image = $movie->image;
$directors = $movie->directors;
$writers = $movie->writers;
$actors = $movie->actors;
$date_created = $movie->date_created;
$date_created = date('d.m.Y',$date_created);
$movie_length = substr($movie->movie_length, 0, -3);
$imdb_rating = $movie->imdb_rating;
$imdb_link = $movie->imdb_link;
$summary = $movie->summary;

$result_tags = $conn->query("SELECT * FROM movie_tags WHERE movie_id='".$movieId."'");
//$movie_tags = $result_tags->fetch_object();

$tag_array = array();
while($rows = mysqli_fetch_array($result_tags)){
	$tag_array[] = $rows['tag_name'];
}
?>

<div class="specificmovietotal">
	<div class="specmovietitle">
		<ul class="movieinfolist">
			<li><?=$title?></li> 
			<li class="maininfofix" id="titleyear">(<?=$release_year?>)</li>
		</ul>	
	</div>	
	<div class="specmoviecontent">
		<div class="specmoviecontentinfo">
			<ul class="movieinfolist">
				<li class="maininfofix"><?=$movie_length?></li>
				<li></li>
				<li class="maininfofix"> | </li>
				<li></li>
				<li class="maininfofix"> <?=$genre?></li>
			</ul>
			<table>
				<tr>
					<td>Actors: </td>
					<td><p class="limitshowinfo"><?=$actors?></p></td>
				</tr>
				<tr>
					<td>Directors: </td>
					<td><p class="limitshowinfo"><?=$directors?></p></td>
				</tr>
				<tr>
					<td>Writers: </td>
					<td><p class="limitshowinfo"><?=$writers?></p></td>
				</tr>
				<tr>
					<td>IMDB rating: </td>
					<td><p class="limitshowinfo"><?=$imdb_rating?>/10</p></td>
				</tr>
				<tr>
					<td>Date added: </td>
					<td><p class="limitshowinfo"><?=$date_created?></p></td>
				</tr>
				<tr>
					<td>Tags used: </td>
					<td><p class="limitshowinfo">
						<?php 
						foreach($tag_array as $tag){?>
							<a class="tags" href="?x=tagResult&tag=<?=$tag?>">
							<?php 
								echo $tag; 
								echo '</a>';
								echo ', ';
						}?>
						
					</p></td>
				</tr>
			</table>	
			<a href=<?=$imdb_link?> target="_blank"><p class="imdburl"><?=$title?> On IMDB</p></a>
		</div>
		<div class="covercontent">
			<div class="specmoviecover">
				<img src=<?=$image?> />
			</div>
			<a href="index.php?x=editCover&id=<?=$movieId?>">
				<img class="btn" id="floatright" title="Edit vinyl cover" src="/library/images/movie_editCoverBtn.png" />
			</a>
		</div>	
		<div class="specmoviesummary">
			Summary: <br>
			<div class="specmoviesumcontent">
				<?=$summary?>
			</div>	
		</div>
	
		<img class="btn" id="floatright" title="Delete movie from library" onclick="deleteCheck(<?=$movieId?>)" src="/library/images/movie_deleteBtn.png" />
		<a href="index.php?x=editMovie&id=<?=$movieId?>"><img class="btn" id="floatright" title="Edit movie information" src="/library/images/movie_editBtn.png" /></a>
	</div>
	<div class="similar">
		<h3>Similar movies</h3>
		<?php
		/*	$sql = "SELECT id, title, image, tag, genre FROM movies WHERE ((tag LIKE '%".$tag."%') 
					OR (genre LIKE '".$genre."')) AND (title NOT LIKE '".$title."') LIMIT 4";
			$s_result = $conn->query($sql);*/
			
			
			// loop that goes through every id except this one in movie_tags
			// Loop through all tags for one movie_id
			// Compare movie tags to this movie tags, get a number of similar/ or less different
			// Loop through array of similar movies
			// the less different tags/the more similar tags, the higher in an array said movie is placed
			// show the 4 highest movies
			
			//Get tags,id for all movie_id that is not this movie_id
			$movieId_intags = $conn->query("SELECT tag_name, movie_id FROM movie_tags WHERE movie_id NOT LIKE '".$movieId."'");
			
			// Create two arrays, one to hold all tags for one movie, one to show similar tags, later to be sorted
			$tagsformovie = array();
			$similarMovies = array();
			
			 // loop through for every movie ID
			foreach ($movieId_intags as $movieTags){
				echo 'Movie ID: ' . $movieTags['movie_id'] . ' ';
				// Loop through ID and gets tags
				foreach ($movieTags as $movieTag['tag_name']){
					//echo 'work';
					echo 'Movie tag: ' . $movieTag['tag_name'] . ' ,';
					//$tagsformovie [] = $movieTags['tag_name'];
					//echo $tagsformovie['tag_name'];
				}
			
				/*$num_diff_tag_array = array_diff($tag, $tagformovie['tag_name']);
				$findsimilarMovies = array($num_diff_tag_array, $tagmovieId);
				
				$similarMovies[] = $findsimilarMovies;*/
				
			}
			
			//$sortedSimilarMovies = array_multisort($similarMovies[0], SORT_NUMERIC, SORT_DESC);
			//echo $sortedSimilarMovies;
			/*foreach ($similarMovies as $similarMovie) {
				$movies = $conn->query("SELECT image, title FROM movies WHERE id='".$tagmovieId['movie_id']."'");
				while ($result = $movies->fetch_assoc()) {
					echo '
					<div class="movie">
					<div class="movie_image">
						<a class="title_link" title="'.$result['title'].'" rel="hovereffect" href="?x=infoMovie&id='.$similarMovie['movie_id'].'">
							<img src="'.$result['image'].'" />
						</a>
					</div>
					<div class="movie_title">
						<a class="title_link" title="'.$result['title'].'" rel="hovereffect" href="?x=infoMovie&id='.$similarMovie['movie_id'].'">
						<p>'.$result['title'].'</p>
						</a>
					</div>			
				</div>';
			}*/
		?>
	</div>
</div>

<?php
if($_GET['f'] == "delete"){
	$id = $_GET['id'];
	$conn->query("DELETE FROM movies WHERE id = '".$id."'");
	$conn->query("DELETE FROM movie_tags WHERE movie_id = '".$id."'");
	header("location: http://lisa.bendiksens.net/movie_library/index.php");
}
?>

