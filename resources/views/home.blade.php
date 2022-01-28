@extends('layouts.front',['title'=>'DevianArt'])

@section('content')
<div class="container service">
    <div class="row">
        <div class="col-sm-6 col-lg-3">
            <div class="icon-box icon-box-side">
                <span class="icon-box-icon text-dark">
                    <i class="icon-rocket"></i>
                </span>

                <div class="icon-box-content">
                    <h3 class="icon-box-title">Free Shipping</h3><!-- End .icon-box-title -->
                    <p>Orders $50 or more</p>
                </div><!-- End .icon-box-content -->
            </div><!-- End .icon-box -->
        </div><!-- End .col-sm-6 col-lg-4 -->
        
        <div class="col-sm-6 col-lg-3">
            <div class="icon-box icon-box-side">
                <span class="icon-box-icon text-dark">
                    <i class="icon-rotate-left"></i>
                </span>

                <div class="icon-box-content">
                    <h3 class="icon-box-title">Free Returns</h3><!-- End .icon-box-title -->
                    <p>Within 30 days</p>
                </div><!-- End .icon-box-content -->
            </div><!-- End .icon-box -->
        </div><!-- End .col-sm-6 col-lg-4 -->

        <div class="col-sm-6 col-lg-3">
            <div class="icon-box icon-box-side">
                <span class="icon-box-icon text-dark">
                    <i class="icon-info-circle"></i>
                </span>

                <div class="icon-box-content">
                    <h3 class="icon-box-title">Get 20% Off 1 Item</h3><!-- End .icon-box-title -->
                    <p>When you sign up</p>
                </div><!-- End .icon-box-content -->
            </div><!-- End .icon-box -->
        </div><!-- End .col-sm-6 col-lg-4 -->

        <div class="col-sm-6 col-lg-3">
            <div class="icon-box icon-box-side">
                <span class="icon-box-icon text-dark">
                    <i class="icon-life-ring"></i>
                </span>

                <div class="icon-box-content">
                    <h3 class="icon-box-title">We Support</h3><!-- End .icon-box-title -->
                    <p>24/7 amazing services</p>
                </div><!-- End .icon-box-content -->
            </div><!-- End .icon-box -->
        </div><!-- End .col-sm-6 col-lg-4 -->

    </div>
</div>

<div class="container popular">
    <hr class="mb-5">

    <div class="section-title">
        <div><p class="title"><span>New Art</span></p></div>
        
        <a class="link" href="{{route('artworks')}}">See All</a>
    </div>

    <div class="row products">

        @foreach ($art as $item)
            <div class="col-6 col-md-4 col-lg-3 col-xl-5col">
                <div class="product product-3 text-center">
                    <figure class="product-media">
                        <a href="{{route('detail-art',$item->id)}}">
                            <img src="{{asset("storage/$item->image")}}" class="product-image" loading="lazy">
                        </a>
                    </figure><!-- End .product-media -->

                    <div class="product-body">
                        <div class="product-cat">
                            <a href="{{route('sort-category',$item->category->slug)}}">{{$item->category->name}}</a>
                        </div><!-- End .product-cat -->
                        <h3 class="product-title"><a href="">{{$item->title}}</a></h3><!-- End .product-title -->
                    </div><!-- End .product-body -->

                    <div class="product-footer">
                        <div class="product-action">
                            <a href="{{route('detail-art',$item->id)}}" class="btn-product btn-quickview" title="Quick view"></a>
                        </div><!-- End .product-action -->
                    </div><!-- End .product-footer -->
                </div><!-- End .product -->
            </div><!-- End .col-sm-6 col-md-4 col-lg-3 -->
        @endforeach

    </div><!-- End .row -->
</div>

<div class="container post">

    <div class="section-title">
        <div><p class="title"><span>Categories</span></p></div>
        <a class="link" href="{{route('categories')}}">See All</a>
    </div>

    <div class="owl-carousel owl-simple mb-4" data-toggle="owl" data-owl-options='{ "nav": true, "dots": false, "items": 3, "margin": 20, "loop": false, "responsive": { "0": { "items":1, "dots":true }, "520": { "items":2, "dots":true }, "768": { "items":3 } } }'>
        @foreach ($categories as $item)
            <article class="entry">
                <figure class="entry-media">
                    <a href="{{route('sort-category',$item->slug)}}">
                        <img src="{{asset("storage/$item->thumbnail")}}" alt="image desc" style="height:230px !important;object-fit:cover">
                    </a>
                </figure><!-- End .entry-media -->

                <div class="entry-body text-center">
                    <h3 class="entry-title">
                        <a href="{{route('sort-category',$item->slug)}}">{{$item->name}}</a>
                    </h3><!-- End .entry-title -->
                </div><!-- End .entry-body -->
            </article><!-- End .entry -->
        @endforeach
    </div><!-- End .owl-carousel -->

</div>
@endsection
