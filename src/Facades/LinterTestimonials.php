<?php

namespace Pardalsalcap\LinterTestimonials\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Pardalsalcap\LinterTestimonials\LinterTestimonials
 */
class LinterTestimonials extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Pardalsalcap\LinterTestimonials\LinterTestimonials::class;
    }
}
