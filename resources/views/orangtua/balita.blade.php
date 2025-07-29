@extends('layouts.app')

@section('content')
<div class="container">
    <h4 class="mb-1">Data Balita Anda</h4>
    <p class="text-muted mb-3">
        Akun: <strong>{{ Auth::user()->name }}</strong> ({{ Auth::user()->email }})
    </p>

    @if($balitas->count() > 0)
        <div class="accordion" id="accordionBalita">
            @foreach ($balitas as $balita)
                <div class="accordion-item mb-3">
                    <h2 class="accordion-header" id="heading{{ $balita->id_balita }}">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $balita->id_balita }}" aria-expanded="false" aria-controls="collapse{{ $balita->id_balita }}">
                            {{ $balita->nama_balita }} (NIK: {{ $balita->nik_balita }})
                        </button>
                    </h2>
                    <div id="collapse{{ $balita->id_balita }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $balita->id_balita }}" data-bs-parent="#accordionBalita">
                        <div class="accordion-body">
                            <p><strong>Tanggal Lahir:</strong> {{ \Carbon\Carbon::parse($balita->tanggal_lahir)->format('d-m-Y') }}</p>
                            <p><strong>Jenis Kelamin:</strong> {{ $balita->jenis_kelamin }}</p>
                            <p><strong>Golongan Darah:</strong> {{ $balita->golongan_darah ?? '-' }}</p>
                            <p><strong>Berat Lahir:</strong> {{ $balita->berat_lahir ?? '-' }} kg</p>
                            <p><strong>Panjang Lahir:</strong> {{ $balita->panjang_lahir ?? '-' }} cm</p>

                            <h6 class="mt-3">Riwayat Pemeriksaan KMS:</h6>
                            @if($balita->kms->count() > 0)
                                <div class="table-responsive">
                                    <table class="table table-sm table-bordered">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Tanggal</th>
                                                <th>Usia (bln)</th>
                                                <th>BB (kg)</th>
                                                <th>TB (cm)</th>
                                                <th>LK (cm)</th>
                                                <th>Imunisasi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($balita->kms as $kms)
                                            <tr>
                                                <td>{{ \Carbon\Carbon::parse($kms->tanggal_pemeriksaan)->format('d-m-Y') }}</td>
                                                <td>{{ $kms->usia_bulan }}</td>
                                                <td>{{ $kms->berat_badan }}</td>
                                                <td>{{ $kms->tinggi_badan }}</td>
                                                <td>{{ $kms->lingkar_kepala ?? '-' }}</td>
                                                <td>{{ $kms->imunisasi->nama_imunisasi ?? '-' }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <p class="text-muted">Belum ada data KMS untuk balita ini.</p>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-3">
            {{ $balitas->links() }}
        </div>
    @else
        <div class="alert alert-info text-center">
            Tidak ada data balita yang terdaftar untuk akun ini.
        </div>
    @endif
</div>
@endsection
