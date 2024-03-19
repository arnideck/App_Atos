<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\CashRegisterTransaction
 *
 * @property int $id
 * @property int $cash_register_id
 * @property string $amount
 * @property string|null $pay_method
 * @property string $type
 * @property string|null $transaction_type
 * @property int|null $transaction_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|CashRegisterTransaction newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CashRegisterTransaction newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CashRegisterTransaction query()
 * @method static \Illuminate\Database\Eloquent\Builder|CashRegisterTransaction whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CashRegisterTransaction whereCashRegisterId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CashRegisterTransaction whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CashRegisterTransaction whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CashRegisterTransaction wherePayMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CashRegisterTransaction whereTransactionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CashRegisterTransaction whereTransactionType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CashRegisterTransaction whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CashRegisterTransaction whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class CashRegisterTransaction extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];
}
