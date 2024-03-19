<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\InvoiceLayout
 *
 * @property int $id
 * @property string $name
 * @property string|null $header_text
 * @property string|null $invoice_no_prefix
 * @property string|null $quotation_no_prefix
 * @property string|null $invoice_heading
 * @property string|null $sub_heading_line1
 * @property string|null $sub_heading_line2
 * @property string|null $sub_heading_line3
 * @property string|null $sub_heading_line4
 * @property string|null $sub_heading_line5
 * @property string|null $invoice_heading_not_paid
 * @property string|null $invoice_heading_paid
 * @property string|null $quotation_heading
 * @property string|null $sub_total_label
 * @property string|null $discount_label
 * @property string|null $tax_label
 * @property string|null $total_label
 * @property string|null $round_off_label
 * @property string|null $total_due_label
 * @property string|null $paid_label
 * @property int $show_client_id
 * @property string|null $client_id_label
 * @property string|null $client_tax_label
 * @property string|null $date_label
 * @property string|null $date_time_format
 * @property int $show_time
 * @property int $show_brand
 * @property int $show_sku
 * @property int $show_cat_code
 * @property int $show_expiry
 * @property int $show_lot
 * @property int $show_image
 * @property int $show_sale_description
 * @property string|null $sales_person_label
 * @property int $show_sales_person
 * @property string|null $table_product_label
 * @property string|null $table_qty_label
 * @property string|null $table_unit_price_label
 * @property string|null $table_subtotal_label
 * @property string|null $cat_code_label
 * @property string|null $logo
 * @property int $show_logo
 * @property int $show_business_name
 * @property int $show_location_name
 * @property int $show_landmark
 * @property int $show_city
 * @property int $show_state
 * @property int $show_zip_code
 * @property int $show_country
 * @property int $show_mobile_number
 * @property int $show_alternate_number
 * @property int $show_email
 * @property int $show_tax_1
 * @property int $show_tax_2
 * @property int $show_barcode
 * @property int $show_payments
 * @property int $show_customer
 * @property string|null $customer_label
 * @property string|null $commission_agent_label
 * @property int $show_commission_agent
 * @property int $show_reward_point
 * @property string|null $highlight_color
 * @property string|null $footer_text
 * @property string|null $module_info
 * @property array|null $common_settings
 * @property int $is_default
 * @property int $business_id
 * @property int $show_qr_code
 * @property array|null $qr_code_fields
 * @property string|null $design
 * @property string|null $cn_heading cn = credit note
 * @property string|null $cn_no_label
 * @property string|null $cn_amount_label
 * @property string|null $table_tax_headings
 * @property int $show_previous_bal
 * @property string|null $prev_bal_label
 * @property string|null $change_return_label
 * @property array|null $product_custom_fields
 * @property array|null $contact_custom_fields
 * @property array|null $location_custom_fields
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\BusinessLocation[] $locations
 * @property-read int|null $locations_count
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceLayout newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceLayout newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceLayout query()
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceLayout whereBusinessId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceLayout whereCatCodeLabel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceLayout whereChangeReturnLabel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceLayout whereClientIdLabel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceLayout whereClientTaxLabel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceLayout whereCnAmountLabel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceLayout whereCnHeading($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceLayout whereCnNoLabel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceLayout whereCommissionAgentLabel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceLayout whereCommonSettings($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceLayout whereContactCustomFields($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceLayout whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceLayout whereCustomerLabel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceLayout whereDateLabel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceLayout whereDateTimeFormat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceLayout whereDesign($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceLayout whereDiscountLabel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceLayout whereFooterText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceLayout whereHeaderText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceLayout whereHighlightColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceLayout whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceLayout whereInvoiceHeading($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceLayout whereInvoiceHeadingNotPaid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceLayout whereInvoiceHeadingPaid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceLayout whereInvoiceNoPrefix($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceLayout whereIsDefault($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceLayout whereLocationCustomFields($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceLayout whereLogo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceLayout whereModuleInfo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceLayout whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceLayout wherePaidLabel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceLayout wherePrevBalLabel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceLayout whereProductCustomFields($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceLayout whereQrCodeFields($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceLayout whereQuotationHeading($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceLayout whereQuotationNoPrefix($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceLayout whereRoundOffLabel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceLayout whereSalesPersonLabel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceLayout whereShowAlternateNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceLayout whereShowBarcode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceLayout whereShowBrand($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceLayout whereShowBusinessName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceLayout whereShowCatCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceLayout whereShowCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceLayout whereShowClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceLayout whereShowCommissionAgent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceLayout whereShowCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceLayout whereShowCustomer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceLayout whereShowEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceLayout whereShowExpiry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceLayout whereShowImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceLayout whereShowLandmark($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceLayout whereShowLocationName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceLayout whereShowLogo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceLayout whereShowLot($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceLayout whereShowMobileNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceLayout whereShowPayments($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceLayout whereShowPreviousBal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceLayout whereShowQrCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceLayout whereShowRewardPoint($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceLayout whereShowSaleDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceLayout whereShowSalesPerson($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceLayout whereShowSku($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceLayout whereShowState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceLayout whereShowTax1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceLayout whereShowTax2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceLayout whereShowTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceLayout whereShowZipCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceLayout whereSubHeadingLine1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceLayout whereSubHeadingLine2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceLayout whereSubHeadingLine3($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceLayout whereSubHeadingLine4($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceLayout whereSubHeadingLine5($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceLayout whereSubTotalLabel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceLayout whereTableProductLabel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceLayout whereTableQtyLabel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceLayout whereTableSubtotalLabel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceLayout whereTableTaxHeadings($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceLayout whereTableUnitPriceLabel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceLayout whereTaxLabel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceLayout whereTotalDueLabel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceLayout whereTotalLabel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceLayout whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class InvoiceLayout extends Model
{
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
        'product_custom_fields' => 'array',
        'contact_custom_fields' => 'array',
        'location_custom_fields' => 'array',
        'common_settings' => 'array',
        'qr_code_fields' => 'array',
    ];

    /**
     * Get the location associated with the invoice layout.
     */
    public function locations()
    {
        return $this->hasMany(\App\BusinessLocation::class);
    }

    /**
     * Return list of invoice layouts for a business
     *
     * @param int $business_id
     *
     * @return array
     */
    public static function forDropdown($business_id)
    {
        $layouts = InvoiceLayout::where('business_id', $business_id)
                    ->pluck('name', 'id');

        return $layouts;
    }
}
