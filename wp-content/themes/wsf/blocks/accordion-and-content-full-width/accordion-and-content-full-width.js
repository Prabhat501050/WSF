export const AccordionAndContentFullWidth = (() => {
	'use strict';
	function init() {

	}

	document.addEventListener('DOMContentLoaded', () => {
		const accordionButtons = document.querySelectorAll('.accordion-button');

		function closeAllAccordions() {
			accordionButtons.forEach((button) => {
				const accordionItem = button.closest('.accordion-item');
				if (accordionItem) {
					const accordionBody = accordionItem.querySelector('.accordion-collapse');
					if (accordionBody) {
						accordionBody.classList.add('hidden');
						button.classList.add('collapsed');
					}
				}
			});
		}

		accordionButtons.forEach((button) => {
			button.addEventListener('click', () => {
				const accordionItem = button.closest('.accordion-item');
				if (accordionItem) {
					const accordionBody = accordionItem.querySelector('.accordion-collapse');
					if (accordionBody) {
						if (accordionBody.classList.contains('hidden')) {
							closeAllAccordions();
							accordionBody.classList.remove('hidden');
							button.classList.remove('collapsed');
						} else {
							accordionBody.classList.add('hidden');
							button.classList.add('collapsed');
						}
					}
				}
			});
		});
	});



	// open accordian on click --- for mobile version map


	// Function to toggle the accordion
	function toggleAccordion(accordionId) {
		var accordionItem = document.getElementById(accordionId);
		if (accordionItem) {
			var accordionButton = accordionItem.querySelector('.accordion-button');
			var accordionCollapse = accordionItem.querySelector('.accordion-collapse');
			if (accordionButton && accordionCollapse) {
				accordionButton.classList.toggle('collapsed');
				accordionCollapse.classList.toggle('hidden');
			}
		}
	}

	// Event listener for hash change
	window.addEventListener('hashchange', function () {
		var hash = window.location.hash.substring(1);
		var validIds = ['Alabamacontent', 'ARKANSAScontent', 'GEORGIAcontent', 'LOUISIANAcontent', 'MISSISSIPPIcontent', 'NORTHCAROLINAcontent', 'TEXAScontent'];
		if (validIds.includes(hash)) {
			toggleAccordion(hash);
		}
	});

	// Event listener for page load
	document.addEventListener('DOMContentLoaded', function () {
		var hash = window.location.hash.substring(1);
		if (hash && document.getElementById(hash)) {
			toggleAccordion(hash);
		}
	});

	// Event listener for popstate
	window.addEventListener('popstate', function (event) {
		var validIds = ['Alabamacontent', 'ARKANSAScontent', 'GEORGIAcontent', 'LOUISIANAcontent', 'MISSISSIPPIcontent', 'NORTHCAROLINAcontent', 'TEXAScontent'];
		validIds.forEach(function (id) {
			var accordionItem = document.getElementById(id);
			if (accordionItem) {
				var accordionButton = accordionItem.querySelector('.accordion-button');
				var accordionCollapse = accordionItem.querySelector('.accordion-collapse');
				if (accordionButton && accordionCollapse && !accordionCollapse.classList.contains('hidden')) {
					toggleAccordion(id);

				}
			}
		});
		window.setTimeout(offsetAnchor, 1);
		function offsetAnchor() {
			if (location.hash.length !== 0) {
				window.scrollTo(window.scrollX, window.scrollY - 215);
			}
		}
	});


	return {
		init: init,
	};

})();





