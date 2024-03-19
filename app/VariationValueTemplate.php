<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\VariationValueTemplate
 *
 * @property int $id
 * @property string $name
 * @property int $variation_template_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\VariationTemplate $variationTemplate
 * @method static \Illuminate\Database\Eloquent\Builder|VariationValueTemplate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VariationValueTemplate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VariationValueTemplate query()
 * @method static \Illuminate\Database\Eloquent\Builder|VariationValueTemplate whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VariationValueTemplate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VariationValueTemplate whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VariationValueTemplate whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VariationValueTemplate whereVariationTemplateId($value)
 * @mixin \Eloquent
 */
class VariationValueTemplate extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];
    /**
     * Get the variation that owns the attribute.
     */
    public function variationTemplate()
    {
        return $this->belongsTo(\App\VariationTemplate::class);
    }
}
