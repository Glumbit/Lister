document.addEventListener('DOMContentLoaded', listLoaded);
window.addEventListener('resize', gamesDetailsOverflow);

function listLoaded() {
	gamesDetailsOverflow();
	document.addEventListener('scroll', toggleFilter);
}

function gamesDetailsOverflow() {
	const gamesItemsHtml = document.getElementsByClassName('games__item');
	const gamesItems = Array.from(gamesItemsHtml);
	for (const i in gamesItems) {
		if (Object.hasOwnProperty.call(gamesItems, i)) {
			const gamesItem = gamesItems[i];
			const gamesDetails = gamesItem.querySelector(".details");
			gamesItem.classList.remove("games__item--overflow");
			gamesDetails.classList.remove("details--left");
			if (gamesDetails.getBoundingClientRect().right + (gamesDetails.offsetWidth * 0.2) > window.innerWidth) {
				gamesItem.classList.add("games__item--overflow");
				gamesDetails.classList.add("details--left");
			}
		}
	}
}

var gamesPrevScrollpos = window.scrollY;
function toggleFilter() {
	var currentScrollPos = window.scrollY;
	console.log(gamesPrevScrollpos + "______" + currentScrollPos);
	if (gamesPrevScrollpos > currentScrollPos) {
		document.querySelector('.filter__mobile').classList.remove('filter__mobile_hidden');
		console.log("show");
	} else {
		document.querySelector('.filter__mobile').classList.add('filter__mobile_hidden');
	}
	gamesPrevScrollpos = currentScrollPos;
} 