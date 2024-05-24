<?php

namespace App\Http\Controllers;

use App\Models\Partisipan;
use App\Models\Pegawai;
use App\Models\Pelatihan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class PartisipanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $partisipan = Partisipan::all();
        $pegawai = Pegawai::all();
        $pelatihan = Pelatihan::all();

        $title = 'Delete Data!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);

        $data = [
            'partisipan' => $partisipan,
            'pegawai' => $pegawai,
            'pelatihan' => $pelatihan
        ];
        return view('pages.partisipan.index', $data);
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
            'pelatihan' => 'required',
            'tgl_selesai' => 'required|date',
            'status' => 'required'
        ]);
        // jika validasi terdapat bernilai false maka dikembalikan ke halaman user dan menampilkan alert toast
        if ($validator->fails()) {
            $msg = $validator->messages()->all();
            Alert::toast($msg, 'error');
            return back();
        }

        $data = new Partisipan([
            'pegawai_id' => $request->pegawai,
            'pelatihan_id' => $request->pelatihan,
            'tgl_selesai' => $request->tgl_selesai,
            'status' => $request->status
        ]);

        $data->save();

        // alert succes ketika menambahkan data berhasil
        Alert::success('Success!', 'Partisipan Created Successfully');

        return redirect()->route('partisipan.index');
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
            'pegawai' => 'required',
            'pelatihan' => 'required',
            'tgl_selesai' => 'required|date',
            'status' => 'required'
        ]);
        // jika validasi terdapat bernilai false maka dikembalikan ke halaman user dan menampilkan alert toast
        if ($validator->fails()) {
            $msg = $validator->messages()->all();
            Alert::toast($msg, 'error');
            return back();
        }

        Partisipan::find($id)->update([
            'pegawai_id' => $request->pegawai,
            'pelatihan_id' => $request->pelatihan,
            'tgl_selesai' => $request->tgl_selesai,
            'status' => $request->status
        ]);

        Alert::toast('Updated Successfully', 'success');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Partisipan::find($id)->delete();
        Alert::toast('Delete Successfully', 'success');
        return redirect()->back();
    }
}
