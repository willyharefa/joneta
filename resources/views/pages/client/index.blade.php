@extends('layouts.dashboard')
@section('content')
    <section class="dashboard-client">
        <h1 class="mt-4">Dashboard Saya</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
        
        {{-- ALERT MESSAGE --}}
        <div class="row g-0">
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-warning my-2">
                    {{ $error }}
                </div>
            
            @endforeach
        @endif
        </div>

        @if ($message = Session::get('success'))
        <div class="row g-0">
            <div class="alert alert-success my-2">
                {{ $message }}
            </div>
        </div>
        @endif

        <div class="row g-0">
                <div class="table-responsive shadow-lg p-4 rounded">
                    <table id="dataTables" class="table align-middle">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Kos</th>
                                <th>Kamar</th>
                                <th>Harga Perkamar</th>
                                <th>Tipe Bayar</th>
                                <th>Sisa Bayar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($payments as $payment)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $payment->kosan->name }}</td>
                                <td>{{ $payment->kamar->name }}</td>
                                <td>@currency($payment->price_room)</td>
                                <td>{{ $payment->type_order }}</td>
                                <td>@currency($payment->leftover)</td>
                                <td>
                                    <!-- Button modal pay leftover -->
                                    <button type="button" class="btn btn-primary" id="btn-pay-leftover" data-bs-toggle="modal" data-bs-target="#payLeftover-{{ $payment->id }}">
                                        Bayar Sisa
                                    </button>
                                    
                                    <!-- Modal pay leftover-->
                                    <form action="{{ route('payment.update', $payment->id) }}" method="post" enctype="multipart/form-data">
                                        @method('PUT')
                                        @csrf
                                        <div class="modal fade" id="payLeftover-{{ $payment->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Data Pembayaan</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <legend class="mb-3">Kamar {{ $payment->kamar->name }}</legend>
                                                        <div class="row mb-3">
                                                            <label for="price_room" class="col-sm-3 col-form-label">Harga Kos</label>
                                                            <div class="col-sm-9">
                                                                <input type="text" class="form-control" id="price_room" value="@currency($payment->price_room)" readonly>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <label for="leftover_display" class="col-sm-3 col-form-label">Sisa Pembayaran</label>
                                                            <div class="col-sm-9">
                                                                <input type="text" class="form-control bx-flashing bg-info fw-bold text-white" id="leftover_display" value="@currency($payment->leftover)" readonly disabled>
                                                                <input type="hidden" id="leftover" value="{{ $payment->leftover }}">
                                                            </div>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <label for="type_order_display" class="col-sm-3 col-form-label">Status Bayar</label>
                                                            <div class="col-sm-9">
                                                                <input type="text" class="form-control" id="type_order" name="type_order_display" value="Lunas" readonly disabled>
                                                                <input type="hidden" class="form-control" name="type_order" value="Lunas" required>
                                                                <div class="alert alert-success mt-3" role="alert">
                                                                    <h4 class="alert-heading">Perhatian!</h4>
                                                                    <p>Kami menetapkan pembayaran anda selanjutnya sebagai status <strong>Pelunasan</strong>, dimana anda hanya dibolehkan menggunakan pembayaran menggunakan DP satu kali saja (pertama kali memesan kosan).</p>
                                                                    <hr>
                                                                    <p class="mb-0">Mohon perhatikan sebelum membayar, anda tidak melebihi sisa pembayaran. Jika terlanjur membayar lebih maka masukan sesuai nominal transfer dan anda mendapatkan kembalian uang.</p>
                                                                </div>
                                                            </div>
                                                        <div class="row mb-3">
                                                            <label for="pay_amount" class="col-sm-3 col-form-label">Nominal Transfer</label>
                                                            <div class="col-sm-9">
                                                                <input type="number" class="form-control" id="pay_amount" name="pay_amount" required>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <label for="change" class="col-sm-3 col-form-label">Kembalian</label>
                                                            <div class="col-sm-9">
                                                                <input type="number" class="form-control" id="change" name="change" required readonly>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <label for="payment_receipt" class="col-sm-3 col-form-label">Bukti Pembayaran</label>
                                                            <div class="col-sm-9">
                                                                <input type="file" class="form-control" id="payment_receipt" name="payment_receipt" required>
                                                                <input type="hidden" name="oldImage" value="{{ $payment->image }}" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary" id="payNow">Bayar Sekarang</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <td colspan="7">
                                <div class="alert alert-info my-2">
                                    Tidak ada aktivitas pembayaran uang muka (DP) saat ini.
                                </div>
                            </td>
                            @endforelse
                        </tbody>
                    </table>
                </div>
        </div>
    </section>
@endsection

@push('script')
    <script>
        const   leftover = document.querySelectorAll('#leftover');
        const   payAmount = document.querySelectorAll('#pay_amount');
        const   btnPayNow = document.querySelectorAll('#payNow');
        const   change = document.querySelectorAll('#change');
        const   form = document.querySelectorAll('form');
        const   btnPayLeftover = document.querySelectorAll('#btn-pay-leftover');
                btnPayLeftover.forEach((btnPay, iBtnPay)=> {
                    btnPayNow[iBtnPay].disabled = true;
                    btnPay.addEventListener('click', () => {
                        payAmount[iBtnPay].addEventListener('input', (e) => {
                            if(!e.target.value == "") {
                                if(leftover[iBtnPay].value > parseInt(e.target.value)) {
                                    let sumPayment = 0;
                                    change[iBtnPay].value = parseInt(sumPayment);
                                } else {
                                    let sumPayment = parseInt(e.target.value) - leftover[iBtnPay].value;
                                    change[iBtnPay].value = parseInt(sumPayment);
                                    btnPayNow[iBtnPay].disabled = false;
                                    btnPayNow[iBtnPay].addEventListener('click', (e) => {
                                        e.preventDefault();
                                        Swal.fire({
                                            title: 'Bayar Sekarang?',
                                            text: "Pastikan bukti pembayaran valid, anda bisa menghubungi owner kos jika ada uang kembalian pada proses pembayaran anda.",
                                            icon: 'info',
                                            showCancelButton: true,
                                            confirmButtonColor: '#3085d6',
                                            cancelButtonColor: '#d33',
                                            confirmButtonText: 'Konfirmasi',
                                            cancelmButtonText: 'Batal',
                                            }).then((willConfirmed) => {
                                            if (willConfirmed.isConfirmed) {
                                                Swal.fire({
                                                    icon: 'success',
                                                    title: 'Pembayaran Berhasil',
                                                    text: 'Pembayaran anda akan ditinjau kembali oleh owner kos, selalu cek dashboard anda.',
                                                    showConfirmButton: false,
                                                    timer: 1500
                                                });
                                                setInterval(() => {
                                                    form[iBtnPay].submit();
                                                }, 1500);
                                            }
                                        })
                                    })
                                }
                            } else {
                                btnPayNow[iBtnPay].disabled = true;
                                let sumPayment = 0;
                                change[iBtnPay].value = parseInt(sumPayment);
                            }
                        })
                    })
                })
    </script>
@endpush