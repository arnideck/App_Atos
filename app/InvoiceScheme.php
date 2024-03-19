<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\InvoiceScheme
 *
 * @property int $id
 * @property int $business_id
 * @property string $name
 * @property string $scheme_type
 * @property string|null $prefix
 * @property int|null $start_number
 * @property int $invoice_count
 * @property int|null $total_digits
 * @property int $is_default
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceScheme newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceScheme newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceScheme query()
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceScheme whereBusinessId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceScheme whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceScheme whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceScheme whereInvoiceCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceScheme whereIsDefault($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceScheme whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceScheme wherePrefix($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceScheme whereSchemeType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceScheme whereStartNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceScheme whereTotalDigits($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceScheme whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class InvoiceScheme extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * Returns list of invoice schemes in array format
     */
    public static function forDropdown($business_id)
    {
        $dropdown = InvoiceScheme::where('business_id', $business_id)
                                ->pluck('name', 'id');

        return $dropdown;
    }

    /**
     * Retrieves the default invoice scheme
     */
    public static function getDefault($business_id)
    {
        $default = InvoiceScheme::where('business_id', $business_id)
                                ->where('is_default', 1)
                                ->first();
        return $default;
    }
}
