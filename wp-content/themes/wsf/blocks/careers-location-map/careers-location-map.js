export const CareersLocationMap = (() => {
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
				$(`.${pin}`).delay(100).show();
				$(`.${svg}`).delay(0).hide(0);
			});

			$('body').click(function () {
				$(`.${svg}`).delay(0).show();
				$(`.${pin}`).delay(1000).hide(0);
			});
		});
	});


	// Map Section fadein Anmation  ==================================

	$(document).on("scroll", function () {
		var pageTop = $(document).scrollTop()
		var pageBottom = pageTop + $(window).height()
		var tags = $(".fadein")

		for (var i = 0; i < tags.length; i++) {
			var tag = tags[i]

			if ($(tag).offset().top < pageBottom) {
				$(tag).addClass("visible")
			} else {
				$(tag).removeClass("visible")
			}
		}
	})

	return {
		init: init,
	};

})();



window.onload = function () {
	var states = ['Alabama', 'Arkansas', 'Mississippi', 'Louisiana', 'Georgia', 'North_Carolina', 'Texas'];
	var svgContainer = document.querySelector('.us_map'); // Assuming .us_map is your SVG container class
	// Set initial transition style for smooth animation
	svgContainer.style.transition = "transform 0.5s ease-in-out";

	states.forEach(function (state) {
		var modal = document.getElementById(state + 'modal');
		var btn = document.getElementById(state);
		var span = modal.getElementsByClassName('btn-close')[0];

		btn.onclick = function () {
			modal.style.display = "block";
			modal.style.animation = "slide-top 0.5s cubic-bezier(0.42, 0, 0.58, 1) forwards";
			// Shift SVG to the left and scale down
			svgContainer.style.transformOrigin = "center"
			svgContainer.style.transform = "translateX(-20%) translateY(0) scale(0.70)";
		}

		span.onclick = function () {
			closeModal(modal);
		}

		modal.onclick = function (event) {
			if (event.target == modal) {
				closeModal(modal);
			}
		}
	});

	window.onclick = function (event) {
		states.forEach(function (state) {
			var modal = document.getElementById(state + 'modal');
			if (event.target == modal) {
				closeModal(modal);
			}
		});
	};

	function closeModal(modal) {
		modal.style.animation = "slide-out 0.5s cubic-bezier(0.42, 0, 0.58, 1) backwards";
		setTimeout(function () {
			modal.style.display = "none";
			// Reset SVG position and scale
			svgContainer.style.transform = "translateX(0) scale(1)";
		}, 300);
	}
}



//pin animation
document.addEventListener('DOMContentLoaded', function () {
	// Function to apply the pulse animation to a circle
	function applyPulseAnimation(circle) {
		const cx = circle.getAttribute('cx');
		const cy = circle.getAttribute('cy');

		// Set the transform origin and apply the animation without delay
		circle.style.transformOrigin = `${cx}px ${cy}px`;
		circle.style.animation = `pulse-me 3s linear infinite`;
	}

	// Insert the keyframes for the pulse animation
	const styleEl = document.createElement('style');
	document.head.appendChild(styleEl);
	const styleSheet = styleEl.sheet;
	styleSheet.insertRule(`
        @keyframes pulse-me {
            0% { transform: scale(0.5); opacity: 1; }
            50% { opacity: 0.5; }
            70% { opacity: 0.07; }
            100% { transform: scale(2.5); opacity: 0; }
        }`, styleSheet.cssRules.length);

	// Apply the pulse animation to each circle
	const circles = document.querySelectorAll('.Ellipse');
	circles.forEach((circle) => {
		applyPulseAnimation(circle);
	});
});

// Mobile Map slider 

document.addEventListener('DOMContentLoaded', (event) => {
	let index = 0;
	const slides = document.querySelectorAll('.slide');
	const totalSlides = slides.length;
	let startX;
	let currentTranslate = 0;

	function showSlide(n) {
		const slidesContainer = document.querySelector('.slides');
		currentTranslate = -n * 100;
		slidesContainer.style.transform = 'translateX(' + currentTranslate + '%)';
	}

	window.moveSlide = function (n) {
		index = (index + n + totalSlides) % totalSlides;
		showSlide(index);
	}

	// Touch events
	const slidesContainer = document.querySelector('.slides');
	slidesContainer.addEventListener('touchstart', handleTouchStart, false);
	slidesContainer.addEventListener('touchmove', handleTouchMove, false);
	slidesContainer.addEventListener('touchend', handleTouchEnd, false);

	function handleTouchStart(event) {
		startX = event.touches[0].clientX;
	}

	function handleTouchMove(event) {
		const touchX = event.touches[0].clientX;
		const deltaX = touchX - startX;
		const translateAmount = currentTranslate + deltaX;
		slidesContainer.style.transform = 'translateX(' + translateAmount + 'px)';
	}

	function handleTouchEnd(event) {
		const endX = event.changedTouches[0].clientX;
		const deltaX = endX - startX;
		if (deltaX < -50) { // Swipe left
			moveSlide(1);
		} else if (deltaX > 50) { // Swipe right
			moveSlide(-1);
		} else { // Tap or insufficient swipe, revert to original position
			showSlide(index);
		}
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

	// Initial display and adjustment
	adjustMapVisibility();

	// Adjust visibility on resize
	window.onresize = adjustMapVisibility;
});
