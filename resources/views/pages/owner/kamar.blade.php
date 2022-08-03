@extends('layouts.dashboard')
@push('style')
    <link rel="stylesheet" href="{{ asset('/css/dashboard.css') }}">
@endpush
@section('content')
    <section class="section-kosan">
        <h1 class="mt-4">Lapak Kos</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('owner.index') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Kamar</li>
        </ol>

        <div class="mb-3">
            <!-- TRIGGER MODAL CREATE -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createRoom">
                + Tambah Kamar
            </button>
            
            <!-- MODAL CREATE -->
            <form action="{{ route('kamar.store') }}" method="post">
                @csrf
                <div class="modal fade" id="createRoom" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl modal-dialog-centered ">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Data Kamar Baru</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row mb-3">
                                    <label for="kosan_id" class="col-sm-3 col-form-label">Nama Kosan</label>
                                    <div class="col-sm-9">
                                        <select name="kosan_id" id="kosan_id" class="form-select" required>
                                            <option disabled selected>Pilih Kosan anda</option>
                                            @foreach ($kosans as $kosan)
                                                <option value="{{ $kosan->id }}">{{ $kosan->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="name" class="col-sm-3 col-form-label">Nama Kamar</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="name" name="name" autocomplete="off" spellcheck="false" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="content" class="col-sm-3 col-form-label">Deskripsi Kamar</label>
                                    <div class="col-sm-9">
                                        {{-- <input type="text" class="form-control" id="name" name="name" autocomplete="off" spellcheck="false" required> --}}
                                        <textarea  class="form-control" id="content" name="description" required title="Deskripsi Kamar"></textarea>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="total_room" class="col-sm-3 col-form-label">Total Kamar/Ruangan</label>
                                    <div class="col-sm-9">
                                        <input type="number" class="form-control" id="total_room" name="total_room" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="room_filled" class="col-sm-3 col-form-label">Kamar Terpakai</label>
                                    <div class="col-sm-9">
                                        <input type="number" class="form-control" id="room_filled" name="room_filled" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="room_available" class="col-sm-3 col-form-label">Kamar Kosong</label>
                                    <div class="col-sm-9">
                                        <input type="number" class="form-control" id="room_available" name="room_available" title="Kamar kosong / tersedia" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="price" class="col-sm-3 col-form-label">Harga Kamar</label>
                                    <div class="col-sm-9">
                                        <input type="number" class="form-control" id="price" name="price" title="Harga kamar" required>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary">Simpan Data</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        {{-- ALERT / MESSAGE --}}
        @if ($message = Session::get('success'))
            <div class="alert alert-success my-3">
                {{ $message }}
            </div>
        @endif

            {{-- Table View Kos --}}
        <div class="table-responsive table-data-kos">
            <table id="dataTables" class="table align-middle">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Jenis Kamar</th>
                        <th>Ruangan</th>
                        <th>Dipakai</th>
                        <th>Sisa</th>
                        <th>Harga</th>
                        <th>Deskripsi</th>
                        <th>Gambar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($kamars as $kamar)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $kamar->name }}</td>
                        <td>{{ $kamar->total_room }}</td>
                        <td>{{ $kamar->room_filled }}</td>
                        <td>{{ $kamar->room_available }}</td>
                        <td>@currency($kamar->price)</td>
                        <td>
                            <div>
                                {!! Str::limit($kamar->description, 20) !!}
                            </div>
                        </td>
                        <td>
                            <a href="{{ route('gambar-kamar.gambar', $kamar->id) }}" class="btn btn-success">Add Image</a>
                        </td>
                        <td>
                            <a href="{{ route('kamar.edit', $kamar->id) }}" class="btn btn-warning" type="button">Edit</a>
                            <form action="{{ route('kamar.destroy', $kamar->id) }}" method="post" class="d-inline-block">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-danger" id="btn-hapus-kamar">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @empty 
                    <tr>
                        <td colspan="9">
                            <div class="alert alert-info my-2">
                                Data kamar masih kosong
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
@endsection

@push('script')
    <script>
        const btnHapus = document.querySelectorAll('#btn-hapus-kamar');
        btnHapus.forEach(btnHapus => {
            btnHapus.addEventListener('click', (e) => {
                e.preventDefault();
                const form = btnHapus.parentElement;
                Swal.fire({
                    title: 'Yakin Menghapus ?',
                    text: 'Data kamar akan dihapus dari database.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya',
                    cancelButtonText: 'Batal',
                    reverseButtons: true
                    }).then((willDeleted) => {
                        if(willDeleted.isConfirmed) {
                            Swal.fire({
                                title: 'Berhasil Dihapus',
                                text: 'Data kamar anda berhasil dihapus.',
                                icon: 'success',
                            });
                            setInterval(() => {
                                form.submit();
                            }, 1300);
                        }
                    });
                });
        });
    </script>
    {{-- <script>
        const btnDelete = document.querySelectorAll('#btn-delete');
        btnDelete.forEach((btnDelete) => {
            btnDelete.addEventListener('click', (e) => {
                e.preventDefault();
                const form = btnDelete.parentElement;
                Swal.fire({
                    title: 'Hapus ?',
                    text: 'Anda yakin ingin menghapus data ini ?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya',
                    cancelButtonText: 'Batal',
                    reverseButtons: true
                }).then((willDelete) => {
                    if(willDelete.isConfirmed) {
                        Swal.fire({
                            title: 'Berhasil Hapus',
                            text: 'Data berhasil dihapus',
                            icon: 'success',
                        });
                        setInterval(() => {
                            form.submit();
                        }, 1300);
                    }
                });
            })
        })
    </script> --}}
@endpush
