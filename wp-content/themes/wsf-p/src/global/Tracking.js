import { Helpers } from './Helpers';

export const Tracking = (() => {
	'use strict';

	function init() {
        /**
         * Tracking for the Workday handoffs
         */

        // Tracking the career search
        const workdaySearch = document.querySelector('.careers-search-form');
        if ( workdaySearch ) {
            workdaySearch.addEventListener('submit', function(e) {
                // Get searched term if set
                const searchInput = document.querySelector('input#search-jobs');
                let searchTerm = searchInput.value;
                Helpers.sendEvent('career_search', { query: searchTerm });
            });
        }
        // Tracking external links, using links that target _blank as the indicator
        const externalLinks = document.querySelectorAll('a[target="_blank"]');
        if ( externalLinks ) {
            externalLinks.forEach( (link) => {
                link.addEventListener('click', function(e) {
                    // Get the link or button text
                    let linkText = this.innerText;
                    // Get the current page URL
                    let currentPage = window.location.href;
                    // Get the destination URL
                    let destinationURL = this.href;
                    // Send the event
                    Helpers.sendEvent('external_link', {
                        link_text: linkText,
                        current_page: currentPage,
                        destination_url: destinationURL
                    });
                });
            });
        }
	}

	return {
		init: init,
	};
})();
