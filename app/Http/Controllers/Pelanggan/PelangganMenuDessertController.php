<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Menu;

class PelangganMenuDessertController extends Controller
{
    public function index(Request $request)
    {
        $condition = 1;
        $result = Menu::where('nama_menu', 'like', "%{$request->keyword}%")
            ->where('nama_kategori', '=', 'Dessert')
            ->paginate(6);
        return view('pelanggan.dessert.index', ['data' => $result, 'condition' => $condition,]);
    }
}
