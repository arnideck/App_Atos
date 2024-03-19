<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Unit
 *
 * @property int $id
 * @property int $business_id
 * @property string $actual_name
 * @property string $short_name
 * @property int $allow_decimal
 * @property int|null $base_unit_id
 * @property string|null $base_unit_multiplier
 * @property int $created_by
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read Unit|null $base_unit
 * @property-read \Illuminate\Database\Eloquent\Collection|Unit[] $sub_units
 * @property-read int|null $sub_units_count
 * @method static \Illuminate\Database\Eloquent\Builder|Unit newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Unit newQuery()
 * @method static \Illuminate\Database\Query\Builder|Unit onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Unit query()
 * @method static \Illuminate\Database\Eloquent\Builder|Unit whereActualName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Unit whereAllowDecimal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Unit whereBaseUnitId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Unit whereBaseUnitMultiplier($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Unit whereBusinessId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Unit whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Unit whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Unit whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Unit whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Unit whereShortName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Unit whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Unit withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Unit withoutTrashed()
 * @mixin \Eloquent
 */
class Unit extends Model
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
     * Return list of units for a business
     *
     * @param int $business_id
     * @param boolean $show_none = true
     *
     * @return array
     */
    public static function forDropdown($business_id, $show_none = false, $only_base = true)
    {
        $query = Unit::where('business_id', $business_id);
        if ($only_base) {
            $query->whereNull('base_unit_id');
        }

        $units = $query->select(DB::raw('CONCAT(actual_name, " (", short_name, ")") as name'), 'id')->get();
        $dropdown = $units->pluck('name', 'id');
        if ($show_none) {
            $dropdown->prepend(__('messages.please_select'), '');
        }
        
        return $dropdown;
    }

    public function sub_units()
    {
        return $this->hasMany(\App\Unit::class, 'base_unit_id');
    }

    public function base_unit()
    {
        return $this->belongsTo(\App\Unit::class, 'base_unit_id');
    }
}
