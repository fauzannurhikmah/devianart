@extends('layouts.app',['title'=>'Create Art'])

@section('style')
  <link rel="stylesheet" href="{{asset('vendor/iziToast/dist/css/iziToast.min.css')}}">
@endsection

@section('content')
<!-- Toastification -->
@if (session()->has('errors')||session()->has('success'))
    <span id="toast" data-status=true data-type="{{session()->has('errors') ? 'error' :'success'}}" data-message="{{session('success')}}"></span>
@endif
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1><i class="fab fa-artstation"></i> Art</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Art</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>
  
      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                          <h2 class="card-title align-self-center">Create Art</h2>
                          <a class="ml-auto btn btn-sm btn-info" href="{{route('art')}}"><i class="fas fa-backward"></i> Back</a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form action="{{route('create-art')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label class="col-label-form col-md-3" for="title">Title</label>
                                <div class="col-md-9">
                                    <input type="text" name="title" id="title" class="form-control">
                                    @error('title')
                                        <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-label-form col-md-3" for="category">Category</label>
                                <div class="col-md-9">
                                    <select name="category" id="category" class="custom-select">
                                        <option selected disabled>Select Category</option>
                                        @foreach ($category as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
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
                                    <textarea name="description" id="description" cols="30" rows="10" class="form-control"></textarea>
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
                                </div>
                            </div>

                            <div class="form-group text-right">
                                <button type="submit" class="btn btn-primary btn-lg">Save</button>
                            </div>
                            </form>
                        </div>
                        <!-- /.card-body -->
                      </div>
                      <!-- /.card -->
                </div>
            </div>
        </div>
  
      </section>
      <!-- /.content -->
@endsection

@push('script')
    <script src="{{asset('vendor/iziToast/dist/js/iziToast.min.js')}}"></script>
    <script src="{{asset('js/script.js')}}"></script>
@endpush