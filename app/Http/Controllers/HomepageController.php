<?php

namespace App\Http\Controllers;

use App\Models\GambarKamar;
use App\Models\Kamar;
use App\Models\Kosan;
use Illuminate\Http\Request;

class HomepageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function detailKos($id)
    {
        $title = "Detail Kos";
        $kosan = Kosan::find($id);
        $kamars = Kamar::where('kosan_id', $id)->get();
        return view('pages.detail-kos', compact('title', 'kosan', 'kamars'));
    }
    public function detailKamar($id)
    {
        $title = "Detail Kamar";
        $kamar = Kamar::find($id);
        $gambarkos = GambarKamar::where('kamar_id', $id)->get();
        return view('pages.kamar-kos', compact('title', 'kamar', 'gambarkos'));
    }
}
