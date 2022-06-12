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
                                        <th>Thambnail Image</th>
                                        <th>Product Name English</th>
                                        <th>Product Name Bangla</th>
                                        <th>Product Quantity</th>
                                        <th>Action</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($products as $item)
                                    <tr>
                                        <td><img src="{{asset($item->product_thambnail) }}" style="width:100px;height:100px;"></td>
                                        <td>{{$item->product_name_en}}</td>
                                        <td>{{$item->product_name_ban}}</td>
                                        <td>{{$item->product_qty}}</td>
                                        <td>
                                            <a class="btn btn-primary" href="{{ route('product.edit',$item->id) }}" title="Edit Data"><i class="fa fa-pencil"></i></a>
                                            <a class="btn btn-danger" id="delete" href="{{ route('subcategory.delete',$item->id) }}" title="Delete Data"><i class="fa fa-trash"></i></a>
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