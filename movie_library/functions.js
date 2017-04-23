function OnSelectedIndexChange() {
	if(document.getElementById('listCheck').checked == false) {
		if(document.getElementById('sortby').value == 'recent') {
			location.href = "?sortby=recent";
		}
		if(document.getElementById('sortby').value == 'alphabetically') {
			location.href = "?sortby=alphabetically";
		}
		if(document.getElementById('sortby').value == 'release') {
			location.href = "?sortby=release";
		}
		if(document.getElementById('sortby').value == 'toprated') {
			location.href = "?sortby=toprated";
		}
		
	}
	if(document.getElementById('listCheck').checked) {
		if(document.getElementById('sortby').value == 'recent') {
			location.href = "?sortby=recent&list=true";
		}
		if(document.getElementById('sortby').value == 'alphabetically') {
			location.href = "?sortby=alphabetically&list=true";
		}
		if(document.getElementById('sortby').value == 'release') {
			location.href = "?sortby=release&list=true";
		}
		if(document.getElementById('sortby').value == 'toprated') {
			location.href = "?sortby=toprated&list=true";
		}
	}
}

function OnSelectedWishChange(){		
	if(document.getElementById('sortwish').value == 'all') {
		location.href = "?x=wishlist&sortwish=all"; 
	}
	if(document.getElementById('sortwish').value == 'cely') {
		location.href = "?x=wishlist&sortwish=cely"; 
	}
	if(document.getElementById('sortwish').value == 'unk1nd') {
		location.href = "?x=wishlist&sortwish=unk1nd"; 
	}
}

function unCheck() {
    document.getElementById("listCheck").checked = false;
    OnSelectedIndexChange();
}

function deleteCheck(id) {
	var answer = confirm("Are you sure you want to delete movie from library?");
	if(answer == true) {
		location.href = "index.php?x=infoMovie&id="+ id + "&f=delete";
	} else {
	}
}

function deleteWish(id) {
	var answer = confirm("Are you sure you want to delete wish from wishlist?");
	if(answer == true) {
		location.href = "index.php?x=wishlist&id="+ id +"&f=delete";
	} else {
	}
}
