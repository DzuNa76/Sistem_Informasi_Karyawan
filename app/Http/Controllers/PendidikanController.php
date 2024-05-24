<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\Pendidikan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class PendidikanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //mengambil semua data pegawai

        $data = Pendidikan::all();

        // digunakan untuk confirm delete data
        $title = 'Delete Data!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);

        return view('pages.pendidikan.pendidikan', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // mengambil data pegawai untuk ditampilkan pada input select pegawai
        $pegawai = Pegawai::all();
        return view('pages.pendidikan.add', ['pegawai' => $pegawai]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pegawai' => 'required',
            'tingkat_pendidikan.*' => 'required',
            'institusi.*' => 'required',
            'jurusan.*' => 'nullable',
            'tahun.*' => 'required|numeric',
        ]);
        // jika validasi terdapat bernilai false maka dikembalikan ke halaman user dan menampilkan alert toast
        if ($validator->fails()) {
            $msg = $validator->messages()->all();
            Alert::toast($msg, 'error');
            return back();
        }
        foreach ($request->tingkat_pendidikan as $index => $tingkat_pendidikan) {
            $newData = new Pendidikan([
                'pegawai_id' => $request->pegawai,
                'tingkat_pendidikan' => $tingkat_pendidikan,
                'institusi' => $request->institusi[$index],
                'jurusan' => $request->jurusan[$index],
                'tahun' => $request->tahun[$index],
            ]);
            $newData->save();
        }

        // alert succes ketika menambahkan data berhasil
        Alert::success('Success!', 'Pendidikan Created Successfully');

        return redirect()->route('pendidikan.index');
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
            'tingkat_pendidikan' => 'required',
            'institusi' => 'required',
            'jurusan' => 'nullable',
            'tahun' => 'required|numeric',
        ]);
        // jika validasi terdapat bernilai false maka dikembalikan ke halaman pendidikan dan menampilkan alert toast
        if ($validator->fails()) {
            $msg = $validator->messages()->all();
            Alert::toast($msg, 'error');
            return back();
        }

        // proses update data pendidikan berdasarkan id
        Pendidikan::find($id)->update([
            'tingkat_pendidikan' => $request->tingkat_pendidikan,
            'institusi' => $request->institusi,
            'jurusan' => $request->jurusan,
            'tahun' => $request->tahun,
        ]);

        // alert succes ketika update data berhasil
        Alert::toast('Updated Successfully', 'success');
        // kembali ke halaman pendidikan
        return redirect()->route('pendidikan.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Pendidikan::find($id)->delete();
        Alert::toast('Delete Successfully', 'success');
        // kembali ke halaman pendidikan
        return redirect()->route('pendidikan.index');
    }
}
