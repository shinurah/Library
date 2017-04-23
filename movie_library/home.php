<?php
  //  error_reporting( E_ALL );
?>
<?php
	include_once '../library/config.php';
	session_start();
	if($_SESSION['fhjd'] != "ja"){
		header('location: http://lisa.bendiksens.net');
	}
?>
<?php
	$sql = "SELECT COUNT(*) FROM movies";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_row($result);
	$total = $row[0];

?>
<div class="main_header">
	<p>Total movies in library: <?=$total?></p> <br><br>
	<p>Sort movies by:
		<select id="sortby" name="sortby" onchange="OnSelectedIndexChange()">	
			<?php
			$sort = $_GET['sortby'];
			if($sort == "recent") {
				echo '<option selected value="recent">Recently Added</option>';			
			} else {
				echo '<option value="recent">Recently Added</option>';
			}
			
			if($sort == "alphabetically") {
				echo '<option selected value="alphabetically">A - Z</option>';
			} else {
				echo '<option value="alphabetically">A - Z</option>';
			}
			
			if($sort == "release") {
				echo '<option selected value="release">Release Date</option>';
			} else {
				echo '<option value="release">Release Date</option>';
			}
			if($sort == "toprated"){
				echo '<option selected value="toprated">Top Rated</option>';
			} else {
				echo '<option value="toprated">Top Rated</option>';
			}
			?>
		</select>
	</p>
	<?php
	if($_GET['list'] == ''){
		echo 'Show as list of titles? <input id="listCheck" type="radio" onchange="OnSelectedIndexChange()" />';
	}
	else {
		echo 'Show as Cover + title? <input id="listCheck" type="radio" checked onclick="unCheck()" />';
	}
	
	echo '<h2>Movies sorted by: ' .$sort. '</h2>';
	?>
	
</div>
<div class="row">
	<div id ="cover">
		<?php
		if($sort == "recent" || $sort == "") {
			$sql = "SELECT id, image, title, date_created FROM movies ORDER BY date_created DESC";
		}
		if($sort == "alphabetically"){
			$sql = "SELECT id, image, title FROM movies ORDER BY title";	
		}
		if($sort == "release"){	
			$sql = "SELECT id, image, title, release_year FROM movies ORDER BY release_year DESC";
		}
		if($sort == "toprated"){
			$sql = "SELECT id, image, title, imdb_rating FROM movies ORDER BY imdb_rating DESC";
		}
			
		$result = $conn->query($sql);
			
		if ($_GET['list'] == '') 
		{
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
		}
		else {
			if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
					echo '
					<div class="title_list">
						<a class="title_link" href="?x=infoMovie&id='.$row['id'].'"><p>'.$row['title'].'</p></a>
					</div>';
				}
			}
		}
		echo $_GET["imdb"];
		?>
	</div>	
</div>

		