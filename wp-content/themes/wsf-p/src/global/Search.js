import { Helpers } from './Helpers';

export const Search = (function () {
	'use strict';

	const searchTrigger = document.getElementById('header-nav-search-trigger');
	const searchBox = document.getElementById('header-nav-search');
	const mainNav = document.getElementById('header-main-nav');
	const alertBar = document.getElementById('wsf-alert-bar');
	const searchBoxToggleClasses = ['!opacity-100', '!pointer-events-auto', '!translate-y-0', 'hidden'];

	function init() {
		searchTrigger.addEventListener('click', () => {
			Helpers.toggleCSSclasses(searchBox, searchBoxToggleClasses);

			if (!searchBox.classList.contains('hidden')) {
				const searchOpenEvent = new CustomEvent('searchOpen');

				window.dispatchEvent(searchOpenEvent);

				searchBox.querySelector('input').focus();
			}

			!searchBox.classList.contains('hidden')
				? mainNav.classList.add('lg:rounded-b-none')
				: mainNav.classList.remove('lg:rounded-b-none');
			document.getElementById('anchor-bar')?.classList.toggle('hidden');
			alertBar?.classList.toggle('hidden');
		});

		window.addEventListener('click', (e) => {
			if (
				!searchBox.classList.contains('hidden') &&
				!searchBox.contains(e.target) &&
				!searchTrigger.contains(e.target)
			) {
				const searchCloseEvent = new CustomEvent('searchClose');

				window.dispatchEvent(searchCloseEvent);

				Helpers.toggleCSSclasses(searchBox, searchBoxToggleClasses);
				mainNav.classList.remove('lg:rounded-b-none');
				document.getElementById('anchor-bar')?.classList.remove('hidden');
				alertBar?.classList.remove('hidden');
			}
		});

		window.addEventListener('keyup', (e) => {
			if (e.key === 'Escape' && !searchBox.classList.contains('hidden')) {
				const searchCloseEvent = new CustomEvent('searchClose');

				window.dispatchEvent(searchCloseEvent);

				Helpers.toggleCSSclasses(searchBox, searchBoxToggleClasses);
				mainNav.classList.remove('lg:rounded-b-none');
				document.getElementById('anchor-bar')?.classList.remove('hidden');
				alertBar?.classList.remove('hidden');
			}
		});
	}

	return {
		init: init,
	};
})();
