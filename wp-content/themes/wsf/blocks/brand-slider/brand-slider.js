import Glide from '@glidejs/glide';
import '../../node_modules/@glidejs/glide/dist/css/glide.core.min.css';

export const BrandSlider = (() => {
	'use strict';

	let $brandSlider;

	function init() {
		$brandSlider = $('.pxblock--brand-slider .glide');

		if($brandSlider.length){
			$brandSlider.each( function() {

				let glide = new Glide($(this)[0], {
					type: 'slider',
					perView: 7,
					bound: true,

					breakpoints: {
						1000: {
							perView: 4
						},
						600: {
							perView: 3
						}
					}					
				});

				glide.mount();

			})
		}
	}

	return {
		init: init,
	};
})();
