<?php

namespace App\Http\Controllers;

use App\Models\Owner;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "Registrasi akun";
        return view('registration', compact('title'));
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
            'name' => 'required|min:4',
            'address' => 'required|min:8',
            'phone' => 'required|min:11',
            'username' => 'required|unique:users|min:6',
            'password' => 'required|confirmed|min:6',
            'status' => 'required',
        ],
        [
            'name.required' => 'Nama masih kosong',
            'name.min' => 'Nama anda terlalu pendek',
            'address.required' => 'Alamat masih kosong',
            'address.min' => 'Alamat anda terlalu pendek',
            'phone.required' => 'Nomor telepon masih kosong',
            'phone.min' => 'No Telepon minimal 11 digit sesuai negara indonesia (+62)',
            'username.required' => 'Username masih kosong',
            'username.unique' => 'Username anda harus unik',
            'username.min' => 'Username minimal 6 karakter',
            'password.confirmed' => 'Password konfirmasi anda tidak sesuai',
            'password.min' => 'Password minimal 6 digit',
            'status.required' => 'Status anda masih kosong' 
        ]);

        if($validated->fails()) {
            return redirect()->back()->withErrors($validated)->withInput();
        }

        if($request->status == "visitor") {
            User::create([
                'name' => $request->name,
                'birthday' => $request->birthday,
                'address' => $request->address,
                'phone' => $request->phone,
                'username' => $request->username,
                'password' => Hash::make($request->password)
            ]);

            return redirect()->route('login.index')->with("success", "Selamat anda berhasil membuat akun baru.");
        }

        if($request->status == "owner") {
            Owner::create([
                'name' => $request->name,
                'birthday' => $request->birthday,
                'address' => $request->address,
                'phone' => $request->phone,
                'username' => $request->username,
                'password' => Hash::make($request->password)
            ]);

            return redirect()->route('login.index')->with("success", "Selamat anda berhasil membuat akun baru.");
        }
        
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
}
