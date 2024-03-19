<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\ProductVariation
 *
 * @property int $id
 * @property int|null $variation_template_id
 * @property string $name
 * @property int $product_id
 * @property int $is_dummy
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\VariationTemplate|null $variation_template
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Variation[] $variations
 * @property-read int|null $variations_count
 * @method static \Illuminate\Database\Eloquent\Builder|ProductVariation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductVariation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductVariation query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductVariation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductVariation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductVariation whereIsDummy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductVariation whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductVariation whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductVariation whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductVariation whereVariationTemplateId($value)
 * @mixin \Eloquent
 */
class ProductVariation extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];
    
    public function variations()
    {
        return $this->hasMany(\App\Variation::class);
    }

    public function variation_template()
    {
        return $this->belongsTo(\App\VariationTemplate::class);
    }
}
