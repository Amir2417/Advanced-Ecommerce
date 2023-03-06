@extends('frontend.main_master')
@section('content')


<div class="body-content">
    <div class="container">
        <div class="row">
            @include('frontend.common.use_sidebar')

            <div class="col-md-10">
                <div class="table-responsive">
                    <h3 class="text-center">Order List</h3>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr style="background: #e2e2e2;">
                                <td class="col-md-1">
                                    <label for="date">Date</label>
                                </td>
                                <td class="col-md-1">
                                    <label for="amount">Amount</label>
                                </td>
                                <td class="col-md-3">
                                    <label for="Method">Payment Method</label>
                                </td>
                                <td class="col-md-2">
                                    <label for="Invoice">Invoice</label>
                                </td>
                                <td class="col-md-2">
                                    <label for="Order">Order</label>
                                </td>
                                <td class="col-md-3">
                                    <label for="Action">Action</label>
                                </td>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach ($orders as $order)
                                <tr>
                                    <td class="col-md-1">
                                        <label for="date">{{ $order->order_date }}</label>
                                    </td>
                                    <td class="col-md-1">
                                        <label for="amount">$ {{ $order->amount }}</label>
                                    </td>
                                    <td class="col-md-3">
                                        <label for="Method">{{ $order->payment_method }}</label>
                                    </td>
                                    <td class="col-md-2">
                                        <label for="Invoice">{{ $order->invoice_no }}</label>
                                    </td>
                                    <td class="col-md-2">
                                        <label for="Order">
                                            <span class="badge badge-pill badge-warning" style="background: #418DB9">{{ $order->status }}</span>

                                        </label>
                                    </td>
                                    <td class="col-md-3">
                                        <a href=" " class="btn btn-primary"><i class="fa fa-eye">View</i></a>
                                        <a href=" " class="btn btn-danger"><i class="fa fa-download">Invoice</i></a>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>

                    </table>
                    {{ $orders->links() }}
                </div>
            </div>
        </div>
    </div>
</div>




@endsection
