<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\DashboardConfiguration
 *
 * @property int $id
 * @property int $business_id
 * @property int $created_by
 * @property string $name
 * @property string $color
 * @property string|null $configuration
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|DashboardConfiguration newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DashboardConfiguration newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DashboardConfiguration query()
 * @method static \Illuminate\Database\Eloquent\Builder|DashboardConfiguration whereBusinessId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DashboardConfiguration whereColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DashboardConfiguration whereConfiguration($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DashboardConfiguration whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DashboardConfiguration whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DashboardConfiguration whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DashboardConfiguration whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DashboardConfiguration whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class DashboardConfiguration extends Model
{
    
}
