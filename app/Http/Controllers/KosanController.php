<?php

namespace App\Http\Controllers;

use App\Models\Kosan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Console\Input\Input;

class KosanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "Daftar Kosan";
        $kosans = Kosan::all();
        return view('pages.owner.kosan', compact('title', 'kosans'));
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
        // dd($request);
        $validated = Validator::make($request->all(), [
            'image' => 'required|mimes:jpeg,png,jpg|max:1024',
        ],
        [
            'image.max' => 'File gambar maksimal 1 Mb. Silahkan kompress jika file besar.',
        ]);

        if($validated->fails()) {
            return redirect()->back()->withErrors($validated);
        }
        Kosan::create([
            'name' => $request->name,
            'address' => $request->address,
            'range_price' => $request->range_prices,
            'image' => $request->file('image')->store('image'),
            // 'image' => $request->file('image')->store('image', $request->image->getClientOriginalName()),
            'owner_id' => Auth::user()->id,
        ]);

        return redirect()->back()->with("success", "Selamat Kos baru berhasil didaftarkan.");

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kosan  $kosan
     * @return \Illuminate\Http\Response
     */
    public function show(Kosan $kosan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kosan  $kosan
     * @return \Illuminate\Http\Response
     */
    public function edit(Kosan $kosan)
    {
        $title = "Edti Data Kosan";
        $kosan = Kosan::find($kosan->id);
        return view('pages.owner.edit-kosan', compact('title', 'kosan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kosan  $kosan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kosan $kosan)
    {
        // $request->validate([
        //     'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
        // ]);
        $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg|max:1024',
        ],
        [
            'image.image' => 'File harus gambar.',
            'image.mimes' => 'Hanya menerima .JPEG, .PNG, .JPG.',
            'image.max' => 'Size file maksimal 1 MB. Silahkan perkecil kembali.'
        ]);
        // dd($validated);
        $validated = $request->all();

        if($request->file('image')) {
            
            if($request->oldImage) {
                // return 'Ya ada gambarnya';
                Storage::delete($request->oldImage);
            }
            $validated['image'] = $request->file('image')->store('image');
        }
        $kosan->update($validated);
        return redirect()->route('kosan.index')->with("success", "Selamat Kos berhasil diperbaharui.");
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kosan  $kosan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kosan $kosan)
    {
        if($kosan->image) {
            Storage::delete($kosan->image);
        }
        Kosan::destroy($kosan->id);
        return redirect()->back()->with("success", "Data kosan selesai dihapus dari database.");

    }
}
