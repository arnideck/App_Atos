<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\TransactionSellLinesPurchaseLines
 *
 * @property int $id
 * @property int|null $sell_line_id id from transaction_sell_lines
 * @property int|null $stock_adjustment_line_id id from stock_adjustment_lines
 * @property int $purchase_line_id id from purchase_lines
 * @property string $quantity
 * @property string $qty_returned
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\PurchaseLine $purchase_line
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionSellLinesPurchaseLines newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionSellLinesPurchaseLines newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionSellLinesPurchaseLines query()
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionSellLinesPurchaseLines whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionSellLinesPurchaseLines whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionSellLinesPurchaseLines wherePurchaseLineId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionSellLinesPurchaseLines whereQtyReturned($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionSellLinesPurchaseLines whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionSellLinesPurchaseLines whereSellLineId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionSellLinesPurchaseLines whereStockAdjustmentLineId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionSellLinesPurchaseLines whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class TransactionSellLinesPurchaseLines extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    public function purchase_line()
    {
        return $this->belongsTo(\App\PurchaseLine::class, 'purchase_line_id');
    }
}
