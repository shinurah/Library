<?php
	include_once '../library/config.php';
	session_start();
	if($_SESSION['fhjd'] != "ja"){
		header('location: http://lisa.bendiksens.net');
	}
?>

<?php
 $search = $_GET['search'];
 $min_length = 3;
 
 echo '<h2>You searched for: ' .$search.'</h2>';
 
 if(strlen($search)>= $min_length){
 	$search = htmlspecialchars($search);
	//$search = mysqli_real_escape_string($search);
	
	$sql ="SELECT * FROM movies WHERE (title LIKE '%".$search."%') 
		OR (genre LIKE '%".$search."%')
		OR (actors LIKE '%".$search."%') 
		OR (directors LIKE '%".$search."%') 
		OR (writers LIKE '%".$search."%')
		OR (tag LIKE '%".$search."%') 
		OR (summary LIKE '%".$search."%')" ;

	$raw_result =  $conn->query($sql);
	
	echo $raw_result->num_rows. ' hits'.'<br/>'; 
	
	//Levenshtein
	/*$shortest = -1;
	//$result = $raw_result->fetch_assoc();
	foreach($raw_result as $result){
		$lev = levenshtein($search, $result);
		if($lev == 0) {
			$closest = $result;
			$shortest = 0;
			break;
		}
		if($lev <= $shortest || $shortest < 0) {
			$closest = $result;
			$shortest = $lev;
		}
	}
	//$closest = $raw_result->fetch_assoc();
	if ($shortest == 0) {
    echo "Exact match found: " .$closest. "";
	} else {
    echo "Did you mean: " .$closest. "?";
	}*/
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
 }
 else {
 	echo "Minimum length is " .$min_length;
 }
?>
	</div>
</div>