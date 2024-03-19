<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Transaction
 *
 * @property int $id
 * @property int $business_id
 * @property int|null $location_id
 * @property int|null $res_table_id fields to restaurant module
 * @property int|null $res_waiter_id fields to restaurant module
 * @property string|null $res_order_status
 * @property string|null $type
 * @property string|null $sub_type
 * @property string $status
 * @property string|null $sub_status
 * @property int $is_quotation
 * @property string|null $payment_status
 * @property string|null $adjustment_type
 * @property int|null $contact_id
 * @property int|null $customer_group_id used to add customer group while selling
 * @property string|null $invoice_no
 * @property string|null $ref_no
 * @property string|null $source
 * @property string|null $subscription_no
 * @property string|null $subscription_repeat_on
 * @property string $transaction_date
 * @property string $total_before_tax Total before the purchase/invoice tax, this includeds the indivisual product tax
 * @property int|null $tax_id
 * @property string $tax_amount
 * @property string|null $discount_type
 * @property string|null $discount_amount
 * @property int $rp_redeemed rp is the short form of reward points
 * @property string $rp_redeemed_amount rp is the short form of reward points
 * @property string|null $shipping_details
 * @property string|null $shipping_address
 * @property string|null $delivery_date
 * @property string|null $shipping_status
 * @property string|null $delivered_to
 * @property string $shipping_charges
 * @property string|null $shipping_custom_field_1
 * @property string|null $shipping_custom_field_2
 * @property string|null $shipping_custom_field_3
 * @property string|null $shipping_custom_field_4
 * @property string|null $shipping_custom_field_5
 * @property string|null $additional_notes
 * @property string|null $staff_note
 * @property int $is_export
 * @property array|null $export_custom_fields_info
 * @property string $round_off_amount Difference of rounded total and actual total
 * @property string|null $additional_expense_key_1
 * @property string $additional_expense_value_1
 * @property string|null $additional_expense_key_2
 * @property string $additional_expense_value_2
 * @property string|null $additional_expense_key_3
 * @property string $additional_expense_value_3
 * @property string|null $additional_expense_key_4
 * @property string $additional_expense_value_4
 * @property string $final_total
 * @property int|null $expense_category_id
 * @property int|null $expense_sub_category_id
 * @property int|null $expense_for
 * @property int|null $commission_agent
 * @property string|null $document
 * @property int $is_direct_sale
 * @property int $is_suspend
 * @property string $exchange_rate
 * @property string|null $total_amount_recovered Used for stock adjustment.
 * @property int|null $transfer_parent_id
 * @property int|null $return_parent_id
 * @property int|null $opening_stock_product_id
 * @property int $created_by
 * @property string|null $repair_completed_on
 * @property int|null $repair_warranty_id
 * @property int|null $repair_brand_id
 * @property int|null $repair_status_id
 * @property int|null $repair_model_id
 * @property int|null $repair_job_sheet_id
 * @property string|null $repair_defects
 * @property string|null $repair_serial_no
 * @property string|null $repair_checklist
 * @property string|null $repair_security_pwd
 * @property string|null $repair_security_pattern
 * @property string|null $repair_due_date
 * @property int|null $repair_device_id
 * @property int $repair_updates_notif
 * @property string|null $prefer_payment_method
 * @property int|null $prefer_payment_account
 * @property array|null $sales_order_ids
 * @property array|null $purchase_order_ids
 * @property string|null $custom_field_1
 * @property string|null $custom_field_2
 * @property string|null $custom_field_3
 * @property string|null $custom_field_4
 * @property int|null $import_batch
 * @property string|null $import_time
 * @property int|null $types_of_service_id
 * @property string|null $packing_charge
 * @property string|null $packing_charge_type
 * @property string|null $service_custom_field_1
 * @property string|null $service_custom_field_2
 * @property string|null $service_custom_field_3
 * @property string|null $service_custom_field_4
 * @property string|null $service_custom_field_5
 * @property string|null $service_custom_field_6
 * @property int $is_created_from_api
 * @property int $rp_earned rp is the short form of reward points
 * @property string|null $order_addresses
 * @property int $is_recurring
 * @property float|null $recur_interval
 * @property string|null $recur_interval_type
 * @property int|null $recur_repetitions
 * @property string|null $recur_stopped_on
 * @property int|null $recur_parent_id
 * @property string|null $invoice_token
 * @property int|null $pay_term_number
 * @property string|null $pay_term_type
 * @property int|null $selling_price_group_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Business $business
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\CashRegisterTransaction[] $cash_register_payments
 * @property-read int|null $cash_register_payments_count
 * @property-read \App\Contact|null $contact
 * @property-read mixed $document_name
 * @property-read mixed $document_path
 * @property-read mixed $due_date
 * @property-read mixed $log_properties
 * @property-read \App\BusinessLocation|null $location
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Media[] $media
 * @property-read int|null $media_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\TransactionPayment[] $payment_lines
 * @property-read int|null $payment_lines_count
 * @property-read \App\Account|null $preferredAccount
 * @property-read \App\SellingPriceGroup|null $price_group
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\PurchaseLine[] $purchase_lines
 * @property-read int|null $purchase_lines_count
 * @property-read \Illuminate\Database\Eloquent\Collection|Transaction[] $recurring_invoices
 * @property-read int|null $recurring_invoices_count
 * @property-read Transaction|null $recurring_parent
 * @property-read Transaction|null $return_parent
 * @property-read Transaction|null $return_parent_sell
 * @property-read \App\User|null $sale_commission_agent
 * @property-read \App\User $sales_person
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\TransactionSellLine[] $sell_lines
 * @property-read int|null $sell_lines_count
 * @property-read \App\User|null $service_staff
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\StockAdjustmentLine[] $stock_adjustment_lines
 * @property-read int|null $stock_adjustment_lines_count
 * @property-read \Illuminate\Database\Eloquent\Collection|Transaction[] $subscription_invoices
 * @property-read int|null $subscription_invoices_count
 * @property-read \App\Restaurant\ResTable|null $table
 * @property-read \App\TaxRate|null $tax
 * @property-read \App\User|null $transaction_for
 * @property-read \App\TypesOfService|null $types_of_service
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction overDue()
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction query()
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereAdditionalExpenseKey1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereAdditionalExpenseKey2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereAdditionalExpenseKey3($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereAdditionalExpenseKey4($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereAdditionalExpenseValue1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereAdditionalExpenseValue2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereAdditionalExpenseValue3($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereAdditionalExpenseValue4($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereAdditionalNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereAdjustmentType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereBusinessId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereCommissionAgent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereContactId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereCustomField1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereCustomField2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereCustomField3($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereCustomField4($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereCustomerGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereDeliveredTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereDeliveryDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereDiscountAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereDiscountType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereDocument($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereExchangeRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereExpenseCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereExpenseFor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereExpenseSubCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereExportCustomFieldsInfo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereFinalTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereImportBatch($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereImportTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereInvoiceNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereInvoiceToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereIsCreatedFromApi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereIsDirectSale($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereIsExport($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereIsQuotation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereIsRecurring($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereIsSuspend($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereLocationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereOpeningStockProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereOrderAddresses($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction wherePackingCharge($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction wherePackingChargeType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction wherePayTermNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction wherePayTermType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction wherePaymentStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction wherePreferPaymentAccount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction wherePreferPaymentMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction wherePurchaseOrderIds($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereRecurInterval($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereRecurIntervalType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereRecurParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereRecurRepetitions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereRecurStoppedOn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereRefNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereRepairBrandId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereRepairChecklist($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereRepairCompletedOn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereRepairDefects($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereRepairDeviceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereRepairDueDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereRepairJobSheetId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereRepairModelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereRepairSecurityPattern($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereRepairSecurityPwd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereRepairSerialNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereRepairStatusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereRepairUpdatesNotif($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereRepairWarrantyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereResOrderStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereResTableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereResWaiterId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereReturnParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereRoundOffAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereRpEarned($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereRpRedeemed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereRpRedeemedAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereSalesOrderIds($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereSellingPriceGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereServiceCustomField1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereServiceCustomField2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereServiceCustomField3($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereServiceCustomField4($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereServiceCustomField5($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereServiceCustomField6($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereShippingAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereShippingCharges($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereShippingCustomField1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereShippingCustomField2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereShippingCustomField3($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereShippingCustomField4($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereShippingCustomField5($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereShippingDetails($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereShippingStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereSource($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereStaffNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereSubStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereSubType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereSubscriptionNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereSubscriptionRepeatOn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereTaxAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereTaxId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereTotalAmountRecovered($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereTotalBeforeTax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereTransactionDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereTransferParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereTypesOfServiceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Transaction extends Model
{
    //Transaction types = ['purchase','sell','expense','stock_adjustment','sell_transfer','purchase_transfer','opening_stock','sell_return','opening_balance','purchase_return', 'payroll', 'expense_refund', 'sales_order', 'purchase_order']

    //Transaction status = ['received','pending','ordered','draft','final', 'in_transit', 'completed']

    
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'purchase_order_ids' => 'array',
        'sales_order_ids' => 'array',
        'export_custom_fields_info' => 'array',
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'transactions';
    
    public function purchase_lines()
    {
        return $this->hasMany(\App\PurchaseLine::class);
    }

    public function sell_lines()
    {
        return $this->hasMany(\App\TransactionSellLine::class);
    }

    public function contact()
    {
        return $this->belongsTo(\App\Contact::class, 'contact_id');
    }

    public function payment_lines()
    {
        return $this->hasMany(\App\TransactionPayment::class, 'transaction_id');
    }

    public function location()
    {
        return $this->belongsTo(\App\BusinessLocation::class, 'location_id');
    }

    public function business()
    {
        return $this->belongsTo(\App\Business::class, 'business_id');
    }

    public function tax()
    {
        return $this->belongsTo(\App\TaxRate::class, 'tax_id');
    }

    public function stock_adjustment_lines()
    {
        return $this->hasMany(\App\StockAdjustmentLine::class);
    }

    public function sales_person()
    {
        return $this->belongsTo(\App\User::class, 'created_by');
    }

    public function sale_commission_agent()
    {
        return $this->belongsTo(\App\User::class, 'commission_agent');
    }

    public function return_parent()
    {
        return $this->hasOne(\App\Transaction::class, 'return_parent_id');
    }

    public function return_parent_sell()
    {
        return $this->belongsTo(\App\Transaction::class, 'return_parent_id');
    }

    public function table()
    {
        return $this->belongsTo(\App\Restaurant\ResTable::class, 'res_table_id');
    }

    public function service_staff()
    {
        return $this->belongsTo(\App\User::class, 'res_waiter_id');
    }

    public function recurring_invoices()
    {
        return $this->hasMany(\App\Transaction::class, 'recur_parent_id');
    }

    public function recurring_parent()
    {
        return $this->hasOne(\App\Transaction::class, 'id', 'recur_parent_id');
    }

    public function price_group()
    {
        return $this->belongsTo(\App\SellingPriceGroup::class, 'selling_price_group_id');
    }

    public function types_of_service()
    {
        return $this->belongsTo(\App\TypesOfService::class, 'types_of_service_id');
    }

    /**
     * Retrieves documents path if exists
     */
    public function getDocumentPathAttribute()
    {
        $path = !empty($this->document) ? asset('/uploads/documents/' . $this->document) : null;
        
        return $path;
    }

    /**
     * Removes timestamp from document name
     */
    public function getDocumentNameAttribute()
    {
        $document_name = !empty(explode("_", $this->document, 2)[1]) ? explode("_", $this->document, 2)[1] : $this->document ;
        return $document_name;
    }

    public function subscription_invoices()
    {
        return $this->hasMany(\App\Transaction::class, 'recur_parent_id');
    }

    /**
     * Shipping address custom method
     */
    public function shipping_address($array = false)
    {
        $addresses = !empty($this->order_addresses) ? json_decode($this->order_addresses, true) : [];

        $shipping_address = [];

        if (!empty($addresses['shipping_address'])) {
            if (!empty($addresses['shipping_address']['shipping_name'])) {
                $shipping_address['name'] = $addresses['shipping_address']['shipping_name'];
            }
            if (!empty($addresses['shipping_address']['company'])) {
                $shipping_address['company'] = $addresses['shipping_address']['company'];
            }
            if (!empty($addresses['shipping_address']['shipping_address_line_1'])) {
                $shipping_address['address_line_1'] = $addresses['shipping_address']['shipping_address_line_1'];
            }
            if (!empty($addresses['shipping_address']['shipping_address_line_2'])) {
                $shipping_address['address_line_2'] = $addresses['shipping_address']['shipping_address_line_2'];
            }
            if (!empty($addresses['shipping_address']['shipping_city'])) {
                $shipping_address['city'] = $addresses['shipping_address']['shipping_city'];
            }
            if (!empty($addresses['shipping_address']['shipping_state'])) {
                $shipping_address['state'] = $addresses['shipping_address']['shipping_state'];
            }
            if (!empty($addresses['shipping_address']['shipping_country'])) {
                $shipping_address['country'] = $addresses['shipping_address']['shipping_country'];
            }
            if (!empty($addresses['shipping_address']['shipping_zip_code'])) {
                $shipping_address['zipcode'] = $addresses['shipping_address']['shipping_zip_code'];
            }
        }

        if ($array) {
            return $shipping_address;
        } else {
            return implode(', ', $shipping_address);
        }
    }

    /**
     * billing address custom method
     */
    public function billing_address($array = false)
    {
        $addresses = !empty($this->order_addresses) ? json_decode($this->order_addresses, true) : [];

        $billing_address = [];

        if (!empty($addresses['billing_address'])) {
            if (!empty($addresses['billing_address']['billing_name'])) {
                $billing_address['name'] = $addresses['billing_address']['billing_name'];
            }
            if (!empty($addresses['billing_address']['company'])) {
                $billing_address['company'] = $addresses['billing_address']['company'];
            }
            if (!empty($addresses['billing_address']['billing_address_line_1'])) {
                $billing_address['address_line_1'] = $addresses['billing_address']['billing_address_line_1'];
            }
            if (!empty($addresses['billing_address']['billing_address_line_2'])) {
                $billing_address['address_line_2'] = $addresses['billing_address']['billing_address_line_2'];
            }
            if (!empty($addresses['billing_address']['billing_city'])) {
                $billing_address['city'] = $addresses['billing_address']['billing_city'];
            }
            if (!empty($addresses['billing_address']['billing_state'])) {
                $billing_address['state'] = $addresses['billing_address']['billing_state'];
            }
            if (!empty($addresses['billing_address']['billing_country'])) {
                $billing_address['country'] = $addresses['billing_address']['billing_country'];
            }
            if (!empty($addresses['billing_address']['billing_zip_code'])) {
                $billing_address['zipcode'] = $addresses['billing_address']['billing_zip_code'];
            }
        }

        if ($array) {
            return $billing_address;
        } else {
            return implode(', ', $billing_address);
        }
    }

    public function cash_register_payments()
    {
        return $this->hasMany(\App\CashRegisterTransaction::class);
    }

    public function media()
    {
        return $this->morphMany(\App\Media::class, 'model');
    }

    public function transaction_for()
    {
        return $this->belongsTo(\App\User::class, 'expense_for');
    }

    /**
     * Returns preferred account for payment.
     * Used in download pdfs
     */
    public function preferredAccount()
    {
        return $this->belongsTo(\App\Account::class, 'prefer_payment_account');
    }
    
    /**
     * Returns the list of discount types.
     */
    public static function discountTypes()
    {
        return [
                'fixed' => __('lang_v1.fixed'),
                'percentage' => __('lang_v1.percentage')
            ];
    }

    public static function transactionTypes()
    {
        return  [
                'sell' => __('sale.sale'),
                'purchase' => __('lang_v1.purchase'),
                'sell_return' => __('lang_v1.sell_return'),
                'purchase_return' =>  __('lang_v1.purchase_return'),
                'opening_balance' => __('lang_v1.opening_balance'),
                'payment' => __('lang_v1.payment'),
                'ledger_discount' => __('lang_v1.ledger_discount')
            ];
    }

    public static function getPaymentStatus($transaction)
    {
        $payment_status = $transaction->payment_status;

        if (in_array($payment_status, ['partial', 'due']) && !empty($transaction->pay_term_number) && !empty($transaction->pay_term_type)) {
            $transaction_date = \Carbon::parse($transaction->transaction_date);
            $due_date = $transaction->pay_term_type == 'days' ? $transaction_date->addDays($transaction->pay_term_number) : $transaction_date->addMonths($transaction->pay_term_number);
            $now = \Carbon::now();
            if ($now->gt($due_date)) {
                $payment_status = $payment_status == 'due' ? 'overdue' : 'partial-overdue';
            }
        }

        return $payment_status;
    }

    /**
     * Due date custom attribute
     */
    public function getDueDateAttribute()
    {
        $transaction_date = \Carbon::parse($this->transaction_date);
        if (!empty($this->pay_term_type) && !empty($this->pay_term_number)) {
            $due_date = $this->pay_term_type == 'days' ? $transaction_date->addDays($this->pay_term_number) : $transaction_date->addMonths($this->pay_term_number);
        } else {
            $due_date = $transaction_date->addDays(0);
        }

        return $due_date;
    }

    public static function getSellStatuses()
    {
        return ['final' => __('sale.final'), 'draft' => __('sale.draft'), 'quotation' => __('lang_v1.quotation'), 'proforma' => __('lang_v1.proforma')];
    }

    /**
     * Attributes to be logged for activity
     */
    public function getLogPropertiesAttribute() {
        $properties = [];

        if (in_array($this->type, ['sell_transfer'])) {
            $properties = ['status'];
        } elseif (in_array($this->type, ['sell'])) {
            $properties = ['type', 'status', 'sub_status', 'shipping_status', 'payment_status', 'final_total'];
        } elseif (in_array($this->type, ['purchase'])) {
            $properties = ['type', 'status', 'payment_status', 'final_total'];
        } elseif (in_array($this->type, ['expense'])) {
            $properties = ['payment_status'];
        } elseif (in_array($this->type, ['sell_return'])) {
            $properties = ['type', 'payment_status', 'final_total'];
        } elseif (in_array($this->type, ['purchase_return'])) {
            $properties = ['type', 'payment_status', 'final_total'];
        }

        return $properties;
    }

    public function scopeOverDue($query)
    {
        return $query->whereIn('transactions.payment_status', ['due', 'partial'])
                    ->whereNotNull('transactions.pay_term_number')
                    ->whereNotNull('transactions.pay_term_type')
                    ->whereRaw("IF(transactions.pay_term_type='days', DATE_ADD(transactions.transaction_date, INTERVAL transactions.pay_term_number DAY) < CURDATE(), DATE_ADD(transactions.transaction_date, INTERVAL transactions.pay_term_number MONTH) < CURDATE())");
    }

    public static function sell_statuses()
    {
        return [
            'final' => __('sale.final'), 
            'draft' => __('sale.draft'), 
            'quotation' => __('lang_v1.quotation'), 
            'proforma' => __('lang_v1.proforma')
        ];
    }

    public static function sales_order_statuses($only_key_value = false)
    {
        if ($only_key_value) {
           return [
                'ordered' => __('lang_v1.ordered'),
                'partial' => __('lang_v1.partial'),
                'completed' => __('restaurant.completed')
            ];
        }
        return [
            'ordered' => [
                'label' => __('lang_v1.ordered'),
                'class' => 'bg-info'
            ],
            'partial' => [
                'label' => __('lang_v1.partial'),
                'class' => 'bg-yellow'
            ],
            'completed' => [
                'label' => __('restaurant.completed'),
                'class' => 'bg-green'
            ]
        ];
    }

    public function salesOrders()
    {
        $sales_orders = null;
        if (!empty($this->sales_order_ids)) {
            $sales_orders = Transaction::where('business_id', $this->business_id)
                                ->where('type', 'sales_order')
                                ->whereIn('id', $this->sales_order_ids)
                                ->get();
        }
        
        return $sales_orders;
    }
}
