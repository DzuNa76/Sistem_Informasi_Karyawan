<?php

namespace App\Http\Controllers;

use App\Models\Jenis_izin;
use App\Models\Pegawai;
use App\Models\PengajuanIzin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class PengajuanIzinController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pengajuanIzin = PengajuanIzin::all();
        $jenisIzin = Jenis_izin::all();
        $pegawai = Pegawai::all();

        $title = 'Delete Data!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);

        $data = [
            'pengajuanIzin' => $pengajuanIzin,
            'jenisIzin' => $jenisIzin,
            'pegawai' => $pegawai
        ];

        return view('pages.pengajuan_izin.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pegawai' => 'required',
            'tgl_pengajuan' => 'required|date',
            'jenisIzin' => 'required',
            'status' => 'required'
        ]);
        // jika validasi terdapat bernilai false maka dikembalikan ke halaman user dan menampilkan alert toast
        if ($validator->fails()) {
            $msg = $validator->messages()->all();
            Alert::toast($msg, 'error');
            return back();
        }

        $data = new PengajuanIzin([
            'pegawai_id' => $request->pegawai,
            'tgl_pengajuan' => $request->tgl_pengajuan,
            'jenisIzin_id' => $request->jenisIzin,
            'status' => $request->status,
        ]);

        $data->save();

        // alert succes ketika menambahkan data berhasil
        Alert::success('Success!', 'Pengajuan Izin Created Successfully');

        return redirect()->route('pengajuan_izin.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'tgl_pengajuan' => 'required|date',
            'jenisIzin' => 'required',
            'status' => 'required'
        ]);
        // jika validasi terdapat bernilai false maka dikembalikan ke halaman user dan menampilkan alert toast
        if ($validator->fails()) {
            $msg = $validator->messages()->all();
            Alert::toast($msg, 'error');
            return back();
        }

        PengajuanIzin::find($id)->update([
            'tgl_pengajuan' => $request->tgl_pengajuan,
            'jenisIzin_id' => $request->jenisIzin,
            'status' => $request->status,
        ]);

        Alert::toast('Updated Successfully', 'success');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        PengajuanIzin::find($id)->delete();
        Alert::toast('Delete Successfully', 'success');
        return redirect()->back();
    }
}
