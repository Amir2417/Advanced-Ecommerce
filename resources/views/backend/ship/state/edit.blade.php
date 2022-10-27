@extends('admin.admin_master')
@section('admin')
<div class="container-full">
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                            <h3 class="box-title">Edit State</h3>
                    </div>
                        <div class="card-body">
                            <form action="{{ route('state.update',$states->id)}}" method="post">
                                @csrf
                                <div class="form-group">
								    <h5>Division Select <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select name="division_id" class="form-control">
                                            <option value="" selected="" disabled="">Select Division</option>
                                            @foreach($divisions as $division)
                                            <option value="{{ $division->id }}" {{ $division->id==$states->division_id?'selected':''}}  >{{$division->division_name}}</option>
                                            @endforeach
                                        </select>
                                        @error('division_id')
                                                <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
								    <h5>District Select <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select name="district_id" class="form-control">
                                            <option value="" selected="" disabled="">Select District</option>
                                            @foreach($districts as $district)
                                            <option value="{{ $district->id }}" {{ $district->id==$states->district_id?'selected':''}}  >{{$district->district_name}}</option>
                                            @endforeach
                                        </select>
                                        @error('district_id')
                                                <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <h5>State Name<span class="text-danger">*</span>
                                    </h5>
                                    <div class="controls">
                                        <input type="text" name="state_name" value="{{ $states->state_name }}" class="form-control">
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
