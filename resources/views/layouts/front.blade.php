<!DOCTYPE html>
<html>

<head>
	<title>{{$title ?? 'DevianArt'}}</title>
	<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="p-themes">

    <meta name="msapplication-TileColor" content="#cc9966">
    <meta name="msapplication-config" content="assets/images/icons/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">
    <!-- Plugins CSS File -->
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/plugins/owl-carousel/owl.carousel.css">
    <link rel="stylesheet" href="/assets/css/plugins/magnific-popup/magnific-popup.css">
    <!-- Main CSS File -->
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="/assets/css/skins/skin-demo-22.css">
    <link rel="stylesheet" href="/assets/css/demos/demo-22.css">
    @yield('style')

</head>
<body>
    <div class="page-wrapper">
        <x-front.navbar></x-front.navbar>
        <div class="main">
            @yield('content')
        </div>
    </div>


<!-- Logout Modal-->
<div class="modal fade" id="logout" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content border-0">
            <div class="modal-header px-4">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body" style="padding: 20px">Select "Logout" below if you are ready to leave from login session</div>
            <div class="modal-footer">
                <button class="btn btn-light" type="button" data-dismiss="modal" style="min-width: 0">Cancel</button>
                <button class="btn btn-primary"
                onclick="event.preventDefault();
                              document.getElementById('logout-form').submit();" style="min-width: 0">Logout</button>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </div>
    </div>
</div>
    <!-- Plugins JS File -->
    <script src="/assets/js/jquery.min.js"></script>
    <script src="/assets/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/js/jquery.hoverIntent.min.js"></script>
    <script src="/assets/js/jquery.waypoints.min.js"></script>
    <script src="/assets/js/superfish.min.js"></script>
    <script src="/assets/js/owl.carousel.min.js"></script>
    <script src="/assets/js/bootstrap-input-spinner.js"></script>
    <script src="/assets/js/jquery.magnific-popup.min.js"></script>
    <!-- Main JS File -->
    <script src="/assets/js/main.js"></script>
    @stack('script')
</body>

</html>