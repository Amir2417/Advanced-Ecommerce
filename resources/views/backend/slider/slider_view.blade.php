@extends('admin.admin_master')
@section('admin')

<div class="container-full">
    <div class="content">
        <div class="row">


            <div class="col-8">

                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Slider List</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Status</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($sliders as $item)
                                    <tr>
                                         <td><img src="{{ asset($item->slider_img) }}"style="width:75px;height:75px;"></td>
                                        <td>
                                            @if($item->title== NULL)
                                            <span class="badge badge-pill badge-danger">No Title</span>
                                            @else
                                            <span class="badge badge-pill badge-success">{{$item->title}}</span>
                                            @endif

                                        </td>
                                        <td>
                                            @if($item->description== NULL)
                                            <span class="badge badge-pill badge-danger">No Description</span>
                                            @else
                                            <span class="badge badge-pill badge-success">{{$item->description}}</span>
                                            @endif

                                        </td>
                                        <td>
                                            @if($item->status ==1)
                                                <span class="badge badge-pill badge-success">Active</span>
                                            @else
                                                <span class="badge badge-pill badge-danger">InActive</span>
                                            @endif
                                        </td>
                                        <td width="30%">
                                            <a class="btn btn-primary" href="{{ route('slider.edit',$item->id) }}" title="Edit Data"><i class="fa fa-pencil"></i></a>

                                            <a class="btn btn-danger" id="delete" href="{{ route('slider.delete',$item->id) }}" title="Delete Data"><i class="fa fa-trash"></i></a>
                                            
                                            @if($item->status ==1)
                                            <a class="btn btn-primary" href="{{ route('slider.inactive',$item->id) }}" title="InActive Now"><i class="fa fa-arrow-down"></i></a>
                                            @else
                                            <a class="btn btn-primary" href="{{ route('slider.active',$item->id) }}" title="Active Now"><i class="fa fa-arrow-up"></i></a>
                                            @endif
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
                            <h3 class="box-title">Add Slider</h3>
                    </div>
                        <div class="card-body">
                            <form action="{{ route('slider.store')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <h5>Slider Title<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="title" class="form-control">

                                    </div>
                                </div>
                                <div class="form-group">
                                        <h5>Slider Description<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="description" class="form-control" >

                                    </div>
                                </div>
                                <div class="form-group">
                                        <h5>Slider Image <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="file" name="slider_img" class="form-control" >
                                        @error('slider_img')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="text-xs-right">
                                    <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Add Slider">

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
