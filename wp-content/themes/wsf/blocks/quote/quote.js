import Glide from '@glidejs/glide';
import '../../node_modules/@glidejs/glide/dist/css/glide.core.min.css';

export const Quote = (() => {
	'use strict';

	let $quoteSlider;
	
	function init() {
		$quoteSlider = $('.pxblock--quote .glide');

		if ($quoteSlider.length) {
			$quoteSlider.each(function () {
				let $slides = $quoteSlider.find('.glide__slide');

				if($slides.length > 1){
					let glide = new Glide($(this)[0], {
						type: 'carousel',
						autoplay: 8000,
						perView: 1,
					});
	
					glide.mount();						
				}
			});
		}
	}

	return {
		init: init,
	};
})();
