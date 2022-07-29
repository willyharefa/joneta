@extends('layouts.dashboard')
@section('content')
    <section class="section-gambar-kamar">
        <h1 class="mt-4">Gambar Kamar Kos</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('owner.index') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('kamar.index') }}">Kamar</a></li>
            <li class="breadcrumb-item active">Tambah Gambar</li>
        </ol>

        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createImage">
            Tambah Gambar
        </button>
        
        <!-- Modal -->
        <form action="{{ route('gambar-kamar.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="modal fade" id="createImage" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Gambar</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-5">
                                <label for="name" class="form-label">Jenis Kamar Kos</label>
                                <select name="kamar_id" id="kamar_id" class="form-select" required>
                                    <option selected value="{{ $kamar->id }}">{{ $kamar->name }}</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <input type="file" class="form-control mb-3" id="image" name="image" onchange="previewImage()" required title="Gambar Kamar Kos">
                                <img class="img-preview img-fluid" width="400px" alt="">
                            </div>
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan Gambar</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-warning my-3">
                    {{ $error }}
                </div>
            @endforeach
        @endif

        @if ($message = Session::get('success'))
            <div class="alert alert-success my-3">
                {{ $message }}
            </div>
        @endif

        <div class="table-responsive mt-5">
            <table id="dataTables" class="table align-middle">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Kamar</th>
                        <th>Gambar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($gambars as $gambar)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $gambar->kamar->name }}</td>
                        <td>
                            <img src="{{ asset('storage/' . $gambar->image ) }}" height="100px" alt="">
                        </td>
                        <td>
                            <button class="btn btn-danger">Hapus</button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4">
                            <div class="alert alert-info my-2">
                                Data masih kosong
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>

@endsection