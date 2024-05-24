@extends('welcome')
@section('content')
{{-- include vendor sweetAlert --}}
@include('sweetalert::alert')
<div class="container-fluid py-4">
    <h2>Update Pegawai</h2>
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-body px-0 pb-2 mx-4">
                    <form role="form text-left" action="{{ route('pegawai.update', ['id' => $data->id]) }}" method="POST">
                        @method("PUT")
                        @csrf
                        <input type="text" name="user_id" value="{{ $data->user_id }}" hidden/>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="input-group input-group-outline my-3 {{ $data->nama ? 'is-filled' : '' }}">
                                    <label class="form-label">Nama</label>
                                    <input type="text" class="form-control" name="nama" value="{{ $data->nama }}"
                                        onfocusout="defocused(this)">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group input-group-outline my-3 {{ $data->email ? 'is-filled' : '' }}">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control" name="email" onfocus="focused(this)" value="{{ $data->email }}"
                                        onfocusout="defocused(this)">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group input-group-outline my-3 {{ $data->no_telp ? 'is-filled' : '' }}">
                                    <label class="form-label">No Telp</label>
                                    <input type="text" class="form-control" name="no_telp" onfocus="focused(this)" value="{{ $data->no_telp }}"
                                        onfocusout="defocused(this)">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group input-group-outline my-3 {{ $data->alamat ? 'is-filled' : '' }}">
                                    <label class="form-label">alamat</label>
                                    <input type="text" class="form-control" name="alamat" onfocus="focused(this)" value="{{ $data->alamat }}"
                                        onfocusout="defocused(this)">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group input-group-outline my-3">
                                    <select class="form-control" name="jk" id="exampleFormControlSelect1">
                                        <option selected value="{{ $data->jk }}">{{ $data->jk }}</option>
                                        <option disabled>Jenis Kelamin</option>
                                        <option value="Laki-Laki">Laki-Laki</option>
                                        <option value="Perempuan">Pimpinan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group input-group-outline my-3 {{ $data->ttl ? 'is-filled' : '' }}">
                                    <label class="form-label">Tanggal Lahir</label>
                                    <input type="date" class="form-control" name="ttl" onfocus="focused(this)" value="{{ $data->ttl }}"
                                        onfocusout="defocused(this)">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group input-group-outline my-3">
                                    <select class="form-control" name="jabatan" id="exampleFormControlSelect1">
                                        <option selected value="{{ $data->jabatan }}">{{ $data->jabatan }}</option>
                                        <option disabled>Jabatan</option>
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
                                    class="btn btn-round bg-gradient-info btn-lg w-100 mt-4 mb-0">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
