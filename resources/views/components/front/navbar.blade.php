<header class="header header-22">
    <div class="header-middle">
        <div class="container">
            <div class="header-left">
                <button class="mobile-menu-toggler">
                    <span class="sr-only">Toggle mobile menu</span>
                    <i class="icon-bars"></i>
                </button>

                <a href="/" class="logo">
                    <img src="/assets/images/demos/demo-22/logo.png" alt="Molla Logo" width="130" height="30">
                </a>
            </div><!-- End .header-left -->

            <div class="header-center">
                <div class="header-search header-search-extended header-search-visible header-search-no-round">
                    <a href="#" class="search-toggle" role="button"><i class="icon-search"></i></a>
                    <form action="{{route('artworks')}}" method="get">
                        <div class="header-search-wrapper search-wrapper-wide">
                            <label for="q" class="sr-only">Search</label>
                            <input type="search" class="form-control" name="search" id="q" placeholder="Search artwork ..." required>

                            <button class="btn btn-primary" type="submit"><i class="icon-search"></i></button>
                        </div><!-- End .header-search-wrapper -->
                    </form>
                </div><!-- End .header-search -->
            </div>

            <div class="header-right">

                <div class="dropdown cart-dropdown">
                    <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
                        <i class="icon-user"></i>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right">
                        <ul class="compare-products">
                            <li class="compare-product">
                                <a href="#" class="btn-remove" title="Remove Product"><i class="icon-cog"></i></a>
                                <h4 class="compare-product-title"><a href="{{route('upload-artwork')}}">Post Your Work</a></h4>
                            </li>
                            @guest
                            <li class="compare-product">
                                <a href="#" class="btn-remove" title="Remove Product"><i class="icon-close"></i></a>
                                <h4 class="compare-product-title"><a href="{{route('login')}}">Login</a></h4>
                            </li>
                            <li class="compare-product">
                                <a href="#" class="btn-remove" title="Remove Product"><i class="icon-close"></i></a>
                                <h4 class="compare-product-title"><a href="{{route('register')}}">Register</a></h4>
                            </li>
                            @endguest

                            @auth
                            <li class="compare-product">
                                <a href="#" class="btn-remove" title="Remove Product"><i class="icon-user"></i></a>
                                <h4 class="compare-product-title"><a href="{{route('users',auth()->id())}}">Profile</a></h4>
                            </li>
                            <li class="compare-product">
                                <a href="#" class="btn-remove" title="Remove Product"><i class="icon-close"></i></a>
                                <h4 class="compare-product-title"><a href="#" role="button" data-target="#logout" data-toggle="modal">Logout</a></h4>
                            </li>
                            @endauth
                        </ul>
                    </div><!-- End .dropdown-menu -->
                </div><!-- End .cart-dropdown -->
            </div><!-- End .header-right -->
        </div><!-- End .container -->
    </div><!-- End .header-middle -->

</header><!-- End .header -->