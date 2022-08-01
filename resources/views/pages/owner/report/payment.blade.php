@extends('layouts.dashboard')

@push('style')
    <link rel="stylesheet" href="{{ asset('/css/dashboard.css') }}">
@endpush

@section('content')
    <section class="section-report-payment py-5">
        <h1 class="text-muted">Laporan Pembayaran</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('owner.index') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Laporan Pembayaran</li>
        </ol>

        <div class="row g-0 my-5">
            <div class="table-responsive p-4 shadow-lg rounded-3">
                <table id="dataTables" class="table align-middle">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Pemesan</th>
                            <th>Tanggal Bayar</th>
                            <th>Tipe Bayar</th>
                            <th>Harga Kamar</th>
                            <th>Nominal Bayar</th>
                            <th>Kembalian</th>
                            <th>Gambar</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($payments as $payment)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $payment->user->name }}</td>
                            <td>{{ $payment->date_pay }}</td>
                            <td>{{ $payment->type_order }}</td>
                            <td>@currency($payment->price_room)</td>
                            <td>@currency($payment->pay_amount)</td>
                            <td>@currency($payment->change)</td>
                            <td>
                                <img src="{{ asset('storage/' . $payment->image) }}" width="100px" alt="">
                            </td>
                            <td>{{ $payment->status }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8">
                                <div class="alert alert-info my-2">
                                    Tidak ada informasi pembayaran.
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