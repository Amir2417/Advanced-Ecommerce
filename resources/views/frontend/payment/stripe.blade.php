@extends('frontend.main_master')
@section('content')

@section('title')
Stripe Payment Page
@endsection
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
					<!-- checkout-progress-sidebar -->
                    <div class="checkout-progress-sidebar ">
                        <div class="panel-group">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="unicase-checkout-title">Select Payment Method</h4>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="stripe">Stripe</label>
                                        <input type="radio" name="payment_method" value="stripe" id="">
                                        <img src="{{ asset('frontend/assets/images/payments/2.png') }}" alt="">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="card">Card</label>
                                        <input type="radio" name="payment_method" value="card" id="">
                                        <img src="{{ asset('frontend/assets/images/payments/3.png') }}" alt="">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="cash">Cash</label>
                                        <input type="radio" name="payment_method" value="cash" id="">
                                        <img src="{{ asset('frontend/assets/images/payments/4.png') }}" alt="">
                                    </div>
                                </div>
                                <hr>
                                <button type="submit" class="btn-upper btn btn-primary checkout-page-button">Payment Step</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
			</div><!-- /.row -->

		</div><!-- /.checkout-box -->
    </div>
</div><!-- /.body-content -->

@endsection
