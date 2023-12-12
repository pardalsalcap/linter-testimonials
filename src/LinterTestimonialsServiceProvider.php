<?php

namespace Pardalsalcap\LinterTestimonials;

use Pardalsalcap\LinterTestimonials\Commands\LinterTestimonialsCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LinterTestimonialsServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('linter-testimonials')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_linter-testimonials_table')
            ->hasCommand(LinterTestimonialsCommand::class);
    }
}
