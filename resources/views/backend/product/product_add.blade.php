@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>



<div class="container-full">
		<!-- Content Header (Page header) -->
			  

		<!-- Main content -->
		<section class="content">

		 <!-- Basic Forms -->
		  <div class="box">
			<div class="box-header with-border">
			  <h4 class="box-title">Add Products</h4>
			  
			</div>
			<!-- /.box-header -->
			<div class="box-body">
			  <div class="row">
				<div class="col">
					<form action="{{ route('product-store') }}" method="post" enctype="multipart/form-data" >
                        @csrf
					    <div class="row">
                            <div class="col-12">
                                <div class="row"> <!--   start 1st row -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Brand Select <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <select name="brand_id" class="form-control" required>
                                                    <option value="" selected="" disabled="">Select Category</option>
                                                    @foreach($brands as $brand)
                                                    <option value="{{ $brand->id }}">{{$brand->brand_name_en}}</option>
                                                    @endforeach
                                                </select>
                                                @error('brand_id')
                                                        <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Category Select <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <select name="category_id" class="form-control" required>
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
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>SubCategory Select <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <select name="subcategory_id" class="form-control" required>
                                                    <option value="" selected="" disabled="">Select Category</option>
                                                    
                                                </select>
                                                @error('subcategory_id')
                                                        <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>	 <!--   end 1st row -->					
                                <div class="row"> <!--   start 2nd row -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>SubSub Category Select <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <select name="subsubcategory_id" class="form-control" required>
                                                    <option value="" selected="" disabled="">Select Category</option>
                                                    
                                                </select>
                                                @error('subsubcategory_id')
                                                        <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Product Name English <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                            <input type="text" name="product_name_en" class="form-control" required>
                                                @error('product_name_en')
                                                        <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Product Name Bangla <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="text" name="product_name_ban" class="form-control" required>
                                                @error('product_name_ban')
                                                        <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>	 <!--   end 2nd row -->					
                                <div class="row"> <!--   start 3nd row -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Product Code <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="text" name="product_code" class="form-control" required>
                                            
                                                @error('product_code')
                                                        <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Product Quantity <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                            <input type="text" name="product_qty" class="form-control" required>
                                                @error('product_qty')
                                                        <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Product Tags English <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                            <input type="text" name="product_tags_en" value="Lorem,Ipsum,Amet" required data-role="tagsinput" placeholder="add tags" />
                                                @error('product_tags_en')
                                                        <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>	 <!--   end 3rd row -->					
                                <div class="row"> <!--   start 4th row -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Product Tags Bangla <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                            <input type="text" name="product_tags_ban" required value="Lorem,Ipsum,Amet" data-role="tagsinput" placeholder="add tags" />
                                                @error('product_tags_ban')
                                                        <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Product Size English <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                            <input type="text" name="product_size_en" required value="Large,Medium,Small" data-role="tagsinput" placeholder="add tags" />
                                                @error('product_size_en')
                                                        <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Product Size Bangla <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                            <input type="text" name="product_size_ban" required value="বড়,মাঝারি,ছোট" data-role="tagsinput" placeholder="add tags" />
                                                @error('product_size_ban')
                                                        <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>	 <!--   end 4th row -->					
                                <div class="row"> <!--   start 5th row -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Product Color English <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                            <input type="text" name="product_color_en" required value="Red,Black,Blue" data-role="tagsinput" placeholder="add tags" />
                                                @error('product_color_en')
                                                        <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Product Color Bangla <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                            <input type="text" name="product_color_ban" required value="লাল,কালো,নীল" data-role="tagsinput" placeholder="add tags" />
                                                @error('product_color_ban')
                                                        <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Product Selling Price <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                            <input type="text" name="selling_price" required class="form-control"/>
                                                @error('selling_price')
                                                        <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>	 <!--   end 5th row -->					
                                <div class="row"> <!--   start 6th row -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Product Discount Price <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                            <input type="text" name="discount_price" required class="form-control"/>
                                                @error('discount_price')
                                                        <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Main Thambnail <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                            <input type="file" name="product_thambnail" required class="form-control" onChange="mainThamUrl(this)" />
                                                @error('product_thambnail')
                                                        <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                                <img src="" alt="" id="mainThmb">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Multiple Image <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="file" name="multi_img[]" class="form-control" multiple="" id="multiImg" required="" >
                                                @error('multi_img') 
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                                <div class="row" id="preview_img"></div>

                                            </div>
                                        </div>
                                    </div>	 <!--   end 6th row -->	
                                </div>
                                <div class="row"> <!--   start 7th row -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <h5>Short Description English <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <textarea  name="short_descp_en" id="textarea" class="form-control" required ></textarea>
                                                @error('discount_price')
                                                        <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <h5>Short Description Bangla <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <textarea  name="short_descp_ban" id="textarea" class="form-control" required ></textarea>
                                                @error('product_thambnail')
                                                        <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>	 <!--   end 7th row -->					
                                <div class="row"> <!--   start 8th row -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <h5>Long Description English <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <textarea id="editor1" required name="long_descp_en" rows="10" cols="80">
                                                    
                                                </textarea>
                                                @error('discount_price')
                                                        <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <h5>Long Description Bangla <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <textarea id="editor2" required name="long_descp_ban" rows="10" cols="80">
                                                
                                                </textarea>
                                                @error('product_thambnail')
                                                        <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>	 <!--   end 8th row -->					
                                    <!--   end 8th row -->					
                                <hr>
                                <div class="row"> <!--   start 8th row -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="controls">
                                                <fieldset>
                                                    <input type="checkbox" name="hot_deals" id="checkbox_2"  value="1">
                                                    <label for="checkbox_2">Hot Deals</label>
                                                </fieldset>
                                                <fieldset>
                                                    <input type="checkbox"  name="featured" id="checkbox_3" value="1">
                                                    <label for="checkbox_3">Featured</label>
                                                </fieldset>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="controls">
                                                <fieldset>
                                                    <input type="checkbox"  name="special_offer"  id="checkbox_5" value="1">
                                                    <label for="checkbox_5">Special Offer</label>
                                                </fieldset>
                                                <fieldset>
                                                    <input type="checkbox" name="special_deals" id="checkbox_4" value="1">
                                                    <label for="checkbox_4">Special Deals</label>
                                                </fieldset>
                                                
                                        
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
					    </div>
						
						
						
						<div class="text-xs-right">
                        <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Add Product">
						</div>
					</form>

				</div>
				<!-- /.col -->
			  </div>
			  <!-- /.row -->
			</div>
			<!-- /.box-body -->
		  </div>
		  <!-- /.box -->

		</section>
		<!-- /.content -->
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
                            $('select[name="subsubcategory_id"]').html('');
                        var d = $('select[name="subcategory_id"]').empty();
                        $.each(data,function(key,value){
                            $('select[name ="subcategory_id"]').append('<option value="'+ value.id +'">' + value.subcategory_name_en + '</option>');
                        });
                    },
                });
            }
            else{
                alert('danger');
            }
        });

$('select[name ="subcategory_id"]').on('change',function(){
            var subcategory_id = $(this).val();
            if(subcategory_id) {
                $.ajax({
                    url: "{{ url('/category/subsubcategory/ajax') }}/"+subcategory_id,
                    type:"GET",
                    dataType:"json",
                    success:function(data) {
                        var d = $('select[name="subsubcategory_id"]').empty();
                        $.each(data,function(key,value){
                            $('select[name ="subsubcategory_id"]').append('<option value="'+ value.id +'">' + value.subsubcategory_name_en + '</option>');
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
<script type="text/javascript">
    function mainThamUrl(input){
        if(input.files && input.files[0]){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#mainThmb').attr('src',e.target.result).width(80).height(80);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }


</script>
<script>
 
  $(document).ready(function(){
   $('#multiImg').on('change', function(){ //on file input change
      if (window.File && window.FileReader && window.FileList && window.Blob) //check File API supported browser
      {
          var data = $(this)[0].files; //this file data
           
          $.each(data, function(index, file){ //loop though each file
              if(/(\.|\/)(gif|jpe?g|png|webp)$/i.test(file.type)){ //check supported file type
                  var fRead = new FileReader(); //new filereader
                  fRead.onload = (function(file){ //trigger function on successful read
                  return function(e) {
                      var img = $('<img/>').addClass('thumb').attr('src', e.target.result) .width(80)
                  .height(80); //create image element 
                      $('#preview_img').append(img); //append image to output element
                  };
                  })(file);
                  fRead.readAsDataURL(file); //URL representing the file's data.
              }
          });
           
      }else{
          alert("Your browser doesn't support File API!"); //if File API is absent
      }
   });
  });
   
  </script>

@endsection 