<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        {!! Form::open(['url' => action('CashRegisterController@postCloseRegister'), 'method' => 'post', 'id' => 'form-close-register']) !!}

        {!! Form::hidden('user_id', $register_details->user_id); !!}
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h3 class="modal-title">@lang( 'cash_register.current_register' ) ({{ \Carbon::createFromFormat('Y-m-d H:i:s', $register_details->open_time)->format('d/m/y-H:i') }}) até ({{ \Carbon::now()->format('d/m/y-H:i') }})</h3>
        </div>

        <div class="modal-body">
            @include('cash_register.payment_details')
            <hr>
            <div class="row cash-register-details">
                <div class="col-sm-4">
                    <div class="form-group">
                        {!! Form::label('closing_amount', __( 'cash_register.total_cash' ) . ':*') !!}
                        {!! Form::text('closing_amount', @num_format($register_details->cash_in_hand + $register_details->total_cash + $register_details->total_cash_receipt_on_credit - $register_details->total_cash_refund - $register_details->total_cash_expense), ['class' => 'form-control input_number', 'required', 'placeholder' => __( 'cash_register.total_cash' ) ]); !!}
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        {!! Form::label('total_card_slips', __( 'cash_register.total_card_slips' ) . ':*') !!} @show_tooltip(__('tooltip.total_card_slips'))
                        {!! Form::number('total_card_slips', $register_details->total_card_slips, ['class' => 'form-control', 'required', 'placeholder' => __( 'cash_register.total_card_slips' ), 'min' => 0 ]); !!}
                    </div>
                </div> 
                <div class="col-sm-4">
                    <div class="form-group">
                        {!! Form::label('total_cheques', __( 'cash_register.total_cheques' ) . ':*') !!} @show_tooltip(__('tooltip.total_cheques'))
                        {!! Form::number('total_cheques', $register_details->total_cheques, ['class' => 'form-control', 'required', 'placeholder' => __( 'cash_register.total_cheques' ), 'min' => 0 ]); !!}
                    </div>
                </div> 
                <hr>
                <div class="col-md-8 col-sm-12">
                    <h3>@lang( 'lang_v1.cash_denominations' )</h3>
                    @if(!empty($pos_settings['cash_denominations']))
                    <table class="table table-slim">
                        <thead>
                        <tr>
                            <th width="20%" class="text-right">@lang('lang_v1.denomination')</th>
                            <th width="20%">&nbsp;</th>
                            <th width="20%" class="text-center">@lang('lang_v1.count')</th>
                            <th width="20%">&nbsp;</th>
                            <th width="20%" class="text-left">@lang('sale.subtotal')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach(explode(',', $pos_settings['cash_denominations']) as $dnm)
                        <tr>
                            <td class="text-right">{{$dnm}}</td>
                            <td class="text-center" >X</td>
                            <td>{!! Form::number("denominations[$dnm]", null, ['class' => 'form-control cash_denomination input-sm', 'min' => 0, 'data-denomination' => $dnm, 'style' => 'width: 100px; margin:auto;' ]); !!}</td>
                            <td class="text-center">=</td>
                            <td class="text-left">
                            <span class="denomination_subtotal">0</span>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th colspan="4" class="text-center">@lang('sale.total')</th>
                            <td><span class="denomination_total">0</span></td>
                        </tr>
                        </tfoot>
                    </table>
                    @else
                    <p class="help-block">@lang('lang_v1.denomination_add_help_text')</p>
                    @endif
                </div>
                <hr>
                <div class="col-sm-12">
                    <div class="form-group">
                        {!! Form::label('closing_note', __( 'cash_register.closing_note' ) . ':') !!}
                        {!! Form::textarea('closing_note', null, ['class' => 'form-control', 'placeholder' => __( 'cash_register.closing_note' ), 'rows' => 3 ]); !!}
                    </div>
                </div>
            </div> 

            <div class="row">
                <div class="col-xs-6">
                    <b>@lang('report.user'):</b> {{ $register_details->user_name}}<br>
                    <b>@lang('business.email'):</b> {{ $register_details->email}}<br>
                    <b>@lang('business.business_location'):</b> {{ $register_details->location_name}}<br>
                </div>
                @if(!empty($register_details->closing_note))
                    <div class="col-xs-6">
                    <strong>@lang('cash_register.closing_note'):</strong><br>
                    {{$register_details->closing_note}}
                    </div>
                @endif
            </div>
        </div>

        <div class="modal-footer">
            @can('close_cash_register')
                <button type="button" id="btn-close-register" class="btn btn-primary">
                    @lang( 'cash_register.close_register' )
                </button>
            @endcan

            <button type="button" class="btn btn-success no-print" aria-label="Print" onclick="$(this).closest('div.modal').printThis();">
                <i class="fa fa-print"></i> 
                @lang('messages.print')
            </button>

            <button type="button" class="btn btn-default" data-dismiss="modal">
                @lang( 'messages.cancel' )
            </button>
        </div>
        {!! Form::close() !!}
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->

<div class="modal" id="modal-confirmation-close-register" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" style="color:red;">
                    Atenção!!! | FECHAR CAIXA
                </h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <h3>Você deseja realmente fechar o caixa?</h3>
            </div>

            <div class="modal-footer">
                <button type="button" id="btn-confirm-close-register" class="btn btn-primary">
                    @lang( 'cash_register.close_register' )
                </button>

                <button type="button" class="btn btn-default" id="btn-cancel-confirm-close-register">
                    @lang( 'messages.cancel' )
                </button>
            </div>
        </div>
    </div>
</div>

<style type="text/css">
    @media print {
        .modal {
            position: absolute;
            left: 0;
            top: 0;
            margin: 0;
            padding: 0;
            overflow: visible !important;
        }

        .cash-register-details, .modal-footer {
            display: none;
        }
    }
</style>

<script>
    $('#btn-close-register').on('click', (evt) => {
        $('#modal-confirmation-close-register').modal('toggle');
    });

    $('#btn-cancel-confirm-close-register').on('click', (evt) => {
        $('#modal-confirmation-close-register').modal('toggle');
    });

    $('#btn-confirm-close-register').on('click', (evt) => {
        $('form#form-close-register').submit();
    });
</script>