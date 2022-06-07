@extends('frontend.main_master')
@section('content')


<div class="body-content">
    <div class="container">
        <div class="row">
            <div class="col-md-2"><br>
                <img class="card-img-top" style="border-radius:50%" src="{{ (!empty($user->profile_photo_path))? url('upload/user_images/'.$user->profile_photo_path): url('upload/no_image.jpg')}}" height="100%" width="100%" alt=""><br><br>

                <ul class="list-group list-group-flush" >
                    <a class="btn btn-primary btn-sm btn-block" href="{{ route('dashboard')}}">Home</a>
                    <a class="btn btn-primary btn-sm btn-block" href="{{ route('user.profile') }}">Profile Update</a>
                    <a class="btn btn-primary btn-sm btn-block" href="{{ route('user.change.password') }}">Change Password</a>
                    <a class="btn btn-danger btn-sm btn-block" href="{{ route('user.logout') }}">Logout</a>
                </ul>
            </div>
            <div class="col-md-2">
                
            </div>
            <div class="col-md-6">
                <div class="card">
                    <h3 class="text-center"><span>Hi... <strong>{{Auth::user()->name}}</strong> Update Your Profile</span></h3><br>

                    <form action="{{ route('user.password.update')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <h5>Current Password <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="password" id="current_password"  name="oldpassword" class="form-control" > 
                            </div>
                        </div>
                        <div class="form-group">
                            <h5>New Password <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="password" id="password"  name="password" class="form-control" > 
                                </div>
                        </div>
                            <div class="form-group">
                                <h5>Confirm Password<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" > 
                                    </div>
                            </div>
                            
                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">Change Password</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>




@endsection