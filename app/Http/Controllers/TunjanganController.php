<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\Tunjangan;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class TunjanganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $tunjangan = Tunjangan::all();
        $pegawai = Pegawai::all();

        // digunakan untuk confirm delete data
        $title = 'Delete Data!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);

        $data = [
            'tunjangan' => $tunjangan,
            'pegawai' => $pegawai
        ];

        return view('pages.tunjangan.index', $data);
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
            'bulan' => 'required',
            'nama_tunjangan' => 'required',
            'tahun' => 'required|numeric',
            'nominal' => 'required|numeric',
        ]);
        // jika validasi terdapat bernilai false maka dikembalikan ke halaman user dan menampilkan alert toast
        if ($validator->fails()) {
            $msg = $validator->messages()->all();
            Alert::toast($msg, 'error');
            return back();
        }

        $data = new Tunjangan([
            'pegawai_id' => $request->pegawai,
            'bulan' => $request->bulan,
            'tahun' => $request->tahun,
            'nama_tunjangan' => $request->nama_tunjangan,
            'nominal' => $request->nominal,
            'status' => "Belum Dibayarkan"
        ]);

        $data->save();

        // alert succes ketika menambahkan data berhasil
        Alert::success('Success!', 'Tunjangan Created Successfully');

        return redirect()->route('tunjangan.index');
    }

    // function untuk cetak data gaji pada pdf menggunakan DomPDF
    public function cetak()
    {
        $tunjangan = Tunjangan::all();
        $date = date('d-m-Y');

        $data = [
            'tunjangan' => $tunjangan,
            'date' => $date
        ];
        $pdf = Pdf::loadView('pages.tunjangan.cetak', $data);
        return $pdf->download('tunjangan.pdf');
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
            'bulan' => 'required',
            'tahun' => 'required|numeric',
            'nama_tunjangan' => 'required',
            'nominal' => 'required|numeric',
            'status' => 'required',
        ]);
        // jika validasi terdapat bernilai false maka dikembalikan ke halaman user dan menampilkan alert toast
        if ($validator->fails()) {
            $msg = $validator->messages()->all();
            Alert::toast($msg, 'error');
            return back();
        }

        $Tunjangan = Tunjangan::findOrFail($id)->first();
        $Tunjangan->bulan = $request->bulan;
        $Tunjangan->tahun = $request->tahun;
        $Tunjangan->nama_tunjangan = $request->nama_tunjangan;
        $Tunjangan->nominal = $request->nominal;
        $Tunjangan->tgl_diterima = $request->status == 'Dibayarkan' ? date('Y-m-d') : '';
        $Tunjangan->status = $request->status;

        $Tunjangan->update();

        Alert::toast('Updated Successfully', 'success');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Tunjangan::find($id)->delete();

        Alert::toast('Deleted Successfully', 'success');
        return redirect()->back();
    }
}
