const mix = require('laravel-mix');

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

// mix.js('resources/js/app.js', 'public/js')
//    .sass('resources/sass/app.scss', 'public/css');

/*
 / Load jqeury from webpack to avoid conflicts.
*/

mix.webpackConfig(webpack => {
    return {
        plugins: [
            new webpack.ProvidePlugin({
                $: 'jquery',
                jQuery: 'jquery',
            })
        ]
    };
});

/*
 / Copy svg defs
*/
mix.copy('resources/assets/icons/coreui/symbols/free-symbol-defs.svg', 'public/assets/icons/coreui/symbols');

mix.js('resources/js/admin/home.js', 'public/js/admin')
    .sass('resources/sass/admin/home.scss', 'public/css/admin');

mix.js('resources/js/artists/index.js', 'public/js/artists')
    .sass('resources/sass/artists/index.scss', 'public/css/artists');
