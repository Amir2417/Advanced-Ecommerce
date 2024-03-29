@extends('admin.admin_master')
@section('admin')

<div class="container-full">
    <div class="content">
        <div class="row">


            <div class="col-md-12">

                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">SubCategory List</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Product En</th>
                                        <th>Product Price</th>
                                        <th>Quantity</th>
                                        <th>Discount</th>
                                        <th>Status</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($products as $item)
                                    <tr>
                                        <td><img src="{{asset($item->product_thambnail) }}" style="width:100px;height:100px;"></td>
                                        <td>{{$item->product_name_en}}</td>
                                        <td>{{$item->selling_price}}$</td>
                                        <td>{{$item->product_qty}}pic</td>
                                        <td>
                                            @if($item->discount_price ==NULL)
                                            <span class="badge badge-pill badge-danger">No Discount Available</span>

                                            @else
                                            @php
                                                $amount = $item->selling_price - $item->discount_price;
                                                $discount = ($amount/$item->selling_price)*100;

                                            @endphp
                                            <span class="badge badge-pill badge-success">{{ round($discount) }}%</span>
                                            @endif

                                        </td>
                                        <td>
                                           @if($item->status == 1)
                                           <span class="badge badge-pill badge-success">Active</span>
                                           @else
                                           <span class="badge badge-pill badge-danger">Inactive</span>
                                           @endif
                                        </td>
                                        <td width="30%">
                                            <a class="btn btn-primary" href="{{ route('product.edit',$item->id) }}" title="Product Details Data"><i class="fa fa-eye"></i></a>
                                            <a class="btn btn-primary" href="{{ route('product.edit',$item->id) }}" title="Edit Data"><i class="fa fa-pencil"></i></a>
                                            <a class="btn btn-danger" id="delete" href="{{ route('product.delete',$item->id) }}" title="Delete Data"><i class="fa fa-trash"></i></a>

                                            @if($item->status == 1)
                                            <a class="btn btn-danger" href="{{ route('product.inactive',$item->id) }}" title="Inactive Now"><i class="fa fa-arrow-down"></i></a>
                                            @else
                                            <a class="btn btn-success" href="{{ route('product.active',$item->id) }}" title="Active Now"><i class="fa fa-arrow-up"></i></a>
                                            @endif

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
    </div>
</div>

@endsection
