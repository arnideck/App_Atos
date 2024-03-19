<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\StockAdjustmentLine
 *
 * @property int $id
 * @property int $transaction_id
 * @property int $product_id
 * @property int $variation_id
 * @property string $quantity
 * @property string $secondary_unit_quantity
 * @property string|null $unit_price Last purchase unit price
 * @property int|null $removed_purchase_line
 * @property int|null $lot_no_line_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\PurchaseLine|null $lot_details
 * @property-read \App\Variation $variation
 * @method static \Illuminate\Database\Eloquent\Builder|StockAdjustmentLine newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StockAdjustmentLine newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StockAdjustmentLine query()
 * @method static \Illuminate\Database\Eloquent\Builder|StockAdjustmentLine whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockAdjustmentLine whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockAdjustmentLine whereLotNoLineId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockAdjustmentLine whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockAdjustmentLine whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockAdjustmentLine whereRemovedPurchaseLine($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockAdjustmentLine whereSecondaryUnitQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockAdjustmentLine whereTransactionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockAdjustmentLine whereUnitPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockAdjustmentLine whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockAdjustmentLine whereVariationId($value)
 * @mixin \Eloquent
 */
class StockAdjustmentLine extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    public function variation()
    {
        return $this->belongsTo(\App\Variation::class, 'variation_id');
    }

    public function lot_details()
    {
        return $this->belongsTo(\App\PurchaseLine::class, 'lot_no_line_id');
    }
}
