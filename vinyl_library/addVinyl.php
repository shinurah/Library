<?php
	include_once '../library/config.php';
	session_start();
	if($_SESSION['fhjd'] != "ja"){
	header('location: http://lisa.bendiksens.net');
	}
?>

<div class="form">
	<h2>Add new Vinyl</h2>
	<?php
		if($_GET['vinyl'] == 'exists') {
			echo 'That vinyl is already in the library!';
		}
		else {
			
		}
	?>
	<form action="doAddVinyl.php" method="post" enctype="multipart/form-data">
		<table>
			<tr>
				<td>Artist: </td>
				<td><input required type="text" name="artist"></td>
			</tr>
			<tr>
				<td>Title: </td>
				<td><input required type="text" name="title"></td>
			</tr>
			<tr>
				<td>Release year: </td>
				<td><input required type="text" name="release_year"></td>
			</tr>
			<tr>
				<td>Genre: </td>
				<td><select required class="dropdown" id="dropdownwidth" name="genre">
						<option value=""></option>
						<option value="Blues">Blues</option>
						<option value="Country">Country</option>
						<option value="Electronic">Electronic</option>
						<option value="Hip Hop">Hip Hop</option>
						<option value="Jazz">Jazz</option>
						<option value="Pop">Pop</option>
						<option value="Rock">Rock</option>

						<option value="EDM">EDM</option>
					</select>
				</td>
			</tr>
			<tr>
				<td>Label: </td>
				<td><input required type="text" name="label"></td>
			</tr>
			<tr>
				<td>Producer: </td>
				<td><input required type="text" name="producer"></td>
			</tr>
			<tr>
				<td>Vinyl Cover: </td>
				<td><input type="file" name="fileToUpload" id="fileToUpload"></td>
			</tr>
		</table>
		<input title="Add vinyl to library" class="btn" id="nextbtn" type="submit" value="">
	</form>
</div>
