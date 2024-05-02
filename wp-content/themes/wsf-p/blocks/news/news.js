export const News = (() => {
	'use strict';

	function init() {
		const allCategoriesButton = document.querySelector('[data-all-categories]');
		const categoriesButtons = document.querySelectorAll('[data-category]');

		if (!allCategoriesButton) return;

		allCategoriesButton.addEventListener('click', () => {
			window.location = baseUrl;
		});

		categoriesButtons.forEach(button => {
			button.addEventListener('click', () => {
				window.location = `${baseUrl}?category=${button.dataset.category}`;
			});
		});
	}

	return {
		init: init,
	};
})();
