<?php

namespace App\Http\Controllers;

use App\Models\EvaluasiKerja;
use App\Models\Pegawai;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class EvaluasiKerjaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $evaluasi = EvaluasiKerja::all();
        $pegawai = Pegawai::all();

        $title = 'Delete Data!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);

        $data = [
            'evaluasi' => $evaluasi,
            'pegawai' => $pegawai,
        ];
        return view('pages.evaluasiKerja.index', $data);
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
            'tgl_evaluasi' => 'required|date',
            'nama_reviewer' => 'required',
            'nilai_kinerja' => 'required|numeric',
            'comments' => 'nullable'
        ]);
        // jika validasi terdapat bernilai false maka dikembalikan ke halaman user dan menampilkan alert toast
        if ($validator->fails()) {
            $msg = $validator->messages()->all();
            Alert::toast($msg, 'error');
            return back();
        }

        $data = new EvaluasiKerja([
            'pegawai_id' => $request->pegawai,
            'tgl_evaluasi' => $request->tgl_evaluasi,
            'nama_reviewer' => $request->nama_reviewer,
            'nilai_kinerja' => $request->nilai_kinerja,
            'comments' => $request->comments,
        ]);

        $data->save();

        // alert succes ketika menambahkan data berhasil
        Alert::success('Success!', 'Evaluasi Kerja Created Successfully');

        return redirect()->route('evalusasiKerja.index');
    }

    // function untuk cetak data gaji pada pdf menggunakan DomPDF
    public function cetak()
    {
        $evaluasiKerja = EvaluasiKerja::all();
        $date = date('d-m-Y');

        $data = [
            'evaluasiKerja' => $evaluasiKerja,
            'date' => $date
        ];
        $pdf = Pdf::loadView('pages.evaluasiKerja.cetak', $data);
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
            'pegawai' => 'required',
            'tgl_evaluasi' => 'required|date',
            'nama_reviewer' => 'required',
            'nilai_kinerja' => 'required|numeric',
            'comments' => 'nullable'
        ]);
        // jika validasi terdapat bernilai false maka dikembalikan ke halaman user dan menampilkan alert toast
        if ($validator->fails()) {
            $msg = $validator->messages()->all();
            Alert::toast($msg, 'error');
            return back();
        }

        EvaluasiKerja::find($id)->update([
            'pegawai_id' => $request->pegawai,
            'tgl_evaluasi' => $request->tgl_evaluasi,
            'nama_reviewer' => $request->nama_reviewer,
            'nilai_kinerja' => $request->nilai_kinerja,
            'comments' => $request->comments,
        ]);

        Alert::toast('Updated Successfully', 'success');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        EvaluasiKerja::find($id)->delete();
        Alert::toast('Delete Successfully', 'success');
        return redirect()->back();
    }
}
