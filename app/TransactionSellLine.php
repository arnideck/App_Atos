<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\TransactionSellLine
 *
 * @property int $id
 * @property int $transaction_id
 * @property int $product_id
 * @property int $variation_id
 * @property float $quantity
 * @property string $secondary_unit_quantity
 * @property string $quantity_returned
 * @property string $unit_price_before_discount
 * @property string|null $unit_price Sell price excluding tax
 * @property string|null $line_discount_type
 * @property string $line_discount_amount
 * @property string|null $unit_price_inc_tax Sell price including tax
 * @property string $item_tax Tax for one quantity
 * @property int|null $tax_id
 * @property int|null $discount_id
 * @property int|null $lot_no_line_id
 * @property string|null $sell_line_note
 * @property int|null $so_line_id
 * @property string $so_quantity_invoiced
 * @property int|null $res_service_staff_id
 * @property string|null $res_line_order_status
 * @property int|null $parent_sell_line_id
 * @property string $children_type Type of children for the parent, like modifier or combo
 * @property int|null $sub_unit_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\TaxRate|null $line_tax
 * @property-read \App\PurchaseLine|null $lot_details
 * @property-read \Illuminate\Database\Eloquent\Collection|TransactionSellLine[] $modifiers
 * @property-read int|null $modifiers_count
 * @property-read \App\Product $product
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\TransactionSellLinesPurchaseLines[] $sell_line_purchase_lines
 * @property-read int|null $sell_line_purchase_lines_count
 * @property-read \App\User|null $service_staff
 * @property-read TransactionSellLine|null $so_line
 * @property-read \App\Unit|null $sub_unit
 * @property-read \App\Transaction $transaction
 * @property-read \App\Variation $variations
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Warranty[] $warranties
 * @property-read int|null $warranties_count
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionSellLine newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionSellLine newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionSellLine query()
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionSellLine whereChildrenType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionSellLine whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionSellLine whereDiscountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionSellLine whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionSellLine whereItemTax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionSellLine whereLineDiscountAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionSellLine whereLineDiscountType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionSellLine whereLotNoLineId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionSellLine whereParentSellLineId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionSellLine whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionSellLine whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionSellLine whereQuantityReturned($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionSellLine whereResLineOrderStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionSellLine whereResServiceStaffId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionSellLine whereSecondaryUnitQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionSellLine whereSellLineNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionSellLine whereSoLineId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionSellLine whereSoQuantityInvoiced($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionSellLine whereSubUnitId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionSellLine whereTaxId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionSellLine whereTransactionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionSellLine whereUnitPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionSellLine whereUnitPriceBeforeDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionSellLine whereUnitPriceIncTax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionSellLine whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionSellLine whereVariationId($value)
 * @mixin \Eloquent
 */
class TransactionSellLine extends Model
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

    public function modifiers()
    {
        return $this->hasMany(\App\TransactionSellLine::class, 'parent_sell_line_id')
            ->where('children_type', 'modifier');
    }

    public function sell_line_purchase_lines()
    {
        return $this->hasMany(\App\TransactionSellLinesPurchaseLines::class, 'sell_line_id');
    }

    /**
     * Get the quantity column.
     *
     * @param  string  $value
     * @return float $value
     */
    public function getQuantityAttribute($value)
    {
        return (float)$value;
    }

    public function lot_details()
    {
        return $this->belongsTo(\App\PurchaseLine::class, 'lot_no_line_id');
    }

    public function get_discount_amount()
    {
        $discount_amount = 0;
        if (!empty($this->line_discount_type) && !empty($this->line_discount_amount)) {
            if ($this->line_discount_type == 'fixed') {
                $discount_amount = $this->line_discount_amount;
            } elseif ($this->line_discount_type == 'percentage') {
                $discount_amount = ($this->unit_price_before_discount * $this->line_discount_amount) / 100;
            }
        }
        return $discount_amount;
    }

    /**
     * Get the unit associated with the purchase line.
     */
    public function sub_unit()
    {
        return $this->belongsTo(\App\Unit::class, 'sub_unit_id');
    }

    public function order_statuses()
    {
        $statuses = [
            'received',
            'cooked',
            'served'
        ];
    }

    public function service_staff()
    {
        return $this->belongsTo(\App\User::class, 'res_service_staff_id');
    }

    /**
     * The warranties that belong to the sell lines.
     */
    public function warranties()
    {
        return $this->belongsToMany('App\Warranty', 'sell_line_warranties', 'sell_line_id', 'warranty_id');
    }

    public function line_tax()
    {
        return $this->belongsTo(\App\TaxRate::class, 'tax_id');
    }

    public function so_line()
    {
        return $this->belongsTo(\App\TransactionSellLine::class, 'so_line_id');
    }
}
