@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Selamat Datang, {{ Auth::user()->name }}!</h2>

    <div class="alert alert-info">
        Anda login sebagai <strong>Admin</strong>. Gunakan dashboard ini untuk mengelola seluruh data dan pengguna sistem Posyandu.
    </div>

    <div class="row g-4">
        <!-- Balita -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body text-center">
                    <i class="bi bi-people-fill fs-1 text-primary mb-3"></i>
                    <h5 class="card-title">Data Balita</h5>
                    <p class="card-text">Kelola seluruh data balita yang terdaftar.</p>
                    <a href="{{ url('/admin/balita') }}" class="btn btn-outline-primary btn-sm">Kelola</a>
                </div>
            </div>
        </div>

        <!-- Vitamin -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body text-center">
                    <i class="bi bi-capsule fs-1 text-success mb-3"></i>
                    <h5 class="card-title">Data Vitamin</h5>
                    <p class="card-text">Manajemen vitamin dan penggunaannya.</p>
                    <a href="{{ url('/admin/vitamin') }}" class="btn btn-outline-success btn-sm">Kelola</a>
                </div>
            </div>
        </div>

        <!-- Imunisasi -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body text-center">
                    <i class="bi bi-shield-plus fs-1 text-warning mb-3"></i>
                    <h5 class="card-title">Data Imunisasi</h5>
                    <p class="card-text">Kelola imunisasi untuk balita.</p>
                    <a href="{{ url('/admin/imunisasi') }}" class="btn btn-outline-warning btn-sm">Kelola</a>
                </div>
            </div>
        </div>

        <!-- KMS -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body text-center">
                    <i class="bi bi-bar-chart-line-fill fs-1 text-danger mb-3"></i>
                    <h5 class="card-title">Data KMS</h5>
                    <p class="card-text">Pantau grafik tumbuh kembang anak.</p>
                    <a href="{{ url('/admin/kms') }}" class="btn btn-outline-danger btn-sm">Kelola</a>
                </div>
            </div>
        </div>

        <!-- Vendor -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body text-center">
                    <i class="bi bi-truck fs-1 text-dark mb-3"></i>
                    <h5 class="card-title">Data Vendor</h5>
                    <p class="card-text">Kelola supplier vitamin dan vaksin.</p>
                    <a href="{{ url('/admin/vendor') }}" class="btn btn-outline-dark btn-sm">Kelola</a>
                </div>
            </div>
        </div>

        <!-- Manajemen User -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body text-center">
                    <i class="bi bi-person-gear fs-1 text-secondary mb-3"></i>
                    <h5 class="card-title">Manajemen User</h5>
                    <p class="card-text">Kelola akun admin, kader, dan orang tua.</p>
                    <a href="{{ url('/admin/user') }}" class="btn btn-outline-secondary btn-sm">Kelola</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
