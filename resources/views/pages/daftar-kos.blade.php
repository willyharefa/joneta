@extends('layouts.homepage')

@section('content')
    <section class="section-daftar-kos">
        <div class="content-wrapper">
            <h3>Daftar Kosan</h3>

            <div class="row g-0 gap-2 mt-4">
                @foreach ($kosans as $kosan)
                <div class="text-start col-md-4 mb-3 col-12 item-kosan p-4">
                    <div class="row g-0 mb-4">
                        <img src="{{ asset('storage/' . $kosan->image ) }}" draggable="false" alt="">
                    </div>
                    <h2 class="text-muted">{{ $kosan->name }}</h2>
                    
                    <div class="col wrapper-owner-profile">
                        <div class="owner-name">
                            <img src="{{ asset('storage/'. $kosan->owner->image) }}" alt="">
                            <p class="fw-bold">{{ $kosan->owner->name }}</p>
                        </div>
                        <p class="d-flex text-muted"><i class='bx bx-sm bx-map-pin me-2'></i>{{ $kosan->address }}</p>
                        <p class="d-flex text-muted"><i class='bx bx-sm bxl-whatsapp me-2'></i>{{ $kosan->owner->phone }}</p>
                        {{-- <p>{{}}</p> --}}
                    </div>

                    <div class="wrapper-button">
                        <a href="{{ route('detail_kos', $kosan->id) }}" class="btn btn-primary d-flex py-3 justify-content-center" style="bottom: 0;">Lihat Selengkapnya</a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection