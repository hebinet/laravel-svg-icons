# Laravel SVG Icons

Allows to inline [Font Awesome 5+](https://fontawesome.com/)'s SVG icons without javascript via a simple Laravel Blade directive.

## Installation

### Install composer package
You can install it using Composer:

```bash
composer require hebinet/laravel-svg-icons
```

Optionally, you can also publish the config file of the package.

```bash
php artisan vendor:publish --provider="Hebinet\SvgIcons\ServiceProvider" --tag=config
```

### Install SVG font
As a next step you need to install Font Awesome via npm:

```bash
npm install @fortawesome/fontawesome-free
```

The path to the SVG files in the npm package is configured by default.

But you can change the path via the config parameter `path_to_fontawesome` in `config\icons.php` if you want to.

### Add Font Awesome SVG CSS-Style
To display the icons correctly you need to add an additional css file which can be found in the npm `@fortawesome/fontawesome-free` package.

I would recommend using Webpack to publish the file in the `public/css` directory.

```js
// Inside webpack.mix.js

mix.copy('node_modules/@fortawesome/fontawesome-free/css/svg-with-js.css', 'public/css/svg-icons.css');

```

Afterwards you need to add the  `svg-icons.css` file in the head section of your site.
```html
<link rel="stylesheet" href="{{ mix('/css/svg-icons.css') }}"/>
```

In order to inherit the font color of the parent correctly you have to add the following style declaration in your global CSS file
```css
svg.svg-inline--fa {
    fill: currentColor;
}
```

## Usage

You can now add the new `@icon` blade directive to add the inline SVG icon.
The argument for the directive is the same as you would use for Font Awesome icons.

You can use the directive as followed:
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