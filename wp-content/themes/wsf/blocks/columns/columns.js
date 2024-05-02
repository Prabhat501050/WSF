export const Columns = (() => {
	'use strict';

	function init() {

		// For each type-accordion, initialize the accordion
		document.querySelectorAll('div.columns-type-accordion').forEach((accordion) => {
			initAccordion(accordion);
		});
		// Listen for screen resize, and redjust any heights of active accordion items
		window.addEventListener('resize', () => {
			document.querySelectorAll('.columns-type-accordion .accordion-item.active').forEach((item) => {
				const content = item.querySelector('div.accordion-content');
				if ( content ) content.style.height = content.scrollHeight + 'px';
			});
		});
	}

	function initAccordion( accordion ) {
		// Find all the accordion items
		const items = accordion.querySelectorAll('div.accordion-item');
		// For each item add a click event listener
		items.forEach((item) => {
			item.addEventListener('click', () => {
				// If the item is active, deactivate it
				if ( item.classList.contains('active') ) {
					closeAccordionItem( item );
				} else {
					// For each active item, deactivate it if it's not the clicked item
					const activeItems = accordion.querySelectorAll('div.accordion-item.active');
					activeItems.forEach((activeItem) => {
						if ( activeItem !== item && activeItem.classList.contains('active') ) {
							closeAccordionItem( activeItem );
						}
					});
					// Then activate the clicked item
					openAccordionItem( item );
				}
			});
		});
	}

	function openAccordionItem( item ) {
		// Set class to active
		item.classList.add('active');
		// Get the content and set the height
		const content = item.querySelector('div.accordion-content');
		if ( content ) content.style.height = content.scrollHeight + 'px';
		// Animate the Y position of the hint if it exists
		const hint = item.querySelector('h6.accordion-hint');
		if ( hint ) {
			hint.style.transform = 'translateY(-100%)';
		}

		
	}

	function closeAccordionItem( item ) {
		item.classList.remove('active');
		const content = item.querySelector('div.accordion-content');
		if ( content ) content.style.height = 0;
		// Show the accordion_hint_text if it exists, delayed 150ms to allow the height to animate
		const hint = item.querySelector('h6.accordion-hint');
		if ( hint ) {
			hint.style.transform = 'translateY(0%)';
		}
	}

	return {
		init: init,
	};
})();
