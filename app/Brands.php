<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Brands
 *
 * @property int $id
 * @property int $business_id
 * @property string $name
 * @property string|null $description
 * @property int $created_by
 * @property int $use_for_repair brands to be used on repair module
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Brands newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Brands newQuery()
 * @method static \Illuminate\Database\Query\Builder|Brands onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Brands query()
 * @method static \Illuminate\Database\Eloquent\Builder|Brands whereBusinessId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Brands whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Brands whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Brands whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Brands whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Brands whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Brands whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Brands whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Brands whereUseForRepair($value)
 * @method static \Illuminate\Database\Query\Builder|Brands withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Brands withoutTrashed()
 * @mixin \Eloquent
 */
class Brands extends Model
{
    use SoftDeletes;
    
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    
    
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * Return list of brands for a business
     *
     * @param int $business_id
     * @param boolean $show_none = false
     *
     * @return object|array brands
     */
    public static function forDropdown($business_id, $show_none = false, $filter_use_for_repair = false)
    {
        $query = Brands::where('business_id', $business_id);

        if ($filter_use_for_repair) {
            $query->where('use_for_repair', 1);
        }

        $brands = $query->orderBy('name', 'asc')
                    ->pluck('name', 'id');

        if ($show_none) {
            $brands->prepend(__('lang_v1.none'), '');
        }

        return $brands;
    }
}
