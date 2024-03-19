<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Barcode
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property float|null $width
 * @property float|null $height
 * @property float|null $paper_width
 * @property float|null $paper_height
 * @property float|null $top_margin
 * @property float|null $left_margin
 * @property float|null $row_distance
 * @property float|null $col_distance
 * @property int|null $stickers_in_one_row
 * @property int $is_default
 * @property int $is_continuous
 * @property int|null $stickers_in_one_sheet
 * @property int|null $business_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Barcode newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Barcode newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Barcode query()
 * @method static \Illuminate\Database\Eloquent\Builder|Barcode whereBusinessId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Barcode whereColDistance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Barcode whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Barcode whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Barcode whereHeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Barcode whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Barcode whereIsContinuous($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Barcode whereIsDefault($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Barcode whereLeftMargin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Barcode whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Barcode wherePaperHeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Barcode wherePaperWidth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Barcode whereRowDistance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Barcode whereStickersInOneRow($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Barcode whereStickersInOneSheet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Barcode whereTopMargin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Barcode whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Barcode whereWidth($value)
 * @mixin \Eloquent
 */
class Barcode extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];
}
