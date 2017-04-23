<?php
	include_once '../library/config.php';
	session_start();
	if($_SESSION['fhjd'] != "ja"){
		header('location: http://lisa.bendiksens.net');
	}
?>
<?php
	$sql = "SELECT COUNT(*) FROM vinyls";
	$vinylCount = mysqli_query($conn, $sql);
	$vinylCountRow = mysqli_fetch_row($vinylCount);
	$vinylTotal = $vinylCountRow[0];
?>
<div class="main_header">
	<p>Total vinyls in library: <?=$vinylTotal?></p> <br><br>
	<p>Sort vinyls by: </p>
</div>
<div class = "row">
	<div id = "cover">
		<?php
			$vinyls = $conn->query("SELECT id, image, title, artist, date_created FROM vinyls ORDER BY date_created DESC");
			
			if ($vinyls->num_rows > 0) {
				while($row = $vinyls->fetch_assoc()) {
					echo '
					<div class="vinyl">
						<a class="title_link" title="'.$row['artist'].'" href="?x=infoVinyl&id='.$row['id'].'">
							<p>'.$row['artist'].'</p>
						</a>
						<div class="vinyl_image">
							<a class="title_link" title="'.$row['title'].'" href="?x=infoVinyl&id='.$row['id'].'">
								<img src="'.$row['image'].'" />
							</a>
						</div>
						<a class="title_link" title="'.$row['title'].'" href="?x=infoVinyl&id='.$row['id'].'">
							<p>'.$row['title'].'</p>
						</a>
					</div>';
				}
			}
			else {
				echo "0 results";
			}
		?>
	</div>
</div>
