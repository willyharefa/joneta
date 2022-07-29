@extends('layouts.homepage')

@push('style')
    <link rel="stylesheet" href="{{ asset('/css/login.css') }}">
@endpush

@section('content')
    <section class="section-login">
        <div class="wrapper-form">
            @if ($message = Session::get('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ $message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            
            @if ($message = Session::get('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ $message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            <form action="{{ route('login.authenticate') }}" method="post">
                @csrf
                <div class="row col-form">
                    <div class="col col-img d-none d-sm-grid">
                        <img src="{{ asset('/icon/mobile-encryption.svg') }}" width="100%" alt="">
                    </div>
                    <div class="col col-form">
                        <h3>Form Login</h3>
                        <p>Silahkan login menggunakan akun anda</p>
                        <div class="my-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" name="username" id="username" autocomplete="off" spellcheck="false" required>
                        </div>
                        <div class="mb-4">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" id="password" required>
                        </div>

                        <button type="submit" class="btn btn-primary py-3 mb-4">Masuk</button>
                        <p>Belum punya akun ? Registrasi <a href="{{ route('registration.index') }}" class="text-decoration-none">disini</a></p>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection