@extends('welcome')
@section('content')
{{-- include vendor sweetAlert --}}
@include('sweetalert::alert')
<div class="container-fluid py-4">
    <h2>Tambah Pegawai</h2>
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-body px-0 pb-2 mx-4">
                    <form role="form text-left" action="{{ route('pegawai.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <div class="input-group input-group-outline my-3">
                                    <label class="form-label">Nama</label>
                                    <input type="text" class="form-control" name="nama" onfocus="focused(this)"
                                        onfocusout="defocused(this)">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group input-group-outline my-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control" name="email" onfocus="focused(this)"
                                        onfocusout="defocused(this)">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group input-group-outline my-3">
                                    <label class="form-label">No Telp</label>
                                    <input type="text" class="form-control" name="no_telp" onfocus="focused(this)"
                                        onfocusout="defocused(this)">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group input-group-outline my-3">
                                    <label class="form-label">alamat</label>
                                    <input type="text" class="form-control" name="alamat" onfocus="focused(this)"
                                        onfocusout="defocused(this)">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group input-group-outline my-3">
                                    <select class="form-control" name="jk" id="exampleFormControlSelect1">
                                        <option disabled selected>Jenis Kelamin</option>
                                        <option value="Laki-Laki">Laki-Laki</option>
                                        <option value="Perempuan">Pimpinan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group input-group-outline my-3">
                                    <label class="form-label">Tanggal Lahir</label>
                                    <input type="date" class="form-control" name="ttl" onfocus="focused(this)"
                                        onfocusout="defocused(this)">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group input-group-outline my-3">
                                    <label class="form-label">username</label>
                                    <input type="text" class="form-control" name="username" onfocus="focused(this)"
                                        onfocusout="defocused(this)">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group input-group-outline my-3">
                                    <label class="form-label">password</label>
                                    <input type="password" class="form-control" name="password" onfocus="focused(this)"
                                        onfocusout="defocused(this)">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group input-group-outline my-3">
                                    <select class="form-control" name="jabatan" id="exampleFormControlSelect1">
                                        <option disabled selected>Jabatan</option>
                                        <option value="Admin">Admin</option>
                                        <option value="Pimpinan">Pimpinan</option>
                                        <option value="Manager">Manager</option>
                                        <option value="Dept Keuangan">Dept Keuangan</option>
                                        <option value="Dept SDM">Dept SDM</option>
                                    </select>
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" id="btn-proses"
                                    class="btn btn-round bg-gradient-info btn-lg w-100 mt-4 mb-0">Tambah</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
