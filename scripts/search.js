function searchButton() {
    var search = document.getElementById('search-text').value;
    if(search) {
	var exact = document.getElementById('exactCheck');
	if(exact == null)
	    open("search.php?search=" + encodeURIComponent(search));
	else {
	    var bexact = exact.checked;
	    if(bexact) {
		open("search.php?" + "search=" + encodeURIComponent(search) + "&exact=true");
		//open(encodeURIComponent("search2.php?search=" + search + "&exact=true"));
	    }
	    else {	    
		open("search.php?search=" + encodeURIComponent(search));
	    //window.location.replace('https://inb4sauce.net/markers.php');
	    }
	}
    }
}
