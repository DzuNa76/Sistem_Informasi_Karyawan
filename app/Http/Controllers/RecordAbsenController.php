<?php

namespace App\Http\Controllers;

use App\Models\RecordAbsensi;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class RecordAbsenController extends Controller
{
    public function store(Request $request)
    {

        //proses tambah data absensi baru
        RecordAbsensi::create([
            'absensi_id' => $request->absensi_id,
            'pegawai_id' => $request->pegawai,
            'status' => $request->status,
        ]);

        // alert succes ketika menambahkan data berhasil
        Alert::success('Success!', 'Absensi Created Successfully');
        // kembali ke halaman absensi
        return redirect()->back();
    }

    public function update(Request $request, $id)
    {

        //proses tambah data absensi baru
        RecordAbsensi::find($id)->update([
            'status' => $request->status,
        ]);

        Alert::toast('Updated Successfully', 'success');
        return redirect()->back();
    }
}
