@extends('layouts.front')
@section('web_title')
    Admin - Data Users
@endsection

@section('content')
    <div class="container-fluid py-4">

        <div class="row">
            <div class="col-lg-12 col-mb-12 col-sm-12 m-1 p-2">
                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#user_modal">
                    <i class="fa fa-plus" aria-hidden="true"></i><span>Tambah User</span>
                </button>
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="adminUsers" class="table table-hover table-striped align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th>Aksi</th>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th class="text-center text-uppercase text-secondary font-weight-bolder ">
                                            Email</th>

                                    </tr>
                                </thead>
                                <?php $data_index = 0; ?>
                                <tfoot>
                                    <tr>
                                        <td>
                                            <input type="hidden" data-index="<?php echo $data_index;
                                            $data_index++;
                                            ?>">
                                        </td>
                                        <td>
                                            <input type="hidden" data-index="<?php echo $data_index;
                                            $data_index++;
                                            ?>">
                                        </td>
                                        <td><input type="text" class="form-control tfoot-seacrh border"
                                                placeholder="nomer user" id="tfootName" data-index="<?php echo $data_index;
                                                $data_index++; ?>">
                                        </td>
                                        <td><input type="text" class="form-control tfoot-seacrh border"
                                                placeholder="emai user" id="tfootEmail" data-index="<?php echo $data_index;
                                                $data_index++; ?>">
                                        </td>

                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Modal -->
        <div class="modal fade" id="user_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Formulir Tambah Barang</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="javascript:;" id="formTambahUser" method="post" class="p-1">
                            @csrf
                            <div class="input-group input-group-outline mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" name="name" id="name" class="form-control">
                            </div>
                            <div class="input-group input-group-outline mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" id="email" class="form-control">
                            </div>
                            <div class="input-group input-group-outline mb-3">
                                <label class="form-label">password</label>
                                <input type="password" name="password" id="password" class="form-control">
                            </div>
                            <div class="input-group input-group-outline mb-3">
                                <label class="form-label">password confirmation</label>
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                    class="form-control">
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('front_scripts')
    <script src="{{ asset('admin_users/view.js?n=' . time()) }}"></script>
@endpush
