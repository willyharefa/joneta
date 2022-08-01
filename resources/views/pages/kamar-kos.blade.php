@extends('layouts.homepage')
@section('content')
    <section class="section-galeri-kamar">
        <div class="content-wrapper">
            <div class="row g-0 mt-5">
                <h1>Detail Kamar</h1>
                <a href="{{ route('detail_kos', $kamar->kosan_id) }}" class="text-decoration-none">Kembali</a>
            </div>
            <div class="row my-5">
                @if (!$gambarkos->isEmpty())
                <div class="col-12 col-md-6 mb-4 mb-md-0">
                    <div id="main-carousel" class="splide">
                        <div class="splide__track">
                            <ul class="splide__list">
                            @foreach ($gambarkos as $item)
                                <li class="splide__slide">
                                    <img src="{{ asset('storage/' . $item->image) }}" alt="">
                                </li>
                            @endforeach
                            </ul>
                        </div>
                    </div>
                    
                    <ul id="thumbnails" class="thumbnails">
                        @foreach ($gambarkos as $item)
                        <li class="thumbnail">
                            <img src="{{ asset('storage/' . $item->image) }}" alt="">
                        </li>
                        @endforeach
                    </ul>
                </div>
                @else
                <div class="col-12 col-md-6 mb-4 mb-md-0">
                    <div class="alert alert-info my-4 p-4">
                        Gambar masih kosong.
                    </div>
                </div>
                @endif
                <div class="col-12 col-md-6">
                    <h2 class="mb-4">{{ $kamar->name }}</h2>

                    <div class="d-flex align-items-center">
                        <i class='bx bx-md bx-buildings me-3'></i>
                        <div class="sub-detail">
                            <label for="" class="form-text">Total Kamar</label>
                            <p>{{ $kamar->total_room }}</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        <i class='bx bx-md bx-face me-3'></i>
                        <div class="sub-detail">
                            <label for="" class="form-text">Kamar Terisi</label>
                            <p>{{ $kamar->room_filled }}</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        <i class='bx bx-md bx-home-alt me-3'></i>
                        <div class="sub-detail">
                            <label for="" class="form-text">Kamar Kosong</label>
                            <p>{{ $kamar->room_available }}</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        <i class='bx bx-md bx-flashing bx-purchase-tag-alt me-3'></i>
                        <div class="sub-detail">
                            <label for="" class="form-text">Harga</label>
                            <p class="fw-bold text-success bx-flashing">@currency($kamar->price)</p>
                        </div>
                    </div>
                </div>
            </div>
            {{-- ALERT MESSAGE --}}
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                <div class="row g-0 gap-3">
                    <div class="alert alert-warning my-2">
                        {{ $error }}
                    </div>
                </div>
                @endforeach
            @endif

            @if ($message = Session::get('success'))
                <div class="alert alert-success my-2">
                    {{ $message }} silahkan cek informasi pemesanan di <a href="{{ route('client.index') }}" class="text-decoration-none fw-bold">Dashboard Saya</a>
                </div>
            @endif

            <div class="row row-description">
                <h3>Deskripsi Kamar</h3>
                <div class="deskripsi">
                    {!! $kamar->description !!}
                </div>
                <div class="col-12">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary p-3" data-bs-toggle="modal" data-bs-target="#pesanSekarang">
                        Pesan Sekarang
                    </button>
                    
                    <!-- Modal -->
                    <form action="{{ route('payment.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="modal fade" id="pesanSekarang" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Data Pemesanan</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row mb-3">
                                            <label for="name" class="col-sm-3 col-form-label">Nama Pemesan</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" readonly value="{{ Auth::user()->name }}">
                                                <input type="hidden" class="form-control" name="kamar_id" value="{{ $kamar->id }}">
                                                <input type="hidden" class="form-control" name="owner_id" value="{{ $kamar->owner_id }}">
                                                <input type="hidden" class="form-control" name="kosan_id" value="{{ $kamar->kosan_id }}">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="order_date" class="col-sm-3 col-form-label">Tanggal Pesan</label>
                                            <div class="col-sm-9">
                                                <input type="date" class="form-control" id="order_date" name="order_date" required>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="price" class="col-sm-3 col-form-label">Harga/kamar</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control fw-bolder bx-flashing bg-info text-white" id="price" name="price" disabled readonly value="@currency($kamar->price)">
                                                <input type="hidden" id="price_room" name="price_room" value="{{ $kamar->price }}">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="pay_amount" class="col-sm-3 col-form-label">Jumlah Bayar</label>
                                            <div class="col-sm-9">
                                                <input type="number" class="form-control" id="pay_amount" name="pay_amount" required title="Jumlah pembayaran anda">
                                                <p class="form-text">Silahkan masukan jumlah pembayaran anda dengan benar</p>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="leftover" class="col-sm-3 col-form-label">Sisa Bayar</label>
                                            <div class="col-sm-9">
                                                <input type="number" class="form-control" id="leftover" name="leftover" required readonly title="Sisa pembayaran anda">
                                                <input type="hidden" class="form-control" id="change" name="change" required>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="type_order" class="col-sm-3 col-form-label">Jenis Bayar</label>
                                            <div class="col-sm-9">
                                                <select class="form-select" name="type_order" required>
                                                    <option selected disabled>Pilih Jenis Pembayaran</option>
                                                    <option value="DP">DP</option>
                                                    <option value="Lunas">Langsung Lunas</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="payment_receipt" class="col-sm-3 col-form-label">Bukti Pembayaran</label>
                                            <div class="col-sm-9">
                                                <input type="file" class="form-control" id="image" name="payment_receipt" onchange="previewImage()" required>
                                                <p class="form-text">Upload bukti bayar anda sesuai nominal yang anda masukan.</p>
                                                <img class="img-preview img-fluid" width="340px" alt="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Pesan</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('script')
    <script>
        // ALERT WHEN ORDER SUCCESSFULLY
        let data = '{{ Session::has('success') }}';
        if(data == 1) {
            Swal.fire(
            'Berhasil',
            'Pemesanan kamar kos anda berhasil dilakukan',
            'success'
            )
        }
        // END SCRIPT ALERT



        const   leftover = document.querySelector('#leftover');
        const   changePay = document.querySelector('#change');
        const   priceRoom = document.querySelector('#price_room').value;
        const   payAmount = document.querySelector('#pay_amount');
                payAmount.addEventListener('input', (e) => {
                    if(e.target.value == "") {
                        leftover.value = 0;
                        changePay.value = 0;
                    } else {
                        if(parseInt(e.target.value) >= priceRoom) {
                            leftover.value = 0;
                            changePay.value = e.target.value - priceRoom;
                        } else {
                            changePay.value = 0;
                            leftover.value = priceRoom - parseInt(e.target.value);
                        }
                    }
                });

        var splide = new Splide( '#main-carousel', {
            type: 'loop',
            autoplay:true,
            pagination: false,
        });

        var thumbnails = document.getElementsByClassName( 'thumbnail' );
        var current;

        for ( var i = 0; i < thumbnails.length; i++ ) {
        initThumbnail( thumbnails[ i ], i );
        }

        function initThumbnail( thumbnail, index ) {
            thumbnail.addEventListener( 'click', function () {
                splide.go( index );
            });
        }

        splide.on( 'mounted move', function () {
            var thumbnail = thumbnails[ splide.index ];
            if ( thumbnail ) {
                if ( current ) {
                    current.classList.remove( 'is-active' );
                }
                thumbnail.classList.add( 'is-active' );
                current = thumbnail;
            }
        });
        splide.mount();
    </script>
@endpush