<!DOCTYPE html>
<html lang="en">
<head>
<!-- Meta -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
<meta name="description" content="">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="author" content="">
<meta name="keywords" content="MediaCenter, Template, eCommerce">
<meta name="robots" content="all">
<title>@yield('title')</title>

<!-- Bootstrap Core CSS -->
<link rel="stylesheet" href="{{ asset('frontend/assets/css/bootstrap.min.css') }}">

<!-- Customizable CSS -->
<link rel="stylesheet" href="{{ asset('frontend/assets/css/main.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/assets/css/blue.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/assets/css/owl.carousel.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/assets/css/owl.transitions.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/assets/css/animate.min.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/assets/css/rateit.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/assets/css/bootstrap-select.min.css') }}">

<!-- Icons/Glyphs -->
<link rel="stylesheet" href="{{ asset('frontend/assets/css/font-awesome.css') }}">

<!-- alert css cdn  -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" type="text/css">

<!-- Fonts -->
<link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,600,600italic,700,700italic,800' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
</head>
<body class="cnt-home">
<!-- ============================================== HEADER ============================================== -->
@include('frontend.body.header')

<!-- ============================================== HEADER : END ============================================== -->
@yield('content')
<!-- /#top-banner-and-menu --> 

<!-- ============================================================= FOOTER ============================================================= -->
@include('frontend.body.footer')
<!-- ============================================================= FOOTER : END============================================================= --> 

<!-- For demo purposes ??? can be removed on production --> 

<!-- For demo purposes ??? can be removed on production : End --> 

<!-- JavaScripts placed at the end of the document so the pages load faster --> 
<script src="{{ asset('frontend/assets/js/jquery-1.11.1.min.js')}}"></script> 
<script src="{{ asset('frontend/assets/js/bootstrap.min.js')}}"></script> 
<script src="{{ asset('frontend/assets/js/bootstrap-hover-dropdown.min.js')}}"></script> 
<script src="{{ asset('frontend/assets/js/owl.carousel.min.js')}}"></script> 
<script src="{{ asset('frontend/assets/js/echo.min.js')}}"></script> 
<script src="{{ asset('frontend/assets/js/jquery.easing-1.3.min.js')}}"></script> 
<script src="{{ asset('frontend/assets/js/bootstrap-slider.min.js')}}"></script> 
<script src="{{ asset('frontend/assets/js/jquery.rateit.min.js')}}"></script> 
<script type="text/javascript" src="{{ asset('frontend/assets/js/lightbox.min.js')}}"></script> 
<script src="{{ asset('frontend/assets/js/bootstrap-select.min.js')}}"></script> 
<script src="{{ asset('frontend/assets/js/wow.min.js')}}"></script> 
<script src="{{ asset('frontend/assets/js/scripts.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" type="text/javascript"></script>

  <script>
    @if(Session::has('message'))
      var type = "{{ Session::get('alert-type','info') }}"
      switch(type){
        case 'info':
          toastr.info("{{Session::get('message')}}");
          break;
        case 'success':
          toastr.success("{{ Session::get('message')}}");
          break;
        case 'warning':
          toastr.warning("{{Session::get('message')}}");
          break;
        case 'error':
          toastr.error("{{Session::get('message')}}");
          break;
      }
    @endif

    
  </script>
 
   <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><strong><span id="pname"></span></strong> </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">{{-- start row  --}}
          <div class="col-md-4">{{-- start col-md-4  --}}
            <div class="card" style="width: 18rem;">{{-- start card  --}}
              <img src="" class="card-img-top" id="pimage" style="height: 200px; width:200px;"  alt="">
              
             </div>{{-- end card  --}}
          </div>{{-- end col-md-4  --}}

          <div class="col-md-4">{{-- start col-md-4  --}}
            <ul class="list-group">
              <li class="list-group-item">Product Price: <strong class="text-danger">$<span id="pprice"></span></strong> <del id="oldprice"></del>$ </li>
              <li class="list-group-item">Product Code: <span id="pcode"></span></li>
              <li class="list-group-item">Category: <span id="pcategory"></span></li>
              <li class="list-group-item">Brand: <span id="pbrand"></span></li>
              <li class="list-group-item">Stock: <span id="available" class="badge badge-pill badge-success" style="background-color: green; color:white;"></span>
              <span id="stockout" class="badge badge-pill badge-danger" style="background-color: red; color:white;"></span></li>
            </ul>
          </div>{{-- end col-md-4  --}}

          <div class="col-md-4">{{-- start col-md-4  --}}
            <div class="form-group " id="colorArea">
              <label for="exampleFormControlSelect1">Choose Color</label>
              <select class="form-control" id="exampleFormControlSelect1" name="color">
                <option></option>
                
              </select>
            </div>
            <div class="form-group" id="sizeArea">
              <label for="exampleFormControlSelect1">Choose Size</label>
              <select class="form-control" id="exampleFormControlSelect1" name="size">
                <option></option>
                
              </select>
            </div>
            <div class="form-group">
              <label for="exampleFormControlSelect1">Quantity</label>
              <input type="number" min="1" class="form-control" value="1">
            </div>
            <button type="submit" class="btn btn-primary mb-2">Submit</button>
          </div>{{-- end col-md-4  --}}
        </div>{{-- end row  --}}
      </div>{{-- end modal body --}}
      
    </div>
  </div>
</div>

<script >

    $.ajaxSetup({
      headers:{
        'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
      }
    })  


// start product view with modal 

function productView(id){

// alert(id)
    $.ajax({
      type: 'GET',
      url: '/product/view/modal/'+id,
      dataType:'json',
      success:function(data){
        $('#pname').text(data.product.product_name_en);
        $('#price').text(data.product.selling_price);
        $('#pcode').text(data.product.product_code);
        $('#pcategory').text(data.product.category.category_name_en);
        $('#pbrand').text(data.product.brand.brand_name_en);
        $('#pimage').attr('src','/'+data.product.product_thambnail);

        //Product Price

        if (data.product.discount_price == null) {
          $('#pprice').text('');
          $('#oldprice').text('');
          $('#pprice').text(data.product.selling_price);
        } else {
          $('#pprice').text(data.product.discount_price);
          $('#oldprice').text(data.product.selling_price);
        }
        //End Product Price

        //Start Stock Option

        if (data.product.product_qty > 0) {
          $('#available').text('')
          $('#stockout').text('')
          $('#available').text('Available')
        } else {
          $('#available').text('')
          $('#stockout').text('')
          $('#stockout').text('Stockout')
        }

        //End Stock Product
       
        //color
        $('select[name="color"]').empty();
        $.each(data.color,function(key,value){
          $('select[name="color"]').append('<option value=" '+value+' ">'+value+'</option>')
          if (data.color=="") {
            $('#colorArea').hide();
          } else {
            $('#colorArea').show();
          }
        })


        //size
        $('select[name="size"]').empty();
        $.each(data.size,function(key,value){
          $('select[name="size"]').append('<option value=" '+value+' ">'+value+'</option>')
          if(data.size=="") {
            $('#sizeArea').hide();
          } else{
            $('#sizeArea').show();
          }
        })

      }

    })

}


</script>
 
</body>
</html>