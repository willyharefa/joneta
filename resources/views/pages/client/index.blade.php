@extends('layouts.dashboard')
@section('content')
    <section class="dashboard-client">
            <h1 class="mt-4">Dashboard Saya</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>

            @if (Auth::guard('owner')->check())
                <p>ya</p>
            @else
            <p>no</p>
            @endif
    </section>
@endsection