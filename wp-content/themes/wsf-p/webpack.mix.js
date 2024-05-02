let mix = require('laravel-mix');
let path = require('path');

mix.options({
	legacyNodePolyfills: true,
	terser: {
		extractComments: false,
	},
	processCssUrls: false,
})
	.webpackConfig({
		stats: {
			children: true,
		},
	})
	.setPublicPath(path.resolve('./'))
	.sourceMaps()
	.extract()
	.autoload({
		jquery: ['$', 'window.jQuery', 'jQuery'],
	})
	.js('src/app.js', 'dist')
	.postCss('src/app.css', 'dist')
	.version()
	.browserSync({
		proxy: process.env.MIX_PROXY,
		files: ['dist', 'blocks/**/*.php', 'template-parts/**/*.php', './*.php'],
	})
	.disableNotifications();
