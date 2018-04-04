$(document).ready(function() {
	window.setInterval("refreshImages()", 5000);
});

function refreshImages() {
	$('img').each(function () {
		this.onerror = () => { this.src = 'offline.png'; }
		$(this).attr('src', 'http://' + $(this).attr('alt') + ':8080?'+ Math.ceil((Math.random() * 1000)));
	});
}

function checkImage(img) {
	var testImg = new Image();
	testImg.onload = () => { img.src = 'http://' + img.alt + ':8080?' + Math.ceil(Math.random() * 1000); }
	testImg.onerror = () => { img.src = 'http://kcisd-tech/screens/offline.png'; }
	testImg.src = 'http://' + img.alt + ':8080';
}