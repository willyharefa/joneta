<?php

namespace App\Http\Controllers;

use App\Models\Kamar;
use App\Models\Payment;
use App\Models\RoomActive;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PaymentController extends Controller
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
        // dd($request);
        $validated = Validator::make($request->all(), [
            'kamar_id' => 'required',
            'owner_id' => 'required',
            'kosan_id' => 'required',
            'order_date' => 'required',
            'pay_amount' => 'required',
            'type_order' => 'required',
            'payment_receipt' => 'required|image|mimes:jpeg,jpg,png|max:256',
        ],
        [ 
            'pay_amount.required' => 'Jumlah biaya anda kosong',
            'payment_receipt.max' => 'Size gambar upload anda maks. 256KB. Demi kelancaran sistem, silahkan compress ukuran gambar anda. Terimakasih',
            'payment_receipt.image' => 'Anda hanya di izinkan mengupload file jenis gambar.',
            'payment_receipt.mimes' => 'Hanya dapat menerima ektensi file .JPEG, .PNG, .JPG.'
        ]);

        if($validated->fails()) {
            return redirect()->back()->withErrors($validated)->withInput();
        }

        Payment::create([
            'owner_id' => $request->owner_id,
            'kosan_id' => $request->kosan_id,
            'kamar_id' => $request->kamar_id,
            'user_id' => Auth::user()->id,
            'date_pay' => $request->order_date,
            'price_room' => $request->price_room,
            'pay_amount' => $request->pay_amount,
            'leftover' => $request->leftover,
            'change' => $request->change,
            'type_order' => $request->type_order,
            'image' => $request->file('payment_receipt')->store('payment'),
            'status' => 'On Reviewed',
        ]);

        RoomActive::create([
            'owner_id' => $request->owner_id,
            'kosan_id' => $request->kosan_id,
            'kamar_id' => $request->kamar_id,
            'user_id' => Auth::user()->id,
            'status' => 'Active',
            'date_in' => $request->order_date,
        ]);
        Kamar::find($request->kamar_id)->increment('room_filled', 1);
        Kamar::find($request->kamar_id)->decrement('room_available', 1);
        return redirect()->back()->with("success", "Pemesan kos anda berhasil dilakukan, ");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payment $payment)
    {
        // dd($request);
        if($request->reupload) {
            $validated = Validator::make($request->all(), [
                'new_image' => 'image|mimes:jpeg,png,jpg|max:256',
            ],
            [
                'new_image.image' => 'Hanya menerima file gambar.',
                'new_image.mimes' => 'File upload harus berekstensi .JPEG, .PNG, .JPG',
                'new_image.max' => 'Ukuran file upload gambar maks. 256KB, silahkan kompress gambar anda.',
            ]);
            if($validated->fails()) {
                return redirect()->back()->withErrors($validated)->withInput();
            }
            if($request->file('new_image')) {
                if($request->oldImagePayment) {
                    Storage::delete($request->oldImagePayment);
                }
            }
            Payment::find($payment->id)->update([
                'status' => 'On Reviewed',
                'change' => $request->new_change,
                'date_pay' => $request->new_paydate,
                'pay_amount' => $request->new_pay_amount,
                'leftover' => $request->new_leftover,
            ]);
            return redirect()->back()->with("success", "Pembayaran berhasil diupload, mohon menunggu proses konfirmasi oleh owner.");
        }
        else {        
            if($request->status === "Confirmed") {
                Payment::find($payment->id)->update([
                    'status' => $request->status,
                ]);
                return redirect()->back();
            } 

            if($request->status === "Rejected") {
                Payment::find($payment->id)->update([
                    'status' => $request->status,
                ]);
                return redirect()->back();
            }

            $validated = Validator::make($request->all(), [
                'payment_receipt' => 'required|image|mimes:jpeg,png,jpg|max:256',
            ],
            [
                'payment_receipt.required' => 'Bukti pembayaran anda masih kosong.',
                'payment_receipt.image' => 'Hanya menerima file gambar.',
                'payment_receipt.mimes' => 'File upload harus berekstensi .JPEG, .PNG, .JPG',
                'payment_receipt.max' => 'Ukuran file upload gambar maks. 256KB, silahkan kompress gambar anda.',
            ]);
            if($validated->fails()) {
                return redirect()->back()->withErrors($validated)->withInput();
            }

            if($request->file('payment_receipt')) {
                if($request->oldImage) {
                    Storage::delete($request->oldImage);
                }
            }

            Payment::find($payment->id)->update([
                'status' => 'On Reviewed',
                'type_order' => $request->type_order,
                'change' => $request->change,
                'image' => $request->file('payment_receipt')->store('payment')
            ]);
            Payment::find($payment->id)->increment('pay_amount', $request->pay_amount);
            Payment::find($payment->id)->decrement('leftover', $request->pay_amount);
            return redirect()->back()->with("success", "Pembayaran berhasil diupload, mohon menunggu proses konfirmasi oleh owner.");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment)
    {
        //
    }
}
