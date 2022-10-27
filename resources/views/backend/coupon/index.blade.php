@extends('admin.admin_master')
@section('admin')
<div class="container-full">
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Coupon List</h3>
                        <div class="box-tools">
                            <div class="input-group input-group-sm hidden-xs" >
                                <div class=" text-right">
                                    <a href="{{ route('coupon.show') }}" class="btn btn-success btn-flat"> ADD NEW </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Coupon Name</th>
                                        <th>Coupon Discount (%)</th>
                                        <th>Coupon Validity</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($coupons as $item)
                                    <tr>
                                        <td>{{$item->coupon_name}}</td>
                                        <td>{{$item->coupon_discount}}</td>
                                        <td>{{ Carbon\Carbon::parse($item->coupon_validity)->format('l, d F, Y') }}
                                            </td>
                                        <td>
                                            @if($item->coupon_validity >= Carbon\Carbon::now()->format('Y-m-d'))
                                                <span class="badge badge-pill badge-success">Valid</span>
                                            @else
                                                <span class="badge badge-pill badge-danger">InValid</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a class="btn btn-primary" href="{{ route('coupon.edit',$item->id) }}" title="Edit Data"><i class="fa fa-pencil"></i></a>
                                            <a class="btn btn-danger" id="delete" href="{{ route('coupon.delete',$item->id) }}" title="Delete Data"><i class="fa fa-trash"></i></a>
                                        </td>
                                   @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
