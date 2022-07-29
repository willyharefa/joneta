<?php

namespace App\Http\Controllers;

use App\Models\GambarKamar;
use App\Models\Kamar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GambarKamarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
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
        $validated = Validator::make($request->all(), [
            'image' => 'required|mimes:jpeg,jpg,png|max:1024',
        ]);

        if($validated->fails()) {
            return redirect()->back()->withErrors($validated)->withInput();
        }

        GambarKamar::create([
            'kamar_id' => $request->kamar_id,
            'image' => $request->file('image')->store('kamar')
        ]);

        return redirect()->back()->with("success", "Selamat Gambar berhasil ditambahkan.");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\GambarKamar  $gambarKamar
     * @return \Illuminate\Http\Response
     */
    public function show(GambarKamar $gambarKamar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\GambarKamar  $gambarKamar
     * @return \Illuminate\Http\Response
     */
    public function edit(GambarKamar $gambarKamar)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\GambarKamar  $gambarKamar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GambarKamar $gambarKamar)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GambarKamar  $gambarKamar
     * @return \Illuminate\Http\Response
     */
    public function destroy(GambarKamar $gambarKamar)
    {
        //
    }

    public function Gambar($id)
    {
        $title = "Data Gambar Kamar";
        $kamar = Kamar::find($id);
        $gambars = GambarKamar::where('kamar_id', $id)->get();
        return view('pages.owner.gambar-kamar', compact('title', 'kamar', 'gambars'));
    }
}
