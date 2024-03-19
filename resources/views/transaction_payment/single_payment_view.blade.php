<style>
    .row p {
        margin: 0px!important;
    }
</style>
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close no-print" data-dismiss="modal" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>
            <h4 class="modal-title no-print">
                @lang('lang_v1.view_payment')
                @if (!empty($single_payment_line->payment_ref_no))
                    ( @lang('purchase.ref_no'): {{ $single_payment_line->payment_ref_no }} )
                @endif
            </h4>
            <h4 class="modal-title visible-print-block">
                @if (!empty($single_payment_line->payment_ref_no))
                    @lang('purchase.ref_no'): {{ $single_payment_line->payment_ref_no }}
                @endif
            </h4>
        </div>

        <div class="modal-body">
            @if (!empty($transaction))
                <div class="row">
                    @if (in_array($transaction->type, ['purchase', 'purchase_return']))
                        <div class="col-xs-6">
                            @lang('purchase.supplier'):
                            <strong>{{ $transaction->contact->supplier_business_name }}</strong>
                            {{ $transaction->contact->name }}
                            {!! $transaction->contact->contact_address !!}
                            @if (!empty($transaction->contact->tax_number))
                                <br>@lang('contact.tax_no'): {{ $transaction->contact->tax_number }}
                            @endif
                            @if (!empty($transaction->contact->mobile))
                                <br>@lang('contact.mobile'): {{ $transaction->contact->mobile }}
                            @endif
                            @if (!empty($transaction->contact->email))
                                <br>@lang('business.email'): {{ $transaction->contact->email }}
                            @endif
                        </div>


                        <div class="col-xs-6">
                            @lang('business.business'):
                            <address>
                                <strong>{{ $transaction->business->name }}</strong>

                                @if (!empty($transaction->location))
                                    {{ $transaction->location->name }}
                                    @if (!empty($transaction->location->landmark))
                                        <br>{{ $transaction->location->landmark }}
                                    @endif
                                    @if (!empty($transaction->location->city) ||
                                        !empty($transaction->location->state) ||
                                        !empty($transaction->location->country))
                                        <br>{{ implode(',', array_filter([$transaction->location->city, $transaction->location->state, $transaction->location->country])) }}
                                    @endif
                                @endif

                                @if (!empty($transaction->business->tax_number_1))
                                    <br>{{ $transaction->business->tax_label_1 }}:
                                    {{ $transaction->business->tax_number_1 }}
                                @endif

                                @if (!empty($transaction->business->tax_number_2))
                                    <br>{{ $transaction->business->tax_label_2 }}:
                                    {{ $transaction->business->tax_number_2 }}
                                @endif

                                @if (!empty($transaction->location))
                                    @if (!empty($transaction->location->mobile))
                                        <br>@lang('contact.mobile'): {{ $transaction->location->mobile }}
                                    @endif
                                    @if (!empty($transaction->location->email))
                                        <br>@lang('business.email'): {{ $transaction->location->email }}
                                    @endif
                                @endif
                            </address>
                        </div>
                    @else
                        <div class="col-xs-12">
                            @if ($transaction->type != 'payroll' && !empty($transaction->contact))
                                <h3
                                    style="border-bottom: 1px solid black;border-bottom-style: dashed;margin-top: 5px;">
                                    @lang('contact.customer')
                                </h3>
                                <p>Nome: <strong>{{ $transaction->contact->name ?? '' }}</strong></p>
                                <p>Endereço: {!! $transaction->contact->contact_address !!}</p>
                                @if (!empty($transaction->contact->tax_number))
                                    <p>@lang('contact.tax_no'): {{ $transaction->contact->tax_number }}</p>
                                @endif
                                @if (!empty($transaction->contact->mobile))
                                    <p>@lang('contact.mobile'): {{ $transaction->contact->mobile }}</p>
                                @endif
                                @if (!empty($transaction->contact->email))
                                    <p>@lang('business.email'): {{ $transaction->contact->email }}</p>
                                @endif
                            @else
                                @if (!empty($transaction->transaction_for))
                                    <h3
                                        style="border-bottom: 1px solid black;border-bottom-style: dashed;margin-top: 5px;">
                                        @lang('essentials::lang.payroll_for')
                                    </h3>
                                    <p>Nome: <strong>{{ $transaction->transaction_for->user_full_name }}</strong></p>
                                    @if (!empty($transaction->transaction_for->address))
                                        <p>Endereço: {{ $transaction->transaction_for->address }}</p>
                                    @endif
                                    @if (!empty($transaction->transaction_for->contact_number))
                                        <p>@lang('contact.mobile'): {{ $transaction->transaction_for->contact_number }}</p>
                                    @endif
                                    @if (!empty($transaction->transaction_for->email))
                                        <p>@lang('business.email'): {{ $transaction->transaction_for->email }}</p>
                                    @endif
                                @endif
                            @endif
                        </div>
                        
                        <div class="col-xs-12">
                            <h3
                                style="border-bottom: 1px solid black;border-bottom-style: dashed;margin-top: 5px;">
                                @lang('business.business')
                            </h3>
                            <strong>{{ $transaction->business->name }}</strong>

                            @if (!empty($transaction->location))
                                {{ $transaction->location->name }}

                                @if (!empty($transaction->location->landmark))
                                    <br>{{ $transaction->location->landmark }}
                                @endif

                                @if (!empty($transaction->location->city) ||
                                    !empty($transaction->location->state) ||
                                    !empty($transaction->location->country))
                                    -
                                    {{ implode(', ', array_filter([$transaction->location->city, $transaction->location->state, $transaction->location->country])) }}
                                @endif
                            @endif

                            @if (!empty($transaction->business->tax_number_1))
                                <br>{{ $transaction->business->tax_label_1 }}:
                                {{ $transaction->business->tax_number_1 }}
                            @endif

                            @if (!empty($transaction->business->tax_number_2))
                                <br>{{ $transaction->business->tax_label_2 }}:
                                {{ $transaction->business->tax_number_2 }}
                            @endif

                            @if (!empty($transaction->location))
                                @if (!empty($transaction->location->mobile))
                                    <br>@lang('contact.mobile'): {{ $transaction->location->mobile }}
                                @endif
                                @if (!empty($transaction->location->email))
                                    <br>@lang('business.email'): {{ $transaction->location->email }}
                                @endif
                            @endif
                        </div>
                    @endif
                </div>
            @endif
            <div class="row">

                <div class="col-xs-12">
                    <h3 style="border-bottom: 1px solid black;border-bottom-style: dashed;margin-top: 5px;">
                        Detalhes
                    </h3>
                    <p>
                        <strong>
                            @lang('purchase.amount'):
                        </strong>
                        <span class="pull-right">@format_currency($single_payment_line->amount)</span>
                    </p>
                    <p>
                        <strong>
                            @lang('lang_v1.payment_method'): 
                        </strong>
                        <span class="pull-right">{{ $payment_types[$single_payment_line->method] ?? '' }}<br></span>
                    </p>
                    
                    @if ($single_payment_line->method == 'card')
                        <p>
                            <strong>@lang('lang_v1.card_holder_name'):</strong> 
                            <span class="pull-right">{{ $single_payment_line->card_holder_name }}</span>
                        </p>
                        <p>
                            <strong>@lang('lang_v1.card_number'):</strong>
                            <span class="pull-right">{{ $single_payment_line->card_number }}</span>
                        </p>
                        <p>
                            <strong>@lang('lang_v1.card_transaction_number'):</strong>
                            <span class="pull-right">{{ $single_payment_line->card_transaction_number }}</span>
                        </p>
                    @elseif($single_payment_line->method == 'cheque')
                        <span>
                            <strong>@lang('lang_v1.cheque_number') :</strong>
                            <span class="pull-right">{{ $single_payment_line->cheque_number }}</span>
                        </span>
                    @elseif($single_payment_line->method == 'bank_transfer')

                    @elseif($single_payment_line->method == 'custom_pay_1')
                        <p>
                            <strong>@lang('lang_v1.transaction_number') :</strong>
                            <span class="pull-right">{{ $single_payment_line->transaction_no }}</span>
                        </p>
                    @elseif($single_payment_line->method == 'custom_pay_2')
                        <p>
                            <strong>@lang('lang_v1.transaction_number') :</strong>
                            <span class="pull-right">{{ $single_payment_line->transaction_no }}</span>
                        </p>
                    @elseif($single_payment_line->method == 'custom_pay_3')
                        <p>
                            <strong> @lang('lang_v1.transaction_number'):</strong>
                            <span class="pull-right">{{ $single_payment_line->transaction_no }}</span>
                        </p>
                    @endif
                </div>

                @if (!empty($single_payment_line->note))
                    <div class="col-xs-12">
                        <h3 style="border-bottom: 1px solid black;border-bottom-style: dashed;margin-top: 5px;">
                            @lang('purchase.payment_note')
                        </h3>
                        
                        {{ $single_payment_line->note }}
                    </div>
                @endif

                <div class="col-xs-12">
                    <p>
                        <strong>@lang('purchase.ref_no'):</strong>
                        <span class="pull-right">
                            @if (!empty($single_payment_line->payment_ref_no))
                                {{ $single_payment_line->payment_ref_no }}
                            @else
                                --
                            @endif
                        </span>
                    </p>
                    <p>
                        <b>@lang('lang_v1.paid_on'):</b>
                        <span class="pull-right">{{ @format_datetime($single_payment_line->paid_on) }}</span>
                    </p>
                    @if (!empty($single_payment_line->document_path))
                        <a href="{{ $single_payment_line->document_path }}" class="btn btn-success btn-xs no-print"
                            download="{{ $single_payment_line->document_name }}"><i class="fa fa-download"
                                data-toggle="tooltip" title="{{ __('purchase.download_document') }}"></i>
                            {{ __('purchase.download_document') }}</a>
                    @endif
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary no-print" aria-label="Print"
                onclick="$(this).closest('div.modal').printThis();">
                <i class="fa fa-print"></i> @lang('messages.print')
            </button>
            <button type="button" class="btn btn-default no-print" data-dismiss="modal">@lang('messages.close')
            </button>
        </div>
    </div>
</div>
