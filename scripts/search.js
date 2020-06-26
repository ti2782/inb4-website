function searchButton() {
    var search = document.getElementById('search-text').value;
    if(search) {
	open("search.php?search=" + encodeURIComponent(search));
	//window.location.replace('https://inb4sauce.net/markers.php');
    }
}
