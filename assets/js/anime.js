document.addEventListener('DOMContentLoaded', animeDetailsOverflow);
window.addEventListener('resize', animeDetailsOverflow);

function animeDetailsOverflow() {
	const animeItemsHtml = document.getElementsByClassName('anime__item');
	const animeItems = Array.from(animeItemsHtml);
	for (const i in animeItems) {
		if (Object.hasOwnProperty.call(animeItems, i)) {
			const animeItem = animeItems[i];
			const animeDetails = animeItem.querySelector(".details")
			animeItem.classList.remove("anime__item--overflow");
			animeDetails.classList.remove("details--left");
			if (animeDetails.getBoundingClientRect().right + (animeDetails.offsetWidth * 0.2) > window.innerWidth) {
				animeItem.classList.add("anime__item--overflow");
				animeDetails.classList.add("details--left");
			}
		}
	}
}

document.addEventListener('DOMContentLoaded', () => {
	// console.log(document.querySelector('.filter__btn'));
	if (window.innerWidth < 992) {
		const filter = document.querySelector('.filter__btn');
		filter.addEventListener("click", filterShow);
	}
});


console.log(window.innerWidth);
function filterShow() {
	console.log("doawijd");
	document.querySelector('.filter').classList.add('filter--show');
}