<?php

namespace App\Http\Controllers\Admin\ManajemenAccount;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\support\Facades\DB;
use Illuminate\Support\Str;
use App\Pelanggan;
Use Carbon\Carbon;

class PelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = DB::table('tbl_pelanggan')
            ->where('tbl_pelanggan.nama_pelanggan','like',"%{$request->keyword}%")
            ->orWhere('tbl_pelanggan.username','like',"%{$request->keyword}%")
            ->paginate(10);
        return view('admin.pelanggan.index',['data'=>$data]);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pelanggan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $qrPassword = $request->username.Carbon::today()->format('y-m-d').str_random(40);
        $request->validate([
            'email'=>'email|unique:tbl_pelanggan,email',
            'username'=>'unique:tbl_pelanggan,username'
            ]);
        Pelanggan::create([
            'nama_pelanggan'=>$request->nama_pelanggan,
            'username'=>$request->username,
            'email'=>$request->email,
            'password'=>bcrypt($request->password),
            'QRpassword'=>$qrPassword
        ]);
        return redirect()->route('pelangganaccount.index')->with('store','Data Berhasil di simpan !');
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
    public function edit(Pelanggan $pelangganaccount)
    {
        return view('admin.pelanggan.edit',['data'=>$pelangganaccount]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pelanggan $pelangganaccount)
    {
        if($request->username == $pelangganaccount->username)
        {
            $request->validate([
                'email'=>'email',
            ]);
            if($request->password == NULL)
            {
                $query = [
                    'nama_pelanggan'=>$request->nama_pelanggan,
                    'username'=>$request->username,
                    'email'=>$request->email,
                ];
            }else
            {
                $query = [
                    'nama_pelanggan'=>$request->nama_pelanggan,
                    'username'=>$request->username,
                    'email'=>$request->email,
                    'password'=>bcrypt($request->password)
                ];
            }
            $pelangganaccount->update($query);
            return redirect()->route('pelangganaccount.index')->with('store','Berhasil Data tersimpan');
        }else{
            $request->validate([
                'username'=>'unique:tbl_pelanggan,username',
                'email'=>'email',
            ]);
            if($request->password == NULL)
            {
                $query = [
                    'nama_pelanggan'=>$request->nama_pelanggan,
                    'username'=>$request->username,
                    'email'=>$request->email,
                ];
            }else
            {
                $query = [
                    'nama_pelanggan'=>$request->nama_pelanggan,
                    'username'=>$request->username,
                    'email'=>$request->email,
                    'password'=>bcrypt($request->password)
                ];
            }
            $pelangganaccount->update($query);
            return redirect()->route('pelangganaccount.index')->with('store','Berhasil Data tersimpan');
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pelanggan $pelangganaccount)
    {
        $pelangganaccount->delete();
        return redirect()->route('pelangganaccount.index')->with('destroy','Data telah di hapus');
    }
}