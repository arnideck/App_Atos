@foreach($featured_products as $variation)
<div class="col-md-3 col-xs-4 product_list no-print hvr-grow-shadow">
<div class="product_box" data-variation_id="{{$variation->id}}" title="{{$variation->full_name}}">		    
<span class="label bg-green pull-left" style="font-weight: bold;font-family: sans-serif;">
@format_currency($variation->default_sell_price) 
</span>

		<div class="image-container" 
			style="background-image: url(
					@if(count($variation->media) > 0)
						{{$variation->media->first()->display_url}}
					@elseif(!empty($variation->product->image_url))
						{{$variation->product->image_url}}
					@else
						{{asset('/img/default.png')}}
					@endif
				);
			background-repeat: no-repeat; background-position: center;
			background-size: contain;">
			
		</div>

		<div class="text_div">
			<small class="text text-muted">{{$variation->product->name}} 
			@if($variation->product->type == 'variable')
				- {{$variation->name}}
			@endif
			</small>

			<small class="text-muted">
				({{$variation->sub_sku}})
			</small>
		</div>
			
		</div>
	</div>
@endforeach