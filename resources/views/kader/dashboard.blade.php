@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Selamat Datang, {{ Auth::user()->name }}!</h2>

    <div class="alert alert-success">
        Anda login sebagai <strong>Kader Posyandu</strong>. Silakan kelola data balita, KMS, imunisasi, dan lainnya di sistem.
    </div>

    <div class="row g-4">
        <!-- Kartu Data Balita -->
        <div class="col-md-6 col-lg-4">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <div class="mb-3">
                        <i class="bi bi-people-fill fs-1 text-primary"></i>
                    </div>
                    <h5 class="card-title">Data Balita</h5>
                    <p class="card-text">Lihat dan kelola data balita di wilayah Anda.</p>
                    <a href="{{ url('/kader/balita') }}" class="btn btn-outline-primary btn-sm">Lihat Data</a>
                </div>
            </div>
        </div>

        <!-- Kartu KMS -->
        <div class="col-md-6 col-lg-4">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <div class="mb-3">
                        <i class="bi bi-clipboard-data-fill fs-1 text-success"></i>
                    </div>
                    <h5 class="card-title">Monitoring KMS</h5>
                    <p class="card-text">Rekam tinggi badan, berat badan, dan data tumbuh kembang balita.</p>
                    <a href="{{ url('/kader/kms') }}" class="btn btn-outline-success btn-sm">Kelola KMS</a>
                </div>
            </div>
        </div>

        <!-- Kartu Imunisasi -->
        <div class="col-md-6 col-lg-4">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <div class="mb-3">
                        <i class="bi bi-capsule-pill fs-1 text-warning"></i>
                    </div>
                    <h5 class="card-title">Data Imunisasi</h5>
                    <p class="card-text">Cek daftar imunisasi yang tersedia untuk balita.</p>
                    <a href="{{ url('/kader/imunisasi') }}" class="btn btn-outline-warning btn-sm">Lihat Imunisasi</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
