@extends('site.index')

@section('content')
<!-- <div class="cell example example1" id="example-1">
	<form action="/charge" method="post" id="payment-form">
		<div class="form-row">
		    <label for="card-element">
		      Credit or debit card
		    </label>
		    <div id="card-element">
		      <!-- A Stripe Element will be inserted here. -->

		      <!-- element start -->

		    	<!-- <div class="cell example example1" id="example-1"> -->
			        <!-- <form> -->
			        <!-- <div class="row">
			        	<fieldset class="col-md-4 offset-md-4">
				            <div class="row">
				              <label for="example1-name" data-tid="elements_examples.form.name_label">Name</label>
				              <input id="example1-name" data-tid="elements_examples.form.name_placeholder" type="text" placeholder="Jane Doe" required="" autocomplete="name">
				            </div>
				            <div class="row">
				              <label for="example1-email" data-tid="elements_examples.form.email_label">Email</label>
				              <input id="example1-email" data-tid="elements_examples.form.email_placeholder" type="email" placeholder="janedoe@gmail.com" required="" autocomplete="email">
				            </div>
				            <div class="row">
				              <label for="example1-phone" data-tid="elements_examples.form.phone_label">Phone</label>
				              <input id="example1-phone" data-tid="elements_examples.form.phone_placeholder" type="tel" placeholder="(941) 555-0123" required="" autocomplete="tel">
				            </div>
				        </fieldset>
			        </div> -->

			          <!-- <fieldset>
			            <div class="row">
			              <div id="example1-card"></div>
			            </div>
			          </fieldset> -->
			          <!-- <button type="submit" data-tid="elements_examples.form.pay_button">Pay $25</button>
			          <div class="error" role="alert"><svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 17 17">
			              <path class="base" fill="#000" d="M8.5,17 C3.80557963,17 0,13.1944204 0,8.5 C0,3.80557963 3.80557963,0 8.5,0 C13.1944204,0 17,3.80557963 17,8.5 C17,13.1944204 13.1944204,17 8.5,17 Z"></path>
			              <path class="glyph" fill="#FFF" d="M8.5,7.29791847 L6.12604076,4.92395924 C5.79409512,4.59201359 5.25590488,4.59201359 4.92395924,4.92395924 C4.59201359,5.25590488 4.59201359,5.79409512 4.92395924,6.12604076 L7.29791847,8.5 L4.92395924,10.8739592 C4.59201359,11.2059049 4.59201359,11.7440951 4.92395924,12.0760408 C5.25590488,12.4079864 5.79409512,12.4079864 6.12604076,12.0760408 L8.5,9.70208153 L10.8739592,12.0760408 C11.2059049,12.4079864 11.7440951,12.4079864 12.0760408,12.0760408 C12.4079864,11.7440951 12.4079864,11.2059049 12.0760408,10.8739592 L9.70208153,8.5 L12.0760408,6.12604076 C12.4079864,5.79409512 12.4079864,5.25590488 12.0760408,4.92395924 C11.7440951,4.59201359 11.2059049,4.59201359 10.8739592,4.92395924 L8.5,7.29791847 L8.5,7.29791847 Z"></path>
			            </svg>
			            <span class="message"></span></div> -->
			        <!-- </form> -->
			        <!-- <div class="success">
			          <div class="icon">
			            <svg width="84px" height="84px" viewBox="0 0 84 84" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
			              <circle class="border" cx="42" cy="42" r="40" stroke-linecap="round" stroke-width="4" stroke="#000" fill="none"></circle>
			              <path class="checkmark" stroke-linecap="round" stroke-linejoin="round" d="M23.375 42.5488281 36.8840688 56.0578969 64.891932 28.0500338" stroke-width="4" stroke="#000" fill="none"></path>
			            </svg>
			          </div>
			          <h3 class="title" data-tid="elements_examples.success.title">Payment successful</h3>
			          <p class="message"><span data-tid="elements_examples.success.message">Thanks for trying Stripe Elements. No money was charged, but we generated a token: </span><span class="token">tok_189gMN2eZvKYlo2CwTBv9KKh</span></p>
			          <a class="reset" href="#">
			            <svg width="32px" height="32px" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
			              <path fill="#000000" d="M15,7.05492878 C10.5000495,7.55237307 7,11.3674463 7,16 C7,20.9705627 11.0294373,25 16,25 C20.9705627,25 25,20.9705627 25,16 C25,15.3627484 24.4834055,14.8461538 23.8461538,14.8461538 C23.2089022,14.8461538 22.6923077,15.3627484 22.6923077,16 C22.6923077,19.6960595 19.6960595,22.6923077 16,22.6923077 C12.3039405,22.6923077 9.30769231,19.6960595 9.30769231,16 C9.30769231,12.3039405 12.3039405,9.30769231 16,9.30769231 L16,12.0841673 C16,12.1800431 16.0275652,12.2738974 16.0794108,12.354546 C16.2287368,12.5868311 16.5380938,12.6540826 16.7703788,12.5047565 L22.3457501,8.92058924 L22.3457501,8.92058924 C22.4060014,8.88185624 22.4572275,8.83063012 22.4959605,8.7703788 C22.6452866,8.53809377 22.5780351,8.22873685 22.3457501,8.07941076 L22.3457501,8.07941076 L16.7703788,4.49524351 C16.6897301,4.44339794 16.5958758,4.41583275 16.5,4.41583275 C16.2238576,4.41583275 16,4.63969037 16,4.91583275 L16,7 L15,7 L15,7.05492878 Z M16,32 C7.163444,32 0,24.836556 0,16 C0,7.163444 7.163444,0 16,0 C24.836556,0 32,7.163444 32,16 C32,24.836556 24.836556,32 16,32 Z"></path>
			            </svg>
			          </a>
			        </div>
			        <div class="caption">
			          <span data-tid="elements_examples.caption.no_charge" class="no-charge">Your card won't be charged</span>
			        </div> -->
		      	<!-- </div> -->

		      <!-- element end -->
		    <!-- </div> -->
		    <!-- Used to display Element errors. -->
		    <!-- <div id="card-errors" role="alert"></div>
	  	</div> -->

	  	<!-- <button>Submit Payment</button> -->
	<!-- </form> -->
<!-- </div> -->
<div class="clearfix"></div>
<!-- <div class="cell example example1" id="example-1"> -->
	<!-- <form accept-charset="UTF-8" class="require-validation"
	    data-cc-on-file="false"
	    data-stripe-publishable-key="{{ env('STRIPE_KEY') }}"
	    id="payment-form" method="post">
	    {{ csrf_field() }}
	    <div class='form-row'>
	        <div class='col-xs-12 form-group required'>
	            <label class='control-label'>Name on Card</label> <input
	                class='form-control' size='4' type='text'>
	        </div>
	    </div>
	    <div class='form-row'>
	        <div class='col-xs-12 form-group card required'>
	            <label class='control-label'>Card Number</label> <input
	                autocomplete='off' class='form-control card-number' size='20'
	                type='text'>
	        </div>
	    </div>
	    <div class='form-row'>
	        <div class='col-xs-4 form-group cvc required'>
	            <label class='control-label'>CVC</label> <input autocomplete='off'
	                class='form-control card-cvc' placeholder='ex. 311' size='4'
	                type='text'>
	        </div>
	        <div class='col-xs-4 form-group expiration required'>
	            <label class='control-label'>Expiration</label> <input
	                class='form-control card-expiry-month' placeholder='MM' size='2'
	                type='text'>
	        </div>
	        <div class='col-xs-4 form-group expiration required'>
	            <label class='control-label'> </label> <input
	                class='form-control card-expiry-year' placeholder='YYYY' size='4'
	                type='text'>
	        </div>
	    </div>
	    <div class='form-row'>
	        <div class='col-md-12'>
	            <div class='form-control total btn btn-info'>
	                Total: <span class='amount'>$300</span>
	            </div>
	        </div>
	    </div>
	    <div class='form-row'>
	        <div class='col-md-12 form-group'>
	            <button class='form-control btn btn-primary submit-button'
	                type='submit' style="margin-top: 10px;">Pay »</button>
	        </div>
	    </div>
	    <div class='form-row'>
	        <div class='col-md-12 error form-group hide'>
	            <div class='alert-danger alert'>Please correct the errors and try
	                again.</div>
	        </div>
	    </div>
	</form> -->


	<!-- last form -->

	<!-- <form action="/pay" method="post" id="payment-form">
        <div class="form-row">
            <label for="card-element">Credit or debit card</label>
           <div id="card-element"></div>
           <div id="card-errors" role="alert"></div>
        </div>
        <button>Submit Payment</button>
     </form>
<div class="clearfix"></div> -->
<div class="product-big-title-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="product-bit-title text-center">
                        <h2>{{__('checkout')}}</h2>
                    </div>
                </div>
            </div>
        </div>
</div> <!-- End Page title area -->
    <section class="section-content bg padding-y">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    @if (Session::has('error'))
                        <p class="alert alert-danger">{{ Session::get('error') }}</p>
                    @endif
                </div>
            </div>
            <form action="{{ route('cart.pay') }}" method="POST" role="form">
                @csrf
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <header class="card-header">
                                <h4 class="card-title mt-2">Billing Details</h4>
                            </header>
                            <article class="card-body">
                                <div class="form-row">
                                    <div class="col form-group">
                                        <label>{{__('first_name')}}</label>
                                        <input type="text" class="form-control" name="first_name">
                                    </div>
                                    <div class="col form-group">
                                        <label>{{__('last_name')}}</label>
                                        <input type="text" class="form-control" name="last_name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>{{__('address')}}</label>
                                    <input type="text" class="form-control" name="address">
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>{{__('city')}}</label>
                                        <input type="text" class="form-control" name="city">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>{{__('country')}}</label>
                                        <input type="text" class="form-control" name="country">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group  col-md-6">
                                        <label>{{__('post_code')}}</label>
                                        <input type="text" class="form-control" name="post_code">
                                    </div>
                                    <div class="form-group  col-md-6">
                                        <label>{{__('phone_number')}}</label>
                                        <input type="text" class="form-control" name="phone_number">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>{{__('email')}}</label>
                                    <input type="email" class="form-control" name="email" value="{{ auth()->user()->email }}" disabled>
                                    <small class="form-text text-muted">{{__('never_share')}}</small>
                                </div>
                                <div class="form-group">
                                    <label>{{__('other_notes')}}</label>
                                    <textarea class="form-control" name="notes" rows="6"></textarea>
                                </div>
                            </article>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <header class="card-header">
                                        <h4 class="card-title mt-2">Your Order</h4>
                                    </header>
                                    <article class="card-body">
                                        <dl class="dlist-align">
                                            <dt>Total cost: </dt>
                                            <dd class="text-right h5 b"> {{ config('settings.currency_symbol') }}{{ \Cart::getSubTotal() }} </dd>
                                        </dl>
                                    </article>
                                </div>
                            </div>
                            <div class="col-md-12 mt-4">
                                <button type="submit" class="subscribe btn btn-success btn-lg btn-block">Place Order</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>


@endsection


@push('js')
<!-- <script type="text/javascript">
	// Set your publishable key: remember to change this to your live publishable key in production
	// See your keys here: https://dashboard.stripe.com/account/apikeys
	var stripe = Stripe('pk_test_TYooMQauvdEDq54NiTphI7jx');
	var elements = stripe.elements();

	// Custom styling can be passed to options when creating an Element.
	var style = {
		base: {
		    // Add your base input styles here. For example:
		    fontSize: '16px',
		    color: '#32325d',
		},
	};

	// Create an instance of the card Element.
	var card = elements.create('card', {style: style});

	// Add an instance of the card Element into the `card-element` <div>.
	card.mount('#card-element');

	// Create a token or display an error when the form is submitted.
	var form = document.getElementById('payment-form');
	form.addEventListener('submit', function(event) {
		event.preventDefault();
		stripe.createToken(card).then(function(result) {
		    if (result.error) {
		      // Inform the customer that there was an error.
		      var errorElement = document.getElementById('card-errors');
		      errorElement.textContent = result.error.message;
		    } else {
		      // Send the token to your server.
		      stripeTokenHandler(result.token);
		    }
		});
	});
</script> -->

<script>


	// var $form = $("#payment-form");
 //    // Create a Stripe client
 //    var stripe = Stripe("{{ env('STRIPE_KEY') }} ");

	//  // Create an instance of Elements
	//  var elements = stripe.elements();

 //         // Custom styling can be passed to options when creating an Element.
 //         // (Note that this demo uses a wider set of styles than the guide below.)
 //         var style = {
 //             base: {
 //                 color: '#32325d',
 //                 lineHeight: '24px',
 //                 fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
 //                 fontSmoothing: 'antialiased',
 //                 fontSize: '16px',
 //                 '::placeholder': {
 //                    color: '#aab7c4'
 //                 }
 //            },
 //            invalid: {
 //               color: '#fa755a',
 //               iconColor: '#fa755a'
 //            }
 //     };

 //     // Create an instance of the card Element
 //     var card = elements.create('card', {style: style});

 //     // Add an instance of the card Element into the `card-element` <div>
 //     card.mount('#card-element');

 //     // Handle real-time validation errors from the card Element.
 //     card.addEventListener('change', function(event) {
 //         var displayError = document.getElementById('card-errors');
 //         if (event.error) {
 //             displayError.textContent = event.error.message;
 //         } else {
 //           displayError.textContent = '';
 //         }
 //     });

 //     // Handle form submission

 //     var form = document.getElementById('payment-form');
 //     form.addEventListener('submit', function(event) {
 //           event.preventDefault();
 //           stripe.createToken(card).then(function(result) {
 //           if (result.error) {
 //               // Inform the user if there was an error
 //               var errorElement = document.getElementById('card-errors');
 //               errorElement.textContent = result.error.message;
 //           } else {
 //              // Send the token to your server
 //              stripeResponseHandler(result.token);
 //           }
 //        });
 //    });
    </script>

<!-- here last  -->
<!-- <script>
	$(function() {
	  $('form.require-validation').bind('submit', function(e) {
	  	console.log('bind')
	    var $form         = $(e.target).closest('form'),
	        inputSelector = ['input[type=email]', 'input[type=password]',
	                         'input[type=text]', 'input[type=file]',
	                         'textarea'].join(', '),
	        $inputs       = $form.find('.required').find(inputSelector),
	        $errorMessage = $form.find('div.error'),
	        valid         = true;
	    $errorMessage.addClass('hide');
	    $('.has-error').removeClass('has-error');
	    $inputs.each(function(i, el) {
	      var $input = $(el);
	      if ($input.val() === '') {
	        $input.parent().addClass('has-error');
	        $errorMessage.removeClass('hide');
	        e.preventDefault(); // cancel on first error
	      }
	    });
	  });
	});

	function stripeResponseHandler(status, response) {
		var $form = $("#payment-form");
	    if (response.error) {
	    	$form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
	    	$('.error')
		        .removeClass('hide')
		        .find('.alert')
		        .text(response.error.message);
		    }
		else {
	    	// token contains id, last4, and card type
	      	var token = response['id'];
	      	// insert the token into the form so it gets submitted to the server
	      	$form.find('input[type=text]').empty();
	      	$form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
	      	$form.get(0).submit();
	    }
  	}

	$(function() {
	  var $form = $("#payment-form");
	  $form.on('submit', function(e) {
	    if (!$form.data('cc-on-file')) {
	    	console.log('cccccccccccc')
	      e.preventDefault();
	      var stripe = Stripe($form.data('stripe-publishable-key'));
	      await stripe.createToken({
	        number: $('.card-number').val(),
	        cvc: $('.card-cvc').val(),
	        exp_month: $('.card-expiry-month').val(),
	        exp_year: $('.card-expiry-year').val()
	      }, stripeResponseHandler(200, 'kjjk'));

	      $.ajax({
	          url: "pay",
	          type:"POST",
	          data:{
	            "_token": "{{ csrf_token() }}",
	            stripeToken:stripeToken,
	          },
	          success:function(response){
	            console.log(response);
	          },
	         });
	    }else{
	    	console.log('not cccccccccccccccccccc')
	    }
	  });

	})
</script> -->



<!-- <script type="text/javascript">

	$(function() {
		$('form.require-validation').bind('submit', function(e) {
		    var $form         = $(e.target).closest('form'),
		        inputSelector = ['input[type=email]', 'input[type=password]',
		                         'input[type=text]', 'input[type=file]',
		                         'textarea'].join(', '),
		        $inputs       = $form.find('.required').find(inputSelector),
		        $errorMessage = $form.find('div.error'),
		        valid         = true;

		        console.log('form:::'+$form);

			    $errorMessage.addClass('hide');
			    $('.has-error').removeClass('has-error');
			    $inputs.each(function(i, el) {
			      var $input = $(el);
			      if ($input.val() === '') {
			        $input.parent().addClass('has-error');
			        $errorMessage.removeClass('hide');
			        e.preventDefault(); // cancel on first error
			      }
			    });

			$form.on('submit', function(e) {
			    if (!$form.data('cc-on-file')) {
			      e.preventDefault();
			      Stripe.setPublishableKey($form.data('stripe-publishable-key'));
			      Stripe.createToken({
			        number: $('.card-number').val(),
			        cvc: $('.card-cvc').val(),
			        exp_month: $('.card-expiry-month').val(),
			        exp_year: $('.card-expiry-year').val()
			      }, stripeResponseHandler);
			    }
			});
		});
	});

	function stripeResponseHandler(status, response) {
		//console.log('response here::::'+response)
	    if (response.error) {
	        $('.error')
	            .removeClass('hide')
	            .find('.alert')
	            .text(response.error.message);
	    } else {
	        // token contains id, last4, and card type
	        var token = response['id'];
	        // insert the token into the form so it gets submitted to the server
	        $form.find('input[type=text]').empty();
	        $form.append("<input type='hidden' name='stripeToken' value='" +token  + "'/>");
	        $form.get(0).submit();
	    }
	}

</script> -->
@endpush
