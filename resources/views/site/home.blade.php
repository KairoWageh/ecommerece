@extends('site.index')

@section('content')

<div class="slider-area">
	<!-- Slider -->
	<div class="block-slider block-slider4">
		<ul class="" id="bxslider-home4">
			<li>
				<img src="{{ asset('public/design/site/img/h4-slide.png') }}" alt="Slide">
				<div class="caption-group">
					<h2 class="caption title">
						iPhone <span class="primary">6 <strong>Plus</strong></span>
					</h2>
					<h4 class="caption subtitle">Dual SIM</h4>
					<a class="caption button-radius" href="#"><span class="icon"></span>Shop now</a>
				</div>
			</li>
			<li><img src="{{ asset('public/design/site/img/h4-slide2.png') }}" alt="Slide">
				<div class="caption-group">
					<h2 class="caption title">
						by one, get one <span class="primary">50% <strong>off</strong></span>
					</h2>
					<h4 class="caption subtitle">school supplies & backpacks.*</h4>
					<a class="caption button-radius" href="#"><span class="icon"></span>Shop now</a>
				</div>
			</li>
			<li><img src="{{ asset('public/design/site/img/h4-slide3.png') }}" alt="Slide">
				<div class="caption-group">
					<h2 class="caption title">
						Apple <span class="primary">Store <strong>Ipod</strong></span>
					</h2>
					<h4 class="caption subtitle">Select Item</h4>
					<a class="caption button-radius" href="#"><span class="icon"></span>Shop now</a>
				</div>
			</li>
			<li><img src="{{ asset('public/design/site/img/h4-slide4.png') }}" alt="Slide">
				<div class="caption-group">
					<h2 class="caption title">
						Apple <span class="primary">Store <strong>Ipod</strong></span>
					</h2>
					<h4 class="caption subtitle">& Phone</h4>
					<a class="caption button-radius" href="#"><span class="icon"></span>Shop now</a>
				</div>
			</li>
		</ul>
	</div>
	<!-- ./Slider -->
</div> <!-- End slider area -->
<div class="promo-area">
	<div class="zigzag-bottom"></div>
	<div class="container">
		<div class="row">
			<div class="col-md-3 col-sm-6">
				<div class="single-promo promo1">
					<i class="fa fa-refresh"></i>
					<p>30 Days return</p>
				</div>
			</div>
			<div class="col-md-3 col-sm-6">
				<div class="single-promo promo2">
					<i class="fa fa-truck"></i>
					<p>Free shipping</p>
				</div>
			</div>
			<div class="col-md-3 col-sm-6">
				<div class="single-promo promo3">
					<i class="fa fa-lock"></i>
					<p>Secure payments</p>
				</div>
			</div>
			<div class="col-md-3 col-sm-6">
				<div class="single-promo promo4">
					<i class="fa fa-gift"></i>
					<p>New products</p>
				</div>
			</div>
		</div>
	</div>
</div> <!-- End promo area -->

<div class="maincontent-area">
	<div class="zigzag-bottom"></div>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="latest-product">
					<h2 class="section-title">{{__('user.latest_products')}}</h2>
					<div class="product-carousel">
						@foreach($latest_products as $product)
						<div class="single-product">
							<div class="product-f-image"  width="195px" height="243px">
								<img src="{{ Storage::url($product->photo) }}" alt="">
								<div class="product-hover">
									<button class="add-to-cart-link" data-id="{{ $product->id }}"><i class="fa fa-shopping-cart"></i> 
									{{__('user.add_to_cart')}}</button>
									<!-- <a href="{{route('cart.add', $product->id)}}" class="add_to_cart_button">
	                        	<i class="fa fa-shopping-cart"></i> 
								{{__('user.add_to_cart')}}
							</a> -->



									<a href="{{route('user.single_product', $product->id)}}" class="view-details-link"><i class="fa fa-link"></i> {{__('user.see_datails')}}</a>
								</div>
							</div>
							
							<h2><a href="single-product.html">{{$product->title}}</a></h2>
							
							<div class="product-carousel-price">
								@if($product->offer_price != 0)
									<ins>${{$product->offer_price}}</ins>
									<del>${{$product->price}}</del>
								@else
									<ins>${{$product->price}}</ins>
								@endif
							</div> 
						</div>
						@endforeach
					</div>
				</div>
			</div>
		</div>
	</div>
</div> <!-- End main content area -->

<div class="brands-area">
	<div class="zigzag-bottom"></div>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="brand-wrapper">
					<div class="brand-list">
						@foreach($manufactures as $manufacture)
							<img src="{{ Storage::url($manufacture->icon) }}" alt="">
						@endforeach                            
					</div>
				</div>
			</div>
		</div>
	</div>
</div> <!-- End brands area -->

<div class="product-widget-area">
	<div class="zigzag-bottom"></div>
	<div class="container">
		<div class="row">
			<div class="col-md-4">
				<div class="single-product-widget">
					<h2 class="product-wid-title">Top Sellers</h2>
					<a href="" class="wid-view-more">View All</a>
					<div class="single-wid-product">
						<a href="single-product.html"><img src="{{ asset('public/design/site/img/product-thumb-1.jpg') }}" alt="" class="product-thumb"></a>
						<h2><a href="single-product.html">Sony Smart TV - 2015</a></h2>
						<div class="product-wid-rating">
							<i class="fa fa-star"></i>
							<i class="fa fa-star"></i>
							<i class="fa fa-star"></i>
							<i class="fa fa-star"></i>
							<i class="fa fa-star"></i>
						</div>
						<div class="product-wid-price">
							<ins>$400.00</ins> <del>$425.00</del>
						</div>                            
					</div>
					<div class="single-wid-product">
						<a href="single-product.html"><img src="{{ asset('public/design/site/img/product-thumb-2.jpg') }}" alt="" class="product-thumb"></a>
						<h2><a href="single-product.html">Apple new mac book 2015</a></h2>
						<div class="product-wid-rating">
							<i class="fa fa-star"></i>
							<i class="fa fa-star"></i>
							<i class="fa fa-star"></i>
							<i class="fa fa-star"></i>
							<i class="fa fa-star"></i>
						</div>
						<div class="product-wid-price">
							<ins>$400.00</ins> <del>$425.00</del>
						</div>                            
					</div>
					<div class="single-wid-product">
						<a href="single-product.html"><img src="{{ asset('public/design/site/img/product-thumb-3.jpg') }}" alt="" class="product-thumb"></a>
						<h2><a href="single-product.html">Apple new i phone 6</a></h2>
						<div class="product-wid-rating">
							<i class="fa fa-star"></i>
							<i class="fa fa-star"></i>
							<i class="fa fa-star"></i>
							<i class="fa fa-star"></i>
							<i class="fa fa-star"></i>
						</div>
						<div class="product-wid-price">
							<ins>$400.00</ins> <del>$425.00</del>
						</div>                            
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="single-product-widget">
					<h2 class="product-wid-title">Recently Viewed</h2>
					<a href="#" class="wid-view-more">View All</a>
					<div class="single-wid-product">
						<a href="single-product.html"><img src="{{ asset('public/design/site/img/product-thumb-4.jpg') }}" alt="" class="product-thumb"></a>
						<h2><a href="single-product.html">Sony playstation microsoft</a></h2>
						<div class="product-wid-rating">
							<i class="fa fa-star"></i>
							<i class="fa fa-star"></i>
							<i class="fa fa-star"></i>
							<i class="fa fa-star"></i>
							<i class="fa fa-star"></i>
						</div>
						<div class="product-wid-price">
							<ins>$400.00</ins> <del>$425.00</del>
						</div>                            
					</div>
					<div class="single-wid-product">
						<a href="single-product.html"><img src="{{ asset('public/design/site/img/product-thumb-1.jpg') }}" alt="" class="product-thumb"></a>
						<h2><a href="single-product.html">Sony Smart Air Condtion</a></h2>
						<div class="product-wid-rating">
							<i class="fa fa-star"></i>
							<i class="fa fa-star"></i>
							<i class="fa fa-star"></i>
							<i class="fa fa-star"></i>
							<i class="fa fa-star"></i>
						</div>
						<div class="product-wid-price">
							<ins>$400.00</ins> <del>$425.00</del>
						</div>                            
					</div>
					<div class="single-wid-product">
						<a href="single-product.html"><img src="{{ asset('public/design/site/img/product-thumb-2.jpg') }}" alt="" class="product-thumb"></a>
						<h2><a href="single-product.html">Samsung gallaxy note 4</a></h2>
						<div class="product-wid-rating">
							<i class="fa fa-star"></i>
							<i class="fa fa-star"></i>
							<i class="fa fa-star"></i>
							<i class="fa fa-star"></i>
							<i class="fa fa-star"></i>
						</div>
						<div class="product-wid-price">
							<ins>$400.00</ins> <del>$425.00</del>
						</div>                            
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="single-product-widget">
					<h2 class="product-wid-title">Top New</h2>
					<a href="#" class="wid-view-more">View All</a>
					<div class="single-wid-product">
						<a href="single-product.html"><img src="{{ asset('public/design/site/img/product-thumb-3.jpg') }}" alt="" class="product-thumb"></a>
						<h2><a href="single-product.html">Apple new i phone 6</a></h2>
						<div class="product-wid-rating">
							<i class="fa fa-star"></i>
							<i class="fa fa-star"></i>
							<i class="fa fa-star"></i>
							<i class="fa fa-star"></i>
							<i class="fa fa-star"></i>
						</div>
						<div class="product-wid-price">
							<ins>$400.00</ins> <del>$425.00</del>
						</div>                            
					</div>
					<div class="single-wid-product">
						<a href="single-product.html"><img src="{{ asset('public/design/site/img/product-thumb-4.jpg') }}" alt="" class="product-thumb"></a>
						<h2><a href="single-product.html">Samsung gallaxy note 4</a></h2>
						<div class="product-wid-rating">
							<i class="fa fa-star"></i>
							<i class="fa fa-star"></i>
							<i class="fa fa-star"></i>
							<i class="fa fa-star"></i>
							<i class="fa fa-star"></i>
						</div>
						<div class="product-wid-price">
							<ins>$400.00</ins> <del>$425.00</del>
						</div>                            
					</div>
					<div class="single-wid-product">
						<a href="single-product.html"><img src="{{ asset('public/design/site/img/product-thumb-1.jpg') }}" alt="" class="product-thumb"></a>
						<h2><a href="single-product.html">Sony playstation microsoft</a></h2>
						<div class="product-wid-rating">
							<i class="fa fa-star"></i>
							<i class="fa fa-star"></i>
							<i class="fa fa-star"></i>
							<i class="fa fa-star"></i>
							<i class="fa fa-star"></i>
						</div>
						<div class="product-wid-price">
							<ins>$400.00</ins> <del>$425.00</del>
						</div>                            
					</div>
				</div>
			</div>
		</div>
	</div>
</div> <!-- End product widget area -->

@endsection

@section('scripts')
<script type="text/javascript">
 
	$(".add-to-cart-link").click(function (e) {
    	e.preventDefault();
       	var ele = $(this);

        $.ajax({
           url: '{{ url('update-cart') }}',
           method: "patch",
           data: {_token: '{{ csrf_token() }}', id: ele.attr("data-id"), quantity: ele.parents("tr").find(".quantity").val()},
           success: function (response) {
               window.location.reload();
           }
        });
    });
    $(".update-cart").click(function (e) {
       e.preventDefault();

       var ele = $(this);

        $.ajax({
           url: '{{ url('update-cart') }}',
           method: "patch",
           data: {_token: '{{ csrf_token() }}', id: ele.attr("data-id"), quantity: ele.parents("tr").find(".quantity").val()},
           success: function (response) {
               window.location.reload();
           }
        });
    });
 
    $(".remove-from-cart").click(function (e) {
        e.preventDefault();

        var ele = $(this);

        if(confirm("Are you sure")) {
            $.ajax({
                url: '{{ url('remove-from-cart') }}',
                method: "DELETE",
                data: {_token: '{{ csrf_token() }}', id: ele.attr("data-id")},
                success: function (response) {
                    window.location.reload();
                }
            });
        }
    });

    </script>
 
@endsection