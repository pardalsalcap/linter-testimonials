# Add management for the testimonials modules of your website

[![Latest Version on Packagist](https://img.shields.io/packagist/v/pardalsalcap/linter-testimonials.svg?style=flat-square)](https://packagist.org/packages/pardalsalcap/linter-testimonials)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/pardalsalcap/linter-testimonials/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/pardalsalcap/linter-testimonials/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/pardalsalcap/linter-testimonials/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/pardalsalcap/linter-testimonials/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/pardalsalcap/linter-testimonials.svg?style=flat-square)](https://packagist.org/packages/pardalsalcap/linter-testimonials)

This package adds management for the testimonials modules of your website. It includes a trait to add to your models and a controller to manage the testimonials.
It needs Filament to work, and includes resources and relation managers to use with it.

## Installation

You can install the package via composer:

```bash
composer require pardalsalcap/linter-testimonials
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="linter-testimonials-migrations"
php artisan migrate
```


## Usage

To include use the resources you can create a resource that extends the package on and modify as needed:

```php
<?php

namespace App\Filament\Resources;
class TestimonialResource extends \Pardalsalcap\LinterTestimonials\Resources\TestimonialResource
{

}
```

You can add the trait to your model:

```php
use Pardalsalcap\LinterTestimonials\Traits\HasTestimonials;
```

This will add a `testimonials` relation to your model. From there you can retrieve the testimonials details.

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Credits

- [pardalsalcap](https://github.com/pardalsalcap)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
