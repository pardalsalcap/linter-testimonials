<?php

namespace Pardalsalcap\LinterTestimonials\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * @property int $id
 * @property string $commenter_name
 * @property string $commenter_position
 * @property string $commenter_company
 * @property string $comment
 * @property int $position
 * @property bool $status
 * @property bool $real
 * @property string $lang
 * @property string $created_at
 * @property string $updated_at
 */
class Testimonial extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['commenter_name', 'commenter_position', 'commenter_company', 'comment', 'position', 'status', 'real', 'lang', 'created_at', 'updated_at'];

    public function testimoniable(): MorphTo
    {
        return $this->morphTo()->withPivot(['testimonial_type']);
    }
}
