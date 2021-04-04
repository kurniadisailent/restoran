<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Meja;

class AdminMejaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = DB::table('tbl_meja')
                ->where('tbl_meja.no_meja','like',"%{$request->keyword}%")
                ->orWhere('tbl_meja.keterangan','like',"%{$request->keyword}%")
                ->orderBy('tbl_meja.no_meja')
                ->paginate(10);
        return view('admin.meja.index',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.meja.create');
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
            'no_meja'=>'unique:tbl_meja,no_meja',
        ]);

        Meja::create([
            'no_meja'=>$request->no_meja,
            'keterangan'=>$request->keterangan,
            'status'=>$request->status
        ]);
        return redirect()->route('meja.index')->with('store','Berhasil disimpan!');
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
    public function edit(Meja $meja)
    {
        return view('admin.meja.edit',['data'=>$meja]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Meja $meja)
    {
        if($request->no_meja == $meja->no_meja)
        {
            $meja->update([
                'no_meja'=>$request->no_meja,
                'keterangan'=>$request->keterangan,
                'status'=>$request->status
                ]);
            return redirect()->route('meja.index')->with('store','Data Berhasil di ubah !');

        }else{
            $request->validate([
                'no_meja'=>'unique:tbl_meja,no_meja'
            ]);

            $meja->update([
                'no_meja'=>$request->no_meja,
                'keterangan'=>$request->keterangan,
                'status'=>$request->status
                ]);
            return redirect()->route('meja.index')->with('store','Data Berhasil di ubah !');
        }
        

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Meja $meja)
    {
        $meja->delete();
        return redirect()->route('meja.index')->with('destroy',' Berhasil dihapus!');
    }
}