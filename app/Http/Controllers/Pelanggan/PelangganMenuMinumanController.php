<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Menu;

class PelangganMenuMinumanController extends Controller
{
    public function index(Request $request)
    {
        $condition = 1;
        $result = Menu::where('nama_menu', 'like', "%{$request->keyword}%")
            ->where('nama_kategori', '=', 'Minuman')
            ->paginate(6);
        return view('pelanggan.minuman.index', ['data' => $result, 'condition' => $condition,]);
    }
}