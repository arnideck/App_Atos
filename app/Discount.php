<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Discount
 *
 * @property int $id
 * @property string $name
 * @property int $business_id
 * @property int|null $brand_id
 * @property int|null $category_id
 * @property int|null $location_id
 * @property int|null $priority
 * @property string|null $discount_type
 * @property string $discount_amount
 * @property \Illuminate\Support\Carbon|null $starts_at
 * @property \Illuminate\Support\Carbon|null $ends_at
 * @property int $is_active
 * @property string|null $spg Applicable in specified selling price group only. Use of applicable_in_spg column is discontinued
 * @property int|null $applicable_in_cg
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Variation[] $variations
 * @property-read int|null $variations_count
 * @method static \Illuminate\Database\Eloquent\Builder|Discount newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Discount newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Discount query()
 * @method static \Illuminate\Database\Eloquent\Builder|Discount whereApplicableInCg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discount whereBrandId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discount whereBusinessId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discount whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discount whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discount whereDiscountAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discount whereDiscountType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discount whereEndsAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discount whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discount whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discount whereLocationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discount whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discount wherePriority($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discount whereSpg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discount whereStartsAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discount whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Discount extends Model
{
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['starts_at', 'ends_at'];

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    public function variations()
    {
        return $this->belongsToMany(\App\Variation::class, 'discount_variations', 'discount_id', 'variation_id');
    }
}
