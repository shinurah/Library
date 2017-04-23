<?php
	include_once '../library/config.php';
	session_start();
	if($_SESSION['fhjd'] != "ja"){
	header('location: http://lisa.bendiksens.net');
	}
?>

<?php
if($_GET['wish'] == 'inwish') {
	echo 'You have already wished for this title.';
}
elseif($_GET['wish'] == 'inlibrary') {
	echo 'Title already exist in the movie library.';
}
elseif($_GET['wish'] == 'success') {
	echo 'Title was successfully added to wishlist';
}
elseif($_GET['f'] == 'delete') {
	echo 'Title was succesfully deleted';
}
else {
	
}
?>


<div id="wishform">
	<form action="doAddWish.php" method="post">
		<table>
			<tr>				
				<td>New Wish:<input required type="text" name="title"></td>
				<td><input class="btn" id="addbtn" type="submit" title="Add title to wishlist" value=""></td>		
			</tr>
		</table>
	</form>
</div>
<h2>Wishlist</h2>
<p>Show :
	<select id="sortwish" name="sortwish" onchange="OnSelectedWishChange()">	
			<?php
			$sort = $_GET['sortwish'];
			if($sort == "all") {
				echo '<option selected value="all">All Wishes</option>';			
			} else {
				echo '<option value="all">All Wishes</option>';
			}
			
			if($sort == "cely") {
				echo '<option selected value="cely">Celyradas Wishes</option>';
			} else {
				echo '<option value="cely">Celyradas Wishes</option>';
			}
			
			if($sort == "unk1nd") {
				echo '<option selected value="unk1nd">Unk1nds Wishes</option>';
			} else {
				echo '<option value="unk1nd">Unk1nds Wishes</option>';
			}
			?>
	</select>
</p>
<div id="content">
	<?php
		if($sort == "all" || $sort == "") {
			$sql = "SELECT * FROM wishlist ORDER BY date_created DESC";
		}
		if($sort == "cely"){
			$sql = "SELECT * FROM wishlist WHERE username='Celyrada' ORDER BY date_created DESC";	
		}
		if($sort == "unk1nd"){	
			$sql = "SELECT * FROM wishlist WHERE username='unk1nd' ORDER BY date_created DESC";
		}
		
		$result = $conn->query($sql);
		
		echo '<table class="wishtable">';
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				echo '
				<tr>
					<td id="wishtitle">'.$row['wishtitle'].'</td> 
					<td id="wishtitle"><div id="wishedby">wished by</div> '.$row['username'].'</td>
					<td id="tdbtn">
						<a href="index.php?x=addMovie&id='.$row['id'].'">
							<img title="Add title to library" class="btn" src="/library/images/movie_addBtn.png" />
						</a>
					</td>
					<td id="tdbtn">
						<img class="btn" title="Delete from wishlist" onclick="deleteWish('.$row['id'].')" src="/library/images/movie_deleteBtn.png" />
					</td>
				</tr>';
			}
		}
		else {
			echo "0 results";
		}
		echo '</table>';
	?>
</div>
<?php
if($_GET['f'] == "delete"){
	$id = $_GET['id'];
	$conn->query("DELETE FROM wishlist WHERE id = '".$id."'");
	header("location: http://lisa.bendiksens.net/movie_library/index.php?x=wishlist");
}
?>
