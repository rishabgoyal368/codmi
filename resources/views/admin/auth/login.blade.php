@extends('admin.auth.layout.app')
@section('content')
<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth">
            <div class="row flex-grow">
                <div class="col-lg-4 mx-auto">
                    @include('admin.layout.flash-message')
                    <div class="auth-form-light text-left p-5">
                        <div class="brand-logo" style="color: #da8cff;font-size: 23px;">
                            {{env('APP_NAME')}}
                        </div>
                        <h4>Sign in to continue.</h4>
                        <form class="pt-3" method="POST" action="{{route('admin_login')}}" id="login">
                            @csrf
                            <div class="form-group">
                                <input type="email" name="email" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Your email address">
                                @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <input type="password" name="password" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Your Password">
                                @if ($errors->has('password'))
                                <span class="text-danger">{{ $errors->first('password') }}</span>
                                @endif
                            </div>
                            <div class="mt-3">
                                <input type="submit" value="SIGN IN" class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection