<?php

namespace App\Utils;

use App\Barcode;

use App\Business;
use App\BusinessLocation;
use App\Contact;
use App\Currency;
use App\InvoiceLayout;
use App\InvoiceScheme;
use App\NotificationTemplate;
use App\Printer;
use App\Unit;
use App\User;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class BusinessUtil extends Util
{

    /**
     * Adds a default settings/resources for a new business
     *
     * @param int $business_id
     * @param int $user_id
     *
     * @return boolean
     */
    public function newBusinessDefaultResources($business_id, $user_id)
    {
        $user = User::find($user_id);

        //create Admin role and assign to user
        $role = Role::create([ 'name' => 'Admin#' . $business_id,
                            'business_id' => $business_id,
                            'guard_name' => 'web', 'is_default' => 1
                        ]);
        $user->assignRole($role->name);

        //Create Cashier role for a new business
        $cashier_role = Role::create([ 'name' => 'Caixa#' . $business_id,
                            'business_id' => $business_id,
                            'guard_name' => 'web'
                        ]);
        $cashier_role->syncPermissions(['sell.view', 'sell.create', 'sell.update', 'sell.delete', 'access_all_locations', 'view_cash_register', 'close_cash_register']);

        $business = Business::findOrFail($business_id);

        //Update reference count
        $ref_count = $this->setAndGetReferenceCount('contacts', $business_id);
        $contact_id = $this->generateReferenceNumber('contacts', $ref_count, $business_id);

        //Add Default/Walk-In Customer for new business
        $customer = [
                        'business_id' => $business_id,
                        'type' => 'customer',
                        'name' => 'Cliente Final',
                        'created_by' => $user_id,
                        'is_default' => 1,
                        'contact_id' => $contact_id,
                        'credit_limit' => 0
                    ];
        Contact::create($customer);

        //create default invoice setting for new business
        InvoiceScheme::create(['name' => 'Padrão',
                            'scheme_type' => 'blank',
                            'prefix' => 'VD',
                            'start_number' => 1,
                            'total_digits' => 6,
                            'is_default' => 1,
                            'business_id' => $business_id
                        ]);
        //create default invoice layour for new business
        InvoiceLayout::create([
                        'name' => 'Padrão',
                        'header_text' => '',
                        'invoice_no_prefix' => 'Fatura Nº',
                        'quotation_no_prefix' => 'Nº Orçamento',
                        'invoice_heading' => 'Venda',
                        'sub_heading_line1' => null,
                        'sub_heading_line2' => null,
                        'sub_heading_line3' => null,
                        'sub_heading_line4' => null,
                        'sub_heading_line5' => null,
                        'invoice_heading_not_paid' => 'no Crediário',
                        'invoice_heading_paid' => 'à vista',
                        'quotation_heading' => 'Consignado',
                        'sub_total_label' => 'Subtotal',
                        'discount_label' => 'Desconto',
                        'tax_label' => 'Imposto',
                        'total_label' => 'Total',
                        'round_off_label' => 'Arredondamento',
                        'total_due_label' => 'Saldo devedor',
                        'paid_label' => 'Total Pago',
                        'show_client_id' => '0',
                        'client_id_label' => null,
                        'client_tax_label' => null,
                        'date_label' => 'Data',
                        'date_time_format' => 'd/m/y H:i',
                        'show_time' => '1',
                        'show_brand' => '0',
                        'show_sku' => '0',
                        'show_cat_code' => '0',
                        'show_expiry' => '0',
                        'show_lot' => '0',
                        'show_image' => '0',
                        'show_sale_description' => '0',
                        'sales_person_label' => 'Atendente:',
                        'show_sales_person' => '1',
                        'table_product_label' => 'Produto',
                        'table_qty_label' => 'Qtde',
                        'table_unit_price_label' => 'Unitário',
                        'table_subtotal_label' => 'Subtotal',
                        'cat_code_label' => null,
                        'logo' => null,
                        'show_logo' => '0',
                        'show_business_name' => '0',
                        'show_location_name' => '0',
                        'show_landmark' => '0',
                        'show_city' => '0',
                        'show_state' => '0',
                        'show_zip_code' => '0',
                        'show_country' => '0',
                        'show_mobile_number' => '0',
                        'show_alternate_number' => '0',
                        'show_email' => '0',
                        'show_tax_1' => '0',
                        'show_tax_2' => '0',
                        'show_barcode' => '0',
                        'show_payments' => '1',
                        'show_customer' => '1',
                        'customer_label' => 'Cliente',
                        'show_reward_point' => '0',
                        'highlight_color' => '#000000',
                        'footer_text' => '',
                        'module_info' => '{&quot;repair&quot;:{&quot;repair_status_label&quot;:null,&quot;repair_warranty_label&quot;:null,&quot;brand_label&quot;:null,&quot;device_label&quot;:null,&quot;model_no_label&quot;:null,&quot;serial_no_label&quot;:null,&quot;defects_label&quot;:null,&quot;repair_checklist_label&quot;:null}}',
                        'common_settings' => '{&quot;due_date_label&quot;:&quot;Vencimento:&quot;,&quot;total_quantity_label&quot;:&quot;Qtde total de itens:&quot;,&quot;item_discount_label&quot;:null,&quot;num_to_word_format&quot;:&quot;international&quot;}',
                        'is_default' => 1,
                        'business_id' => $business_id,
                        'design' => 'slim2',
                        'cn_heading' => 'OBS:',
                        'cn_no_label' => 'Nº Nota',
                        'cn_amount_label' => 'Valor do Crédito',
                        'table_tax_headings' => null,
                        'show_previous_bal' => '0',
                        'prev_bal_label' => 'Total em aberto',
                        'change_return_label' => 'Troco',
                        'product_custom_fields' => null,
                        'contact_custom_fields' => null,
                        'location_custom_fields' => null
                    ]);

        //create default barcode setting for new business
        // Barcode::create(['name' => 'Default',
        //                 'description' => '',
        //                 'width' => 37.29,
        //                 'height' => 25.93,
        //                 'top_margin' => 5,
        //                 'left_margin' => 5,
        //                 'row_distance' => 1,
        //                 'col_distance' => 1,
        //                 'stickers_in_one_row' => 4,
        //                 'is_default' => 1,
        //                 'business_id' => $business_id
        //             ]);
        
        //Add Default Unit for new business
        $unit = [
                    'business_id' => $business_id,
                    'actual_name' => 'Unidades',
                    'short_name' => 'Und',
                    'allow_decimal' => 0,
                    'created_by' => $user_id
                ];
        Unit::create($unit);

        //Create default notification templates
        $notification_templates = NotificationTemplate::defaultNotificationTemplates($business_id);
        foreach ($notification_templates as $notification_template) {
            NotificationTemplate::create($notification_template);
        }

        return true;
    }

    /**
     * Gives a list of all currencies
     *
     * @return array
     */
    public function allCurrencies()
    {
        $currencies = Currency::select('id', DB::raw("concat(country, ' - ',currency, '(', code, ') ') as info"))
                ->orderBy('country')
                ->pluck('info', 'id');

        return $currencies;
    }

    /**
     * Gives a list of all timezone
     *
     * @return array
     */
    public function allTimeZones()
    {
        $datetime = new \DateTimeZone("EDT");

        $timezones = $datetime->listIdentifiers();
        $timezone_list = [];
        foreach ($timezones as $timezone) {
            $timezone_list[$timezone] = $timezone;
        }

        return $timezone_list;
    }

    /**
     * Gives a list of all accouting methods
     *
     * @return array
     */
    public function allAccountingMethods()
    {
        return [
            'fifo' => __('business.fifo'),
            'lifo' => __('business.lifo')
        ];
    }

    /**
     * Creates new business with default settings.
     *
     * @return array
     */
    public function createNewBusiness($business_details)
    {
        $business_details['sell_price_tax'] = 'excludes';

        $business_details['default_profit_percent'] = 45;
        
        $business_details['theme_color'] = 'blue';

        //Add POS shortcuts
        $business_details['keyboard_shortcuts'] = '{"pos":{"express_checkout":"ctrl+d","pay_n_ckeckout":"f3","draft":" ","cancel":"f4","edit_discount":"shift+d","edit_order_tax":" ","add_payment_row":"shift+p","finalize_payment":"enter","recent_product_quantity":"ins","add_new_product":"f2"}}';


        //Add prefixes
        $business_details['ref_no_prefixes'] = [
            'purchase' => 'CO',
            'stock_transfer' => 'TR',
            'stock_adjustment' => 'AJ',
            'sell_return' => 'CN',
            'expense' => 'DE',
            'contacts' => 'PE',
            'purchase_payment' => 'PC',
            'sell_payment' => 'PV',
            'business_location' => 'FL'
            ];

        //Disable inline tax editing
        $business_details['enable_inline_tax'] = 0;

        $business = Business::create_business($business_details);

        return $business;
    }

    /**
     * Gives details for a business
     *
     * @return object
     */
    public function getDetails($business_id)
    {
        $details = Business::
                        leftjoin('tax_rates AS TR', 'business.default_sales_tax', 'TR.id')
                        ->leftjoin('currencies AS cur', 'business.currency_id', 'cur.id')
                        ->select(
                            'business.*',
                            'cur.code as currency_code',
                            'cur.symbol as currency_symbol',
                            'thousand_separator',
                            'decimal_separator',
                            'TR.amount AS tax_calculation_amount',
                            'business.default_sales_discount'
                        )
                        ->where('business.id', $business_id)
                        ->first();

        return $details;
    }

    /**
     * Gives current financial year
     *
     * @return array
     */
    public function getCurrentFinancialYear($business_id)
    {
        $business = Business::where('id', $business_id)->first();
        $start_month = $business->fy_start_month;
        $end_month = $start_month -1;
        if ($start_month == 1) {
            $end_month = 12;
        }
        
        $start_year = date('Y');
        //if current month is less than start month change start year to last year
        if (date('n') < $start_month) {
            $start_year = $start_year - 1;
        }

        $end_year = date('Y');
        //if current month is greater than end month change end year to next year
        if (date('n') > $end_month) {
            $end_year = $start_year + 1;
        }
        $start_date = $start_year . '-' . str_pad($start_month, 2, 0, STR_PAD_LEFT) . '-01';
        $end_date = $end_year . '-' . str_pad($end_month, 2, 0, STR_PAD_LEFT) . '-01';
        $end_date = date('Y-m-t', strtotime($end_date));

        $output = [
                'start' => $start_date,
                'end' =>  $end_date
            ];
        return $output;
    }

    /**
     * Adds a new location to a business
     *
     * @param int $business_id
     * @param array $location_details
     * @param int $invoice_layout_id default null
     *
     * @return location object
     */
    public function addLocation($business_id, $location_details, $invoice_scheme_id = null, $invoice_layout_id = null)
    {
        if (empty($invoice_scheme_id)) {
            $layout = InvoiceLayout::where('is_default', 1)
                                    ->where('business_id', $business_id)
                                    ->first();
            $invoice_layout_id = $layout->id;
        }

        if (empty($invoice_scheme_id)) {
            $scheme = InvoiceScheme::where('is_default', 1)
                                    ->where('business_id', $business_id)
                                    ->first();
            $invoice_scheme_id = $scheme->id;
        }

        //Update reference count
        $ref_count = $this->setAndGetReferenceCount('business_location', $business_id);
        $location_id = $this->generateReferenceNumber('business_location', $ref_count, $business_id);

        //Enable all payment methods by default
        $payment_types = $this->payment_types();
        $location_payment_types = [];
        foreach ($payment_types as $key => $value) {
            $location_payment_types[$key] = [
                'is_enabled' => 1,
                'account' => null
            ];
        }
        $location = BusinessLocation::create(['business_id' => $business_id,
                            'name' => $location_details['name'],
                            'landmark' => $location_details['landmark'],
                            'city' => $location_details['city'],
                            'state' => $location_details['state'],
                            'zip_code' => $location_details['zip_code'],
                            'country' => $location_details['country'],
                            'invoice_scheme_id' => $invoice_scheme_id,
                            'invoice_layout_id' => $invoice_layout_id,
                            'sale_invoice_layout_id' => $invoice_layout_id,
                            'mobile' => !empty($location_details['mobile']) ? $location_details['mobile'] : '',
                            'alternate_number' => !empty($location_details['alternate_number']) ? $location_details['alternate_number'] : '',
                            'website' => !empty($location_details['website']) ? $location_details['website'] : '',
                            'email' => '',
                            'location_id' => $location_id,
                            'default_payment_accounts' => json_encode($location_payment_types)
                        ]);
        return $location;
    }

    /**
     * Return the invoice layout details
     *
     * @param int $business_id
     * @param array $location_details
     * @param array $layout_id = null
     *
     * @return location object
     */
    public function invoiceLayout($business_id, $layout_id = null)
    {
        $layout = null;
        if (!empty($layout_id)) {
            $layout = InvoiceLayout::find($layout_id);
        }
        
        //If layout is not found (deleted) then get the default layout for the business
        if (empty($layout)) {
            $layout = InvoiceLayout::where('business_id', $business_id)
                        ->where('is_default', 1)
                        ->first();
        }
        //$output = []
        return $layout;
    }

    /**
     * Return the printer configuration
     *
     * @param int $business_id
     * @param int $printer_id
     *
     * @return array
     */
    public function printerConfig($business_id, $printer_id)
    {
        $printer = Printer::where('business_id', $business_id)
                    ->find($printer_id);

        $output = [];

        if (!empty($printer)) {
            $output['connection_type'] = $printer->connection_type;
            $output['capability_profile'] = $printer->capability_profile;
            $output['char_per_line'] = $printer->char_per_line;
            $output['ip_address'] = $printer->ip_address;
            $output['port'] = $printer->port;
            $output['path'] = $printer->path;
            $output['server_url'] = $printer->server_url;
        }

        return $output;
    }

    /**
     * Return the date range for which editing of transaction for a business is allowed.
     *
     * @param int $business_id
     * @param char $edit_transaction_period
     *
     * @return array
     */
    public function editTransactionDateRange($business_id, $edit_transaction_period)
    {
        if (is_numeric($edit_transaction_period)) {
            return ['start' => \Carbon::today()
                                ->subDays($edit_transaction_period),
                    'end' => \Carbon::today()
                ];
        } elseif ($edit_transaction_period == 'fy') {
            //Editing allowed for current financial year
            return $this->getCurrentFinancialYear($business_id);
        }

        return false;
    }

    /**
     * Return the default setting for the pos screen.
     *
     * @return array
     */
     public function defaultPosSettings()
    {
        return ['disable_pay_checkout' => 0, 'disable_draft' => 1, 'disable_express_checkout' => 0, 'hide_product_suggestion' => 0, 'hide_recent_trans' => 0, 'disable_discount' => 0, 'disable_order_tax' => 1, 'is_pos_subtotal_editable' => 0];
    }

    /**
     * Return the default setting for the email.
     *
     * @return array
     */
    public function defaultEmailSettings()
    {
        return ['mail_host' => '', 'mail_port' => '', 'mail_username' => '', 'mail_password' => '', 'mail_encryption' => '', 'mail_from_address' => '', 'mail_from_name' => ''];
    }

    /**
     * Return the default setting for the email.
     *
     * @return array
     */
    public function defaultSmsSettings()
    {
        return ['url' => '', 'send_to_param_name' => 'to', 'msg_param_name' => 'text', 'request_method' => 'post', 'param_1' => '', 'param_val_1' => '', 'param_2' => '', 'param_val_2' => '','param_3' => '', 'param_val_3' => '','param_4' => '', 'param_val_4' => '','param_5' => '', 'param_val_5' => '', ];
    }
}
