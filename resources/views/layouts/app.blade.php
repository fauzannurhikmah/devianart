<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>DevianArt | {{$title ?? 'Admin'}}</title>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="/vendor/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/css/app.css">
  <link rel="stylesheet" href="/css/adminlte.min.css">
  @yield('style')
</head>
<body class="hold-transition sidebar-mini">
    <div class="wrapper" id="app">
        <x-navbar></x-navbar>
        <x-sidebar></x-sidebar>

        <div class="content-wrapper">
            @yield('content')
        </div>
    </div>

<!-- Logout Modal-->
<div class="modal fade" id="logout" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content border-0">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to leave from admin page</div>
            <div class="modal-footer">
                <button class="btn btn-light" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary"
                onclick="event.preventDefault();
                              document.getElementById('logout-form').submit();" >Logout</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </div>
    </div>
</div>

    <script src="/js/app.js"></script>
    <script src="/js/adminlte.min.js"></script>
    @stack('script')
    <script src="/js/demo.js"></script>
</body>
</html>
