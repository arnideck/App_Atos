@inject('request', 'Illuminate\Http\Request')

<div class="container-fluid">

	<!-- Language changer -->
	<div class="row">
		<div class="col-md-6">
			<div class="pull-left mt-10">
		        <select class="form-control input-sm" id="change_lang">
		            @foreach(config('constants.langs') as $key => $val)
		                <option value="{{$key}}" 
		                	@if( (empty(request()->lang) && config('app.locale') == $key) 
		                	|| request()->lang == $key) 
		                		selected 
		                	@endif
		                >
		                	{{$val['full_name']}}
		                </option>
		            @endforeach
		        </select>
	    	</div>
		</div>
		<div class="col-md-6">
			<div class="pull-right text-white">
	        	@if(!($request->segment(1) == 'business' && $request->segment(2) == 'register'))

	        		<!-- Register Url -->
		        	
		        @endif

		        @if(!($request->segment(1) == 'business' && $request->segment(2) == 'register') && $request->segment(1) != 'login')
		        	{{ __('business.already_registered')}} <a href="{{ action('Auth\LoginController@login') }}@if(!empty(request()->lang)){{'?lang=' . request()->lang}} @endif">{{ __('business.sign_in') }}</a>
		        @endif
	        </div>
		</div>
	</div>
</div>