@extends('welcome')
@section('content')
{{-- include vendor sweetAlert --}}
@include('sweetalert::alert')
<div class="container-fluid py-4">
    <h2>Management Gaji</h2>
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3 ">
                        <div class="row align-items-center">
                            <div class="col-sm">
                                <h6 class="text-white text-capitalize ps-3">
                                    Gaji table
                                </h6>
                            </div>
                            <div class="col-sm  d-flex align-items-center justify-content-end mx-3 gap-2">
                                <button type="button" class="btn btn-info" data-bs-toggle="modal"
                                    data-bs-target="#modal-form">Tambah</button>
                                    <a type="button" class="btn btn-success" href="{{ route('gaji.cetak') }}">Cetak</a>
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
                                        Nama Pegawai
                                    </th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Bulan
                                    </th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Tahun
                                    </th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Nominal
                                    </th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Tanggal Diterima
                                    </th>
                                    <th
                                        class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Status
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- Foreach data user untuk ditampilkan --}}
                                @foreach ($gaji as $items)
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">
                                                    {{ $items->pegawais->nama }}
                                                </h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">
                                            {{ $items->bulan }}
                                        </p>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">
                                            {{ $items->tahun }}
                                        </p>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">
                                            {{ $items->nominal }}
                                        </p>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">
                                            {{ $items->tgl_diterima }}
                                        </p>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <span class="badge badge-sm bg-gradient-success">
                                            {{ $items->status }}</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <a href="#"
                                            class="text-secondary font-weight-bold text-xs" data-toggle="tooltip"
                                            data-original-title="Edit update" data-bs-toggle="modal"
                                            data-bs-target="#update-modal{{ $items->id }}">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        <a href="{{ route('gaji.destroy', ['id' => $items->id]) }}"
                                            class="text-secondary font-weight-bold text-xs" data-toggle="tooltip"
                                            data-original-title="Delete gaji" data-confirm-delete="true">
                                            <i class="fa-solid fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                                {{-- Modal Update Data gaji --}}
                                <div class="modal fade" id="update-modal{{ $items->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="modal-form" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                                        <div class="modal-content">
                                            <div class="modal-body p-0">
                                                <div class="card card-plain">
                                                    <div class="card-header pb-0 text-left">
                                                        <h5 class="">Update</h5>
                                                    </div>
                                                    <div class="card-body">
                                                        <form role="form text-left"
                                                            action="{{ route('gaji.update', ['id' => $items->id]) }}"
                                                            method="POST">
                                                            @method('PUT')
                                                            @csrf
                                                            <div class="input-group input-group-outline my-3">
                                                                <select class="form-control" name="bulan"
                                                                    id="exampleFormControlSelect1">
                                                                    <option value="Januari" {{ $items->bulan ==
                                                                        'Januari' ? 'selected' : '' }}>
                                                                        Januari</option>
                                                                    <option value="Februari" {{ $items->bulan ==
                                                                        'Februari' ? 'selected' : '' }}>
                                                                        Februari</option>
                                                                    <option value="Maret" {{ $items->bulan == 'Maret' ?
                                                                        'selected' : '' }}>
                                                                        Maret</option>
                                                                    <option value="April" {{ $items->bulan == 'April' ?
                                                                        'selected' : '' }}>
                                                                        April</option>
                                                                    <option value="Mei" {{ $items->bulan == 'Mei' ?
                                                                        'selected' : '' }}>
                                                                        Mei</option>
                                                                    <option value="Juni" {{ $items->bulan == 'Juni' ?
                                                                        'selected' : '' }}>
                                                                        Juni</option>
                                                                    <option value="July" {{ $items->bulan == 'July' ?
                                                                        'selected' : '' }}>
                                                                        July</option>
                                                                    <option value="Agustus" {{ $items->bulan ==
                                                                        'Agustus' ? 'selected' : '' }}>
                                                                        Agustus</option>
                                                                    <option value="September" {{ $items->bulan ==
                                                                        'September' ? 'selected' : '' }}>
                                                                        September</option>
                                                                    <option value="Oktober" {{ $items->bulan ==
                                                                        'Oktober' ? 'selected' : '' }}>
                                                                        Oktober</option>
                                                                    <option value="November" {{ $items->bulan ==
                                                                        'November' ? 'selected' : '' }}>
                                                                        November</option>
                                                                    <option value="Desember" {{ $items->bulan ==
                                                                        'Desember' ? 'selected' : '' }}>
                                                                        Desember</option>
                                                                </select>
                                                            </div>
                                                            <div
                                                                class="input-group input-group-outline my-3 {{ $items->tahun ? 'is-filled' : '' }}">
                                                                <label class="form-label">Tahun (YYYY)</label>
                                                                <input type="varchar" class="form-control" name="tahun"
                                                                    onfocus="focused(this)" value="{{ $items->tahun }}"
                                                                    onfocusout="defocused(this)">
                                                            </div>
                                                            <div
                                                                class="input-group input-group-outline my-3 {{ $items->nominal ? 'is-filled' : '' }}">
                                                                <label class="form-label">Nominal</label>
                                                                <input type="varchar" class="form-control"
                                                                    name="nominal" onfocus="focused(this)"
                                                                    value="{{ $items->nominal }}"
                                                                    onfocusout="defocused(this)">
                                                            </div>
                                                            <div class="input-group input-group-outline my-3">
                                                                <select class="form-control" name="status"
                                                                    id="exampleFormControlSelect1">
                                                                    <option value="Dibayarkan" {{ $items->status ==
                                                                        'Dibayarkan' ? 'selected' : '' }}>
                                                                        Dibayarkan</option>
                                                                    <option value="Belum Dibayarkan" {{ $items->status
                                                                        == 'Belum Dibayarkan' ? 'selected' : '' }}>
                                                                        Belum Dibayarkan</option>
                                                                </select>
                                                            </div>
                                                            <div class="text-center">
                                                                <button type="submit" id="btn-proses"
                                                                    class="btn btn-round bg-gradient-info btn-lg w-100 mt-4 mb-0">Update</button>
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
                {{-- Modal Add Gaji --}}
                <div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modal-form"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                        <div class="modal-content">
                            <div class="modal-body p-0">
                                <div class="card card-plain">
                                    <div class="card-header pb-0 text-left">
                                        <h5 class="">Tambah Gaji</h5>
                                    </div>
                                    <div class="card-body">
                                        <form role="form text-left" action="{{ route('gaji.store') }}" method="POST">
                                            @csrf
                                            <div class="input-group input-group-outline my-3">
                                                <select class="form-control" name="pegawai"
                                                    id="exampleFormControlSelect1">
                                                    <option selected disabled>Nama Pegawai</option>
                                                    @foreach ($pegawai as $items)
                                                    <option value="{{ $items->id }}">{{ $items->nama }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="input-group input-group-outline my-3">
                                                <select class="form-control" name="bulan"
                                                    id="exampleFormControlSelect1">
                                                    <option selected disabled>Bulan</option>
                                                    <option value="Januari">
                                                        Januari</option>
                                                    <option value="Februari">
                                                        Februari</option>
                                                    <option value="Maret">
                                                        Maret</option>
                                                    <option value="April">
                                                        April</option>
                                                    <option value="Mei">
                                                        Mei</option>
                                                    <option value="Juni">
                                                        Juni</option>
                                                    <option value="July">
                                                        July</option>
                                                    <option value="Agustus">
                                                        Agustus</option>
                                                    <option value="September">
                                                        September</option>
                                                    <option value="Oktober">
                                                        Oktober</option>
                                                    <option value="November">
                                                        November</option>
                                                    <option value="Desember">
                                                        Desember</option>
                                                </select>
                                            </div>
                                            <div class="input-group input-group-outline my-3 ">
                                                <label class="form-label">Tahun (YYYY)</label>
                                                <input type="varchar" class="form-control" name="tahun"
                                                    onfocus="focused(this)" onfocusout="defocused(this)">
                                            </div>
                                            <div class="input-group input-group-outline my-3 ">
                                                <label class="form-label">Nominal</label>
                                                <input type="varchar" class="form-control" name="nominal"
                                                    onfocus="focused(this)" onfocusout="defocused(this)">
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
