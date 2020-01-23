function searchButton() {
    var search = document.getElementById('search-text').value;
    if(search) {
	window.open('https://archive.4plebs.org/_/search/text/' + search + '/image/T98E_D9VKmMFt6zS_rAqiw/results/thread/', '_blank');
    }
}
