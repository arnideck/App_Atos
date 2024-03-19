<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\TypesOfService
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property int $business_id
 * @property array|null $location_price_group
 * @property string|null $packing_charge
 * @property string|null $packing_charge_type
 * @property int $enable_custom_fields
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|TypesOfService newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TypesOfService newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TypesOfService query()
 * @method static \Illuminate\Database\Eloquent\Builder|TypesOfService whereBusinessId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TypesOfService whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TypesOfService whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TypesOfService whereEnableCustomFields($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TypesOfService whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TypesOfService whereLocationPriceGroup($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TypesOfService whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TypesOfService wherePackingCharge($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TypesOfService wherePackingChargeType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TypesOfService whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class TypesOfService extends Model
{
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
        'location_price_group' => 'array'
    ];

    /**
     * Return list of types of service for a business
     *
     * @param int $business_id
     *
     * @return array
     */
    public static function forDropdown($business_id)
    {
        $types_of_service = TypesOfService::where('business_id', $business_id)
                    ->pluck('name', 'id');

        return $types_of_service;
    }
}
