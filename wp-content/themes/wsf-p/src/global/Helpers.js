export const Helpers = (() => {
	'use strict';

	function init() {
		links();
		body_scroll();
		anchorBar();
		mobile_menu();
		footerMenu();
	}

	const toggleCSSclasses = (el, cls) => cls.map((cl) => el.classList.toggle(cl));

	function links() {
		document.querySelectorAll('a').forEach((anchorTag) => {
			// External links
			if (
				anchorTag.href.indexOf(window.location.host) < 0 &&
				anchorTag.href.indexOf('mailto') < 0 &&
				anchorTag.href.indexOf('tel') < 0
			)
				anchorTag.setAttribute('target', '_blank');

			// Anchor links
			if (anchorTag.href.indexOf('#') === 0 && !document.getElementById(anchorTag.href.replace('#', '')))
				window.scrollTo({ top: 0, behavior: 'smooth' });
		});
	}

	function mobile_menu() {
		const mobileTrigger = document.querySelector('.site-header__mobile-trigger');
		const menuContainer = document.getElementById('wsf-mobile-menu');

		if (!mobileTrigger || !menuContainer) return;

		// const headerHeight = document.getElementById('header-main-nav').getBoundingClientRect().height;

		// menuContainer.style.maxHeight = `calc(100vh - ${headerHeight}px)`;

		mobileTrigger.addEventListener('click', () => {
			mobileTrigger.classList.toggle('opened');
			document.body.classList.toggle('overflow-hidden');
			document.getElementById('anchor-bar')?.classList.toggle('hidden');
			toggleCSSclasses(menuContainer, ['translate-x-full', 'pointer-events-none']);
		});

		menuContainer.querySelectorAll('.menu-item').forEach((item) => {
			const megaMenu = item.querySelector('.mobile-mega-menu');

			if (megaMenu) {
				item.addEventListener('click', (ev) => {
					if (megaMenu.classList.contains('!max-h-screen')) return;
					const link = item.querySelector('a');

					ev.preventDefault();

					menuContainer.querySelectorAll('.menu-item').forEach((i) => {
						const link = i.querySelector('a');

						link.classList.remove('bg-red-accent');
						link.classList.remove('text-white');

						i.querySelector('.mobile-mega-menu')?.classList.remove('!max-h-screen');
					});

					link.classList.add('bg-red-accent');
					link.classList.add('text-white');
					megaMenu.classList.add('!max-h-screen');
				});
			}
		});
	}

	function body_scroll() {
		window.addEventListener(
			'scroll',
			() => {
				window.scrollY > 1
					? document.body.classList.add('scrolled')
					: document.body.classList.remove('scrolled');
			},
			1,
		);
	}

	function sendEvent(action, options) {

		// Action is required, options are optional. Error if action is not provided.
		if ( !action ) {
			console.error('GA event not sent. Action is required.');
			return;
		}

		if (typeof gtag !== 'undefined' && gtag !== null) {
			gtag('event', action, options);
			// console.warn(
			// 	'GA event sent',
			// 	'\n',
			// 	'Action: '+ action,
			// 	'\n',
			// 	'Options: ',
			// 	options
			// );
		} else {
			// console.warn(
			// 	'GA events are not tracked on this domain ',
			// 	'\n',
			// 	'Action: '+ action,
			// 	'\n',
			// 	'Options: ',
			// 	options
			// );
		}
	}

	function anchorBar() {
		const targetBlocks = [...document.querySelectorAll('[data-anchor-label]')]?.filter(
			(block) => block.dataset.anchorLabel !== '',
		);

		if (targetBlocks.length === 0) return;

		const anchorBarEl = document.createElement('nav');

		anchorBarEl.id = 'anchor-bar';

		anchorBarEl.classList.add(
			'container',
			'heading',
			'bg-red-accent',
			'text-white',
			'flex',
			'items-center',
			'py-3',
			'text-xl',
			'lg:rounded-b-md',
			'shadow-lg',
			'flex-wrap',
			'lg:flex-nowrap',
		);

		targetBlocks?.forEach((block) => {
			const targetLinkEl = document.createElement('button');

			targetLinkEl.classList.add(
				'hover:text-tan',
				'text-white',
				'transition',
				'font-heading',
				'text-xl',
				'uppercase',
				'tracking-wide',
				'mr-5',
				'md:mr-10'
			);

			targetLinkEl.innerText = block.dataset.anchorLabel;

			targetLinkEl.addEventListener('click', () => {
				window.scrollTo({
					top: block.offsetTop - 150,
					behavior: 'smooth',
				});
			});

			anchorBarEl.appendChild(targetLinkEl);
		});

		document.getElementById('header-main-nav').classList.add('!rounded-b-none');
		document.getElementById('wsf-site-header').appendChild(anchorBarEl);
	}

	function footerMenu(){
		var footerMenu = document.getElementById('menu-footer-menu');
		if (footerMenu) {
			var py8Links = footerMenu.querySelectorAll('a.py-8');

			py8Links.forEach(function(link) {
				link.classList.remove('py-8');
			});
		}
	}

	return {
		init: init,
		sendEvent: sendEvent,
		toggleCSSclasses: toggleCSSclasses,
	};
})();
