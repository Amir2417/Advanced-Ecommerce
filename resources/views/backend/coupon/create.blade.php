@extends('admin.admin_master')
@section('admin')

<div class="container-full">
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                            <h3 class="box-title">Add Coupon</h3>
                    </div>
                        <div class="card-body">
                            <form action="{{ route('coupon.store')}}" method="post">
                                @csrf
                                <div class="form-group">
                                    <h5>Coupon Name<span class="text-danger">*</span>
                                    </h5>
                                    <div class="controls">
                                        <input type="text" name="coupon_name" class="form-control">
                                        @error('coupon_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                        <h5>Coupon Discount (%)<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="coupon_discount" class="form-control"  >
                                        @error('coupon_discount')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                        <h5>Coupon Validity <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="date" name="coupon_validity" class="form-control" min="{{ Carbon\Carbon::now()->format('Y-m-d') }}">
                                        @error('coupon_validity')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="text-xs-right">
                                    <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Add Coupon">

                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
