@extends('layouts.homepage')

@section('content')
    <section class="section-detail-kos">
        <div class="content-wrapper">
            <div class="row mb-5">
                <h1>Detail Kosan</h1>
                <a href="{{ route('daftarKos') }}" class="text-decoration-none">Kembali</a>
            </div>
            <div class="container-detail">
                <div class="row g-0 gap-3 wrapper-head">
                    <div class="col-12 col-md-6 mb-3 mb-md-0">
                        <img src="{{ asset('storage/' . $kosan->image) }}" width="100%" alt="">
                    </div>
                    <div class="col-12 col-md-5">
                        <h2>{{ $kosan->name }}</h2>
                        <div class="mb-2">
                            <label for="" class="form-text">Pemilik Kos</label>
                            <p>{{ $kosan->owner->name }}</p>
                        </div>
                        <div class="mb-2">
                            <label for="" class="form-text">Lokasi</label>
                            <p>{{ $kosan->address }}</p>
                        </div>
                        <div class="mb-2">
                            <label for="" class="form-text">No Telepon</label>
                            <p>{{ $kosan->owner->phone }}</p>
                        </div>
                        <div class="mb-2">
                            <label for="" class="form-text">Range Harga/kamar</label>
                            <p class="fw-bold bx-flashing text-success">{{ $kosan->range_price }}</p>
                        </div>
                    </div>
                </div>
                @auth('web')
                <h5>List Kamar :</h5>
                <div class="wrapper-type-kos mb-4">
                    @forelse ($kamars as $kamar)
                        <div class="type me-3 me-lg-0">
                            <a href="{{ route('detail_kamar', $kamar->id) }}" class="btn btn-warning me-lg-3">{{ $kamar->name }}</a>
                        </div>
                    @empty
                    <div class="alert alert-info my-2">
                        Tipe kamar masih belum tersedia saat ini.
                    </div>
                    @endforelse
                </div>
                @endauth
                <div class="row g-0 my-3">
                    <h5>Deskripsi Kosan</h5>
                    <p class="text-muted">{{ $kosan->description }}</p>
                </div>
                <div class="row g-0 map">
                    <div class="col">
                        {!! $kosan->map !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('components.footer')
@endsection