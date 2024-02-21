<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pembayaran = Pembayaran::with('siswa')
            ->select('siswa_id', \DB::raw('MAX(id) as id'), \DB::raw('MAX(tgl_bayar) as tgl_bayar_last'), \DB::raw('SUM(jumlah_bayar) as total_bayar'))
            ->groupBy('siswa_id')
            ->orderByDesc('tgl_bayar_last')
            ->paginate(5);

        return view('pembayaran.index', compact('pembayaran'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = siswa::all();
        return view('pembayaran.create',compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

            $this->validate($request,[
                'siswa_id'=>'required',
                'tgl_bayar'=>'required',
                'jumlah_bayar'=>'required',
            ]);
            pembayaran::create([
                'siswa_id'=>$request->siswa_id,
                'tgl_bayar'=>$request->tgl_bayar,
                'jumlah_bayar'=>$request->jumlah_bayar,
            ]);
            return redirect()->route('pembayaran.index')->with(['success'=>'Data Berhasil Disimpan!']);

    }
    public function history($siswa_id)
    {
        $pembayaran = Pembayaran::where('siswa_id', $siswa_id)->paginate(5);
        return view('pembayaran.history', compact('pembayaran'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit(Pembayaran $pembayaran)
    {
        $data= Siswa::all();
        $bayar = pembayaran::all();
        return view('pembayaran.edit', compact('pembayaran', 'data', 'bayar'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, pembayaran $pembayaran)
    {
        $this->validate($request, [

            'siswa_id'     => 'required',
            'tgl_bayar'   => 'required',
            'jumlah_bayar'   => 'required'
        ]);
        $pembayaran->update([
            'siswa_id' => $request->siswa_id,
            'tgl_bayar' => $request->tgl_bayar,
            'jumlah_bayar' => $request->jumlah_bayar,
        ]);

        return redirect()->route('pembayaran.index')->with(['success' => 'Data Berhasil di Ubah']);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(pembayaran $pembayaran)
       {

            //delete post
            $pembayaran->delete();

            //redirect to index
            return redirect()->route('pembayaran.index')->with(['success' => 'Data Berhasil Dihapus!']);
        }

}
