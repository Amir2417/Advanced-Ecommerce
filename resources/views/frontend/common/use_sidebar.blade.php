<div class="col-md-2"><br>
    <img class="card-img-top" style="border-radius:50%" src="{{ (!empty(Auth::user()->profile_photo_path))? url('upload/user_images/'.Auth::user()->profile_photo_path): url('upload/no_image.jpg')}}" height="100%" width="100%" alt=""><br><br>

    <ul class="list-group list-group-flush" >
        <a class="btn btn-primary btn-sm btn-block" href="{{ route('dashboard')}}">Home</a>
        <a class="btn btn-primary btn-sm btn-block" href="{{ route('user.profile') }}">Profile Update</a>
        <a class="btn btn-primary btn-sm btn-block" href="{{ route('my.orders') }}">Orders</a>
        <a class="btn btn-primary btn-sm btn-block" href="{{ route('user.change.password') }}">Change Password</a>
        <a class="btn btn-danger btn-sm btn-block" href="{{ route('user.logout') }}">Logout</a>
    </ul>
</div>
