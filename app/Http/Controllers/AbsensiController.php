<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Pegawai;
use App\Models\RecordAbsensi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class AbsensiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // mengambil semua data dari table absensi
        $data = Absensi::all();

        // digunakan untuk confirm delete data
        $title = 'Delete Data!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);

        return view('pages.absensi.index', ['data' => $data]);
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
        //validasi request user
        $validator = Validator::make($request->all(), [
            'tgl_absensi' => 'required|date',
            'durasi' => 'required|date_format:H:i:s',
        ]);
        // jika validasi terdapat bernilai false maka dikembalikan ke halaman absensi dan menampilkan alert toast
        if ($validator->fails()) {
            $msg = $validator->messages()->all();
            Alert::toast($msg, 'error');
            return back();
        }
        //mengatur waktu absensi sesuai durasi yang diinputkan agar absensi otomatis tertutup ketika durasi habis
        $started_at = Carbon::now();
        $durasi = Carbon::parse($request->durasi);
        $closed_at = $started_at->copy()->addMinutes($durasi->minute)->addSeconds($durasi->second);

        //proses tambah data absensi baru
        Absensi::create([
            'tgl_absensi' => $request->tgl_absensi,
            'status' => 'Buka',
            'durasi' => $request->durasi,
            'started_at' => $started_at,
            'closed_at' => $closed_at,
        ]);

        // alert succes ketika menambahkan data berhasil
        Alert::success('Success!', 'Absensi Created Successfully');
        // kembali ke halaman absensi
        return redirect()->back();
    }

    // fungsi untuk mengecek dan update status absensi secara otomatis dengan menggunakan schedule bawaan laravel
    // fungsi ini dijalankan di app/console/kernel.php pada function schedule
    public function checkAndUpdateStatus()
    {
        // ambil waktu saat ini
        $now = Carbon::now();
        // mengambil data absensi dengan status == buka
        $absensis = Absensi::where('status', 'Buka')->get();

        //untuk memeriksa setiap entri absensi yang statusnya masih "Buka" dan  di perbarui statusnya menjadi "Tutup" jika waktu saat ini (current time) sudah melewati atau sama dengan waktu tutup (closed_at) yang ditentukan untuk setiap entri absensi.
        foreach ($absensis as $absensi) {
            if ($now->greaterThanOrEqualTo(Carbon::parse($absensi->closed_at))) {
                $absensi->update(['status' => 'Tutup']);
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $absensi = Absensi::find($id);
        $pegawai = Pegawai::all();
        $record = RecordAbsensi::where('absensi_id', $id)->get();

        $data = [
            'absensi' => $absensi,
            'pegawai' => $pegawai,
            'records' => $record,
        ];
        return view('pages.absensi.show', $data);
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
            'tgl_absensi' => 'required|date',
            'status' => 'required|in:Buka,Tutup',
            'durasi' => 'required|integer|min:1', // Durasi dalam menit
        ]);
        // jika validasi terdapat bernilai false maka dikembalikan ke halaman user dan menampilkan alert toast
        if ($validator->fails()) {
            $msg = $validator->messages()->all();
            Alert::toast($msg, 'error');
            return back();
        }

        $absensi = Absensi::findOrFail($id);

        $absensi->tgl_absensi = $request->tgl_absensi;
        $absensi->status = $request->status;

        // Hitung waktu tutup baru berdasarkan durasi
        $newClosedAt = Carbon::now()->addMinutes($request->durasi);
        $absensi->closed_at = $newClosedAt;

        $absensi->save();

        Alert::toast('Updated Successfully', 'success');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Absensi::find($id)->delete();

        Alert::toast('Delete Successfully', 'success');
        // kembali ke halaman Absensi
        return redirect()->route('absensi.index');
    }
}
