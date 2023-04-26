@extends('layouts.front')
@section('web_title')
Admin - Update Password
@endsection

@section('content')
<div class="container-fluid py-4">
    <div class="row">

        <div class="col-lg-4">

            <h5 class="text-danger fw-bold">Update Password {{ $data->email }}</h5>

        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-mb-12 col-sm-12 m-1 p-2">
            <div class="card">
                <div class="card-body">
                    <form action="javascript:;" id="formUpdatePassword" method="post" class="p-1">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="id" id="idValue" value="{{ $data->id }}">
                        <div class="input-group input-group-outline mb-3">
                            <label class="form-label">password</label>
                            <input type="password" name="password" id="password" class="form-control">
                        </div>
                        <div class="input-group input-group-outline mb-3">
                            <label class="form-label">password confirmation</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                        </div>

                        <button type="submit" class="btn btn-primary">Update Password</button>
                        <a href="{{ route('admin_users') }}" class="btn btn-outline-success ms-1">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>


</div>
@endsection

@push('front_scripts')
<script src="{{ asset('admin_users/update_password.min.js?n=' . time()) }}"></script>
@endpush