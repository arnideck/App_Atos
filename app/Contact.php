<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Notifications\Notifiable;

/**
 * App\Contact
 *
 * @property int $id
 * @property int $business_id
 * @property string $type
 * @property string|null $supplier_business_name
 * @property string|null $name
 * @property string|null $prefix
 * @property string|null $first_name
 * @property string|null $middle_name
 * @property string|null $last_name
 * @property string|null $email
 * @property string|null $contact_id
 * @property string $contact_status
 * @property string|null $tax_number
 * @property string|null $city
 * @property string|null $state
 * @property string|null $country
 * @property string|null $address_line_1
 * @property string|null $address_line_2
 * @property string|null $zip_code
 * @property string|null $dob
 * @property string $mobile
 * @property string|null $landline
 * @property string|null $alternate_number
 * @property int|null $pay_term_number
 * @property string|null $pay_term_type
 * @property string|null $credit_limit
 * @property int $created_by
 * @property string $balance
 * @property int $total_rp rp is the short form of reward points
 * @property int $total_rp_used rp is the short form of reward points
 * @property int $total_rp_expired rp is the short form of reward points
 * @property int $is_default
 * @property string|null $shipping_address
 * @property array|null $shipping_custom_field_details
 * @property int $is_export
 * @property string|null $export_custom_field_1
 * @property string|null $export_custom_field_2
 * @property string|null $export_custom_field_3
 * @property string|null $export_custom_field_4
 * @property string|null $export_custom_field_5
 * @property string|null $export_custom_field_6
 * @property string|null $position
 * @property int|null $customer_group_id
 * @property string|null $custom_field1
 * @property string|null $custom_field2
 * @property string|null $custom_field3
 * @property string|null $custom_field4
 * @property string|null $custom_field5
 * @property string|null $custom_field6
 * @property string|null $custom_field7
 * @property string|null $custom_field8
 * @property string|null $custom_field9
 * @property string|null $custom_field10
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Business $business
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\DocumentAndNote[] $documentsAndnote
 * @property-read int|null $documents_andnote_count
 * @property-read mixed $contact_address_array
 * @property-read mixed $contact_address
 * @property-read mixed $full_name
 * @property-read mixed $full_name_with_business
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\User[] $userHavingAccess
 * @property-read int|null $user_having_access_count
 * @method static \Illuminate\Database\Eloquent\Builder|Contact active()
 * @method static \Illuminate\Database\Eloquent\Builder|Contact newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Contact newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Contact onlyCustomers()
 * @method static \Illuminate\Database\Eloquent\Builder|Contact onlyOwnContact()
 * @method static \Illuminate\Database\Eloquent\Builder|Contact onlySuppliers()
 * @method static \Illuminate\Database\Query\Builder|Contact onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Contact query()
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereAddressLine1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereAddressLine2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereAlternateNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereBalance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereBusinessId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereContactId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereContactStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereCreditLimit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereCustomField1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereCustomField10($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereCustomField2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereCustomField3($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereCustomField4($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereCustomField5($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereCustomField6($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereCustomField7($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereCustomField8($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereCustomField9($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereCustomerGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereDob($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereExportCustomField1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereExportCustomField2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereExportCustomField3($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereExportCustomField4($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereExportCustomField5($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereExportCustomField6($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereIsDefault($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereIsExport($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereLandline($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereMiddleName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereMobile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact wherePayTermNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact wherePayTermType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact wherePrefix($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereShippingAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereShippingCustomFieldDetails($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereSupplierBusinessName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereTaxNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereTotalRp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereTotalRpExpired($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereTotalRpUsed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereZipCode($value)
 * @method static \Illuminate\Database\Query\Builder|Contact withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Contact withoutTrashed()
 * @mixin \Eloquent
 */
class Contact extends Authenticatable
{
    use Notifiable;

    use SoftDeletes;

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
        'shipping_custom_field_details' => 'array',
    ];
    

    /**
    * Get the business that owns the user.
    */
    public function business()
    {
        return $this->belongsTo(\App\Business::class);
    }

    public function scopeActive($query)
    {
        return $query->where('contacts.contact_status', 'active');
    }

    /**
    * Filters only own created suppliers or has access to the supplier
    */
    public function scopeOnlySuppliers($query)
    {
        if (!auth()->user()->can('supplier.view') && !auth()->user()->can('supplier.view_own')) {
            abort(403, 'Unauthorized action.');
        }

        $query->whereIn('contacts.type', ['supplier', 'both']);

        if (auth()->check() && !auth()->user()->can('supplier.view') && auth()->user()->can('supplier.view_own')) {
            $query->leftjoin('user_contact_access AS ucas', 'contacts.id', 'ucas.contact_id');
            $query->where( function($q){
                $user_id = auth()->user()->id;
                $q->where('contacts.created_by', $user_id)
                    ->orWhere('ucas.user_id', $user_id);
            });
        }

        return $query;
    }

    /**
    * Filters only own created customers or has access to the customer
    */
    public function scopeOnlyCustomers($query)
    {
        if (!auth()->user()->can('customer.view') && !auth()->user()->can('customer.view_own')) {
            abort(403, 'Unauthorized action.');
        }
            
        $query->whereIn('contacts.type', ['customer', 'both']);

        if (auth()->check() && !auth()->user()->can('customer.view') && auth()->user()->can('customer.view_own')) {
            $query->leftjoin('user_contact_access AS ucas', 'contacts.id', 'ucas.contact_id');
            $query->where( function($q){
                $user_id = auth()->user()->id;
                $q->where('contacts.created_by', $user_id)
                    ->orWhere('ucas.user_id', $user_id);
            });
        }
        return $query;
    }

    /**
    * Filters only own created contact or has access to the contact
    */
    public function scopeOnlyOwnContact($query)
    {
        $query->leftjoin('user_contact_access AS ucas', 'contacts.id', 'ucas.contact_id');
        $query->where( function($q){
            $user_id = auth()->user()->id;
            $q->where('contacts.created_by', $user_id)
                ->orWhere('ucas.user_id', $user_id);
        });
        return $query;
    }

    /**
     * Get all of the contacts's notes & documents.
     */
    public function documentsAndnote()
    {
        return $this->morphMany('App\DocumentAndNote', 'notable');
    }

    /**
     * Return list of contact dropdown for a business
     *
     * @param $business_id int
     * @param $exclude_default = false (boolean)
     * @param $prepend_none = true (boolean)
     *
     * @return array users
     */
    public static function contactDropdown($business_id, $exclude_default = false, $prepend_none = true, $append_id = true)
    {
        $query = Contact::where('business_id', $business_id)
                    ->where('type', '!=', 'lead')
                    ->active();
                    
        if ($exclude_default) {
            $query->where('is_default', 0);
        }

        if ($append_id) {
            $query->select(
                DB::raw("IF(contacts.contact_id IS NULL OR contacts.contact_id='', name, CONCAT(name, ' - ', COALESCE(supplier_business_name, ''), '(', contacts.contact_id, ')')) AS supplier"),
                'contacts.id'
                    );
        } else {
            $query->select(
                'contacts.id',
                DB::raw("IF (supplier_business_name IS not null, CONCAT(name, ' (', supplier_business_name, ')'), name) as supplier")
            );
        }
        
        if (auth()->check() && !auth()->user()->can('supplier.view') && auth()->user()->can('supplier.view_own')) {
            $query->leftjoin('user_contact_access AS ucas', 'contacts.id', 'ucas.contact_id');
            $query->where( function($q){
                $user_id = auth()->user()->id;
                $q->where('contacts.created_by', $user_id)
                    ->orWhere('ucas.user_id', $user_id);
            });
        }

        $contacts = $query->pluck('supplier', 'contacts.id');

        //Prepend none
        if ($prepend_none) {
            $contacts = $contacts->prepend(__('lang_v1.none'), '');
        }

        return $contacts;
    }

    /**
     * Return list of suppliers dropdown for a business
     *
     * @param $business_id int
     * @param $prepend_none = true (boolean)
     *
     * @return array users
     */
    public static function suppliersDropdown($business_id, $prepend_none = true, $append_id = true)
    {
        $all_contacts = Contact::where('contacts.business_id', $business_id)
                        ->whereIn('contacts.type', ['supplier', 'both'])
                        ->active();

        if ($append_id) {
            $all_contacts->select(
                DB::raw("IF(contacts.contact_id IS NULL OR contacts.contact_id='', name, CONCAT(contacts.name, ' - ', COALESCE(contacts.supplier_business_name, ''), '(', contacts.contact_id, ')')) AS supplier"),
                'contacts.id'
                    );
        } else {
            $all_contacts->select(
                'contacts.id',
                DB::raw("CONCAT(contacts.name, ' (', contacts.supplier_business_name, ')') as supplier")
                );
        }

        if (auth()->check() && !auth()->user()->can('supplier.view') && auth()->user()->can('supplier.view_own')) {
            $all_contacts->onlyOwnContact();
        }

        $suppliers = $all_contacts->pluck('supplier', 'id');

        //Prepend none
        if ($prepend_none) {
            $suppliers = $suppliers->prepend(__('lang_v1.none'), '');
        }

        return $suppliers;
    }

    /**
     * Return list of customers dropdown for a business
     *
     * @param $business_id int
     * @param $prepend_none = true (boolean)
     *
     * @return array users
     */
    public static function customersDropdown($business_id, $prepend_none = true, $append_id = true)
    {
        $all_contacts = Contact::where('contacts.business_id', $business_id)
                        ->whereIn('contacts.type', ['customer', 'both'])
                        ->active();

        if ($append_id) {
            $all_contacts->select(
                DB::raw("IF(contacts.contact_id IS NULL OR contacts.contact_id='', CONCAT( COALESCE(contacts.supplier_business_name, ''), ' - ', contacts.name), CONCAT(COALESCE(contacts.supplier_business_name, ''), ' - ', name, ' (', contacts.contact_id, ')')) AS customer"),
                'contacts.id'
                );
        } else {
            $all_contacts->select('contacts.id', DB::raw("contacts.name as customer"));
        }

        if (auth()->check() && !auth()->user()->can('customer.view') && auth()->user()->can('customer.view_own')) {
            $all_contacts->onlyOwnContact();
        }

        $customers = $all_contacts->pluck('customer', 'id');

        //Prepend none
        if ($prepend_none) {
            $customers = $customers->prepend(__('lang_v1.none'), '');
        }

        return $customers;
    }

    /**
     * Return list of contact type.
     *
     * @param $prepend_all = false (boolean)
     * @return array
     */
    public static function typeDropdown($prepend_all = false)
    {
        $types = [];

        if ($prepend_all) {
            $types[''] = __('lang_v1.all');
        }

        $types['customer'] = __('report.customer');
        $types['supplier'] = __('report.supplier');
        $types['both'] = __('lang_v1.both_supplier_customer');

        return $types;
    }

    /**
     * Return list of contact type by permissions.
     *
     * @return array
     */
    public static function getContactTypes()
    {
        $types = [];
        if (auth()->check() && auth()->user()->can('supplier.create')) {
            $types['supplier'] = __('report.supplier');
        }
        if (auth()->check() && auth()->user()->can('customer.create')) {
            $types['customer'] = __('report.customer');
        }
        if (auth()->check() && auth()->user()->can('supplier.create') && auth()->user()->can('customer.create')) {
            $types['both'] = __('lang_v1.both_supplier_customer');
        }

        return $types;
    }

    public function getContactAddressAttribute()
    {
        $address_array = [];
        if (!empty($this->supplier_business_name)) {
            $address_array[] = $this->supplier_business_name;
        }
        if (!empty($this->name)) {
            $address_array[] = !empty($this->supplier_business_name) ? '<br>' . $this->name : $this->name;
        }
        if (!empty($this->address_line_1)) {
            $address_array[] = '<br>' . $this->address_line_1;
        }
        if (!empty($this->address_line_2)) {
            $address_array[] =  '<br>' . $this->address_line_2;
        }
        if (!empty($this->city)) {
            $address_array[] = '<br>' . $this->city;
        }
        if (!empty($this->state)) {
            $address_array[] = $this->state;
        }
        if (!empty($this->country)) {
            $address_array[] = $this->country;
        }

        $address = '';
        if (!empty($address_array)) {
            $address = implode(', ', $address_array);
        }
        if (!empty($this->zip_code)) {
            $address .= ',<br>' . $this->zip_code;
        }

        return $address;
    }

    public function getFullNameAttribute()
    {
        $name_array = [];
        if (!empty($this->prefix)) {
            $name_array[] = $this->prefix;
        }
        if (!empty($this->first_name)) {
            $name_array[] = $this->first_name;
        }
        if (!empty($this->middle_name)) {
            $name_array[] = $this->middle_name;
        }
        if (!empty($this->last_name)) {
            $name_array[] = $this->last_name;
        }
        
        return implode(' ', $name_array);
    }

    public function getFullNameWithBusinessAttribute()
    {
        $name_array = [];
        if (!empty($this->prefix)) {
            $name_array[] = $this->prefix;
        }
        if (!empty($this->first_name)) {
            $name_array[] = $this->first_name;
        }
        if (!empty($this->middle_name)) {
            $name_array[] = $this->middle_name;
        }
        if (!empty($this->last_name)) {
            $name_array[] = $this->last_name;
        }
        
        $full_name = implode(' ', $name_array);
        $business_name = !empty($this->supplier_business_name) ? $this->supplier_business_name . ', ' : '';

        return $business_name . $full_name;
    }

    public function getContactAddressArrayAttribute()
    {
        $address_array = [];
        if (!empty($this->address_line_1)) {
            $address_array[] = $this->address_line_1;
        }
        if (!empty($this->address_line_2)) {
            $address_array[] = $this->address_line_2;
        }
        if (!empty($this->city)) {
            $address_array[] = $this->city;
        }
        if (!empty($this->state)) {
            $address_array[] = $this->state;
        }
        if (!empty($this->country)) {
            $address_array[] = $this->country;
        }
        if (!empty($this->zip_code)) {
            $address_array[] = $this->zip_code;
        }

        return $address_array;
    }


    /**
     * All user who have access to this contact
     * Applied only when selected_contacts is true for a user in
     * users table
     */
    public function userHavingAccess()
    {
        return $this->belongsToMany(\App\User::class, 'user_contact_access');
    }
}
