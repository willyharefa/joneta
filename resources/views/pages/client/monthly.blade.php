@extends('layouts.dashboard')
@section('content')
    <section class="dashboard-client">
        <h1 class="mt-4">Pembayaran Saya</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('client.index') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Perbulan</li>
        </ol>
        
        {{-- ALERT MESSAGE --}}
        <div class="row g-0">
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-warning my-2">
                    {{ $error }}
                </div>
            
            @endforeach
        @endif
        </div>

        @if ($message = Session::get('success'))
        <div class="row g-0">
            <div class="alert alert-success my-2">
                {{ $message }}
            </div>
        </div>
        @endif

        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPayment">
            Tambah Pembayaran
        </button>

        

        <!-- Modal -->
        <form action="{{ route('payment.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="modal fade" id="addPayment" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Data Pembayaran</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row mb-3">
                                <label for="kamar_id" class="col-sm-3 col-form-label">Kos Pilihan :</label>
                                <div class="col-sm-9">
                                    <select name="kamar_id" id="kamar_id" class="form-select" required>
                                        <option selected disabled>Pilih kosan anda</option>
                                        @forelse ($rooms as $room)
                                        <option value="{{ $room->kamar_id }}">{{ $room->kosan->name }} | {{ $room->kamar->name }}</option>
                                        @empty
                                        <option selected disabled>Data Kosan pilihan masih kosong</option>
                                        @endforelse
                                    </select>
                                    <div class="form-text">Data yang tampil adalah data kosan yang telah anda pilih diikuti jenis tipe kamarnya.</div>
                                </div>
                            </div>
                            <input type="hidden" name="owner_id" value="{{ $room->owner_id }}">
                            <input type="hidden" name="kosan_id" value="{{ $room->kosan_id }}">
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label fw-bold">Total Bayar</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control bx-flashing bg-info fw-bold text-white" id="total_payment" name="price_room" readonly required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="date_payment" class="col-sm-3 col-form-label">Tanggal Pembayaran</label>
                                <div class="col-sm-9">
                                    <input type="date" class="form-control" id="date_payment" name="order_date" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="pay_amount" class="col-sm-3 col-form-label">Nominal Bayar</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" id="pay_amount" name="pay_amount" min="0" oninput="this.value = Math.abs(this.value)" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="leftover" class="col-sm-3 col-form-label">Sisa</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" id="leftover" name="leftover" required readonly>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="change" class="col-sm-3 col-form-label">Kembalian</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" id="change" name="change" required readonly>
                                    <input type="hidden" name="type_order" value="Lunas">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="image" class="col-sm-3 col-form-label">Bukti Pembayaran</label>
                                <div class="col-sm-9">
                                    <input type="file" class="form-control mb-3" id="image" name="payment_receipt" onchange="previewImage()" required>
                                    <img class="img-preview img-fluid" style="box-shadow: 0px 0px 4px rgba(0,0,0, .12); border-radius: 9px;" width="400px" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary" id="btn-payment">Input Pembayaran</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        
        <div class="col shadow-lg rounded-3 mt-5">
            <div class="table-responsive p-4">
                <table id="dataTables" class="table table-sm align-items-center align-middle w-100 text-nowrap">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tanggal Bayar</th>
                            <th>Nama Kosan</th>
                            <th>Tipe Kamar</th>
                            <th>Harga Kamar</th>
                            <th>Total Bayar</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($payments as $payment)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $payment->date_pay->format('d F Y') }}</td>
                            <td>{{ $payment->kosan->name }}</td>
                            <td>{{ $payment->kamar->name }}</td>
                            <td>@currency($payment->price_room)</td>
                            <td>@currency($payment->pay_amount)</td>
                            <td>Lunas</td>
                            <td>
                                @if ($payment->status == "Confirmed" || $payment->status == "On Reviewed")
                                {{ $payment->status }}
                                @endif
                                @if($payment->status == "Rejected")
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" id="btn-update-payment" data-bs-target="#updatePayment-{{ $payment->id }}">
                                        Perbaharui
                                    </button>

                                    <!-- Modal -->
                                    <form action="{{ route('payment.update', $payment->id) }}" method="post" enctype="multipart/form-data" id="form_payment">
                                        @method('PUT')
                                        @csrf
                                        <div class="modal fade" id="updatePayment-{{ $payment->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Data Pembayaran</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <input type="hidden" name="reupload" value="reuploaded">
                                                        <div class="row mb-3">
                                                            <label for="new_paydate" class="col-sm-3 col-form-label">Tanggal Pembayaran</label>
                                                            <div class="col-sm-9">
                                                                <input type="date" class="form-control" id="new_paydate" name="new_paydate" value="{{ $payment->date_pay->format('Y-m-d') }}" required>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <label for="new_price_room" class="col-sm-3 col-form-label">Harga Perkamar</label>
                                                            <div class="col-sm-9">
                                                                <input type="number" class="form-control bx-flashing bg-info fw-bold text-white" id="new_price_room" name="new_price_room" value="{{ $payment->price_room }}" required disabled readonly>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <label for="new_pay_amount" class="col-sm-3 col-form-label">Nominal Pembayaran</label>
                                                            <div class="col-sm-9">
                                                                <input type="number" class="form-control" id="new_pay_amount" name="new_pay_amount" min="0" value="{{ $payment->pay_amount }}" required>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <label for="pay_amount" class="col-sm-3 col-form-label">Status Pembayaran</label>
                                                            <div class="col-sm-9">
                                                                <input type="text" class="form-control" value="Lunas" disabled readonly>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <label for="new_leftover" class="col-sm-3 col-form-label">Sisa Bayar</label>
                                                            <div class="col-sm-9">
                                                                <input type="number" name="new_leftover" id="new_leftover" class="form-control" value="{{ $payment->leftover }}" required readonly>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <label for="new_change" class="col-sm-3 col-form-label">Kembalian</label>
                                                            <div class="col-sm-9">
                                                                <input type="number" name="new_change" id="new_change" class="form-control" value="{{ $payment->change }}" required readonly>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <label for="new_image" class="col-sm-3 col-form-label">Bukti Pembayaran</label>
                                                            <div class="col-sm-9">
                                                                @if ($payment->image)
                                                                    <input type="hidden" value="{{ $payment->image }}" name="oldImagePayment">
                                                                    <img src="{{ asset('storage/' . $payment->image) }}" class="new-img-preview mb-2 d-block" height="200px" alt="">
                                                                    <div id="infoFieldPrice" class="form-text mb-3">Ini adalah gambar sebelumnya.</div>
                                                                @else
                                                                    <img class="new-img-preview img-fluid" src="" width="400px" alt="">
                                                                @endif
                                                                <input type="file" class="form-control mb-3" id="new_image" name="new_image">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn btn-primary" id="btn-change-payment">Perbaharui Pembayaran</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <td colspan="8">
                            <div class="alert alert-info my-2">
                                Tidak ada aktivitas pembayaran.
                            </div>
                        </td>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </section>
@endsection

@push('script')
    <script>
        const kosanSelected = document.querySelector("#kamar_id");
        const totalPayment = document.querySelector('#total_payment');
        const payAmount = document.querySelector('#pay_amount');
        const leftover = document.querySelector('#leftover');
        const change = document.querySelector('#change');
        const btnPayment = document.querySelector('#btn-payment');
        kosanSelected.addEventListener('change', (e) => {
            let getId = e.target.value;
            fetch('/kamar-data/'+ getId)
            .then(response => response.json())
            .then(data => {
                    totalPayment.value = data.price
            });
        });

        payAmount.addEventListener('input', (e) => {
            if(!e.target.value == "") {
                if(parseInt(e.target.value) <= totalPayment.value) {
                    leftover.value = totalPayment.value - parseInt(e.target.value);
                    change.value = 0;
                    
                } else {
                    change.value = parseInt(e.target.value - totalPayment.value);
                    leftover.value = 0; 
                }

                if(parseInt(e.target.value) >= totalPayment.value ) {
                    btnPayment.disabled = false;
                } else {
                    btnPayment.disabled = true;
                }
            }
        })

        const   btnUpdatePay = document.querySelectorAll('#btn-update-payment');
        const   priceRoomUpdate = document.querySelectorAll('#new_price_room');
        const   newPayAmount = document.querySelectorAll('#new_pay_amount');
        const   newLeftover = document.querySelectorAll('#new_leftover');
        const   newChange = document.querySelectorAll('#new_change');
        const   btnSavePaymentUpdate = document.querySelectorAll('#btn-change-payment');
                btnUpdatePay.forEach((btnUpdatePay, indexBtnUpdate) => {
                    // return indexBtnUpdate;
                    btnUpdatePay.addEventListener('click', () => {
                        newPayAmount[indexBtnUpdate].addEventListener('input', (e) => {
                            if(!parseInt(e.target.value) == "") {
                                if(parseInt(e.target.value) <= priceRoomUpdate[indexBtnUpdate].value) {
                                    newLeftover[indexBtnUpdate].value = priceRoomUpdate[indexBtnUpdate].value - parseInt(e.target.value);
                                    newChange[indexBtnUpdate].value = 0
                                }
                                else {
                                    newLeftover[indexBtnUpdate].value = 0;
                                    newChange[indexBtnUpdate].value = parseInt(e.target.value) - priceRoomUpdate[indexBtnUpdate].value;
                                }
                            } else {
                                newLeftover[indexBtnUpdate].value = 0;
                                newChange[indexBtnUpdate].value = 0;
                            }
                        });
                    });

                    btnSavePaymentUpdate[indexBtnUpdate].addEventListener('click', (e) => {
                        e.preventDefault();
                        const form = document.querySelectorAll('#form_payment');
                        Swal.fire({
                            title: 'Yakin Memperbaharui ?',
                            text: 'Pastikan data pembayaran anda sesuai dengan inputan anda',
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonText: 'Ya',
                            cancelButtonText: 'Batal',
                            reverseButtons: true
                            }).then((willUpdatePayment) => {
                                if(willUpdatePayment.isConfirmed) {
                                    Swal.fire({
                                        title: 'Berhasil Diperbaharui',
                                        text: 'Data pembayaran anda berhasil diperbaharui.',
                                        icon: 'success',
                                    });
                                    setInterval(() => {
                                        form[indexBtnUpdate].submit();
                                    }, 1300);
                                }
                            });
                        })
                    // function newPreviewImage() {
                    //     const newImage = document.querySelectorAll('#new_image');
                    //     const newImgPreview = document.querySelectorAll('.new-img-preview');
                    //     const oFReader = new FileReader();
                    //     oFReader.readAsDataURL(newImage[indexBtnUpdate].files[0]);
                    //     oFReader.onload = function (oFREvent) {
                    //         newImgPreview[indexBtnUpdate].src = oFREvent.target.result;
                    //     }
                    // }
                });
    </script>
@endpush