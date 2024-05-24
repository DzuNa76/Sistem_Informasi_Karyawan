@extends('welcome')
@section('content')
    {{-- include vendor sweetAlert --}}
    @include('sweetalert::alert')
    <div class="container-fluid py-4">
        <h2>Management Pendidikan</h2>
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3 ">
                            <div class="row align-items-center">
                                <div class="col-sm">
                                    <h6 class="text-white text-capitalize ps-3">
                                        Pendidikan table
                                    </h6>
                                </div>
                                <div class="col-sm  d-flex align-items-center justify-content-end mx-3">
                                    <a href="{{ route('pendidikan.create') }}" type="button"
                                        class="btn btn-info">Tambah</a>
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
                                            Tingkat Pendidikan
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Institusi
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Jurusan
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Tahun
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- Foreach data user untuk ditampilkan --}}
                                    @foreach ($data as $items)
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
                                                    {{ $items->tingkat_pendidikan }}
                                                </p>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">
                                                    {{ $items->institusi }}
                                                </p>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">
                                                    {{ $items->jurusan }}
                                                </p>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">
                                                    {{ $items->tahun }}
                                                </p>
                                            </td>
                                            <td class="align-middle text-center">
                                                <a href="{{ route('pendidikan.edit', ['id' => $items->id]) }}"
                                                    class="text-secondary font-weight-bold text-md" data-toggle="tooltip"
                                                    data-original-title="Edit update" data-bs-toggle="modal"
                                                    data-bs-target="#update-modal{{ $items->id }}">
                                                   <i class="fa-solid fa-pen-to-square"></i>
                                                </a>
                                                <a href="{{ route('pendidikan.destroy', ['id' => $items->id]) }}"
                                                    class="text-secondary font-weight-bold text-md" data-toggle="tooltip"
                                                    data-original-title="Delete pendidikan" data-confirm-delete="true">
                                                    <i class="fa-solid fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        {{-- Modal Update Data Pendidikan --}}
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
                                                                    action="{{ route('pendidikan.update', ['id' => $items->id]) }}"
                                                                    method="POST">
                                                                    @method('PUT')
                                                                    @csrf
                                                                    <div class="input-group input-group-outline my-3">
                                                                        <select class="form-control"
                                                                            name="tingkat_pendidikan"
                                                                            id="exampleFormControlSelect1">
                                                                            <option selected
                                                                                value="{{ $items->tingkat_pendidikan }}">
                                                                                {{ $items->tingkat_pendidikan }}</option>
                                                                            <option value="SMP">SMP</option>
                                                                            <option value="SMK">SMK</option>
                                                                            <option value="S1">S1</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="input-group input-group-outline my-3 {{ $items->institusi ? 'is-filled' : '' }}">
                                                                        <label class="form-label">Institusi</label>
                                                                        <input type="text" class="form-control"
                                                                            name="institusi" onfocus="focused(this)"
                                                                            value="{{ $items->institusi }}"
                                                                            onfocusout="defocused(this)">
                                                                    </div>
                                                                    <div class="input-group input-group-outline my-3 {{ $items->jurusan ? 'is-filled' : '' }}">
                                                                        <label class="form-label">Jurusan</label>
                                                                        <input type="text" class="form-control"
                                                                            name="jurusan" onfocus="focused(this)"
                                                                            value="{{ $items->jurusan }}"
                                                                            onfocusout="defocused(this)">
                                                                    </div>
                                                                    <div class="input-group input-group-outline my-3 {{ $items->tahun ? 'is-filled' : '' }}">
                                                                        <label class="form-label">Tahun</label>
                                                                        <input type="text" class="form-control"
                                                                            name="tahun" onfocus="focused(this)"
                                                                            value="{{ $items->tahun }}"
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
        </div>
    </div>
@endsection
