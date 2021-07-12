@extends('admin.layout.app')
@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title"> Manage Proof </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/admin')}}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Manage Proof</li>
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
                                <th>Proof</th>
                                <th>Status</th>
                                <th>Requested at</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $user)
                            <tr>
                                <td>{{$user->user->name}}</td>
                                <td> <img src="{{$user->user->getProfileImage()}}" alt=""></td>
                                <td><a href="{{$user->proof}}" target="_blank">click here..</a></td>
                                <td>{!! $user->getCookStatus() !!}</td>
                                <td>{{date('d-M-y H:i:s',strtotime($user->created_at))}}</td>
                                <td>
                                    @if ($user->proof_status == \App\Models\CookProfile::PROOFDEACTIVATE)
                                    <a class="changeStatus" data-id="{{$user->id}}" data-page="Proof" data-url="{{route('changeProofRequest')}}" data-status="{{$user->proof_status}}"><i class="mdi mdi-account-convert custom_icon icon_red" title="Delete"></i></a>
                                    @else
                                    <a class="changeStatus" data-id="{{$user->id}}" data-page="Proof" data-url="{{route('changeProofRequest')}}" data-status="{{$user->proof_status}}"><i class="mdi mdi-account-check custom_icon icon_green" title="Delete"></i></a>
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