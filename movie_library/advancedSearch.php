<?php
	session_start();
	if($_SESSION['fhjd'] != "ja"){
		header('location: http://lisa.bendiksens.net');
	}
	include_once '../library/config.php';
?>

<div class="form">
	<h2>Advanced Search</h2>
	<?php
	?>
	<form action="index.php" method="GET">
		<input type="hidden" name="x" value="advancedSearchResult" />
		<table>
			<tr>
				<td>Title :</td>
				<td><input type="text" name="title"></td>
			</tr>
			<tr>
				<td>Release Year :</td>
				<td><input type="text" name="release_year"></td>
			</tr>
			<tr>
				<td>Genre :</td>
				<td><select class="dropdown" name="genre">
						<option value=""></option>
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
				<td><input type="number" name="length"></td>
				<td>in minutes</td>
			</tr>
			<tr>
				<td>Actors :</td>
				<td><input type="text" name="actors"></td>
			</tr>
			<tr>
				<td>Director(s) :</td>
				<td><input type="text" name="directors"></td>
			</tr>
			<tr>
				<td>Writer(s) :</td>
				<td><input type="text" name="writers"></td>
			</tr>
			<tr>
				<td>Tags :</td>
				<td><input type="text" name="tag"></td>
			</tr>
			<tr>
				<td>IMDB rating :</td>
				<td><input type="number" name="imdb_rating" step="0.1" min="1" max="10"></td>
				<td>/10</td>
			</tr>
		</table>
		<textarea name="summary" rows="7" cols="75" placeholder="Movie Summary" ></textarea>
		<input class="btn" id="searchbtn2" type="submit" title="Search movie library" value="">	
	</form>
</div>