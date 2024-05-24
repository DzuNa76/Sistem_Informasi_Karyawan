@extends('welcome')
@section('content')
@include('sweetalert::alert')
<div class="container-fluid py-4">
    <h2>Tambah Pendidikan</h2>
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-body px-0 pb-2 mx-4">
                    <form role="form text-left" action="{{ route('pendidikan.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <div class="input-group input-group-outline my-3">
                                    <select class="form-control" name="pegawai" id="exampleFormControlSelect1">
                                        <option disabled selected>Nama Pegawai</option>
                                        @foreach ($pegawai as $items)
                                            <option value="{{ $items->id }}">{{ $items->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div id="pendidikan-wrapper">
                            <div class="row pendidikan-item">
                                <div class="col-md-4">
                                    <div class="input-group input-group-outline my-3">
                                        <select class="form-control" name="tingkat_pendidikan[]" id="exampleFormControlSelect1">
                                            <option disabled selected>Tingkat Pendidikan</option>
                                            <option value="SMP">SMP</option>
                                            <option value="SMK">SMK</option>
                                            <option value="S1">S1</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group input-group-outline my-3">
                                        <label class="form-label">Institusi</label>
                                        <input type="text" class="form-control" name="institusi[]" onfocus="focused(this)"
                                            onfocusout="defocused(this)">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group input-group-outline my-3">
                                        <label class="form-label">Jurusan</label>
                                        <input type="text" class="form-control" name="jurusan[]" onfocus="focused(this)"
                                            onfocusout="defocused(this)">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group input-group-outline my-3">
                                        <label class="form-label">Tahun</label>
                                        <input type="text" class="form-control" name="tahun[]" onfocus="focused(this)"
                                            onfocusout="defocused(this)">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="input-group input-group-outline my-3">
                                        <button type="button" class="btn btn-danger btn-remove">Hapus</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <button type="button" class="btn btn-primary" id="add-pendidikan">Tambah Pendidikan</button>
                            </div>
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
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('add-pendidikan').addEventListener('click', function () {
            var wrapper = document.getElementById('pendidikan-wrapper');
            var item = document.querySelector('.pendidikan-item');
            var clone = item.cloneNode(true);
            var inputs = clone.querySelectorAll('input');
            inputs.forEach(input => input.value = '');
            var selects = clone.querySelectorAll('select');
            selects.forEach(select => select.value = '');
            wrapper.appendChild(clone);
        });

        document.getElementById('pendidikan-wrapper').addEventListener('click', function (e) {
            if (e.target && e.target.matches('.btn-remove')) {
                var item = e.target.closest('.pendidikan-item');
                item.remove();
            }
        });
    });
</script>
