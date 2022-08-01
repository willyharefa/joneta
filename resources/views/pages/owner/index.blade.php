@extends('layouts.dashboard')

@push('style')
    <link rel="stylesheet" href="{{ asset('/css/dashboard.css') }}">
@endpush

@section('content')
    <section class="section-dashboard-owner">
        <h1 class="text-muted">Dashboard Owner</h1>

        <div class="row g-0 gap-3 wrapper-greetings align-items-center justify-content-between">
            <div class="col-12 col-md-6 mb-4 mb-md-0">
                <div id="image-carousel" class="splide" aria-label="Beautiful Images">
                    <div class="splide__track">
                        <ul class="splide__list">
                            <li class="splide__slide">
                                <img src="{{ asset('/icon/hello-welcome.svg') }}" width="100%" height="100%" alt="">
                            </li>
                            <li class="splide__slide">
                                <img src="{{ asset('/icon/hello-welcome-2.svg') }}" width="100%" height="100%" alt="">
                            </li>
                            <li class="splide__slide">
                                <img src="{{ asset('/icon/hello-welcome-3.svg') }}" width="100%" height="100%" alt="">
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-5">
                <h1 class="mb-4">Hai, Owner</h1>
                <p class="text-muted">Selamat datang kembali ya... <br>Informasi seputar lapak kos anda akan selalu kami tampilkan di dashboard utama anda, selalu cek secara berskala ya :)</p>
            </div>
        </div>

        <div class="row g-0 mt-5 wrapper-information align-items-center bg-white p-4">
            <div class="table-responsive">
                <table id="dataTables" class="table align-middle text-nowrap">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Pemesan</th>
                            <th>Jenis Kamar</th>
                            <th>Tanggal</th>
                            <th>Bukti Bayar</th>
                            <th>Tipe Bayar</th>
                            <th>Harga Kamar</th>
                            <th>Sisa Bayar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($payments as $payment)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $payment->user->name }}</td>
                            <td>{{ $payment->kamar->name }}</td>
                            <td>{{ $payment->date_pay }}</td>
                            <td>
                                <img src="{{ asset('storage/' . $payment->image) }}" width="100px" alt="">
                            </td>
                            <td>{{ $payment->type_order }}</td>
                            <td>@currency($payment->price_room)</td>
                            <td>@currency($payment->leftover)</td>
                            @if($payment->status === "On Reviewed")
                            <td>
                                <form action="{{ route('payment.update', $payment->id) }}" method="post" class="d-inline-block">
                                    @method('PUT')
                                    @csrf
                                    <input type="hidden" name="status" value="Confirmed">
                                    <input type="hidden" name="type_order" value="{{ $payment->type_order }}">
                                    <button type="submit" class="btn btn-success btn-confirmed">Confirmed</button>
                                </form>
                                <form action="{{ route('payment.update', $payment->id) }}" method="post" class="d-inline-block">
                                    @method('PUT')
                                    @csrf
                                    <input type="hidden" name="status" value="Rejected">
                                    <button type="submit" class="btn btn-danger btn-rejected">Rejected</button>
                                </form>
                            </td>
                            @else
                            <td>{{ $payment->status }}</td>
                            @endif
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9">
                                <div class="alert alert-info my-2">
                                    Tidak ada aktivitas pemesanan kosan anda. 
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </section>

@endsection

@push('script')
    <script>
        // ALERT CONFIRMED PAYMENT
        const btnConfirmed = document.querySelectorAll('.btn-confirmed');
        btnConfirmed.forEach(btnConfirmed => {
            btnConfirmed.addEventListener('click', (e) => {
                e.preventDefault();
                form = btnConfirmed.parentElement;
                Swal.fire({
                    title: 'Konfirmasi Pembayaran?',
                    text: "Pastikan bukti pembayaran valid.",
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
                            title: 'Terkonfirmasi',
                            text: 'Pembayaran client, berhasil dikonfirmasi',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        setInterval(() => {
                            form.submit();
                        }, 1500);
                    }
                })
            });
        })
        // ALERT REJECTED PAYMENT
        const btnRejected = document.querySelectorAll('.btn-rejected');
        btnRejected.forEach(btnRejected => {
            btnRejected.addEventListener('click', (e) => {
                e.preventDefault();
                Swal.fire({
                    title: 'Tolak Pembayaran?',
                    text: "Pembayaran akan ditolak, pastikan kembali pembayaran valid.",
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Tolak',
                    cancelmButtonText: 'Batal',
                    }).then((willRejected) => {
                    if (willRejected.isConfirmed) {
                        Swal.fire(
                        'Pembayaran ditolak!',
                        'Berhasil, pembayaran client ditolak.',
                        'success'
                        )
                    }
                })
            });
        })
        document.addEventListener( 'DOMContentLoaded', function () {
            new Splide( '#image-carousel', {
                type: 'loop',
                arrows: false,
                speed: 2000,
                pauseOnHover: false,
                rewind     : true,
                rewindSpeed: 1000,
                interval: 3000,
                easing: 'ease',
                pagination: false,
                autoplay: 'true',
            } ).mount();
        });
    </script>
@endpush