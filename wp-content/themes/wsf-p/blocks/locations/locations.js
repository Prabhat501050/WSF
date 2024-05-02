import { Helpers } from '../../src/global/Helpers';
import mapStylesJSON from './lightgraymap.json';

export const Locations = (() => {
	'use strict';

	let map;
	let markers = [];

	function init() {
		if (!document.getElementById('locations-map') || typeof wsfLocations === 'undefined') return;

		initMap();
	}

	async function initMap() {
		const { Map } = await google.maps.importLibrary('maps');
		const { AdvancedMarkerElement } = await google.maps.importLibrary('marker');

		map = new Map(document.getElementById('locations-map'), {
			center: { lat: -34.397, lng: 150.644 },
			zoom: 8,
			mapId: '3a486dcb54de5716',
			styles: mapStylesJSON,
			streetViewControl: false
		});

		renderMarkers(AdvancedMarkerElement);
	}

	function renderMarkers(AdvancedMarkerElement) {
		const mapBounds = new google.maps.LatLngBounds();

		markers = [];

		wsfLocations.forEach((location, i) => {
			mapBounds.extend(new google.maps.LatLng(location.map.lat, location.map.lng));

			const markerHTML = document.createElement('div');
			const inner = document.createElement('div');

			inner.className = 'w-3 h-3 bg-red rounded-full ring-4 ring-[#FFE6D5]/60';
			markerHTML.className =
				'transition-expo w-6 h-6 flex flex-col justify-center items-center rounded-full border-2 border-red-accent/0 hover:border-red-accent/100 translate-y-1/2 cursor-pointer';

			markerHTML.appendChild(inner);

			const marker = new AdvancedMarkerElement({
				position: { lat: location.map.lat, lng: location.map.lng },
				map: map,
				content: markerHTML,
			});

			if (i == 0) {
				map.setCenter(marker.position);
				Helpers.toggleCSSclasses(markerHTML, ['border-red-accent/100', 'border-red-accent/0']);
				renderLocation(location);
			}

			markers.push(marker);

			marker.addListener('click', () => {
				map.setCenter(marker.position);

				markers.forEach((m) => {
					m.content.classList.remove('border-red-accent/100');
					m.content.classList.add('border-red-accent/0');
				});

				markerHTML.classList.add('border-red-accent/100');
				markerHTML.classList.remove('border-red-accent/0');

				renderLocation(location);
			});
		});

		map.fitBounds(mapBounds);
	}

	function renderLocation(location) {
		const targetEl = document.getElementById('location-data');
		const template = document.getElementById('location-template');
		const clone = template.content.cloneNode(true);
		const imageContainer = clone.querySelector('[data-image-container]');
		const title = clone.querySelector('h3');
		const locationName = clone.querySelector('h2');
		const contentContainer = clone.querySelector('[data-content-container]');
		const linkEl = clone.querySelector('a');

		imageContainer.innerHTML = location.image;
		title.textContent = location.title;
		locationName.textContent = location.location;
		contentContainer.innerHTML = location.content;

		if (location.map_link) {
			linkEl.innerText = location.map_link.title;
			linkEl.setAttribute('href', location.map_link.url);
			linkEl.setAttribute('target', location.map_link.target);
			linkEl.setAttribute('aria-label', `${location.map_link.title} about ${location.title}`);
		} else {
			linkEl.remove();
		}

		while (targetEl.firstChild) {
			targetEl.removeChild(targetEl.firstChild);
		}

		targetEl.appendChild(clone);
	}

	return {
		init: init,
	};
})();
