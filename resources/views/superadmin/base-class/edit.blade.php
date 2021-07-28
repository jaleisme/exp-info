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
                        <div class="">
                            <div class="row">
                                <div class="col-12">
                                    <h6 class="heading-small text-muted mb-4">Class Detail</h6>
                                </div>
                                <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-class-name">Class Name</label>
                                    <input type="text" name="class_name" id="input-class-name" class="form-control" placeholder="E.g. Class A of 2021" value="{{ $data->class_name }}" required>
                                </div>
                                </div>
                                <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-email">Class Leader</label>
                                    <select name="leader" class="form-control" required>
                                        <option value="" disabled>Choose Class Leader</option>
                                        @foreach ($user as $item)
                                        <option value="{{ $item->id }}" @if($item->id == $data->leader) selected @endif>{{ $item->name }}</option>
                                        @endforeach
                                    </select>
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
        </div>
    </div>
</div>
@endsection

@section('custom-script')
<script>
    let status = $('#password-status')
    let input = $('#password')
    let length = 0
    $('document').ready(function(){
      status.addClass('text-danger')
      status.text('too weak')
    })
    input.keyup(function(){
        length = input.val().length;
        if(length == 0){
          status.removeClass('text-success')
          status.removeClass('text-warning')
          console.log('too weak '+length);
          status.addClass('text-danger')
          status.text('too weak')
        }
        if(length > 0 || length <= 6){
          status.removeClass('text-success')
          status.removeClass('text-danger')
          console.log('weak '+length);

          status.addClass('text-warning')
          status.text('weak')
        }
        if(length > 6){
          status.removeClass('text-warning')
          status.removeClass('text-danger')
          console.log('strong '+length);

          status.addClass('text-success')
          status.text('strong')
        }
    })
</script>
@endsection
