@extends('welcome')
@section('content')
{{-- include vendor sweetAlert --}}
@include('sweetalert::alert')
<div class="container-fluid py-4">
    <h2>Management User</h2>
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3 ">
                        <div class="row align-items-center">
                            <div class="col-sm">
                                <h6 class="text-white text-capitalize ps-3">
                                    Users table
                                </h6>
                            </div>
                            <div class="col-sm  d-flex align-items-center justify-content-end mx-3">
                                <button type="button" class="btn btn-info" data-bs-toggle="modal"
                                    data-bs-target="#modal-form">Tambah</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Name
                                    </th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Password
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Role
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- Foreach data user untuk ditampilkan --}}
                                @foreach ($data as $users)
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">
                                                    {{ $users->username }}
                                                </h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">
                                            {{ $users->password }}
                                        </p>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <span class="badge badge-sm bg-gradient-success"> {{ $users->role }}</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <a href="#" type="button" class="text-secondary font-weight-bold text-md"
                                            data-toggle="tooltip" data-original-title="Edit user" data-bs-toggle="modal"
                                            data-bs-target="#updateUser-modal{{ $users->id }}">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        <a href="{{ route('user.destroy', ['id' => $users->id ]) }}"
                                            class="text-secondary font-weight-bold text-md" data-toggle="tooltip"
                                            data-original-title="Delete user" data-confirm-delete="true">
                                            <i class="fa-solid fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                                {{-- Modal Update Data User--}}
                                <div class="modal fade" id="updateUser-modal{{ $users->id }}" tabindex="-1"
                                    role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                                        <div class="modal-content">
                                            <div class="modal-body p-0">
                                                <div class="card card-plain">
                                                    <div class="card-header pb-0 text-left">
                                                        <h5 class="">Update User{{ $users->id }}</h5>
                                                    </div>
                                                    <div class="card-body">
                                                        <form role="form text-left" action="{{ route('user.update',['id' => $users->id]) }}"
                                                            method="POST">
                                                            @method('PUT')
                                                            @csrf
                                                            <div class="input-group input-group-outline my-3 {{ $users->username ? 'is-filled' : '' }}">
                                                                <label class="form-label">Username</label>
                                                                <input type="text" class="form-control" name="username" value="{{ $users->username }}"
                                                                    onfocus="focused(this)"
                                                                    onfocusout="defocused(this)">
                                                            </div>
                                                            <div class="input-group input-group-outline my-3 {{ $users->password ? 'is-filled' : '' }}">
                                                                <label class="form-label">Password</label>
                                                                <input type="password" class="form-control"
                                                                    name="password" onfocus="focused(this)" value="{{ $users->password }}"
                                                                    onfocusout="defocused(this)">
                                                            </div>
                                                            <div class="input-group input-group-outline my-3">
                                                                <select class="form-control" name="role"
                                                                    id="exampleFormControlSelect1">
                                                                    <option disabled selected value="{{ $users->role }}">{{ $users->role }}</option>
                                                                    <option value="Admin">Admin</option>
                                                                    <option value="Pimpinan">Pimpinan</option>
                                                                    <option value="Manager">Manager</option>
                                                                    <option value="Dept Keuangan">Dept Keuangan</option>
                                                                    <option value="Dept SDM">Dept SDM</option>
                                                                </select>
                                                            </div>
                                                            <div class="text-center">
                                                                <button type="submit" id="btn-proses"
                                                                    class="btn btn-round bg-gradient-info btn-lg w-100 mt-4 mb-0">Tambah</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                {{-- Modal Add User --}}
                <div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modal-form"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                        <div class="modal-content">
                            <div class="modal-body p-0">
                                <div class="card card-plain">
                                    <div class="card-header pb-0 text-left">
                                        <h5 class="">Tambah User</h5>
                                        <p class="mb-0">Data ini digunakan untuk Login User Sesuai Role</p>
                                    </div>
                                    <div class="card-body">
                                        <form role="form text-left" action="{{ route('user.store') }}" method="POST">
                                            @csrf
                                            <div class="input-group input-group-outline my-3">
                                                <label class="form-label">Username</label>
                                                <input type="text" class="form-control" name="username"
                                                    onfocus="focused(this)" onfocusout="defocused(this)">
                                            </div>
                                            <div class="input-group input-group-outline my-3">
                                                <label class="form-label">Password</label>
                                                <input type="password" class="form-control" name="password"
                                                    onfocus="focused(this)" onfocusout="defocused(this)">
                                            </div>
                                            <div class="input-group input-group-outline my-3">
                                                <select class="form-control" name="role" id="exampleFormControlSelect1">
                                                    <option disabled selected>Role</option>
                                                    <option value="Admin">Admin</option>
                                                    <option value="Pimpinan">Pimpinan</option>
                                                    <option value="Manager">Manager</option>
                                                    <option value="Dept Keuangan">Dept Keuangan</option>
                                                    <option value="Dept SDM">Dept SDM</option>
                                                </select>
                                            </div>
                                            <div class="text-center">
                                                <button type="submit" id="btn-proses"
                                                    class="btn btn-round bg-gradient-info btn-lg w-100 mt-4 mb-0">Tambah</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
