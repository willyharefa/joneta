@extends('layouts.dashboard')
@section('content')
    <section class="section-kamar-edit">
        <h1 class="mt-5">Edit Data Kamar</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('owner.index') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('kamar.index') }}">Kamar</a></li>
            <li class="breadcrumb-item active">Edit Kamar</li>
        </ol>

        <form action="{{ route('kamar.update', $kamar->id) }}" method="post">
            @method('PUT')
            @csrf
            <div class="col-lg-10 col-12">
                <div class="row mb-3">
                    <label for="kosan_id" class="col-sm-3 col-form-label">Nama Kosan</label>
                    <div class="col-sm-9">
                        <select name="kosan_id" id="kosan_id" class="form-select" required>
                            <option disabled selected>Pilih Kosan anda</option>
                            @foreach ($kosans as $kosan)
                                @if ($kamar->id === $kosan->id)
                                    <option value="{{ $kosan->id }}" selected>{{ $kosan->name }}</option>
                                @else
                                    <option value="{{ $kosan->id }}">{{ $kosan->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="new_name" class="col-sm-3 col-form-label">Nama Kamar</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="new_name" name="new_name" autocomplete="off" spellcheck="false" required value="{{ $kamar->name }}">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="content" class="col-sm-3 col-form-label">Deskripsi Kamar</label>
                    <div class="col-sm-9">
                        <textarea  class="form-control" id="content" name="new_description" required title="Deskripsi Kamar">{{ $kamar->description }}</textarea>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="new_total_room" class="col-sm-3 col-form-label">Total Kamar/Ruangan</label>
                    <div class="col-sm-9">
                        <input type="number" class="form-control" id="new_total_room" name="new_total_room" required value="{{ $kamar->total_room }}">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="new_room_filled" class="col-sm-3 col-form-label">Kamar Terpakai</label>
                    <div class="col-sm-9">
                        <input type="number" class="form-control" id="new_room_filled" name="new_room_filled" required value="{{ $kamar->room_filled }}">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="new_room_available" class="col-sm-3 col-form-label">Kamar Kosong</label>
                    <div class="col-sm-9">
                        <input type="number" class="form-control" id="new_room_available" name="new_room_available" title="Kamar kosong / tersedia" required value="{{ $kamar->room_available }}">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="new_price" class="col-sm-3 col-form-label">Harga Kamar</label>
                    <div class="col-sm-9">
                        <input type="number" class="form-control" id="new_price" name="new_price" title="Harga kamar" required value="{{ $kamar->price }}">
                    </div>
                </div>
    
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary py-3">Simpan Perubahan</button>
                </div>
            </div>
        </form>
    </section>
@endsection