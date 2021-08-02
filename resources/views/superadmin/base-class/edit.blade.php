@extends('layouts.app')

@section('content')
<div class="">
    @if(\Session::has('msg'))
    <div class="col-12">
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <span class="alert-icon"><i class="fa fa-exclamation-triangle"></i></span>
            <span class="alert-text"><strong>Error!</strong> {{ \Session::get('msg') }}</span>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <form action="{{ route('base-class.update', $data->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-header"><strong>Edit Class</strong></div>
                    <div class="card-body">
                        <div class="class-detail">
                            <div class="row">
                                <div class="col-12">
                                    <h6 class="heading-small text-muted mb-4">Class Detail</h6>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-class-name">Class Name</label>
                                        <input type="text" name="class_name" id="input-class-name" class="form-control" placeholder="E.g. Class A of 2021" value="{{ $data->class_name }}" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-end">
                        <a href="{{ url('superadmin/academic/base-class') }}" class="btn btn-sm btn-danger mr-3">Cancel</a>
                        <button class="btn btn-sm btn-primary" type="submit">Save Changes</button>
                    </div>
                </form>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="card-students">
                        <div class="row">
                            <div class="col-6">
                                <h6 class="heading-small text-muted mb-4">Class Students</h6>
                            </div>
                            <div class="col-6 d-flex justify-content-end">
                                <div class="cta">
                                    <button type="button" class="btn btn-sm btn-white text-primary" data-toggle="modal" data-target="#modal-default"><i class="fas fa-plus"></i><span class="ml-1">Add student</span></button>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="table-responsive text-center">
                                    <table class="table align-items-center table-flush">
                                      <thead class="thead-light">
                                        <tr>
                                          <th scope="col" style="width: 5%;"><strong>#</strong></th>
                                          <th scope="col">Student Name</th>
                                          <th scope="col">Student Email</th>
                                          <th scope="col" style="width: 20%;">Action</th>
                                        </tr>
                                      </thead>
                                      <tbody class="list">
                                          @if (count($users) == 0)
                                            <tr>
                                                <td colspan="4">No Data Here</td>
                                            </tr>
                                          @endif
                                          @foreach ($users as $key => $item)
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
                                                  <form method="POST" action="{{ route('remove-student') }}" id="form">
                                                      @csrf
                                                      <input type="hidden" name="class_id" id="class_id" value="{{ $data->id }}">
                                                      <input type="hidden" name="student_id" id="student_id" value="{{ $item->id_user }}">
                                                      <button class="btn btn-sm btn-white text-danger btn-icon-only d-flex justify-content-center align-items-center" id="delete-btn" tooltip="Delete">
                                                          <i class="fas fa-trash"></i>
                                                      </button>
                                                  </form>
                                              </td>
                                            </tr>
                                          @endforeach
                                      </tbody>
                                    </table>
                                  </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<input type="hidden" id="url" value="{{ route('remove-student') }}">
<input type="hidden" id="csrf" value="{{ CSRF_TOKEN() }}">
<div class="modal fade" id="modal-default" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
    <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
        <div class="modal-content">
            <form action="{{ route('add-student') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h6 class="modal-title" id="modal-title-default">Add New Student</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <div class="modal-body">
                    <input type="hidden" name="class_id" value="{{ $data->id }}">
                    <div class="form-group">
                        <label class="form-control-label" for="input-email">Student Name</label>
                        <select name="student" class="form-control" required>
                            <option value="" selected disabled>Choose Student</option>
                            @foreach ($all_student as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-link  mr-auto" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('custom-script')
<script>
    $('#delete-btn').click(function(){
        var url = $('#url').val()
        var csrf = $('#csrf').val()

        $.ajax({
            type: "POST",
            url: url,
            data: {
                csrf_token: csrf,
                class_id: $('#class_id').val(),
                student_id: $('#student_id').val(),
            }
        });
    })
</script>
@endsection
