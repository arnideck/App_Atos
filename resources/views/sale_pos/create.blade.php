@extends('layouts.app')

@section('title', __('sale.pos_sale'))

@section('content')
<section class="content no-print">
	<input type="hidden" id="amount_rounding_method" value="{{$pos_settings['amount_rounding_method'] ?? ''}}">
	@if(!empty($pos_settings['allow_overselling']))
		<input type="hidden" id="is_overselling_allowed">
	@endif
	@if(session('business.enable_rp') == 1)
        <input type="hidden" id="reward_point_enabled">
    @endif
    @php
		$is_discount_enabled = $pos_settings['disable_discount'] != 1 ? true : false;
		$is_rp_enabled = session('business.enable_rp') == 1 ? true : false;
	@endphp
	{!! Form::open(['url' => action('SellPosController@store'), 'method' => 'post', 'id' => 'add_pos_sell_form' ]) !!}
	<div class="row mb-12">
		<div class="col-md-12">
			<div class="row">
				<div class="@if(empty($pos_settings['hide_product_suggestion'])) col-md-6 @else col-md-10 col-md-offset-1 @endif padding: 15px pr-12">
					<div class="box box-solid mb-12 @if(!isMobile()) mb-40 @endif">
						<div class="box-body pb-0">
							{!! Form::hidden('location_id', $default_location->id ?? null , ['id' => 'location_id', 'data-receipt_printer_type' => !empty($default_location->receipt_printer_type) ? $default_location->receipt_printer_type : 'browser', 'data-default_payment_accounts' => $default_location->default_payment_accounts ?? '']); !!}
							<!-- sub_type -->
							{!! Form::hidden('sub_type', isset($sub_type) ? $sub_type : null) !!}
							<input type="hidden" id="item_addition_method" value="{{$business_details->item_addition_method}}">
								@include('sale_pos.partials.pos_form')

								@include('sale_pos.partials.pos_form_totals')

								@include('sale_pos.partials.payment_modal')

								@if(empty($pos_settings['disable_suspend']))
									@include('sale_pos.partials.suspend_note_modal')
								@endif

								@if(empty($pos_settings['disable_recurring_invoice']))
									@include('sale_pos.partials.recurring_invoice_modal')
								@endif
							</div>
						</div>
					</div>
				@if(empty($pos_settings['hide_product_suggestion']) && !isMobile())
				    <div class="col-md-6 padding: 15px">
                    <div class="box box-success mb-12">
                    <div class="box-body pb-1">
					@include('sale_pos.partials.pos_sidebar')
				</div>
				@endif
			</div>
		</div>
	</div>
	@include('sale_pos.partials.pos_form_actions')
	{!! Form::close() !!}
</section>

<!-- This will be printed -->
<section class="invoice print_section" id="receipt_section">
</section>
<div class="modal fade contact_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
	@include('contact.create', ['quick_add' => true])
</div>
@if(empty($pos_settings['hide_product_suggestion']) && isMobile())
	@include('sale_pos.partials.mobile_product_suggestions')
@endif
<!-- /.content -->
<div class="modal fade register_details_modal" tabindex="-1" role="dialog" 
	aria-labelledby="gridSystemModalLabel">
</div>

<div class="modal fade close_register_modal" tabindex="-1" role="dialog" 
	aria-labelledby="gridSystemModalLabel">
</div>

<!-- quick product modal -->
<div class="modal fade quick_add_product_modal" tabindex="-1" role="dialog" aria-labelledby="modalTitle"></div>

<div class="modal fade" id="expense_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
</div>

@include('sale_pos.partials.configure_search_modal')

@include('sale_pos.partials.recent_transactions_modal')

@include('sale_pos.partials.weighing_scale_modal')

<div class="modal fade pay_contact_due_modal" tabindex="-1" in-pdv role="dialog" aria-labelledby="gridSystemModalLabel"></div>

<div class="modal" id="modal-alert-select-client-first" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Selecione um cliente antes</h2>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>

@stop
@section('css')
	<!-- include module css -->
    @if(!empty($pos_module_data))
        @foreach($pos_module_data as $key => $value)
            @if(!empty($value['module_css_path']))
                @includeIf($value['module_css_path'])
            @endif
        @endforeach
    @endif
@stop


@section('javascript')
	<script src="{{ asset('js/pos.js?v=' . $asset_v) }}"></script>
	<script src="{{ asset('js/printer.js?v=' . $asset_v) }}"></script>
	<script src="{{ asset('js/product.js?v=' . $asset_v) }}"></script>
	<script src="{{ asset('js/opening_stock.js?v=' . $asset_v) }}"></script>
	@include('sale_pos.partials.keyboard_shortcuts')

	<!-- Call restaurant module if defined -->
    @if(in_array('tables' ,$enabled_modules) || in_array('modifiers' ,$enabled_modules) || in_array('service_staff' ,$enabled_modules))
    	<script src="{{ asset('js/restaurant.js?v=' . $asset_v) }}"></script>
    @endif
    <!-- include module js -->
    @if(!empty($pos_module_data))
	    @foreach($pos_module_data as $key => $value)
            @if(!empty($value['module_js_path']))
                @includeIf($value['module_js_path'], ['view_data' => $value['view_data']])
            @endif
	    @endforeach
	@endif

    <script>
        $(document).on('click', '#btn-make-payment-R', function(e) {
            e.preventDefault();

            const selected_client_name = $('#customer_id option:selected').text();

            if (selected_client_name != 'Cliente Final') {

                let url = $('#btn-make-payment-R').data('href').replace('#ID_CLIENT', $('#customer_id').val());

                $.ajax({
                    url: url,
                    dataType: 'html',
                    success: function(result) {
                        $('.pay_contact_due_modal')
                            .html(result)
                            .modal('show');
                        __currency_convert_recursively($('.pay_contact_due_modal'));
                        
                        $('#paid_on').datetimepicker({
                            format: moment_date_format + ' ' + moment_time_format,
                            ignoreReadonly: true,
                        });

                        $('.pay_contact_due_modal')
                            .find('form#pay_contact_due_form')
                        .validate();

                        $(document, 'form#pay_contact_due_form').unbind('submit');

                        $('.pay_contact_due_modal').find('form#pay_contact_due_form').on('submit', function(evt) {
                            evt.preventDefault();

                            $('#pay_contact_due_form').find('button[type="submit"]').attr('disabled', false);

                            var form = $(this);
                            var actionUrl = form.attr('action');

                            $.ajax({
                                type: "POST",
                                url: "{{ action('TransactionPaymentController@postPayContactDueOnPDV') }}",
                                data: form.serialize(),
                                success: function(result) {

                                    $('#receipt_section').html(result.receipt.html_content);
                                    
                                    __currency_convert_recursively($('#receipt_section'));

                                    $('.pay_contact_due_modal').modal('hide');
                                    $('#customer_id').val(1).change();
                                    $('#total-a-receber').addClass('hide');
                                    $('#total-a-receber').closest('span').text('');

                                    var title = document.title;
                                    if (typeof result.receipt.print_title != 'undefined') {
                                        document.title = result.receipt.print_title;
                                    }
                                    if (typeof result.print_title != 'undefined') {
                                        document.title = result.print_title;
                                    }

                                    __print_receipt('receipt_section');

                                    setTimeout(function() {
                                        document.title = title;
                                    }, 1200);

                                    $('#pay_contact_due_form').find('.cash_denomination_error').addClass('hide');
                                }
                            });
                        })
                    },
                });
            }
            else {
                $('#modal-alert-select-client-first').modal('show');
            }
        });
    </script>
@endsection