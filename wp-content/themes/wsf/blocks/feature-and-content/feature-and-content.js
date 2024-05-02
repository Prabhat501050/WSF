export const FeatureAndContent = (() => {
	'use strict';

	function init() {
		var $accordion_trigger = $('.accordion h3');

		$accordion_trigger.on('click', function (e) {
			e.preventDefault();
			$(this)
				.toggleClass('text-red-accent text-gray-700')
				.next('.expander')
				.toggleClass('opacity-0 opacity-100 translate-y-0 pointer-events-auto hidden')
				.parent('.accordion')
				.toggleClass('border-l-gray-400 border-l-red-accent');
		});

		$accordion_trigger.trigger('click').eq(0).trigger('click');
	}

	return {
		init: init,
	};
})();
