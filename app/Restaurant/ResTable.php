<?php

namespace App\Restaurant;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Restaurant\ResTable
 *
 * @property int $id
 * @property int $business_id
 * @property int $location_id
 * @property string $name
 * @property string|null $description
 * @property int $created_by
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|ResTable newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ResTable newQuery()
 * @method static \Illuminate\Database\Query\Builder|ResTable onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ResTable query()
 * @method static \Illuminate\Database\Eloquent\Builder|ResTable whereBusinessId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ResTable whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ResTable whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ResTable whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ResTable whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ResTable whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ResTable whereLocationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ResTable whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ResTable whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|ResTable withTrashed()
 * @method static \Illuminate\Database\Query\Builder|ResTable withoutTrashed()
 * @mixin \Eloquent
 */
class ResTable extends Model
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
}
