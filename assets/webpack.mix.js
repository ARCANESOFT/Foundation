let mix = require('laravel-mix');

/*--------------------------------------------------------------------------
 | Mix Configuration
 |--------------------------------------------------------------------------
 */

const options = require('../options.mix');

mix.setPublicPath(options.assetsPath);
mix.setResourceRoot(options.resourceRoot);

/*--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 */

mix.ts(`${__dirname}/js/main.ts`, 'js/arcanesoft.js');
mix.sass(`${__dirname}/scss/main.scss`, 'css/arcanesoft.css');

mix.copyDirectory(`${__dirname}/svg`, `${options.assetsPath}/svg/arcanesoft`);
