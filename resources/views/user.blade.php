@extends('layouts.front',['title'=>"$user->name - DevianArt"])

@section('style')
  <link rel="stylesheet" href="{{asset('vendor/iziToast/dist/css/iziToast.min.css')}}">
@endsection

@section('content')
<!-- Toastification -->
@if (session()->has('errors')||session()->has('success'))
    <span id="toast" data-status=true data-type="{{session()->has('errors') ? 'error' :'success'}}" data-message="{{session('success')}}"></span>
@endif

<div class="page-header text-center" @if ($arts->count()) style="background-image: url('{{"/storage/".$arts->first()->image}}');min-height:300px" @else style="background-image: url('/assets/images/page-header-bg.jpg');min-height:300px"  @endif>
</div><!-- End .page-header -->  

<div class="container my-4">
    <div class="row">
        <div class="col-md-2">
            @if ($user->photo=='/img/avatar-3.png')
                <img src="{{$user->photo}}" alt="juahah" class="rounded-pill shadow ml-auto" width="100">
            @else
                <img src="{{asset('storage/'.$user->photo)}}" alt="juahah" class="rounded-pill shadow ml-auto" style="width: 100px;height:100px;object-fit:cover">
            @endif
        </div>
        <div class="col-md-10 align-self-center">
            <div class="row">
                <div class="col">
                    <h5 class="text-white my-0">{{$user->name}} </h5>
                    <p class="text-warning">{{$user->email}}</p>
                    <p class="small">Joined : {{$user->created_at}}</p>
                </div>
                <div class="col text-right">
                    @auth
                    @can('update', $user)
                        <a href="#" data-toggle="modal" data-target="#editModal"><i class="icon-edit"></i> Edit</a>
                    @endcan
                    @endauth
                </div>
            </div>

        </div>   
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-md-9">
        <h5 class="text-white d-inline-block"><span class="text-warning">#</span> Artwork</h5>
        <span class="float-right badge badge-warning" style="font-size:12px">{{$arts->count()}}</span>
        <div class="row">
            @foreach ($arts as $item)
                <div class="col-md-3 mb-2"><a href="{{route('detail-art',$item->id)}}"><img src="{{asset("storage/$item->image")}}" class="rounded shadow w-100" loading="lazy" style="height:150px;object-fit:cover"></a></div>
            @endforeach
        </div>

        <div class="d-flex justify-content-center text-center mt-2">
            {!!$arts->links()!!}
        </div>
    </div>
</div>

@auth
@can('update', $user)
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header px-3">
                        <h5 class="modal-title font-weight-bold" id="exampleModalLabel">Edit Profile</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body text-left p-4">
                        <form action="{{route('edit-user', auth()->id())}}" method="post" enctype="multipart/form-data">
                            @method('put')
                            @csrf
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" name="name" id="name" value="{{$user->name}}">
                                @error('name')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="photo">Photo</label>
                                <input type="file" name="photo" id="photo" class="form-control">
                                @error('photo')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                                <div class="mt-2 text-center">
                                    @if ($user->photo=='/img/avatar-3.png')
                                        <img src="{{$user->photo}}" class="shadow mx-auto" width="200">
                                    @else
                                        <img src="{{asset('storage/'.$user->photo)}}" class="shadow mx-auto" width="200">
                                    @endif
                                    <p class="my-0 small font-weight-bold">Your Photo</p>
                                </div>
                            </div>
                            <div class="form-group text-right">
                                <button type="submit" class="btn btn-primary">Edit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
</div>
@endcan
@endauth
@endsection

@push('script')
    <script src="{{asset('vendor/iziToast/dist/js/iziToast.min.js')}}"></script>
    <script src="{{asset('js/script.js')}}"></script>
@endpush