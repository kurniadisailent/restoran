<?php

namespace App\Http\Controllers\Admin\ManajemenAccount;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\support\Facades\DB;
use App\Waiter;
use Image;

class WaiterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = DB::table('tbl_waiter')
            ->where('tbl_waiter.nama_waiter', 'like', "%{$request->keyword}%")
            ->orWhere('tbl_waiter.username', 'like', "%{$request->keyword}%")
            ->orWhere('tbl_waiter.status', 'like', "%{$request->keyword}%")
            ->paginate(10);
        return view('admin.waiter.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.waiter.create');
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
            'username' => 'unique:tbl_waiter,username',
            'email' => 'email',
        ]);

        //lokasi file foto di simpan
        $lokasi_file = public_path('/assets/foto_waiter');

        if (!empty($request->file_foto_waiter)) {
            //Resize foto waiter
            $foto_waiter = $request->file('file_foto_waiter');
            //rewrite nama waiter
            $nama_waiter = preg_replace('/\s+/', '', $request->nama_waiter);
            //end rewrite nama waiter
            $nama_foto_waiter = $nama_waiter . time() . '.' . $foto_waiter->getClientOriginalExtension();
            $resize_foto_waiter = Image::make($foto_waiter->getRealPath());
            $resize_foto_waiter->resize(150, 150)->save($lokasi_file . '/' . $nama_foto_waiter);
            //End resize foto waiter

            waiter::create([
                'file_foto_waiter' => $nama_foto_waiter,
                'nama_waiter' => $request->nama_waiter,
                'jenis_kelamin' => $request->jenis_kelamin,
                'alamat' => $request->alamat,
                'no_hp' => $request->no_hp,
                'email' => $request->email,
                'username' => $request->username,
                'password' => bcrypt($request->password),
                'status' => $request->status,
            ]);
        } else {
            waiter::create([
                'nama_waiter' => $request->nama_waiter,
                'jenis_kelamin' => $request->jenis_kelamin,
                'alamat' => $request->alamat,
                'no_hp' => $request->no_hp,
                'username' => $request->username,
                'password' => $request->password,
                'status' => $request->status,
                'file_foto_waiter'=>'noimage.png'
            ]);
        }

        return redirect()->route('waiteraccount.index')->with('store', 'Berhasil disimpan!');
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
    public function edit(Waiter $waiteraccount)
    {
        return view('admin.waiter.edit', ['data' => $waiteraccount]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Waiter $waiteraccount)
    {
        //lokasi file foto di simpan
        $lokasi_file = public_path('/assets/foto_waiter');

        if (!empty($request->file_foto_waiter)) {
            //Resize foto waiter
            $foto_waiter = $request->file('file_foto_waiter');
            //rewrite nama waiter
            $nama_waiter = preg_replace('/\s+/', '', $request->nama_waiter);
            //end rewrite nama waiter
            $nama_foto_waiter = $nama_waiter . time() . '.' . $foto_waiter->getClientOriginalExtension();
            $resize_foto_waiter = Image::make($foto_waiter->getRealPath());
            $resize_foto_waiter->resize(150, 150)->save($lokasi_file . '/' . $nama_foto_waiter);
            //End resize foto waiter
            if ($request->username == $waiteraccount->username) {
                $request->validate([
                    'email' => 'email',
                ]);
                if ($request->password == NULL) {
                    $query = [
                        'file_foto_waiter' => $nama_foto_waiter,
                        'nama_waiter' => $request->nama_waiter,
                        'jenis_kelamin' => $request->jenis_kelamin,
                        'alamat' => $request->alamat,
                        'no_hp' => $request->no_hp,
                        'email' => $request->email,
                        'username' => $request->username,
                        'status' => $request->status,
                    ];
                } else {
                    $query = [
                        'file_foto_waiter' => $nama_foto_waiter,
                        'nama_waiter' => $request->nama_waiter,
                        'jenis_kelamin' => $request->jenis_kelamin,
                        'alamat' => $request->alamat,
                        'no_hp' => $request->no_hp,
                        'email' => $request->email,
                        'username' => $request->username,
                        'password' => bcrypt($request->password),
                        'status' => $request->status,
                    ];
                }
                $waiteraccount->update($query);
                return redirect()->route('waiteraccount.index')->with('store', 'Berhasil Data tersimpan');
            } else {
                $request->validate([
                    'username' => 'unique:tbl_waiter,username',
                    'email' => 'email',
                ]);
                if ($request->password == NULL) {
                    $query = [
                        'file_foto_waiter' => $nama_foto_waiter,
                        'nama_waiter' => $request->nama_waiter,
                        'jenis_kelamin' => $request->jenis_kelamin,
                        'alamat' => $request->alamat,
                        'no_hp' => $request->no_hp,
                        'email' => $request->email,
                        'username' => $request->username,
                        'status' => $request->status,
                    ];
                } else {
                    $query = [
                        'file_foto_waiter' => $nama_foto_waiter,
                        'nama_waiter' => $request->nama_waiter,
                        'jenis_kelamin' => $request->jenis_kelamin,
                        'alamat' => $request->alamat,
                        'no_hp' => $request->no_hp,
                        'email' => $request->email,
                        'username' => $request->username,
                        'password' => bcrypt($request->password),
                        'status' => $request->status,
                    ];
                }
                $waiteraccount->update($query);
                return redirect()->route('waiteraccount.index')->with('store', 'Berhasil Data tersimpan');
            }
        } else {
            if ($request->username == $waiteraccount->username) {
                $request->validate([
                    'email' => 'email',
                ]);
                if ($request->password == NULL) {
                    $query = [
                        'nama_waiter' => $request->nama_waiter,
                        'jenis_kelamin' => $request->jenis_kelamin,
                        'alamat' => $request->alamat,
                        'no_hp' => $request->no_hp,
                        'email' => $request->email,
                        'username' => $request->username,
                        'status' => $request->status,
                    ];
                } else {
                    $query = [
                        'nama_waiter' => $request->nama_waiter,
                        'jenis_kelamin' => $request->jenis_kelamin,
                        'alamat' => $request->alamat,
                        'no_hp' => $request->no_hp,
                        'email' => $request->email,
                        'username' => $request->username,
                        'password' => bcrypt($request->password),
                        'status' => $request->status,
                    ];
                }
                $waiteraccount->update($query);
                return redirect()->route('waiteraccount.index')->with('store', 'Berhasil Data tersimpan');
            } else {
                $request->validate([
                    'username' => 'unique:tbl_waiter,username',
                    'email' => 'email',
                ]);
                if ($request->password == NULL) {
                    $query = [
                        'nama_waiter' => $request->nama_waiter,
                        'jenis_kelamin' => $request->jenis_kelamin,
                        'alamat' => $request->alamat,
                        'no_hp' => $request->no_hp,
                        'email' => $request->email,
                        'username' => $request->username,
                        'status' => $request->status,
                    ];
                } else {
                    $query = [
                        'nama_waiter' => $request->nama_waiter,
                        'jenis_kelamin' => $request->jenis_kelamin,
                        'alamat' => $request->alamat,
                        'no_hp' => $request->no_hp,
                        'email' => $request->email,
                        'username' => $request->username,
                        'password' => bcrypt($request->password),
                        'status' => $request->status,
                    ];
                }
                $waiteraccount->update($query);
                return redirect()->route('waiteraccount.index')->with('store', 'Berhasil Data tersimpan');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Waiter $waiteraccount)
    {
        $waiteraccount->delete();
        return redirect()->route('waiteraccount.index')->with('destroy', 'Berhasil Data tersimpan');
    }

    public function UpdateStatus(Request $request, Waiter $waiteraccount)
    {
        if ($request->status == 'Aktif') {
            $waiteraccount->update(['status' => 'Aktif']);
            return redirect()->route('waiteraccount.index');
        } else {
            $waiteraccount->update(['status' => 'Non-Aktif']);
            return redirect()->route('waiteraccount.index');
        }
        return redirect()->route('waiteraccount.index');
    }
}