@extends('admin.layout.app')
@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title"> Manage Users </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/admin')}}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Manage Users</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    </p>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Profile Pic</th>
                                <th>Email</th>
                                <th>User Type</th>
                                <th>Login Type</th>
                                <th>Status</th>
                                <th>Created</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $user)
                            <tr>
                                <td>{{$user->name}}</td>
                                <td> <img src="{{$user->getProfileImage()}}" alt=""></td>
                                <td>{{$user->email}}</td>
                                <td><label class="{{$user->getUserType()[0]}}">{{$user->getUserType()[1 ]}}</label></td>
                                <td><label class="{{$user->getLoginType()[0]}}">{{$user->getLoginType()[1 ]}}</label></td>
                                <td><label class="{{$user->getStatus()[0]}}">{{$user->getStatus()[1 ]}}</label></td>
                                <td>{{date('d-M-y H:i:s',strtotime($user->created_at))}}</td>
                                <td>
                                    <a href="{{url('/admin/edit-user')}}/{{$user->id}}"><i class="mdi mdi-grease-pencil custom_icon"></i></a>
                                    <a class="changeStatus" data-id="{{$user->id}}" data-url="{{url('/admin/change-request')}}" data-status="{{$user->status}}"><i class="mdi mdi mdi-delete custom_icon icon_red"></i></a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td>NO data found!</td>
                            </tr>
                            @endforelse


                    </table>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection