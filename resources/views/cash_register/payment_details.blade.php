<div class="row">
    <div class="col-sm-12">
        <table class="table table-condensed">
            <tr>
                <th>@lang('lang_v1.payment_method')</th>
                <th>Entradas</th>
                <th>Saídas</th>
            </tr>
            <tr>
                <td>
                    @lang('cash_register.cash_in_hand'):
                </td>
                <td>
                    <span class="display_currency" data-currency_symbol="true">
                        {{ $register_details->cash_in_hand }}
                    </span>
                </td>
                <td>--</td>
            </tr>
            @if($register_details->total_cash_receipt_on_credit > 0)
                <tr>
                    <td>
                        Receb. Fiado no dinheiro: 
                    </td>
                    <td>
                        <span class="display_currency" data-currency_symbol="true">
                            {{ $register_details->total_cash_receipt_on_credit }}
                        </span>
                    </td>
                    <td>--</td>
                </tr>
            @endif
            @if($register_details->total_card_receipt_on_credit > 0)
                <tr>
                    <td>
                        Receb. Fiado no cartão: 
                    </td>
                    <td>
                        <span class="display_currency" data-currency_symbol="true">
                            {{ $register_details->total_card_receipt_on_credit }}
                        </span>
                    </td>
                    <td>--</td>
                </tr>
            @endif
            @if($register_details->total_cheque_receipt_on_credit > 0)
            <tr>
                <td>
                    Receb. Fiado no cheque: 
                </td>
                <td>
                    <span class="display_currency" data-currency_symbol="true">
                        {{ $register_details->total_cheque_receipt_on_credit }}
                    </span>
                </td>
                <td>--</td>
            </tr>
            @endif
            @if($register_details->total_bank_transfer_receipt_on_credit > 0)
                <tr>
                    <td>
                        Receb. Fiado por Trans. Banc/Pix: 
                    </td>
                    <td>
                        <span class="display_currency" data-currency_symbol="true">
                            {{ $register_details->total_bank_transfer_receipt_on_credit }}
                        </span>
                    </td>
                    <td>--</td>
                </tr>
            @endif
            @if($register_details->total_other_receipt_on_credit > 0)
                <tr>
                    <td>
                        Receb. Fiado por Outros: 
                    </td>
                    <td>
                        <span class="display_currency" data-currency_symbol="true">
                            {{ $register_details->total_other_receipt_on_credit }}
                        </span>
                    </td>
                    <td>--</td>
                </tr>
            @endif
            @if($register_details->total_other_receipt_on_custom_pay_1 > 0)
                <tr>
                    <td>
                        Receb. Fiado por {{ $payment_types['custom_pay_1'] }}:
                    </td>
                    <td>
                        <span class="display_currency" data-currency_symbol="true">
                            {{ $register_details->total_other_receipt_on_custom_pay_1 }}
                        </span>
                    </td>
                    <td>--</td>
                </tr>
            @endif
            @if($register_details->total_other_receipt_on_custom_pay_2 > 0)
                <tr>
                    <td>
                        Receb. Fiado por {{ $payment_types['custom_pay_2'] }}:
                    </td>
                    <td>
                        <span class="display_currency" data-currency_symbol="true">
                            {{ $register_details->total_other_receipt_on_custom_pay_2 }}
                        </span>
                    </td>
                    <td>--</td>
                </tr>
            @endif
            @if($register_details->total_other_receipt_on_custom_pay_3 > 0)
                <tr>
                    <td>
                        Receb. Fiado por {{ $payment_types['custom_pay_3'] }}:
                    </td>
                    <td>
                        <span class="display_currency" data-currency_symbol="true">
                            {{ $register_details->total_other_receipt_on_custom_pay_3 }}
                        </span>
                    </td>
                    <td>--</td>
                </tr>
            @endif
            @if($register_details->total_other_receipt_on_custom_pay_4 > 0)
                <tr>
                    <td>
                        Receb. Fiado por {{ $payment_types['custom_pay_4'] }}:
                    </td>
                    <td>
                        <span class="display_currency" data-currency_symbol="true">
                            {{ $register_details->total_other_receipt_on_custom_pay_4 }}
                        </span>
                    </td>
                    <td>--</td>
                </tr>
            @endif
            @if($register_details->total_other_receipt_on_custom_pay_5 > 0)
                <tr>
                    <td>
                        Receb. Fiado por {{ $payment_types['custom_pay_5'] }}:
                    </td>
                    <td>
                        <span class="display_currency" data-currency_symbol="true">
                            {{ $register_details->total_other_receipt_on_custom_pay_5 }}
                        </span>
                    </td>
                    <td>--</td>
                </tr>
            @endif
            @if($register_details->total_other_receipt_on_custom_pay_6 > 0)
                <tr>
                    <td>
                        Receb. Fiado por {{ $payment_types['custom_pay_6'] }}:
                    </td>
                    <td>
                        <span class="display_currency" data-currency_symbol="true">
                            {{ $register_details->total_other_receipt_on_custom_pay_6 }}
                        </span>
                    </td>
                    <td>--</td>
                </tr>
            @endif
            @if($register_details->total_other_receipt_on_custom_pay_7 > 0)
                <tr>
                    <td>
                        Receb. Fiado por {{ $payment_types['custom_pay_7'] }}:
                    </td>
                    <td>
                        <span class="display_currency" data-currency_symbol="true">
                            {{ $register_details->total_other_receipt_on_custom_pay_7 }}
                        </span>
                    </td>
                    <td>--</td>
                </tr>
            @endif
            <tr>
                <td>
                    @lang('cash_register.cash_payment'):
                    </th>
                <td>
                    <span class="display_currency" data-currency_symbol="true">{{ $register_details->total_cash }}</span>
                </td>
                <td>
                    <span class="display_currency"
                        data-currency_symbol="true">{{ $register_details->total_cash_expense }}</span>
                </td>
            </tr>
            <tr>
                <td>
                    @lang('cash_register.checque_payment'):
                </td>
                <td>
                    <span class="display_currency"
                        data-currency_symbol="true">{{ $register_details->total_cheque }}</span>
                </td>
                <td>
                    <span class="display_currency"
                        data-currency_symbol="true">{{ $register_details->total_cheque_expense }}</span>
                </td>
            </tr>
            <tr>
                <td>
                    @lang('cash_register.card_payment'):
                </td>
                <td>
                    <span class="display_currency"
                        data-currency_symbol="true">{{ $register_details->total_card }}</span>
                </td>
                <td>
                    <span class="display_currency"
                        data-currency_symbol="true">{{ $register_details->total_card_expense }}</span>
                </td>
            </tr>
            <tr>
                <td>
                    @lang('cash_register.bank_transfer'):
                </td>
                <td>
                    <span class="display_currency"
                        data-currency_symbol="true">{{ $register_details->total_bank_transfer }}</span>
                </td>
                <td>
                    <span class="display_currency"
                        data-currency_symbol="true">{{ $register_details->total_bank_transfer_expense }}</span>
                </td>
            </tr>
            <tr>
                <td>
                    @lang('lang_v1.advance_payment'):
                </td>
                <td>
                    <span class="display_currency"
                        data-currency_symbol="true">{{ $register_details->total_advance }}</span>
                </td>
                <td>
                    <span class="display_currency"
                        data-currency_symbol="true">{{ $register_details->total_advance_expense }}</span>
                </td>
            </tr>
            @if (array_key_exists('custom_pay_1', $payment_types) && $register_details->total_custom_pay_1 > 0)
                <tr>
                    <td>
                        {{ $payment_types['custom_pay_1'] }}:
                    </td>
                    <td>
                        <span class="display_currency"
                            data-currency_symbol="true">{{ $register_details->total_custom_pay_1 }}</span>
                    </td>
                    <td>
                        <span class="display_currency"
                            data-currency_symbol="true">{{ $register_details->total_custom_pay_1_expense }}</span>
                    </td>
                </tr>
            @endif
            @if (array_key_exists('custom_pay_2', $payment_types) && $register_details->total_custom_pay_2 > 0)
                <tr>
                    <td>
                        {{ $payment_types['custom_pay_2'] }}:
                    </td>
                    <td>
                        <span class="display_currency"
                            data-currency_symbol="true">{{ $register_details->total_custom_pay_2 }}</span>
                    </td>
                    <td>
                        <span class="display_currency"
                            data-currency_symbol="true">{{ $register_details->total_custom_pay_2_expense }}</span>
                    </td>
                </tr>
            @endif
            @if (array_key_exists('custom_pay_3', $payment_types) && $register_details->total_custom_pay_3 > 0)
                <tr>
                    <td>
                        {{ $payment_types['custom_pay_3'] }}:
                    </td>
                    <td>
                        <span class="display_currency"
                            data-currency_symbol="true">{{ $register_details->total_custom_pay_3 }}</span>
                    </td>
                    <td>
                        <span class="display_currency"
                            data-currency_symbol="true">{{ $register_details->total_custom_pay_3_expense }}</span>
                    </td>
                </tr>
            @endif
            @if (array_key_exists('custom_pay_4', $payment_types) && $register_details->total_custom_pay_4 > 0)
                <tr>
                    <td>
                        {{ $payment_types['custom_pay_4'] }}:
                    </td>
                    <td>
                        <span class="display_currency"
                            data-currency_symbol="true">{{ $register_details->total_custom_pay_4 }}</span>
                    </td>
                    <td>
                        <span class="display_currency"
                            data-currency_symbol="true">{{ $register_details->total_custom_pay_4_expense }}</span>
                    </td>
                </tr>
            @endif
            @if (array_key_exists('custom_pay_5', $payment_types) && $register_details->total_custom_pay_5 > 0)
                <tr>
                    <td>
                        {{ $payment_types['custom_pay_5'] }}:
                    </td>
                    <td>
                        <span class="display_currency"
                            data-currency_symbol="true">{{ $register_details->total_custom_pay_5 }}</span>
                    </td>
                    <td>
                        <span class="display_currency"
                            data-currency_symbol="true">{{ $register_details->total_custom_pay_5_expense }}</span>
                    </td>
                </tr>
            @endif
            @if (array_key_exists('custom_pay_6', $payment_types) && $register_details->total_custom_pay_6 > 0)
                <tr>
                    <td>
                        {{ $payment_types['custom_pay_6'] }}:
                    </td>
                    <td>
                        <span class="display_currency"
                            data-currency_symbol="true">{{ $register_details->total_custom_pay_6 }}</span>
                    </td>
                    <td>
                        <span class="display_currency"
                            data-currency_symbol="true">{{ $register_details->total_custom_pay_6_expense }}</span>
                    </td>
                </tr>
            @endif
            @if (array_key_exists('custom_pay_7', $payment_types) && $register_details->total_custom_pay_7 > 0)
                <tr>
                    <td>
                        {{ $payment_types['custom_pay_7'] }}:
                    </td>
                    <td>
                        <span class="display_currency"
                            data-currency_symbol="true">{{ $register_details->total_custom_pay_7 }}</span>
                    </td>
                    <td>
                        <span class="display_currency"
                            data-currency_symbol="true">{{ $register_details->total_custom_pay_7_expense }}</span>
                    </td>
                </tr>
            @endif

            <tr>
                <td>
                    @lang('cash_register.other_payments'):
                </td>
                <td>
                    <span class="display_currency"
                        data-currency_symbol="true">{{ $register_details->total_other }}</span>
                </td>
                <td>
                    <span class="display_currency"
                        data-currency_symbol="true">{{ $register_details->total_other_expense }}</span>
                </td>
            </tr>
        </table>
        <hr>
        <table class="table table-condensed">
            <tr>
                <td>
                    @lang('cash_register.total_sales'):
                </td>
                <td>
                    <span class="display_currency"
                        data-currency_symbol="true">{{ $register_details->total_sale }}</span>
                </td>
            </tr>
            <tr class="success">
                <th>
                    @lang('lang_v1.credit_sales'):
                </th>
                <td>
                    <b>
                        <span class="display_currency"data-currency_symbol="true">
                            {{ $details['transaction_details']->total_sales - $register_details->total_sale }}
                        </span>
                    </b>
                </td>
            </tr>
            <!--<tr class="success">
                <th>
                    @lang('cash_register.total_sales'):
                </th>
                <td>
                    <b>
                        <span class="display_currency" data-currency_symbol="true">{{ $details['transaction_details']->total_sales }}</span>
                    </b>
                </td>
            </tr> -->
            <tr class="success">
                <th>
                    @lang('lang_v1.total_payment')
                </th>
                <td>
                    <b>
                        <span class="display_currency" data-currency_symbol="true">
                            {{ $register_details->cash_in_hand + $register_details->total_cash + $register_details->total_cash_receipt_on_credit - $register_details->total_cash_refund }}
                        </span>
                    </b>
                </td>
            </tr>
            <tr class="success">
                <th>
                    Total de receb. do Fiado: 
                </th>
                <td>
                    <b><span class="display_currency" data-currency_symbol="true">
                        {{ $register_details->total_receipt_on_credit }}
                    </span></b>
                </td>
            </tr>
            <tr class="danger">
                <th>
                    Total de Saídas:
                </th>
                <td>
                    <b><span class="display_currency"
                            data-currency_symbol="true">{{ $register_details->total_expense }}</span></b>
                </td>
            </tr>
        </table>
    </div>
</div>

@include('cash_register.register_product_details')
