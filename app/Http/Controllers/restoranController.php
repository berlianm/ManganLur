<?php

namespace App\Http\Controllers;

use App\Models\Restoran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class restoranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('content.restoran.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('content.restoran.tambahResto');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'buka' => 'required',
            'tutup' => 'required',
            ]);

        DB::table('restorans')->insert([
            'nama_resto' => $request->nama,
            'alamat' => $request->alamat,
            'jam_buka' => $request->buka,
            'jam_tutup' => $request->tutup,
            'user_id' => Auth::user()->id,
        ]);

        return redirect('/tabel-restoranku')->with([
            'status' => 'success',
            'message' => 'Restoran berhasil ditambahkan'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = DB::table('restorans')->where('id','=',$id)->first();
        // dd($data);
        return view('content.restoran.editResto',[
            'data' => $data
        ]);

        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'buka' => 'required',
            'tutup' => 'required',
            'gambar' => 'mimes:png,jpg',
            ]);

         if ($request->file('gambar') == "") {
            DB::table('restorans')->where('id', '=', $id)->update([
                'nama_resto' => $request->nama,
                'alamat' => $request->alamat,
                'lokasi_map' => $request->map,
                'keterangan' => $request->keterangan,
                'jam_buka' => $request->buka,
                'jam_tutup' => $request->tutup,
                'user_id' => Auth::user()->id,
            ]);
         } else {
            $dokumen = $request->file('gambar');
            $nama_dokumen = time() . "_" . $dokumen->getClientOriginalName();
            $tujuan_upload = 'data_file';
            $dokumen->move($tujuan_upload, $nama_dokumen);

            DB::table('restorans')->where('id', '=', $id)->update([
                'nama_resto' => $request->nama,
                'alamat' => $request->alamat,
                'gambar' => $nama_dokumen,
                'lokasi_map' => $request->map,
                'keterangan' => $request->keterangan,
                'jam_buka' => $request->buka,
                'jam_tutup' => $request->tutup,
                'user_id' => Auth::user()->id,
            ]);
         }

        return redirect('/tabel-restoranku')->with([
            'status' => 'success',
            'message' => 'Restoran berhasil diupdate'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $file = Restoran::findOrFail($id);
        $file_path = public_path('data_file/' . $file->gambar);
        File::delete($file_path);
        $file->delete();
        
        
        return redirect('/tabel-restoranku')->with([
            'status' => 'success',
            'message' => 'Restoran berhasil dihapus'
        ]);
    }

    public function tabelRestoran()
    {
        $data = DB::table('restorans')->join('users','restorans.user_id','=','users.id')->where('users.id','=', Auth::user()->id)->select('restorans.*')->get();
        return view('content.restoran.tabelRestoran',[
            'data' => $data
        ]);
    }
}
