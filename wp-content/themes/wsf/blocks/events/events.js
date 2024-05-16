export const Events = (() => {
	'use strict';

	let filters = {
		month: null,
		state: null,
		eventType: null,
		schoolType: null,
		eventSearch: null,
	};

	// This only fires once per page that has the events block, no matter how many times it's used
	function init() {
		// Get all the events blocks on the page
		const eventsBlocks = document.querySelectorAll('.pxblock--events');

		// For each block, display the filters and add listeners
		eventsBlocks.forEach((block) => {
			// Get the filters container
			const filtersContainer = block.querySelector('.filters');
			// Unhide the filters being we have JS
			filtersContainer.classList.remove('hidden');
			// Remove the aria-hidden attribute
			filtersContainer.removeAttribute('aria-hidden');

			// Get the filter selects
			const filterSelects = filtersContainer.querySelectorAll('select.filter-select');
			// For each select, add a change listener
			filterSelects.forEach((select) => {
				select.addEventListener('change', (event) => {
					// Get the label slug of the select
					const slug = event.target.dataset.slug;
					// Get the value of the select
					const value = event.target.value;
					// Filter the events
					filterEvents(slug, value, block);
				});
			});
		});

		// Load the current filters from the URL query string
		loadFilters();
	}

	function loadFilters() {
		// Get the URL query string
		const urlParams = new URLSearchParams(window.location.search);
		// Get the month filter if it exists
		filters.month = urlParams.get('month');
		// Get the state filter if it exists
		filters.state = urlParams.get('state');
		// Get the event type filter if it exists
		filters.eventType = urlParams.get('event-type');
		// Get the school type filter if it exists
		filters.schoolType = urlParams.get('school-type');
		// Get the event search filter if it exists, just so we can pass it along
		filters.eventSearch = urlParams.get('event-search');

		// Set the select values to the current filters
		const monthSelect = document.querySelector('.filter-select[data-slug="month"]');
		const stateSelect = document.querySelector('.filter-select[data-slug="state"]');
		const eventTypeSelect = document.querySelector('.filter-select[data-slug="event-type"]');
		const schoolTypeSelect = document.querySelector('.filter-select[data-slug="school-type"]');
		if (filters.month) {
			// Check if the value exists in the select
			const monthOption = monthSelect.querySelector(`option[value="${filters.month}"]`);
			if (monthOption) {
				// If the value exists in the select, set it to that value
				monthSelect.value = filters.month;
			} else {
				// If the value doesn't exist in the select, set it to all
				monthSelect.value = 'all';
			}
		}
		if (filters.state) {
			// Check if the value exists in the select
			const stateOption = stateSelect.querySelector(`option[value="${filters.state}"]`);
			if (stateOption) {
				// If the value exists in the select, set it to that value
				stateSelect.value = filters.state;
			} else {
				// If the value doesn't exist in the select, set it to all
				stateSelect.value = 'all';
			}
		}
		if (filters.eventType) {
			// Check if the value exists in the select
			const eventTypeOption = eventTypeSelect.querySelector(`option[value="${filters.eventType}"]`);
			if (eventTypeOption) {
				// If the value exists in the select, set it to that value
				eventTypeSelect.value = filters.eventType;
			} else {
				// If the value doesn't exist in the select, set it to all
				eventTypeSelect.value = 'all';
			}
		}
		if (filters.schoolType) {
			// Check if the value exists in the select
			const schoolTypeOption = schoolTypeSelect.querySelector(`option[value="${filters.schoolType}"]`);
			if (schoolTypeOption) {
				// If the value exists in the select, set it to that value
				schoolTypeSelect.value = filters.schoolType;
			} else {
				// If the value doesn't exist in the select, set it to all
				schoolTypeSelect.value = 'all';
			}
		}
	}

	function filterEvents(name, value, block) {
		// console.log("filter-name:", name);
		// console.log("filter-value:", value);
		// console.log("filter-block:", block);

		// If the value is all, null it out
		if (value === 'all') {
			value = null;
		}

		// Take the update we are doing and store it to generate the new URL query string
		switch (name) {
			case 'month':
				filters.month = value;
				break;
			case 'state':
				filters.state = value;
				break;
			case 'event-type':
				filters.eventType = value;
				break;
			case 'school-type':
				filters.schoolType = value;
				break;
		}

		// Use the current filters variables to generate a new URL query string
		const url = generateUrl();

		// Push the new URL and refresh the page
		window.location = url;
	}

	function generateUrl() {
		// TODO - This currently removes other query string parameters, we should preserve them

		// Get the current base URL
		let url = window.location.pathname;
		// Remove any page number from the URL
		url = url.replace(/page\/\d+/, '');

		// Create a new URLSearchParams object
		const urlParams = new URLSearchParams();
		// Add the month filter to the URL query string
		if (filters.month) {
			urlParams.append('month', filters.month);
		}
		// Add the state filter to the URL query string
		if (filters.state) {
			urlParams.append('state', filters.state);
		}
		// Add the event type filter to the URL query string
		if (filters.eventType) {
			urlParams.append('event-type', filters.eventType);
		}
		// Add the school type filter to the URL query string
		if (filters.schoolType) {
			urlParams.append('school-type', filters.schoolType);
		}
		// Add the event search filter to the URL query string
		if (filters.eventSearch) {
			urlParams.append('event-search', filters.eventSearch);
		}

		// Add the URL query string to the base URL
		url += '?' + urlParams.toString();
		// Return the URL
		return url;
	}

	return {
		init: init,
	};
})();
