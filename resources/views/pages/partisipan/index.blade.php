@extends('welcome')
@section('content')
    {{-- include vendor sweetAlert --}}
    @include('sweetalert::alert')
    <div class="container-fluid py-4">
        <h2>Management Partisipan</h2>
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3 ">
                            <div class="row align-items-center">
                                <div class="col-sm">
                                    <h6 class="text-white text-capitalize ps-3">
                                        Partisipan table
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
                                            Nama Pegawai
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Nama Program
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Tanggal Selesai
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
                                    @foreach ($partisipan as $items)
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
                                                    {{ $items->pelatihans->nama_pelatihan }}
                                                </p>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">
                                                    {{ $items->tgl_selesai }}
                                                </p>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">
                                                    {{ $items->status }}
                                                </p>
                                            </td>
                                            <td class="align-middle text-center">
                                                <a href="#" class="text-secondary font-weight-bold text-md"
                                                    data-toggle="tooltip" data-original-title="Edit update"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#update-modal{{ $items->id }}">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </a>
                                                <a href="{{ route('partisipan.destroy', ['id' => $items->id]) }}"
                                                    class="text-secondary font-weight-bold text-md" data-toggle="tooltip"
                                                    data-original-title="Delete gaji" data-confirm-delete="true">
                                                    <i class="fa-solid fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        {{-- Modal Update Data Partisipan --}}
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
                                                                    action="{{ route('partisipan.update', ['id' => $items->id]) }}"
                                                                    method="POST">
                                                                    @method('PUT')
                                                                    @csrf
                                                                    <div class="input-group input-group-outline my-3">
                                                                        <select class="form-control" name="pegawai"
                                                                            id="exampleFormControlSelect1">
                                                                            @foreach ($pegawai as $pgwi)
                                                                                <option value="{{ $pgwi->id }}"
                                                                                    {{ $items->pegawai_id == $pgwi->id ? 'selected' : '' }}>
                                                                                    {{ $pgwi->nama }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <div class="input-group input-group-outline my-3">
                                                                        <select class="form-control" name="pelatihan"
                                                                            id="exampleFormControlSelect1">
                                                                            @foreach ($pelatihan as $lat)
                                                                                <option value="{{ $lat->id }}"
                                                                                    {{ $items->pelatihan_id == $lat->id ? 'selected' : '' }}>
                                                                                    {{ $lat->nama_pelatihan }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <div
                                                                        class="input-group input-group-outline my-3 {{ $items->tgl_selesai ? 'is-filled' : '' }}">
                                                                        <label class="form-label">Tanggal Selesai</label>
                                                                        <input type="date" class="form-control"
                                                                            name="tgl_selesai" onfocus="focused(this)"
                                                                            value="{{ $items->tgl_selesai }}"
                                                                            onfocusout="defocused(this)">
                                                                    </div>
                                                                    <div class="input-group input-group-outline my-3">
                                                                        <select class="form-control" name="status"
                                                                            id="exampleFormControlSelect1">
                                                                            <option value="ENROLLED"
                                                                                {{ $items->status == 'ENROLLED' ? 'selected' : '' }}>
                                                                                ENROLLED</option>
                                                                            <option value="COMPLETED"
                                                                                {{ $items->status == 'COMPLETED' ? 'selected' : '' }}>
                                                                                COMPLETED</option>
                                                                            <option value="FAILED"
                                                                                {{ $items->status == 'FAILED' ? 'selected' : '' }}>
                                                                                FAILED</option>
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
                </div>
            </div>
            {{-- Modal Add Partisipan --}}
            <div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modal-form"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                    <div class="modal-content">
                        <div class="modal-body p-0">
                            <div class="card card-plain">
                                <div class="card-header pb-0 text-left">
                                    <h5 class="">Tambah Partisipan</h5>
                                </div>
                                <div class="card-body">
                                    <form role="form text-left" action="{{ route('partisipan.store') }}" method="POST">
                                        @csrf
                                        <div class="input-group input-group-outline my-3">
                                            <select class="form-control" name="pegawai" id="exampleFormControlSelect1">
                                                <option selected disabled>Nama Pegawai</option>
                                                @foreach ($pegawai as $items)
                                                    <option value="{{ $items->id }}">
                                                        {{ $items->nama }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="input-group input-group-outline my-3">
                                            <select class="form-control" name="pelatihan" id="exampleFormControlSelect1">
                                                <option selected disabled>Nama Pelatihan</option>
                                                @foreach ($pelatihan as $items)
                                                    <option value="{{ $items->id }}">
                                                        {{ $items->nama_pelatihan }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="input-group input-group-outline my-3 ">
                                            <label class="form-label">Tanggal Selesai</label>
                                            <input type="date" class="form-control" name="tgl_selesai"
                                                onfocus="focused(this)" onfocusout="defocused(this)">
                                        </div>
                                        <div class="input-group input-group-outline my-3">
                                            <select class="form-control" name="status" id="exampleFormControlSelect1">
                                                <option selected disabled>Status</option>
                                                <option value="ENROLLED">
                                                    ENROLLED</option>
                                                <option value="COMPLETED">
                                                    COMPLETED</option>
                                                <option value="FAILED">
                                                    FAILED</option>
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
@endsection
