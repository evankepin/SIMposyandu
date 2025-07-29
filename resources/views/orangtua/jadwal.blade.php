@extends('layouts.app')

@section('content')
@php
    use Carbon\Carbon;
    use Carbon\CarbonPeriod;

    $now = Carbon::now();
    $startOfMonth = $now->copy()->startOfMonth();
    $endOfMonth = $now->copy()->endOfMonth();
    $daysInMonth = $now->daysInMonth;

    $jadwalMap = $jadwals->groupBy('tanggal_kegiatan');
@endphp

<div class="container">
    <h4 class="mb-3">Jadwal Posyandu</h4>
    <!-- Kalender Bulan Ini -->
    <h5 class="mb-3">Kalender Jadwal Posyandu Bulan {{ $now->locale('id')->translatedFormat('F Y') }}</h5>
    <div class="table-responsive">
        <table class="table table-bordered text-center">
            <thead class="table-light">
                <tr>
                    <th>Minggu</th>
                    <th>Senin</th>
                    <th>Selasa</th>
                    <th>Rabu</th>
                    <th>Kamis</th>
                    <th>Jumat</th>
                    <th>Sabtu</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $calendar = [];
                    $dayOfWeek = $startOfMonth->dayOfWeek;
                    $datePointer = $startOfMonth->copy()->startOfWeek();

                    while ($datePointer <= $endOfMonth->copy()->endOfWeek()) {
                        $week = [];
                        for ($i = 0; $i < 7; $i++) {
                            $week[] = $datePointer->copy();
                            $datePointer->addDay();
                        }
                        $calendar[] = $week;
                    }
                @endphp

                @foreach ($calendar as $week)
                    <tr>
                        @foreach ($week as $day)
                            <td class="{{ $day->month !== $now->month ? 'text-muted' : '' }}"
                                style="vertical-align: top; height: 120px; padding: 5px;">
                                <div><strong>{{ $day->day }}</strong></div>
                                @foreach ($jadwalMap[$day->format('Y-m-d')] ?? [] as $item)
                                    <div class="mt-1 p-1 bg-info text-white rounded small">
                                        <small>{{ $item->jenis_kegiatan }}</small>
                                    </div>
                                @endforeach
                            </td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{ $jadwals->links() }}
</div>
    <!-- Search -->
    <form class="mb-4" method="GET">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Cari lokasi atau jenis kegiatan..." value="{{ request('search') }}">
            <button class="btn btn-outline-primary" type="submit">Cari</button>
        </div>
    </form>

    <!-- Tabel Jadwal List -->
    <h5 class="mb-3">Daftar Jadwal</h5>
    <div class="table-responsive mb-4">
        <table class="table table-bordered table-hover">
            <thead class="table-light">
                <tr>
                    <th>Tanggal</th>
                    <th>Waktu</th>
                    <th>Lokasi</th>
                    <th>Jenis Kegiatan</th>
                    <th>Deskripsi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($jadwals as $jadwal)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($jadwal->tanggal_kegiatan)->format('d-m-Y') }}</td>
                    <td>{{ $jadwal->waktu_kegiatan }}</td>
                    <td>{{ $jadwal->lokasi }}</td>
                    <td>{{ $jadwal->jenis_kegiatan }}</td>
                    <td>{{ $jadwal->deskripsi }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center">Tidak ada jadwal tersedia.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

@endsection
