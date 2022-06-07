@extends('frontend.main_master')
@section('content')

<div class="body-content">
    <div class="container">
        <div class="row">
            <div class="col-md-2"><br>
                <img class="card-img-top" style="border-radius:50%" src="{{ (!empty($editData->photo_profile_path))? url('upload/admin_images/'.$editData->photo_profile_path): url('upload/no_image.jpg')}}" height="100%" width="100%" alt=""><br><br>

                <ul class="list-group list-group-flush" >
                    <a class="btn btn-primary btn-sm btn-block" href="">Home</a>
                    <a class="btn btn-primary btn-sm btn-block" href="">Profile Update</a>
                    <a class="btn btn-primary btn-sm btn-block" href="">Change Password</a>
                    <a class="btn btn-danger btn-sm btn-block" href="">Logout</a>
                </ul>
            </div>
            <div class="col-md-2">
                
            </div>
            <div class="col-md-6">
                <div class="card">
                    <h3 class="text-center"><span>Hi... <strong>{{Auth::user()->name}}</strong> Welcome to SoftLight Shoop</span></h3>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection