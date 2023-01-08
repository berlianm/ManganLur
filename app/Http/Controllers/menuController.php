<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class menuController extends Controller
{
    public function menu($id)
    {
        $menu = DB::table('menus')->join('restorans', 'menus.restoran_id', '=', 'restorans.id')->join('jenis_menu','menus.jenis_menu_id', '=','jenis_menu.id')->where('menus.restoran_id','=',$id)->select('menus.*','jenis_menu.nama')->get();
        return view('content.menu.menuRestoran', [
            'menu' => $menu,
            'id' => $id
        ]);
    }
    public function tambahGambar(Request $request, $id)
    {
        $request->validate([
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $imageName = time().'.'.$request->gambar->extension();
        $request->gambar->move(public_path('images/menu/'), $imageName);
        DB::table('gambar_menu')->insert([
            'menu_id' => $id,
            'gambar' => $imageName,
        ]);
        return redirect()->back()->with([
            'status' => 'success',
            'message' => '1 Gambar berhasil ditambahkan'
        ]);
    }
    public function tjenisMenu(Request $request)
    {
        $request->validate([
            'nama' => 'required',
        ]);
        DB::table('jenis_menu')->insert([
            'nama' => $request->nama,
            'keterangan' => $request->nama ,
        ]);
        return redirect()->back()->with([
            'status' => 'success',
            'message' => '1 Jenis Menu berhasil ditambahkan'
        ]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'menu' => 'required',
            'deskripsi' => 'required',
            'harga' => 'required',
            'jenis_menu' => 'required',
            'restoran_id' => 'required',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = time().'.'.$request->gambar->extension();
        $request->gambar->move(public_path('images/menu/'), $imageName);
        Menu::create([
            'nama_menu' => $request->menu,
            'keterangan' => $request->deskripsi,
            'harga' => $request->harga,
            'jenis_menu_id' => $request->jenis_menu,
            'restoran_id' => $request->restoran_id,
            'gambar' => $imageName,
        ]);
        return redirect()->back()->with([
            'status' => 'success',
            'message' => '1 Menu berhasil ditambahkan'
        ]);
    }

    public function edit($id,$idR)
    {
        
        $menu = Menu::find($id);
        return view('content.menu.editMenu', [
            'menu' => $menu,
            'idR' => $idR
        ]);
    }

    public function update(Request $request , $id)
    {
        $request->validate([
            'menu' => 'required',
            'keterangan' => 'required',
            'harga' => 'required',
            'jenis_menu' => 'required',
            'restoran_id' => 'required',
            'gambar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $menu = Menu::find($id);
        if ($request->hasFile('gambar')) {
            $imageName = time().'.'.$request->gambar->extension();
            $request->gambar->move(public_path('images/menu/'), $imageName);
            $menu->gambar = $imageName;
        }
        $menu->nama_menu = $request->menu;
        $menu->keterangan = $request->keterangan;
        $menu->harga = $request->harga;
        $menu->jenis_menu_id = $request->jenis_menu;
        $menu->restoran_id = $request->restoran_id;
        $menu->save();
        return redirect()->back()->with([
            'status' => 'success',
            'message' => '1 Menu berhasil diubah'
        ]);
    }

    public function destroy($id)
    {
        $file = Menu::findOrFail($id);
        $file_path = public_path('images/menu/' . $file->gambar);
        File::delete($file_path);
        $file->delete();

        return redirect()->back()->with([
            'status' => 'success',
            'message' => '1 Menu berhasil dihapus'
        ]);
    }
    
    public function deleteJenisMenu($id)
    {
        DB::table('jenis_menu')->where('id', '=', $id)->delete();
        return redirect()->back()->with([
            'status' => 'success',
            'message' => '1 Jenis Menu berhasil dihapus'
        ]);
    }

    public function detail($id, $idR)
    {
        
        $menu = Menu::find($id);
        return view('content.menu.detailMenu', [
            'menu' => $menu,
            'idR' => $idR
        ]);
    }

    public function reviewMenu(Request $request , $id)
    {
        $request->validate([
            'review' => 'required',
            
        ]);
        DB::table('review_menu')->insert([
            'menu_id' => $id,
            'review' => $request->review,
            'user_id' => $request->user_id,
        ]);
        return redirect()->back()->with([
            'status' => 'success',
            'message' => '1 Review berhasil ditambahkan'
        ]);
    }
    public function reviewResto(Request $request , $id)
    {
        $request->validate([
            'review' => 'required',
            
        ]);
        DB::table('review_resto')->insert([
            'restoran_id' => $id,
            'review' => $request->review,
            'user_id' => $request->user_id,
        ]);
        return redirect()->back()->with([
            'status' => 'success',
            'message' => '1 Review berhasil ditambahkan'
        ]);
    }
    
    public function editGambar($id,$idM)
    {
        $gambar = DB::table('gambar_menu')->where('id', '=', $id)->first();
        return view('content.menu.editGambar', [
            'gambar' => $gambar,
            'idM' => $idM
        ]);
    }
    
    public function updateGambar( Request $request, $id)
    {
        $request->validate([
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $gambar = DB::table('gambar_menu')->where('id', '=', $id)->first();
        if ($request->hasFile('gambar')) {
            $imageName = time().'.'.$request->gambar->extension();
            $request->gambar->move(public_path('images/menu/'), $imageName);
            $gambar->gambar = $imageName;
        }
        DB::table('gambar_menu')->where('id', '=', $id)->update([
            'gambar' => $gambar->gambar,
        ]);
        return redirect()->back()->with([
            'status' => 'success',
            'message' => '1 Gambar berhasil diubah'
        ]);
    }
    public function destroyGambar($id)
    {
        $file = DB::table('gambar_menu')->where('id', '=', $id)->first();
        $file_path = public_path('images/menu/' . $file->gambar);
        File::delete($file_path);
        DB::table('gambar_menu')->where('id', '=', $id)->delete();
        return redirect()->back()->with([
            'status' => 'success',
            'message' => '1 Gambar berhasil dihapus'
        ]);
    }

    public function tambahRating(Request $request, $id)
    {
        $request->validate([
            'rating' => 'required',
        ]);
        
        DB::table('rating')->insert([
            'restoran_id' => $id,
            'rating' => $request->rating,
            'user_id' => $request->user_id,
        ]);
        return redirect()->back()->with([
            'status' => 'success',
            'message' => '1 Rating berhasil ditambahkan'
        ]);
    }
}
