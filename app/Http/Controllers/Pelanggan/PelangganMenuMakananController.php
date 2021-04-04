<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Menu;

class PelangganMenuMakananController extends Controller
{
    public function index(Request $request)
    {
        $condition = 1;
        $result = Menu::where('nama_menu', 'like', "%{$request->keyword}%")
            ->where('nama_kategori', '=', 'Makanan')
            ->paginate(6);
        return view('pelanggan.makanan.index', ['data' => $result, 'condition' => $condition,]);
    }
}
