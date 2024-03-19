<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\ReferenceCount
 *
 * @property int $id
 * @property string $ref_type
 * @property int $ref_count
 * @property int $business_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|ReferenceCount newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ReferenceCount newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ReferenceCount query()
 * @method static \Illuminate\Database\Eloquent\Builder|ReferenceCount whereBusinessId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReferenceCount whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReferenceCount whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReferenceCount whereRefCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReferenceCount whereRefType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReferenceCount whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ReferenceCount extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];
}
