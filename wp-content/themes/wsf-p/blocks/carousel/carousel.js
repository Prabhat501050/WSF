import Glide from '@glidejs/glide';
import '@glidejs/glide/dist/css/glide.core.min.css';

export const Carousel = (() => {
	'use strict';

	function init() {
		$('.pxblock--carousel .glide').each(function () {
			var glide = new Glide($(this)[0], {
				type: 'carousel',
				autoplay: false,
				perView: 3,
				classes: {
					activeNav: 'bg-red',
				},
				focusAt: 2,
				gap: 20,
				breakpoints: {
					768: { // md
						perView: 1,
						focusAt: 1,
					},
					1280: { // xlg
						perView: 2,
						focusAt: 1,
					},
				},
			});

			glide.on('mount.after', function () {
				$('.glide__slide--active').next().find('.caption').addClass('opacity-100');
				$('.glide__bullet').eq(0).addClass('bg-red');
			});

			glide.on('run.before', function () {
				$('.glide__slide .caption').removeClass('opacity-100').addClass('opacity-0');
				$('.glide__bullet--active').removeClass('bg-red');
			});

			glide.on('run.after', function () {
				$('.glide__slide--active').next().find('.caption').addClass('opacity-100');
				$('.glide__bullet--active').addClass('bg-red');
			});

			glide.mount();
		});
	}

	return {
		init: init,
	};
})();
