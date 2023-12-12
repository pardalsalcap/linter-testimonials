<?php

namespace Pardalsalcap\LinterTestimonials\Commands;

use Illuminate\Console\Command;

class LinterTestimonialsCommand extends Command
{
    public $signature = 'linter-testimonials';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
