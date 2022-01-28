@extends('layouts.front',['title'=>"$art->title - Edit Artwork"])

@section('style')
  <link rel="stylesheet" href="{{asset('vendor/iziToast/dist/css/iziToast.min.css')}}">
@endsection

@section('content')
<!-- Toastification -->
@if (session()->has('errors')||session()->has('success'))
    <span id="toast" data-status=true data-type="{{session()->has('errors') ? 'error' :'success'}}" data-message="{{session('success')}}"></span>
@endif
    <div class="row justify-content-center mt-4">
        <div class="col-md-8">
            <div class="card border-0 shadow" style="background: #333333;padding:40px!important;">
                <h3 class="text-white"><span class="text-warning">#</span> Artwork ID {{$art->id}}</h3>
                <form action="{{route('edit-art',$art->id)}}" method="POST" enctype="multipart/form-data">
                    @method('put')
                    @csrf
                    <div class="form-group row">
                        <label class="col-label-form col-md-3" for="title">Title</label>
                        <div class="col-md-9">
                            <input type="text" name="title" id="title" class="form-control" value="{{old('title')??$art->title}}">
                            @error('title')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-label-form col-md-3" for="category">Category</label>
                        <div class="col-md-9">
                            <select name="category" id="category" class="form-control">
                                <option selected disabled>Select Category</option>
                                @foreach ($category as $item)
                                <option value="{{$item->id}}" {{$art->category_id==$item->id ?'selected':''}}>{{$item->name}}</option>
                                @endforeach
                            </select>
                            @error('category')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-label-form col-md-3" for="description">Description</label>
                        <div class="col-md-9">
                            <textarea name="description" id="description" cols="30" rows="10" class="form-control">{{old('description')??$art->description}}</textarea>
                            @error('description')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="image" class="col-label-form col-md-3">Image</label>
                        <div class="col-md-9">
                            <input type="file" name="image" id="image" class="form-control">
                            @error('image')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                            <div class="text-center mt-2">
                                <img src="{{asset("storage/$art->image")}}" class="shadow rounded mx-auto" width="200">
                                <p class="font-weight-bold">Current Image</p>
                            </div>
                        </div>
                    </div>
    
                    <div class="form-group text-right">
                        <button type="submit" class="btn btn-primary btn-lg">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="{{asset('vendor/iziToast/dist/js/iziToast.min.js')}}"></script>
    <script src="{{asset('js/script.js')}}"></script>
@endpush