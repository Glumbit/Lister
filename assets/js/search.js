document.addEventListener('DOMContentLoaded', animeDetailsOverflow);
window.addEventListener('resize', animeDetailsOverflow);

function animeDetailsOverflow() {
	const animeItemsHtml = document.getElementsByClassName('search-results__item');
	const animeItems = Array.from(animeItemsHtml);
	for (const i in animeItems) {
		if (Object.hasOwnProperty.call(animeItems, i)) {
			const animeItem = animeItems[i];
			const animeDetails = animeItem.querySelector(".details")
			animeItem.classList.remove("search-results__item--overflow");
			animeDetails.classList.remove("details--left");
			if (animeDetails.getBoundingClientRect().right + (animeDetails.offsetWidth * 0.2) > window.innerWidth) {
				animeItem.classList.add("search-results__item--overflow");
				animeDetails.classList.add("details--left");
			}
		}
	}
}