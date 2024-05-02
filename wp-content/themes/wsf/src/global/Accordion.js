import { Helpers } from './Helpers';

export const Accordion = (() => {
	'use strict';

	function init() {
		const accordionItems = document.querySelectorAll('[data-accordion-item]');

		accordionItems.forEach((item) => {
			item.querySelector('[data-trigger]').addEventListener('click', () => {
				item.classList.toggle('bg-white');
				Helpers.toggleCSSclasses(item.querySelector('[data-content]'), ['hidden']);
				Helpers.toggleCSSclasses(item.querySelector('#maximize'), ['rotate-90', 'opacity-0']);
				Helpers.toggleCSSclasses(item.querySelector('#minimize'), ['-rotate-90', 'opacity-0']);
				item.querySelector('[data-item-title]')?.classList.toggle('text-red');
			});
		});
	}

	return {
		init: init,
	};
})();
