let mix = require("laravel-mix");
const tailwindcss = require("tailwindcss");
require("dotenv").config();
require("laravel-mix-purgecss");
require("laravel-mix-polyfill");

// define the server ip where your php is running on in the .env file (docker/local/xampp etc.)
// type 'npm run watch' for hot reloading server
// snippetOption puts browsersync script into header, so it works with turbolinks
mix.browserSync({
  proxy: process.env.LOCALPROXY,
  files: ["wp-content/themes/wp-template/dist/app.css", "wp-content/themes/wp-template/dist/app.js", "wp-content/themes/wp-template/**/*.php", "wp-content/themes/wp-template/**/*.js"],
  watch: true,
  snippetOptions: {
    rule: {
      match: /<\/head>/i,
      fn: function(snippet, match) {
        return snippet + match;
      }
    }
  }
});

// mix adds tailwind, preprocesses sass, combines css, purges css and bundles/polyfills js
// outputs two files in the dist folder, which are enqueued in the functions.php
mix
  .js("src/js/app.js", "wp-content/themes/wp-template/dist/")
  .sass("src/css/app.scss", "wp-content/themes/wp-template/dist/")
  .options({
    processCssUrls: false,
    postCss: [tailwindcss("tailwind.config.js")]
  })
  .polyfill({
    enabled: true
  })
  .purgeCss({
    content: ["src/js/app.js", "wp-content/themes/wp-template/**/*.php"],
    css: ["src/css/app.scss"]
  });

// Full API
// mix.js(src, output);
// mix.react(src, output); <-- Identical to mix.js(), but registers React Babel compilation.
// mix.preact(src, output); <-- Identical to mix.js(), but registers Preact compilation.
// mix.coffee(src, output); <-- Identical to mix.js(), but registers CoffeeScript compilation.
// mix.ts(src, output); <-- TypeScript support. Requires tsconfig.json to exist in the same folder as webpack.mix.js
// mix.extract(vendorLibs);
// mix.sass(src, output);
// mix.less(src, output);
// mix.stylus(src, output);
// mix.postCss(src, output, [require('postcss-some-plugin')()]);
// mix.browserSync('my-site.test');
// mix.combine(files, destination);
// mix.babel(files, destination); <-- Identical to mix.combine(), but also includes Babel compilation.
// mix.copy(from, to);
// mix.copyDirectory(fromDir, toDir);
// mix.minify(file);
// mix.sourceMaps(); // Enable sourcemaps
// mix.version(); // Enable versioning.
// mix.disableNotifications();
// mix.setPublicPath('path/to/public');
// mix.setResourceRoot('prefix/for/resource/locators');
// mix.autoload({}); <-- Will be passed to Webpack's ProvidePlugin.
// mix.webpackConfig({}); <-- Override webpack.config.js, without editing the file directly.
// mix.babelConfig({}); <-- Merge extra Babel configuration (plugins, etc.) with Mix's default.
// mix.then(function () {}) <-- Will be triggered each time Webpack finishes building.
// mix.override(function (webpackConfig) {}) <-- Will be triggered once the webpack config object has been fully generated by Mix.
// mix.dump(); <-- Dump the generated webpack config object to the console.
// mix.extend(name, handler) <-- Extend Mix's API with your own components.
// mix.options({
//   extractVueStyles: false, // Extract .vue component styling to file, rather than inline.
//   globalVueStyles: file, // Variables file to be imported in every component.
//   processCssUrls: true, // Process/optimize relative stylesheet url()'s. Set to false, if you don't want them touched.
//   purifyCss: false, // Remove unused CSS selectors.
//   terser: {}, // Terser-specific options. https://github.com/webpack-contrib/terser-webpack-plugin#options
//   postCss: [] // Post-CSS options: https://github.com/postcss/postcss/blob/master/docs/plugins.md
// });
