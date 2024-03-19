<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\CashRegister
 *
 * @property int $id
 * @property int $business_id
 * @property int|null $location_id
 * @property int|null $user_id
 * @property string $status
 * @property string|null $closed_at
 * @property string $closing_amount
 * @property int $total_card_slips
 * @property int $total_cheques
 * @property array|null $denominations
 * @property string|null $closing_note
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\CashRegisterTransaction[] $cash_register_transactions
 * @property-read int|null $cash_register_transactions_count
 * @method static \Illuminate\Database\Eloquent\Builder|CashRegister newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CashRegister newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CashRegister query()
 * @method static \Illuminate\Database\Eloquent\Builder|CashRegister whereBusinessId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CashRegister whereClosedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CashRegister whereClosingAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CashRegister whereClosingNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CashRegister whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CashRegister whereDenominations($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CashRegister whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CashRegister whereLocationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CashRegister whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CashRegister whereTotalCardSlips($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CashRegister whereTotalCheques($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CashRegister whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CashRegister whereUserId($value)
 * @mixin \Eloquent
 */
class CashRegister extends Model
{
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'denominations' => 'array'
    ];

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * Get the Cash registers transactions.
     */
    public function cash_register_transactions()
    {
        return $this->hasMany(\App\CashRegisterTransaction::class);
    }
}
