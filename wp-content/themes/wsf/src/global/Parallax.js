import Rellax from 'rellax';

export const Parallax = (() => {
	'use strict';

	function init() {
		if (window.innerWidth > 1023) {
			new Rellax('[data-parallax]', {
				center: true,
			});
		}
	}

	return {
		init: init,
	};
})();
