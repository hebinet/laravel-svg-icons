# Laravel SVG Icons

Allows to inline [Font Awesome 5+](https://fontawesome.com/)'s SVG icons via a simple Laravel Blade directive without Javascript.

## Installation

### Install composer package
You can install it using Composer:

```bash
composer require hebinet/laravel-svg-icons
```

Optionally, you can publish the config file of the package.

```bash
php artisan vendor:publish --provider="Hebinet\SvgIcons\ServiceProvider" --tag=config
```

### Install SVG font
Additionally you need to install Font Awesome via npm:

```bash
npm install @fortawesome/fontawesome-free
```

The path to the SVG Files in the npm package is configured by default.

You can change the path via the config Parameter `path_to_fontawesome` in `config\icons.php`

### Add Font Awesome SVG CSS-Style
To display the icons correctly you need to include additional css files which can be found in the npm `@fortawesome/fontawesome-free` package.

I would recommend using Webpack to publish the file in the `public/css` directory.

```js
// Inside webpack.mix.js

mix.copy('node_modules/@fortawesome/fontawesome-free/css/svg-with-js.css', 'public/css/svg-icons.css');

```

The `svg-icons.css` file should now be included in the head-Section of your Site
```html
<link rel="stylesheet" href="{{ mix('/css/svg-icons.css') }}"/>
```

To set the color of the icons correctly, you have to add the following style declaration in your global CSS file
```css
svg.svg-inline--fa {
    fill: currentColor;
}
```

## Usage

You can add the new `@icon` blade directive to add the inline SVG icon.
The argument for the directive is the same as you would use for Font Awesome Icon.

You can use it like this
```
@icon('{style} {icon} {optional addtitonal classes},{optional title}')
```

### Examples

```php
// Plain icon
@icon('fas fa-download')

// Icon with additional size class
@icon('fas fa-download fa-5x')

// And here with an additional title
@icon('fas fa-download,Download button')
@icon('fas fa-download fa-5x,Download button')
```

## Accessibility

* `role="img"` is added to the SVG tag by default
* `aria-hidden="true"` is added to the SVG tag by default unless a `<title>` is set

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email office@hebinet.at instead of using the issue tracker.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.