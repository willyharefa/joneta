<?php

namespace App\Http\Controllers;

use App\Models\Kamar;
use App\Models\Kosan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KamarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "Data Kamar";
        $kosans = Kosan::all();
        $kamars = Kamar::all();
        return view('pages.owner.kamar', compact('title', 'kosans', 'kamars'));
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
        Kamar::create([
            'owner_id' => Auth::user()->id,
            'kosan_id' => $request->kosan_id,
            'name' => $request->name,
            'total_room' => $request->total_room,
            'room_filled' => $request->room_filled,
            'room_available' => $request->room_available,
            'price' => $request->price,
            'description' => $request->description
        ]);

        return redirect()->back()->with("success", "Selamat kamar baru berhasil ditambahkan.");

        // TUGAS SELANJUTNYA :
        // MENGISI DATA KAMAR, AKTIFITAS SAYA TERAKHIR ADALAH MENAMBAHKAN CEDTOR DAN GIMANA SUPAYA DATA BISA DIINPUT 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kamar  $kamar
     * @return \Illuminate\Http\Response
     */
    public function show(Kamar $kamar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kamar  $kamar
     * @return \Illuminate\Http\Response
     */
    public function edit(Kamar $kamar)
    {
        $title = "Edit data kamar";
        $kosans = Kosan::all();
        return view('pages.owner.edit-kamar', compact('title', 'kamar', 'kosans'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kamar  $kamar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kamar $kamar)
    {
        // dd($request);

        Kamar::find($kamar->id)->update([
            'owner_id' => Auth::user()->id,
            'kosan_id' => $request->kosan_id,
            'name' => $request->new_name,
            'total_room' => $request->new_total_room,
            'room_filled' => $request->new_room_filled,
            'room_available' => $request->new_room_available,
            'price' => $request->new_price,
            'description' => $request->new_description
        ]);
        return redirect()->route('kamar.index')->with("success", "Data kamar $request->new_name berhasil diperbaharui");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kamar  $kamar
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kamar $kamar)
    {
        //
    }
}
