@extends('frontend.main_master')
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<div class="body-content">
    <div class="container">
        <div class="row">
            @include('frontend.common.use_sidebar')
            <div class="col-md-2">

            </div>
            <div class="col-md-6">
                <div class="card">
                    <h3 class="text-center"><span>Hi... <strong>{{Auth::user()->name}}</strong> Update Your Profile</span></h3>

                    <form action="{{ route('user.profile.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <h5>User Name <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="text" name="name" value="{{ $user->name}}" class="form-control" >
                            </div>
                        </div>
                        <div class="form-group">
                            <h5>User Email <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="email" name="email" value="{{ $user->email}}" class="form-control" >
                                </div>
                        </div>
                            <div class="form-group">
                                <h5>User Phone <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="phone" value="{{ $user->phone}}" class="form-control" >
                                    </div>
                            </div>
                            <div class="form-group">
                                <h5>User File <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input id="image" type="file" name="profile_photo_path" class="form-control" >
                                    </div>
                            </div>
                            <div class="form-group">
                                <img id="showImage" src="{{(!empty($user->profile_photo_path))? url('upload/user_images/'.$user->profile_photo_path): url('upload/no_image.jpg')}}" style="width:100px;height:100px;">
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">Update Profile</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $('#image').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#showImage').attr('src',e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });

</script>



@endsection
