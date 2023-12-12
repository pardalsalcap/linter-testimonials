<?php

namespace Pardalsalcap\LinterTestimonials\Traits;

use Illuminate\Database\Eloquent\Relations\MorphToMany;

use Pardalsalcap\LinterTestimonials\Models\Testimoniable;
use Pardalsalcap\LinterTestimonials\Models\Testimonial;

trait HasTestimonials
{
    public function testimonials(): MorphToMany
    {
        return $this->morphToMany(Testimonial::class, 'testimoniable')->withPivot(['testimonial_type']);
    }

    public function attachAddress(Testimonial $testimonial)
    {
        $testimoniable = Testimoniable::where('testimoniable_id', $this->id)
            ->where('testimoniable_type', self::class)
            ->where('testimonial_id', $testimonial->id)
            ->firstOrNew();
        $testimoniable->tesimonial_id = $testimonial->id;
        $testimoniable->testimoniable_id = $this->id;
        $testimoniable->testimoniable_type = self::class;

        return $testimoniable->save();
    }

    public function detachAddress(Testimonial $testimonial)
    {
        return Testimoniable::where('testimonial_id', $testimonial->id)
            ->where('testimoniable_id', $this->id)
            ->where('testimoniable_type', self::class)
            ->delete();
    }

    public function syncAddresses(...$testimonials)
    {
        $testimonials = collect($testimonials);
        $testimonials_ids = $testimonials->pluck('id')->all();

        Testimoniable::where('testimoniable_id', $this->id)
            ->where('testimoniable_type', self::class)
            ->whereNotIn('testimoniable_id', $testimonials_ids)
            ->delete();
        foreach ($testimonials as $testimonial) {
            $this->attachAddress($testimonial);
        }
    }
}
