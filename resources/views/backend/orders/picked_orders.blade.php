@extends('admin.admin_master')
@section('admin')
<div class="container-full">
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Picked Order List</h3>
                        <div class="box-tools">
                            <div class="input-group input-group-sm hidden-xs" >
                                <div class=" text-right">

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
                                        <th>Date</th>
                                        <th>Amount</th>
                                        <th>Payment Method</th>
                                        <th>Invoice</th>
                                        <th>Order</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($orders as $item)
                                    <tr>
                                        <td>{{$item->order_date}}</td>
                                        <td>{{$item->amount}}</td>
                                        <td>{{ $item->payment_method }}</td>
                                        <td>{{ $item->invoice_no }}</td>
                                        <td>                                    <span class="badge badge-pill badge-warning" style="background: #418DB9">{{ $item->status }}</span></td>
                                        <td>
                                            <a class="btn btn-primary" href="{{ route('order_details',$item->id) }}" title="Edit Data"><i class="fa fa-pencil"></i></a>
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
