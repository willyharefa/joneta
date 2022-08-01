@extends('layouts.homepage')

@push('style')
    <link rel="stylesheet" href="{{ asset('/css/login.css') }}">
@endpush

@section('content')
    <section class="section-registration">
        <div class="content-wrapper">
            <h2>Form Registrasi</h2>
            <p class="text-muted">Isi biodata anda dengan lengkap pada form dibawah ini</p>
            <div class="col-md-7 col-12 mt-5 form-login">
                <form action="{{ route('registration.store') }}" method="POST">
                    @csrf
                    <div class="row mb-3">
                        <label for="name" class="col-sm-4 col-form-label">Nama Lengkap</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" autocomplete="off" spellcheck="false" required value="{{ old('name') }}">
                            @error('name')
                                <div class="alert alert-danger my-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="birthday" class="col-sm-4 col-form-label">Tanggal Lahir</label>
                        <div class="col-sm-8">
                            <input type="date" class="form-control" id="date" name="birthday" required value="{{ old('birthday', date('d-m-y')) }}">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="gender" class="col-sm-4 col-form-label">Jenis Kelamin</label>
                        <div class="col-sm-8">
                            <select name="gender" id="gender" class="form-select" required>
                                <option selected disabled>Pilih jenis kelamin</option>
                                <option value="Pria">Pria</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="address" class="col-sm-4 col-form-label">Alamat</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" autocomplete="off" spellcheck="false" required value="{{ old('address') }}">
                            @error('address')
                                <div class="alert alert-danger my-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="phone" class="col-sm-4 col-form-label">No Telepon / WA</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" autocomplete="off" spellcheck="false" required value="{{ old('phone') }}">
                            @error('phone')
                                <div class="alert alert-danger my-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="username" class="col-sm-4 col-form-label"><strong>Username</strong></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" autocomplete="off" spellcheck="false" required value="{{ old('username') }}">
                            @error('username')
                                <div class="alert alert-danger my-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="password" class="col-sm-4 col-form-label"><strong>Password</strong></label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
                            @error('password')
                                <div class="alert alert-danger my-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="password" class="col-sm-4 col-form-label"><strong>Konfirmasi Password</strong></label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" id="password" name="password_confirmation" required>
                        </div>
                    </div>

                    <fieldset class="row mb-3">
                        <legend class="col-form-label col-sm-4 pt-0">Radios</legend>
                        <div class="col-sm-8">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" id="visitor" value="visitor" required {{ old('status') === 'visitor' ? 'checked' : '' }}>
                                <label class="form-check-label" for="gridRadios1">Pengunjung</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" id="owner" value="owner" required {{ old('status') === 'owner' ? 'checked' : '' }}>
                                <label class="form-check-label" for="owner">Owner Kos</label>
                            </div>
                        </div>
                    </fieldset>
                    <hr>
                    <div class="d-md-flex align-items-center">
                        <button type="submit" class="btn btn-primary py-3 me-md-4 mb-4 mb-md-0">Daftar Sekarang</button>
                        <p class="m-0 text-muted">Sudah punya akun ? Klik <a href="{{ route('login.index') }}">disini</a></p>
                    </div>
                </form>
            </div>
        </div>
</section>
@include('components.footer')
@endsection
