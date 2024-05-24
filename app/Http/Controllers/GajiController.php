<?php

namespace App\Http\Controllers;

use App\Models\Gaji;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Barryvdh\DomPDF\Facade\Pdf;

class GajiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $gaji = Gaji::all();
        $pegawai = Pegawai::all();

        // digunakan untuk confirm delete data
        $title = 'Delete Data!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);

        $data = [
            'gaji' => $gaji,
            'pegawai' => $pegawai
        ];

        return view('pages.gaji.index', $data);
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
            'tahun' => 'required|numeric',
            'nominal' => 'required|numeric',
        ]);
        // jika validasi terdapat bernilai false maka dikembalikan ke halaman user dan menampilkan alert toast
        if ($validator->fails()) {
            $msg = $validator->messages()->all();
            Alert::toast($msg, 'error');
            return back();
        }

        $data = new Gaji([
            'pegawai_id' => $request->pegawai,
            'bulan' => $request->bulan,
            'tahun' => $request->tahun,
            'nominal' => $request->nominal,
            'status' => "Belum Dibayarkan"
        ]);

        $data->save();

        // alert succes ketika menambahkan data berhasil
        Alert::success('Success!', 'Gaji Created Successfully');

        return redirect()->route('gaji.index');
    }

    // function untuk cetak data gaji pada pdf menggunakan DomPDF
    public function cetak()
    {
        $gaji = Gaji::all();
        $date = date('d-m-Y');

        $data = [
            'gaji' => $gaji,
            'date' => $date
        ];
        $pdf = Pdf::loadView('pages.gaji.cetak', $data);
        return $pdf->download('invoice.pdf');
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
            'nominal' => 'required|numeric',
            'status' => 'required',
        ]);
        // jika validasi terdapat bernilai false maka dikembalikan ke halaman user dan menampilkan alert toast
        if ($validator->fails()) {
            $msg = $validator->messages()->all();
            Alert::toast($msg, 'error');
            return back();
        }

        $gaji = Gaji::findOrFail($id)->first();
        $gaji->bulan = $request->bulan;
        $gaji->tahun = $request->tahun;
        $gaji->nominal = $request->nominal;
        $gaji->tgl_diterima = $request->status == 'Dibayarkan' ? date('Y-m-d') : '';
        $gaji->status = $request->status;

        $gaji->update();

        Alert::toast('Updated Successfully', 'success');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Gaji::find($id)->delete();

        Alert::toast('Deleted Successfully', 'success');
        return redirect()->back();
    }
}
