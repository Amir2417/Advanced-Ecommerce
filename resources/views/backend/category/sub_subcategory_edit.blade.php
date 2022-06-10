@extends('admin.admin_master')
@section('admin')

<div class="container-full">
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                            <h3 class="box-title">Edit SubSubCategory</h3>
                    </div>
                        <div class="card-body">
                            <form action="{{ route('subsubcategory.update')}}" method="post">
                                @csrf
                                <input type="hidden" name="id" value="{{ $subsubcategories->id}}">
                                <div class="form-group">
								    <h5>Category Select <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select name="category_id" class="form-control">
                                            <option value="" selected="" disabled="">Select Category</option>
                                            @foreach($categories as $category)
                                            <option value="{{ $category->id }} "{{ $category->id==$subsubcategories->category_id?'selected':''}} >{{$category->category_name_en}}</option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                                <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
							    </div>
                                <div class="form-group">
								    <h5>Sub Category Select <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select name="subcategory_id" class="form-control">
                                            <option value="" selected="" disabled="">Select Category</option>
                                            @foreach($subcategories as $subcategory)
                                            <option value="{{ $subcategory->id }} "{{ $subcategory->id==$subsubcategories->subcategory_id?'selected':''}} >{{$subcategory->subcategory_name_en}}</option>
                                            @endforeach
                                        </select>
                                        @error('subcategory_id')
                                                <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
							    </div>
                                <div class="form-group">
                                        <h5>SubSubCategory English<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="subsubcategory_name_en" class="form-control" value="{{ $subsubcategories->subsubcategory_name_en}}" > 
                                        @error('subcategory_name_en')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                        <h5>SubSubCategory Bangla <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="subsubcategory_name_ban" class="form-control" value="{{ $subsubcategories->subsubcategory_name_ban}}"> 
                                        @error('subcategory_name_ban')
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