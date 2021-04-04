<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Menu;
use Illuminate\Support\Facades\Auth;


class PelangganHomeController extends Controller
{
    public function index()
    {
        $data = Menu::paginate(6);
        return view('pelanggan.home.index',[
            'data'=>$data,
            ]);
    }
}