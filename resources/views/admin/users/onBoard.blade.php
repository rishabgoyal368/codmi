@extends('admin.layout.app')
@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title"> On Board Results </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/admin')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{url('/admin/manage-users')}}">Manage Users</a></li>
                <li class="breadcrumb-item active" aria-current="page">On Board Results</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="user_name">
                        @forelse ($results as $key => $result)
                        <div>

                            <p class="font-weight-bold"><span>{{$key+1}}. </span>{{$result->question_id}}</p>
                            <p><span class="font-weight-bold">Answer:  </span>{{$result->answer}}</p>
                        </div>

                        @empty
                        <p>No data found!</p>
                        @endforelse
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>
@endsection