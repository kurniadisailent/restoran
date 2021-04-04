<?php

namespace App\Http\Controllers\Admin\ManajemenAccount;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\support\Facades\DB;
use App\Owner;
use Auth;

class OwnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = DB::table('tbl_owner')
                ->where('tbl_owner.nama_owner','like',"%{$request->keyword}%")
                ->orWhere('tbl_owner.username','like',"%{$request->keyword}%")
                ->orWhere('tbl_owner.email','like',"%{$request->keyword}%")
                ->paginate(10);
        return view('admin.owner.index',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.owner.create');
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
            'username'=>'unique:tbl_owner,username',
            'email'=>'email',
        ]);

        owner::create([
            'nama_owner'=>$request->nama_owner,
            'username'=>$request->username,
            'email'=>$request->email,
            'password'=>bcrypt($request->password),
        ]);
        return redirect()->route('owneraccount.index')->with('store','Berhasil Data tersimpan');
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
    public function edit(owner $owneraccount)
    {
        return view('admin.owner.edit',['data'=>$owneraccount]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, owner $owneraccount)
    {
        if($request->username == $owneraccount->username)
        {
            $request->validate([
                'email'=>'email',
            ]);
            if($request->password == NULL)
            {
                $query = [
                    'nama_owner'=>$request->nama_owner,
                    'username'=>$request->username,
                    'email'=>$request->email,
                ];
            }else
            {
                $query = [
                    'nama_owner'=>$request->nama_owner,
                    'username'=>$request->username,
                    'email'=>$request->email,
                    'password'=>bcrypt($request->password)
                ];
            }
            $owneraccount->update($query);
            return redirect()->route('owneraccount.index')->with('store','Berhasil Data tersimpan');
        }else{
            $request->validate([
                'username'=>'unique:tbl_owner,username',
                'email'=>'email',
            ]);
            if($request->password == NULL)
            {
                $query = [
                    'nama_owner'=>$request->nama_owner,
                    'username'=>$request->username,
                    'email'=>$request->email,
                ];
            }else
            {
                $query = [
                    'nama_owner'=>$request->nama_owner,
                    'username'=>$request->username,
                    'email'=>$request->email,
                    'password'=>bcrypt($request->password)
                ];
            }
            $owneraccount->update($query);
            return redirect()->route('owneraccount.index')->with('store','Berhasil Data tersimpan');
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(owner $owneraccount)
    {
        $owneraccount->delete();
        return redirect()->route('owneraccount.index')->with('destroy','Berhasil Data tersimpan');
    }
}