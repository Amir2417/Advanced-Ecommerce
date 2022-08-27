@extends('admin.admin_master')
@section('admin')

<div class="container-full">
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                            <h3 class="box-title">Edit District</h3>
                    </div>
                        <div class="card-body">
                            <form action="{{ route('district.update',$districts->id)}}" method="post">
                                @csrf
                                <div class="form-group">
								    <h5>District Select <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select name="division_id" class="form-control">
                                            <option value="" selected="" disabled="">Select District</option>
                                            @foreach($divisions as $division)
                                            <option value="{{ $division->id }}" {{ $division->id==$districts->division_id?'selected':''}}  >{{$division->division_name}}</option>
                                            @endforeach
                                        </select>
                                        @error('division_id')
                                                <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <h5>District Name<span class="text-danger">*</span>
                                    </h5>
                                    <div class="controls">
                                        <input type="text" name="district_name" class="form-control">
                                        @error('district_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="text-xs-right">
                                    <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Update">
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
