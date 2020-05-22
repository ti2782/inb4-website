function searchButton() {
    var search = document.getElementById('search-text').value;
    if(search) {
	//window.location.href = "https://inb4sauce.net/search.php?search=" + encodeURIComponent(search);
	window.open("search.php?search=" + encodeURIComponent(search));
    }
}
