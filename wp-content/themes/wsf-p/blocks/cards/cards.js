import Glide from '@glidejs/glide';
import '@glidejs/glide/dist/css/glide.core.min.css';

export const Cards = (() => {
	'use strict';

	function init() {
		$('.pxblock--cards .glide').each(function () {
			if ($(this).find('.glide__slide').length > 3) {

				var glide = new Glide($(this)[0], {
					type: 'slider',
					autoplay: 0,
					perView: 3
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
					$('.glide__slide--active').next().find('.caption').addClass('opacity-100')
					$('.glide__bullet--active').addClass('bg-red');
				});

				glide.mount();
			}
		})


	}

	return {
		init: init,
	};
})();
