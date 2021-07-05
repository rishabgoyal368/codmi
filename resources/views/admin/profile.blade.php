@extends('admin.layout.app')
@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title"> My Profile </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/admin/dashboard')}}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">My Profile</li>
            </ol>
        </nav>
    </div>
    <div class="row">

        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <form class="forms-sample" method="POST" action="{{url('/admin/my-profile')}}" enctype="multipart/form-data" id="admin-user">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputName1">Name</label>
                            <input type="text" class="form-control" id="exampleInputName1" name="name" autocomplete="off" placeholder="Name" value="{{Auth::guard('admin')->user()->name}}">
                            @if($errors->has('name'))
                            <label class="error">{{ $errors->first('name') }}</label>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail3">Email address</label>
                            <input type="email" class="form-control" id="exampleInputEmail3" name="email" autocomplete="off" placeholder="Email" value="{{Auth::guard('admin')->user()->email}}">
                            @if($errors->has('email'))
                            <label class="error">{{ $errors->first('email') }}</label>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>File upload</label>
                            <input type="file" name="profile_pic" class="file-upload-default" accept="image/png, image/jpg, image/jpeg">
                            <div class="input-group col-xs-12">
                                <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                                <span class="input-group-append">
                                    <button class="file-upload-browse btn btn-gradient-primary" type="button">Upload</button>
                                </span>
                            </div>
                            @if($errors->has('profile_pic'))
                            <label class="error">{{ $errors->first('profile_pic') }}</label>
                            @endif
                        </div>
                        <img src="{{Auth::guard('admin')->user()->getProfileImage()}}" style="width:200px;height:200px">
                        <div class="form-group">
                            <button type="submit" class="btn btn-gradient-primary mr-2">Submit</button>
                            <button class="btn btn-light">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

@section('external_script')
<script src="{{asset('assets/js/jquery.validate.min.js')}}"></script>
<script src="{{asset('assets/js/custom-validate.js')}}"></script>
<script src="{{asset('assets/js/file-upload.js')}}"></script>
@endsection