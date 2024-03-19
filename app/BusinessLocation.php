<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;
use App\SellingPriceGroup;
use App\Variation;

/**
 * App\BusinessLocation
 *
 * @property int $id
 * @property int $business_id
 * @property string|null $location_id
 * @property string $name
 * @property string|null $landmark
 * @property string $country
 * @property string $state
 * @property string $city
 * @property string $zip_code
 * @property int $invoice_scheme_id
 * @property int $invoice_layout_id
 * @property int|null $sale_invoice_layout_id
 * @property int|null $selling_price_group_id
 * @property int|null $print_receipt_on_invoice
 * @property string $receipt_printer_type
 * @property int|null $printer_id
 * @property string|null $mobile
 * @property string|null $alternate_number
 * @property string|null $email
 * @property string|null $website
 * @property array|null $featured_products
 * @property int $is_active
 * @property string|null $default_payment_accounts
 * @property string|null $custom_field1
 * @property string|null $custom_field2
 * @property string|null $custom_field3
 * @property string|null $custom_field4
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $location_address
 * @property-read SellingPriceGroup|null $price_group
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessLocation active()
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessLocation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessLocation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessLocation query()
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessLocation whereAlternateNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessLocation whereBusinessId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessLocation whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessLocation whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessLocation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessLocation whereCustomField1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessLocation whereCustomField2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessLocation whereCustomField3($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessLocation whereCustomField4($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessLocation whereDefaultPaymentAccounts($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessLocation whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessLocation whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessLocation whereFeaturedProducts($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessLocation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessLocation whereInvoiceLayoutId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessLocation whereInvoiceSchemeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessLocation whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessLocation whereLandmark($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessLocation whereLocationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessLocation whereMobile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessLocation whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessLocation wherePrintReceiptOnInvoice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessLocation wherePrinterId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessLocation whereReceiptPrinterType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessLocation whereSaleInvoiceLayoutId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessLocation whereSellingPriceGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessLocation whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessLocation whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessLocation whereWebsite($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessLocation whereZipCode($value)
 * @mixin \Eloquent
 */
class BusinessLocation extends Model
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
        'featured_products' => 'array'
    ];

    /**
     * Return list of locations for a business
     *
     * @param int $business_id
     * @param boolean $show_all = false
     * @param array $receipt_printer_type_attribute =
     *
     * @return array
     */
    public static function forDropdown($business_id, $show_all = false, $receipt_printer_type_attribute = false, $append_id = true, $check_permission = true)
    {
        $query = BusinessLocation::where('business_id', $business_id)->Active();

        if ($check_permission) {
            $permitted_locations = auth()->user()->permitted_locations();
            if ($permitted_locations != 'all') {
                $query->whereIn('id', $permitted_locations);
            }
        }
        

        if ($append_id) {
            $query->select(
                DB::raw("IF(location_id IS NULL OR location_id='', name, CONCAT(name, ' (', location_id, ')')) AS name"),
                'id',
                'receipt_printer_type',
                'selling_price_group_id',
                'default_payment_accounts',
                'invoice_scheme_id'
            );
        }

        $result = $query->get();

        $locations = $result->pluck('name', 'id');

        $price_groups = SellingPriceGroup::forDropdown($business_id);

        if ($show_all) {
            $locations->prepend(__('report.all_locations'), '');
        }

        if ($receipt_printer_type_attribute) {
            $attributes = collect($result)->mapWithKeys(function ($item) use ($price_groups) {
                $default_payment_accounts = json_decode($item->default_payment_accounts, true);
                $default_payment_accounts['advance'] = [
                    'is_enabled' => 1,
                    'account' => null
                ];
                return [$item->id => [
                            'data-receipt_printer_type' => $item->receipt_printer_type,
                            'data-default_price_group' => !empty($item->selling_price_group_id) && array_key_exists($item->selling_price_group_id, $price_groups) ? $item->selling_price_group_id : null,
                            'data-default_payment_accounts' => json_encode($default_payment_accounts),
                            'data-default_invoice_scheme_id' => $item->invoice_scheme_id
                        ]
                    ];
            })->all();

            return ['locations' => $locations, 'attributes' => $attributes];
        } else {
            return $locations;
        }
    }

    public function price_group()
    {
        return $this->belongsTo(\App\SellingPriceGroup::class, 'selling_price_group_id');
    }

    /**
     * Scope a query to only include active location.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    /**
     * Get the featured products.
     *
     * @return array/object
     */
    public function getFeaturedProducts($is_array = false, $check_location = true)
    {

        if (empty($this->featured_products)) {
            return [];
        }
        $query = Variation::whereIn('variations.id', $this->featured_products)
                                    ->join('product_locations as pl', 'pl.product_id', '=', 'variations.product_id')
                                    ->join('products as p', 'p.id', '=', 'variations.product_id')
                                    ->where('p.not_for_selling', 0)
                                    ->with(['product_variation', 'product', 'media'])
                                    ->select('variations.*');

        if ($check_location) {
            $query->where('pl.location_id', $this->id);
        }
        $featured_products = $query->get();
        if ($is_array) {
            $array = [];
            foreach ($featured_products as $featured_product) {
                $array[$featured_product->id] = $featured_product->full_name;
            }
            return $array;
        }
        return $featured_products;
    }

    public function getLocationAddressAttribute() 
    {
        $location = $this;
        $address_line_1 = [];
        if (!empty($location->landmark)) {
            $address_line_1[] = $location->landmark;
        }
        if (!empty($location->city)) {
            $address_line_1[] = $location->city;
        }
        if (!empty($location->state)) {
            $address_line_1[] = $location->state;
        }
        if (!empty($location->zip_code)) {
            $address_line_1[] = $location->zip_code;
        }
        $address = implode(', ', $address_line_1);
        $address_line_2 = [];
        if (!empty($location->country)) {
            $address_line_2[] = $location->country;
        }
        $address .= '<br>';
        $address .= implode(', ', $address_line_2);

        return $address;
    }
}
