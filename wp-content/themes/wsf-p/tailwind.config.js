const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
	content: require('fast-glob').sync([
		'./**/*.php',
		'./blocks/**/*.js',
		'./src/**/*.js',
		'*.php',
		'./acf-json/*.json',
	]),
	theme: {
		container: {
			center: true,
			padding: {
				DEFAULT: '1rem',
				sm: '2rem',
				lg: '4rem',
				xl: '5rem',
			},
		},
		colors: {
			transparent: 'transparent',
			current: 'currentColor',
			white: '#ffffff',
			black: '#000000',
			beige: '#f8f4ea',
			'dark-beige': '#F1ECE0',
			olive: '#8a9747',
			bronze: '#ab8241',
			charcoal: '#363c48',
			tan: '#DCC6A3',
			red: '#b11f28',
			'red-accent': '#69101d',
			blue: '#E3EEF5',
			gray: {
				50: '#fafafa',
				100: '#f5f5f5',
				200: '#eaeaea',
				300: '#e0e0e0',
				400: '#cccccc',
				500: '#b8b8b8',
				600: '#707070',
				700: '#525252',
				800: '#3d3d3d',
				900: '#292929',
				1000: '#141414',
				1100: '#0a0a0a',
			},
		},
		extend: {
			spacing: {
				18: '4.5rem',
			},
			padding: {
				// don't override tailwind's base classes...
				16: '4.5rem',
				24: '24px',
				40: '40px',
				48: '48px',
				56: '56px',
				62: '62px',
				100: '100px',
				124: '124px',
				headerMobile: '90px',
				headerDesktop: '120px',
			},
			lineHeight: {
				tighter: '1.125',
				jumbo: '.73',
			},
			letterSpacing: {
				widest: '2.8px',
			},
			fontFamily: {
				sans: ['PT sans', ...defaultTheme.fontFamily.sans],
				serif: ['PT serif', ...defaultTheme.fontFamily.serif],
				heading: ['Knockout\\ 68'],
				inter: ['Inter', ...defaultTheme.fontFamily.sans],
			},
			fontSize: {
				'2xxl': '1.75rem',
				'4xxl': '2.5rem',
				'5xxl': '3.5rem',
				'6xxl': '4rem',
				headline: '140px',
				jumbo: '200px',
			},
			backgroundImage: {
				alert: "url('../assets/images/alert.svg')",
				search: 'url(data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjgiIGhlaWdodD0iMjgiIHZpZXdCb3g9IjAgMCAyOCAyOCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHBhdGggaWQ9InNlYXJjaCIgZD0iTTI1LjY2NjcgMjQuMDIxN0wyMC4xOTUgMTguNTVDMjEuNDIgMTYuOTc1IDIyLjE2NjcgMTQuOTkxNyAyMi4xNjY3IDEyLjgzMzNDMjIuMTY2NyA3LjY3NjY3IDE3Ljk5IDMuNSAxMi44MzMzIDMuNUM3LjY3NjY3IDMuNSAzLjUgNy42NzY2NyAzLjUgMTIuODMzM0MzLjUgMTcuOTkgNy42NzY2NyAyMi4xNjY3IDEyLjgzMzMgMjIuMTY2N0MxNC45OTE3IDIyLjE2NjcgMTYuOTc1IDIxLjQzMTcgMTguNTUgMjAuMTk1TDI0LjAyMTcgMjUuNjY2N0wyNS42NjY3IDI0LjAyMTdaTTUuODMzMzMgMTIuODMzM0M1LjgzMzMzIDguOTcxNjcgOC45NzE2NyA1LjgzMzMzIDEyLjgzMzMgNS44MzMzM0MxNi42OTUgNS44MzMzMyAxOS44MzMzIDguOTcxNjcgMTkuODMzMyAxMi44MzMzQzE5LjgzMzMgMTYuNjk1IDE2LjY5NSAxOS44MzMzIDEyLjgzMzMgMTkuODMzM0M4Ljk3MTY3IDE5LjgzMzMgNS44MzMzMyAxNi42OTUgNS44MzMzMyAxMi44MzMzWiIgZmlsbD0iI2IxMWYyOCIvPgo8L3N2Zz4K)',
				fingerRightWhite:
					'url("data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIyNCIgaGVpZ2h0PSIyNCIgdmlld0JveD0iMCAwIDI0IDI0IiBmaWxsPSJub25lIj4KICA8cGF0aCBkPSJNMTIuMjAwMiA2LjY3MDQ1TDkuMjA3NDggNC40NDQ0MkM4Ljc4OTQxIDQuMTMzNCA4LjI3NDg1IDMuOTc3MTQgNy43NTI4NyA0LjAwMjdDNy4yMzA4OSA0LjAyODI2IDYuNzM0MzUgNC4yMzQwMyA2LjM0OTIgNC41ODQzOEwxLjcyNTc3IDguNzg3NjNDMS4yNjMyMSA5LjIwNzUxIDEgOS44MDA2NyAxIDEwLjQyMzhMMSAxNS41NTY4QzEgMTguMjIyNyAzLjI0MDAzIDIwIDUuNDgwMDcgMjBMMTUuMDc5NyAyMEMxNy42NDAxIDIwIDE3LjY0MDEgMTYuNjY3NiAxNS4wNzk3IDE2LjY2NzZMMTQuNDQwMiAxNi42Njc2IiBzdHJva2U9IiNmZmZmZmYiIHN0cm9rZS13aWR0aD0iMS41IiBzdHJva2UtbGluZWNhcD0icm91bmQiIHN0cm9rZS1saW5lam9pbj0icm91bmQiLz4KICA8cGF0aCBkPSJNMTQuMzg0NiAxN0wxNi4yMzA1IDE3QzE4LjY5MjMgMTcgMTguNjkyMyAxMy42NjY3IDE2LjIzMDUgMTMuNjY2N0wxNC4zODQ2IDEzLjY2NjdMMTcuMDc2OSAxMy42NjY3QzE5LjUzODggMTMuNjY2NyAxOS41Mzg4IDEwLjMzMzMgMTcuMDc2OSAxMC4zMzMzTTE0LjM4NDYgMTAuMzMzM0wxNy4wNzY5IDEwLjMzMzNNMTcuMDc2OSAxMC4zMzMzTDIxLjM4NTcgMTAuMzMzM0MyMS44MTM5IDEwLjMzMyAyMi4yMjQ1IDEwLjE1NzMgMjIuNTI3MiA5Ljg0NDc5QzIyLjgzIDkuNTMyMjYgMjMgOS4xMDg1IDIzIDguNjY2NjdDMjMgOC4yMjQ2NCAyMi44Mjk4IDcuODAwNzIgMjIuNTI2OSA3LjQ4ODE2QzIyLjIyMzkgNy4xNzU1OSAyMS44MTMgNyAyMS4zODQ2IDdMOSA3IiBzdHJva2U9IiNmZmZmZmYiIHN0cm9rZS13aWR0aD0iMS41IiBzdHJva2UtbGluZWNhcD0icm91bmQiIHN0cm9rZS1saW5lam9pbj0icm91bmQiLz4KPC9zdmc+")',
				fingerLeftWhite:
					'url("data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjYiIGhlaWdodD0iMjUiIHZpZXdCb3g9IjAgMCAyNiAyNSIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHBhdGggZD0iTTEzLjA5OTggNi4xMTM2M0wxNi4yNzk1IDMuNjA5MzRDMTYuNzIzNyAzLjI1OTQ1IDE3LjI3MDUgMy4wODM2NiAxNy44MjUxIDMuMTEyNDJDMTguMzc5NyAzLjE0MTE3IDE4LjkwNzMgMy4zNzI2NiAxOS4zMTY1IDMuNzY2OEwyNC4yMjg5IDguNDk1NDZDMjQuNzIwMyA4Ljk2NzgyIDI1IDkuNjM1MTMgMjUgMTAuMzM2MkwyNSAxNi4xMTA4QzI1IDE5LjEwOTkgMjIuNjIgMjEuMTA5NCAyMC4yMzk5IDIxLjEwOTRMMTAuMDQwMyAyMS4xMDk0QzcuMzE5OTEgMjEuMTA5NCA3LjMxOTkxIDE3LjM2MDQgMTAuMDQwMyAxNy4zNjA0TDEwLjcxOTggMTcuMzYwNCIgc3Ryb2tlPSJ3aGl0ZSIgc3Ryb2tlLXdpZHRoPSIxLjUiIHN0cm9rZS1saW5lY2FwPSJyb3VuZCIgc3Ryb2tlLWxpbmVqb2luPSJyb3VuZCIvPgo8cGF0aCBkPSJNMTAuMjMwOCAxNy4xMDk0TDguMjUzMDggMTcuMTA5NEM1LjYxNTM5IDE3LjEwOTQgNS42MTUzOSAxMy43NzYgOC4yNTMwOCAxMy43NzZMMTAuMjMwOCAxMy43NzZMNy4zNDYxNSAxMy43NzZDNC43MDg0NiAxMy43NzYgNC43MDg0NiAxMC40NDI3IDcuMzQ2MTUgMTAuNDQyN00xMC4yMzA4IDEwLjQ0MjdMNy4zNDYxNSAxMC40NDI3TTcuMzQ2MTUgMTAuNDQyN0wyLjcyOTYyIDEwLjQ0MjdDMi4yNzA3OSAxMC40NDI0IDEuODMwODYgMTAuMjY2NyAxLjUwNjUyIDkuOTU0MTZDMS4xODIxOSA5LjY0MTYzIDEgOS4yMTc4OCAxIDguNzc2MDRDMSA4LjMzNDAxIDEuMTgyMzUgNy45MTAwOSAxLjUwNjkzIDcuNTk3NTNDMS44MzE1MSA3LjI4NDk3IDIuMjcxNzQgNy4xMDkzNyAyLjczMDc3IDcuMTA5MzdMMTYgNy4xMDkzNyIgc3Ryb2tlPSJ3aGl0ZSIgc3Ryb2tlLXdpZHRoPSIxLjUiIHN0cm9rZS1saW5lY2FwPSJyb3VuZCIgc3Ryb2tlLWxpbmVqb2luPSJyb3VuZCIvPgo8L3N2Zz4K")',
				fingerLeftRed: "url('../assets/images/redLeftFinger.svg')",
			},
			backgroundSize: {
				4: '1rem',
				6: '1.5rem',
				8: '2rem',
			},
			transitionTimingFunction: {
				'in-expo': 'cubic-bezier(0.95, 0.05, 0.795, 0.035)',
				'out-expo': 'cubic-bezier(0.19, 1, 0.22, 1)',
				'out-quart': 'cubic-bezier(0.25, 1, 0.5, 1)',
			},
		},
	},
	safelist: [
		'bg-tan',
		'bg-blue',
		'bg-beige',
		'bg-dark-beige',
		'bg-charcoal',
		'text-bronze',
		'text-olive',
		'py-[24px]',
		'py-[40px]',
		'py-[48px]',
		'py-[56px]',
		'py-[62px]',
		'py-[98px]',
		'py-[100px]',
		'py-[124px]',
		'py-[200px]',
		'pt-[24px]',
		'pt-[40px]',
		'pt-[48px]',
		'pt-[56px]',
		'pt-[62px]',
		'pt-[98px]',
		'pt-[100px]',
		'pt-[124px]',
		'pt-[200px]',
		'pt-[300px]',
		'pb-[24px]',
		'pb-[40px]',
		'pb-[48px]',
		'pb-[56px]',
		'pb-[62px]',
		'pb-[98px]',
		'pb-[100px]',
		'pb-[124px]',
		'pb-[200px]',
		'pb-[300px]',
		'w-3/4',
		'w-1/2',
	],
	plugins: [
		function ({ addUtilities }) {
			const newUtilities = {
				'.m-center': {
					p: {
						'@apply text-center sm:text-left': {},
					},
				},
				'.content': {
					p: {
						'@apply last:mb-0': {},
					},
					'p > .btn': {
						'@apply mt-0': {},
					},
				},
				'.img-bg': {
					img: {
						'@apply block object-cover w-full h-full': {},
					},
				},
				'.image-bg': {
					img: {
						'@apply h-screen absolute top-0 left-0 z-0 pointer-events-none w-full h-full object-cover object-center':
							{},
					},
				},
				'.img-full': {
					img: {
						'@apply max-w-full mx-auto': {},
					},
				},
				'.pxblock': {
					'@apply lg:max-w-[1800px] mx-auto': {},
				},
			};

			addUtilities(newUtilities);
		},
	],
};
