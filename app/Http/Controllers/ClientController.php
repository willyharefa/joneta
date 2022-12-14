<?php

namespace App\Http\Controllers;

use App\Models\Kamar;
use App\Models\Payment;
use App\Models\RoomActive;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "Dashboard Saya";
        $payments = Payment::where('user_id', Auth::user()->id)
                    ->where('type_order', 'DP')
                    ->get();
        return view('pages.client.index', compact('title', 'payments'));
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

    public function monthly()
    {
        $title = "Pembayaran Kosan";
        $rooms = RoomActive::where('user_id', Auth::user()->id)->get();
        $payments = Payment::where('user_id', Auth::user()->id)
                            ->where('type_order', 'Lunas')
                            ->orderBy('status', 'DESC')
                            ->get();
        return view('pages.client.monthly', compact('title', 'rooms', 'payments'));
    }

    public function responseRoomActive($id)
    {
        $priceRoom = Kamar::where('id',$id)->first();
        return response()->json($priceRoom);
    }
}
