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
                                <th>Email</th>
                                <th>Roll</th>
                                <th>Created</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $user)
                            <tr>
                                <td>{{$user->email}}</td>
                                <td>{{$user->getRole()}}</td>
                                <td>{{date('d-M-y H:i:s',strtotime($user->created_at))}}</td>
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