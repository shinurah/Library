<?php
	include_once '../library/config.php';
	session_start();
	if($_SESSION['fhjd'] != "ja"){
	header('location: http://lisa.bendiksens.net');
	}
?>

<?php
$wishId = $_GET['id'];

$result = $conn->query("SELECT wishtitle FROM wishlist WHERE id='".$wishId."'");
$wish = $result->fetch_object();
$wishtitle = $wish->wishtitle;
?>
<div class="form">
	<h2>Add New Movie</h2>
	<?php
		if($_GET['movie'] == 'exists') {
			echo 'That movie is already in the library!';
		}
		else {
			
		}
	?>
	<form action="doAddMovie.php" method="post" enctype="multipart/form-data">
		<table>
			<tr>
				<td>Title: </td>
				<td>
				<?php
					if($wishId == '') {
						echo '<input required type="text" name="title">';
					} else {
						echo '<input required type="text" name="title" value="'.$wishtitle.'">';
					}
				?>
				
				</td>
			</tr>
			<tr>
				<td>Release Year: </td>
				<td><input required type="text" name="release_year"></td>
			</tr>
			<tr>
				<td>Genre: </td>
				<td><select required class="dropdown" id="dropdownwidth" name="genre">
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
				<td>Movie length: </td>
				<td><input required type="number" name="length"></td>
				<td>in minutes</td>
			</tr>
			<tr>
				<td>Actors: </td>
				<td><input type="text" name="actors"></td>
			</tr>
			<tr>
				<td>Director(s): </td>
				<td><input type="text" name="directors"></td>
			</tr>
			<tr>
				<td>Writer(s): </td>
				<td><input type="text" name="writers"></td>
			</tr>
			<tr>
				<td>Tags: </td>
				<td><input type="text" name="tag"></td>
			</tr>
			<tr>
				<td>IMDB url: </td>
				<td><input type="text" name="imdb_link"></td>
			</tr>
			<tr>
				<td>IMDB rating: </td>
				<td><input type="number" name="imdb_rating" step="0.1" min="1" max="10"></td>
				<td>/10</td>
			</tr>
			<tr>
				<td>Movie Cover: </td>
				<td><input type="file" name="fileToUpload" id="fileToUpload"></td>
			</tr>
			<tr>
				<td>TV Series?</td>
				<td><input type="checkbox"></td>
			</tr>
			<tr>
				<td>Seasons: </td>
				<td><input type="number" step="1" min="1"></td>
			</tr>
		</table>
		<textarea name="summary" rows="7" cols="75" placeholder="Movie Summary" ></textarea>
		<input title="Add movie to library" class="btn" id="addbtn" type="submit" value="">	
	</form>
</div>


<div class="recent">
	<h3>5 Most recently added movies</h3>
		<?php
			$sql = "SELECT id, image, title, date_created FROM movies ORDER BY date_created DESC LIMIT 5";
			$result = $conn->query($sql);
			
			if ($result->num_rows > 0) {
					while($row = $result->fetch_assoc()) {
						echo '
						<div class="movie">
							<div class="movie_image">
								<a class="title_link" title="'.$row['title'].'" href="?x=infoMovie&id='.$row['id'].'"><img src="'.$row['image'].'" /></a>
							</div>
							<div class="movie_title">
								<a class="title_link" title="'.$row['title'].'" href="?x=infoMovie&id='.$row['id'].'"><p>'.$row['title'].'</p></a>
							</div>
						</div>';
					}
				}
				else {
					echo "0 results";
				}
		?>
</div>

		
