@extends('layouts.dashboard')
@section('content')
    <section class="section-edit">
        <h1 class="mt-4">Data Kos Edit</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('owner.index') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('kosan.index') }}">Kosan</a></li>
            <li class="breadcrumb-item active">Edit Kosan</li>
        </ol>

        {{-- ALERT --}}
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger">
                    {{ $error }}
                </div>
            @endforeach
        @endif

        <div class="col-lg-8 col-12">
            <form action="{{ route('kosan.update', $kosan->id) }}" method="post" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="row mb-3">
                    <label for="name" class="col-sm-3 col-form-label">Nama Kos</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="name" name="name" autocomplete="off" spellcheck="false" value="{{ $kosan->name }}" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="address" class="col-sm-3 col-form-label">Alamat</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="address" name="address" autocomplete="off" spellcheck="false" value="{{ $kosan->address }}" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="range_prices" class="col-sm-3 col-form-label">Range Harga</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="range_prices" name="range_price" autocomplete="off" spellcheck="false" placeholder="Ex: Rp. 500.000 - Rp. 1.000.000" value="{{ $kosan->range_price }}" required>
                        <div id="infoFieldPrice" class="form-text">Masukan kisaran harga kos agar dapat ditampilkan pada lapak kos anda</div>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="description" class="col-sm-3 col-form-label">Deskripsi Kosan</label>
                    <div class="col-sm-9">
                        <textarea name="description" id="description" cols="30" class="form-control" rows="10">{{ $kosan->description }}</textarea>
                        <div id="infoFieldPrice" class="form-text">Deskripsi ini akan tampil dilapak anda, sebisa mungkin anda ringkas.</div>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="map" class="col-sm-3 col-form-label">Embed Map</label>
                    <div class="col-sm-9">
                        <textarea name="map" id="map" cols="30" class="form-control" rows="10">{{ $kosan->map }}</textarea>
                        <div class="form-text">Silahkan cari embed maps di google map maupun di website lainnya.</div>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="image" class="col-sm-3 col-form-label">Pilih Gambar</label>
                    <div class="col-sm-9">
                        @if ($kosan->image)
                            <input type="hidden" value="{{ $kosan->image }}" name="oldImage">
                            <input type="hidden" value="{{ auth()->user()->id }}" name="owner_id">
                            <img src="{{ asset('storage/' . $kosan->image) }}" class="img-preview mb-2 d-block" height="200px" alt="">
                            <div id="infoFieldPrice" class="form-text mb-3">Ini adalah gambar sebelumnya.</div>
                        @else
                            <img class="img-preview img-fluid" src="" width="400px" alt="">
                        @endif
                            <input type="file" class="form-control mb-3" id="image" name="image" onchange="previewImage()">
                    </div>
                </div>
                
                <div class="mb-5">
                    <button type="submit" class="btn btn-primary p-3">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </section>
@endsection

@push('script')
    <script>
        function previewImage() {
            const image = document.querySelector('#image');
            const imgPreview = document.querySelector('.img-preview');
            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);
            oFReader.onload = function (oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }
    </script>
@endpush