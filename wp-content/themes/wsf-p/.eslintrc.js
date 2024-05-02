module.exports = {
	env: {
		browser: true,
		es2021: true,
		node: true,
	},
	extends: 'eslint:recommended',
	parserOptions: {
		ecmaVersion: 12,
		sourceType: 'module',
	},
	globals: {
		$: true,
		MicroModal: true,
		php_vars: true,
		gtag: true,
		google: true,
		wsfLocations: true,
		templateDirURI: true,
		baseUrl: true,
	},
	rules: {
		'no-unused-vars': 1,
	},
};
