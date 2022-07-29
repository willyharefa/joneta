@extends('layouts.dashboard')
@push('style')
    <link rel="stylesheet" href="{{ asset('/css/dashboard.css') }}">
@endpush
@section('content')
    <section class="section-kosan">
        <h1 class="mt-4">Lapak Kos</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Dashboard</li>
            <li class="breadcrumb-item active">Kosan</li>
            {{-- <li class="breadcrumb-item"><a href="#">Home</a></li> --}}
        </ol>

        <div class="mb-3">
            <!-- TRIGGER MODAL CREATE -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                + Kos Baru
            </button>
            
            <!-- MODAL CREATE -->
            <form action="{{ route('kosan.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered ">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Data Kos Baru</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row mb-3">
                                    <label for="name" class="col-sm-3 col-form-label">Nama Kos</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="name" name="name" autocomplete="off" spellcheck="false" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="address" class="col-sm-3 col-form-label">Alamat</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="address" name="address" autocomplete="off" spellcheck="false" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="range_prices" class="col-sm-3 col-form-label">Range Harga</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="range_prices" name="range_prices" autocomplete="off" spellcheck="false" placeholder="Ex: Rp. 500.000 - Rp. 1.000.000" required>
                                        <div id="infoFieldPrice" class="form-text">Masukan kisaran harga kos agar dapat ditampilkan pada lapak kos anda</div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="image" class="col-sm-3 col-form-label">Pilih Gambar</label>
                                    <div class="col-sm-9">
                                        <input type="file" class="form-control mb-3" id="image" name="image" onchange="previewImage()" required>
                                        <img class="img-preview img-fluid" width="400px" alt="">
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
                        <th>Nama Kos</th>
                        <th>Alamat</th>
                        <th>Patokan Harga</th>
                        <th>Gambar</th>
                        <th>Pemilik</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($kosans as $kosan)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $kosan->name }}</td>
                        <td>{{ $kosan->address }}</td>
                        <td>{{ $kosan->range_price }}</td>
                        <td>
                            <img src="{{ asset('storage/' . $kosan->image ) }}" width="200px" alt="">
                        </td>
                        <td>{{ $kosan->owner->name }}</td>
                        <td>
                            <a href="{{ route('kosan.edit', $kosan->id) }}" class="btn btn-warning d-inline-block">Edit</a>
                            <form action="{{ route('kosan.destroy', $kosan->id) }}" method="post" class="d-inline-block">
                                @method('DELETE')
                                @csrf
                                <a type="submit" class="btn btn-danger btn-hapus" id="btn-delete">Hapus</a>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7">
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

@push('script')
    <script>
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
    </script>
@endpush
