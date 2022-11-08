@extends('frontend.main_master')
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
@section('title')
My Checkout Page
@endsection
<div class="breadcrumb">
	<div class="container">
		<div class="breadcrumb-inner">
			<ul class="list-inline list-unstyled">
				<li><a href="#">Home</a></li>
				<li class='active'>Checkout</li>
			</ul>
		</div><!-- /.breadcrumb-inner -->
	</div><!-- /.container -->
</div><!-- /.breadcrumb -->
<div class="body-content">
	<div class="container">
		<div class="checkout-box ">
			<div class="row">
				<div class="col-md-8">
					<div class="panel-group checkout-steps" id="accordion">
						<!-- checkout-step-01  -->
                        <div class="panel panel-default checkout-step-01">
                            <div id="collapseOne" class="panel-collapse collapse in">
                                <!-- panel-body  -->
                                <div class="panel-body">
                                    <div class="row">
                                        <!-- guest-login -->
                                        <div class="col-md-6 col-sm-6 already-registered-login">
                                            <h4 class="checkout-subtitle"><b>Shipping Address</b></h4>
                                            <p class="text title-tag-line">Please log in below:</p>
                                            <form class="register-form" role="form">
                                                <div class="form-group">
                                                    <label class="info-title" for="exampleInputEmail1">Shipping Name <span>*</span></label>
                                                    <input type="text" name="shipping_name" class="form-control unicase-form-control text-input" id="exampleInputEmail1" value="{{ Auth::user()->name }}" required>
                                                </div>
                                                <div class="form-group">
                                                    <label class="info-title" for="exampleInputEmail1">Email <span>*</span></label>
                                                    <input type="email" name="shipping_email" class="form-control unicase-form-control text-input" id="exampleInputEmail1" value="{{ Auth::user()->email }}" required>
                                                </div>
                                                <div class="form-group">
                                                    <label class="info-title" for="exampleInputEmail1">Phone <span>*</span></label>
                                                    <input type="number" name="shipping_phone" class="form-control unicase-form-control text-input" id="exampleInputEmail1" value="{{ Auth::user()->phone }}" required>
                                                </div>
                                                <div class="form-group">
                                                    <label class="info-title" for="exampleInputEmail1">Post Code <span>*</span></label>
                                                    <input type="text" name="post_code" class="form-control unicase-form-control text-input" id="exampleInputEmail1" placeholder="Post Code" required>
                                                </div>

                                        </div>
                                        <!-- guest-login -->
                                        <!-- already-registered-login -->
                                        <div class="col-md-6 col-sm-6 already-registered-login">
                                            <div class="form-group">
                                                <h5><b> Division Select</b> <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <select name="division_id" class="form-control" required>
                                                        <option value="" selected="" disabled="">Select Division</option>
                                                        @foreach($divisions as $item)
                                                        <option value="{{ $item->id }}">{{$item->division_name}}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('division_id')
                                                            <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <h5><b> District Select </b><span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <select name="district_id" class="form-control" required>
                                                        <option value="" selected="" disabled="">Select District</option>

                                                    </select>
                                                    @error('district_id')
                                                            <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <h5><b> State Select</b> <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <select name="state_id" class="form-control" required>
                                                        <option value="" selected="" disabled="">Select State</option>

                                                    </select>
                                                    @error('division_id')
                                                            <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <h5><b> Notes</b> <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <textarea class="form-control" name="notes" id="" cols="30" rows="10"></textarea>
                                                </div>
                                            </div>


                                            </form>
                                        </div>
                                        <!-- already-registered-login -->
                                    </div>
                                </div>
                                <!-- panel-body  -->
                            </div><!-- row -->
                        </div>
                        <!-- checkout-step-01  -->
					</div><!-- /.checkout-steps -->
				</div>
				<div class="col-md-4">
					<!-- checkout-progress-sidebar -->
                    <div class="checkout-progress-sidebar ">
                        <div class="panel-group">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="unicase-checkout-title">Your Checkout Progress</h4>
                                </div>
                                <div class="">
                                    <ul class="nav nav-checkout-progress list-unstyled">

                                        @foreach ($carts as $item)
                                            <li>
                                                <strong>Image: </strong>
                                                <img src="{{ $item->options->image }}" style="width: 75px;" srcset="">
                                            </li>
                                            <li>
                                                <strong>Qty: </strong>
                                                ( {{ $item->qty }} )
                                                <strong>Color: </strong>
                                                {{ $item->options->color }}
                                                <strong>Size: </strong>
                                                {{ $item->options->size }}
                                            </li>
                                        @endforeach
                                        <hr>
                                        <li>Sub Total {{ $cartTotal }}</li><hr>
                                        <li><a href="#">Payment Method</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
			</div><!-- /.row -->
		</div><!-- /.checkout-box -->
    </div>
</div><!-- /.body-content -->
<script type="text/javascript">
    $(document).ready(function(){
        $('select[name ="division_id"]').on('change',function(){
            var division_id = $(this).val();
            if(division_id) {
                $.ajax({
                    url: "{{ url('/district_get/ajax') }}/"+division_id,
                    type:"GET",
                    dataType:"json",
                    success:function(data) {
                            $('select[name="state_id"]').html('');
                        var d = $('select[name="district_id"]').empty();
                        $.each(data,function(key,value){
                            $('select[name ="district_id"]').append('<option value="'+ value.id +'">' + value.district_name + '</option>');
                        });
                    },
                });
            }
            else{
                alert('danger');
            }
        });

$('select[name ="district_id"]').on('change',function(){
            var district_id = $(this).val();
            if(district_id) {
                $.ajax({
                    url: "{{ url('/state_get/ajax') }}/"+district_id,
                    type:"GET",
                    dataType:"json",
                    success:function(data) {
                        var d = $('select[name="state_id"]').empty();
                        $.each(data,function(key,value){
                            $('select[name ="state_id"]').append('<option value="'+ value.id +'">' + value.state_name + '</option>');
                        });
                    },
                });
            }
            else{
                alert('danger');
            }
        });
    });
</script>
@endsection
