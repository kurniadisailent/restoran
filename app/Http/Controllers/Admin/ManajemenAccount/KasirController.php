<?php

namespace App\Http\Controllers\Admin\ManajemenAccount;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\support\Facades\DB;
use App\Kasir;
use Image;

class KasirController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = DB::table('tbl_kasir')
            ->where('tbl_kasir.nama_kasir','like',"%{$request->keyword}%")
            ->orWhere('tbl_kasir.username','like',"%{$request->keyword}%")
            ->orWhere('tbl_kasir.status','like',"%{$request->keyword}%")
            ->paginate(10);
        return view('admin.kasir.index',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.kasir.create');
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
           'username'=>'unique:tbl_kasir,username',
       ]);

       //lokasi file foto di simpan
       $lokasi_file = public_path('/assets/foto_kasir');
        
       if(!empty($request->file_foto_kasir))
       {
       //Resize foto kasir
       $foto_kasir = $request->file('file_foto_kasir');
       //rewrite nama kasir
       $nama_kasir = preg_replace('/\s+/', '', $request->nama_kasir);
       //end rewrite nama kasir
       $nama_foto_kasir = $nama_kasir . time() . '.' . $foto_kasir->getClientOriginalExtension();
       $resize_foto_kasir = Image::make($foto_kasir->getRealPath());
       $resize_foto_kasir->resize(150, 150)->save($lokasi_file . '/' . $nama_foto_kasir);
       //End resize foto kasir
       
       kasir::create([
           'file_foto_kasir'=>$nama_foto_kasir,
           'nama_kasir'=>$request->nama_kasir,
           'jenis_kelamin'=>$request->jenis_kelamin,
           'alamat'=>$request->alamat,
           'no_hp'=>$request->no_hp,
           'email'=>$request->email,
           'username'=>$request->username,
           'password'=>bcrypt($request->password),
           'status'=>$request->status,
       ]);
       }else{
           kasir::create([
            'nama_kasir'=>$request->nama_kasir,
            'jenis_kelamin'=>$request->jenis_kelamin,
            'alamat'=>$request->alamat,
            'no_hp'=>$request->no_hp,
            'username'=>$request->username,
            'password'=>$request->password,
            'status'=>$request->status,
           ]); 
       }

       return redirect()->route('kasiraccount.index')->with('store','Berhasil disimpan!');
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
    public function edit(kasir $kasiraccount)
    {
        return view('admin.kasir.edit',['data'=>$kasiraccount]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, kasir $kasiraccount)
    {
       //lokasi file foto di simpan
       $lokasi_file = public_path('/assets/foto_kasir');
        
       if(!empty($request->file_foto_kasir))
       {
        //Resize foto kasir
        $foto_kasir = $request->file('file_foto_kasir');
        //rewrite nama kasir
        $nama_kasir = preg_replace('/\s+/', '', $request->nama_kasir);
        //end rewrite nama kasir
        $nama_foto_kasir = $nama_kasir . time() . '.' . $foto_kasir->getClientOriginalExtension();
        $resize_foto_kasir = Image::make($foto_kasir->getRealPath());
        $resize_foto_kasir->resize(150, 150)->save($lokasi_file . '/' . $nama_foto_kasir);
        //End resize foto kasir
            if($request->username == $adminaccount->username)
            {
                $request->validate([
                    'email'=>'email',
                ]);
                if($request->password == NULL)
                {
                    $query = [
                        'file_foto_kasir'=>$nama_foto_kasir,
                        'nama_kasir'=>$request->nama_kasir,
                        'jenis_kelamin'=>$request->jenis_kelamin,
                        'alamat'=>$request->alamat,
                        'no_hp'=>$request->no_hp,
                        'email'=>$request->email,
                        'username'=>$request->username,
                        'status'=>$request->status,
                    ];
                }else{
                    $query = [
                        'file_foto_kasir'=>$nama_foto_kasir,
                        'nama_kasir'=>$request->nama_kasir,
                        'jenis_kelamin'=>$request->jenis_kelamin,
                        'alamat'=>$request->alamat,
                        'no_hp'=>$request->no_hp,
                        'email'=>$request->email,
                        'username'=>$request->username,
                        'password'=>bcrypt($request->password),
                        'status'=>$request->status,
                    ];
                }
                $kasiraccount->update($query);
                return redirect()->route('kasiraccount.index')->with('store','Berhasil Data tersimpan');
            }else{
                $request->validate([
                    'username'=>'unique:tbl_kasir,username',
                    'email'=>'email',
                ]);
                if($request->password == NULL)
                {
                    $query = [
                        'file_foto_kasir'=>$nama_foto_kasir,
                        'nama_kasir'=>$request->nama_kasir,
                        'jenis_kelamin'=>$request->jenis_kelamin,
                        'alamat'=>$request->alamat,
                        'no_hp'=>$request->no_hp,
                        'email'=>$request->email,
                        'username'=>$request->username,
                        'status'=>$request->status,
                    ];
                }else
                {
                    $query = [
                        'file_foto_kasir'=>$nama_foto_kasir,
                        'nama_kasir'=>$request->nama_kasir,
                        'jenis_kelamin'=>$request->jenis_kelamin,
                        'alamat'=>$request->alamat,
                        'no_hp'=>$request->no_hp,
                        'email'=>$request->email,
                        'username'=>$request->username,
                        'password'=>bcrypt($request->password),
                        'status'=>$request->status,
                    ];
                }
                $kasiraccount->update($query);
                return redirect()->route('kasiraccount.index')->with('store','Berhasil Data tersimpan');
            }
       }else{
        if($request->username == $kasiraccount->username)
        {
            $request->validate([
                'email'=>'email',
            ]);
            if($request->password == NULL)
            {
                $query = [
                    'nama_kasir'=>$request->nama_kasir,
                    'jenis_kelamin'=>$request->jenis_kelamin,
                    'alamat'=>$request->alamat,
                    'no_hp'=>$request->no_hp,
                    'email'=>$request->email,
                    'username'=>$request->username,
                    'status'=>$request->status,
                ];
            }else
            {
                $query = [
                    'nama_kasir'=>$request->nama_kasir,
                    'jenis_kelamin'=>$request->jenis_kelamin,
                    'alamat'=>$request->alamat,
                    'no_hp'=>$request->no_hp,
                    'email'=>$request->email,
                    'username'=>$request->username,
                    'password'=>bcrypt($request->password),
                    'status'=>$request->status,
                ];
            }
            $kasiraccount->update($query);
            return redirect()->route('kasiraccount.index')->with('store','Berhasil Data tersimpan');
        }else{
            $request->validate([
                'username'=>'unique:tbl_kasir,username',
                'email'=>'email',
            ]);
            if($request->password == NULL)
            {
                $query = [
                    'nama_kasir'=>$request->nama_kasir,
                    'jenis_kelamin'=>$request->jenis_kelamin,
                    'alamat'=>$request->alamat,
                    'no_hp'=>$request->no_hp,
                    'email'=>$request->email,
                    'username'=>$request->username,
                    'status'=>$request->status,
                ];
            }else
            {
                $query = [
                    'nama_kasir'=>$request->nama_kasir,
                    'jenis_kelamin'=>$request->jenis_kelamin,
                    'alamat'=>$request->alamat,
                    'no_hp'=>$request->no_hp,
                    'email'=>$request->email,
                    'username'=>$request->username,
                    'password'=>bcrypt($request->password),
                    'status'=>$request->status,
                ];
            }
            $kasiraccount->update($query);
            return redirect()->route('kasiraccount.index')->with('store','Berhasil Data tersimpan');
        }
       }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(kasir $kasiraccount)
    {
        $kasiraccount->delete();
        return redirect()->route('kasiraccount.index')->with('destroy','Berhasil Data tersimpan');
    }

    public function UpdateStatus(Request $request, kasir $kasiraccount)
    {
        if($request->status == 'Aktif')
        {
            $kasiraccount->update(['status'=>'Aktif']);
            return redirect()->route('kasiraccount.index');
        }else{
            $kasiraccount->update(['status'=>'Non-Aktif']);
            return redirect()->route('kasiraccount.index');
        }
        return redirect()->route('kasiraccount.index');
    }
}