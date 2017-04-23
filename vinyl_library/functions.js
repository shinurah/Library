function deleteCheck(id) {
	var answer = confirm("Are you sure you want to delete vinyl from library?");
	if(answer == true) {
		location.href = "index.php?x=infoVinyl&id="+ id + "&f=delete";
	} else {
	}
}

function deleteTrack(id, trackid) {
	var answer = confirm("Are you sure you want to delete track from tracklist?");
	if(answer == true) {
		location.href = "index.php?x=infoVinyl&id="+ id +"&trackid="+ trackid +"&t=delete";
	} else {
	}
}
