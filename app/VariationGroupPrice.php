<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\VariationGroupPrice
 *
 * @property int $id
 * @property int $variation_id
 * @property int $price_group_id
 * @property string $price_inc_tax
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|VariationGroupPrice newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VariationGroupPrice newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VariationGroupPrice query()
 * @method static \Illuminate\Database\Eloquent\Builder|VariationGroupPrice whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VariationGroupPrice whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VariationGroupPrice wherePriceGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VariationGroupPrice wherePriceIncTax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VariationGroupPrice whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VariationGroupPrice whereVariationId($value)
 * @mixin \Eloquent
 */
class VariationGroupPrice extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];
}
