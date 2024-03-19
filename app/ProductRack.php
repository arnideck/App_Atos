<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\ProductRack
 *
 * @property int $id
 * @property int $business_id
 * @property int $location_id
 * @property int $product_id
 * @property string|null $rack
 * @property string|null $row
 * @property string|null $position
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|ProductRack newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductRack newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductRack query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductRack whereBusinessId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductRack whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductRack whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductRack whereLocationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductRack wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductRack whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductRack whereRack($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductRack whereRow($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductRack whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ProductRack extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];
}
