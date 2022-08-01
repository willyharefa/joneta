@extends('layouts.dashboard')

@push('style')
    <link rel="stylesheet" href="{{ asset('/css/dashboard.css') }}">
@endpush

@section('content')
    <section class="section-report-payment py-5">
        <h1 class="text-muted">Laporan Data Kamar Kos</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('owner.index') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Laporan Data Kamar</li>
        </ol>

        <div class="row g-0 my-5">
            <div class="table-responsive p-4 shadow-lg rounded-3">
                <table id="dataTables" class="table align-middle">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Jenis Kamar</th>
                            <th>Ruangan</th>
                            <th>Dipakai</th>
                            <th>Sisa</th>
                            <th>Harga Kamar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($rooms as $room)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $room->name }}</td>
                            <td>{{ $room->total_room }}</td>
                            <td>{{ $room->room_filled }}</td>
                            <td>{{ $room->room_available }}</td>
                            <td>@currency($room->price)</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6">
                                <div class="alert alert-info my-2">
                                    Tidak ada informasi data kamar.
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
        $(document).ready(function () {
                $('#dataTables').DataTable({
                    dom:    "<'top' <'row mb-4'" +
                                    "<'col-12 col-md-4 mb-md-0 mb-2'l>"+
                                    "<'col-12 col-md-4'B>"+
                                    "<'col-12 col-md-4 text-end'f>"+
                                ">"+
                            ">t"+
                            "<'bottom'<'row my-3'<'col'i><'col'p>> >",
                    buttons: [
                        'copy', 'csv', 'excel', 'pdf', 'print'
                    ]
                });
            });
    </script>
@endpush