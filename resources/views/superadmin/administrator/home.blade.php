@extends('layouts.app')

@section('content')
<div class="">
    <div class="row">
        @if(\Session::has('success'))
        <div class="col-md-12">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <span class="alert-icon"><i class="fa fa-check-square"></i></span>
                <span class="alert-text"><strong>Notice!</strong> {{ \Session::get('success') }}</span>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
        @endif
        @if(\Session::has('danger'))
        <div class="col-md-12">
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <span class="alert-icon"><i class="fa fa-exclamation-triangle"></i></span>
                <span class="alert-text"><strong>Danger!</strong> {{ \Session::get('danger') }}</span>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
        @endif
    </div>

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <!-- Card header -->
                <div class="card-header border-0 d-flex justify-content-between">
                  <h3 class="mb-0">Administrator</h3>
                  <a href="{{ route('administrator.create') }}" class="btn btn-sm btn-primary"><i class="fas fa-plus"></i><span class="ml-1">Add new data</span></a>
                </div>
                <!-- Light table -->
                <div class="table-responsive text-center">
                  <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <tr>
                        <th scope="col" style="width: 5%;"><strong>#</strong></th>
                        <th scope="col">Username</th>
                        <th scope="col">Email</th>
                        <th scope="col" style="width: 20%;">Action</th>
                      </tr>
                    </thead>
                    <tbody class="list">
                        @foreach ($data as $key => $item)
                        <tr>
                            <th scope="row">
                                <strong>{{ $key+1 }}</strong>
                            </th>
                            <td>
                                {{ $item->name }}
                            </td>
                            <td>
                                {{ $item->email }}
                            </td>
                            <td class="d-flex justify-content-center">
                                <a class="btn btn-sm btn-white text-warning btn-icon-only d-flex justify-content-center align-items-center" href="{{ route('administrator.edit', $item->id) }}" tooltip="Edit">
                                  <i class="fas fa-pen"></i>
                                </a>
                                <form method="POST" action="{{ route('administrator.delete', $item->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-white text-danger btn-icon-only d-flex justify-content-center align-items-center" type="submit" tooltip="Delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                                {{-- <div class="dropdown">
                                <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  <i class="fas fa-ellipsis-v"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                  <a class="dropdown-item" href="#">Action</a>
                                  <a class="dropdown-item" href="#">Another action</a>
                                  <a class="dropdown-item" href="#">Something else here</a>
                                </div>
                              </div> --}}
                            </td>
                          </tr>
                        @endforeach
                    </tbody>
                  </table>
                </div>
                <!-- Card footer -->
                {{-- <div class="card-footer py-4">
                  <nav aria-label="...">
                    <ul class="pagination justify-content-end mb-0">
                      <li class="page-item disabled">
                        <a class="page-link" href="#" tabindex="-1">
                          <i class="fas fa-angle-left"></i>
                          <span class="sr-only">Previous</span>
                        </a>
                      </li>
                      <li class="page-item active">
                        <a class="page-link" href="#">1</a>
                      </li>
                      <li class="page-item">
                        <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
                      </li>
                      <li class="page-item"><a class="page-link" href="#">3</a></li>
                      <li class="page-item">
                        <a class="page-link" href="#">
                          <i class="fas fa-angle-right"></i>
                          <span class="sr-only">Next</span>
                        </a>
                      </li>
                    </ul>
                  </nav>
                </div> --}}
              </div>
        </div>
    </div>
</div>
@endsection
