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
                                        <th>Brand Ban</th>
                                        <th>Image</th>
                                        <th>Action</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($brands as $item)
                                    <tr>
                                        <td>{{$item->brand_name_en}}</td>
                                        <td>{{$item->brand_name_hin}}</td>
                                        <td><img src="{{ asset($item->brand_image) }}"style="width:75px;height:75px;"></td>
                                        <td>
                                            <a class="btn btn-primary" href="{{ route('brand.edit',$item->id) }}">Edit</a>
                                            <a class="btn btn-danger" id="delete" href="">Delete</a>
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
                                        <input type="text" name="brand_name_en" class="form-control">
                                        @error('brand_name_en')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                        <h5>Brand Name Bangla<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="brand_name_hin" class="form-control" > 
                                        @error('brand_name_hin')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                        <h5>Brand Image <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="file" name="brand_image" class="form-control" > 
                                        @error('brand_image')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                    
                                    
                                <div class="text-xs-right">
                                    <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Add Brand">
                                    
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