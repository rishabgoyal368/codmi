@extends('admin.layout.app')
@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title"> Edit User </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/admin/dashboard')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{url('/admin/manage-users')}}">Manage User</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit User</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <form class="forms-sample" method="POST" action="{{route('edit-user')}}" id="edit-user" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{$user->id}}">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Name" value="{{old('name') ?? $user->name}}">
                            @if($errors->has('name'))
                            <label class="error">{{ $errors->first('name') }}</label>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Email address</label>
                            <input type="email" name="email" class="form-control" placeholder="Email" value="{{old('email') ?? $user->email}}">
                            @if($errors->has('email'))
                            <label class="error">{{ $errors->first('email') }}</label>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Mobile number</label>
                            <input type="text" name="mobile_number" class="form-control" placeholder="Email" value="{{old('mobile_number') ?? $user->mobile_number}}">
                            @if($errors->has('mobile_number'))
                            <label class="error">{{ $errors->first('mobile_number') }}</label>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <select class="form-control" name="status">
                                <option value="{{\App\Models\User::ACTIVESTATUS}}" @if($user->status == \App\Models\User::ACTIVESTATUS) selected @endif>Active</option>
                                <option value="{{\App\Models\User::PENDINGSTATUS}}" @if($user->status == \App\Models\User::PENDINGSTATUS) selected @endif>Pending</option>
                            </select>
                            @if($errors->has('status'))
                            <label class="error">{{ $errors->first('status') }}</label>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Profile Pic</label>
                            <input type="file" name="profile_pic" accept="image/png, image/jpg, image/jpeg" class="file-upload-default">
                            <div class="input-group col-xs-12">
                                <input type="text" value="{{$user->profile_pic}}" class="form-control file-upload-info" disabled placeholder="Upload Image">
                                <span class="input-group-append">
                                    <button class="file-upload-browse btn btn-gradient-primary" type="button">Upload</button>
                                </span>
                            </div>
                            @if($errors->has('profile_pic'))
                            <label class="error">{{ $errors->first('profile_pic') }}</label>
                            @endif
                            <img src="{{$user->getProfileImage()}}" style="width:200px;height:200px">
                        </div>
                        <button type="submit" class="btn btn-gradient-primary mr-2">Submit</button>
                        <button class="btn btn-light">Cancel</button>
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