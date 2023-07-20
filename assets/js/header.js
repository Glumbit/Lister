document.addEventListener("DOMContentLoaded", DomLoaded);
function DomLoaded() {
	searchListener()
}

function searchListener() {
	const searchFieldStat = document.querySelector('.search__field');
	searchFieldStat.addEventListener('input', searchFind)
}
function searchFind(event) {
	let resultsCounter = 0;
	let needed = event.target.value
	const searchResults = document.querySelector('.search__results');
	searchResults.innerHTML = "";
	Array.from(searchData.anime).forEach(test => {
		if (resultsCounter == 5) return;
		if (test.post_title.toLowerCase().includes(needed.toLowerCase()) && needed.length >= 2) {
			resultsCounter += 1
			let itemSearch = document.createElement("div");
			itemSearch.innerHTML = `<div class="search__item"><div class="search__img"><a href="${test.post_link}"><img src="${test.post_image}" alt=""></a></div><div class="search__data"><a href="${test.post_link}" class="search__title_line-left title_line-left">${test.post_title}</a><p>${test.post_category}</p><p>${test.post_type}</p><p>${test.post_part}</p><p>Вышел: ${test.post_dateCreate}</p></div></div >`
			searchResults.append(itemSearch)
		}
	});
	Array.from(searchData.games).forEach(test => {
		if (resultsCounter == 5) {
			return
		}
		if (test.post_title.toLowerCase().includes(needed.toLowerCase()) && needed.length >= 2) {
			resultsCounter += 1
			let itemSearch = document.createElement("div");
			itemSearch.innerHTML = `<div class="search__item"><div class="search__img"><a href="${test.post_link}"><img src="${test.post_image}" alt=""></a></div><div class="search__data"><a href="${test.post_link}" class="search__title_line-left title_line-left">${test.post_title}</a><p>${test.post_type}</p><p>${test.post_part}</p><p>Вышел: ${test.post_dateCreate}</p></div></div >`
			searchResults.append(itemSearch)
		}
	});
	if (resultsCounter > 0) {
		searchResults.classList.remove("search__results_disabled")
	}
	else {
		searchResults.classList.add("search__results_disabled")
	}
}