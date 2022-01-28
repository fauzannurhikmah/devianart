@extends('layouts.app',['title'=>'Artist'])

@section('style')
    <!-- DataTables -->
  <link rel="stylesheet" href="/vendor/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="/vendor/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="/vendor/datatables-buttons/css/buttons.bootstrap4.min.css">
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
              <h1><i class="fas fa-paint-brush"></i> Artist</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Artist</li>
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
                          <h2 class="card-title align-self-center">Artist List</h2>
                          <span class="ml-auto text-warning font-weight-bold" data-toggle="modal" data-target="#addModal"> All Artist Contribute <i class="fas fa-bell"></i></span>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                          <table id="example2" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                              <th>#</th>
                              <th>Name</th>
                              <th>Art Publish</th>
                              <th class="text-center">Actions
                                <small class="d-block text-primary">Edit | Delete</small>
                              </th>
                            </tr>
                            </thead>
                            <tbody>
                              @forelse ($artist as $index=>$item)
                                <tr>
                                  <td>{{++$index}}</td>
                                  <td>
                                      <div class="row">
                                          <div class="col text-center">
                                            <img @if ($item->photo=='/img/avatar-3.png')
                                            src="{{asset($item->photo)}}" @else src="{{asset("storage/$item->photo")}}"
                                            @endif class="img-circle elevation-2" alt="User Image" width="50" height="50" style="object-fit:cover" loading="lazy">
                                          </div>
                                          <div class="col-md-10">
                                              <p class="my-0 font-weight-bold">{{$item->name}}</p>
                                              <small class="text-primary">{{$item->email}}</small>
                                          </div>
                                      </div>
                                  </td>
                                  <td>{{$item->arts->count()}}</td>
                                  <td class="text-center">
                                    <button class="btn btn-sm btn-info mr-1" data-toggle="modal" data-target="#editModal{{$item->id}}"><i class="fas fa-edit"></i></button>
                                    <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteModal{{$item->id}}"><i class="fas fa-trash"></i></button>
                                    <x-delete-modal id="{{$item->id}}" link="{{route('delete-category', $item->id)}}"></x-delete-modal>
                                  </td>
                                </tr>
                              @empty
                                <tr>
                                  <td colspan="5" class="text-center"><p class="lead">Empty <i class="fas fa-exlamation-triangle text-warning"></i></p></td>
                                </tr>
                              @endforelse
                            </tbody>
                          </table>

                          <div class="d-flex justify-content-end">
                            {!! $artist->links() !!}
                          </div>
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
    <script src="/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="/vendor/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="/vendor/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="/vendor/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="/vendor/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="/vendor/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="/vendor/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="/vendor/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="/vendor/datatables-buttons/js/buttons.colVis.min.js"></script>
    <script src="/js/dataTable.js"></script>
    <script src="{{asset('vendor/iziToast/dist/js/iziToast.min.js')}}"></script>
    <script src="{{asset('js/script.js')}}"></script>
@endpush