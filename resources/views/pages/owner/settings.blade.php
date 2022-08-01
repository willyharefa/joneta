@extends('layouts.dashboard')
@section('content')
    <section class="section-setting-owner py-5">
        <h1 class="text-muted">Pengaturan</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('owner.index') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Pengaturan</li>
        </ol>

        <div class="col-12 col-md-8 mt-5">
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="row g-0">
                        <div class="alert alert-danger my-2">
                            {{ $error }}
                        </div>
                    </div>
                @endforeach
            @endif

            @if ($message = Session::get('success'))
                <div class="row g-0">
                    <div class="alert alert-success my-2">
                        {{ $message }}
                    </div>
                </div>
            @endif
            <div class="card">
                <div class="card-header row g-0 align-items-center justify-content-between">
                    <div class="col">
                        Biodata
                    </div>
                    <div class="col text-end">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editProfileOwner">
                            Edit Profile
                        </button>
                        
                        <!-- Modal -->
                        <form action="{{ route('owner.update', $owner->id) }}" method="post" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="modal fade" id="editProfileOwner" tabindex="-1">
                                <div class="modal-dialog modal-lg modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Biodata Baru</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row mb-3">
                                                <label class="col-sm-3 col-form-label">Nama Lengkap</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="name" value="{{ $owner->name }}" required>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label class="col-sm-3 col-form-label">Tanggal lahir</label>
                                                <div class="col-sm-9">
                                                    <input type="date" class="form-control" name="birthday" value="{{ $owner->birthday->format('Y-m-d') }}" required>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label class="col-sm-3 col-form-label">Jenis Kelamin</label>
                                                <div class="col-sm-9">
                                                    <select name="gender" id="gender" class="form-select" required>
                                                        <option value="Pria" {{ $owner->gender == "Pria" ? "selected" : "" }}>Pria</option>
                                                        <option value="Perempuan" {{ $owner->gender == "Perempuan" ? "selected" : "" }}>Perempuan</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label class="col-sm-3 col-form-label">Alamat</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="address" value="{{ $owner->address }}" required>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label class="col-sm-3 col-form-label">No. Telepon / WA</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="phone" value="{{ $owner->phone }}" required>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label class="col-sm-3 col-form-label fw-bold">Username</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="username" value="{{ $owner->username }}" required>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label class="col-sm-3 col-form-label fw-bold">Tentang Saya</label>
                                                <div class="col-sm-9">
                                                    <textarea class="form-control" name="description" id="description" rows="2" required>{{ $owner->description }}</textarea>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label class="col-sm-3 col-form-label fw-bold">Foto Profile</label>
                                                <div class="col-sm-9">
                                                    <input type="file" class="form-control" name="image" {{ $owner->image == '' ? 'required' : '' }}>
                                                    <div class="form-text text-start">Anda bisa mengabaikan field ini jika tidak ingin mengubah foto profile anda.</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary btn-save">Save changes</button>
                                        </div>
                                </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-4 mx-auto mx-md-0 col-md-3 mb-3 mb-md-0">
                            @if ($owner->image == "")
                            <div class="alert alert-info">
                                Gambar profile anda masih kosong
                            </div>
                            @else
                            <img src="{{ asset('storage/'. $owner->image) }}" style="border-radius: 50%" width="100%" alt="">
                            @endif
                        </div>
                        <div class="col-12 col-md-9 text-center text-md-start">
                            @if ($owner->description == "")
                                <div class="alert alert-info">
                                    Deskripsi tentang anda masih kosong. Silahkan isi dengan mengklik tombol <strong>Edit Profile</strong>.
                                </div>
                            @else
                            <label for="" class="form-label fw-bold">Tentang Saya</label>
                            <blockquote class="text-muted fs-italic">
                                {{ $owner->description }}
                            </blockquote>
                            @endif
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Nama Lengkap</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" value="{{ $owner->name }}" readonly disabled>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Tanggal lahir</label>
                        <div class="col-sm-9">
                            <input type="date" class="form-control" value="{{ $owner->birthday->format('Y-m-d') }}" readonly disabled>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Jenis Kelamin</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" value="{{ $owner->gender }}" readonly disabled>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Alamat</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" value="{{ $owner->address }}" readonly disabled>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">No. Telepon / WA</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" value="{{ $owner->phone }}" readonly disabled>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label fw-bold">Username</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" value="{{ $owner->username }}" readonly disabled>
                        </div>
                    </div>
                    <div class="row mb-3 justify-content-end">
                        <div class="col-sm-9">
                            <div class="alert alert-success" role="alert">
                                <h5 class="alert-heading">Perhatian !</h5>
                                <p>Saat ini, anda belum dapat mengubah password akun anda. Kedepannya sistem kami akan terus melakukan pengembangan fitur-fitur tersebut salah satunya reset password.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection