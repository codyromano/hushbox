(function () {
	var callToAction = document.querySelector('.call-to-action-large'),
	intro = document.querySelector('#intro');

	callToAction.addEventListener('click', function () {
		intro.classList.add('slide-left'); 
		callToAction.classList.add('fade-out'); 
	});

})();
