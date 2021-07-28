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
                <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-header"><strong>New User</strong></div>
                    <div class="card-body">
                        <div class="user-account">
                            <div class="row">
                                <div class="col-12">
                                    <h6 class="heading-small text-muted mb-4">User Account</h6>
                                </div>
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
                        <hr class="my-5">
                        <div class="user-information">
                            <div class="row">
                                <div class="col-12">
                                    <h6 class="heading-small text-muted mb-4">User Information</h6>
                                </div>
                                <div class="col-6">
                                    <label class="form-control-label">Choose Photo</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="customFileLang" lang="en" name="photo" required>
                                        <label class="custom-file-label" for="customFileLang">Select Photo</label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-student_uid">Student ID</label>
                                        <input type="text" name="student_uid" id="input-student_uid" class="form-control" placeholder="E.g. 1207050***" required>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-address">Address</label>
                                        <textarea name="address" id="input-address" class="form-control" placeholder="E.g. Wolf St. No. 12" required></textarea>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-about">About</label>
                                        <input type="text" name="about" id="input-about" class="form-control" placeholder="E.g. Hello There!" required>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-tel_num">Phone Number</label>
                                        <input type="text" name="tel_num" id="input-tel_num" class="form-control" placeholder="+62-****-****-****" required>
                                        <small>Whatsapp number priority</small>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-pob">Place of Birth</label>
                                        <input type="text" name="pob" id="input-pob" class="form-control" placeholder="E.g. Greenwoods, Alabama" required>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-dob">Date of Birth</label>
                                        <input type="date" name="dob" id="input-dob" class="form-control" required>
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

    let role_check = $('#role_check')
    role_check.change(function(){
        if (role_check.is(':checked')) {
            $('#role').val(1)
        }
        else{
            $('#role').val(2)
        }
        // console.log($('#role').val())
    })
</script>
@endsection
