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
$e_release_year = $movie->release_year;
$e_genre = $movie->genre;
//$e_image = $movie->image;
$e_directors = $movie->directors;
$e_writers = $movie->writers;
$e_actors = $movie->actors;
$e_tag = $movie->tag;
$e_movie_length = $movie->movie_length;
$e_imdb_rating = $movie->imdb_rating;
$e_imdb_link = $movie->imdb_link;
$e_summary = $movie->summary;

function convertToMins ($hours) {
	if(strstr($hours, ':')) {
		$separatedData = split(':', $hours);
		
		$minutesInHours = $separatedData[0] * 60;
		$minutes = $separatedData[1];
		
		$totalMinutes = $minutesInHours + $minutes;
	} else {
		$totalminutes = $hours * 60;
	}
	return $totalMinutes;
}

$e_length = convertToMins($e_movie_length);


?>
<div class="form">
	<h2>Edit movie</h2>
	<form action="doEditMovie.php" method="post" enctype="multipart/form-data">
		<table>
			<tr>
				<td>Title :</td>
				<td><input type="text" name="title" value="<? echo $e_title; ?>"></td>
			</tr>
			<tr>
				<td>Release Year :</td>
				<td><input type="text" name="release_year" value="<? echo $e_release_year; ?>"></td>
			</tr>
			<tr>
				<td>Genre :</td>
				<td><select class="dropdown" name="genre">
						<option value="<? echo $e_genre; ?>" selected><? echo $e_genre; ?></option>
						<option value="action">Action</option>
						<option value="adventure">Adventure</option>
						<option value="animation">Animation</option>
						<option value="biography">Biography</option>
						<option value="comedy">Comedy</option>
						<option value="crime">Crime</option>
						<option value="documentary">Documentary</option>
						<option value="drama">Drama</option>
						<option value="family">Family</option>
						<option value="fantasy">Fantasy</option>
						<option value="history">History</option>
						<option value="horror">Horror</option>
						<option value="music">Music</option>
						<option value="musical">Musical</option>
						<option value="romance">Romance</option>
						<option value="scifi">Sci-Fi</option>
						<option value="thriller">Thriller</option>
						<option value="war">War</option>
					</select>
				</td>
			</tr>
			<tr>
				<td>Movie length :</td>
				<td><input type="number" name="length" value="<? echo $e_length; ?>"></td>
				<td>in minutes</td>
			</tr>
			<tr>
				<td>Actors :</td>
				<td><input type="text" name="actors" value="<? echo $e_actors; ?>"></td>
			</tr>
			<tr>
				<td>Director(s) :</td>
				<td><input type="text" name="directors" value="<? echo $e_directors; ?>"></td>
			</tr>
			<tr>
				<td>Writer(s) :</td>
				<td><input type="text" name="writers" value="<? echo $e_writers; ?>"></td>
			</tr>
			<tr>
				<td>Tags :</td>
				<td><input type="text" name="tag" value="<? echo $e_tag; ?>"></td>
			</tr>
			<tr>
				<td>IMDB url :</td>
				<td><input type="text" name="imdb_link" value="<? echo $e_imdb_link; ?>"></td>
			</tr>
			<tr>
				<td>IMDB rating :</td>
				<td><input type="number" name="imdb_rating" step="0.1" min="1" max="10" value="<? echo $e_imdb_rating; ?>"></td>
				<td>/10</td>
			</tr>
			<!--<tr>
				<td>Movie Cover :</td>
				<td><input type="file" name="fileToUpload" id="fileToUpload"></td>
			</tr>-->
		</table>
		<textarea name="summary" rows="7" cols="75"><? echo $e_summary; ?></textarea>
		<input type='hidden' name='id' value="<?echo $movieId;?>">
		<input title="Update movie" class="btn" id="updatebtn" type="submit" value="">	
	</form>
</div>

