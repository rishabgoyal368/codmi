@extends('admin.layout.app')
@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title"> Add Category </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/admin/dashboard')}}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Add Category</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <form class="forms-sample" method="POST" action="{{url('admin/add-category')}}" id="edit-user" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Name" value="{{old('name') ?? @$user->name}}" autocomplete="off">
                            @if($errors->has('name'))
                            <label class="error">{{ $errors->first('name') }}</label>
                            @endif
                        </div>

                        <div class="form-group">
                            <label>Parent</label>

                            <select>
                                
                                @foreach($parentCategories as $category)
                                <optgroup label="{{$category->name}}">
                                @if(count($category->subcategory))
                                @include('admin.category.subCategoryView',['subcategories' => $category->subcategory, 'dataParent' => $category->id , 'dataLevel' => 1])
                                @endif
                                </optgroup>
                                @endforeach
                            </select>
                            @if($errors->has('name'))
                            <label class="error">{{ $errors->first('name') }}</label>
                            @endif
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