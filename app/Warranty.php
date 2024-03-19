<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Warranty
 *
 * @property int $id
 * @property string $name
 * @property int $business_id
 * @property string|null $description
 * @property int $duration
 * @property string $duration_type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read string $display_name
 * @method static \Illuminate\Database\Eloquent\Builder|Warranty newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Warranty newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Warranty query()
 * @method static \Illuminate\Database\Eloquent\Builder|Warranty whereBusinessId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Warranty whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Warranty whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Warranty whereDuration($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Warranty whereDurationType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Warranty whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Warranty whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Warranty whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Warranty extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    public static function forDropdown($business_id)
    {
        $warranties = Warranty::where('business_id', $business_id)
                            ->get();
        $dropdown = [];

        foreach ($warranties as $warranty) {
            $dropdown[$warranty->id] = $warranty->name . ' (' . $warranty->duration . ' ' . __('lang_v1.' . $warranty->duration_type) . ')';
        }
        
        return $dropdown;
    }

    /**
     * Get the display name.
     *
     * @return string
     */
    public function getDisplayNameAttribute()
    {
        $name = $this->name . ' (' . $this->duration . ' ' . __('lang_v1.' . $this->duration_type) . ')';
        return $name;
    }

    public function getEndDate($date)
    {
        $date_obj = \Carbon::parse($date);

        if ($this->duration_type == 'days') {
            $date_obj->addDays($this->duration);
        } elseif ($this->duration_type == 'months') {
            $date_obj->addMonths($this->duration);
        } elseif ($this->duration_type == 'years') {
            $date_obj->addYears($this->duration);
        }

        return $date_obj->toDateTimeString();
    }
}
