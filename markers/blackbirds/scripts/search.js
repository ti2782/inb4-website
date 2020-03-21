function searchButton() {
    var search = document.getElementById('search-text').value;
    if(search) {
	window.open('https://archive.4plebs.org/_/search/text/' + search + '/image/h8CGn88rRoGgmAVOW0TxMg/results/thread/', '_blank');
    }
    else {
	window.open('https://archive.4plebs.org/_/search/image/h8CGn88rRoGgmAVOW0TxMg/results/thread/', '_blank');
    }
}
