<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\TaxRate
 *
 * @property int $id
 * @property int $business_id
 * @property string $name
 * @property float $amount
 * @property int $is_tax_group
 * @property int $for_tax_group
 * @property int $created_by
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|TaxRate[] $sub_taxes
 * @property-read int|null $sub_taxes_count
 * @method static \Illuminate\Database\Eloquent\Builder|TaxRate excludeForTaxGroup()
 * @method static \Illuminate\Database\Eloquent\Builder|TaxRate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TaxRate newQuery()
 * @method static \Illuminate\Database\Query\Builder|TaxRate onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|TaxRate query()
 * @method static \Illuminate\Database\Eloquent\Builder|TaxRate whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TaxRate whereBusinessId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TaxRate whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TaxRate whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TaxRate whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TaxRate whereForTaxGroup($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TaxRate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TaxRate whereIsTaxGroup($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TaxRate whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TaxRate whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|TaxRate withTrashed()
 * @method static \Illuminate\Database\Query\Builder|TaxRate withoutTrashed()
 * @mixin \Eloquent
 */
class TaxRate extends Model
{
    use SoftDeletes;
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    
    
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * Return list of tax rate dropdown for a business
     *
     * @param $business_id int
     * @param $prepend_none = true (boolean)
     * @param $include_attributes = false (boolean)
     *
     * @return array['tax_rates', 'attributes']
     */
    public static function forBusinessDropdown(
        $business_id,
        $prepend_none = true,
        $include_attributes = false,
        $exclude_for_tax_group = true
    ) {
        $all_taxes = TaxRate::where('business_id', $business_id);

        if ($exclude_for_tax_group) {
            $all_taxes->ExcludeForTaxGroup();
        }
        $result = $all_taxes->get();
        $tax_rates = $result->pluck('name', 'id');

        //Prepend none
        if ($prepend_none) {
            $tax_rates = $tax_rates->prepend(__('lang_v1.none'), '');
        }

        //Add tax attributes
        $tax_attributes = null;
        if ($include_attributes) {
            $tax_attributes = collect($result)->mapWithKeys(function ($item) {
                return [$item->id => ['data-rate' => $item->amount]];
            })->all();
        }

        $output = ['tax_rates' => $tax_rates, 'attributes' => $tax_attributes];
        return $output;
    }

    /**
     * Return list of tax rate for a business
     *
     * @return array
     */
    public static function forBusiness($business_id)
    {
        $tax_rates = TaxRate::where('business_id', $business_id)
                        ->select(['id', 'name', 'amount'])
                        ->get()
                        ->toArray();

        return $tax_rates;
    }

    /**
     * Return list of tax rates associated with the group_tax
     *
     * @return object
     */
    public function sub_taxes()
    {
        return $this->belongsToMany(\App\TaxRate::class, 'group_sub_taxes', 'group_tax_id', 'tax_id');
    }

    /**
     * Return list of group taxes for a business
     *
     * @return array
     */
    public static function groupTaxes($business_id)
    {
        $tax_rates = TaxRate::where('business_id', $business_id)
                        ->where('is_tax_group', 1)
                        ->with(['sub_taxes'])
                        ->get();

        return $tax_rates;
    }

    public function scopeExcludeForTaxGroup($query)
    {
        return $query->where('for_tax_group', 0);
    }
}
