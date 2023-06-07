$(document).ready(() => {
	$('.anime__item').each(function () {
		//Переменные
		let details = $(this).find('.details');
		//Функции
		function detailsStart() {
			$(details).css({ transform: 'translateX(-103%)' });
		};
		function detailsEnd() {
			$(details).css({ transform: 'translateX(-80%)' });
		}
		//Код

		if ($(details)[0].getBoundingClientRect().left + 350 /*ширина details*/ + 10 /*промежуток между details и preview */ > $('body')[0].getBoundingClientRect().width) {
			$(details).css({ left: '0', right: 'auto', transform: 'translateX(-80%)' });
			$(this).hover(detailsStart, detailsEnd);
		}
	});
	$('#filter__submit').click(function () {
		var checkboxArr = [];
		checkboxArr.length = 0;
		$('.form-check-input:checked').each(function () {
			checkboxArr.push($(this).prev().text().replace(': ', ''));
		});
		$('.anime__item').each(function () {
			let isFiltered = false;
			$(this).css('display', 'block');
			if (checkboxArr.length != 0) {
				checkboxArr.forEach(checkboxItem => {
					if ($(this).find('.genres').text().includes(checkboxItem)) {
						isFiltered = true
					}
				});
				if (!isFiltered) {
					$(this).css('display', 'none');
				}
			}
		})
	});
	if ($('body')[0].getBoundingClientRect().width <= 992) {
		$('#anime__filter').slideUp(0);
	}

	$('.btn-filter').click(function () {
		$('#anime__filter').slideToggle(2000);
	})
	$('#filter__submit').click(function () {
		if ($('body')[0].getBoundingClientRect().width <= 992) {
			$('#anime__filter').slideToggle(2000);
		}
	})

})