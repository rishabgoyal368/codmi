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
                                <th>Parent</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                  
                        @forelse ($categories as $category)
                            <tr>
                                <td>{{$category->name}}</td>
                                <td>
                                    

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