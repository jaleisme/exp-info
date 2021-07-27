@extends('layouts.app')

@section('content')
<div class="">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Notice</div>

                <div class="card-body">
                    Welcome back, <strong>{{ Auth::user()->name }}!</strong>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
