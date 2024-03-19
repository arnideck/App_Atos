<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Printer
 *
 * @property int $id
 * @property int $business_id
 * @property string $name
 * @property string $connection_type
 * @property string $capability_profile
 * @property string|null $char_per_line
 * @property string|null $ip_address
 * @property string|null $port
 * @property string|null $path
 * @property int $created_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Printer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Printer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Printer query()
 * @method static \Illuminate\Database\Eloquent\Builder|Printer whereBusinessId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Printer whereCapabilityProfile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Printer whereCharPerLine($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Printer whereConnectionType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Printer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Printer whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Printer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Printer whereIpAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Printer whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Printer wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Printer wherePort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Printer whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Printer extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    public static function capability_profiles()
    {
        $profiles = [
            'default' => 'Default',
            'simple' => 'Simple',
            'SP2000' => 'Star Branded',
            'TEP-200M' => 'Espon Tep',
            'P822D' => 'P822D'
        ];

        return $profiles;
    }

    public static function capability_profile_srt($profile)
    {
        $profiles = Printer::capability_profiles();

        return isset($profiles[$profile]) ? $profiles[$profile] : '';
    }

    public static function connection_types()
    {
        $types = [
            'network' => 'Network',
            'windows' => 'Windows',
            'linux' => 'Linux'
        ];

        return $types;
    }

    public static function connection_type_str($type)
    {
        $types = Printer::connection_types();

        return isset($types[$type]) ? $types[$type] : '';
    }

    /**
     * Return list of printers for a business
     *
     * @param int $business_id
     * @param boolean $show_select = true
     *
     * @return array
     */
    public static function forDropdown($business_id, $show_select = true)
    {
        $query = Printer::where('business_id', $business_id);

        $printers = $query->pluck('name', 'id');
        if ($show_select) {
            $printers->prepend(__('messages.please_select'), '');
        }
        return $printers;
    }
}
