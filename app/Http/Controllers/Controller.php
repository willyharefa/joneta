<?php

namespace App\Http\Controllers;

use App\Models\Kosan;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index()
    {
        $title = "Go-Kost - Selamat datang di laman E-Kost";
        return view('welcome', compact('title'));
    }
    public function daftarKos()
    {
        $title = "Daftar Kosan";
        $kosans = Kosan::all();
        return view('pages.daftar-kos', compact('title', 'kosans'));
    }
}
