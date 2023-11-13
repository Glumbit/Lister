document.addEventListener('DOMContentLoaded', listLoaded);
window.addEventListener('resize', animeDetailsOverflow);

function listLoaded() {
	animeDetailsOverflow();
	document.addEventListener('scroll', toggleFilter);
}

function animeDetailsOverflow() {
	const animeItemsHtml = document.getElementsByClassName('anime__item');
	const animeItems = Array.from(animeItemsHtml);
	for (const i in animeItems) {
		if (Object.hasOwnProperty.call(animeItems, i)) {
			const animeItem = animeItems[i];
			const animeDetails = animeItem.querySelector(".details");
			animeItem.classList.remove("anime__item--overflow");
			animeDetails.classList.remove("details--left");
			if (animeDetails.getBoundingClientRect().right + (animeDetails.offsetWidth * 0.2) > window.innerWidth) {
				animeItem.classList.add("anime__item--overflow");
				animeDetails.classList.add("details--left");
			}
		}
	}
}

var animePrevScrollpos = window.scrollY;
function toggleFilter() {
	var currentScrollPos = window.scrollY;
	if (animePrevScrollpos > currentScrollPos) {
		document.querySelector('.filter__mobile').classList.remove('filter__mobile_hidden');
	} else {
		document.querySelector('.filter__mobile').classList.add('filter__mobile_hidden');
	}
	animePrevScrollpos = currentScrollPos;
} 