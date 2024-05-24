<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //mengambil semua data pegawai
        $data = Pegawai::all();

        // digunakan untuk confirm delete data
        $title = 'Delete Data!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);

        return view('pages.pegawai.pegawai', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.pegawai.addPegawai');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required',
            'jabatan' => 'required',
            'nama' => 'required',
            'email' => 'required|unique:pegawais|max:255',
            'alamat' => 'nullable',
            'jk' => 'nullable',
            'ttl' => 'nullable|date',
            'no_telp' => 'nullable'
        ]);
        // jika validasi terdapat bernilai false maka dikembalikan ke halaman user dan menampilkan alert toast
        if ($validator->fails()) {
            $msg = $validator->messages()->all();
            Alert::toast($msg, 'error');
            return back();
        }
        // proses menambahkan data baru ke table user
        $user = new User([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => $request->jabatan
        ]);
        $user->save();

        // proses menambagkan data baru ke table pegawai
        $savePegawai = new Pegawai([
            'user_id' => $user->id,
            'nama' => $request->nama,
            'jk' => $request->jk,
            'ttl' => $request->ttl,
            'alamat' => $request->alamat,
            'no_telp' => $request->no_telp,
            'email' => $request->email,
            'jabatan' => $request->jabatan
        ]);

        $savePegawai->save();
        // alert succes ketika menambahkan data berhasil
        Alert::success('Success!', 'Pegawai Created Successfully');
        // kembali ke halaman pegawai
        return redirect()->route('pegawai.index');
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
        //Mengambil data pegawai berdasarkan $id
        $data = Pegawai::find($id)->first();

        return view('pages.pegawai.editPegawai', ['data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'email' => 'required',
            'alamat' => 'nullable',
            'jk' => 'nullable',
            'ttl' => 'nullable|date',
            'no_telp' => 'nullable',
            'jabatan' => 'nullable'
        ]);
        // jika validasi terdapat bernilai false maka dikembalikan ke halaman user dan menampilkan alert toast
        if ($validator->fails()) {
            $msg = $validator->messages()->all();
            Alert::toast($msg, 'error');
            return back();
        }
        // proses update data Role user jika jabatan diubah
        User::find($request->user_id)->update([
            'role' => $request->jabatan
        ]);

        Pegawai::find($request->id)->update([
            'nama' => $request->nama,
            'email' => $request->email,
            'alamat' => $request->alamat,
            'jk' => $request->jk,
            'ttl' => $request->ttl,
            'no_telp' => $request->no_telp,
            'jabatan' => $request->jabatan,
        ]);

        // alert succes ketika update data berhasil
        Alert::toast('Updated Successfully', 'success');
        // kembali ke halaman user
        return redirect()->route('pegawai.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // proses delete data
        Pegawai::find($id)->delete();
        User::where('id', $id)->delete();
        alert()->success('Success!', 'Post Deleted Successfully');
        return redirect()->route('user.index')->with('message', 'Berhasil Dihapus');
    }
}
