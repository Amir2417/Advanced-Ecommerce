@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<div class="container-full">
    <div class="content">
        <div class="row">

        
            <div class="col-md-8">

                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">SubSubCategory List</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Category</th>
                                        <th>Sub Category Name</th>
                                        <th>Sub SubCategory En</th>
                                        <th>Sub SubCategory Ban</th>
                                        <th>Action</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($subsubcategory as $item)
                                    <tr>
                                        <td>{{$item['category']['category_name_en']}}</td>
                                        <td>{{$item['subcategory']['subcategory_name_en']}}</td>
                                        <td>{{$item->subsubcategory_name_en}}</td>
                                        <td>{{$item->subsubcategory_name_ban}}</td>
                                        <td>
                                            <a class="btn btn-primary" href="{{ route('subsubcategory.edit',$item->id) }}" title="Edit Data"><i class="fa fa-pencil"></i></a>
                                            <a class="btn btn-danger" id="delete" href="{{ route('subcategory.delete',$item->id) }}" title="Delete Data"><i class="fa fa-trash"></i></a>
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
                            <h3 class="box-title">Add SubSubCategory</h3>
                    </div>
                        <div class="card-body">
                            <form action="{{ route('subsubcategory.store')}}" method="post">
                                @csrf
                                <div class="form-group">
                                    <h5>Category Select <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select name="category_id" class="form-control">
                                            <option value="" selected="" disabled="">Select Category</option>
                                            @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{$category->category_name_en}}</option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                                <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
							    </div>
                                <div class="form-group">
                                    <h5>SubCategory Select <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select name="subcategory_id" class="form-control">
                                            <option value="" selected="" disabled="">Select SubCategory</option>
                                            
                                        </select>
                                        @error('subcategory_id')
                                                <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
							    </div>
                                <div class="form-group">
                                        <h5>SubSubCategory English<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="subsubcategory_name_en" class="form-control" > 
                                        @error('subsubcategory_name_en')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                        <h5>SubSubCategory Bangla <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="subsubcategory_name_ban" class="form-control" > 
                                        @error('subsubcategory_name_ban')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                    
                                    
                                <div class="text-xs-right">
                                    <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Add New">
                                    
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
        $('select[name ="category_id"]').on('change',function(){
            var category_id = $(this).val();
            if(category_id) {
                $.ajax({
                    url: "{{ url('/category/subcategory/ajax') }}/"+category_id,
                    type:"GET",
                    dataType:"json",
                    success:function(data) {
                        var d = $('select[name="subcategory_id"]').empty();
                        $.each(data,function(key,value){
                            $('select[name ="subcategory_id"]').append('<option value="'+ value.id +'">' + value.   subcategory_name_en + '</option>');
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