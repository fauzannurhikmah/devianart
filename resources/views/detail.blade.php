@extends('layouts.front',['title'=>"DevianArt - $art->title"])

@section('style')
<link rel="stylesheet" href="/vendor/fontawesome-free/css/all.min.css">
<link rel="stylesheet" href="{{asset('vendor/iziToast/dist/css/iziToast.min.css')}}">
@endsection

@section('content')
<!-- Toastification -->
@if (session()->has('failed'))
    <span id="toast" data-status=true data-type="{{session()->has('failed') ? 'error' :'success'}}" data-message="{{session('failed')}}"></span>
@endif
<div class="page-content mt-4">
    <div class="container">
        <div class="row">
            <div class="col-lg-9">
                <article class="entry single-entry">
                    <figure class="entry-media">
                        <img src="{{asset("storage/$art->image")}}" alt="image desc" loading="lazy">
                    </figure><!-- End .entry-media -->

                    <div class="entry-body">
                        <div class="entry-meta">
                            <span class="entry-author">
                                by <a href="{{route('users',$art->user->id)}}">{{$art->user->name}}</a>
                            </span>
                            <span class="meta-separator">|</span>
                            <a href="#">{{$art->created_at->diffForHumans()}}</a>
                            <span class="ml-auto">
                                @auth
                                @can('update', $art)
                                <a href="{{route('edit-artwork',$art->id)}}" class="badge p-3 text-info"><i class="fas fa-edit"></i></a>
                                @endcan
                                @can('delete', $art)
                                <a href="#" class="badge p-3 text-danger" data-toggle="modal" data-target="#deleteModal"><i class="fas fa-trash"></i></a>
                                @endcan
                                @endauth
                                <a href="{{route('download',$art->id)}}" class="badge p-3" style="border: 1px solid"><i class="fas fa-download"></i></a>
                            </span>
                        </div><!-- End .entry-meta -->

                        <h2 class="entry-title text-white">
                           {{$art->title}}
                        </h2><!-- End .entry-title -->

                        <div class="entry-content editor-content">
                            <p>{{$art->description}}</p>
                        </div><!-- End .entry-content -->

                        <div class="entry-footer row no-gutters flex-column flex-md-row">
                            <div class="col-md">
                                <div class="entry-tags">
                                    <span>Category:</span> <a href="{{route('sort-category',$art->category->slug)}}">{{$art->category->name}}</a>
                                </div><!-- End .entry-tags -->
                            </div><!-- End .col -->

                            <div class="col-md-auto mt-2 mt-md-0">
                                <div class="social-icons social-icons-color">
                                    <span class="social-label">Share this post:</span>
                                    <a href="#" class="social-icon social-facebook" title="Facebook" target="_blank"><i class="icon-facebook-f"></i></a>
                                    <a href="#" class="social-icon social-twitter" title="Twitter" target="_blank"><i class="icon-twitter"></i></a>
                                    <a href="#" class="social-icon social-pinterest" title="Pinterest" target="_blank"><i class="icon-pinterest"></i></a>
                                    <a href="#" class="social-icon social-linkedin" title="Linkedin" target="_blank"><i class="icon-linkedin"></i></a>
                                </div><!-- End .soial-icons -->
                            </div><!-- End .col-auto -->
                        </div><!-- End .entry-footer row no-gutters -->
                    </div><!-- End .entry-body -->

                </article><!-- End .entry -->
             
                @if($comments->count())
                    <div class="comments">
                        <h3 class="title">{{$comments->count()}} Comments</h3><!-- End .title -->
                        <ul>
                            @foreach ($comments as $item)
                                <li>
                                    <div class="comment">
                                        <figure class="comment-media">
                                            <a href="{{route('users',$item->user->id)}}">
                                                @if ($item->user->photo=='/img/avatar-3.png')
                                                    <img src="{{asset($item->user->photo)}}" alt="User name">
                                                @else
                                                    <img src="{{asset('storage/'.$item->user->photo)}}" alt="User name" style="width:50px;height:50px;object-fit:cover">
                                                @endif
                                            </a>
                                        </figure>

                                        <div class="comment-body">
                                            <div class="float-right">
                                                @can('update', $item)
                                                    <a href="#" class="small nav-link d-inline-block text-info" data-toggle="modal" data-target="#editComment{{$item->id}}">Edit <i class="fas fa-edit"></i></a>
                                                @endcan
                                                @can('delete', $item)
                                                    <a href="#" class="small nav-link d-inline-block text-secondary" data-toggle="modal" data-target="#deleteComment{{$item->id}}">delete <i class="fas fa-trash"></i></a>
                                                @endcan
                                            </div>
                                            <div class="comment-user">
                                                <h4><a href="{{route('users',$item->user->id)}}" class="text-info">{{$item->user->name}}</a>
                                                    @if ($item->user_id==auth()->id())
                                                        <span class="ml-2 badge badge-warning d-inline-block" style="font-size: 10px">You</span>
                                                    @endif
                                                </h4>
                                                <span class="comment-date">{{$item->created_at->format('d M Y')}}</span>
                                            </div><!-- End .comment-user -->

                                            <div class="comment-content">
                                                <p>{{$item->message}}</p>
                                            </div><!-- End .comment-content -->
                                        </div><!-- End .comment-body -->
                                    </div><!-- End .comment -->
                                </li>
                            @endforeach
                        </ul>
                    </div><!-- End .comments -->
                @endif
                <div class="reply" style="background-color: #333333">
                    <div class="heading">
                        <h3 class="title text-white">Leave A Reply</h3><!-- End .title -->
                        <p class="title-desc">Your name will be filled automatically if you are logged in*</p>
                    </div><!-- End .heading -->

                    <form action="{{route('post-comment')}}" method="POST">
                        @csrf
                        <input type="hidden" name="art" value="{{$art->id}}">
                        <label for="message" class="sr-only">Comment</label>
                        <textarea name="text" id="text" cols="30" rows="4" class="form-control" required placeholder="Comment *" required></textarea>
                        @error('text')
                            <small class="text-warning">{{$message}}</small>
                        @enderror
                        <button type="submit" class="btn btn-outline-primary-2">
                            <span>POST COMMENT</span>
                            <i class="icon-long-arrow-right"></i>
                        </button>
                    </form>
                </div><!-- End .reply -->
            </div><!-- End .col-lg-9 -->

            <aside class="col-lg-3">
                <div class="sidebar">
                    <div class="widget widget-search">
                        <h3 class="widget-title text-white"><span class="text-warning">#</span> Artist</h3><!-- End .widget-title -->
                        <div class="text-center">
                            @if ($art->user->photo=='/img/avatar-3.png')
                                <img src="{{$art->user->photo}}" alt="juahah" class="rounded-pill mx-auto" width="100">
                            @else
                                <img src="{{asset('storage/'.$art->user->photo)}}" alt="juahah" class="rounded-pill mx-auto" style="width: 100px;height:100px;object-fit:cover">
                            @endif
                            <a href="{{route('users',$art->user->id)}}"> <h6 class="text-white my-0 font-weight-bold">{{$art->user->name}}</h6> </a>
                            <p class="my-0 text-warning small">{{$art->user->email}}</p>
                        </div>
                    </div><!-- End .widget -->

                    <div class="widget">
                        <h3 class="widget-title text-white"><span class="text-warning">#</span> New Art</h3>
                        <div class="row">
                            @foreach ($arts as $item)
                                <div class="col-md-4 mt-1">
                                    <a href="{{route('detail-art',$item->id)}}">
                                        <img src="{{asset("storage/$item->image")}}" class="rounded shadow" loading="lazy" style="height:55px;object-fit:cover;">
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="widget widget-cats">
                        <h3 class="widget-title text-white"><span class="text-warning">#</span> Categories</h3><!-- End .widget-title -->

                        <ul>
                            @foreach ($categories as $item)
                                <li><a href="{{route('sort-category',$item->slug)}}" class="text-white">{{$item->name}}<span class="badge badge-warning">{{$item->arts->count()}}</span></a></li>
                            @endforeach
                        </ul>
                    </div><!-- End .widget -->
                </div><!-- End .sidebar sidebar-shop -->
            </aside><!-- End .col-lg-3 -->
        </div><!-- End .row -->
    </div><!-- End .container -->
</div><!-- End .page-content -->


<!-- Modal For Delete Artwork-->
@auth
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header px-4">
                <h5 class="modal-title font-weight-bold" id="exampleModalLabel">Are you sure?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body text-left" style="padding: 20px">Do you want to delete artwork ID:{{$art->id}}?</div>
            <div class="modal-footer">
                <button class="btn btn-info" style="min-width: 0">Cancel</button>
                <form action="{{route('delete-artwork',$art->id)}}" method="POST">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-danger"  style="min-width: 0">Delete</button>
                </form>
            </div>
        </div>
    </div>
    </div>
@endauth

<!-- Modal For Edit Comment  -->
@foreach ($comments as $item)
<div class="modal fade" id="editComment{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header px-4">
            <h5 class="modal-title font-weight-bold" id="exampleModalLabel">Comment ID {{$item->id}}</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body text-left" style="padding: 20px">
            <form action="{{route('edit-comment',$item->id)}}" method="POST">
                @csrf
                @method('put')
                <div class="form-group">
                    <input type="hidden" name="art" value="{{$art->id}}">
                    <label for="text">Message</label>
                    <textarea name="text" id="text" cols="30" rows="10" class="form-control">{{old('text') ?? $item->message}}</textarea>
                    @error('text')
                        <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div class="text-right">
                    <button type="submit" class="btn btn-primary"  style="min-width: 0">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
@endforeach

<!-- Modal For Delete Comment  -->
@auth
@foreach ($comments as $item)
<div class="modal fade" id="deleteComment{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header px-4">
            <h5 class="modal-title font-weight-bold" id="exampleModalLabel">Are you sure?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body text-left" style="padding: 20px">Do you want to delete this comment ID : {{$item->id}}?</div>
        <div class="modal-footer">
            <button class="btn btn-info" style="min-width: 0">Cancel</button>
            <form action="{{route('delete-comment',$item->id)}}" method="POST">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-danger"  style="min-width: 0">Delete</button>
            </form>
        </div>
    </div>
</div>
</div>
@endforeach
@endauth


@endsection

@push('script')
    <script src="{{asset('vendor/iziToast/dist/js/iziToast.min.js')}}"></script>
    <script src="{{asset('js/script.js')}}"></script>
@endpush
