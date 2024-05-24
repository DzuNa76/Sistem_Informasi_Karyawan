@extends('welcome')
@section('content')
    {{-- include vendor sweetAlert --}}
    @include('sweetalert::alert')
    <div class="container-fluid py-4">
        <h2>Management Pelatihan</h2>
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3 ">
                            <div class="row align-items-center">
                                <div class="col-sm">
                                    <h6 class="text-white text-capitalize ps-3">
                                        Pelatihan table
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
                                            Nama Program
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Type
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Tanggal Mulai
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Tanggal Selesai
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $items)
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">
                                                            {{ $items->nama_pelatihan }}
                                                        </h6>
                                                        <p
                                                                class="text-xs text-secondary mb-0"
                                                            >
                                                                {{ $items->Penyelenggara }}
                                                            </p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">
                                                    {{ $items->type }}
                                                </p>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">
                                                    {{ $items->tgl_mulai }}
                                                </p>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">
                                                    {{ $items->tgl_selesai }}
                                                </p>
                                            </td>
                                            <td class="align-middle text-center">
                                                <a href="#" class="text-secondary font-weight-bold text-md"
                                                    data-toggle="tooltip" data-original-title="Edit update"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#update-modal{{ $items->id }}">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </a>
                                                <a href="{{ route('pelatihan.destroy', ['id' => $items->id]) }}"
                                                    class="text-secondary font-weight-bold text-md" data-toggle="tooltip"
                                                    data-original-title="Delete gaji" data-confirm-delete="true">
                                                    <i class="fa-solid fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        {{-- Modal Update Data Pengajuan izin --}}
                                        <div class="modal fade" id="update-modal{{ $items->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-body p-0">
                                                        <div class="card card-plain">
                                                            <div class="card-header pb-0 text-left">
                                                                <h5 class="">Update</h5>
                                                            </div>
                                                            <div class="card-body">
                                                                <form role="form text-left"
                                                                    action="{{ route('pelatihan.update', ['id' => $items->id]) }}"
                                                                    method="POST">
                                                                    @method('PUT')
                                                                    @csrf
                                                                    <div
                                                                        class="input-group input-group-outline my-3 {{ $items->nama_pelatihan ? 'is-filled' : '' }}">
                                                                        <label class="form-label">Nama Pelatihan</label>
                                                                        <input type="text" class="form-control"
                                                                            name="nama_pelatihan" onfocus="focused(this)"
                                                                            value="{{ $items->nama_pelatihan }}"
                                                                            onfocusout="defocused(this)">
                                                                    </div>
                                                                    <div
                                                                        class="input-group input-group-outline my-3 {{ $items->penyelenggara ? 'is-filled' : '' }}">
                                                                        <label class="form-label">Penyelenggara</label>
                                                                        <input type="text" class="form-control"
                                                                            name="penyelenggara" onfocus="focused(this)"
                                                                            value="{{ $items->penyelenggara }}"
                                                                            onfocusout="defocused(this)">
                                                                    </div>
                                                                    <div class="input-group input-group-outline my-3">
                                                                        <select class="form-control" name="type"
                                                                            id="exampleFormControlSelect1">
                                                                            <option value="Internal"
                                                                                {{ $items->type == 'Internal' ? 'selected' : '' }}>
                                                                                Internal</option>
                                                                            <option value="External"
                                                                                {{ $items->type == 'External' ? 'selected' : '' }}>
                                                                                External</option>
                                                                        </select>
                                                                    </div>
                                                                    <div
                                                                        class="input-group input-group-outline my-3 {{ $items->tgl_mulai ? 'is-filled' : '' }}">
                                                                        <label class="form-label">Tanggal Mulai</label>
                                                                        <input type="date" class="form-control"
                                                                            name="tgl_mulai" onfocus="focused(this)"
                                                                            value="{{ $items->tgl_mulai }}"
                                                                            onfocusout="defocused(this)">
                                                                    </div>
                                                                    <div
                                                                        class="input-group input-group-outline my-3 {{ $items->tgl_selesai ? 'is-filled' : '' }}">
                                                                        <label class="form-label">Tanggal Selesai</label>
                                                                        <input type="date" class="form-control"
                                                                            name="tgl_selesai" onfocus="focused(this)"
                                                                            value="{{ $items->tgl_selesai }}"
                                                                            onfocusout="defocused(this)">
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
                </div>
            </div>
            {{-- Modal Add Pelatihan --}}
            <div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modal-form"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                    <div class="modal-content">
                        <div class="modal-body p-0">
                            <div class="card card-plain">
                                <div class="card-header pb-0 text-left">
                                    <h5 class="">Tambah Pelatihan</h5>
                                </div>
                                <div class="card-body">
                                    <form role="form text-left" action="{{ route('pelatihan.store') }}"
                                        method="POST">
                                        @csrf
                                        <div class="input-group input-group-outline my-3 ">
                                            <label class="form-label">Nama Pelatihan</label>
                                            <input type="text" class="form-control" name="nama_pelatihan"
                                                onfocus="focused(this)" onfocusout="defocused(this)">
                                        </div>
                                        <div class="input-group input-group-outline my-3 ">
                                            <label class="form-label">Penyelenggara</label>
                                            <input type="text" class="form-control" name="penyelenggara"
                                                onfocus="focused(this)" onfocusout="defocused(this)">
                                        </div>
                                        <div class="input-group input-group-outline my-3">
                                            <select class="form-control" name="type" id="exampleFormControlSelect1">
                                                <option selected disabled>Type</option>
                                                <option value="Internal">
                                                    Internal</option>
                                                <option value="External">
                                                    External</option>
                                            </select>
                                        </div>
                                        <div class="input-group input-group-outline my-3 ">
                                            <label class="form-label">Tanggal Mulai</label>
                                            <input type="date" class="form-control" name="tgl_mulai"
                                                onfocus="focused(this)" onfocusout="defocused(this)">
                                        </div>
                                        <div class="input-group input-group-outline my-3 ">
                                            <label class="form-label">Tanggal Selesai</label>
                                            <input type="date" class="form-control" name="tgl_selesai"
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
@endsection
