<?php

namespace Pardalsalcap\LinterTestimonials\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $testimonial_id
 * @property int $testimoniable_id
 * @property string $testimoniable_type
 * @property string $testimonial_type
 * @property Testimonial $testimonial
 */
class Testimoniable extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'testimoniables';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = ['testimonial_id', 'testimoniable_id', 'testimoniable_type', 'testimonial_type'];

    public function testimonial(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Testimonial::class);
    }
}
