<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\PurchaseLine
 *
 * @property int $id
 * @property int $transaction_id
 * @property int $product_id
 * @property int $variation_id
 * @property float $quantity
 * @property string $secondary_unit_quantity
 * @property string $pp_without_discount Purchase price before inline discounts
 * @property string $discount_percent Inline discount percentage
 * @property string $purchase_price
 * @property string $purchase_price_inc_tax
 * @property string $item_tax Tax for one quantity
 * @property int|null $tax_id
 * @property int|null $purchase_order_line_id
 * @property string $quantity_sold Quanity sold from this purchase line
 * @property string $quantity_adjusted Quanity adjusted in stock adjustment from this purchase line
 * @property string $quantity_returned
 * @property string $po_quantity_purchased
 * @property string $mfg_quantity_used
 * @property string|null $mfg_date
 * @property string|null $exp_date
 * @property string|null $lot_number
 * @property int|null $sub_unit_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read float $quantity_remaining
 * @property-read float $quantity_used
 * @property-read \App\TaxRate|null $line_tax
 * @property-read \App\Product $product
 * @property-read PurchaseLine|null $purchase_order_line
 * @property-read \App\Unit|null $sub_unit
 * @property-read \App\Transaction $transaction
 * @property-read \App\Variation $variations
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseLine newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseLine newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseLine query()
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseLine whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseLine whereDiscountPercent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseLine whereExpDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseLine whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseLine whereItemTax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseLine whereLotNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseLine whereMfgDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseLine whereMfgQuantityUsed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseLine wherePoQuantityPurchased($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseLine wherePpWithoutDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseLine whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseLine wherePurchaseOrderLineId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseLine wherePurchasePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseLine wherePurchasePriceIncTax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseLine whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseLine whereQuantityAdjusted($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseLine whereQuantityReturned($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseLine whereQuantitySold($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseLine whereSecondaryUnitQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseLine whereSubUnitId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseLine whereTaxId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseLine whereTransactionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseLine whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseLine whereVariationId($value)
 * @mixin \Eloquent
 */
class PurchaseLine extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];
    
    public function transaction()
    {
        return $this->belongsTo(\App\Transaction::class);
    }

    public function product()
    {
        return $this->belongsTo(\App\Product::class, 'product_id');
    }

    public function variations()
    {
        return $this->belongsTo(\App\Variation::class, 'variation_id');
    }

    /**
     * Set the quantity.
     *
     * @param  string  $value
     * @return float $value
     */
    public function getQuantityAttribute($value)
    {
        return (float)$value;
    }

    /**
     * Get the unit associated with the purchase line.
     */
    public function sub_unit()
    {
        return $this->belongsTo(\App\Unit::class, 'sub_unit_id');
    }

    /**
     * Give the quantity remaining for a particular
     * purchase line.
     *
     * @return float $value
     */
    public function getQuantityRemainingAttribute()
    {
        return (float)($this->quantity - $this->quantity_used);
    }

    /**
     * Give the sum of quantity sold, adjusted, returned.
     *
     * @return float $value
     */
    public function getQuantityUsedAttribute()
    {
        return (float)($this->quantity_sold + $this->quantity_adjusted + $this->quantity_returned + $this->mfg_quantity_used);
    }

    public function line_tax()
    {
        return $this->belongsTo(\App\TaxRate::class, 'tax_id');
    }

    public function purchase_order_line()
    {
        return $this->belongsTo(\App\PurchaseLine::class, 'purchase_order_line_id');
    }
}
