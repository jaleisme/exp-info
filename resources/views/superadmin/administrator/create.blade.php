@extends('layouts.app')

@section('content')
<div class="">
    @if(\Session::has('msg'))
    <div class="row">
        <div class="col-12">
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <span class="alert-icon"><i class="fa fa-exclamation-triangle"></i></span>
                <span class="alert-text"><strong>Error!</strong> {{ \Session::get('msg') }}</span>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    </div>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <form action="{{ route('administrator.store') }}" method="POST">
                    @csrf
                    <div class="card-header"><strong>New Administrator</strong></div>
                    <div class="card-body">
                        <h6 class="heading-small text-muted mb-4">User information</h6>
                        <div class="">
                            <div class="row">
                                <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-username">Username</label>
                                    <input type="text" name="name" id="input-username" class="form-control" placeholder="E.g. John Doe" required>
                                </div>
                                </div>
                                <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-email">Email address</label>
                                    <input type="email" name="email" id="input-email" class="form-control" placeholder="johndoe@example.com" required>
                                </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-first-name">Password</label>
                                    <input  id="password" name="password" type="password" class="form-control px-3 @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="********">
                                    <small>Password must be more than 8 characters</small>
                                </div>
                                </div>
                                <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-last-name">Confirm Password</label>
                                    <input type="password" name="confirm_password" id="input-last-name" class="form-control" placeholder="********" required>
                                    <div class="text-muted font-italic"><small>password strength: <span id="password-status" class="font-weight-700"></span></small></div>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-end">
                        <a href="{{ url('superadmin/system-access/administrator') }}" class="btn btn-sm btn-danger mr-3">Cancel</a>
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
