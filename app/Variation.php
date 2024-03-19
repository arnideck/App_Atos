<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Variation
 *
 * @property int $id
 * @property string $name
 * @property int $product_id
 * @property string|null $sub_sku
 * @property int $product_variation_id
 * @property int|null $variation_value_id
 * @property string|null $default_purchase_price
 * @property string $dpp_inc_tax
 * @property string $profit_percent
 * @property string|null $default_sell_price
 * @property string|null $sell_price_inc_tax Sell price including tax
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property array|null $combo_variations Contains the combo variation details
 * @property-read mixed $full_name
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\VariationGroupPrice[] $group_prices
 * @property-read int|null $group_prices_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Media[] $media
 * @property-read int|null $media_count
 * @property-read \App\Product $product
 * @property-read \App\ProductVariation $product_variation
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\TransactionSellLine[] $sell_lines
 * @property-read int|null $sell_lines_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\VariationLocationDetails[] $variation_location_details
 * @property-read int|null $variation_location_details_count
 * @method static \Illuminate\Database\Eloquent\Builder|Variation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Variation newQuery()
 * @method static \Illuminate\Database\Query\Builder|Variation onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Variation query()
 * @method static \Illuminate\Database\Eloquent\Builder|Variation whereComboVariations($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Variation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Variation whereDefaultPurchasePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Variation whereDefaultSellPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Variation whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Variation whereDppIncTax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Variation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Variation whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Variation whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Variation whereProductVariationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Variation whereProfitPercent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Variation whereSellPriceIncTax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Variation whereSubSku($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Variation whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Variation whereVariationValueId($value)
 * @method static \Illuminate\Database\Query\Builder|Variation withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Variation withoutTrashed()
 * @mixin \Eloquent
 */
class Variation extends Model
{
    use SoftDeletes;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];
    
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'combo_variations' => 'array',
    ];
    
    public function product_variation()
    {
        return $this->belongsTo(\App\ProductVariation::class);
    }

    public function product()
    {
        return $this->belongsTo(\App\Product::class, 'product_id');
    }

    /**
     * Get the sell lines associated with the variation.
     */
    public function sell_lines()
    {
        return $this->hasMany(\App\TransactionSellLine::class);
    }

    /**
     * Get the location wise details of the the variation.
     */
    public function variation_location_details()
    {
        return $this->hasMany(\App\VariationLocationDetails::class);
    }

    /**
     * Get Selling price group prices.
     */
    public function group_prices()
    {
        return $this->hasMany(\App\VariationGroupPrice::class, 'variation_id');
    }

    public function media()
    {
        return $this->morphMany(\App\Media::class, 'model');
    }

    public function getFullNameAttribute()
    {
        $name = $this->product->name;
        if ($this->product->type == 'variable') {
            $name .= ' - ' . $this->product_variation->name . ' - ' . $this->name;
        }
        $name .= ' (' . $this->sub_sku . ')';

        return $name;
    }
}
