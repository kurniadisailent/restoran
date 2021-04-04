<?php

namespace App\Http\Controllers\Admin\ManajemenAccount;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\support\Facades\DB;
use App\Admin;
use Auth;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = DB::table('tbl_admin')
                ->where('tbl_admin.nama_admin','like',"%{$request->keyword}%")
                ->orWhere('tbl_admin.username','like',"%{$request->keyword}%")
                ->orWhere('tbl_admin.email','like',"%{$request->keyword}%")
                ->paginate(10);
        return view('admin.admin.index',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.admin.create');
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
            'username'=>'unique:tbl_admin,username',
            'email'=>'email',
        ]);

        Admin::create([
            'nama_admin'=>$request->nama_admin,
            'username'=>$request->username,
            'email'=>$request->email,
            'password'=>bcrypt($request->password),
        ]);
        return redirect()->route('adminaccount.index')->with('store','Berhasil Data tersimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $adminaccount)
    {
        return view('admin.admin.edit',['data'=>$adminaccount]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Admin $adminaccount)
    {
        if($request->username == $adminaccount->username)
        {
            $request->validate([
                'email'=>'email',
            ]);
            if($request->password == NULL)
            {
                $query = [
                    'nama_admin'=>$request->nama_admin,
                    'username'=>$request->username,
                    'email'=>$request->email,
                ];
            }else
            {
                $query = [
                    'nama_admin'=>$request->nama_admin,
                    'username'=>$request->username,
                    'email'=>$request->email,
                    'password'=>bcrypt($request->password)
                ];
            }
            $adminaccount->update($query);
            return redirect()->route('adminaccount.index')->with('store','Berhasil Data tersimpan');
        }else{
            $request->validate([
                'username'=>'unique:tbl_admin,username',
                'email'=>'email',
            ]);
            if($request->password == NULL)
            {
                $query = [
                    'nama_admin'=>$request->nama_admin,
                    'username'=>$request->username,
                    'email'=>$request->email,
                ];
            }else
            {
                $query = [
                    'nama_admin'=>$request->nama_admin,
                    'username'=>$request->username,
                    'email'=>$request->email,
                    'password'=>bcrypt($request->password)
                ];
            }
            $adminaccount->update($query);
            return redirect()->route('adminaccount.index')->with('store','Berhasil Data tersimpan');
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $adminaccount)
    {
        $adminaccount->delete();
        return redirect()->route('adminaccount.index')->with('destroy','Berhasil Data tersimpan');
    }
}