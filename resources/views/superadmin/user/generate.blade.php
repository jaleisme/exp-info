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
                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-account">User Account</label>
                                        <select name="id_user" id="input-account" class="form-control" required>
                                            <option value="" selected disabled>Choose Account</option>
                                            @foreach ($user as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
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
                        <a href="{{ url('superadmin/system-access/user') }}" class="btn btn-sm btn-danger mr-3">Cancel</a>
                        <button class="btn btn-sm btn-primary" type="submit">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('custom-script')

@endsection
