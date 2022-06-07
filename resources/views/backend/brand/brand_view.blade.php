@extends('admin.admin_master')
@section('admin')

<div class="container-full">
    <div class="content">
        <div class="row">

        
            <div class="col-8">

                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Brand List</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Brand En</th>
                                        <th>Brand Hin</th>
                                        <th>Image</th>
                                        <th>Action</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($brands as $item)
                                    <tr>
                                        <td>{{$item->brand_name_en}}</td>
                                        <td>{{$item->brand_name_hin}}</td>
                                        <td><img src="{{ asset($item->brand_image) }}" alt=""></td>
                                        <td>
                                            <a class="btn btn-primary" href="">Edit</a>
                                            <a class="btn btn-danger" href="">Delete</a>
                                        </td>
                                        
                                   @endforeach 
                                </tbody>
                                
                            </table>
                        </div>
                    </div>
                   
                </div>       
            </div>
            
            <div class="col-md-4">
                <div class="box">
                    <div class="box-header with-border">
                            <h3 class="box-title">Add Brand</h3>
                    </div>
                        <div class="card-body">
                            <form action="{{ route('brand.store')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <h5>Brand Name English<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="brand_name_en" class="form-control" > 
                                    </div>
                                </div>
                                <div class="form-group">
                                        <h5>Brand Name Hindi<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="brand_name_en" class="form-control" > 
                                    </div>
                                </div>
                                <div class="form-group">
                                        <h5>Brand Image <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="file" name="brand_image" class="form-control" > 
                                    </div>
                                </div>
                                    
                                    
                                <div class="text-xs-right">
                                    <button type="submit" class="btn btn-rounded btn-info">Add Brand</button>
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