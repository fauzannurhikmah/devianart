@extends('layouts.app',['title'=>'Art'])

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
                          <h2 class="card-title align-self-center">Art List</h2>
                          <a class="ml-auto btn btn-sm btn-secondary" href="{{route('create-art')}}"><i class="fas fa-plus"></i> Tambah Data</a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                          <table id="example2" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                              <th>#</th>
                              <th>Image</th>
                              <th>Title</th>
                              <th>Category</th>
                              <th class="text-center">Actions
                                <small class="d-block text-primary">Edit | Delete</small>
                              </th>
                            </tr>
                            </thead>
                            <tbody>
                              @forelse ($art as $index=>$item)
                                <tr>
                                  <td>{{++$index}}</td>
                                  <td class="text-center"> <img src="{{asset("storage/$item->image")}}" class="shadow-sm rounded" width="100"> </td>
                                  <td>{{$item->title}}</td>
                                  <td>{{$item->category->name}}</td>
                                  <td class="text-center">
                                    <a class="btn btn-sm btn-info mr-1" href="{{route('edit-art',$item->id)}}"><i class="fas fa-edit"></i></a>
                                    <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteModal{{$item->id}}"><i class="fas fa-trash"></i></button>
                                    <x-delete-modal id="{{$item->id}}" link="{{route('delete-art', $item->id)}}"></x-delete-modal>
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
                            {!! $art->links() !!}
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