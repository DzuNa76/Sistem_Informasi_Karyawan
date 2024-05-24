<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // mengambil semua data dari table user
        $data = User::all();

        // digunakan untuk confirm delete data
        $title = 'Delete Data!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);

        return view('pages.user', ['data' => $data]);
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
        // validasi $request
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required',
            'role' => 'required'
        ]);
        // jika validasi terdapat bernilai false maka dikembalikan ke halaman user dan menampilkan alert toast
        if ($validator->fails()) {
            $msg = $validator->messages()->all();
            Alert::toast($msg, 'error');
            return back();
        }
        // proses menambahkan data baru ke database
        $user = new User([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => $request->role
        ]);
        $user->save();
        // alert succes ketika menambahkan data berhasil
        Alert::success('Success!', 'User Created Successfully');
        // kembali ke halaman user
        return redirect()->back();
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
        // validasi $request
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required',
            'role' => 'required'
        ]);
        // jika validasi terdapat bernilai false maka dikembalikan ke halaman user dan menampilkan alert toast
        if ($validator->fails()) {
            $msg = $validator->messages()->all();
            Alert::toast($msg, 'error');
            return back();
        }
        // proses update data
        User::find($request->id)->update([
            'username' => $request->username,
            'password' => hash('sha512', $request->password),
            'role' => $request->role
        ]);

        Alert::toast('Updated Successfully', 'success');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // proses delete data
        Pegawai::where('user_id',$id)->delete();
        User::find($id)->delete();
        alert()->success('Success!', 'User Deleted Successfully');
        return redirect()->route('user.index');
    }
}
