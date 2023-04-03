const mix = require('laravel-mix');

let webpack = require('webpack');
let path = require('path');

mix.webpackConfig({
	resolve: {
		alias: {
			jQuery: path.resolve(__dirname, 'node_modules/jquery/dist/jquery.js')
		}
	},
	plugins: [
		// ProvidePlugin helps to recognize $ and jQuery words in code
		// And replace it with require('jquery')
		new webpack.ProvidePlugin({
			$: 'jquery',
			jQuery: 'jquery'
		})
	]
});

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .vue()
    .sass('resources/sass/app.scss', 'public/css');

mix.postCss('resources/css/app.css', 'public/css');