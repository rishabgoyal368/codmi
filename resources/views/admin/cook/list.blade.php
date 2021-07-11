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
                                <td><label class="{{$user->getStatus()[0]}}">{{$user->getStatus()[1]}}</label></td>
                                <td>{{date('d-M-y H:i:s',strtotime($user->created_at))}}</td>
                                <td>
                                    <a href="{{url('/admin/edit-user')}}/{{$user->id}}" title="Edit"><i class="mdi mdi-grease-pencil custom_icon"></i></a>
                                    <a class="changeStatus" data-id="{{$user->id}}" data-url="{{url('/admin/change-request')}}" data-status="{{$user->status}}"><i class="mdi mdi mdi-delete custom_icon icon_red" title="Delete"></i></a>
                                    @if($user->type == \App\Models\User::COOKTYPE)
                                    <a href="{{url('/admin/on-board-result')}}/{{$user->id}}" target="_blank"><i class="mdi mdi mdi-database custom_icon" title="On board Result"></i></a>
                                    @endif

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