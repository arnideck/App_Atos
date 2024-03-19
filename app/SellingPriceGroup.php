<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\SellingPriceGroup
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property int $business_id
 * @property int $is_active
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|SellingPriceGroup active()
 * @method static \Illuminate\Database\Eloquent\Builder|SellingPriceGroup newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SellingPriceGroup newQuery()
 * @method static \Illuminate\Database\Query\Builder|SellingPriceGroup onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|SellingPriceGroup query()
 * @method static \Illuminate\Database\Eloquent\Builder|SellingPriceGroup whereBusinessId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SellingPriceGroup whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SellingPriceGroup whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SellingPriceGroup whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SellingPriceGroup whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SellingPriceGroup whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SellingPriceGroup whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SellingPriceGroup whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|SellingPriceGroup withTrashed()
 * @method static \Illuminate\Database\Query\Builder|SellingPriceGroup withoutTrashed()
 * @mixin \Eloquent
 */
class SellingPriceGroup extends Model
{
    use SoftDeletes;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    public function scopeActive($query)
    {
        return $query->where('selling_price_groups.is_active', 1);
    }

    /**
     * Return list of selling price groups
     *
     * @param int $business_id
     *
     * @return array
     */
    public static function forDropdown($business_id, $with_default = true)
    {
        $price_groups = SellingPriceGroup::where('business_id', $business_id)
                                    ->active()
                                    ->get();

        $dropdown = [];

        if ($with_default && auth()->user()->can('access_default_selling_price')) {
            $dropdown[0] = __('lang_v1.default_selling_price');
        }
        
        foreach ($price_groups as $price_group) {
            if (auth()->user()->can('selling_price_group.' . $price_group->id)) {
                $dropdown[$price_group->id] = $price_group->name;
            }
        }
        return $dropdown;
    }

    /**
     * Counts total number of selling price groups
     *
     * @param int $business_id
     *
     * @return array
     */
    public static function countSellingPriceGroups($business_id)
    {
        $count = SellingPriceGroup::where('business_id', $business_id)
                                ->active()
                                ->count();

        return $count;
    }
}
