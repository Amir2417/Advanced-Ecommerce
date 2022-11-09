@extends('frontend.main_master')
@section('content')
@section('title')
Stripe Payment Page
@endsection
<style>

.StripeElement {
  box-sizing: border-box;
  height: 40px;
  padding: 10px 12px;
  border: 1px solid transparent;
  border-radius: 4px;
  background-color: white;
  box-shadow: 0 1px 3px 0 #e6ebf1;
  -webkit-transition: box-shadow 150ms ease;
  transition: box-shadow 150ms ease;
}
.StripeElement--focus {
  box-shadow: 0 1px 3px 0 #cfd7df;
}
.StripeElement--invalid {
  border-color: #fa755a;
}
.StripeElement--webkit-autofill {
  background-color: #fefde5 !important;}
</style>


<div class="breadcrumb">
	<div class="container">
		<div class="breadcrumb-inner">
			<ul class="list-inline list-unstyled">
				<li><a href="#">Home</a></li>
				<li class='active'>Stripe</li>
			</ul>
		</div><!-- /.breadcrumb-inner -->
	</div><!-- /.container -->
</div><!-- /.breadcrumb -->
<div class="body-content">
	<div class="container">
		<div class="checkout-box ">
			<div class="row">
				<div class="col-md-6">
					<!-- checkout-progress-sidebar -->
                    <div class="checkout-progress-sidebar ">
                        <div class="panel-group">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="unicase-checkout-title">Your Shopping Amount</h4>
                                </div>
                                <div class="">
                                    <ul class="nav nav-checkout-progress list-unstyled">
                                        <hr>
                                        <li><b> Sub Total  ${{ $cartTotal }} </b></li><hr>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
				<div class="col-md-6">
                    <div class="checkout-progress-sidebar ">
                        <div class="panel-group">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="unicase-checkout-title">Select Payment Method</h4>
                                </div>
                                <form action="{{ route('stripe.order') }} " method="post" id="payment-form">
                                    @csrf
                                    <div class="form-row">
                                        <label for="card-element">
                                        <input type="hidden" name="name" value="{{ $data['shipping_name'] }}">
                                        <input type="hidden" name="email" value="{{ $data['shipping_email'] }}">
                                        <input type="hidden" name="phone" value="{{ $data['shipping_phone'] }}">
                                        <input type="hidden" name="post_code" value="{{ $data['post_code'] }}">
                                        <input type="hidden" name="division_id" value="{{ $data['division_id'] }}">
                                        </label>
                                        <input type="hidden" name="district_id" value="{{ $data['district_id'] }}">
                                        </label>
                                        <input type="hidden" name="state_id" value="{{ $data['state_id'] }}">
                                        </label>
                                        <input type="hidden" name="notes" value="{{ $data['notes'] }}">
                                        </label>

                                        <div id="card-element">
                                        <!-- A Stripe Element will be inserted here. -->
                                        </div>
                                        <!-- Used to display form errors. -->
                                        <div id="card-errors" role="alert"></div>
                                    </div>
                                    <br>
                                    <button class="btn btn-primary">Submit Payment</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
			</div>
		</div>
    </div>
</div>
<script type="text/javascript">

var stripe = Stripe('pk_test_51KK6g7JPRcCF9jDyFgVNWp9cr8FGhzXimpuVbLIfsJZ2ZB6M3Z3uiecHjBaMA6yn3BHvuRVmReKRh31MwN4KnU4E00wY1QQHLS');

var elements = stripe.elements();

var style = {
  base: {
    color: '#32325d',
    fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
    fontSmoothing: 'antialiased',
    fontSize: '16px',
    '::placeholder': {
      color: '#aab7c4'
    }
  },
  invalid: {
    color: '#fa755a',
    iconColor: '#fa755a'
  }
};

var card = elements.create('card', {style: style});

card.mount('#card-element');

card.on('change', function(event) {
  var displayError = document.getElementById('card-errors');
  if (event.error) {
    displayError.textContent = event.error.message;
  } else {
    displayError.textContent = '';
  }
});

var form = document.getElementById('payment-form');
form.addEventListener('submit', function(event) {
  event.preventDefault();
  stripe.createToken(card).then(function(result) {
    if (result.error) {

      var errorElement = document.getElementById('card-errors');
      errorElement.textContent = result.error.message;
    } else {

      stripeTokenHandler(result.token);
    }
  });
});

function stripeTokenHandler(token) {

  var form = document.getElementById('payment-form');
  var hiddenInput = document.createElement('input');
  hiddenInput.setAttribute('type', 'hidden');
  hiddenInput.setAttribute('name', 'stripeToken');
  hiddenInput.setAttribute('value', token.id);
  form.appendChild(hiddenInput);

  form.submit();
}
</script>
@endsection
