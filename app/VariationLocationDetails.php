<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\VariationLocationDetails
 *
 * @property int $id
 * @property int $product_id
 * @property int $product_variation_id id from product_variations table
 * @property int $variation_id
 * @property int $location_id
 * @property string $qty_available
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|VariationLocationDetails newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VariationLocationDetails newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VariationLocationDetails query()
 * @method static \Illuminate\Database\Eloquent\Builder|VariationLocationDetails whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VariationLocationDetails whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VariationLocationDetails whereLocationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VariationLocationDetails whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VariationLocationDetails whereProductVariationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VariationLocationDetails whereQtyAvailable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VariationLocationDetails whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VariationLocationDetails whereVariationId($value)
 * @mixin \Eloquent
 */
class VariationLocationDetails extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];
}
