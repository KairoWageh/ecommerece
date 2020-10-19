@extends('site.index')

@section('content')
<div class="product-big-title-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="product-bit-title text-center">
                        <h2>{{ __('user.shop') }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    
    <div class="single-product-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
            	@foreach($products as $product)
                <div class="col-md-3 col-sm-6">
                    <div class="single-shop-product">
                        <div class="product-upper">
                            <img src="{{ Storage::url($product->photo) }}" alt="">
                        </div>
                        <h2><a href="">{{ $product->title }}</a></h2>
                        <div class="product-carousel-price">
                            @if($product->offer_price != 0)
								<ins>${{$product->offer_price}}</ins>
								<del>${{$product->price}}</del>
							@else
								<ins>${{$product->price}}</ins>
							@endif
                        </div>  
                        
                        <div class="product-option-shop">
                            <!-- <a class="add_to_cart_button" data-quantity="1" data-product_sku="" data-product_id="70" rel="nofollow" href="/canvas/shop/?add-to-cart=70">{{ __('user.add_to_cart') }}</a> -->

	                        <a href="{{route('cart.add', $product->id)}}" class="add_to_cart_button">
	                        	<i class="fa fa-shopping-cart"></i> 
								{{__('user.add_to_cart')}}
							</a>
                        </div>                       
                    </div>
                </div>
                @endforeach
            </div>
            
            <div class="row">
                <div class="col-md-12">
                    <div class="product-pagination text-center">
                        <nav>
                          <ul class="pagination">
                            <li>
                              <a href="#" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                              </a>
                            </li>
                            <li><a href="#">1</a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">4</a></li>
                            <li><a href="#">5</a></li>
                            <li>
                              <a href="#" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                              </a>
                            </li>
                          </ul>
                        </nav>                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection