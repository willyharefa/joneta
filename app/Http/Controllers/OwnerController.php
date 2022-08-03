<?php

namespace App\Http\Controllers;

use App\Models\Kamar;
use App\Models\Owner;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class OwnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "Dashboard Owner";
        $payments = Payment::where('owner_id', Auth::user()->id)->latest()
                    // ->where('status', 'On Reviewed')
                    ->get();
        return view('pages.owner.index', compact('title', 'payments'));
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
     * @param  \App\Models\Owner  $owner
     * @return \Illuminate\Http\Response
     */
    public function show(Owner $owner)
    {
        $title = "Pengaturan Akun";
        return view('pages.owner.settings', compact('title', 'owner'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Owner  $owner
     * @return \Illuminate\Http\Response
     */
    public function edit(Owner $owner)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Owner  $owner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Owner $owner)
    {
        $validated = Validator::make($request->all(),[
            'image' => 'image|mimes:jpeg,png,jpg|max:128',
        ],
        [
            'image.image' => 'Hanya bisa upload file gambar',
            'image.mimes' => 'Hanya upload file berekstensi .JPEG, .PNG, .JPG.',
            'image.max' => 'Size file gambar maks. 128KB. Silahkan kompress gambar anda terlebih dahulu.'
        ]);

        if($validated->fails()) {
            return redirect()->back()->withErrors($validated)->withInput();
        }

        if(!$request->file('image') == null || $request->file('image')) {
            if($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            Owner::find($owner->id)->update([
                'name' => $request->name,
                'gender' => $request->gender,
                'birthday' => $request->birthday,
                'address' => $request->address,
                'phone' => $request->phone,
                'username' => $request->username,
                'description' => $request->description,
                'image' => $request->file('image')->store('profile'),
            ]);
            return redirect()->back()->with("success", "Berhasil memperbaharui biodata anda.");
        } 
        // }
        else {
            Owner::find($owner->id)->update([
                'name' => $request->name,
                'gender' => $request->gender,
                'birthday' => $request->birthday,
                'address' => $request->address,
                'phone' => $request->phone,
                'username' => $request->username,
                'description' => $request->description,
            ]);
            return redirect()->back()->with("success", "Berhasil memperbaharui biodata anda.");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Owner  $owner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Owner $owner)
    {
        //
    }
    public function reportPayment()
    {
        $title = "Laporan Pembayaran Kosan";
        $payments = Payment::where('owner_id', Auth::user()->id)
                    ->where('type_order', 'Lunas')
                    ->where('status', 'Confirmed')
                    ->get();
        return view('pages.owner.report.payment', compact('title', 'payments'));
    }
    public function reportRoom()
    {
        $title = "Laporan Data Kamar";
        $rooms = Kamar::where('owner_id', Auth::user()->id)
                    ->get();
        return view('pages.owner.report.room', compact('title', 'rooms'));
    }
}
