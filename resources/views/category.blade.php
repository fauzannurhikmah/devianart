@extends('layouts.front',['title'=>'Artworks'])

@section('content')
<div class="container">
    <div class="d-flex my-5 justify-content-between">
        <div class="align-self-center">
            <h3 class="text-white mb-0"><span class="text-warning">#</span> Categories</h3>
        </div>
        <form action="{{route('categories')}}" method="get">
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
        @foreach ($categories as $item)
            <div class="col-md-3">
                <div class="product">
                    <figure class="product-media">
                        <a href="{{route('sort-category',$item->slug)}}">
                            <img src="{{asset("storage/$item->thumbnail")}}" alt="Product image" class="product-image" style="height:180px;object-fit:cover;">
                        </a>

                        <div class="product-action-vertical">
                            <a href="#" class="btn-product-icon btn-wishlist" title="Add to Wishlist"><span>add to wishlist</span></a>
                        </div><!-- End .product-action-vertical -->
                    </figure><!-- End .product-media -->

                    <div class="product-body">
                        <h3 class="product-title"><a href="{{route('sort-category',$item->slug)}}">{{$item->name}}</a></h3><!-- End .product-title -->
                    </div><!-- End .product-body -->
                </div>
            </div>
        @endforeach
    </div>
    <div class="d-flex justify-content-center text-center">
        {!! $categories->links() !!}
    </div>
</div>
@endsection