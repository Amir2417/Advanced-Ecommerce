@extends('admin.admin_master')
@section('admin')
<div class="container-full">
    <div class="content">
        <div class="row">
            <div class="col-md-6 col-12">
                <div class="card">
                    <div class="card-header"><h4>Shipping Details</h4></div>
                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <th>Shipping Name:</th>
                                <th>{{ $order->name }}</th>
                            </tr>
                            <tr>
                                <th>Shipping Email:</th>
                                <th>{{ $order->email }}</th>
                            </tr>
                            <tr>
                                <th>Shipping Phone:</th>
                                <th>{{ $order->phone }}</th>
                            </tr>
                            <tr>
                                <th>Division :</th>
                                <th>{{ $order->division->division_name }}</th>
                            </tr>
                            <tr>
                                <th>District :</th>
                                <th>{{ $order->district->district_name }}</th>
                            </tr>
                            <tr>
                                <th>State :</th>
                                <th>{{ $order->state->state_name }}</th>
                            </tr>
                            <tr>
                                <th>Post Code :</th>
                                <th>{{ $order->post_code }}</th>
                            </tr>
                            <tr>
                                <th>Order Date :</th>
                                <th>{{ $order->order_date }}</th>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="card">
                    <div class="card-header"><h4>Order Details For
                        <span style="color:red">Invoice : {{ $order->invoice_no }}</span></h4>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <th>Name:</th>
                                <th>{{ $order->user->name }}</th>
                            </tr>
                            <tr>
                                <th>Email:</th>
                                <th>{{ $order->user->email }}</th>
                            </tr>
                            <tr>
                                <th>Phone:</th>
                                <th>{{ $order->phone }}</th>
                            </tr>
                            <tr>
                                <th>Payment Type:</th>
                                <th>{{ $order->payment_type }}</th>
                            </tr>
                            <tr>
                                <th>Payment Method :</th>
                                <th>{{ $order->payment_method }}</th>
                            </tr>
                            <tr>
                                <th>Tranx ID :</th>
                                <th>{{ $order->transaction_id}}</th>
                            </tr>
                            <tr>
                                <th>Order Total :</th>
                                <th>{{ $order->amount }}</th>
                            </tr>
                            <tr>
                                <th>Order :</th>
                                <th><span class="badge badge-pill badge-warning" style="background: #418DB9">{{ $order->status }}</span></th>

                            </tr>

                        </table>
                        <div class="box-tools">
                            <div class="input-group input-group-sm hidden-xs" >
                                <div class="text-right">
                                    @if ($order->status == 'pending')
                                        <a href="{{ route('pending.confirm',$order->id) }}" class="btn btn-success btn-flat" id="confirm"> Confirm Order </a>

                                    @elseif ($order->status == 'confirm')
                                        <a href="{{ route('confirm.processing',$order->id) }}" class="btn btn-success btn-flat" id="processing"> Processing Order </a>

                                    @elseif ($order->status == 'processing')
                                        <a href="{{ route('processing.picked',$order->id) }}" class="btn btn-success btn-flat" id="picked"> Picked Order </a>

                                    @elseif ($order->status == 'picked')
                                        <a href="{{ route('picked.shipped',$order->id) }}" class="btn btn-success btn-flat" id="shipped"> Shipped Order </a>
                                        
                                    @elseif ($order->status == 'shipped')
                                        <a href="{{ route('shipped.delivered',$order->id) }}" class="btn btn-success btn-flat" id="delivered"> Delivered Order </a>
                                    @else

                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><h4>Product Information</h4></div>
                    <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <td class="col-md-1">
                                    <label for="date">Image</label>
                                </td>
                                <td class="col-md-4">
                                    <label for="amount">Product Name</label>
                                </td>
                                <td class="col-md-1">
                                    <label for="Method">Product Code</label>
                                </td>
                                <td class="col-md-1">
                                    <label for="Invoice">Color</label>
                                </td>
                                <td class="col-md-1">
                                    <label for="Order">Size</label>
                                </td>
                                <td class="col-md-1">
                                    <label for="Action">Quantity</label>
                                </td>
                                <td class="col-md-1">
                                    <label for="Action">Price</label>
                                </td>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach ($orderItem as $item)
                                <tr>
                                    <td class="col-md-1">
                                        <label for="date"><img src="{{ asset($item->product->product_thambnail) }}" width="50px;" height="50px;" alt="" srcset=""></label>
                                    </td>
                                    <td class="col-md-4">
                                        <label for="amount">{{ $item->product->product_name_en }}</label>
                                    </td>
                                    <td class="col-md-1">
                                        <label for="Method">{{ $item->product->product_code }}</label>
                                    </td>
                                    <td class="col-md-1">
                                        <label for="Invoice">{{ $item->color }}</label>
                                    </td>
                                    <td class="col-md-1">
                                        {{ $item->size }}
                                    </td>
                                    <td class="col-md-1">
                                        {{ $item->qty }}
                                    </td>
                                    <td class="col-md-1">
                                        ${{ $item->product->discount_price }}  (${{ $item->product->discount_price * $item->qty }})
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>

                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
