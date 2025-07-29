@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Selamat Datang, {{ Auth::user()->name }}!</h2>

    <div class="alert alert-info">
        Anda masuk sebagai <strong>Orang Tua</strong>. Gunakan dashboard ini untuk memantau tumbuh kembang balita Anda.
    </div>

    <div class="row g-4">
        <!-- Kartu Data Balita -->
        <div class="col-md-6 col-xl-4">
            <div class="card shadow border-0 h-100">
                <div class="card-body text-center">
                    <div class="mb-3">
                        <i class="bi bi-people-fill fs-1 text-primary"></i>
                    </div>
                    <h5 class="card-title">Data Balita</h5>
                    <p class="card-text">Lihat data balita yang terdaftar pada akun Anda.</p>
                    <a href="{{ url('/orangtua/balita') }}" class="btn btn-outline-primary btn-sm">Lihat Data</a>
                </div>
            </div>
        </div>

        <!-- Kartu Riwayat Kesehatan -->
        <div class="col-md-6 col-xl-4">
            <div class="card shadow border-0 h-100">
                <div class="card-body text-center">
                    <div class="mb-3">
                        <i class="bi bi-bar-chart-line-fill fs-1 text-success"></i>
                    </div>
                    <h5 class="card-title">Riwayat Kesehatan</h5>
                    <p class="card-text">Pantau perkembangan berat badan, tinggi, dan lainnya.</p>
                    <a href="{{ url('/orangtua/kms') }}" class="btn btn-outline-success btn-sm">Lihat Riwayat</a>
                </div>
            </div>
        </div>

        <!-- Kartu Jadwal Imunisasi -->
        <div class="col-md-6 col-xl-4">
            <div class="card shadow border-0 h-100">
                <div class="card-body text-center">
                    <div class="mb-3">
                        <i class="bi bi-calendar-check-fill fs-1 text-purple"></i>
                    </div>
                    <h5 class="card-title">Jadwal Imunisasi</h5>
                    <p class="card-text">Cek jadwal imunisasi balita Anda secara lengkap.</p>
                    <a href="{{ url('/orangtua/imunisasi') }}" class="btn btn-outline-secondary btn-sm">Lihat Jadwal</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
