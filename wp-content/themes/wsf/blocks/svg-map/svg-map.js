export const SvgMap = (() => {
	'use strict';

	function init() {

	}

	$(document).ready(function () {
		const states = [
			{ state: 'Alabama', pin: 'Alb_map', svg: 'svg-elem-2' },
			{ state: 'Arkansas', pin: 'ark_pins', svg: 'svg-elem-4' },
			{ state: 'Mississippi', pin: 'missi_pin', svg: 'svg-elem-6' },
			{ state: 'Louisiana', pin: 'lusiaana_pin', svg: 'svg-elem-8' },
			{ state: 'Georgia', pin: 'ge_pin', svg: 'svg-elem-10' },
			{ state: 'NorthCarolina', pin: 'Nortc_pin', svg: 'svg-elem-013' },
			{ state: 'Texas', pin: 'Tx_l', svg: 'tx_svg_elem_13' }
		];

		states.forEach(({ state, pin, svg }) => {
			$(`.${state}`).click(function (event) {
				event.stopPropagation();
				$(`.${pin}`).delay(500).show();
				$(`.${svg}`).delay(0).hide(0);
			});

			$('body').click(function () {
				$(`.${svg}`).delay(500).show();
				$(`.${pin}`).delay(1000).hide(0);
			});
		});
	});




	return {
		init: init,
	};

})();



window.onload = function () {
	var states = ['Alabama', 'Arkansas', 'Mississippi', 'Louisiana', 'Georgia', 'North_Carolina', 'Texas'];

	states.forEach(function (state) {
		var modal = document.getElementById(state + 'modal');
		var btn = document.getElementById(state);
		var span = modal.getElementsByClassName('btn-close')[0];

		btn.onclick = function () {
			modal.style.animationName = "";
			modal.style.display = "block";
		}

		span.onclick = closeModal;
		window.onclick = function (event) {
			if (event.target == modal) {
				closeModal();
			}
		}

		function closeModal() {
			modal.style.animationName = "fadeOut";
			setTimeout(function () {
				modal.style.display = "none";
				modal.style.animationName = "";
			}, 500);
		}

	});

};


// Mobile Map slider 

document.addEventListener('DOMContentLoaded', (event) => {
	let index = 0;
	const slides = document.querySelectorAll('.slide');
	const totalSlides = slides.length;

	function showSlide(n) {
		const slidesContainer = document.querySelector('.slides');
		slidesContainer.style.transform = 'translateX(' + (-n * 100) + '%)';
	}

	window.moveSlide = function (n) {
		index = (index + n + totalSlides) % totalSlides;
		showSlide(index);
	}

	// Function to adjust the visibility of maps based on device width
	function adjustMapVisibility() {
		const mobileMap = document.getElementById('Mobilemap');
		const desktopMap = document.getElementById('Desktopmap');
		const screenWidth = window.innerWidth;

		if (screenWidth < 768) {
			mobileMap.style.display = 'block';
			desktopMap.style.display = 'none';
		} else {
			mobileMap.style.display = 'none';
			desktopMap.style.display = 'block';
		}
	}

	// Automatic sliding with loop back to the first image
	// setInterval(() => {
	// 	index = (index + 1) % totalSlides; // Loop back to the first image
	// 	showSlide(index);
	// }, 3000); // Change image every 3 seconds

	// Initial display and adjustment
	adjustMapVisibility();

	// Adjust visibility on resize
	window.onresize = adjustMapVisibility;
});













