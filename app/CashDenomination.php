<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\CashDenomination
 *
 * @property int $id
 * @property int $business_id
 * @property string $amount
 * @property int $total_count
 * @property string $model_type
 * @property int $model_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|CashDenomination newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CashDenomination newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CashDenomination query()
 * @method static \Illuminate\Database\Eloquent\Builder|CashDenomination whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CashDenomination whereBusinessId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CashDenomination whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CashDenomination whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CashDenomination whereModelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CashDenomination whereModelType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CashDenomination whereTotalCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CashDenomination whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class CashDenomination extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];
}
