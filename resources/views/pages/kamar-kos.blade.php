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
                        <i class='bx bx-md bx-like me-3'></i>
                        <div class="sub-detail">
                            <label for="" class="form-text">Kamar Kosong</label>
                            <p>{{ $kamar->room_available }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row row-description">
                <h3>Deskripsi Kamar</h3>
                <div class="deskripsi">
                    {!! $kamar->description !!}
                </div>
                <div class="col-12">
                    <!-- Button trigger modal -->
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary p-3" data-bs-toggle="modal" data-bs-target="#pesanSekarang">
                        Pesan Sekarang
                    </button>
                    
                    <!-- Modal -->
                    <form action="" method="post">
                        <div class="modal fade" id="pesanSekarang" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Data Pemesanan</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                ...
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Pesan</button>
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