@extends('layouts.front',['title'=>'Artworks'])

@section('content')
<div class="container">
    <div class="d-flex my-5 justify-content-between">
        <div class="align-self-center">
            <h3 class="text-white mb-0"><span class="text-warning">#</span> Artworks</h3>
            @if (request('search'))
                <p class="my-0">Search <span class="text-warning">{{request('search')}}...</span></p>
                <p class="my-0 small">Result <span class="badge badge-warning">{{$art->count()}}</span></p>
            @endif

            @if (request()->routeIs('sort-category'))
                <p class="my-0">Category <span class="text-warning">{{$art->first()->category->name}}</span></p>
                <p class="my-0 small">Result <span class="badge badge-warning">{{$art->count()}}</span></p>
            @endif
        </div>
        <form action="{{route('artworks')}}" method="get">
            <div class="input-group">
                <select name="filter" class="form-control">
                    <option selected disabled>Filter</option>
                    <option value="asc">Newest</option>
                    <option value="desc">Oldest</option>
                    <option value="sort-az">Sort A-Z</option>
                    <option value="sort-za">Sort Z-A</option>
                </select>
                <button type="submit" class="btn btn-warning" id="basic-addon2"  style="min-width:0;padding: 7px 12px;"><img src="/img/filter.png" width="15"></button>
              </div>
        </form>
    </div>
    <div class="row justify-content-center">
        @foreach ($art as $item)
            <div class="col-md-3">
                <div class="product">
                    <figure class="product-media">
                        <a href="{{route('detail-art',$item->id)}}">
                            <img src="{{asset("storage/$item->image")}}" alt="Product image" class="product-image" style="height:180px;object-fit:cover;">
                        </a>

                        <div class="product-action-vertical">
                            <a href="#" class="btn-product-icon btn-wishlist" title="Add to Wishlist"><span>add to wishlist</span></a>
                        </div><!-- End .product-action-vertical -->
                    </figure><!-- End .product-media -->

                    <div class="product-body">
                        <div class="product-cat">
                            <a href="{{route('sort-category',$item->category->slug)}}">{{$item->category->name}}</a>
                        </div><!-- End .product-cat -->
                        <h3 class="product-title"><a href="{{route('detail-art',$item->id)}}">{{$item->title}}</a></h3><!-- End .product-title -->
                    </div><!-- End .product-body -->
                </div>
            </div>
        @endforeach
    </div>
    <div class="d-flex justify-content-center text-center">
        {!! $art->links() !!}
    </div>
</div>
@endsection