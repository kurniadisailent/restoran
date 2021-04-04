<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Menu;
use Image;

class AdminMenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = DB::table('tbl_menu')
                ->where('tbl_menu.nama_menu','like',"%{$request->keyword}%")
                ->orWhere('tbl_menu.nama_kategori','like',"%{$request->keyword}%")
                ->orWhere('tbl_menu.harga','like',"%{$request->keyword}%")
                ->orWhere('tbl_menu.status','like',"%{$request->keyword}%")
                ->orWhere('tbl_menu.deskripsi','like',"%{$request->keyword}%")
                ->orderBy('tbl_menu.id_menu')
                ->paginate(5);
        return view('admin.menu.index',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.menu.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //lokasi file foto di simpan
        $lokasi_file = public_path('/assets/menus');

        //Validasi Status
        if($request->stok <= 0)
        {
            $status = 'Habis';
        }elseif($request->stok > 0){
            $status = 'Tersedia';
        }
        
        if(!empty($request->file_gambar_menu))
        {
        //Resize Gambar menu
        $gambar_menu = $request->file('file_gambar_menu');
        $nama_gambar_menu = 'gambar_menu_'. time() . '.' . $gambar_menu->getClientOriginalExtension();
        $resize_gambar_menu = Image::make($gambar_menu->getRealPath());
        $resize_gambar_menu->resize(150, 150)->save($lokasi_file . '/' . $nama_gambar_menu);
        //End resize Gambar menu
            
        
        Menu::create([
            'file_gambar_menu'=>$nama_gambar_menu,
            'nama_menu'=>$request->nama_menu,
            'nama_kategori'=>$request->kategori_menu,
            'deskripsi'=>$request->deskripsi_menu,
            'harga'=>$request->harga_menu,
            'diskon'=>$request->diskon_menu,
            'stok'=>$request->stok,
            'status'=>$status
        ]);
        }else{
            Menu::create([
                'file_gambar_menu'=>'noimage.png',
                'nama_menu'=>$request->nama_menu,
                'nama_kategori'=>$request->kategori_menu,
                'deskripsi'=>$request->deskripsi_menu,
                'harga'=>$request->harga_menu,
                'diskon'=>$request->diskon_menu,
                'stok'=>$request->stok,
                'status'=>$status
            ]); 
        }

        return redirect()->route('menu.index')->with('store','Berhasil disimpan!');
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
    public function edit(menu $menu)
    {
        return view('admin.menu.edit',['data'=>$menu]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, menu $menu)
    {
        //lokasi file foto di simpan
        $lokasi_file = public_path('/assets/menus');

        //Validasi Status
        if($request->stok <= 0)
        {
            $status = 'Habis';
        }else{
            $status = 'Tersedia';
        }

        if(!empty($request->file_gambar_menu))
        {
        //Resize Gambar menu
        $gambar_menu = $request->file('file_gambar_menu');
        $nama_gambar_menu = 'gambar_menu_'. time() . '.' . $gambar_menu->getClientOriginalExtension();
        $resize_gambar_menu = Image::make($gambar_menu->getRealPath());
        $resize_gambar_menu->resize(150, 150)->save($lokasi_file . '/' . $nama_gambar_menu);
        //End resize Gambar menu
        
        $query = [
            'file_gambar_menu'=>$nama_gambar_menu,
            'nama_menu'=>$request->nama_menu,
            'nama_kategori'=>$request->kategori_menu,
            'deskripsi'=>$request->deskripsi_menu,
            'harga'=>$request->harga_menu,
            'stok'=>$request->stok,
            'diskon'=>$request->diskon_menu,
            'status'=>$status
        ];

        }else{
            $query = [
                'nama_menu'=>$request->nama_menu,
                'nama_kategori'=>$request->kategori_menu,
                'deskripsi'=>$request->deskripsi_menu,
                'harga'=>$request->harga_menu,
                'stok'=>$request->stok,
                'diskon'=>$request->diskon_menu,
                'status'=>$status
            ]; 
        }
        $menu->update($query);
        return redirect()->route('menu.index')->with('store','Berhasil Di Update!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(menu $menu)
    {
        $menu->delete();
        return redirect()->route('menu.index')->with('destroy','Berhasil dihapus!');
    }

    public function UpdateStatus(Request $request, menu $menu)
    {
        $total_stok = Menu::select('stok')->where('id_menu','=',$menu->id_menu)->pluck('stok')->first();
        $aritmatika_tambah = $total_stok + 10;
        if ($total_stok <= 10)
        {
            $status = 'Habis';
            $aritmatika_kurang = 0;  
        }else{
            $status = 'Tersedia';
            $aritmatika_kurang = $total_stok - 10;
        }
        if($request->status == 'add')
        {
            $menu->update([
                'status'=>'Tersedia',
                'stok'=> $aritmatika_tambah
                ]);
            return redirect()->route('menu.index');
        }elseif($request->status == 'dec'){
            $menu->update([
                'status'=>$status,
                'stok'=> $aritmatika_kurang
                ]);
            return redirect()->route('menu.index');
        }elseif($request->status == 'Habis'){
            $menu->update([
                'status'=>'Habis',
                'stok'=> 0
                ]);
            return redirect()->route('menu.index');
        }
        return redirect()->route('menu.index');
        // return dd($total_stok);
    }

    // public function statusTersedia(Request $request)
    // {
    //     $id_menu=$request->id_menu;
    //     $model = new YourModel();
    //     //assumed your column is "approved" and approved status is "0"
    //     $updated = $model->find($id_menu)->update(['status'=>'Tersedia']);
    //     return redirect()->route('menu.index');
    // }
    
    // public function statusHabis(menu $menu)
    // {
    //     $query = ['status'=>'Habis'];
    //     $menu->update($query);
    //     return redirect()->route('menu.index');
    // }
}