<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Product
 *
 * @property int $id
 * @property string $name
 * @property int $business_id
 * @property string|null $type
 * @property int|null $unit_id
 * @property int|null $secondary_unit_id
 * @property array|null $sub_unit_ids
 * @property int|null $brand_id
 * @property int|null $category_id
 * @property int|null $sub_category_id
 * @property int|null $tax
 * @property string $tax_type
 * @property int $enable_stock
 * @property string|null $alert_quantity
 * @property string $sku
 * @property string|null $barcode_type
 * @property string|null $expiry_period
 * @property string|null $expiry_period_type
 * @property int $enable_sr_no
 * @property string|null $weight
 * @property string|null $product_custom_field1
 * @property string|null $product_custom_field2
 * @property string|null $product_custom_field3
 * @property string|null $product_custom_field4
 * @property string|null $image
 * @property string|null $product_description
 * @property int $created_by
 * @property int|null $warranty_id
 * @property int $is_inactive
 * @property int|null $repair_model_id
 * @property int $not_for_selling
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Brands|null $brand
 * @property-read \App\Category|null $category
 * @property-read string $image_path
 * @property-read string $image_url
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Media[] $media
 * @property-read int|null $media_count
 * @property-read \Illuminate\Database\Eloquent\Collection|Product[] $modifier_products
 * @property-read int|null $modifier_products_count
 * @property-read \Illuminate\Database\Eloquent\Collection|Product[] $modifier_sets
 * @property-read int|null $modifier_sets_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\BusinessLocation[] $product_locations
 * @property-read int|null $product_locations_count
 * @property-read \App\TaxRate|null $product_tax
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\ProductVariation[] $product_variations
 * @property-read int|null $product_variations_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\PurchaseLine[] $purchase_lines
 * @property-read int|null $purchase_lines_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\ProductRack[] $rack_details
 * @property-read int|null $rack_details_count
 * @property-read \App\Unit|null $second_unit
 * @property-read \App\Category|null $sub_category
 * @property-read \App\Unit|null $unit
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Variation[] $variations
 * @property-read int|null $variations_count
 * @property-read \App\Warranty|null $warranty
 * @method static \Illuminate\Database\Eloquent\Builder|Product active()
 * @method static \Illuminate\Database\Eloquent\Builder|Product forLocation($location_id)
 * @method static \Illuminate\Database\Eloquent\Builder|Product inactive()
 * @method static \Illuminate\Database\Eloquent\Builder|Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product productForSales()
 * @method static \Illuminate\Database\Eloquent\Builder|Product productNotForSales()
 * @method static \Illuminate\Database\Eloquent\Builder|Product query()
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereAlertQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereBarcodeType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereBrandId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereBusinessId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereEnableSrNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereEnableStock($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereExpiryPeriod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereExpiryPeriodType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereIsInactive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereNotForSelling($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereProductCustomField1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereProductCustomField2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereProductCustomField3($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereProductCustomField4($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereProductDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereRepairModelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereSecondaryUnitId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereSku($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereSubCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereSubUnitIds($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereTax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereTaxType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereUnitId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereWarrantyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereWeight($value)
 * @mixin \Eloquent
 */
class Product extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    protected $appends = ['image_url'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'sub_unit_ids' => 'array',
    ];
    
    /**
     * Get the products image.
     *
     * @return string
     */
    public function getImageUrlAttribute()
    {
        if (!empty($this->image)) {
            $image_url = asset('/uploads/img/' . rawurlencode($this->image));
        } else {
            $image_url = asset('/img/default.png');
        }
        return $image_url;
    }

    /**
    * Get the products image path.
    *
    * @return string
    */
    public function getImagePathAttribute()
    {
        if (!empty($this->image)) {
            $image_path = public_path('uploads') . '/' . config('constants.product_img_path') . '/' . $this->image;
        } else {
            $image_path = null;
        }
        return $image_path;
    }

    public function product_variations()
    {
        return $this->hasMany(\App\ProductVariation::class);
    }
    
    /**
     * Get the brand associated with the product.
     */
    public function brand()
    {
        return $this->belongsTo(\App\Brands::class);
    }
    
    /**
    * Get the unit associated with the product.
    */
    public function unit()
    {
        return $this->belongsTo(\App\Unit::class);
    }

    /**
    * Get the unit associated with the product.
    */
    public function second_unit()
    {
        return $this->belongsTo(\App\Unit::class, 'secondary_unit_id');
    }

    /**
     * Get category associated with the product.
     */
    public function category()
    {
        return $this->belongsTo(\App\Category::class);
    }
    /**
     * Get sub-category associated with the product.
     */
    public function sub_category()
    {
        return $this->belongsTo(\App\Category::class, 'sub_category_id', 'id');
    }
    
    /**
     * Get the brand associated with the product.
     */
    public function product_tax()
    {
        return $this->belongsTo(\App\TaxRate::class, 'tax', 'id');
    }

    /**
     * Get the variations associated with the product.
     */
    public function variations()
    {
        return $this->hasMany(\App\Variation::class);
    }

    /**
     * If product type is modifier get products associated with it.
     */
    public function modifier_products()
    {
        return $this->belongsToMany(\App\Product::class, 'res_product_modifier_sets', 'modifier_set_id', 'product_id');
    }

    /**
     * If product type is modifier get products associated with it.
     */
    public function modifier_sets()
    {
        return $this->belongsToMany(\App\Product::class, 'res_product_modifier_sets', 'product_id', 'modifier_set_id');
    }

    /**
     * Get the purchases associated with the product.
     */
    public function purchase_lines()
    {
        return $this->hasMany(\App\PurchaseLine::class);
    }

    /**
     * Scope a query to only include active products.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('products.is_inactive', 0);
    }

    /**
     * Scope a query to only include inactive products.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeInactive($query)
    {
        return $query->where('products.is_inactive', 1);
    }

    /**
     * Scope a query to only include products for sales.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeProductForSales($query)
    {
        return $query->where('not_for_selling', 0);
    }

    /**
     * Scope a query to only include products not for sales.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeProductNotForSales($query)
    {
        return $query->where('not_for_selling', 1);
    }

    public function product_locations()
    {
        return $this->belongsToMany(\App\BusinessLocation::class, 'product_locations', 'product_id', 'location_id');
    }

    /**
     * Scope a query to only include products available for a location.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeForLocation($query, $location_id)
    {
        return $query->where(function ($q) use ($location_id) {
            $q->whereHas('product_locations', function ($query) use ($location_id) {
                $query->where('product_locations.location_id', $location_id);
            });
        });
    }

    /**
     * Get warranty associated with the product.
     */
    public function warranty()
    {
        return $this->belongsTo(\App\Warranty::class);
    }

    public function media()
    {
        return $this->morphMany(\App\Media::class, 'model');
    }

    public function rack_details()
    {
        return $this->hasMany(\App\ProductRack::class);
    }
}
