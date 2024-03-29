@extends('admin.admin_master')
@section('admin')
<div class="container-full">
    <div class="content">
        <div class="row">
            <div class="col-8">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Division List</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Division Name</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($divisions as $item)
                                    <tr>
                                        <td>{{$item->division_name}}</td>
                                        <td>
                                            @if($item->status == 1)
                                            <span class="badge badge-pill badge-success">Active</span>
                                            @else
                                            <span class="badge badge-pill badge-danger">Inactive</span>
                                            @endif
                                         </td>
                                        <td>
                                            <a class="btn btn-primary" href="{{ route('division.edit',$item->id) }}" title="Edit Data"><i class="fa fa-pencil"></i></a>
                                            <a class="btn btn-danger" id="delete" href="{{ route('division.delete',$item->id) }}" title="Delete Data"><i class="fa fa-trash"></i></a>

                                            @if($item->status == 1)
                                            <a class="btn btn-danger" href="{{ route('division.inactive',$item->id) }}" title="Inactive Now"><i class="fa fa-arrow-down"></i></a>
                                            @else
                                            <a class="btn btn-success" href="{{ route('division.active',$item->id) }}" title="Active Now"><i class="fa fa-arrow-up"></i></a>
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
                            <h3 class="box-title">Add Division</h3>
                    </div>
                        <div class="card-body">
                            <form action="{{ route('division.store')}}" method="post">
                                @csrf
                                <div class="form-group">
                                    <h5>Division Name<span class="text-danger">*</span>
                                    </h5>
                                    <div class="controls">
                                        <input type="text" name="division_name" class="form-control">
                                        @error('division_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="text-xs-right">
                                    <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Add Division">

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
