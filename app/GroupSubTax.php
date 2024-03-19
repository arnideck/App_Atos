<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\GroupSubTax
 *
 * @property int $group_tax_id
 * @property int $tax_id
 * @property-read \App\TaxRate $tax_rate
 * @method static \Illuminate\Database\Eloquent\Builder|GroupSubTax newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GroupSubTax newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GroupSubTax query()
 * @method static \Illuminate\Database\Eloquent\Builder|GroupSubTax whereGroupTaxId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GroupSubTax whereTaxId($value)
 * @mixin \Eloquent
 */
class GroupSubTax extends Model
{
    public function tax_rate()
    {
        return $this->belongsTo(\App\TaxRate::class, 'group_tax_id');
    }
}
