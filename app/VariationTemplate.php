<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\VariationTemplate
 *
 * @property int $id
 * @property string $name
 * @property int $business_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\VariationValueTemplate[] $values
 * @property-read int|null $values_count
 * @method static \Illuminate\Database\Eloquent\Builder|VariationTemplate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VariationTemplate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VariationTemplate query()
 * @method static \Illuminate\Database\Eloquent\Builder|VariationTemplate whereBusinessId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VariationTemplate whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VariationTemplate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VariationTemplate whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VariationTemplate whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class VariationTemplate extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];
    /**
    * Get the attributes for the variation.
    */
    public function values()
    {
        return $this->hasMany(\App\VariationValueTemplate::class);
    }
}
