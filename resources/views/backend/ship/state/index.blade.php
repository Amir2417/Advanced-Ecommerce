@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<div class="container-full">
    <div class="content">
        <div class="row">
            <div class="col-8">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">State List</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Division Name</th>
                                        <th>District Name</th>
                                        <th>State Name</th>
                                        <th>Status</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($states as $item)
                                    <tr>
                                        <td>{{$item->division->division_name}}</td>
                                        <td>{{$item->district->district_name}}</td>
                                        <td>{{$item->state_name}}</td>
                                        <td>
                                            @if($item->status == 1)
                                            <span class="badge badge-pill badge-success">Active</span>
                                            @else
                                            <span class="badge badge-pill badge-danger">Inactive</span>
                                            @endif
                                         </td>
                                        <td width="30%">
                                            <a class="btn btn-primary" href="{{ route('state.edit',$item->id) }}" title="Edit Data"><i class="fa fa-pencil"></i></a>
                                            <a class="btn btn-danger" id="delete" href="{{ route('state.delete',$item->id) }}" title="Delete Data"><i class="fa fa-trash"></i></a>

                                            @if($item->status == 1)
                                            <a class="btn btn-danger" href="{{ route('state.inactive',$item->id) }}" title="Inactive Now"><i class="fa fa-arrow-down"></i></a>
                                            @else
                                            <a class="btn btn-success" href="{{ route('state.active',$item->id) }}" title="Active Now"><i class="fa fa-arrow-up"></i></a>
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
                            <h3 class="box-title">Add State</h3>
                    </div>
                        <div class="card-body">
                            <form action="{{ route('state.store')}}" method="post">
                                @csrf
                                <div class="form-group">
								    <h5>Division Select <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select name="division_id" class="form-control">
                                            <option value="" selected="" disabled="">Select Division</option>
                                            @foreach($divisions as $division)
                                            <option value="{{ $division->id }}">{{$division->division_name}}</option>
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
                                        <input type="text" name="state_name" class="form-control">
                                        @error('state_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="text-xs-right">
                                    <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Add State">
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $('select[name ="division_id"]').on('change',function(){
            var division_id = $(this).val();
            if(division_id) {
                $.ajax({
                    url: "{{ url('/shipping/division/district/ajax') }}/"+division_id,
                    type:"GET",
                    dataType:"json",
                    success:function(data) {
                        var d = $('select[name="district_id"]').empty();
                        $.each(data,function(key,value){
                            $('select[name ="district_id"]').append('<option value="'+ value.id +'">' + value.   district_name + '</option>');
                        });
                    },
                });
            }
            else{
                alert('danger');
            }
        });
    });
</script>

@endsection
